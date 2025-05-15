<!-- <?php
        // require(dirname(__DIR__) . "../../controller/user.controller.php");


        // $userController = new UserController();


        // $addresses = $userController->getDeliveryAddress();
        // 
        ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feane - Shopping Cart</title>
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

        .cart-container {
            display: grid;
            grid-template-columns: 1fr 350px;
            gap: 30px;
        }

        .cart-items {
            background-color: #191919;
            border-radius: 10px;
            padding: 20px;
        }

        .cart-item {
            display: flex;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #333;
        }

        .cart-item:last-child {
            border-bottom: none;
        }

        .item-image {
            width: 80px;
            height: 80px;
            border-radius: 8px;
            overflow: hidden;
            margin-right: 15px;
            flex-shrink: 0;
        }

        .item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .item-details {
            flex: 1;
        }

        .item-name {
            font-weight: 500;
            font-size: 18px;
            margin-bottom: 5px;
        }

        .item-price {
            color: #ffbe33;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .item-actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .quantity-control {
            display: flex;
            align-items: center;
            background-color: #2c2c2c;
            border-radius: 5px;
            overflow: hidden;
        }

        .quantity-btn {
            background: none;
            border: none;
            color: #ffffff;
            width: 30px;
            height: 30px;
            font-size: 16px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .quantity-btn:hover {
            background-color: #3a3a3a;
        }

        .quantity-input {
            width: 40px;
            height: 30px;
            border: none;
            background-color: #2c2c2c;
            color: #ffffff;
            text-align: center;
            font-size: 14px;
        }

        .quantity-input:focus {
            outline: none;
        }

        .remove-btn {
            background: none;
            border: none;
            color: #ff6b6b;
            cursor: pointer;
            font-size: 14px;
            display: flex;
            align-items: center;
        }

        .remove-btn svg {
            margin-right: 5px;
            width: 16px;
            height: 16px;
        }

        .remove-btn:hover {
            text-decoration: underline;
        }

        .cart-summary {
            background-color: #191919;
            border-radius: 10px;
            padding: 20px;
            position: sticky;
            top: 100px;
        }

        .summary-title {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #333;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            font-size: 15px;
        }

        .summary-row.discount {
            color: #4cd964;
        }

        .summary-row.total {
            font-size: 18px;
            font-weight: 600;
            color: #ffbe33;
            padding-top: 15px;
            margin-top: 15px;
            border-top: 1px solid #333;
        }

        .promo-code {
            margin: 20px 0;
            padding-top: 15px;
            border-top: 1px dashed #333;
        }

        .promo-title {
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 10px;
        }

        .promo-form {
            display: flex;
            gap: 10px;
        }

        .promo-input {
            flex: 1;
            padding: 10px 15px;
            background-color: #2c2c2c;
            border: none;
            border-radius: 5px;
            color: #ffffff;
            font-size: 14px;
        }

        .promo-input:focus {
            outline: 2px solid #ffbe33;
        }

        .promo-btn {
            padding: 10px 15px;
            background-color: #ffbe33;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s;
            white-space: nowrap;
        }

        .promo-btn:hover {
            background-color: #e69c00;
        }

        .promo-message {
            margin-top: 8px;
            font-size: 13px;
        }

        .promo-success {
            color: #4cd964;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .promo-error {
            color: #ff6b6b;
        }

        .payment-methods {
            margin-top: 25px;
        }

        .payment-title {
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 15px;
        }

        .payment-options {
            display: grid;
            gap: 10px;
            margin-bottom: 25px;
        }

        .payment-option {
            position: relative;
            border-radius: 5px;
            overflow: hidden;
        }

        .payment-option input {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .payment-option label {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            background-color: #2c2c2c;
            cursor: pointer;
            transition: background-color 0.3s;
            border: 2px solid transparent;
        }

        .payment-option input:checked+label {
            border-color: #ffbe33;
            background-color: #3a3a3a;
        }

        .payment-option label:hover {
            background-color: #3a3a3a;
        }

        .payment-option .payment-logo {
            width: 30px;
            height: 30px;
            margin-right: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .payment-option .payment-logo img {
            max-width: 100%;
            max-height: 100%;
        }

        .payment-option .payment-logo svg {
            width: 24px;
            height: 24px;
        }

        .checkout-btn {
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

        .checkout-btn:hover {
            background-color: #e69c00;
        }

        .empty-cart {
            text-align: center;
            padding: 40px 20px;
        }

        .empty-cart svg {
            width: 80px;
            height: 80px;
            color: #666;
            margin-bottom: 20px;
        }

        .empty-cart h3 {
            font-size: 24px;
            margin-bottom: 15px;
        }

        .empty-cart p {
            color: #999;
            margin-bottom: 25px;
        }

        .continue-shopping {
            display: inline-block;
            padding: 10px 25px;
            background-color: #ffbe33;
            color: #ffffff;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 500;
            transition: background-color 0.3s;
        }

        .continue-shopping:hover {
            background-color: #e69c00;
        }

        @media (max-width: 992px) {
            .cart-container {
                grid-template-columns: 1fr;
            }

            .cart-summary {
                position: static;
            }
        }

        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .item-actions {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .remove-btn {
                margin-left: 0;
            }
        }

        @media (max-width: 576px) {
            .cart-item {
                flex-direction: column;
                align-items: flex-start;
            }

            .item-image {
                margin-right: 0;
                margin-bottom: 15px;
            }

            .item-details {
                width: 100%;
            }
        }

        .delivery-address {
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px dashed #333;
        }

        .address-title {
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 15px;
        }

        .address-options {
            display: grid;
            gap: 10px;
            margin-bottom: 15px;
        }

        .address-option {
            position: relative;
            border-radius: 5px;
            overflow: hidden;
        }

        .address-option input {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .address-option label {
            display: block;
            padding: 12px 15px;
            background-color: #2c2c2c;
            cursor: pointer;
            transition: background-color 0.3s;
            border: 2px solid transparent;
            border-radius: 5px;
        }

        .address-option input:checked+label {
            border-color: #ffbe33;
            background-color: #3a3a3a;
        }

        .address-option label:hover {
            background-color: #3a3a3a;
        }

        .address-details {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .address-name {
            font-weight: 500;
            font-size: 15px;
        }

        .address-text {
            font-size: 13px;
            color: #ccc;
        }

        .address-phone {
            font-size: 13px;
            color: #ccc;
        }

        .add-new-address {
            margin-top: 5px;
        }

        .add-address-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            padding: 10px;
            background-color: #2c2c2c;
            color: #ffbe33;
            border: 1px dashed #ffbe33;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .add-address-btn:hover {
            background-color: #3a3a3a;
        }

        .address-form {
            margin-top: 15px;
            padding: 15px;
            background-color: #2c2c2c;
            border-radius: 5px;
        }

        .form-group {
            margin-bottom: 12px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
        }

        .form-input {
            width: 100%;
            padding: 10px;
            background-color: #191919;
            border: 1px solid #333;
            border-radius: 5px;
            color: #ffffff;
            font-size: 14px;
        }

        .form-input:focus {
            outline: none;
            border-color: #ffbe33;
        }

        textarea.form-input {
            min-height: 80px;
            resize: vertical;
        }

        .form-actions {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }

        .cancel-btn {
            flex: 1;
            padding: 10px;
            background-color: #3a3a3a;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
        }

        .save-btn {
            flex: 1;
            padding: 10px;
            background-color: #ffbe33;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
        }

        .cancel-btn:hover {
            background-color: #444;
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
                <a href="#" class="btn-order">ĐẶT HÀNG NGAY</a>
            </nav>
        </div>
    </header>

    <main class="main-container">
        <div class="container">
            <div class="page-title">
                <h1>Your Cart</h1>
            </div>

            <div class="cart-container" id="cart-container">
                <div class="cart-items" id="cart-items">
                    <div class="cart-item">
                        <div class="item-image">
                            <img src="/placeholder.svg?height=80&width=80" alt="Cheeseburger">
                        </div>
                        <div class="item-details">
                            <div class="item-name">Deluxe Cheeseburger</div>
                            <div class="item-price">$12.99</div>
                            <div class="item-actions">
                                <div class="quantity-control">
                                    <button class="quantity-btn decrease-btn" onclick="updateQuantity(1, -1)">-</button>
                                    <input type="number" class="quantity-input" value="1" min="1" max="10"
                                        data-item-id="1" onchange="updateQuantityInput(1, this.value)">
                                    <button class="quantity-btn increase-btn" onclick="updateQuantity(1, 1)">+</button>
                                </div>
                                <button class="remove-btn" onclick="removeItem(1)">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Remove
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="cart-item">
                        <div class="item-image">
                            <img src="/placeholder.svg?height=80&width=80" alt="French Fries">
                        </div>
                        <div class="item-details">
                            <div class="item-name">Large French Fries</div>
                            <div class="item-price">$4.99</div>
                            <div class="item-actions">
                                <div class="quantity-control">
                                    <button class="quantity-btn decrease-btn" onclick="updateQuantity(2, -1)">-</button>
                                    <input type="number" class="quantity-input" value="1" min="1" max="10"
                                        data-item-id="2" onchange="updateQuantityInput(2, this.value)">
                                    <button class="quantity-btn increase-btn" onclick="updateQuantity(2, 1)">+</button>
                                </div>
                                <button class="remove-btn" onclick="removeItem(2)">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Remove
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="cart-item">
                        <div class="item-image">
                            <img src="/placeholder.svg?height=80&width=80" alt="Chocolate Shake">
                        </div>
                        <div class="item-details">
                            <div class="item-name">Chocolate Milkshake</div>
                            <div class="item-price">$5.49</div>
                            <div class="item-actions">
                                <div class="quantity-control">
                                    <button class="quantity-btn decrease-btn" onclick="updateQuantity(3, -1)">-</button>
                                    <input type="number" class="quantity-input" value="1" min="1" max="10"
                                        data-item-id="3" onchange="updateQuantityInput(3, this.value)">
                                    <button class="quantity-btn increase-btn" onclick="updateQuantity(3, 1)">+</button>
                                </div>
                                <button class="remove-btn" onclick="removeItem(3)">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Remove
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="cart-summary" id="cart-summary">
                    <h2 class="summary-title">Order Summary</h2>

                    <div class="summary-row">
                        <span>Subtotal</span>
                        <span id="subtotal">$23.47</span>
                    </div>

                    <div class="summary-row">
                        <span>Delivery Fee</span>
                        <span id="delivery-fee">$2.50</span>
                    </div>

                    <div class="promo-code">
                        <div class="promo-title">Promotional Code</div>
                        <div class="promo-form">
                            <input type="text" class="promo-input" id="promo-input" placeholder="Enter code">
                            <button class="promo-btn" onclick="applyPromoCode()">Apply</button>
                        </div>
                        <div class="promo-message" id="promo-message"></div>
                    </div>

                    <div class="summary-row discount" id="discount-row" style="display: none;">
                        <span>Discount</span>
                        <span id="discount-amount">-$0.00</span>
                    </div>

                    <div class="summary-row total">
                        <span>Total</span>
                        <span id="total">$25.97</span>
                    </div>
                    <div class="delivery-address">
                        <h3 class="address-title">Delivery Address</h3>

                        <div class="address-options">
                            <?php foreach ($addresses as $index => $address): ?>
                                <div class="address-option">
                                    <input type="radio" name="address" id="address<?= $index ?>"
                                        value="<?= htmlspecialchars($address['id']) ?>" <?= $index === 0 ? 'checked' : '' ?>>
                                    <label for="address<?= $index ?>">
                                        <div class="address-details">
                                            <div class="address-name"><?= htmlspecialchars($address['address_name']) ?>
                                            </div>
                                            <div class="address-text"><?= htmlspecialchars($address['address']) ?></div>
                                            <div class="address-phone"><?= htmlspecialchars($address['phone']) ?></div>
                                            <div class="address-id hidden"><?= htmlspecialchars($address['id']) ?></div>
                                        </div>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                          
                            <div class="add-new-address">
                                <button class="add-address-btn" onclick="showAddAddressForm()">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" width="18" height="18">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4" />
                                    </svg>
                                    Add New Address
                                </button>
                            </div>
                        </div>

                        <div class="address-form" id="address-form" style="display: none;">
                            <div class="form-group">
                                <label for="address-name">Address Name</label>
                                <input type="text" id="address-name" class="form-input"
                                    placeholder="Home, Office, etc.">
                            </div>
                            <div class="form-group">
                                <label for="address-full">Full Address</label>
                                <textarea id="address-full" class="form-input"
                                    placeholder="Street, Building, District, City"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="address-phone">Phone Number</label>
                                <input type="text" id="address-phone" class="form-input" placeholder="+84 123 456 789">
                            </div>
                            <div class="form-actions">
                                <button class="cancel-btn" onclick="hideAddAddressForm()">Cancel</button>
                                <button class="save-btn" onclick="saveNewAddress()">Save Address</button>
                            </div>
                        </div>
                    </div>
                    <div class="payment-methods">
                        <h3 class="payment-title">Payment Method</h3>

                        <div class="payment-options">
                            <div class="payment-option">
                                <input type="radio" name="payment" id="momo" value="momo" checked>
                                <label for="momo">
                                    <div class="payment-logo">
                                        <svg viewBox="0 0 24 24" fill="#ae2070" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z" />
                                            <path
                                                d="M12 6c-3.31 0-6 2.69-6 6s2.69 6 6 6 6-2.69 6-6-2.69-6-6-6zm0 10c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4z" />
                                        </svg>
                                    </div>
                                    MoMo
                                </label>
                            </div>

                            <div class="payment-option">
                                <input type="radio" name="payment" id="paypal" value="paypal">
                                <label for="paypal">
                                    <div class="payment-logo">
                                        <svg viewBox="0 0 24 24" fill="#0070ba" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M20.067 8.478c.492.315.844.897.844 1.553 0 .975-.593 1.77-1.496 2.08-.903.31-2.162.31-3.065 0-.903-.31-1.496-1.105-1.496-2.08 0-.656.352-1.238.844-1.553.492-.315 1.14-.315 1.632 0 .492.315.844.897.844 1.553 0 .656-.352 1.238-.844 1.553-.492.315-1.14.315-1.632 0-.492-.315-.844-.897-.844-1.553M3.089 8.478c.492.315.844.897.844 1.553 0 .975-.593 1.77-1.496 2.08-.903.31-2.162.31-3.065 0-.903-.31-1.496-1.105-1.496-2.08 0-.656.352-1.238.844-1.553.492-.315 1.14-.315 1.632 0 .492.315.844.897.844 1.553 0 .656-.352 1.238-.844 1.553-.492.315-1.14.315-1.632 0-.492-.315-.844-.897-.844-1.553" />
                                        </svg>
                                    </div>
                                    PayPal
                                </label>
                            </div>

                            <div class="payment-option">
                                <input type="radio" name="payment" id="cod" value="cod">
                                <label for="cod">
                                    <div class="payment-logo">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="#ffbe33">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    Cash on Delivery
                                </label>
                            </div>
                        </div>
                    </div>

                    <button class="checkout-btn" onclick="checkout()">Proceed to Checkout</button>
                </div>
            </div>

            <div class="empty-cart" id="empty-cart" style="display: none;">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <h3>Your cart is empty</h3>
                <p>Looks like you haven't added any items to your cart yet.</p>
                <a href="/duanweb2" class="continue-shopping">Continue Shopping</a>
            </div>
        </div>
        <div id="app-data" data-user-id="<?= htmlspecialchars($_SESSION['user_id'] ?? '') ?>"
            data-products='<?= isset($products) ? json_encode($products, JSON_HEX_APOS | JSON_HEX_QUOT) : "null" ?>'
            style="display: none;">
        </div>
    </main>

</body>

</html> -->


<?php
require(dirname(__DIR__) . "../../controller/user.controller.php");

$userController = new UserController();
$addresses = $userController->getDeliveryAddress();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feane - Shopping Cart</title>
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

        /* Checkout Steps */
        .checkout-steps {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
        }

        .step {
            display: flex;
            align-items: center;
            margin: 0 15px;
            position: relative;
        }

        .step:not(:last-child):after {
            content: '';
            position: absolute;
            right: -30px;
            top: 50%;
            width: 30px;
            height: 2px;
            background-color: #333;
            transform: translateY(-50%);
        }

        .step.active:not(:last-child):after {
            background-color: #ffbe33;
        }

        .step-number {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #333;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            font-weight: 500;
        }

        .step.active .step-number {
            background-color: #ffbe33;
        }

        .step-label {
            font-size: 16px;
            color: #ccc;
        }

        .step.active .step-label {
            color: #ffbe33;
            font-weight: 500;
        }

        .cart-container {
            display: grid;
            grid-template-columns: 1fr;
            gap: 30px;
        }

        .cart-container.payment-stage {
            /* grid-template-columns: 1fr 350px; */
        }

        .cart-items {
            background-color: #191919;
            border-radius: 10px;
            padding: 20px;
        }

        .cart-item {
            display: flex;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #333;
        }

        .cart-item:last-child {
            border-bottom: none;
        }

        .item-image {
            width: 80px;
            height: 80px;
            border-radius: 8px;
            overflow: hidden;
            margin-right: 15px;
            flex-shrink: 0;
        }

        .item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .item-details {
            flex: 1;
        }

        .item-name {
            font-weight: 500;
            font-size: 18px;
            margin-bottom: 5px;
        }

        .item-price {
            color: #ffbe33;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .item-actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .quantity-control {
            display: flex;
            align-items: center;
            background-color: #2c2c2c;
            border-radius: 5px;
            overflow: hidden;
        }

        .quantity-btn {
            background: none;
            border: none;
            color: #ffffff;
            width: 30px;
            height: 30px;
            font-size: 16px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .quantity-btn:hover {
            background-color: #3a3a3a;
        }

        .quantity-input {
            width: 40px;
            height: 30px;
            border: none;
            background-color: #2c2c2c;
            color: #ffffff;
            text-align: center;
            font-size: 14px;
        }

        .quantity-input:focus {
            outline: none;
        }

        .remove-btn {
            background: none;
            border: none;
            color: #ff6b6b;
            cursor: pointer;
            font-size: 14px;
            display: flex;
            align-items: center;
        }

        .remove-btn svg {
            margin-right: 5px;
            width: 16px;
            height: 16px;
        }

        .remove-btn:hover {
            text-decoration: underline;
        }

        .cart-summary {
            background-color: #191919;
            border-radius: 10px;
            padding: 20px;
            position: sticky;
            top: 100px;
            display: none;
        }

        .payment-stage .cart-summary {
            display: block;
        }

        .summary-title {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #333;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            font-size: 15px;
        }

        .summary-row.discount {
            color: #4cd964;
        }

        .summary-row.total {
            font-size: 18px;
            font-weight: 600;
            color: #ffbe33;
            padding-top: 15px;
            margin-top: 15px;
            border-top: 1px solid #333;
        }

        .promo-code {
            margin: 20px 0;
            padding-top: 15px;
            border-top: 1px dashed #333;
        }

        .promo-title {
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 10px;
        }

        .promo-form {
            display: flex;
            gap: 10px;
        }

        .promo-input {
            flex: 1;
            padding: 10px 15px;
            background-color: #2c2c2c;
            border: none;
            border-radius: 5px;
            color: #ffffff;
            font-size: 14px;
        }

        .promo-input:focus {
            outline: 2px solid #ffbe33;
        }

        .promo-btn {
            padding: 10px 15px;
            background-color: #ffbe33;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s;
            white-space: nowrap;
        }

        .promo-btn:hover {
            background-color: #e69c00;
        }

        .promo-message {
            margin-top: 8px;
            font-size: 13px;
        }

        .promo-success {
            color: #4cd964;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .promo-error {
            color: #ff6b6b;
        }

        .payment-methods {
            margin-top: 25px;
        }

        .payment-title {
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 15px;
        }

        .payment-options {
            display: grid;
            gap: 10px;
            margin-bottom: 25px;
        }

        .payment-option {
            position: relative;
            border-radius: 5px;
            overflow: hidden;
        }

        .payment-option input {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .payment-option label {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            background-color: #2c2c2c;
            cursor: pointer;
            transition: background-color 0.3s;
            border: 2px solid transparent;
        }

        .payment-option input:checked+label {
            border-color: #ffbe33;
            background-color: #3a3a3a;
        }

        .payment-option label:hover {
            background-color: #3a3a3a;
        }

        .payment-option .payment-logo {
            width: 30px;
            height: 30px;
            margin-right: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .payment-option .payment-logo img {
            max-width: 100%;
            max-height: 100%;
        }

        .payment-option .payment-logo svg {
            width: 24px;
            height: 24px;
        }

        .checkout-btn,
        .continue-btn {
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
            margin-top: 20px;
        }

        .checkout-btn:hover,
        .continue-btn:hover {
            background-color: #e69c00;
        }

        .empty-cart {
            text-align: center;
            padding: 40px 20px;
        }

        .empty-cart svg {
            width: 80px;
            height: 80px;
            color: #666;
            margin-bottom: 20px;
        }

        .empty-cart h3 {
            font-size: 24px;
            margin-bottom: 15px;
        }

        .empty-cart p {
            color: #999;
            margin-bottom: 25px;
        }

        .continue-shopping {
            display: inline-block;
            padding: 10px 25px;
            background-color: #ffbe33;
            color: #ffffff;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 500;
            transition: background-color 0.3s;
        }

        .continue-shopping:hover {
            background-color: #e69c00;
        }

        .delivery-address {
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px dashed #333;
        }

        .address-title {
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 15px;
        }

        .address-options {
            display: grid;
            gap: 10px;
            margin-bottom: 15px;
        }

        .address-option {
            position: relative;
            border-radius: 5px;
            overflow: hidden;
        }

        .address-option input {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .address-option label {
            display: block;
            padding: 12px 15px;
            background-color: #2c2c2c;
            cursor: pointer;
            transition: background-color 0.3s;
            border: 2px solid transparent;
            border-radius: 5px;
        }

        .address-option input:checked+label {
            border-color: #ffbe33;
            background-color: #3a3a3a;
        }

        .address-option label:hover {
            background-color: #3a3a3a;
        }

        .address-details {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .address-name {
            font-weight: 500;
            font-size: 15px;
        }

        .address-text {
            font-size: 13px;
            color: #ccc;
        }

        .address-phone {
            font-size: 13px;
            color: #ccc;
        }

        .add-new-address {
            margin-top: 5px;
        }

        .add-address-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            padding: 10px;
            background-color: #2c2c2c;
            color: #ffbe33;
            border: 1px dashed #ffbe33;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .add-address-btn:hover {
            background-color: #3a3a3a;
        }

        .address-form {
            margin-top: 15px;
            padding: 15px;
            background-color: #2c2c2c;
            border-radius: 5px;
        }

        .form-group {
            margin-bottom: 12px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
        }

        .form-input {
            width: 100%;
            padding: 10px;
            background-color: #191919;
            border: 1px solid #333;
            border-radius: 5px;
            color: #ffffff;
            font-size: 14px;
        }

        .form-input:focus {
            outline: none;
            border-color: #ffbe33;
        }

        textarea.form-input {
            min-height: 80px;
            resize: vertical;
        }

        .form-actions {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }

        .cancel-btn {
            flex: 1;
            padding: 10px;
            background-color: #3a3a3a;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
        }

        .save-btn {
            flex: 1;
            padding: 10px;
            background-color: #ffbe33;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
        }

        .cancel-btn:hover {
            background-color: #444;
        }

        /* Hide quantity controls in payment stage */
        .payment-stage .item-actions .quantity-control {
            display: none;
        }

        .payment-stage .item-actions .remove-btn {
            display: none;
        }

        /* Show quantity text in payment stage */
        .item-quantity {
            display: none;
            color: #ccc;
            font-size: 14px;
        }

        .payment-stage .item-quantity {
            display: block;
        }

        /* Back button for payment stage */
        .cart-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #333;
        }

        .back-btn {
            display: flex;
            align-items: center;
            gap: 5px;
            background: none;
            border: none;
            color: #ffbe33;
            font-size: 14px;
            cursor: pointer;
            padding: 5px 10px;
            border-radius: 4px;
            transition: background-color 0.2s;
        }

        .back-btn:hover {
            background-color: rgba(255, 190, 51, 0.1);
        }

        .back-btn svg {
            width: 16px;
            height: 16px;
        }

        /* Hide back button in cart stage */
        .back-btn {
            display: none;
        }

        .payment-stage .back-btn {
            display: flex;
        }

        /* Hide continue button in payment stage */
        .payment-stage .continue-btn {
            display: none;
        }

        /* Hide checkout button in cart stage */
        .checkout-btn {
            display: none;
        }

        .payment-stage .checkout-btn {
            display: block;
        }

        @media (max-width: 992px) {
            .cart-container.payment-stage {
                grid-template-columns: 1fr;
            }

            .cart-summary {
                position: static;
            }
        }

        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .item-actions {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .remove-btn {
                margin-left: 0;
            }
        }

        @media (max-width: 576px) {
            .cart-item {
                flex-direction: column;
                align-items: flex-start;
            }

            .item-image {
                margin-right: 0;
                margin-bottom: 15px;
            }

            .item-details {
                width: 100%;
            }

            .checkout-steps {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .step:not(:last-child):after {
                display: none;
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
                <h1>Giỏ hàng</h1>
            </div>

            <!-- Checkout Steps -->
            <div class="checkout-steps">
                <div class="step active" id="cart-step">
                    <div class="step-number">1</div>
                    <div class="step-label">Giỏ hàng</div>
                </div>
                <div class="step" id="payment-step">
                    <div class="step-number">2</div>
                    <div class="step-label">Thanh toán</div>
                </div>
            </div>

            <div class="cart-container" id="cart-container">
                <div class="cart-header">
                    <button class="back-btn" id="back-btn" onclick="goToCartStage()">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        Quay lại giỏ hàng
                    </button>
                </div>

                <div class="cart-items" id="cart-items">
                    <div class="cart-item">
                        <div class="item-image">
                            <img src="/placeholder.svg?height=80&width=80" alt="Cheeseburger">
                        </div>
                        <div class="item-details">
                            <div class="item-name">Deluxe Cheeseburger</div>
                            <div class="item-price">$12.99</div>
                            <div class="item-quantity">Quantity: 1</div>
                            <div class="item-actions">
                                <div class="quantity-control">
                                    <button class="quantity-btn decrease-btn" onclick="updateQuantity(1, -1)">-</button>
                                    <input type="number" class="quantity-input" value="1" min="1" max="10"
                                        data-item-id="1" onchange="updateQuantityInput(1, this.value)">
                                    <button class="quantity-btn increase-btn" onclick="updateQuantity(1, 1)">+</button>
                                </div>
                                <button class="remove-btn" onclick="removeItem(1)">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Xóa
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="cart-item">
                        <div class="item-image">
                            <img src="/placeholder.svg?height=80&width=80" alt="French Fries">
                        </div>
                        <div class="item-details">
                            <div class="item-name">Large French Fries</div>
                            <div class="item-price">$4.99</div>
                            <div class="item-quantity">Quantity: 1</div>
                            <div class="item-actions">
                                <div class="quantity-control">
                                    <button class="quantity-btn decrease-btn" onclick="updateQuantity(2, -1)">-</button>
                                    <input type="number" class="quantity-input" value="1" min="1" max="10"
                                        data-item-id="2" onchange="updateQuantityInput(2, this.value)">
                                    <button class="quantity-btn increase-btn" onclick="updateQuantity(2, 1)">+</button>
                                </div>
                                <button class="remove-btn" onclick="removeItem(2)">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Xóa
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="cart-item">
                        <div class="item-image">
                            <img src="/placeholder.svg?height=80&width=80" alt="Chocolate Shake">
                        </div>
                        <div class="item-details">
                            <div class="item-name">Chocolate Milkshake</div>
                            <div class="item-price">$5.49</div>
                            <div class="item-quantity">Quantity: 1</div>
                            <div class="item-actions">
                                <div class="quantity-control">
                                    <button class="quantity-btn decrease-btn" onclick="updateQuantity(3, -1)">-</button>
                                    <input type="number" class="quantity-input" value="1" min="1" max="10"
                                        data-item-id="3" onchange="updateQuantityInput(3, this.value)">
                                    <button class="quantity-btn increase-btn" onclick="updateQuantity(3, 1)">+</button>
                                </div>
                                <button class="remove-btn" onclick="removeItem(3)">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Xóa
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="cart-summary" id="cart-summary">
                    <h2 class="summary-title">Tóm tắt đơn hàng</h2>

                    <div class="summary-row">
                        <span>Tổng phụ</span>
                        <span id="subtotal">$23.47</span>
                    </div>

                    <div class="summary-row">
                        <span>Phí giao hàng</span>
                        <span id="delivery-fee">$2.50</span>
                    </div>

                    <div class="summary-row">
                        <span>Thuế suất</span>
                        <span id="tax-rate">$2.50</span>
                    </div>
                    
                    <div class="summary-row">
                        <span>Phí thuế</span>
                        <span id="tax-fee">$2.50</span>
                    </div>

                    

                    <div class="promo-code">
                        <div class="promo-title">Mã giảm giá</div>
                        <div class="promo-form">
                            <input type="text" class="promo-input" id="promo-input" placeholder="Nhập mã giảm giá">
                            <button class="promo-btn" onclick="applyPromoCode()">Áp dụng</button>
                        </div>
                        <div class="promo-message" id="promo-message"></div>
                    </div>

                    <div class="summary-row discount" id="discount-row" style="display: none;">
                        <span>Discount</span>
                        <span id="discount-amount">-$0.00</span>
                    </div>

                    <div class="summary-row total">
                        <span>Thành tiền</span>
                        <span id="total">$25.97</span>
                    </div>
                    <div class="delivery-address">
                        <h3 class="address-title">Địa chỉ giao hàng</h3>

                        <div class="address-options">
                            <?php foreach ($addresses as $index => $address): ?>
                                <div class="address-option">
                                    <input type="radio" name="address" id="address<?= $index ?>"
                                        value="<?= htmlspecialchars($address['id']) ?>" <?= $index === 0 ? 'checked' : '' ?>>
                                    <label for="address<?= $index ?>">
                                        <div class="address-details">
                                            <div class="address-name"><?= htmlspecialchars($address['address_name']) ?>
                                            </div>
                                            <div class="address-text"><?= htmlspecialchars($address['address']) ?></div>
                                            <div class="address-phone"><?= htmlspecialchars($address['phone']) ?></div>
                                            <div class="address-id hidden"><?= htmlspecialchars($address['id']) ?></div>
                                        </div>
                                    </label>
                                </div>
                            <?php endforeach; ?>

                            <div class="add-new-address">
                                <button class="add-address-btn" onclick="showAddAddressForm()">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" width="18" height="18">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4" />
                                    </svg>
                                    Thêm địa chỉ mới
                                </button>
                            </div>
                        </div>

                        <div class="address-form" id="address-form" style="display: none;">
                            <div class="form-group">
                                <label for="address-name">Tên nhà riêng/văn phòng</label>
                                <input type="text" id="address-name" class="form-input"
                                    placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="address-full">Địa chỉ</label>
                                <textarea id="address-full" class="form-input"
                                    placeholder=""></textarea>
                            </div>
                            <div class="form-group">
                                <label for="address-phone">Số điện thoại</label>
                                <input type="text" id="address-phone" class="form-input" placeholder="">
                            </div>
                            <div class="form-actions">
                                <button class="cancel-btn" onclick="hideAddAddressForm()">Hủy</button>
                                <button class="save-btn" onclick="saveNewAddress()">Lưu địa chỉ</button>
                            </div>
                        </div>
                    </div>
                    <div class="payment-methods">
                        <h3 class="payment-title">Phương thức thanh toán</h3>

                        <div class="payment-options">
                            <div class="payment-option">
                                <input type="radio" name="payment" id="momo" value="momo" checked>
                                <label for="momo">
                                    <div class="payment-logo">
                                        <svg viewBox="0 0 24 24" fill="#ae2070" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z" />
                                            <path
                                                d="M12 6c-3.31 0-6 2.69-6 6s2.69 6 6 6 6-2.69 6-6-2.69-6-6-6zm0 10c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4z" />
                                        </svg>
                                    </div>
                                    MoMo
                                </label>
                            </div>

                            <div class="payment-option">
                                <input type="radio" name="payment" id="paypal" value="paypal">
                                <label for="paypal">
                                    <div class="payment-logo">
                                        <svg viewBox="0 0 24 24" fill="#0070ba" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M20.067 8.478c.492.315.844.897.844 1.553 0 .975-.593 1.77-1.496 2.08-.903.31-2.162.31-3.065 0-.903-.31-1.496-1.105-1.496-2.08 0-.656.352-1.238.844-1.553.492-.315 1.14-.315 1.632 0 .492.315.844.897.844 1.553 0 .656-.352 1.238-.844 1.553-.492.315-1.14.315-1.632 0-.492-.315-.844-.897-.844-1.553M3.089 8.478c.492.315.844.897.844 1.553 0 .975-.593 1.77-1.496 2.08-.903.31-2.162.31-3.065 0-.903-.31-1.496-1.105-1.496-2.08 0-.656.352-1.238.844-1.553.492-.315 1.14-.315 1.632 0 .492.315.844.897.844 1.553 0 .656-.352 1.238-.844 1.553-.492.315-1.14.315-1.632 0-.492-.315-.844-.897-.844-1.553" />
                                        </svg>
                                    </div>
                                    PayPal
                                </label>
                            </div>

                            <div class="payment-option">
                                <input type="radio" name="payment" id="cod" value="cod">
                                <label for="cod">
                                    <div class="payment-logo">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="#ffbe33">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    Thanh toán khi nhận hàng
                                </label>
                            </div>
                        </div>
                    </div>

                    <button class="checkout-btn" onclick="checkout()">Tiến hành thanh toán</button>
                </div>

                <!-- Continue to Payment button (visible only in cart stage) -->
                <button class="continue-btn" id="continue-btn" onclick="goToPaymentStage()">Thanh toán</button>
            </div>

            <div class="empty-cart" id="empty-cart" style="display: none;">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <h3>Giỏ hàng trống</h3>
                <a href="/duanweb2" class="continue-shopping">Tiếp tục mua hàng</a>
            </div>
        </div>
        <div id="app-data" data-user-id="<?= htmlspecialchars($_SESSION['user_id'] ?? '') ?>"
            data-products='<?= isset($products) ? json_encode($products, JSON_HEX_APOS | JSON_HEX_QUOT) : "null" ?>'
            style="display: none;">
        </div>
    </main>


</body>

</html>