<?php
require_once __DIR__ . '/../db.php';

class Contributeur {
    public static function getAll() {
        $db = getDB();
        $stmt = $db->query("SELECT * FROM contributeur");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id) {
        $db = getDB();
        $stmt = $db->prepare("SELECT * FROM contributeur WHERE libelle = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getByLibelle($libelle) {
        $db = getDB();
        $stmt = $db->prepare("SELECT * FROM contributeur WHERE libelle = ?");
        $stmt->execute([$libelle]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($data) {
        $db = getDB();
        $stmt = $db->prepare("INSERT INTO contributeur VALUES (?)");
        $stmt->execute([
            $data->libelle]);
        return $db->lastInsertId();
    }

    //pas necessaire mais peut servir
    /*public static function update($libelle, $data) {
        $db = getDB();
        $stmt = $db->prepare("UPDATE contributeur SET libelle = ?");
        $stmt->execute([
            $data->libelle, $libelle]);
    }
    
    /*public static function delete($libelle) {
        $db = getDB();
        $stmt = $db->prepare("DELETE FROM contributeur WHERE libelle = ?");
        $stmt->execute([$libelle]);
    }*/
}
