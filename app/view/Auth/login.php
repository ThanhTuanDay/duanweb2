<?php
require(dirname(__DIR__) . "../../controller/auth.controller.php");
require(dirname(__DIR__) . "../../lib/session.php");
Session::init();
?>
<?php
$Controller_login = new AuthController();



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $data = $Controller_login->loginUser($_POST['username'], $_POST['password']);
    if (!is_null($data)) {
        Session::set('role', $data['role']);
        Session::set('name', $data['name']);
        Session::set('user_id', $data['id']);
        Session::set('email', $data['email']);
        Session::set('phone', $data['phone']);
        echo "
        <script>
            localStorage.setItem('isLogin', 'true');
            window.location.href = '/duanweb2/homepage';
        </script>";
    }
}



if (Session::get('name')) {
    echo "
    <script>
        localStorage.setItem('isLogin', 'true');
        window.location.href = '/duanweb2/homepage';
    </script>";
} else {
    "
    <script>
   
    window.location.href='/duanweb2/login'
    </script>
    ";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feane - Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #0c0c0c;
            color: #ffffff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .header {
            padding: 15px 0;
            background-color: #191919;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 999;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
        }

        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo {
            font-size: 28px;
            font-weight: bold;
            text-decoration: none;
            color: #ffffff;
        }

        .nav-links {
            display: flex;
            gap: 30px;
        }

        .nav-links a {
            color: #ffffff;
            text-decoration: none;
            font-size: 16px;
            transition: color 0.3s;
        }

        .nav-links a:hover {
            color: #ffbe33;
        }

        .btn-order {
            background-color: #ffbe33;
            color: #ffffff;
            padding: 8px 25px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 500;
            transition: background-color 0.3s;
        }

        .btn-order:hover {
            background-color: #e69c00;
        }

        .auth-container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 100px 20px 40px;
        }

        .auth-box {
            background-color: #191919;
            border-radius: 10px;
            padding: 40px;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
        }

        .auth-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .auth-header h2 {
            font-size: 32px;
            margin-bottom: 10px;
        }

        .auth-header p {
            color: #999;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            background-color: #2c2c2c;
            border: none;
            border-radius: 5px;
            color: #ffffff;
            font-size: 16px;
        }

        .form-control:focus {
            outline: 2px solid #ffbe33;
        }

        .form-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
            margin-bottom: 25px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .forgot-password {
            color: #ffbe33;
            text-decoration: none;
            font-size: 14px;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        .password-field {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #999;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .password-toggle:hover {
            color: #ffbe33;
        }

        .password-toggle svg {
            width: 20px;
            height: 20px;
        }

        .btn-submit {
            width: 100%;
            padding: 12px;
            background-color: #ffbe33;
            color: #ffffff;
            border: none;
            border-radius: 25px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-submit:hover {
            background-color: #e69c00;
        }

        .auth-footer {
            text-align: center;
            margin-top: 25px;
            color: #999;
            font-size: 14px;
        }

        .auth-footer a {
            color: #ffbe33;
            text-decoration: none;
            font-weight: 500;
        }

        .auth-footer a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .auth-box {
                padding: 30px 20px;
            }
        }
    </style>
</head>

<body>
    <header class="header">
        <div class="container">
            <nav class="navbar">
                <a href="#" class="logo">Feane</a>
                <div class="nav-links">
                    <a href="homepage">TRANG CHỦ</a>
                    <a href="menu">THỰC ĐƠN</a>
                    <a href="about">THÔNG TIN </a>
                </div>
                <a href="#" class="btn-order">ĐẶT HÀNG NGAY</a>
            </nav>
        </div>
    </header>

    <main class="auth-container">
        <div class="auth-box">
            <div class="auth-header">
                <h2>Đăng nhập</h2>
                <p>Vui lòng đăng nhập tài khoản của bạn</p>
            </div>

            <form action="login" method="post">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="username" name="username" class="form-control"
                        placeholder="Nhập email của bạn" required>
                </div>

                <div class="form-group">
                    <label for="password">Mật khẩu</label>
                    <div class="password-field">
                        <input type="password" id="password" name="password" class="form-control"
                            placeholder="Nhập mật khẩu của bạn" required>
                        <button type="button" class="password-toggle" id="password-toggle"
                            aria-label="Toggle password visibility">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" id="eye-icon">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="form-footer">
                    <div class="remember-me">
                        <input type="checkbox" id="remember">
                        <label for="remember">Nhớ mật khẩu</label>
                    </div>
                    <a href="forgot" class="forgot-password">Quên mật khẩu?</a>
                </div>

                <button type="submit" class="btn-submit">Đăng nhập</button>
            </form>

            <div class="auth-footer">
                Bạn chưa có tài khoản? <a href="register">Đăng ký</a>
            </div>
        </div>
    </main>
</body>
<script>
    const passwordField = document.getElementById('password');
    const passwordToggle = document.getElementById('password-toggle');
    const eyeIcon = document.getElementById('eye-icon');

    passwordToggle.addEventListener('click', function() {
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                `;
        } else {
            passwordField.type = 'password';
            eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                `;
        }
    });
</script>

</html>