<?php
require_once __DIR__ . '/../models/CompteMouvement.php';
require_once __DIR__ . '/../helpers/Utils.php';



class CompteMouvementController {
    public static function getAll() {
        $compteMouvements = CompteMouvement::getAll();
        Flight::json($compteMouvements);
    }

    public static function getByCompte($id_compte) {
        $compteMouvement = CompteMouvement::getByCompte($id_compte);
        Flight::json($compteMouvement);
    }

    public static function create() {
        $data = Flight::request()->data;
        //$data->date_mouvement = Utils::formatDate($data->date_mouvement);
        $id_compte = CompteMouvement::create($data);
        Flight::json(['message' => 'CompteMouvement ajouté', 'id_compte' => $id_compte]);
    }

    //pas necessaire mais peut servir
    /*public static function update($id_compte) {
        $data = Flight::request()->data;
        CompteMouvement::update($id_compte, $data);
        Flight::json(['message' => 'CompteMouvement modifié']);
    }

    /*public static function delete($id_compte) {
        CompteMouvement::delete($id_compte);
        Flight::json(['message' => 'CompteMouvement supprimé']);
    }*/
}
