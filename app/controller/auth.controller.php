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
        $this->db = new Database();
        $this->userModel = new UserModel($this->db);

    }
    public function loginUser($email, $password)
    {
        $user = new UserDto(null, null, $email, null, null, $password, null);
        return $this->userModel->LoginUser($user);
    }

    public function isEmailExists($email)
    {
        return $this->userModel->checkEmailExists($email);
    }


    public function isPhoneExist($phone){
        return $this->userModel->checkPhoneExist($phone);
    }
    public function registerUser($email, $password, $password2, $name, $phone = null, $address = null)
    {
        if ($password !== $password2) {
            return "Mật khẩu xác nhận không khớp!";
        }

        if ($this->userModel->checkEmailExists($email)) {
            return "Email đã tồn tại, vui lòng dùng email khác!";
        }
        $user = new UserDto(
            null,
            $name,
            $email,
            $phone,
            $address,
            $password,
            'customer'
        );

        $result = $this->userModel->registerUser($user);

        if ($result) {
            return true;
        } else {
            return "Đăng ký thất bại! Vui lòng thử lại.";
        }

    }


    public function verifyUser($email, $token)
    {
        return $this->userModel->verifyUser($email, $token);
    }

    public function sendForgotPasswordRequest($email)
    {
        return $this->userModel->sendForgotPasswordRequest($email);
    }


    public function resetPassword($email, $token, $newPassword)
    {
       
        if (!$this->userModel->isRemainingTimeReset($token)) {
            return 'Liên kết đã hết hạn, vui lòng thử lại';
        }
      
        $result = $this->userModel->resetPassword($email, $token, $newPassword);
        if (!$result) {
            return 'Có lỗi hệ thống, vui lòng thử lại sau';
        }

        return $result;
    }
}

?>