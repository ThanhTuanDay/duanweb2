<?php 
require(dirname(__DIR__) . "../../controller/user.controller.php");
$userId = $_SESSION['user_id'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $userId) {
    $data = json_decode(file_get_contents("php://input"), true);
    
    $userDto = new UserDto(
        $userId,
        $data['firstName'] . ' ' . $data['lastName'],
        null,
        $data['phone'],
        $data['address']  
    );

    $userController = new UserController();
    $success = $userController->updateUserInformation( $userDto);

    echo json_encode(['success' => $success]);
    exit;
}

?>