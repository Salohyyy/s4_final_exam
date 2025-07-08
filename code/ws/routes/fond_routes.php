<?php
require_once __DIR__ . '/../controllers/FondController.php';

Flight::route('GET /fond/stats', ['FondController', 'getAll']);