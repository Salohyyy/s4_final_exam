<?php
require_once __DIR__ . '/../db.php';

class PretCaracteristique {
    public static function getAll() {
        $db = getDB();
        $stmt = $db->query("SELECT * FROM pret_caracteristique");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id) {
        $db = getDB();
        $stmt = $db->prepare("SELECT * FROM pret_caracteristique WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($data) {
        $db = getDB();
        $stmt = $db->prepare("INSERT INTO pret_caracteristique (id_pret_type, montant_min, montant_max, duree_min,duree_max,taux_interet) VALUES (?, ?, ?, ?,?,?)");
        $stmt->execute([$data->id_pret_type, $data->montant_min, $data->montant_max, $data->duree_min, $data->duree_max, $data->taux_interet]);
        return $db->lastInsertId();
    }

    public static function update($id, $data) {
        $db = getDB();
        $stmt = $db->prepare("UPDATE pret_caracteristique SET id_pret_type = ?, montant_min = ?, montant_max = ?, duree_min = ?, duree_max = ?, taux_interet = ?  WHERE id = ?");
        $stmt->execute([$data->id_pret_type, $data->montant_min, $data->montant_max, $data->duree_min, $data->duree_max, $data->taux_interet]);
    }

    public static function delete($id) {
        $db = getDB();
        $stmt = $db->prepare("DELETE FROM pret_caracteristique WHERE id = ?");
        $stmt->execute([$id]);
    }
}
