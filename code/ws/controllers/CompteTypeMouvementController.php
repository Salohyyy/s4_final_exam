<?php
require_once __DIR__ . '/../models/CompteTypeMouvement.php';
require_once __DIR__ . '/../helpers/Utils.php';



class CompteTypeMouvementController {
    public static function getAll() {
        $compteTypeMouvement = CompteTypeMouvement::getAll();
        Flight::json($compteTypeMouvement);
    }

    public static function getById($id) {
        $compteTypeMouvement = CompteTypeMouvement::getById($id);
        Flight::json($compteTypeMouvement);
    }

    public static function getByDescription($description) {
        $compteTypeMouvement = CompteTypeMouvement::getByDescription($description);
        Flight::json($compteTypeMouvement);
    }

    public static function getByEntree($entree) {
        $compteTypeMouvement = CompteTypeMouvement::getByEntree($entree);
        Flight::json($compteTypeMouvement);
    }


    //pas necessaire mais peut servir
    /*public static function update($numero) {
        $data = Flight::request()->data;
        CompteTypeMouvement::update($numero, $data);
        Flight::json(['message' => 'CompteTypeMouvement modifié']);
    }

    /*public static function delete($numero) {
        CompteTypeMouvement::delete($numero);
        Flight::json(['message' => 'CompteTypeMouvement supprimé']);
    }*/
}
