<?php
require_once __DIR__ . '/../controllers/CompteController.php';

Flight::route('GET /compte', ['CompteController', 'getAll']);
Flight::route('GET /compte/numero/@id', ['CompteController', 'getByNumero']);
Flight::route('GET /compte/typecompte/institutionnelle', ['CompteController', 'getCompteInstitutionnelle']);
Flight::route('POST /compte', ['CompteController', 'create']);
//Flight::route('PUT /compte/@id', ['CompteController', 'update']);
//Flight::route('DELETE /compte/@id', ['CompteController', 'delete']);
