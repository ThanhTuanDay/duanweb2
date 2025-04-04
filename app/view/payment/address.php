<?php
require(dirname(__DIR__) . "../../controller/user.controller.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    if ($data['action'] === 'insert_address') {
        $userId = $data['userId'];
        $addressName = $data['addressName'];
        $address = $data['address'];
        $phone = $data['phone'];

        $userController = new UserController();
        $insertedId = $userController->insertAddress($userId, $addressName, $address, $phone);

        if ($insertedId) {
            echo json_encode([
                'success' => true,
                'addressId' => $insertedId
            ]);
        } else {
            echo json_encode(['success' => false]);
        }

        exit;
    }
}


?>