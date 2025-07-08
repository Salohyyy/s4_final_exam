<?php
require_once __DIR__ . '/../models/PretType.php';

class PretTypeController {
    public static function getAll() {
        $db = Flight::get('db');
        Flight::json(PretType::getAll());
    }
}
