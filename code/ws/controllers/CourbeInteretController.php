<?php
require_once __DIR__ . '/../models/CourbeInteret.php';
require_once __DIR__ . '/../helpers/Utils.php';



class CourbeInteretController {
    public static function getInteret() {
        $data = Flight::request()->data;
        $data->date_deb = Utils::formatDate($data->date_deb);
        $data->date_fin = Utils::formatDate($data->date_fin);
        $donnees = CourbeInteret::getInteret($data->date_deb,$data->date_fin);
        $mois = [];
        $interets = [];
        foreach ($donnees as $row) {
            $mois[] = $row['nom_mois'];
            $interets[] = (float)$row['total_interets'];
        }
        Flight::json($mois,$interets);
    }

}