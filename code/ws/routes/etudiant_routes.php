<?php
// require_once __DIR__ . '/../controllers/EtudiantController.php';
// 
// Flight::route('GET /etudiants', ['EtudiantController', 'getAll']);
// Flight::route('GET /etudiants/@id', ['EtudiantController', 'getById']);
// Flight::route('POST /etudiants', ['EtudiantController', 'create']);
// Flight::route('PUT /etudiants/@id', ['EtudiantController', 'update']);
// Flight::route('DELETE /etudiants/@id', ['EtudiantController', 'delete']);

require_once __DIR__ . '/../controllers/ClientController.php';
require_once __DIR__ . '/../controllers/CompteClientController.php';
require_once __DIR__ . '/../controllers/CompteTypeMouvementController.php';

Flight::route('GET /clients', ['ClientController', 'getAll']);

Flight::route('GET /comptes-client', function () {
    $idClient = Flight::request()->query['id_client'];
    CompteClientController::getByClient($idClient);
});

Flight::route('GET /compte_type_mouvement', ['CompteTypeMouvementController', 'getByEntree']);

Flight::route('POST /compte_mouvements', ['CompteMouvementController', 'create']);  
