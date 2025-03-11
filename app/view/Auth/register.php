<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký - Siuuuuuuu Shop</title>
    <link rel="stylesheet" href="public/css/register.css">

</head>

<body>
    <div class="register-container">
        <h2>ĐĂNG KÍ</h2>
        <form action="process_register.php" method="POST">
            <label for="username">Tên tài khoản</label>
            <input type="text" id="username" name="username" required placeholder="Nhập tên tài khoản">

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required placeholder="Nhập email">

            <label for="password">Mật khẩu</label>
            <input type="password" id="password" name="password" required placeholder="Nhập mật khẩu">

            <label for="confirm_password">Xác nhận mật khẩu</label>
            <input type="password" id="confirm_password" name="confirm_password" required placeholder="Nhập lại mật khẩu">

            <button type="submit">Đăng Ký</button>
        </form>
        <p>Bạn đã có tài khoản? <a href="login">Đăng nhập ngay</a></p>
    </div>
</body>

</html>