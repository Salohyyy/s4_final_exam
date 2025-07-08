<?php
require_once __DIR__ . '/../controllers/PretTypeController.php';
require_once __DIR__ . '/../controllers/ClientController.php';
require_once __DIR__ . '/../controllers/PretController.php';
require_once __DIR__ . '/../controllers/PretEtatController.php';
require_once __DIR__ . '/../controllers/RemboursementController.php';

Flight::route('GET /clients', ['ClientController', 'getAll']);
Flight::route('GET /pret_types', ['PretTypeController', 'getAll']);
Flight::route('POST /prets', ['PretController', 'create']);

Flight::route('POST /pret_etats/valider', ['PretEtatController', 'valider']);
Flight::route('POST /pret_etats/refuser', ['PretEtatController', 'refuser']);
Flight::route('GET /prets/non_valides', ['PretController', 'getNonValides']);

Flight::route('POST /remboursements/prets', ['RemboursementController', 'getPretsNonRembourses']);
Flight::route('POST /remboursements/details', ['RemboursementController', 'getRemboursementDetails']);
Flight::route('POST /remboursements/valider', ['RemboursementController', 'validerRemboursement']);

Flight::route('GET /remboursements/pdf', ['RemboursementController', 'exporterPDF']);
Flight::route('GET /remboursements/prets', ['RemboursementController', 'getPretsClient']);

Flight::route('GET /disponibilite', ['DisponibiliteController', 'calculerDisponibilite']);
