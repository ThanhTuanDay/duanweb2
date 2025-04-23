let discountAmount = 0;

const promoCodes = {
    "WELCOME10": { type: "percentage", value: 10 },
    "FEANE20": { type: "percentage", value: 20 },
    "FREESHIP": { type: "shipping", value: deliveryFee },
    "5DOLLAROFF": { type: "fixed", value: 5 }
};


document.addEventListener("DOMContentLoaded", () => {
    const cartContainer = document.getElementById("cart-container");
    let cartItems = getUserCart();
    const emptyCart = document.getElementById("empty-cart");
    if (cartItems.length === 0) {
        if (cartContainer && emptyCart) {
            cartContainer.style.display = "none";
            emptyCart.style.display = "block";
        }
        return;
    }

    const cartItemsWrapper = cartContainer.querySelector(".cart-items");
    cartItemsWrapper.innerHTML = "";

    cartItems.forEach((item) => {
        const itemElement = document.createElement("div");
        itemElement.className = "cart-item";
        itemElement.innerHTML = `
            <div class="item-image">
                <img src="${item.image_url}" alt="${item.name}">
            </div>
            <div class="item-details">
                <div class="item-name">${item.name}</div>
                <div class="item-price">${formatCurrency(item.price)}</div>
                <div class="item-actions">
                    <div class="quantity-control">
                        <button class="quantity-btn decrease-btn" onclick="updateQuantity('${item.id}', -1)">-</button>
                        <input type="number" class="quantity-input" value="${item.quantity}" min="1" max="10"
                            data-item-id="${item.id}" onchange="updateQuantityInput('${item.id}', this.value)">
                        <button class="quantity-btn increase-btn" onclick="updateQuantity('${item.id}', 1)">+</button>
                    </div>
                    <button class="remove-btn" onclick="removeItem('${item.id}')">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Remove
                    </button>
                </div>
            </div>
        `;
        cartItemsWrapper.appendChild(itemElement);
    });

    window.cartItems = cartItems;
    updateCart(cartItems);
    getSettings(cartItems);
    document.querySelectorAll(".quantity-btn").forEach(btn => {
        btn.addEventListener("click", () => {
            const input = btn.closest(".quantity-control").querySelector(".quantity-input");
            const productId = input.dataset.itemId;

            let quantity = parseInt(input.value);

            quantity += btn.classList.contains("increase-btn") ? 1 : -1;
            quantity = Math.max(1, Math.min(10, quantity));
            input.value = quantity;

            updateQuantity(productId, quantity);
            let cartItems = getUserCart();
            updateCart(cartItems);
        });
    });

    document.querySelectorAll(".quantity-input").forEach(input => {
        input.addEventListener("change", () => {
            const productId = parseInt(input.dataset.itemId);
            let quantity = parseInt(input.value);
            quantity = Math.max(1, Math.min(10, quantity));
            input.value = quantity;
            updateQuantity(productId, quantity);
            let cartItems = getUserCart();
            updateCart(cartItems);
        });
    });


    document.querySelectorAll(".remove-btn").forEach(btn => {
        btn.addEventListener("click", () => {
            const input = btn.closest(".cart-item").querySelector(".quantity-input");
            const productId = parseInt(input.dataset.itemId);
            removeItem(productId);
            btn.closest(".cart-item").remove();
            let cartItems = getUserCart();
            updateCart(cartItems);

            if (cart.length === 0) {
                document.getElementById("cart-container").style.display = 'none';
                document.getElementById("empty-cart").style.display = 'block';
            }
        });
    });
});


function updateCart(cart) {
    const subtotal = cart.reduce((total, item) => total + (item.price * item.quantity), 0);
    let taxFee = 0;
    if(settings){
        const { enable_taxes } = settings;
        const taxRate = enable_taxes ? getApplicableTaxRate() : 0;
        taxFee = subtotal * taxRate / 100;

        document.getElementById("tax-fee").textContent = `${formatCurrency(taxFee)}`;
        document.getElementById("tax-rate").textContent = `${taxRate}%`;
    }
    const total = subtotal + Math.round(deliveryFee) - discountAmount + taxFee  ;
    document.getElementById("delivery-fee").textContent = `${formatCurrency(deliveryFee)}`;
    document.getElementById("subtotal").textContent = `${formatCurrency(subtotal)}`;
    document.getElementById("total").textContent = `${formatCurrency(total)}`;
}
function formatCurrency(amount) {
    return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(amount);
}

