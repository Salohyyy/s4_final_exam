<?php
require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../fpdf186/fpdf.php'; 
// C:\xampp\htdocs\S4\s4_final_exam\fpdf186\fpdf.php
class RemboursementModel {
    public static function getPretsNonRembourses($idClient) {
        $conn = getDB();

        $sql = "
            SELECT p.id, p.montant, p.duree, p.delais, pt.description AS type
            FROM pret p
            JOIN pret_type pt ON p.id_pret_type = pt.id
            WHERE p.id_client = ?
              AND EXISTS (
                SELECT 1
                FROM remboursement_pret r
                WHERE r.id_pret = p.id
                  AND r.date_remboursement IS NULL
            )
        ";

        $stmt = $conn->prepare($sql);
        $stmt->execute([$idClient]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function getRemboursementDetails($idPret, $date) {
        $conn = getDB();
    
        // Recuperer l'echeance du pret à cette date
        $stmt = $conn->prepare("
            SELECT * FROM remboursement_pret 
            WHERE id_pret = ? 
              AND date_prevue = ?
        ");
        $stmt->execute([$idPret, $date]);
        $remboursement = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if (!$remboursement) return [];
    
        // Calcul penalite si retard
        $datePrevue = new DateTime($remboursement['date_prevue']);
        $dateChoisie = new DateTime($date);
        $diff = $dateChoisie->diff($datePrevue);
        $retard = ($dateChoisie > $datePrevue) ? $diff->days : 0;
    
        // Recuperer penalite journalière
        $stmt = $conn->query("SELECT pourcentage FROM penalite ORDER BY date_modif DESC LIMIT 1");
        $penalitePourcent = (float) $stmt->fetchColumn();
    
        $montantPenalite = 0;
        if ($retard > 0) {
            // Penalite = annuite * (penalite %/jour) * nb jours
            $montantPenalite = $remboursement['annuite'] * $penalitePourcent / 100 * $retard;
        }
    
        return [
            'assurance'      => $remboursement['assurance'],
            'amortissement'  => $remboursement['amortissement'],
            'interet'        => $remboursement['interet'],
            'annuite'        => $remboursement['annuite'],
            'montant_penalite' => round($montantPenalite, 2)
        ];
    }
    public static function validerRemboursement($idPret, $dateRemboursement) {
        $conn = getDB();
    
        // Recuperer la ligne concernee : prochaine echeance non remboursee
        $stmt = $conn->prepare("
            SELECT * FROM remboursement_pret 
            WHERE id_pret = ? 
              AND date_remboursement IS NULL 
              ORDER BY date_prevue ASC LIMIT 1
        ");
        $stmt->execute([$idPret]);
        $remboursement = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if (!$remboursement) return false;
    
        // Verifier retard
        $datePrevue = new DateTime($remboursement['date_prevue']);
        $dateRemb = new DateTime($dateRemboursement);
        $retard = ($dateRemb > $datePrevue) ? $dateRemb->diff($datePrevue)->days : 0;
    
        $montantPenalite = 0;
    
        if ($retard > 0) {
            // Recuperer taux de penalite
            $stmt = $conn->query("SELECT pourcentage FROM penalite ORDER BY date_modif DESC LIMIT 1");
            $taux = (float) $stmt->fetchColumn();
            $montantPenalite = $remboursement['annuite'] * $taux / 100 * $retard;
        }
    
        // Mise à jour
        $stmt = $conn->prepare("
            UPDATE remboursement_pret 
            SET date_remboursement = ?, montant_penalite = ? 
            WHERE id = ?
        ");
        return $stmt->execute([$dateRemboursement, round($montantPenalite, 2), $remboursement['id']]);
    }
    
    public static function genererPDF($idPret) {
        $db = getDB();

        // 1. Recuperer les details du pret
        $stmt = $db->prepare("
            SELECT p.*, c.nom, c.prenom, a.pourcentage AS assurance
            FROM pret p
            JOIN client c ON p.id_client = c.id
            LEFT JOIN assurance a ON a.date_modif = (
                SELECT MAX(date_modif) FROM assurance
            )
            WHERE p.id = ?
        ");
        $stmt->execute([$idPret]);
        $pret = $stmt->fetch(PDO::FETCH_ASSOC);

        // 2. Recuperer les echeances
        $stmt = $db->prepare("
            SELECT * FROM remboursement_pret WHERE id_pret = ? ORDER BY date_prevue ASC
        ");
        $stmt->execute([$idPret]);
        $remboursements = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // 3. Creation PDF
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',16);

        $pdf->Cell(0,10,"Echeancier du pret #{$idPret}",0,1,'C');
        $pdf->SetFont('Arial','',12);
        $pdf->Cell(0,10,"Client: {$pret['nom']} {$pret['prenom']}",0,1);
        $pdf->Cell(0,10,"Montant: {$pret['montant']} Ar - Duree: {$pret['duree']} mois",0,1);
        $pdf->Cell(0,10,"Taux d'assurance: {$pret['assurance']} %",0,1);
        $pdf->Ln(5);

        // Table
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(25,8,"Interet",1);
        $pdf->Cell(35,8,"Amortissement",1);
        $pdf->Cell(25,8,"Annuite",1);
        $pdf->Cell(30,8,"Prevue",1);
        $pdf->Cell(40,8,"Remboursee",1);
        $pdf->Cell(30,8,"Penalite",1);
        $pdf->Ln();

        $pdf->SetFont('Arial','',10);
        foreach ($remboursements as $r) {
            $pdf->Cell(25,8,number_format($r['interet'],2),1);
            $pdf->Cell(35,8,number_format($r['amortissement'],2),1);
            $pdf->Cell(25,8,number_format($r['annuite'],2),1);
            $pdf->Cell(30,8,$r['date_prevue'],1);
            $pdf->Cell(40,8,$r['date_remboursement'] ?? '-',1);
            $pdf->Cell(30,8,number_format($r['montant_penalite'],2),1);
            $pdf->Ln();
        }

        ob_start();
        $pdf->Output();
        return ob_get_clean();
    }
    public static function getPretsClient($idClient) {
        $db = getDB();
    
        $sql = "
            SELECT p.id, p.montant, p.duree, p.delais
            FROM pret p
            JOIN pret_etat pe ON pe.id_pret = p.id
            WHERE p.id_client = ? 
            AND pe.id_pret_statut = 2
            ORDER BY p.id DESC
        ";
    
        $stmt = $db->prepare($sql);
        $stmt->execute([$idClient]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
