<?php
require_once __DIR__ . '/../db.php';
class DisponibiliteModel {
    public static function getDisponibiliteParMois($moisDebut, $anneeDebut, $moisFin, $anneeFin) {
        $db = getDB();

        $debut = DateTime::createFromFormat('Y-m', "$anneeDebut-$moisDebut");
        $fin = DateTime::createFromFormat('Y-m', "$anneeFin-$moisFin");

        $data = [];

        while ($debut <= $fin) {
            $mois = $debut->format('m');
            $annee = $debut->format('Y');

            // Total remboursements du mois
            $stmtR = $db->prepare("
                SELECT SUM(COALESCE(annuite + montant_penalite, 0)) AS remboursement 
                FROM remboursement_pret 
                WHERE MONTH(date_remboursement) = ? AND YEAR(date_remboursement) = ?
            ");
            $stmtR->execute([$mois, $annee]);
            $rembourse = $stmtR->fetch()['remboursement'] ?? 0;

            // Total montant non encore emprunté
            $stmtE = $db->query("SELECT COALESCE(SUM(montant), 0) as total FROM fonds WHERE etat = 'non_emprunte'");
            $non_emprunte = $stmtE->fetch()['total'] ?? 0;

            $data[] = [
                'mois' => $mois,
                'annee' => $annee,
                'non_emprunte' => (float) $non_emprunte,
                'rembourse' => (float) $rembourse,
                'total_disponible' => (float) $non_emprunte + $rembourse
            ];

            $debut->modify('+1 month');
        }

        return $data;
    }
}
