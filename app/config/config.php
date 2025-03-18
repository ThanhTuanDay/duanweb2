<?php
require_once (dirname(__DIR__)."../../vendor/autoload.php");

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__) . '/app/config', '.env');
$dotenv->safeLoad(); 
// define("DB_HOST", $_ENV['DB_HOST']);
// define("DB_USER", $_ENV['DB_USER']);
// define("DB_PASS", $_ENV['DB_PASS']);
// define("DB_NAME", $_ENV['DB_NAME']);
// define('DB_PORT', $_ENV['DB_PORT']);
// define('GMAIL_USERNAME',$_ENV['GMAIL_USERNAME']);
// define('GMAIL_PASSWORD',$_ENV['GMAIL_PASSWORD']);