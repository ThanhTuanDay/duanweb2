<?php
require(dirname(__DIR__) . "../../controller/payment.controller.php");




$orderId = $_GET['orderId'] ?? null;
$resultCode = $_GET['resultCode'] ?? null;

if (!$orderId ) {
    http_response_code(400);
    echo "Invalid payment data";
    exit;
}
$user_id = $_SESSION['userId'] ?? null;
$paymentController = new PaymentController();
$order = $paymentController->getOrderById($orderId);
if ($resultCode == "0") {
    $paymentController->handlePaymentResponse($orderId, OrderStatus::Delivering);
} else {
    $paymentController->handlePaymentResponse($orderId, OrderStatus::Cancelled);
}



?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feane - Payment Success</title>
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
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .success-container {
            background-color: #191919;
            border-radius: 10px;
            padding: 40px;
            width: 100%;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .success-icon {
            width: 100px;
            height: 100px;
            background-color: rgba(255, 190, 51, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
            position: relative;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(255, 190, 51, 0.4);
            }

            70% {
                box-shadow: 0 0 0 20px rgba(255, 190, 51, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(255, 190, 51, 0);
            }
        }

        .success-icon svg {
            width: 50px;
            height: 50px;
            color: #ffbe33;
        }

        .success-title {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 15px;
            color: #ffbe33;
        }

        .success-message {
            font-size: 16px;
            color: #cccccc;
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .order-details {
            background-color: #222222;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 30px;
        }

        .order-number {
            font-size: 18px;
            font-weight: 500;
            margin-bottom: 15px;
            color: #ffffff;
        }

        .order-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .order-info-label {
            color: #999999;
        }

        .order-info-value {
            color: #ffffff;
            font-weight: 500;
        }

        .divider {
            height: 1px;
            background-color: #333333;
            margin: 15px 0;
        }

        .return-home {
            display: inline-block;
            background-color: #ffbe33;
            color: #ffffff;
            padding: 12px 30px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 500;
            transition: background-color 0.3s;
            border: none;
            font-size: 16px;
            cursor: pointer;
        }

        .return-home:hover {
            background-color: #e69c00;
        }

        .additional-actions {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .action-link {
            color: #999999;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s;
        }

        .action-link:hover {
            color: #ffbe33;
        }

        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .success-container {
                padding: 30px 20px;
            }

            .success-title {
                font-size: 24px;
            }

            .success-message {
                font-size: 14px;
            }

            .order-number {
                font-size: 16px;
            }

            .order-info {
                font-size: 13px;
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
                    <a href="about">THÔNG TIN</a>
                 
                </div>
                <a href="#" class="btn-order">ĐẶT HÀNG NGAY</a>
            </nav>
        </div>
    </header>

    <main class="main-container">
        <div class="container">
            <div class="success-container">
                <div class="success-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <h1 class="success-title">Thanh toán thành công!</h1>
                <p class="success-message">
                    
                    Cảm ơn bạn đã đặt hàng. Thanh toán của bạn đã được xử lý thành công.
                    Chúng tôi sẽ bắt đầu chuẩn bị bữa ăn ngon cho bạn ngay!
                </p>

                <div class="order-details">
                    <div class="order-number">Order#<?= htmlspecialchars($order->getId()) ?></div>

                    <div class="order-info">
                        <span class="order-info-label">Thời gian đặt hàng:</span>
                        <span class="order-info-value"><?= htmlspecialchars($order->getCreatedAt()) ?></span>
                    </div>

                    <div class="order-info">
                        <span class="order-info-label">Phương thức thanh toán:</span>
                        <span class="order-info-value">Thanh toán khi nhận hàng</span>
                    </div>

                    <div class="order-info">
                        <span class="order-info-label">Địa chỉ giao hàng:</span>
                        <span class="order-info-value"><?= htmlspecialchars($order->getDeliveryAddress()) ?></span>
                    </div>

                    <div class="divider"></div>

                    <div class="order-info">
                        <span class="order-info-label">Thành tiền:</span>
                        <span class="order-info-value"> <?= number_format($order->getTotalPrice(), 0, '', '.') ?> VND
                        </span>
                    </div>

                    <div class="order-info">
                        <span class="order-info-label">Thời gian giao hàng:</span>
                        <span class="order-info-value">30-45 phút </span>
                    </div>
                </div>

                <a href="homepage" class="return-home">Quay lại trang chủ</a>

                <div class="additional-actions">
                    <a href="#" class="action-link">Chi tiết đơn hàng</a>
                    <a href="#" class="action-link">Hỗ trợ</a>
                </div>
            </div>
        </div>
        <div id="app-data" data-user-id="<?= htmlspecialchars($_SESSION['user_id'] ?? '') ?>"
            data-products='<?= isset($products) ? json_encode($products, JSON_HEX_APOS | JSON_HEX_QUOT) : "null" ?>'
            style="display: none;">
        </div>
    </main>
</body>



</html>