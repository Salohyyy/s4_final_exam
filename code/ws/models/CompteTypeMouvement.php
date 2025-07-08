<?php
require_once __DIR__ . '/../db.php';

class CompteTypeMouvement {
    public static function getAll() {
        $db = getDBTest();
        $stmt = $db->query("SELECT * FROM compte_type_mouvement");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id) {
        $db = getDBTest();
        $stmt = $db->prepare("SELECT * FROM compte_type_mouvement WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getByEntree($entree) {
        $db = getDBTest();
        $stmt = $db->prepare("SELECT * FROM compte_type_mouvement WHERE entree = ?");
        $stmt->execute([$entree]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($data) {
        $db = getDBTest();
        $stmt = $db->prepare("INSERT INTO compte_type_mouvement (description, entree) VALUES (?, ?)");
        $stmt->execute([$data->description, $data->entree]);
        return $db->lastInsertId();
    }

    public static function update($id, $data) {
        $db = getDBTest();
        $stmt = $db->prepare("UPDATE compte_type_mouvement SET description = ?, entree = ? WHERE id = ?");
        $stmt->execute([$data->description, $data->entree, $id]);
    }

    public static function delete($id) {
        $db = getDBTest();
        $stmt = $db->prepare("DELETE FROM compte_type_mouvement WHERE id = ?");
        $stmt->execute([$id]);
    }
}
