<?php
require_once __DIR__ . '/../models/PretType.php';
require_once __DIR__ . '/../helpers/Utils.php';



class PretTypeController {
    public static function getAll() {
        $pretType = PretType::getAll();
        Flight::json($pretType);
    }

    public static function getById($id) {
        $PretType = PretType::getById($id);
        Flight::json($PretType);
    }

    public static function create() {
        $data = Flight::request()->data;
        $id = PretType::create($data);
        $dateFormatted = Utils::formatDate('2025-01-01');
        Flight::json(['message' => 'Type de prêt ajouté', 'id' => $id]);
    }

    public static function update($id) {
        $data = Flight::request()->data;
        PretType::update($id, $data);
        Flight::json(['message' => 'Type de prêt modifié']);
    }

    /*public static function delete($id) {
        PretType::delete($id);
        Flight::json(['message' => 'Type de prêt supprimé']);
    }*/
}
