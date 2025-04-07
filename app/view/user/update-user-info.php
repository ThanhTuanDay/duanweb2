<?php 
require(dirname(__DIR__) . "../../controller/user.controller.php");
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' ) {
    $data = json_decode(file_get_contents("php://input"), true);
    
    $userDto = new UserDto(
        $data['userId'],
        $data['firstName'] . ' ' . $data['lastName'],
        $data['email'],
        $data['phone'],
        $data['address']  
    );

    $userController = new UserController();
    $success = $userController->updateUserInformation( $userDto);

    echo json_encode(['success' => $success]);
    exit;
}else {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request or not logged in'
    ]);
    exit;
}

?>