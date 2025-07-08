<?php
require_once __DIR__ . '/../db.php';

class CompteTypeMouvement {
    public static function getAll() {
        $db = getDB();
        $stmt = $db->query("SELECT * FROM compte_type_mouvement");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id) {
        $db = getDB();
        $stmt = $db->prepare("SELECT * FROM compte_type_mouvement WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getByEntree($entree) {
        $db = getDB();
        $stmt = $db->prepare("SELECT * FROM compte_type_mouvement WHERE entree = ?");
        $stmt->execute([$entree]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getByDescription($description) {
        $db = getDB();
        $stmt = $db->prepare("SELECT * FROM compte_type_mouvement WHERE description = ?");
        $stmt->execute([$description]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($data) {
        $db = getDB();
        $stmt = $db->prepare("INSERT INTO compte_type_mouvement (description,entree) VALUES (?, ?)");
        $stmt->execute([
            $data->description,
            $data->entree
        ]);
        return $db->lastInsertId();
    }

    //pas necessaire mais peut servir
    /*public static function update($id, $data) {
        $db = getDB();
        $stmt = $db->prepare("UPDATE compte_type_mouvement SET nom = ?, prenom = ?, email = ?, age = ? WHERE id = ?");
        $stmt->execute([
            $data->id_compte_type_mouvement,
            $data->id_compte,
            $data->id_contributeur,
            $data->date_mouvement,
            $data->montant, $id]);
    }

    public static function delete($id) {
        $db = getDB();
        $stmt = $db->prepare("DELETE FROM compte_type_mouvement WHERE id = ?");
        $stmt->execute([$id]);
    }*/
}
