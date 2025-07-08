<?php
require_once __DIR__ . '/../db.php';

class CompteMouvement {
    public static function getAll() {
        $db = getDBTest();
        $stmt = $db->query("
            SELECT cm.*, c.numero, ctm.entree
            FROM compte_mouvement cm
            JOIN compte c ON cm.id_compte = c.id
            JOIN compte_type_mouvement ctm ON cm.id_compte_type_mouvement = ctm.id
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id) {
        $db = getDBTest();
        $stmt = $db->prepare("
            SELECT cm.*, c.numero, ctm.entree
            FROM compte_mouvement cm
            JOIN compte c ON cm.id_compte = c.id
            JOIN compte_type_mouvement ctm ON cm.id_compte_type_mouvement = ctm.id
            WHERE cm.id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getByCompte($id_compte) {
        $db = getDBTest();
        $stmt = $db->prepare("
            SELECT cm.*, c.numero, ctm.entree
            FROM compte_mouvement cm
            JOIN compte c ON cm.id_compte = c.id
            JOIN compte_type_mouvement ctm ON cm.id_compte_type_mouvement = ctm.id
            WHERE cm.id_compte = ?
        ");
        $stmt->execute([$id_compte]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create($data) {
        $db = getDBTest();
        $stmt = $db->prepare("
            INSERT INTO compte_mouvement (
                id_compte_type_mouvement, id_compte, id_contributeur, date_mouvement, montant
            ) VALUES (?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $data->id_compte_type_mouvement,
            $data->id_compte,
            $data->id_contributeur,
            $data->date_mouvement,
            $data->montant
        ]);
        return $db->lastInsertId();
    }

    public static function update($id, $data) {
        $db = getDBTest();
        $stmt = $db->prepare("
            UPDATE compte_mouvement SET 
                id_compte_type_mouvement = ?,
                id_compte = ?,
                id_contributeur = ?,
                date_mouvement = ?,
                montant = ?
            WHERE id = ?
        ");
        $stmt->execute([
            $data->id_compte_type_mouvement,
            $data->id_compte,
            $data->id_contributeur,
            $data->date_mouvement,
            $data->montant,
            $id
        ]);
    }

    public static function delete($id) {
        $db = getDBTest();
        $stmt = $db->prepare("DELETE FROM compte_mouvement WHERE id = ?");
        $stmt->execute([$id]);
    }
}
