<?php
require_once __DIR__ . '/../db.php';

class CompteClient {
    public static function getAll() {
        $db = getDB();
        $stmt = $db->query("SELECT * FROM compte_client");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getByClient($id_client) {
        $db = getDB();
        $stmt = $db->prepare("SELECT * FROM compte_client WHERE id_client= ?");
        $stmt->execute([$id_client]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($data) {
        $db = getDB();
        $stmt = $db->prepare("INSERT INTO compteClient (id_client,id_compte,date,attribution) VALUES (?, ?, ?, ?)");
        $stmt->execute([
            $data->id_client,
            $data->id_compte,
            $data->date,
            $data->attribution
        ]);
        return $db->lastInsertId();
    }

    
    public static function update($id_compte, $data) {
        $db = getDB();
        $stmt = $db->prepare("UPDATE compte_client SET id_client = ?, id_compte = ?, date = ?, attribution = ?  WHERE id_compte = ?");
        $stmt->execute([
            $data->id_client,
            $data->id_compte,
            $data->date,
            $data->attribution,
            $id_compte]);
    }
    
    //pas necessaire mais peut servir
    /*public static function delete($id) {
        $db = getDB();
        $stmt = $db->prepare("DELETE FROM compte_client WHERE id = ?");
        $stmt->execute([$id]);
    }*/
}
