<?php
require_once __DIR__ . '/../models/CompteMouvement.php';
require_once __DIR__ . '/../helpers/Utils.php';

class CompteMouvementController {
    public static function getAll() {
        $mouvements = CompteMouvement::getAll();
        Flight::json($mouvements);
    }

    public static function getById($id) {
        $mouvement = CompteMouvement::getById($id);
        if ($mouvement) {
            Flight::json($mouvement);
        } else {
            Flight::halt(404, "Mouvement non trouvé.");
        }
    }

    public static function getByCompte($idCompte) {
        $mouvements = CompteMouvement::getByCompte($idCompte);
        Flight::json($mouvements);
    }

    public static function create() {
        $idType = $_POST['id_compte_type_mouvement'] ?? null;
        $idCompte = $_POST['id_compte'] ?? null;
        $idContributeur = $_POST['id_contributeur'] ?? null;
        $date = $_POST['date_mouvement'] ?? null;
        $montant = $_POST['montant'] ?? null;
    
        // Vérifie si tous les champs sont présents
        if (!$idType || !$idCompte || !$idContributeur || !$date || !$montant) {
            Flight::json(["error" => "Champs manquants."], 400);
            return;
        }
    
        // Appel du modèle avec les données groupées en objet (facultatif)
        $data = (object)[
            'id_compte_type_mouvement' => $idType,
            'id_compte' => $idCompte,
            'id_contributeur' => $idContributeur,
            'date_mouvement' => $date,
            'montant' => $montant
        ];
    
        $id = CompteMouvement::create($data);
    
        Flight::json(["message" => "Mouvement inséré avec succès ✅", "id" => $id]);
    }


    public static function update($id) {
        $data = Utils::getBodyAsJson();
        CompteMouvement::update($id, $data);
        Flight::json(["message" => "Mouvement mis à jour"]);
    }

    public static function delete($id) {
        CompteMouvement::delete($id);
        Flight::json(["message" => "Mouvement supprimé"]);
    }
}
