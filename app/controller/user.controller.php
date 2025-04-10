<?php
include(dirname(__FILE__) . "/../config/config.php");
include(dirname(__FILE__) . "/../lib/database.php");
include(dirname(__FILE__) . "/../models/user.model.php");




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

    public function getUserById($userId): UserDto|null{
        return $this->userModel->getUserById($userId);
    }


    public function insertAddress($userId, $addressName, $address, $phone){
        return $this->userModel->insertAddress($userId, $addressName, $address, $phone);
    }

    public function updateUserInformation( $userDto): bool {
        return $this->userModel->updateUserInformation($userDto);
    }

    public function updatePassword($userDto){
        return $this->userModel->updatePassword($userDto);
    }
    
}



?>