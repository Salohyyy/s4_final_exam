<?php
require_once __DIR__ . '/../controllers/PretTypeController.php';
require_once __DIR__ . '/../controllers/ClientController.php';
require_once __DIR__ . '/../controllers/PretController.php';

Flight::route('GET /clients', ['ClientController', 'getAll']);
Flight::route('GET /pret_types', ['PretTypeController', 'getAll']);
Flight::route('POST /prets', ['PretController', 'create']);