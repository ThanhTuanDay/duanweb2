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
                <h1>Your Cart</h1>
            </div>

            <div class="cart-container" id="cart-container">
                <div class="cart-items">
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

                <div class="cart-summary">
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
                <a href="#" class="continue-shopping">Continue Shopping</a>
            </div>
        </div>
    </main>

    <script>

        const cartItems = [
            { id: 1, name: "Deluxe Cheeseburger", price: 12.99, quantity: 1 },
            { id: 2, name: "Large French Fries", price: 4.99, quantity: 1 },
            { id: 3, name: "Chocolate Milkshake", price: 5.49, quantity: 1 }
        ];

        const deliveryFee = 2.50;
        let discountAmount = 0;
        let discountCode = "";

        const promoCodes = {
            "WELCOME10": { type: "percentage", value: 10 },
            "FEANE20": { type: "percentage", value: 20 },
            "FREESHIP": { type: "shipping", value: deliveryFee },
            "5DOLLAROFF": { type: "fixed", value: 5 }
        };


        function applyPromoCode() {
            const promoInput = document.getElementById('promo-input');
            const promoMessage = document.getElementById('promo-message');
            const code = promoInput.value.trim().toUpperCase();

            if (code === "") {
                promoMessage.textContent = "Please enter a promotional code";
                promoMessage.className = "promo-message promo-error";
                return;
            }

            if (promoCodes[code]) {
                const promo = promoCodes[code];
                discountCode = code;

                if (promo.type === "percentage") {
                    const subtotal = cartItems.reduce((total, item) => total + (item.price * item.quantity), 0);
                    discountAmount = (subtotal * promo.value / 100).toFixed(2);
                    promoMessage.innerHTML = `<span class="promo-success"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg> ${promo.value}% discount applied</span>`;
                } else if (promo.type === "shipping") {
                    discountAmount = promo.value.toFixed(2);
                    promoMessage.innerHTML = `<span class="promo-success"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg> Free shipping applied</span>`;
                } else if (promo.type === "fixed") {
                    discountAmount = promo.value.toFixed(2);
                    promoMessage.innerHTML = `<span class="promo-success"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg> $${promo.value} discount applied</span>`;
                }

                document.getElementById('discount-row').style.display = "flex";
                document.getElementById('discount-amount').textContent = `-$${discountAmount}`;

                updateCart();
            } else {
                promoMessage.textContent = "Invalid promotional code";
                promoMessage.className = "promo-message promo-error";
                discountAmount = 0;
                discountCode = "";
                document.getElementById('discount-row').style.display = "none";
                updateCart();
            }
        }

        function updateQuantity(itemId, change) {
            const item = cartItems.find(item => item.id === itemId);
            if (item) {
                const newQuantity = item.quantity + change;
                if (newQuantity >= 1 && newQuantity <= 10) {
                    item.quantity = newQuantity;
                    updateCart();

                    const input = document.querySelector(`.quantity-input[data-item-id="${itemId}"]`);
                    if (input) {
                        input.value = newQuantity;
                    }
                }
            }
        }

        function updateQuantityInput(itemId, value) {
            const quantity = parseInt(value);
            if (quantity >= 1 && quantity <= 10) {
                const item = cartItems.find(item => item.id === itemId);
                if (item) {
                    item.quantity = quantity;
                    updateCart();
                }
            }
        }

        function removeItem(itemId) {
            const index = cartItems.findIndex(item => item.id === itemId);
            if (index !== -1) {
                cartItems.splice(index, 1);
                const itemElement = document.querySelector(`.cart-item:has(.quantity-input[data-item-id="${itemId}"])`);
                if (itemElement) {
                    itemElement.remove();
                }

                updateCart();


                if (cartItems.length === 0) {
                    document.getElementById('cart-container').style.display = 'none';
                    document.getElementById('empty-cart').style.display = 'block';
                }
            }
        }

        function updateCart() {
            const subtotal = cartItems.reduce((total, item) => total + (item.price * item.quantity), 0);
            const total = subtotal + deliveryFee - discountAmount;

            document.getElementById('subtotal').textContent = `$${subtotal.toFixed(2)}`;
            document.getElementById('total').textContent = `$${total.toFixed(2)}`;
        }
        function checkout() {
            const paymentMethod = document.querySelector('input[name="payment"]:checked').value;
            const subtotal = cartItems.reduce((total, item) => total + (item.price * item.quantity), 0);
            const total = subtotal + deliveryFee - discountAmount;

            let message = `Proceeding to checkout with ${paymentMethod} payment method. Total: $${total.toFixed(2)}`;
            if (discountCode) {
                message += `\nPromo code applied: ${discountCode}`;
            }

            alert(message);
        }

        updateCart();
    </script>
</body>

</html>