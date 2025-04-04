<?php
include(dirname(__FILE__) . "/../config/config.php");
include(dirname(__FILE__) . "/../lib/database.php");
include(dirname(__FILE__) . "/../models/user.model.php");
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



class UserController {
    private $db;
    private $userModel;
    public function __construct()
    {
        $this->db = new Database();
        $this->userModel = new UserModel($this->db);
    }
    public function getDeliveryAddress(){
        return $this->userModel->getDeliveryAddressesById($_SESSION['user_id']);
    }


    public function insertAddress($userId, $addressName, $address, $phone){
        return $this->userModel->insertAddress($userId, $addressName, $address, $phone);
    }
    
}



?>