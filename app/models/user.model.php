<?php
require_once(dirname(__DIR__) . "../dto/user.dto.php");
require_once __DIR__ . '/../helper/message-sender.php';
require_once(dirname(__DIR__) . "../lib/staticRole.php");
class UserModel
{

    private $db;
    private $conn;
    private $messageSender;
    public function __construct($db)
    {
        $this->db = $db;
        $this->conn = $db->getConnection();
        $this->messageSender = new GmailSender();
    }
    public function LoginUser(UserDto $user)
    {
        $sql = "SELECT * FROM users WHERE email = ? AND password = ? AND is_verified = 1 LIMIT 1";
        $stmt = $this->db->link->prepare($sql);

        $email = $user->getEmail();
        $password = $user->getPassword();

        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            echo "<script>alert('Tài khoản không tồn tại hoặc chưa xác thực');</script>";
            return null;
        }
    }
    public function getAllUsers(): mixed
    {
        $sql = "SELECT * FROM users";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
        // $users = [];
        // while ($row = $result->fetch_assoc()) {
        //     $users[] = new UserDto(
        //         $row['id'],
        //         $row['name'],
        //         $row['email'],
        //         $row['phone'],
        //         role: $row['role'],
        //         created_at: $row['created_at'],
        //         isBlocked: (bool) $row['is_block'],
        //     );
        // }

        // return $users;
    }
    
    public function getDeliveryAddressesById($userId)
    {
        $sql = "SELECT * FROM user_addresses WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        $addresses = [];
        while ($row = $result->fetch_assoc()) {
            $addresses[] = $row;
        }

        return $addresses;
    }

    public function insertAddress($userId, $addressName, $address, $phone)
    {
        $id = uniqid();
        $sql = "INSERT INTO user_addresses (id, user_id, address_name, address, phone) 
            VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssss", $id, $userId, $addressName, $address, $phone);

        if ($stmt->execute()) {
            return $id;
        }

        return false;
    }

    public function checkEmailExists($email)
    {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->num_rows > 0;
    }

    public function checkPhoneExist($phone)
    {
        $sql = "SELECT * FROM users WHERE phone = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $phone);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->num_rows > 0;
    }
    public function countCustomers(): int
    {
        $sql = "SELECT COUNT(*) as total FROM users WHERE role = ?";
        $stmt = $this->conn->prepare($sql);
        $role = AppRole::ROLE_USER;
        $stmt->bind_param("s", $role);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['total'] ?? 0;
    }

    public function registerUser($userDto)
    {
        $sql = "INSERT INTO users ( name, email, phone, address, password, role,verify_token,is_verified) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $token = $this->messageSender->generateToken();
        $name = $userDto->getName();
        $email = $userDto->getEmail();
        $phone = $userDto->getPhone();
        $address = $userDto->getAddress();
        $password = $userDto->getPassword();
        $role = $userDto->getRole() == null ? $userDto::ROLE_USER : $userDto->getRole();
        $is_verified = 0;


        $stmt->bind_param(
            "ssssssss",
            $name,
            $email,
            $phone,
            $address,
            $password,
            $role,
            $token,
            $is_verified
        );
        $result = $stmt->execute();

        if ($result->num_rows > 0) {
            return false;
        }

        $stmt->close();

        $userDto->setVerifyToken($token);

        $this->sendVerifyEmail($userDto);
        return $result;
    }


    public function sendVerifyEmail($userDto)
    {
        $email = $userDto->getEmail();
        $token = $userDto->getVerifyToken();
        $name = $userDto->getName();
        $subject = "Xác thực tài khoản";
        $url = VERIFY_URL . "?email=$email&token=" . $token;
        $template = $this->messageSender->getVerifyTemplate($name, $url);
        $this->messageSender->send($email, $subject, $template);
    }

    public function verifyUser($email, $token)
    {
        $sql = "SELECT * FROM users WHERE email = ? AND verify_token = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $email, $token);
        $stmt->execute();
        $result = $stmt->get_result();

        if (!$result->num_rows > 0) {
            return false;
        }
        return $this->updateUserVerified($email, null);
    }

    public function updateUserVerified($email, $token = NULL)
    {
        $update = "UPDATE users SET is_verified = 1, verify_token = ? WHERE email = ?";
        $stmt = $this->conn->prepare($update);
        $stmt->bind_param("ss", $token, $email);
        return $stmt->execute();
    }


    public function sendForgotPasswordRequest($email)
    {
        $user = $this->getUserByEmailAndIsVerified($email);
        if (!$user) {
            return false;
        }
        $token = time();
        $this->updateUserVerified($email, $token);
        $subject = "Thay đổi mật khẩu";
        $verifyUrl = RESET_PASS_URL . '?email=' . $email . '&token=' . $token;
        $template = $this->messageSender->getVerifyTemplate($user->getName(), $verifyUrl);
        $this->messageSender->send($email, $subject, $template);

        return true;
    }

    public function resetPassword($email, $token, $newPassword)
    {

        $user = $this->getUserByEmailAndIsVerified($email);
        if ($user == null) {
            return false;
        }

        $user->setPassword($newPassword);
        return $this->updateUser($user);
    }

    public function updatePassword($userDto)
    {
        $sql = "UPDATE users SET password = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $password = $userDto->getPassword();
        $id = $userDto->getId();

        $stmt->bind_param("ss", $password, $id);
        return $stmt->execute();
    }

    public function isRemainingTimeReset($token)
    {
        $token_time = (int) $token;
        $remaining_time = time() - $token_time;
        if ($remaining_time > RESET_PASS_TIME_LIMIT) {
            return false;
        }
        return true;
    }

    public function updateUserInformation($userDto){
        $sql = "UPDATE users SET 
            name = ?, 
            phone = ?, 
            address = ?
        WHERE id = ? ";

        $stmt = $this->conn->prepare($sql);

        $name = $userDto->getName();
        $phone = $userDto->getPhone();
        $address = $userDto->getAddress();
        $id = $userDto->getId();
        $stmt->bind_param(
            "ssss",
            $name,
            $phone,
            $address,
            $id
        );

        return $stmt->execute();
    }

    
    public function updateUser($userDto)
    {

        $sql = "UPDATE users SET 
            name = ?, 
            phone = ?, 
            address = ?, 
            password = ?, 
            role = ?, 
            verify_token = NULL
        WHERE email = ? ";

        $stmt = $this->conn->prepare($sql);

        $name = $userDto->getName();
        $phone = $userDto->getPhone();
        $address = $userDto->getAddress();
        $password = $userDto->getPassword();
        $role = $userDto->getRole();
        $email = $userDto->getEmail();

        $stmt->bind_param(
            "ssssss",
            $name,
            $phone,
            $address,
            $password,
            $role,
            $email
        );

        $result = $stmt->execute();
        if (!$result) {
            die("SQL Error: " . $stmt->error);
        }
        $stmt->close();

        return $result;
    }

    public function getUserById($id): UserDto|null
    {
        $query = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $data = $result->fetch_assoc();
            return new UserDto(
                null,
                $data['name'],
                $data['email'],
                $data['phone'],
                $data['address'],
                $data['password'],
                null,
                null,
                null,
               null,
            );
        } else {
            return null;
        }
    }

    public function getUserByEmailAndIsVerified($email)
    {
        $query = "SELECT * FROM users WHERE email = ? AND is_verified = ?";
        $stmt = $this->conn->prepare($query);
        $isVerified = 1;
        $stmt->bind_param(
            "ss",
            $email,
            $isVerified
        );
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $data = $result->fetch_assoc();
            $stmt->close();
            return new UserDto(
                null,
                $data['name'],
                $data['email'],
                $data['phone'],
                $data['address'],
                $data['password'],
                $data['role'],
                $data['created_at'],
                $data['verify_token'],
                (bool) $data['is_verified']
            );
        } else {
            $stmt->close();
            return null;
        }
    }
}

?>