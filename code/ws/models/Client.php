<?php
require_once __DIR__ . '/../db.php';

class Client {
    public static function getAll() {
        $db = getDB();
        $sql = "SELECT * FROM client";
        $stmt = $db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}