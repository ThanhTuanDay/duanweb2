<?php
require_once(dirname(__DIR__) . '../controller/category.controller.php');
$categoryController = new CategoryController();

?>
<?php
if (($_SERVER["REQUEST_METHOD"] === "GET" && !isset($_GET['action'])) || ($_SERVER["REQUEST_METHOD"] === "POST" && !isset($_POST['action']))) {
    $response = array(
        "success" => false,
        "message" => 'Invalid request method'
    );
    echo json_encode($response);
    exit();
}
?>

<?php
$action = isset($_GET['action']) ? $_GET['action'] : $_POST["action"];
switch ($action) {
    case 'getCategories':
        $listCategories = $categoryController->getAllCategory();

        foreach ($listCategories as $category) {
            $response[] = [
                'id' => $category->getId(),
                'name' => $category->getName(),
                'description' => $category->getDescription(),
                'created_at' => $category->getCreatedAt(),
                'images_url' => $category->getImage()
            ];
        }

        header('Content-Type: application/json');

        echo json_encode($response);

        break;
    case 'getPaginatedCategories':
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = isset($_GET['perPage']) ? (int)$_GET['perPage'] : 10;

        $paginationData = $categoryController->getPaginatedCategories($page, $perPage);
        $categories = $paginationData['categories'];
        $totalItems = $paginationData['totalItems'];

        $response = [
            'success' => true,
            'data' => $categories,
            'totalItems' => $totalItems
        ];
        header('Content-Type: application/json');

        echo json_encode($response);
        break;
    case 'updateCategory':
        // $categoryData = $_POST['formData'];
        // $data = [
        //     'id' => $categoryData['id'],
        //     'name' => $categoryData['name'],
        //     'description' => $categoryData['description'],
        //     'status' => $categoryData['status'],
        // ];

        if (!isset($_FILES['image'])) {
            $response[] = [
                'success' => false,
                'message' => 'UpdateCategory fail!'

            ];
        }
        $image = $_FILES['image'];
        $uploadDir = __DIR__ . '/../../public/images/categories/';
        
        file_put_contents(__DIR__ . '/category-api.txt', json_encode($uploadDir), FILE_APPEND);
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true); // tạo folder nếu chưa tồn tại
        }
        
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $rawName = $_POST['name'] ?? 'image';
        $safeName = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', iconv('UTF-8', 'ASCII//TRANSLIT', $rawName))));
        $filename = $safeName . '.' . $ext;
        $targetPath = $uploadDir . $filename;
        move_uploaded_file($_FILES['image']['tmp_name'], $targetPath);
        $targetPath = '/duanweb2/public/images/categories/' . $filename;
        $categoryDto = new CategoryDto(
            $_POST['id'],
            $_POST['name'],
            $_POST['description'],
            $_POST['status'],
            $targetPath
        );

        

        $updateCategoryItem= $categoryController->updateCategory($categoryDto);
        $response=[];
        if($updateCategoryItem){
            $response[]=[
                'success'=>$updateCategoryItem,
                'message'=>'UpdateCategory success'
            ];
        } else {
            $response[] = [
                'success' => false,
                'message' => 'CreateCategory fail!'

            ];
        }
        header('Content-Type: application/json');

        echo json_encode($response);

        break;
    default:

        break;
}
?>