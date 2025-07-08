<?php
require_once __DIR__ . '/../controllers/ContributeurController.php';

Flight::route('GET /contributeur', ['ContributeurController', 'getAll']);
Flight::route('GET /contributeur/institutionelle', ['ContributeurController', 'getContributeurInstitutionelle']);
Flight::route('GET /contributeur/id/@id', ['ContributeurController', 'getById']);
Flight::route('GET /contributeur/libelle/@libelle', ['ContributeurController', 'getByLibelle']);
Flight::route('POST /contributeur', ['ContributeurController', 'create']);
//Flight::route('PUT /contributeur/@id', ['ContributeurController', 'update']);
//Flight::route('DELETE /contributeur/@id', ['CompteController', 'delete']);
