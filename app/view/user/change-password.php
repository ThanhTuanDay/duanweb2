<?php
require_once '../../controller/user.controller.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' ) {
    $data = json_decode(file_get_contents("php://input"), true);
    $userId = $data['userId'] ?? null;
    $userController = new UserController();
    $user = $userController->getUserById($userId);
    if($user->getPassword() !== $data['currentPassword']) {
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
