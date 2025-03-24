<?php
require(dirname(__File__) . "./app/lib/session.php");
Session::init();
$page = isset($_GET['page']) ? $_GET['page'] : 'homepage';

$file = "./app/view/page/$page.php";

$data=Session::get('name');

if (file_exists($file)) {
    $content = $file; 
    include "./app/view/layout/layout.php";
} else {
    include  "./app/view/page/404.php"; 
}

