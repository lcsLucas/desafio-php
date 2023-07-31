<?php

require_once __DIR__ . '/../index.php';

define("DIR", "exercicio-4");

use Ex4\Controller\GatewayController;

$controller = new GatewayController();

if (filter_has_var(INPUT_POST, 'type')) {
    $controller->processPayment();
} else {
    $controller->index();
}