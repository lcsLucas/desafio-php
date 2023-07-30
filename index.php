<?php
/**
 * Autoload do Composer
 */

 session_start();

require_once __DIR__ . '/vendor/autoload.php';

define("ABSPATH", __DIR__);

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();