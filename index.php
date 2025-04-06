<?php
require(dirname(__FILE__) . "/app/lib/session.php");
Session::init();

$page = isset($_GET['page']) ? $_GET['page'] : 'homepage';
$adminpage = isset($_GET['adminpage']) ? $_GET['adminpage'] : 'dashboard';

$clientfile = "./app/view/page/$page.php";
$adminfolder = isset($_GET['adminfolder']) && !empty($_GET['adminfolder']) ? $_GET['adminfolder'] : '';
$adminfolder = isset($_GET['adminfolder']) ? $_GET['adminfolder'] : '';
$adminpage = isset($_GET['adminpage']) ? $_GET['adminpage'] : 'dashboard';

if ($adminfolder) {
    $adminfile = "./app/view/admin/$adminfolder/$adminpage.php";
} else {
    $adminfile = "./app/view/admin/$adminpage.php";
}

// echo "Role: " . Session::get('role') . "<br>";
// echo "Admin Folder: " . ($adminfolder ?: 'Không có') . "<br>";
// echo "Admin Page: " . $adminpage . "<br>";
// echo "Admin File Path: " . $adminfile . "<br>";
if (Session::get('role') === 'admin' || Session::get('role') === 'staff' ) {
    if (isset($_GET['page'])) {
        header("Location: /duanweb2/admin/dashboard/page"); 
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
