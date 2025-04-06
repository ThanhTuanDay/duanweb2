<?php
require_once (dirname(__DIR__)."../../vendor/autoload.php");
$dotenv = Dotenv\Dotenv::createUnsafeImmutable(__DIR__ . '/../../');
$dotenv->safeLoad();
define("DB_HOST", $_ENV['DB_HOST']);
define("DB_USER", $_ENV['DB_USER']);
define("DB_PASS", $_ENV['DB_PASS']);
define("DB_NAME", $_ENV['DB_NAME']);
define('DB_PORT', $_ENV['DB_PORT']);
define('GMAIL_USERNAME',$_ENV['GMAIL_USERNAME']);
define('GMAIL_PASSWORD',$_ENV['GMAIL_PASSWORD']);
define('MOMO_SECRET_KEY',$_ENV['MOMO_SECRET_KEY']);
define('MOMO_ACCESS_KEY',$_ENV['MOMO_ACCESS_KEY']);
define('MOMO_PARTNER_CODE',$_ENV['MOMO_PARTNER_CODE']);
define('MOMO_IPN_URL', trim(getenv('MOMO_IPN_URL')));
define('MOMO_REDIRECT_URL',$_ENV['MOMO_RETURN_URL']);
define('VERIFY_URL','http://localhost/duanweb2/verify');
define('RESET_PASS_URL','http://localhost/duanweb2/resetpassword');
define('RESET_PASS_TIME_LIMIT',30*60);