<?php
require_once __DIR__ . '/../db.php';

class CompteMouvement {
    public static function getAll() {
        $db = getDB();
        $stmt = $db->query("SELECT * FROM compte_mouvement");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getByCompte($id_compte) {
        $db = getDB();
        $stmt = $db->prepare("SELECT * FROM compte_mouvement WHERE id_compte = ?");
        $stmt->execute([$id_compte]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($data) {
        $db = getDB();
        $stmt = $db->prepare("INSERT INTO compte_mouvement (id_compte_type_mouvement,id_compte,id_contributeur,date_mouvement,montant) VALUES (?, ?, ?, ?)");
        $stmt->execute([
            $data->id_compte_type_mouvement,
            $data->id_compte,
            $data->id_contributeur,
            $data->date_mouvement,
            $data->montant]);
        return $db->lastInsertId();
    }
}
