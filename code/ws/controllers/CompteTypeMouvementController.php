<?php
require_once __DIR__ . '/../models/CompteTypeMouvement.php';
require_once __DIR__ . '/../helpers/Utils.php'; // si besoin d’utilitaires

class CompteTypeMouvementController {
    public static function getByEntree() {
        $entree = Flight::request()->query['entree'];

        if (!isset($entree)) {
            Flight::json(['error' => 'Paramètre "entree" manquant.'], 400);
            return;
        }

        // Convertir en booléen
        $entreeBool = ($entree == '1' || strtolower($entree) === 'true') ? true : false;

        $type = CompteTypeMouvement::getByEntree($entreeBool);

        if ($type) {
            Flight::json($type);
        } else {
            Flight::json(['error' => 'Type de mouvement non trouvé.'], 404);
        }
    }
}
