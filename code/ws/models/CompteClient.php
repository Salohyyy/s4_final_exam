<?php
require_once __DIR__ . '/../db.php';

class CompteClient {
    public static function getAll() {
        $db = getDBTest();
        $stmt = $db->query("SELECT * FROM compte_client");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id) {
        $db = getDBTest();
        $stmt = $db->prepare("SELECT * FROM compte_client WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($data) {
        $db = getDBTest();
        $stmt = $db->prepare("
            INSERT INTO compte_client (id_client, id_compte, date, attribution)
            VALUES (?, ?, ?, ?)
        ");
        $stmt->execute([
            $data->id_client,
            $data->id_compte,
            $data->date,
            $data->attribution
        ]);
        return $db->lastInsertId();
    }

    public static function update($id, $data) {
        $db = getDBTest();
        $stmt = $db->prepare("
            UPDATE compte_client
            SET id_client = ?, id_compte = ?, date = ?, attribution = ?
            WHERE id = ?
        ");
        $stmt->execute([
            $data->id_client,
            $data->id_compte,
            $data->date,
            $data->attribution,
            $id
        ]);
    }

    public static function delete($id) {
        $db = getDBTest();
        $stmt = $db->prepare("DELETE FROM compte_client WHERE id = ?");
        $stmt->execute([$id]);
    }

    public static function getByClient($id_client) {
        $db = getDBTest();
        $stmt = $db->prepare("
            SELECT cc.*, c.numero
            FROM compte_client cc
            JOIN compte c ON cc.id_compte = c.id
            WHERE cc.id_client = ?
        ");
        $stmt->execute([$id_client]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
