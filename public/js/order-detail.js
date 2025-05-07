document.addEventListener("DOMContentLoaded", async () => {
    const urlParams = new URLSearchParams(window.location.search);
    const orderId = urlParams.get("id");

    if (!orderId) return alert("Missing order ID!");


    const orderRes = await fetch(`/duanweb2/app/api/order.api.php?action=getOrderDetailById&orderId=${orderId}`);
    const orderData = await orderRes.json();

    if (!orderData.success) return alert(orderData.message);

    const { order, items, timeline } = orderData;


    const userRes = await fetch('/duanweb2/app/api/users.api.php', {
        method: "POST",
        body: new URLSearchParams({ action: 'getUserById', id: order.user_id })
    });
    const userData = await userRes.json();

    if (!userData.success) return alert("User not found");


    const formatCurrency = (amount) => Number(amount).toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });


    document.querySelector('h2 span.text-primary').textContent = `#${order.id}`;
    document.querySelectorAll('.info-item').forEach(el => {
        if (el.textContent.includes("Order ID:")) el.innerHTML = `<div class="info-icon"><i class="fas fa-hashtag"></i></div><div><strong>Order ID:</strong> #${order.id}</div>`;
        if (el.textContent.includes("Order Date:")) el.innerHTML = `<div class="info-icon"><i class="fas fa-calendar"></i></div><div><strong>Order Date:</strong> ${order.created_at}</div>`;
        if (el.textContent.includes("Payment Method:")) el.innerHTML = `<div class="info-icon"><i class="fas fa-credit-card"></i></div><div><strong>Payment Method:</strong> ${order.payment_method}</div>`;
        if (el.textContent.includes("Payment Status:")) el.innerHTML = `<div class="info-icon"><i class="fas fa-money-check"></i></div><div><strong>Payment Status:</strong> <span class="status-badge paid"><i class="fas fa-check-circle"></i> Paid</span></div>`;
    });


    document.getElementById('customer-name').innerHTML = `<strong>Customer:</strong> ${userData.name}`;
    document.getElementById('customer-email').innerHTML = `<strong>Email:</strong> ${userData.email}`;
    document.getElementById('customer-phone').innerHTML = `<strong>Phone:</strong> ${userData.phone}`;
    document.getElementById('customer-id').innerHTML = `<strong>Customer ID:</strong> ${userData.id}`;


    document.querySelectorAll('.address-card').forEach(card => {
        card.innerHTML = `
            <h6><i class="fas fa-shipping-fast"></i> ${card.innerText.includes("Billing") ? 'Billing Address' : 'Shipping Address'}</h6>
            <p>${userData.name}</p>
            <p>${userData.address}</p>
            <p class="mb-0">${userData.phone}</p>`;
    });


    const tbody = document.querySelector(".table tbody");
    tbody.innerHTML = "";
    items.forEach((item, idx) => {
        tbody.innerHTML += `
        <tr>
            <td>
                <div class="d-flex align-items-center">
                    <img src="${item.image_url}" alt="${item.name}" class="product-img me-3" width="60">
                    <div>
                        <h6 class="mb-0">${item.name}</h6>
                        <small class="text-muted">${item.variant || ""}</small>
                    </div>
                </div>
            </td>
            <td>${formatCurrency(item.price)}</td>
            <td>${item.quantity}</td>
            <td class="text-end">${formatCurrency(item.price * item.quantity)}</td>
        </tr>`;
    });


    const subtotal = items.reduce((sum, i) => sum + i.price * i.quantity, 0);
    const shipping = parseFloat(order.delivery_fee || 0);
    const tax = subtotal * (parseFloat(order.tax_rate || 0) / 100);
    const discount = parseFloat(order.discount_amount || 0);
    const tip = parseFloat(order.tip || 0);
    const total = subtotal + shipping + tax + tip - discount;

    const summaryEls = document.querySelectorAll('.order-summary-item span:last-child');
    summaryEls[0].textContent = formatCurrency(subtotal);
    summaryEls[1].textContent = formatCurrency(shipping);
    summaryEls[2].textContent = formatCurrency(tax);
    summaryEls[3].textContent = `-${formatCurrency(discount)}`;
    summaryEls[4].textContent = formatCurrency(tip);
    summaryEls[5].textContent = formatCurrency(total);


    const timelineContainer = document.getElementById('statusTimeline');
    timelineContainer.innerHTML = '';
    timeline.forEach((event) => {
        timelineContainer.innerHTML += `
            <div class="timeline-item completed">
                <div class="timeline-date"><i class="fas fa-clock"></i> ${event.time}</div>
                <div class="timeline-title"><i class="fas fa-check-circle"></i> ${event.status}</div>
                <div class="timeline-text">${event.note}</div>
            </div>`;
    });


    if (order.note) {
        document.querySelector(".card-body .bg-light p").textContent = order.note;
    }

    const returnBtn = document.getElementById('return-btn');
    if (returnBtn && userData.id) {
        returnBtn.href = `../../admin/customer-order-detail/page?userId=${userData.id}`;
    }

});
