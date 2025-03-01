<?php
/*protocal type http or https*/
define('PROTOCAL', 'http');
/*root and asset paths*/

$path = str_replace("\\", "/", PROTOCAL . "://" . $_SERVER['SERVER_NAME'] . __DIR__ . "/");
$path = str_replace($_SERVER['DOCUMENT_ROOT'], "", $path);
define('ASSETS', str_replace("server/core", "client/", $path));