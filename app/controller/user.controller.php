<?php
include(dirname(__FILE__) . "../config/config.php");
// include_once(dirname(__FILE__) . "../../helpers/format.php");
include(dirname(__FILE__) . "../lib/database.php");
include(dirname(__FILE__) . "../models/user.model.php");
class UserController {
    private $db;
    private $userModel;
    public function __construct()
    {
        $this->db = new Database();
        $this->userModel = new UserModel($this->db);
    }
}



?>