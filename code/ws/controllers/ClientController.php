<?php
require_once __DIR__ . '/../models/Client.php';

class ClientController {
    public static function getAll() {
        Flight::json(Client::getAll());
    }
}
