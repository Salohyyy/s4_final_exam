<?php
require_once __DIR__ . '/../models/Etudiant.php';
require_once __DIR__ . '/../helpers/Utils.php';



class AjoutController {
    public static function getAll() {
        $etudiants = CompteMouvement::getAll();
        Flight::json($etudiants);
    }

    public static function getById($id) {
        $etudiant = CompteMouvement::getById($id);
        Flight::json($etudiant);
    }

    public static function create() {
        $data = Flight::request()->data;
        $id = CompteMouvement::create($data);
        $dateFormatted = Utils::formatDate('2025-01-01');
        Flight::json(['message' => 'Mouvement ajouté', 'id' => $id]);
    }

    public static function update($id) {
        $data = Flight::request()->data;
        CompteMouvement::update($id, $data);
        Flight::json(['message' => 'Mouvement modifié']);
    }

    public static function delete($id) {
        CompteMouvement::delete($id);
        Flight::json(['message' => 'Mouvement supprimé']);
    }
}
