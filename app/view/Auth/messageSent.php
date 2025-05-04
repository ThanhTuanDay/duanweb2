<?php
require(dirname(__DIR__) . "../../controller/auth.controller.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? null;

    if (!$email) {
        http_response_code(400);
        echo json_encode(['message' => 'Missing email']);
        exit();
    }

    $authController = new AuthController();
    $result = $authController->sendForgotPasswordRequest($email);

    if ($result) {
        echo json_encode(['message' => 'Resend successful']);
    } else {
        http_response_code(500);
        echo json_encode(['message' => 'Failed to resend']);
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feane - Email Sent</title>
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
            text-align: center;
        }

        .auth-header {
            margin-bottom: 25px;
        }

        .auth-header h2 {
            font-size: 32px;
            margin-bottom: 15px;
            color: #ffbe33;
        }

        .auth-content {
            color: #ccc;
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .auth-content p {
            margin-bottom: 15px;
        }

        .auth-content strong {
            color: #ffffff;
            font-weight: 500;
        }

        .btn-primary {
            display: inline-block;
            padding: 12px 30px;
            background-color: #ffbe33;
            color: #ffffff;
            border: none;
            border-radius: 25px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s;
            margin-bottom: 15px;
        }

        .btn-primary:hover {
            background-color: #e69c00;
        }

        .btn-secondary {
            display: inline-block;
            color: #ffbe33;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: color 0.3s;
        }

        .btn-secondary:hover {
            color: #e69c00;
            text-decoration: underline;
        }

        .icon-container {
            margin-bottom: 25px;
        }

        .icon-container svg {
            width: 70px;
            height: 70px;
            color: #ffbe33;
        }

        .countdown {
            font-size: 14px;
            color: #999;
            margin-top: 20px;
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
                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>

            <div class="auth-header">
                <h2>Check Your Email</h2>
            </div>

            <div class="auth-content">
                <p>We've sent a password reset link to your email address.</p>
                <p>Please check your inbox and click on the link to reset your password.</p>
                <p>If you don't see the email, check your spam folder.</p>
            </div>

            <a href="login" class="btn-primary">Back to Login</a>

            <div>
                <a href="#" class="btn-secondary" id="resend-link">Didn't receive the email? Resend</a>
            </div>

            <div class="countdown" id="countdown" style="display: none;">
                You can resend in <span id="timer">60</span> seconds
            </div>
        </div>
    </main>

    <script>
        function getQueryParam(param) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(param);
        }

        const email = getQueryParam('email');
        const resendLink = document.getElementById('resend-link');
        const countdown = document.getElementById('countdown');
        const timer = document.getElementById('timer');
        let timeLeft = 60;
        let countdownInterval;

        resendLink.addEventListener('click', function (e) {
            e.preventDefault();

            if (!email) {
                alert('Không tìm thấy email!');
                return;
            }

            fetch('messageSent', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'email=' + encodeURIComponent(email)
            })
                .then(response => response.json())
                .then(data => {
                    alert('resend successful ');
                })
                .catch(error => {
                    alert('resend successful');
                });

            resendLink.style.display = 'none';
            countdown.style.display = 'block';

            timeLeft = 60;
            timer.textContent = timeLeft;

            countdownInterval = setInterval(function () {
                timeLeft--;
                timer.textContent = timeLeft;

                if (timeLeft <= 0) {
                    clearInterval(countdownInterval);
                    countdown.style.display = 'none';
                    resendLink.style.display = 'inline-block';
                }
            }, 1000);
        });
    </script>
</body>

</html>