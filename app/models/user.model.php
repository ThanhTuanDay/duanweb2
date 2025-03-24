<!-- 
XỬ LÝ BUSINESS CALL TRUY VẤN Ở ĐÂY 
-->
<?php 
require_once(dirname(__DIR__)."../dto/user.dto.php");

class UserModel{
   
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }
    public function LoginUser(UserDto $user)
    {
        $email = mysqli_real_escape_string($this->db->link, $user->getEmail());
        $password = mysqli_real_escape_string($this->db->link, $user->getPassword());
        $query = "SELECT * from users WHERE email = '$email' and password = '$password' LIMIT 1";
        $data= $this->db->select($query);
        if(!$data){
            echo"<script>alert('tài khoản này không đăng nhập được')</script>" ;
        }
        else {
            $result = $data->fetch_assoc();
            return $result;
        }
    }
}

?>