function goToPaymentStage() {
    // Update UI for payment stage
    document.getElementById('cart-container').classList.add('payment-stage');
    
    // Update step indicators
    document.getElementById('cart-step').classList.remove('active');
    document.getElementById('payment-step').classList.add('active');
    
    // Update quantities for display
    document.querySelectorAll('.cart-item').forEach(item => {
        const quantity = item.querySelector('.quantity-input')?.value || 1;
        const quantityText = item.querySelector('.item-quantity');
        
        // If item-quantity element doesn't exist, create it
        if (!quantityText) {
            const itemDetails = item.querySelector('.item-details');
            const priceElement = item.querySelector('.item-price');
            
            if (itemDetails && priceElement) {
                const newQuantityText = document.createElement('div');
                newQuantityText.className = 'item-quantity';
                newQuantityText.textContent = `Quantity: ${quantity}`;
                
                // Insert after price element
                priceElement.insertAdjacentElement('afterend', newQuantityText);
            }
        } else {
            quantityText.textContent = `Quantity: ${quantity}`;
        }
    });
    
    // Scroll to top
    window.scrollTo(0, 0);
}


function goToCartStage() {

    document.getElementById('cart-container').classList.remove('payment-stage');
    

    document.getElementById('payment-step').classList.remove('active');
    document.getElementById('cart-step').classList.add('active');
    

    window.scrollTo(0, 0);
}

function applyPromoCode() {
    const promoInput = document.getElementById('promo-input');
    const promoMessage = document.getElementById('promo-message');
    const code = promoInput.value.trim().toUpperCase();

    if (code === "") {
        promoMessage.textContent = "Please enter a promotional code";
        promoMessage.className = "promo-message promo-error";
        return;
    }

    const today = new Date().toISOString().split('T')[0]; // "YYYY-MM-DD"
    const matchedCoupon = coupons.find(coupon =>
        coupon.code === code &&
        coupon.is_active == 1 &&
        coupon.valid_from <= today &&
        coupon.valid_until >= today
    );

    if (matchedCoupon) {
        if (cartItems == null) {
            cartItems = getUserCart();
        }
        if (cartItems.length == 0) {
            promoMessage.textContent = "Please add items to your cart before applying a promotional code";
            promoMessage.className = "promo-message promo-error";
            return;
        }


        const subtotal = cartItems.reduce((total, item) => total + (item.price * item.quantity), 0);
        discountCode = code;

        if (matchedCoupon.discount_type === "percentage") {
            discountAmount = subtotal * (parseFloat(matchedCoupon.discount_amount) / 100);
            promoMessage.innerHTML = `<span class="promo-success"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg> ${matchedCoupon.discount_amount}% discount applied</span>`;
        } else if (matchedCoupon.discount_type === "shipping") {
            discountAmount = deliveryFee;
            promoMessage.innerHTML = `<span class="promo-success"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg> Free shipping applied</span>`;
        } else if (matchedCoupon.discount_type === "fixed") {
            discountAmount = parseFloat(matchedCoupon.discount_amount);
            promoMessage.innerHTML = `<span class="promo-success"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg> ₫${Number(discountAmount).toLocaleString('vi-VN')} discount applied</span>`;
        }

        document.getElementById('discount-row').style.display = "flex";
        document.getElementById('discount-amount').textContent = `-${Number(discountAmount).toLocaleString('vi-VN')}₫`;

        updateCart(cartItems);
    } else {
        promoMessage.textContent = "Invalid or expired promotional code";
        promoMessage.className = "promo-message promo-error";
        discountAmount = 0;
        discountCode = "";
        document.getElementById('discount-row').style.display = "none";
        updateCart(cartItems);
    }
}








