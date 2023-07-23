<?php

require_once __DIR__ . '/../index.php';

use Ex2\Controller\GitHubController;

$controller = new GitHubController();

$controller->index();