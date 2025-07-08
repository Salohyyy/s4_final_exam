<?php
require_once __DIR__ . '/../controllers/CompteTypeMouvementController.php';

Flight::route('GET /compteTypeMouvement', ['CompteTypeMouvementController', 'getAll']);
Flight::route('GET /compteTypeMouvement/description/@description', ['CompteTypeMouvementController', 'getByDescription']);
Flight::route('GET /compteTypeMouvement/id/@id', ['CompteTypeMouvementController', 'getById']);
Flight::route('GET /compteTypeMouvement/entree/institutionnelle/@boolean', ['CompteTypeMouvementController', 'getByEntree']);
Flight::route('POST /compteTypeMouvement', ['CompteTypeMouvementController', 'create']);
//Flight::route('PUT /compteTypeMouvement/@id', ['CompteTypeMouvementController', 'update']);
//Flight::route('DELETE /compteTypeMouvement/@id', ['CompteTypeMouvementController', 'delete']);
