<?php
require_once __DIR__ . '/../db.php';

class Mouvement {
    // Trouver le type de mouvement selon le champ "entree"
    public static function getTypeByEntree($entree) {
        $db = getDB();
        $sql = "SELECT * FROM compte_type_mouvement WHERE entree = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$entree]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Insérer un nouveau mouvement
    public static function insert($data) {
        $db = getDB();
        $sql = "INSERT INTO compte_mouvement (id_compte_type_mouvement, id_compte, id_contributeur, date_mouvement, montant)
                VALUES (:id_type, :id_compte, :id_contributeur, :date_mvt, :montant)";
        $stmt = $db->prepare($sql);
        $stmt->execute([
            ':id_type' => $data['id_compte_type_mouvement'],
            ':id_compte' => $data['id_compte'],
            ':id_contributeur' => $data['id_contributeur'],
            ':date_mvt' => $data['date_mouvement'],
            ':montant' => $data['montant']
        ]);
    }
}
