<?php
require_once __DIR__ . '/../controllers/PretCaracteristiqueController.php';

Flight::route('GET /pretCaracteristique', ['PretCaracteristiqueController', 'getAll']);
Flight::route('GET /pretCaracteristique/@id', ['PretCaracteristiqueController', 'getById']);
Flight::route('POST /pretCaracteristique', ['PretCaracteristiqueController', 'create']);
//Flight::route('PUT /pretCaracteristique/@id', ['PretCaracteristiqueController', 'update']);
//Flight::route('DELETE /pretCaracteristique/@id', ['PretCaracteristiqueController', 'delete']);
