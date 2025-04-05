<?php 
    require_once(dirname(__DIR__).'../controller/category.controller.php');
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
switch($action){
    case 'getCategories':
        $listCategories = $categoryController->getAllCategory(); 

        foreach ($listCategories as $category) {
            $response[] = [
                'id' => $category->getId(),
                'name' => $category->getName(),
                'description' => $category->getDescription(),
                'created_at' => $category->getCreatedAt(),
                'images_url'=>$category->getImage()
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

    default:

      break;
}
?>