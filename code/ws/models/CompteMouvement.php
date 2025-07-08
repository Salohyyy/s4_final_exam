<?php
require_once __DIR__ . '/../db.php';

class CompteMouvement {
    public static function getAll() {
        $db = getDB();
        $stmt = $db->query("SELECT * FROM compte_mouvement");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getInvestissement() {
        $db = getDB();
        $stmt = $db->query("SELECT ct.libelle contributeur,ctm.description description,c.numero compte,date_mouvement,montant 
        FROM compte_mouvement cm 
        JOIN contributeur ct ON ct.id=cm.id_contributeur
        JOIN compte_type_mouvement ctm ON ctm.id=cm.id_compte_type_mouvement
        JOIN compte c ON c.id=cm.id_compte
        WHERE id_compte_type_mouvement=3");
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
        $stmt = $db->prepare("INSERT INTO compte_mouvement (id_compte_type_mouvement,id_compte,id_contributeur,date_mouvement,montant) VALUES (?, ?, ?, ?,?)");
        $stmt->execute([
            $data->id_compte_type_mouvement,
            $data->id_compte,
            $data->id_contributeur,
            $data->date_mouvement,
            $data->montant]);
        return $db->lastInsertId();
    }

    //pas necessaire mais peut servir
    /*public static function update($id, $data) {
        $db = getDB();
        $stmt = $db->prepare("UPDATE compte_mouvement SET id_compte_type_mouvement = ?, id_compte = ?, id_contributeur = ?, date_mouvement = ?, montant=? WHERE id = ?");
        $stmt->execute([
            $data->id_compte_type_mouvement,
            $data->id_compte,
            $data->id_contributeur,
            $data->date_mouvement,
            $data->montant, $id]);
    }

    public static function delete($id) {
        $db = getDB();
        $stmt = $db->prepare("DELETE FROM compte_mouvement WHERE id = ?");
        $stmt->execute([$id]);
    }*/
}
