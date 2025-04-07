<?php 
    require_once(dirname(__DIR__).'../controller/user.controller.php');
    $userController = new UserController();
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
    case 'getDeliveryAddress':
        $listAddress = $userController->getDeliveryAddress(); 
        foreach ($listAddress as $address) {
            $response[] = [
                'id' => $address->getId(),
                'name' => $address->getName(),
                'address' => $address->getAddress(),
                'phone' => $address->getPhone(),
                'created_at' => $address->getCreatedAt()
            ];
        }
        header('Content-Type: application/json');
        echo json_encode($response);
        break;
    case 'getAllUsers':
        $listUsers = $userController->getAllUsers(); 
        foreach ($listUsers as $user) {
            $response[] = [
                'id' => $user->getId(),
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'phone' => $user->getPhone(),
                'role' => $user->getRole(),
                'created_at' => $user->getCreatedAt(),
                'is_block' => $user->isBlocked(),
            ];
        }
        header('Content-Type: application/json');
        echo json_encode($response);
        break;
    default:
      break;
}
?>