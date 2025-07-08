<?php
require_once __DIR__ . '/../db.php';

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
    
        // Récupérer l'échéance du prêt à cette date
        $stmt = $conn->prepare("
            SELECT * FROM remboursement_pret 
            WHERE id_pret = ? 
              AND date_prevue = ?
        ");
        $stmt->execute([$idPret, $date]);
        $remboursement = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if (!$remboursement) return [];
    
        // Calcul pénalité si retard
        $datePrevue = new DateTime($remboursement['date_prevue']);
        $dateChoisie = new DateTime($date);
        $diff = $dateChoisie->diff($datePrevue);
        $retard = ($dateChoisie > $datePrevue) ? $diff->days : 0;
    
        // Récupérer pénalité journalière
        $stmt = $conn->query("SELECT pourcentage FROM penalite ORDER BY date_modif DESC LIMIT 1");
        $penalitePourcent = (float) $stmt->fetchColumn();
    
        $montantPenalite = 0;
        if ($retard > 0) {
            // Pénalité = annuité * (penalité %/jour) * nb jours
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
    
        // Récupérer la ligne concernée : prochaine échéance non remboursée
        $stmt = $conn->prepare("
            SELECT * FROM remboursement_pret 
            WHERE id_pret = ? 
              AND date_remboursement IS NULL 
              ORDER BY date_prevue ASC LIMIT 1
        ");
        $stmt->execute([$idPret]);
        $remboursement = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if (!$remboursement) return false;
    
        // Vérifier retard
        $datePrevue = new DateTime($remboursement['date_prevue']);
        $dateRemb = new DateTime($dateRemboursement);
        $retard = ($dateRemb > $datePrevue) ? $dateRemb->diff($datePrevue)->days : 0;
    
        $montantPenalite = 0;
    
        if ($retard > 0) {
            // Récupérer taux de pénalité
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
    
    
}
