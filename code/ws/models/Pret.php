<?php
require_once __DIR__ . '/../db.php';

class Pret {
    public static function create($data) {
        $db = getDB();
        $stmt = $db->prepare("INSERT INTO pret (id_pret_type, id_client, montant, duree, description) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$data->id_pret_type, $data->id_client, $data->montant, $data->duree, $data->description]);
        return $db->lastInsertId();
    }
    public function updatePretEtat($data) {
        $db = getDB();
        $stmt = $db->prepare("INSERT INTO pret_etat (id_pret, id_pret_statut, date_etat, id_employe) VALUES (?, ?, ?, ?)");
        $stmt->execute([$data->id_pret, $data->id_pret_statut, $data->date_etat, $data->id_employe]);
        return $db->lastInsertId();
    }
}