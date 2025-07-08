<?php
require_once __DIR__ . '/../db.php';
class PretEtat {
    public static function insertEtatInitial($id_pret, $id_employe = 1) {
        $db = getDB();
        // Récupérer l'ID du statut "en attente"
        $sqlStatut = "SELECT id FROM pret_statut WHERE LOWER(libelle) = 'en attente'";
        $statut = $db->query($sqlStatut)->fetch(PDO::FETCH_ASSOC);

        if (!$statut) {
            throw new Exception("Statut 'en attente' introuvable.");
        }

        $sql = "INSERT INTO pret_etat (id_pret, id_pret_statut, date_etat, id_employe)
                VALUES (:id_pret, :id_pret_statut, :date_etat, :id_employe)";
        $stmt = $db->prepare($sql);
        $stmt->execute([
            ':id_pret' => $id_pret,
            ':id_pret_statut' => $statut['id'],
            ':date_etat' => date('Y-m-d'),
            ':id_employe' => $id_employe
        ]);
    }
}
