<?php
require_once(dirname(__DIR__) . "../config/config.php");
require_once(dirname(__DIR__) . "../models/user.model.php");
require_once(dirname(__DIR__) . "../lib/database.php");
require_once(dirname(__DIR__) . '../dto/user.dto.php');
?>
<?php

class AuthController
{
    private $db;
    private $userModel;
    public function __construct()
    {
        $this->db =  new Database();
        $this->userModel = new UserModel($this->db);

    }
    public function loginUser($email,$password){
          $user = new UserDto(null,null,$email,null, null, $password,null);
            return $this->userModel->LoginUser($user);
    }
}

?>