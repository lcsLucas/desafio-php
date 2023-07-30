<?php

require_once __DIR__ . '/../index.php';

define("DIR", "exercicio-3");

use Ex3\Controller\ETLController;

$controller = new ETLController();

$controller->index();