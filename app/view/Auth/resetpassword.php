<?php
require(dirname(__DIR__) . "../../controller/auth.controller.php");
$authController = new AuthController();

$email = $_GET['email'] ?? null;
$token = $_GET['token'] ?? null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newPassword = $_POST['password'] ?? '';
    $email = $_POST['email'];
    $token = $_POST['token'] ?? null;

    if (!$email || !$token) {
        die("Thiếu thông tin reset password.");
    }

    $result = $authController->resetPassword($email, $token, $newPassword);

    if ($result) {
        echo "<script>
            alert('Đổi mật khẩu thành công!');
            window.location.href = 'login';
          </script>";
        exit();
    } else {
        echo "<script>
            alert('$result');
          </script>";
    }

}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feane - Reset Password</title>
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
            line-height: 1.5;
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

        .password-strength {
            margin-top: 8px;
            font-size: 12px;
            color: #999;
        }

        .strength-meter {
            height: 4px;
            background-color: #333;
            border-radius: 2px;
            margin-top: 5px;
            overflow: hidden;
        }

        .strength-meter-fill {
            height: 100%;
            width: 0%;
            background-color: #ffbe33;
            transition: width 0.3s;
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
            margin-top: 10px;
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

        .icon-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .icon-container svg {
            width: 60px;
            height: 60px;
            color: #ffbe33;
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
                    <a href="home">HOME</a>
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
            <div class="icon-container">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>

            <div class="auth-header">
                <h2>Reset Password</h2>
                <p>Create a new password for your account</p>
            </div>

            <form action="resetpassword" method="POST">
                <div class="form-group">
                    <input type="hidden" id="token" name="token" value="<?php echo $token; ?>">
                    <input type="hidden" id="email" name="email" value="<?php echo $email; ?>">
                    <label for="new-password">New Password</label>
                    <div class="password-field">
                        <input type="password" id="new-password" name="password" class="form-control"
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
                    <div class="password-strength">
                        <div>Password strength: <span id="strength-text">Weak</span></div>
                        <div class="strength-meter">
                            <div class="strength-meter-fill" style="width: 20%;"></div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="confirm-password">Confirm Password</label>
                    <div class="password-field">
                        <input type="password" id="password-confirm" name="confirm-password" class="form-control"
                            placeholder="Enter your password" required>
                        <button type="button" class="password-toggle" id="password-toggle-1"
                            aria-label="Toggle password visibility">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" id="eye-icon-1">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-submit">Set New Password</button>
            </form>

            <div class="auth-footer">
                Remember your password? <a href="login">Back to Login</a>
            </div>
        </div>
    </main>

    <script>
        const passwordInput = document.getElementById('new-password');
        const strengthText = document.getElementById('strength-text');
        const strengthMeter = document.querySelector('.strength-meter-fill');

        passwordInput.addEventListener('input', function () {
            const password = this.value;
            let strength = 0;

            if (password.length >= 8) strength += 25;
            if (password.match(/[A-Z]/)) strength += 25;
            if (password.match(/[0-9]/)) strength += 25;
            if (password.match(/[^A-Za-z0-9]/)) strength += 25;

            strengthMeter.style.width = strength + '%';

            if (strength <= 25) {
                strengthText.textContent = 'Weak';
                strengthMeter.style.backgroundColor = '#ff4d4d';
            } else if (strength <= 50) {
                strengthText.textContent = 'Fair';
                strengthMeter.style.backgroundColor = '#ffa64d';
            } else if (strength <= 75) {
                strengthText.textContent = 'Good';
                strengthMeter.style.backgroundColor = '#ffbe33';
            } else {
                strengthText.textContent = 'Strong';
                strengthMeter.style.backgroundColor = '#66cc66';
            }
        });

        const form = document.querySelector('form');
        const confirmPassword = document.getElementById('confirm-password');

        form.addEventListener('submit', function (e) {
            if (passwordInput.value !== confirmPassword.value) {
                e.preventDefault();
                alert('Passwords do not match!');
                confirmPassword.focus();
            }
        });
    </script>
</body>
<script>

    const passwordField = document.getElementById('new-password');
    const passwordToggle = document.getElementById('password-toggle');
    const passwordConfirmField = document.getElementById('password-confirm');
    const passwordConfirmToggle = document.getElementById('password-toggle-1');
    const eyeIcon = document.getElementById('eye-icon');
    const eyeIcon1 = document.getElementById('eye-icon-1');
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

            eyeIcon1.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                `;
        } else {
            passwordConfirmField.type = 'password';

            eyeIcon1.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                `;
        }
    })
</script>

</html>