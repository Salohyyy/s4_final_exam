<?php
require_once __DIR__ . '/../models/Fond.php';
require_once __DIR__ . '/../helpers/Utils.php';



class FondController {
    public static function getAll() {
        $fond = Fond::getAll();
        Flight::json($fond);
    }

}