<?php
require(dirname(__DIR__) . "../../controller/user.controller.php");




$userId = Session::get('user_id');
$userController = new UserController();
$user = $userController->getUserById($userId);

if (!$user) {
    header("Location: login");
    exit;
}

$nameParts = explode(' ', $user->getName());
$firstName = array_shift($nameParts);
$lastName = implode(' ', $nameParts);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feane - My Profile</title>
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

        .main-container {
            flex: 1;
            padding: 100px 0 40px;
        }

        .page-title {
            margin-bottom: 30px;
            text-align: center;
        }

        .page-title h1 {
            font-size: 36px;
            margin-bottom: 10px;
            color: #ffbe33;
        }

        .page-title p {
            color: #cccccc;
            font-size: 16px;
        }

        .profile-container {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
        }

        .profile-sidebar {
            flex: 1;
            min-width: 250px;
            background-color: #191919;
            border-radius: 10px;
            padding: 30px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            overflow: hidden;
            margin-bottom: 20px;
            border: 3px solid #ffbe33;
        }

        .profile-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-name {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 5px;
            text-align: center;
        }

        .profile-email {
            color: #999999;
            margin-bottom: 20px;
            text-align: center;
        }

        .profile-menu {
            width: 100%;
            margin-top: 20px;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 10px;
            cursor: pointer;
            transition: background-color 0.3s;
            text-decoration: none;
            color: #ffffff;
        }

        .menu-item:hover {
            background-color: rgba(255, 190, 51, 0.1);
        }

        .menu-item.active {
            background-color: rgba(255, 190, 51, 0.1);
            color: #ffbe33;
        }

        .menu-item svg {
            width: 20px;
            height: 20px;
            margin-right: 10px;
        }

        .profile-content {
            flex: 2;
            min-width: 300px;
        }

        .profile-card {
            background-color: #191919;
            border-radius: 10px;
            padding: 30px;
            margin-bottom: 30px;
        }

        .card-title {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #ffbe33;
            display: flex;
            align-items: center;
        }

        .card-title svg {
            width: 24px;
            height: 24px;
            margin-right: 10px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            color: #cccccc;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            background-color: #222222;
            border: 1px solid #333333;
            border-radius: 8px;
            color: #ffffff;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        .form-control:focus {
            outline: none;
            border-color: #ffbe33;
        }

        .form-row {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .form-row .form-group {
            flex: 1;
            min-width: 200px;
        }

        .btn {
            padding: 12px 25px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
        }

        .btn-primary {
            background-color: #ffbe33;
            color: #ffffff;
        }

        .btn-primary:hover {
            background-color: #e69c00;
        }

        .btn-secondary {
            background-color: transparent;
            color: #ffffff;
            border: 1px solid #333333;
        }

        .btn-secondary:hover {
            background-color: #222222;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            margin-top: 30px;
        }

        .password-input-container {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #999999;
            cursor: pointer;
        }

        .toggle-password:hover {
            color: #ffffff;
        }

        .toggle-password svg {
            width: 20px;
            height: 20px;
        }

        .form-hint {
            font-size: 12px;
            color: #999999;
            margin-top: 5px;
        }

        .form-error {
            color: #ff4d4d;
            font-size: 12px;
            margin-top: 5px;
            display: none;
        }

        .form-success {
            background-color: rgba(76, 217, 100, 0.1);
            color: #4cd964;
            padding: 10px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: none;
        }

        .form-success.show {
            display: block;
        }

        .upload-btn-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
            margin-top: 10px;
        }

        .upload-btn {
            background-color: #222222;
            color: #ffffff;
            padding: 8px 15px;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .upload-btn svg {
            width: 16px;
            height: 16px;
        }

        .upload-btn-wrapper input[type=file] {
            font-size: 100px;
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
            cursor: pointer;
        }

        .avatar-preview {
            margin-top: 15px;
            text-align: center;
        }

        .avatar-preview img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #333333;
        }

        .password-strength {
            margin-top: 10px;
            height: 5px;
            background-color: #333333;
            border-radius: 5px;
            overflow: hidden;
        }

        .password-strength-meter {
            height: 100%;
            width: 0;
            transition: width 0.3s, background-color 0.3s;
        }

        .password-strength-text {
            font-size: 12px;
            margin-top: 5px;
            color: #999999;
        }

        .weak {
            background-color: #ff4d4d;
            width: 33%;
        }

        .medium {
            background-color: #ffbe33;
            width: 66%;
        }

        .strong {
            background-color: #4cd964;
            width: 100%;
        }

        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .page-title h1 {
                font-size: 28px;
            }

            .profile-container {
                flex-direction: column;
            }

            .profile-sidebar {
                width: 100%;
            }

            .form-row {
                flex-direction: column;
                gap: 0;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
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

    <main class="main-container">
        <div class="container">
            <div class="page-title">
                <h1>Thông tin cá nhân của tôi </h1>
                <p>
                    Xem và cập nhật thông tin cá nhân của bạn</p>
            </div>

            <div class="profile-container">
                <div class="profile-sidebar">
                    <div class="profile-avatar">
                        <img src="/placeholder.svg?height=120&width=120" alt="Profile Avatar">
                    </div>
                    <h2 class="profile-name"><?php echo htmlspecialchars($user->getName()); ?></h2>
                    <p class="profile-email"><?php echo htmlspecialchars($user->getEmail()); ?></p>

                    <div class="upload-btn-wrapper">
                        <div class="upload-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Thay đổi hình ảnh
                        </div>
                        <input type="file" name="avatar" id="avatar-upload" accept="image/*"
                            onchange="previewAvatar(this)">
                    </div>

                    <div class="profile-menu">
                        <a href="#personal-info" class="menu-item active">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>

                            Thông tin cá nhân </a>
                        <a href="#change-password" class="menu-item">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            Thay đổi mật khẩu
                        </a>
                        <a href="order-history" class="menu-item">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                            Đơn đặt hàng của tôi
                        </a>
                        <a href="logout" class="menu-item">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Đăng xuất
                        </a>
                    </div>
                </div>

                <div class="profile-content">
                    <div id="personal-info" class="profile-card">
                        <h3 class="card-title">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Thông tin cá nhânnhân
                        </h3>

                        <div class="form-success" id="personal-info-success">
                            Thông tin cá nhân của bạn đã cập nhật thành công
                        </div>

                        <form id="personal-info-form">
                            <input type="hidden" id="user-id" value="<?php echo htmlspecialchars($userId); ?>">
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="first-name" class="form-label">
                                        Tên</label>
                                    <input type="text" id="first-name" class="form-control"
                                        value="<?php echo htmlspecialchars($firstName); ?>" required>
                                    <div class="form-error" id="first-name-error">Vui lòng nhập tên của bạn</div>
                                </div>
                                <div class="form-group">
                                    <label for="last-name" class="form-label">TTên họ </label>
                                    <input type="text" id="last-name" class="form-control"
                                        value="<?php echo htmlspecialchars($lastName); ?>" required>
                                    <div class="form-error" id="last-name-error">Vui lòng nhập họ của bạn</div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="form-label">địa chỉ Email </label>
                                <input type="email" id="email" class="form-control"
                                    value="<?php echo htmlspecialchars($user->getEmail()); ?>" disabled>
                                <div class="form-hint">địa chỉ Email không thể đổi  </div>
                            </div>

                            <div class="form-group">
                                <label for="phone" class="form-label">Số điện thoạir</label>
                                <input type="tel" id="phone" class="form-control"
                                    value="<?php echo htmlspecialchars($user->getPhone()); ?>" required>
                                <div class="form-error" id="phone-error">Làm ơn nhập số điện thoại </div>
                            </div>
                            <div class="form-group">
                                <label for="address" class="form-label">Địa chỉ giao hàng/label>
                                <input type="text" id="address" class="form-control"
                                    value="<?php echo htmlspecialchars($user->getAddress()); ?>" required>
                            </div>
                            <div class="form-actions">
                                <button type="button" class="btn btn-secondary"
                                    onclick="resetPersonalInfoForm()">Hủy</button>
                                <button type="button" class="btn btn-primary" onclick="savePersonalInfo()">Lưu thay đổi</button>
                            </div>
                        </form>
                    </div>

                    <div id="change-password" class="profile-card">
                        <h3 class="card-title">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                          Thay đổi mật khẩu 
                        </h3>

                        <div class="form-success" id="password-success">
                            Mật khẩu đổi thành công!
                        </div>

                        <form id="password-form">
                            <div class="form-group">
                                <label for="current-password" class="form-label">Mật khẩu hiện tại </label>
                                <div class="password-input-container">
                                    <input type="password" id="current-password" class="form-control" required>
                                    <button type="button" class="toggle-password"
                                        onclick="togglePasswordVisibility('current-password')">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                </div>
                                <div class="form-error" id="current-password-error">Hãy nhập mật khẩu hiện tại 
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="new-password" class="form-label">Mật khẩu mớimới</label>
                                <div class="password-input-container">
                                    <input type="password" id="new-password" class="form-control" required
                                        onkeyup="checkPasswordStrength()">
                                    <button type="button" class="toggle-password"
                                        onclick="togglePasswordVisibility('new-password')">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                </div>
                                <div class="password-strength">
                                    <div class="password-strength-meter" id="password-strength-meter"></div>
                                </div>
                                <div class="password-strength-text" id="password-strength-text">Độ mạnh mật khẩu</div>
                                <div class="form-error" id="new-password-error">Mật khẩu ít nhất có 8 ký tự </div>
                            </div>

                            <div class="form-group">
                                <label for="confirm-password" class="form-label">Xác nhận mật khẩu mới </label>
                                <div class="password-input-container">
                                    <input type="password" id="confirm-password" class="form-control" required>
                                    <button type="button" class="toggle-password"
                                        onclick="togglePasswordVisibility('confirm-password')">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                </div>
                                <div class="form-error" id="confirm-password-error">Mật khẩu không mactch với nhaunhau</div>
                            </div>

                            <div class="form-actions">
                                <button type="button" class="btn btn-secondary"
                                    onclick="resetPasswordForm()">Cancel</button>
                                <button type="button" class="btn btn-primary" onclick="changePassword()">Change
                                    Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="public/js/user-info.js"></script>
</body>

</html>