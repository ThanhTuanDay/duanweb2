<?php

$page = isset($_GET['page']) ? $_GET['page'] : 'homepage';

$file = "./app/view/page/$page.php";

if (file_exists($file)) {
    $content = $file; 
    include "./app/view/layout/layout.php";
} else {
    include  "./app/view/page/404.php"; 
}

