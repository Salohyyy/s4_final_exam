<?php
require_once __DIR__ . '/../controllers/PretTypeController.php';

Flight::route('GET /pretType', ['PretTypeController', 'getAll']);
Flight::route('GET /pretType/@id', ['PretTypeController', 'getById']);
Flight::route('POST /pretType', ['PretTypeController', 'create']);
Flight::route('PUT /pretType/@id', ['PretTypeController', 'update']);
//Flight::route('DELETE /pretType/@id', ['PretTypeController', 'delete']);
