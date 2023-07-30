<?php

require_once __DIR__ . '/../index.php';

use Ex1\Controller\AuthController;

$controller = new AuthController();

if (filter_has_var(INPUT_POST, 'signup')) {
    $controller->signup();
} else if (filter_has_var(INPUT_POST, 'login')) {
    $controller->login();
} else if (filter_has_var(INPUT_POST, 'logout')) {
    session_destroy();
    header("Refresh:0");
}

if (!empty($_SESSION['logged']))
    $controller->welcome();
else
    $controller->index();