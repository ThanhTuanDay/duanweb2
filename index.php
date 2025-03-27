<?php
require(dirname(__FILE__) . "/app/lib/session.php");
Session::init();

$page = isset($_GET['page']) ? $_GET['page'] : 'homepage';
$adminpage = isset($_GET['adminpage']) ? $_GET['adminpage'] : 'dashboard';

$clientfile = "./app/view/page/$page.php";
$adminfile = "./app/view/admin/$adminpage.php";

if (Session::get('role') === 'admin' || Session::get('role') === 'staff' ) {
    if (isset($_GET['page'])) {
        header("Location: /duanweb2/admin/dashboard"); 
        exit();
    }

    if (file_exists($adminfile)) {
        $content = $adminfile;
        include "./app/view/layout/layout-admin.php";
        exit();
    } else {
        include "./app/view/page/404.php"; 
        exit();
    }
}

if (Session::get('role') !== 'admin') {
    if (isset($_GET['adminpage'])) {
        header("Location: /duanweb2/403"); 
        exit();
    }

    if (file_exists($clientfile)) {
        $content = $clientfile;
        include "./app/view/layout/layout.php";
        exit();
    } else {
        include "./app/view/page/404.php"; 
    }
}
else{
    include "./app/view/page/404.php";
    exit();
}
