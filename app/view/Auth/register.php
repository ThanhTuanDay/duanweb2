<?php
require(dirname(__DIR__) . "../../controller/auth.controller.php");
require(dirname(__DIR__) . "../../lib/session.php");
Session::init();

$Controller_register = new AuthController();

if (Session::get('name')) {
    header("Location: /duanweb2/homepage");
    exit();
}
$mail_error = null;
$phone_error = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    if ($Controller_register->isEmailExists($email)) {
        $mail_error = "Email đã tồn tại!";

    } elseif
    ($Controller_register->isPhoneExist($phone)) {
        $phone_error = "Số điện thoại đã được dùng";

    } elseif ($password !== $confirm_password) {
        $error = "Mật khẩu xác nhận không khớp!";
    } else {
        $result = $Controller_register->registerUser($email, $password, $confirm_password, $name, $phone, $address);

        if ($result === true) {
            header("Location: /duanweb2/login");
            exit();
        } else {
            $error = $result;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feane - Register</title>
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

        .form-error-server {
            color: #ff4d4d;
            font-size: 12px;
            margin-top: 5px;
            display: block;
        }

        .form-error {
            color: #ff4d4d;
            font-size: 12px;
            margin-top: 5px;
            display: none;
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

        .terms {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin: 20px 0;
        }

        .terms input {
            margin-top: 5px;
        }

        .terms label {
            font-size: 14px;
            color: #ccc;
        }

        .terms a {
            color: #ffbe33;
            text-decoration: none;
        }

        .terms a:hover {
            text-decoration: underline;
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
                    <a href="homepage">HOME</a>
                    <a href="menu">MENU</a>
                    <a href="about">ABOUT</a>
                    <a href="book">BOOK TABLE</a>
                </div>
                <a href="#" class="btn-order">Order Online</a>
            </nav>
        </div>
    </header>

    <main class="auth-container">
        <div class="auth-box">
            <div class="auth-header">
                <h2>Register</h2>
                <p>Create your account to order delicious food</p>
            </div>

            <form action="register" method="POST">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email"
                        required>
                    <?php if (!is_null($mail_error)): ?>
                        <div class="form-error-server">
                            <?= htmlspecialchars($mail_error) ?>
                        </div>
                    <?php endif; ?>
                    <div class="form-error" id="email-error">Email không đúng định dạng</div>
                </div>

                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Enter your full name"
                        required>
                    <div class="form-error" id="full-name-error">Tên không được chứa kí tự đặc biệt</div>
                </div>

                <div class="form-group">
                    <label for="address">Adress</label>
                    <input type="text" id="address" name="address" class="form-control" placeholder="Enter your adress"
                        required>
                </div>

                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" name="phone" class="form-control" placeholder="Enter your phone number"
                        required>
                    <?php if (!is_null($phone_error)): ?>
                        <div class="form-error-server">
                            <?= htmlspecialchars($phone_error) ?>
                        </div>
                    <?php endif; ?>
                    <div class="form-error" id="phone-error">Số điện thoại không đúng định dạng</div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="password-field">
                        <input type="password" id="password" name="password" class="form-control"
                            placeholder="Enter your password" required>
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

                <div class="form-group">
                    <label for="confirm-password">Confirm Password</label>
                    <div class="password-field">
                        <input type="password" id="confirm-password" name="confirm-password" class="form-control"
                            placeholder="Enter your password" required>
                        <button type="button" class="password-toggle" id="password-toggle-1"
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
                    <div class="form-error" id="confirm-password-error">Mật khẩu không trùng</div>
                </div>

                <div class="terms">
                    <input type="checkbox" id="terms" >
                    <label for="terms">I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy
                            Policy</a></label>
                </div>

                <button type="submit" class="btn-submit">Create Account</button>
            </form>

            <div class="auth-footer">
                Already have an account? <a href="login">Login</a>
            </div>
        </div>
    </main>
</body>
<script>
    // Password visibility toggle
    const passwordField = document.getElementById('password');
    const passwordToggle = document.getElementById('password-toggle');
    const passwordConfirmField = document.getElementById('confirm-password');
    const passwordConfirmToggle = document.getElementById('password-toggle-1');
    const eyeIcon = document.getElementById('eye-icon');

    passwordToggle.addEventListener('click', function () {
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
    passwordConfirmToggle.addEventListener('click', function () {
        if (passwordConfirmField.type === 'password') {
            passwordConfirmField.type = 'text';
            eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                `;
        } else {
            passwordConfirmField.type = 'password';
            eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                `;
        }
    });

    document.querySelector("form").addEventListener("submit", function (e) {
        e.preventDefault();

        // Lấy giá trị
        const email = document.getElementById("email");
        const name = document.getElementById("name");
        const phone = document.getElementById("phone");
        const password = document.getElementById("password");
        const confirmPassword = document.getElementById("confirm-password");
        const terms = document.getElementById("terms");

        // Reset lỗi
        document.querySelectorAll(".form-error").forEach(el => el.style.display = "none");

        let isValid = true;

        // Email validate
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email.value.trim())) {
            document.getElementById("email-error").style.display = "block";
            isValid = false;
        }

        // Tên không chứa ký tự đặc biệt
        const nameRegex = /^[a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯưẠ-ỹ\s]+$/u;
        if (!nameRegex.test(name.value.trim())) {
            document.getElementById("full-name-error").style.display = "block";
            isValid = false;
        }

        // Số điện thoại Việt Nam (bắt đầu bằng 0, 10 số)
        const phoneRegex = /^0\d{9}$/;
        if (!phoneRegex.test(phone.value.trim())) {
            document.getElementById("phone-error").style.display = "block";
            isValid = false;
        }
      
        // Mật khẩu khớp nhau
        if (password.value !== confirmPassword.value) {
            document.getElementById("confirm-password-error").style.display = "block";
            isValid = false;
        }

        // Checkbox điều khoản
        if (!terms.checked) {
            alert("Bạn cần đồng ý với điều khoản sử dụng.");
            isValid = false;
        }

        // Nếu mọi thứ đều ổn → submit form
        if (isValid) {
            this.submit();
        }
    });
</script>

</html>