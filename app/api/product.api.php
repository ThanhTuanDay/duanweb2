<?php
require(dirname(__DIR__) . "../controller/product.controller.php");
require(dirname(__DIR__) . "../controller/category.controller.php");

$productController = new ProductController();
$categoryController = new CategoryController();
header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];
$action = $_REQUEST['action'] ?? null;

if (!$action) {
    echo json_encode([
        "success" => false,
        "message" => "Missing action"
    ]);
    exit();
}

switch ($action) {
    case 'getProducts':
        $page = isset($_GET['pagination']) ? (int) $_GET['pagination'] : 1;
        $perPage = isset($_GET['per_page']) ? (int) $_GET['per_page'] : 10;

        $total = $productController->countTotalProducts();
        $products = $productController->getAllProducts();
        $categories = $categoryController->getAllCategoriesWithoutMapping();

        echo json_encode([
            "success" => true,
            "products" => $products,
            "categories" => $categories,
            "totalPages" => ceil($total / $perPage)
        ]);
        break;

    case 'saveProduct':
        if ($method === 'POST') {
            $name = $_POST['productName'] ?? '';
            $categoryId = $_POST['productCategory'] ?? '';
            $price = (float) ($_POST['productPrice'] ?? 0);
            $stock = (int) ($_POST['productStock'] ?? 0);
            $description = $_POST['productDescription'] ?? '';
            $status = $_POST['productStatus'] ?? 'inactive';

            $targetPath = '';
            if (isset($_FILES['productImage']) && $_FILES['productImage']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = realpath(__DIR__ . '/../../../../public/images') . '/';
                $filename = basename($_FILES['productImage']['name']);
                $targetPath = $uploadDir . $filename;

                if (!move_uploaded_file($_FILES['productImage']['tmp_name'], $targetPath)) {
                    echo json_encode(["success" => false, "message" => "Upload ảnh thất bại"]);
                    exit();
                }
                $targetPath = '/duanweb2/public/images/' . $filename;
            }

            $id = $_POST['productId'] ?? '';
            $storeId = 'ee70a51b-0c45-11f0-ab99-6ef87da1f643';

            if ($id === '') {
                $productController->createProduct(
                    new ProductDto(null, $name, $description, $price, $categoryId, $targetPath, $stock, $storeId, $status)
                );
                echo json_encode(["success" => true, "message" => "Thêm sản phẩm thành công"]);
            } else {
                $oldImage = $_POST['oldProductImage'] ?? '';
                $result = $productController->updateProduct(
                    new ProductDto($id, $name, $description, $price, $categoryId, $targetPath ?: $oldImage, $stock, $storeId, $status)
                );
                if ($result) {
                    echo json_encode(["success" => true, "message" => "Cập nhật sản phẩm thành công"]);
                } else {
                    echo json_encode(["success" => false, "message" => "Sản phẩm đã từng bán, không thể cập nhật"]);
                }
            }
        }
        break;

    case 'blockProduct':
        if ($method === 'POST') {
            $id = $_POST['id'] ?? '';
            $result = $productController->blockProduct($id);
            echo json_encode([
                "success" => $result,
                "message" => $result ? "Đã chặn sản phẩm" : "Chặn sản phẩm thất bại"
            ]);
        }
        break;

    case 'deleteProduct':
        if ($method === 'POST') {
            $id = $_POST['id'] ?? '';
            if ($productController->isProductSold($id)) {
                echo json_encode(["success" => false, "message" => "Sản phẩm đã bán, không thể xoá"]);
            } else {
                $productController->deleteProduct($id);
                echo json_encode(["success" => true, "message" => "Đã xoá sản phẩm"]);
            }
        }
        break;
    case 'openProduct':
        if ($method === 'POST') {
            $id = $_POST['id'] ?? '';
            $result = $productController->openProduct($id);
            echo json_encode([
                "success" => $result,
                "message" =>  "Đã mở sản phẩm",
            ]);
        }
        break;   
    case 'getStats':
        $id = $_POST['id'] ?? null;
        $stats = $productController->getProductStats($id); 
        echo json_encode(['success' => true, 'data' => $stats]);
        break;
    case 'getMonthlySales':
        $id = $_GET['id'] ?? '';
        $data = $productController->getMonthlySalesByProduct($id);
        echo json_encode(["success" => true, "data" => $data]);
        break;
    default:
        echo json_encode(["success" => false, "message" => "Unknown action"]);
        break;
}
