<?php
require_once __DIR__ . '/../db.php';

class Compte {
    public static function getByClient($id_client) {
        $db = getDB();
        $sql = "SELECT * FROM compte WHERE id_client = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$id_client]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
