<?php
require_once __DIR__ . '/../db.php';

class CourbeInteret {
    public static function getInteret($date_deb,$date_fin) {
        $db = getDB();
        $stmt = $db->prepare("SELECT
        YEAR(date_remboursement) AS annee,
        MONTH(date_remboursement) AS mois,
        MONTHNAME(date_remboursement) AS nom_mois,
        COALESCE(SUM(interet), 0) AS total_interets,
        COALESCE(SUM(montant_penalite), 0) AS total_penalites,
        COUNT(id) AS nombre_remboursements
        FROM remboursement_pret
        WHERE date_remboursement BETWEEN ? AND ?
        GROUP BY annee, mois, nom_mois
        ORDER BY annee, mois");
        $stmt->execute([$date_deb, $date_fin]); 
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}