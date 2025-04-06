<?php
require_once '../../controller/user.controller.php';


$userId = $_SESSION['user_id'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $userId) {
    $data = json_decode(file_get_contents("php://input"), true);

    $userController = new UserController();
    $user = $userController->getUserById($userId);
    if($user->getPassword() !== $data['oldPassword']){
        echo json_encode(['success' => false, 'message' => 'Mật khẩu cũ không đúng']);
        exit;
    }
    $userDto = new UserDto(
        $userId,
        null,
        null,
        null,
        null,
        $data['newPassword'] ?? null,
    );
    $success = $userController->updatePassword($userDto);

    echo json_encode(['success' => $success]);
    exit;
}
?>
