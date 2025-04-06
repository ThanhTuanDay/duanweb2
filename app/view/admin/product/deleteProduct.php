
<?php 
require(dirname(__DIR__) . "/../../controller/product.controller.php");
$productController = new ProductController();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    if ($productController->isProductSold($id)) {
        http_response_code(200);
        echo "sold";
    } else {
        $productController-> deleteProduct($id);
        echo "deleted";
    }
}
?>