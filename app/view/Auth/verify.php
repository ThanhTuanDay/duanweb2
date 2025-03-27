<?php
require(dirname(__DIR__) . "../../controller/auth.controller.php");

if (!isset($_GET['email']) || !isset($_GET['token'])) {
    die("Thiếu thông tin xác thực.");
}
$authController = new AuthController();
$email = $_GET['email'];
$token = $_GET['token'];

$result = $authController->verifyUser($email, $token);
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Xác thực tài khoản</title>
</head>

<body>
    <?php if ($result): ?>
        <div
            style="max-width: 600px; margin: 50px auto; padding: 30px; border: 1px solid #28a745; border-radius: 8px; background-color: #f9f9f9; text-align: center;">
            <h2 style="color: #28a745;">✅ Xác thực tài khoản thành công!</h2>
            <p>Bạn có thể quay lại trang đăng nhập để tiếp tục.</p>
            <a href="login"
                style="display: inline-block; padding: 12px 24px; background-color: #28a745; color: white; text-decoration: none; border-radius: 5px; margin-top: 20px;">Quay
                về đăng nhập</a>
        </div>
    <?php else: ?>
        <div
            style="max-width: 600px; margin: 50px auto; padding: 30px; border: 1px solid #dc3545; border-radius: 8px; background-color: #f9f9f9; text-align: center;">
            <h2 style="color: #dc3545;">❌ Lỗi hệ thống, vui lòng kiểm tra lại!</h2>
        </div>
    <?php endif; ?>
</body>

</html>