<?php
require_once __DIR__ . '/../db.php';

class Fond {
    public static function getAll() {
        $db = getDB();
        $stmt = $db->query("SELECT * FROM fond");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /*public static function getStatistiquesFinancieres() {
        $db = getDB();
        $stmt = $db->query("
            SELECT 
                somme_encaissements_clients,
                montant_pretable,
                somme_autres_fonds
            FROM fond
        ");
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }*/

   
}