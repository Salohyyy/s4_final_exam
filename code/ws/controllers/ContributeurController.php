<?php
require_once __DIR__ . '/../models/Contributeur.php';
require_once __DIR__ . '/../helpers/Utils.php';



class ContributeurController {
    public static function getAll() {
        $contributeurs = Contributeur::getAll();
        Flight::json($contributeurs);
    }

    public static function getContributeurInstitutionelle() {
        $contributeurs = Contributeur::getAll();
        unset($contributeurs[0]);
        $contributeurs = array_values($contributeurs);
        Flight::json($contributeurs);
    }

    public static function getById($id) {
        $contributeur = Contributeur::getById($id);
        Flight::json($contributeur);
    }

    public static function getByLibelle($libelle) {
        $contributeur = Contributeur::getByLibelle($libelle);
        Flight::json($contributeur);
    }

    public static function create() {
        $data = Flight::request()->data;
        $libelle = Contributeur::create($data);
        $dateFormatted = Utils::formatDate('2025-01-01');
        Flight::json(['message' => 'Contributeur ajouté', 'libelle' => $libelle]);
    }

    //pas necessaire mais peut servir
    /*public static function update($libelle) {
        $data = Flight::request()->data;
        Contributeur::update($libelle, $data);
        Flight::json(['message' => 'Contributeur modifié']);
    }

    /*public static function delete($libelle) {
        Contributeur::delete($libelle);
        Flight::json(['message' => 'Contributeur supprimé']);
    }*/
}
