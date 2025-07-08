<?php
require_once __DIR__ . '/../models/Compte.php';
require_once __DIR__ . '/../helpers/Utils.php';



class CompteController {
    public static function getAll() {
        $compte = Compte::getAll();
        Flight::json($compte);
    }

    public static function getById($id) {
        $compte = Compte::getById($id);
        Flight::json($compte);
    }

    public static function getByNumero($numero) {
        $compte = Compte::getByNumero($numero);
        Flight::json($compte);
    }

    public static function getCompteInstitutionnelle() {
        $compte = Compte::getCompteInstitutionnelle();
        Flight::json($compte);
    }

    public static function create() {
        $data = Flight::request()->data;
        $numero = Compte::create($data);
        $dateFormatted = Utils::formatDate('2025-01-01');
        Flight::json(['message' => 'Compte ajouté', 'numero' => $numero]);
    }

    //pas necessaire mais peut servir
    /*public static function update($numero) {
        $data = Flight::request()->data;
        Compte::update($numero, $data);
        Flight::json(['message' => 'Compte modifié']);
    }

    /*public static function delete($numero) {
        Compte::delete($numero);
        Flight::json(['message' => 'Compte supprimé']);
    }*/

    public static function getByClient($id_client) {
        $compte = Compte::getByClient($id_client);
        Flight::json($compte);
    }
}
