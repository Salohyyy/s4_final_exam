<?php
require_once __DIR__ . '/../db.php';
class PretType {
    public static function getAll() {
        $db = getDB();
        $stmt = $db->query("SELECT * FROM pret_type");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
