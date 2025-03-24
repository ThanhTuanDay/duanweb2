<?php
require(dirname(__DIR__) . "../../controller/auth.controller.php");
require(dirname(__DIR__)."../../lib/session.php");
Session::init();
?>
<?php
$Controller_login = new AuthController();



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $data=$Controller_login->loginUser($_POST['username'], $_POST['password']);
    if(!is_null($data)){
         Session::set('role',$data['role']);
         Session::set('name', $data['name']);
        header("Location:/duanweb2/homepage");
    }
}
if (Session::get('name')) {
    header("Location:/duanweb2/homepage");
} else {
    "<script>window.location.href='/duanweb2/login'</script>";
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập - Siuuuuuuu Shop</title>
    <link rel="stylesheet" href="public/css/login.css">
</head>

<body>

    <div class="login-container">
        <form action="login" method="post">

            <h2>ĐĂNG NHẬP</h2>
            <label for="username"> Tên tài khoản</label>
            <input type="text" id="username" name="username" required placeholder="Nhập tên tài khoản">

            <label for="password">Mật khẩu</label>
            <input type="password" id="password" name="password" required placeholder="Nhập mật khẩu">

            <button type="submit">Đăng nhập</button>
        </form>
        <p>Bạn chưa có tài khoản? <a href="register">Đăng ký ngay</a></p>
    </div>

</body>