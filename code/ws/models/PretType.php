<?php
require_once __DIR__ . '/../db.php';

class PretType {
    public static function getAll() {
        $db = getDB();
        $stmt = $db->query("SELECT * FROM pret_type");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id) {
        $db = getDB();
        $stmt = $db->prepare("SELECT * FROM pret_type WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($data) {
        $db = getDB();
        $stmt = $db->prepare("INSERT INTO pret_type (description, but) VALUES (?, ?)");
        $stmt->execute([$data->description, $data->but]);
        return $db->lastInsertId();
    }

    public static function update($id, $data) {
        $db = getDB();
        $stmt = $db->prepare("UPDATE pret_type SET description = ?, but = ? WHERE id = ?");
        $stmt->execute([$data->description, $data->but]);
    }

    public static function delete($id) {
        $db = getDB();
        $stmt = $db->prepare("DELETE FROM pret_type WHERE id = ?");
        $stmt->execute([$id]);
    }
}
