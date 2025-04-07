<?php
require(dirname(__DIR__) . "/../../controller/product.controller.php");
$productController = new ProductController();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    $productController -> blockProduct($id); 

    echo "blocked";
}