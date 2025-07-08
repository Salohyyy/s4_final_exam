<?php
require_once __DIR__ . '/../controllers/CourbeInteretController.php';

Flight::route('POST /courbe', ['CourbeInteretController', 'getInteret']);