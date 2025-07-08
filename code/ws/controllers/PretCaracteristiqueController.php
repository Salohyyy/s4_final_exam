<?php
require_once __DIR__ . '/../models/PretCaracteristique.php';
require_once __DIR__ . '/../helpers/Utils.php';



class PretCaracteristiqueController {
    public static function getAll() {
        $PretCaracteristiques = PretCaracteristique::getAll();
        Flight::json($PretCaracteristiques);
    }

    public static function getById($id) {
        $PretCaracteristique = PretCaracteristique::getById($id);
        Flight::json($PretCaracteristique);
    }

    public static function create() {
        $data = Flight::request()->data;
        $id = PretCaracteristique::create($data);
        $dateFormatted = Utils::formatDate('2025-01-01');
        Flight::json(['message' => 'Pret Caracteristique ajouté', 'id' => $id]);
    }

    public static function update($id) {
        $data = Flight::request()->data;
        PretCaracteristique::update($id, $data);
        Flight::json(['message' => 'Pret Caracteristique modifié']);
    }

    /*public static function delete($id) {
        PretCaracteristique::delete($id);
        Flight::json(['message' => 'Pret Caracteristique supprimé']);
    }*/
}
