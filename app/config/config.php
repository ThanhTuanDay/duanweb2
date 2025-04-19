<?php
require_once (dirname(__DIR__)."../../vendor/autoload.php");
$dotenv = Dotenv\Dotenv::createUnsafeImmutable(__DIR__ . '/../../');
$dotenv->load();
define("DB_HOST", $_ENV['DB_HOST'] ?? "fast-food-shop-nguyenhoanghiep478-9317.j.aivencloud.com");
define("DB_USER", $_ENV['DB_USER']) ?? "avnadmin";
define("DB_PASS", $_ENV['DB_PASS']) ?? "AVNS_DJvTceg3EafMDgXGR-A";
define("DB_NAME", $_ENV['DB_NAME']) ??  "defaultdb";
define('DB_PORT', $_ENV['DB_PORT']) ?? "23769";
define('GMAIL_USERNAME',$_ENV['GMAIL_USERNAME']) ?? "";
define('GMAIL_PASSWORD',$_ENV['GMAIL_PASSWORD']) ?? "";
define('MOMO_SECRET_KEY',$_ENV['MOMO_SECRET_KEY']) ?? "";
define('MOMO_ACCESS_KEY',$_ENV['MOMO_ACCESS_KEY']) ?? "";
define('MOMO_PARTNER_CODE',$_ENV['MOMO_PARTNER_CODE']) ?? "";
define('MOMO_IPN_URL', trim(getenv('MOMO_IPN_URL'))) ?? "";
define('MOMO_REDIRECT_URL',$_ENV['MOMO_RETURN_URL']) ?? "";
define('VERIFY_URL','http://localhost/duanweb2/verify');
define('RESET_PASS_URL','http://localhost/duanweb2/resetpassword');
define('RESET_PASS_TIME_LIMIT',30*60);