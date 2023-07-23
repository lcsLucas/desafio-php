<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Ex2\Controller\GitHubController;

$controller = new GitHubController();

$controller->index();