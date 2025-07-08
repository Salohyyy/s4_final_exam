<?php
require 'vendor/autoload.php';
require 'db.php';
require 'routes/contributeur_routes.php';
require 'routes/compteMouvement_routes.php';
require 'routes/compteTypeMouvement_routes.php';
require 'routes/compte_routes.php';
require 'routes/pretType_routes.php';
require 'routes/pretCaracteristique_routes.php';
require 'routes/fond_routes.php';
require 'routes/routes.php';
require 'routes/courbeInteret_routes.php';

Flight::start();