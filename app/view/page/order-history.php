<?php
require(dirname(__DIR__) . "../../controller/payment.controller.php");

$paymentController = new PaymentController();
$userId = Session::get('user_id');

if (!$userId) {
    header("Location: login");
    exit;
}

$orders = $paymentController->getOrdersByUserId($userId);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feane - Đơn hàng của tôi</title>
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

        .orders-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .order-card {
            background-color: #191919;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s;
        }

        .order-card:hover {
            transform: translateY(-5px);
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            background-color: #222222;
            border-bottom: 1px solid #333333;
        }

        .order-number {
            font-weight: 600;
            font-size: 16px;
        }

        .order-date {
            color: #999999;
            font-size: 14px;
        }

        .order-status {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            text-transform: uppercase;
        }

        .status-delivered {
            background-color: rgba(76, 217, 100, 0.15);
            color: #4cd964;
        }

        .status-processing {
            background-color: rgba(255, 190, 51, 0.15);
            color: #ffbe33;
        }

        .status-cancelled {
            background-color: rgba(255, 59, 48, 0.15);
            color: #ff3b30;
        }

        .order-summary {
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .order-items {
            flex: 1;
        }

        .item-preview {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .item-preview:last-child {
            margin-bottom: 0;
        }

        .item-image {
            width: 40px;
            height: 40px;
            border-radius: 5px;
            overflow: hidden;
            margin-right: 10px;
        }

        .item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .item-name {
            font-size: 14px;
        }

        .item-quantity {
            color: #999999;
            font-size: 12px;
            margin-left: 5px;
        }

        .order-total {
            text-align: right;
            margin-left: 20px;
        }

        .total-label {
            font-size: 14px;
            color: #999999;
            margin-bottom: 5px;
        }

        .total-amount {
            font-size: 18px;
            font-weight: 600;
            color: #ffbe33;
        }

        .order-actions {
            display: flex;
            border-top: 1px solid #333333;
        }

        .order-action-btn {
            flex: 1;
            padding: 12px;
            background: none;
            border: none;
            color: #ffffff;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .order-action-btn:hover {
            background-color: #222222;
        }

        .order-action-btn svg {
            width: 16px;
            height: 16px;
            margin-right: 8px;
        }

        .order-action-btn.primary {
            color: #ffbe33;
        }

        .order-action-btn.primary:hover {
            background-color: rgba(255, 190, 51, 0.1);
        }

        .order-action-btn.secondary {
            border-left: 1px solid #333333;
        }

        /* Order Details Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 1000;
            overflow-y: auto;
            padding: 20px;
        }

        .modal-content {
            background-color: #191919;
            border-radius: 10px;
            max-width: 800px;
            margin: 50px auto;
            overflow: hidden;
            animation: modalFadeIn 0.3s;
        }

        @keyframes modalFadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background-color: #222222;
            border-bottom: 1px solid #333333;
        }

        .modal-title {
            font-size: 20px;
            font-weight: 600;
        }

        .close-modal {
            background: none;
            border: none;
            color: #ffffff;
            font-size: 24px;
            cursor: pointer;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: background-color 0.3s;
        }

        .close-modal:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .modal-body {
            padding: 20px;
        }

        .order-info-section {
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 15px;
            color: #ffbe33;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }

        .info-item {
            background-color: #222222;
            padding: 15px;
            border-radius: 8px;
        }

        .info-label {
            font-size: 12px;
            color: #999999;
            margin-bottom: 5px;
        }

        .info-value {
            font-size: 14px;
            font-weight: 500;
        }

        .order-items-list {
            margin-bottom: 30px;
        }

        .order-item {
            display: flex;
            align-items: center;
            padding: 15px;
            background-color: #222222;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .order-item:last-child {
            margin-bottom: 0;
        }

        .item-details {
            flex: 1;
            margin-left: 15px;
        }

        .item-title {
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 5px;
        }

        .item-variant {
            font-size: 12px;
            color: #999999;
            margin-bottom: 5px;
        }

        .item-price {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .price-amount {
            font-size: 14px;
            font-weight: 500;
        }

        .price-quantity {
            font-size: 12px;
            color: #999999;
        }

        .order-summary-section {
            background-color: #222222;
            padding: 20px;
            border-radius: 8px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .summary-row:last-child {
            margin-bottom: 0;
        }

        .summary-label {
            font-size: 14px;
            color: #999999;
        }

        .summary-value {
            font-size: 14px;
            font-weight: 500;
        }

        .summary-divider {
            height: 1px;
            background-color: #333333;
            margin: 15px 0;
        }

        .summary-total {
            font-size: 18px;
            font-weight: 600;
            color: #ffbe33;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            padding: 20px;
            border-top: 1px solid #333333;
        }

        .modal-btn {
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-primary {
            background-color: #ffbe33;
            color: #ffffff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #e69c00;
        }

        .btn-secondary {
            background-color: transparent;
            color: #ffffff;
            border: 1px solid #333333;
            margin-right: 10px;
        }

        .btn-secondary:hover {
            background-color: #222222;
        }

        .tracking-section {
            margin-top: 30px;
        }

        .tracking-timeline {
            position: relative;
            padding-left: 30px;
        }

        .tracking-timeline::before {
            content: '';
            position: absolute;
            top: 0;
            left: 9px;
            width: 2px;
            height: 100%;
            background-color: #333333;
        }

        .timeline-item {
            position: relative;
            padding-bottom: 25px;
        }

        .timeline-item:last-child {
            padding-bottom: 0;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: -30px;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background-color: #222222;
            border: 2px solid #ffbe33;
            z-index: 1;
        }

        .timeline-item.completed::before {
            background-color: #ffbe33;
        }

        .timeline-content {
            background-color: #222222;
            padding: 15px;
            border-radius: 8px;
        }

        .timeline-title {
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 5px;
        }

        .timeline-time {
            font-size: 12px;
            color: #999999;
        }

        .empty-orders {
            text-align: center;
            padding: 50px 20px;
            background-color: #191919;
            border-radius: 10px;
        }

        .empty-orders svg {
            width: 80px;
            height: 80px;
            color: #666;
            margin-bottom: 20px;
        }

        .empty-orders h3 {
            font-size: 24px;
            margin-bottom: 15px;
        }

        .empty-orders p {
            color: #999;
            margin-bottom: 25px;
        }

        .browse-menu {
            display: inline-block;
            padding: 10px 25px;
            background-color: #ffbe33;
            color: #ffffff;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 500;
            transition: background-color 0.3s;
        }

        .browse-menu:hover {
            background-color: #e69c00;
        }

        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .page-title h1 {
                font-size: 28px;
            }

            .order-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .order-date {
                margin: 5px 0;
            }

            .order-summary {
                flex-direction: column;
                align-items: flex-start;
            }

            .order-total {
                margin-left: 0;
                margin-top: 15px;
                text-align: left;
            }

            .info-grid {
                grid-template-columns: 1fr;
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
            <div class="page-title">
                <h1>Đơn hàng của tôi</h1>
                <p>Xem và theo dõi đơn hàng của bạn</p>
            </div>

            <div class="orders-container">
                <?php if (!empty($orders)): ?>
                    <?php foreach ($orders as $order):
                        $items = $paymentController->getOrderItemsByOrderId($order->getId());
                    ?>
                        <div class="order-card">
                            <div class="order-header">
                                <div>
                                    <div class="order-number">Order #<?= htmlspecialchars($order->getId()) ?></div>
                                    <div class="order-date"><?= date('F j, Y - g:i A', strtotime($order->getCreatedAt())) ?>
                                    </div>
                                </div>
                                <span class="order-status <?= match ($order->getStatus()) {
                                                                'completed' => 'status-delivered',
                                                                'delivering', 'preparing' => 'status-processing',
                                                                'cancelled' => 'status-cancelled',
                                                                default => ''
                                                            } ?>">
                                    <?= ucfirst($order->getStatus()) ?>
                                </span>
                            </div>

                            <div class="order-summary">
                                <div class="order-items">
                                    <?php foreach ($items as $item): ?>
                                        <div class="item-preview">
                                            <div class="item-image">
                                                <img src="<?= htmlspecialchars($item['image_url'] ?? '/placeholder.svg') ?>"
                                                    alt="<?= htmlspecialchars($item['name']) ?>">
                                            </div>
                                            <div class="item-name"><?= htmlspecialchars($item['name']) ?> <span
                                                    class="item-quantity">x<?= $item['quantity'] ?></span></div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="order-total">
                                    <div class="total-label">Thành tiền</div>
                                    <div class="total-amount"><?= number_format($order->getTotalPrice(), 0, ',', '.') ?> VND</div>
                                </div>
                            </div>

                            <div class="order-actions">
                                <button class="order-action-btn primary"
                                    onclick="openOrderDetails('<?= $order->getId() ?>')">Xem chi tiết</button>
                                <button class="order-action-btn secondary reorder-btn"
                                    data-order-id="<?= $order->getId() ?>"
                                    data-items='<?= json_encode($items, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) ?>'>
                                    Đặt hàng lại
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="empty-orders">
                        <h3>Bạn chưa có đơn hàng</h3>
                        <p>Bạn chưa có đơn hàng nào trước đây</p>
                        <a href="menu" class="browse-menu">Quay về TRANG CHỦ</a>
                    </div>
                <?php endif; ?>
                <!-- <div class="order-card">
                    <div class="order-header">
                        <div>
                            <div class="order-number">Order #FN78945612</div>
                            <div class="order-date">April 4, 2025 - 2:48 PM</div>
                        </div>
                        <span class="order-status status-delivered">Delivered</span>
                    </div>
                    <div class="order-summary">
                        <div class="order-items">
                            <div class="item-preview">
                                <div class="item-image">
                                    <img src="/placeholder.svg?height=40&width=40" alt="Deluxe Cheeseburger">
                                </div>
                                <div class="item-name">Deluxe Cheeseburger <span class="item-quantity">x1</span></div>
                            </div>
                            <div class="item-preview">
                                <div class="item-image">
                                    <img src="/placeholder.svg?height=40&width=40" alt="French Fries">
                                </div>
                                <div class="item-name">Large French Fries <span class="item-quantity">x1</span></div>
                            </div>
                            <div class="item-preview">
                                <div class="item-image">
                                    <img src="/placeholder.svg?height=40&width=40" alt="Chocolate Shake">
                                </div>
                                <div class="item-name">Chocolate Milkshake <span class="item-quantity">x1</span></div>
                            </div>
                        </div>
                        <div class="order-total">
                            <div class="total-label">Total Amount</div>
                            <div class="total-amount">$25.97</div>
                        </div>
                    </div>
                    <div class="order-actions">
                        <button class="order-action-btn primary" onclick="openOrderDetails('FN78945612')">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            View Details
                        </button>
                        <button class="order-action-btn secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            Reorder
                        </button>
                    </div>
                </div>

    
                <div class="order-card">
                    <div class="order-header">
                        <div>
                            <div class="order-number">Order #FN78945589</div>
                            <div class="order-date">April 1, 2025 - 7:32 PM</div>
                        </div>
                        <span class="order-status status-processing">Processing</span>
                    </div>
                    <div class="order-summary">
                        <div class="order-items">
                            <div class="item-preview">
                                <div class="item-image">
                                    <img src="/placeholder.svg?height=40&width=40" alt="Margherita Pizza">
                                </div>
                                <div class="item-name">Margherita Pizza <span class="item-quantity">x1</span></div>
                            </div>
                            <div class="item-preview">
                                <div class="item-image">
                                    <img src="/placeholder.svg?height=40&width=40" alt="Garlic Bread">
                                </div>
                                <div class="item-name">Garlic Bread <span class="item-quantity">x1</span></div>
                            </div>
                            <div class="item-preview">
                                <div class="item-image">
                                    <img src="/placeholder.svg?height=40&width=40" alt="Coca Cola">
                                </div>
                                <div class="item-name">Coca Cola <span class="item-quantity">x2</span></div>
                            </div>
                        </div>
                        <div class="order-total">
                            <div class="total-label">Total Amount</div>
                            <div class="total-amount">$32.50</div>
                        </div>
                    </div>
                    <div class="order-actions">
                        <button class="order-action-btn primary" onclick="openOrderDetails('FN78945589')">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            View Details
                        </button>
                        <button class="order-action-btn secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            Reorder
                        </button>
                    </div>
                </div>


                <div class="order-card">
                    <div class="order-header">
                        <div>
                            <div class="order-number">Order #FN78945432</div>
                            <div class="order-date">March 25, 2025 - 1:15 PM</div>
                        </div>
                        <span class="order-status status-cancelled">Cancelled</span>
                    </div>
                    <div class="order-summary">
                        <div class="order-items">
                            <div class="item-preview">
                                <div class="item-image">
                                    <img src="/placeholder.svg?height=40&width=40" alt="Chicken Pasta">
                                </div>
                                <div class="item-name">Chicken Pasta <span class="item-quantity">x1</span></div>
                            </div>
                            <div class="item-preview">
                                <div class="item-image">
                                    <img src="/placeholder.svg?height=40&width=40" alt="Caesar Salad">
                                </div>
                                <div class="item-name">Caesar Salad <span class="item-quantity">x1</span></div>
                            </div>
                        </div>
                        <div class="order-total">
                            <div class="total-label">Total Amount</div>
                            <div class="total-amount">$28.75</div>
                        </div>
                    </div>
                    <div class="order-actions">
                        <button class="order-action-btn primary" onclick="openOrderDetails('FN78945432')">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            View Details
                        </button>
                        <button class="order-action-btn secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            Reorder
                        </button>
                    </div>
                </div>
            </div> -->


                <!-- <div class="empty-orders" style="display: none;">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                <h3>No Orders Yet</h3>
                <p>You haven't placed any orders yet. Start ordering your favorite meals!</p>
                <a href="menu.html" class="browse-menu">Browse Menu</a>
            </div> -->
            </div>
    </main>

    <!-- Order Details Modal -->
    <!-- <div class="modal" id="orderDetailsModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Order #FN78945612</h2>
                <button class="close-modal" onclick="closeOrderDetails()">&times;</button>
            </div>
            <div class="modal-body">
                <div class="order-info-section">
                    <h3 class="section-title">Order Information</h3>
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label">Order Date</div>
                            <div class="info-value">April 4, 2025 - 2:48 PM</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Status</div>
                            <div class="info-value">Delivered</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Payment Method</div>
                            <div class="info-value">MoMo</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Delivery Address</div>
                            <div class="info-value">123 Main Street, Apt 4B, District 1, Ho Chi Minh City</div>
                        </div>
                    </div>
                </div>

                <div class="order-items-list">
                    <h3 class="section-title">Order Items</h3>
                    <div class="order-item">
                        <div class="item-image">
                            <img src="/placeholder.svg?height=80&width=80" alt="Deluxe Cheeseburger">
                        </div>
                        <div class="item-details">
                            <div class="item-title">Deluxe Cheeseburger</div>
                            <div class="item-variant">Regular size, Extra cheese</div>
                            <div class="item-price">
                                <div class="price-amount">$12.99</div>
                                <div class="price-quantity">Quantity: 1</div>
                            </div>
                        </div>
                    </div>
                    <div class="order-item">
                        <div class="item-image">
                            <img src="/placeholder.svg?height=80&width=80" alt="French Fries">
                        </div>
                        <div class="item-details">
                            <div class="item-title">Large French Fries</div>
                            <div class="item-variant">Large size, Extra salt</div>
                            <div class="item-price">
                                <div class="price-amount">$4.99</div>
                                <div class="price-quantity">Quantity: 1</div>
                            </div>
                        </div>
                    </div>
                    <div class="order-item">
                        <div class="item-image">
                            <img src="/placeholder.svg?height=80&width=80" alt="Chocolate Shake">
                        </div>
                        <div class="item-details">
                            <div class="item-title">Chocolate Milkshake</div>
                            <div class="item-variant">Large size, Whipped cream</div>
                            <div class="item-price">
                                <div class="price-amount">$5.49</div>
                                <div class="price-quantity">Quantity: 1</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="order-summary-section">
                    <h3 class="section-title">Order Summary</h3>
                    <div class="summary-row">
                        <div class="summary-label">Subtotal</div>
                        <div class="summary-value">$23.47</div>
                    </div>
                    <div class="summary-row">
                        <div class="summary-label">Delivery Fee</div>
                        <div class="summary-value">$2.50</div>
                    </div>
                    <div class="summary-row">
                        <div class="summary-label">Discount</div>
                        <div class="summary-value">$0.00</div>
                    </div>
                    <div class="summary-divider"></div>
                    <div class="summary-row">
                        <div class="summary-label">Total</div>
                        <div class="summary-value summary-total">$25.97</div>
                    </div>
                </div>

                <div class="tracking-section">
                    <h3 class="section-title">Order Tracking</h3>
                    <div class="tracking-timeline">
                        <div class="timeline-item completed">
                            <div class="timeline-content">
                                <div class="timeline-title">Order Placed</div>
                                <div class="timeline-time">April 4, 2025 - 2:48 PM</div>
                            </div>
                        </div>
                        <div class="timeline-item completed">
                            <div class="timeline-content">
                                <div class="timeline-title">Order Confirmed</div>
                                <div class="timeline-time">April 4, 2025 - 2:50 PM</div>
                            </div>
                        </div>
                        <div class="timeline-item completed">
                            <div class="timeline-content">
                                <div class="timeline-title">Preparing Your Food</div>
                                <div class="timeline-time">April 4, 2025 - 2:55 PM</div>
                            </div>
                        </div>
                        <div class="timeline-item completed">
                            <div class="timeline-content">
                                <div class="timeline-title">Out for Delivery</div>
                                <div class="timeline-time">April 4, 2025 - 3:10 PM</div>
                            </div>
                        </div>
                        <div class="timeline-item completed">
                            <div class="timeline-content">
                                <div class="timeline-title">Delivered</div>
                                <div class="timeline-time">April 4, 2025 - 3:32 PM</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="modal-btn btn-secondary" onclick="closeOrderDetails()">Close</button>
                <button class="modal-btn btn-primary">Reorder</button>
            </div>
        </div>
    </div> -->

    <?php foreach ($orders as $order): ?>
        <?php
        $items = $paymentController->getOrderItemsByOrderId($order->getId());
        $modalId = 'orderDetailsModal_' . $order->getId();
        ?>
        <div class="modal" id="<?= $modalId ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Order #<?= htmlspecialchars($order->getId()) ?></h2>
                    <button class="close-modal" onclick="closeOrderDetails('<?= $modalId ?>')">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="order-info-section">
                        <h3 class="section-title">Thông tin đơn hàng </h3>
                        <div class="info-grid">
                            <div class="info-item">
                                <div class="info-label">Ngày đặt hàng </div>
                                <div class="info-value"><?= date("F j, Y - g:i A", strtotime($order->getCreatedAt())) ?>
                                </div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Trạng thái </div>
                                <div class="info-value"><?= ucfirst($order->getStatus()) ?></div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Phương thức thanh toán </div>
                                <div class="info-value">Thanh toán khi nhận hàng</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Địa chỉ giao hàng </div>
                                <div class="info-value"><?= htmlspecialchars($order->getDeliveryAddress()) ?></div>
                            </div>
                        </div>
                    </div>

                    <div class="order-items-list">
                        <h3 class="section-title">Sản phẩm </h3>
                        <?php foreach ($items as $item): ?>
                            <div class="order-item">
                                <div class="item-image">
                                    <img src="<?= htmlspecialchars($item['image_url']) ?>"
                                        alt="<?= htmlspecialchars($item['name']) ?>">
                                </div>
                                <div class="item-details">
                                    <div class="item-title"><?= htmlspecialchars($item['name']) ?></div>
                                    <div class="item-variant">Phần</div>
                                    <div class="item-price">
                                        <div class="price-amount"><?= number_format($item['price'], 0, ',', '.') ?> VND</div>

                                        <div class="price-quantity">Số lượng : <?= $item['quantity'] ?></div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="order-summary-section">
                        <h3 class="section-title">Hóa đơn</h3>
                        <div class="summary-row">
                            <div class="summary-label">Thành tiền</div>
                            <div class="summary-value summary-total"><?= number_format($item['price'], 0, ',', '.') ?> VND</div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="modal-btn btn-secondary" onclick="closeOrderDetails('<?= $modalId ?>')">Đóng </button>
                    <button class="modal-btn btn-primary reorder-btn"
                        data-order-id="<?= $order->getId() ?>"
                        data-items='<?= json_encode($items, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) ?>'>
                        Đặt hàng lại 
                    </button>
                </div>
            </div>
        </div>
    <?php endforeach; ?>


    <script>
        function openOrderDetails(orderId) {
            const modalId = 'orderDetailsModal_' + orderId;
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.style.display = 'block';
                document.body.style.overflow = 'hidden';
            }
        }

        function closeOrderDetails(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.style.display = 'none';
                document.body.style.overflow = 'auto';
            }
        }

        // Close modal when clicking outside of it
        window.onclick = function(event) {
            const modal = document.getElementById('orderDetailsModal');
            if (event.target === modal) {
                closeOrderDetails();
            }
        }
    </script>
</body>

</html>