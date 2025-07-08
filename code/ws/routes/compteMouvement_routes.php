<?php
require_once __DIR__ . '/../controllers/CompteMouvementController.php';

Flight::route('GET /compteMouvement', ['CompteMouvementController', 'getAll']);
Flight::route('GET /compteMouvement/@id_compte', ['CompteMouvementController', 'getByCompte']);
Flight::route('POST /compteMouvement', ['CompteMouvementController', 'create']);
Flight::route('GET /invest', ['CompteMouvementController', 'getInvestissement']);
//Flight::route('PUT /compteMouvement/@id', ['CompteMouvementController', 'update']);
//Flight::route('DELETE /compteMouvement/@id', ['CompteController', 'delete']);