function checkout() {
    if (!isLoggedIn) {
        alert("Bạn cần đăng nhập để thanh toán.");
        window.location.href = "/duanweb2/login";
        return;
    }

    const paymentMethod = document.querySelector('input[name="payment"]:checked').value;
    const cartItems = getUserCart();
    const subtotal = cartItems.reduce((total, item) => total + (item.price * item.quantity), 0);
 
    const selectedAddressRadio = document.querySelector('input[name="address"]:checked');
    const addressLabel = selectedAddressRadio?.nextElementSibling;
    const deliveryAddress = addressLabel?.querySelector('.address-text')?.textContent?.trim() || '';
    const deliveryPhone = addressLabel?.querySelector('.address-phone')?.textContent?.trim() || '';
    const deliveryName = addressLabel?.querySelector('.address-name')?.textContent?.trim() || '';
    const deliveryAddressId = addressLabel?.querySelector('.address-id')?.textContent?.trim() || '';
    const { enable_taxes, tax_display_option, currency } = settings;
    const taxRate = enable_taxes ? getApplicableTaxRate() : 0;
    const taxFee = subtotal * taxRate / 100;
    const userId = document.getElementById('app-data').dataset.userId;
    const promoInput = document.getElementById('promo-input');
    const discountCode = promoInput.value.trim().toUpperCase() || null;
    const total = subtotal + deliveryFee - discountAmount + taxFee;
    const payload = {
        paymentMethod: paymentMethod,
        amount: total,
        deliveryAddressId: deliveryAddressId,
        userId: userId,
        taxRate: taxRate,
        taxFee: taxFee,
        discountAmount: discountAmount,
        discountCode: discountCode,
        deliveryFee: deliveryFee,
        cartItems: cartItems.map(item => ({
            id: item.id,
            name: item.name,
            quantity: item.quantity,
            price: Math.round(parseFloat(item.price)),
            totalPrice: item.price * item.quantity,
            currency: 'VND',
        })),
        addressInfo: {
            deliveryAddress,
            deliveryFee
        },
        userInfo: {
            name: deliveryName,
            phone: deliveryPhone
        }
    };
    if (paymentMethod === 'momo') {
        momoPayment(payload);
    }
    else if (paymentMethod === 'cod') {
        codPayment(payload);
    }
    else {
        alert('Chưa tích hợp phương thức này!');
    }
}

function momoPayment(payload) {
    fetch('http://localhost/duanweb2/payment', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(payload)
    })
        .then(res => res.json())
        .then(data => {
            if (data.payUrl) {
                window.location.href = data.payUrl;
            } else {
                alert('Không thể tạo thanh toán MoMo');
                console.error(data);
            }
        })
        .catch(err => {
            alert('Có lỗi khi kết nối đến MoMo');
            console.error(err);
        });
}


function codPayment(payload) {
    fetch('http://localhost/duanweb2/payment', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(payload)
    })
        .then(res => res.json())
        .then(data => {

            window.location.href = '/duanweb2/success?orderId=' + data + "&resultCode=0";

        })
        .catch(err => {
            alert('Có lỗi khi kết nối đến server.');
            console.error(err);
        });
}

function showAddAddressForm() {
    document.getElementById('address-form').style.display = 'block';
    document.querySelector('.add-address-btn').style.display = 'none';
}

function hideAddAddressForm() {
    document.getElementById('address-form').style.display = 'none';
    document.querySelector('.add-address-btn').style.display = 'flex';


    document.getElementById('address-name').value = '';
    document.getElementById('address-full').value = '';
    document.getElementById('address-phone').value = '';
}
function saveNewAddress() {
    const addressName = document.getElementById('address-name').value;
    const addressFull = document.getElementById('address-full').value;
    const addressPhone = document.getElementById('address-phone').value;
    const userId = document.getElementById('app-data').dataset.userId;

    if (!addressName || !addressFull || !addressPhone) {
        alert('Please fill in all address fields');
        return;
    }

    // Gửi request lên server để lưu địa chỉ
    fetch("http://localhost/duanweb2/create-adress", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            action: 'insert_address',
            userId: userId,
            addressName: addressName,
            address: addressFull,
            phone: addressPhone
        })
    })
        .then(res => res.json())
        .then(data => {
            console.log(data);
            if (data.success && data.addressId) {
                const addressOptions = document.querySelector('.address-options');
                const newAddressId = data.addressId;

                const newAddressHTML = `
                <div class="address-option">
                    <input type="radio" name="address" id="${newAddressId}" value="${newAddressId}" checked>
                    <label for="${newAddressId}">
                        <div class="address-details">
                            <div class="address-name">${addressName}</div>
                            <div class="address-text">${addressFull}</div>
                            <div class="address-phone">${addressPhone}</div>
                        </div>
                    </label>
                </div>
            `;

                const addNewAddressDiv = document.querySelector('.add-new-address');
                addNewAddressDiv.insertAdjacentHTML('beforebegin', newAddressHTML);

                document.getElementById(newAddressId).checked = true;
                hideAddAddressForm();
                location.reload();
            } else {
                alert('Lưu địa chỉ thất bại!');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Có lỗi xảy ra khi lưu địa chỉ.');
        });
}
