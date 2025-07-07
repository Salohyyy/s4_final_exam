<?php
require_once __DIR__ . '/../db.php';

class Compte {
    public static function getAll() {
        $db = getDB();
        $stmt = $db->query("SELECT * FROM compte");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id) {
        $db = getDB();
        $stmt = $db->prepare("SELECT * FROM compte WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getByNumero($numero) {
        $db = getDB();
        $stmt = $db->prepare("SELECT * FROM compte WHERE numero= ?");
        $stmt->execute([$numero]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getCompteInstitutionnelle() {
        $id_compte_type=2;
        $db = getDB();
        $stmt = $db->prepare("SELECT * FROM compte WHERE id_compte_type= ?");
        $stmt->execute([$id_compte_type]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create($data) {
        $db = getDB();
        $stmt = $db->prepare("INSERT INTO compte (numero,id_compte_type) VALUES (?, ?)");
        $stmt->execute([
            $data->numero,
            $data->id_compte_type
        ]);
        return $db->lastInsertId();
    }

    //pas necessaire mais peut servir
    /*public static function update($numero, $data) {
        $db = getDB();
        $stmt = $db->prepare("UPDATE compte SET numero = ?, id_compte_type = ? WHERE numero = ?");
        $stmt->execute([
            $data->numero,
            $data->id_compte_type, $numero]);
    }
    
    public static function delete($id) {
        $db = getDB();
        $stmt = $db->prepare("DELETE FROM compte WHERE id = ?");
        $stmt->execute([$id]);
    }*/
}
