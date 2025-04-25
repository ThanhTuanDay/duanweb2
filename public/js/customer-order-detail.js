document.addEventListener("DOMContentLoaded", () => {
    const urlParams = new URLSearchParams(window.location.search);
    const userId = urlParams.get("userId");
    if (userId) loadCustomerOrderDetail(userId);
});

async function loadCustomerOrderDetail(userId) {
    let orders = [];
    let user = [];
    try {
        const response = await fetch('/duanweb2/app/api/order.api.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                action: 'getCustomerOrderDetail',
                userId: userId
            })
        });

        const result = await response.json();

        if (result.success) {
            orders = result.orders;
            renderOrderHistory(orders);
        } else {
            alert("Không tìm thấy thông tin đơn hàng.");
        }
    } catch (error) {
        console.error("Lỗi khi load dữ liệu khách hàng:", error);
    }

    try {
        const response = await fetch('/duanweb2/app/api/users.api.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                action: 'getUserById',
                id: userId
            })
        });

        const result = await response.json();

        if (result.success) {
            user = {
                id: result.id,
                name: result.name,
                email: result.email,
                phone: result.phone,
                address: result.address,
                created_at: result.created_at,
            };
            renderCustomerProfile(user, orders);

        } else {
            alert("Không tìm thấy thông tin khách hàng.");
        }
    } catch (error) {
        console.error("Lỗi khi load dữ liệu khách hàng:", error);
    }


}
function renderCustomerProfile(user, orders) {
    document.querySelector('.card-body h4').innerHTML = user.name;
    document.querySelector('.fa-envelope').parentElement.innerHTML = `<i class="fas fa-envelope me-2"></i>` + user.email;
    document.querySelector('.fa-phone').parentElement.innerHTML = `<i class="fas fa-phone me-2"></i>` + user.phone || 'No phone';
    document.querySelector('.fa-map-marker-alt').parentElement.innerHTML = `<i class="fas fa-map-marker-alt me-2"></i>` + user.address || 'No address';
    document.querySelector('.fa-calendar-alt').parentElement.innerHTML = `<i class="fas fa-calendar-alt me-2"></i> Member since: ${user.created_at}`;

    const totalOrders = orders.length;
    const totalSpent = orders.reduce((sum, o) => sum + parseFloat(o.total), 0);
    const avgOrder = totalOrders ? totalSpent / totalOrders : 0;
    const lastOrder = orders[0]?.created_at || "N/A";

    document.querySelectorAll('.p-3 h4')[0].textContent = totalOrders;
    document.querySelectorAll('.p-3 h4')[1].textContent = `$${totalSpent.toFixed(2)}`;
    document.querySelectorAll('.p-3 h4')[2].textContent = `$${avgOrder.toFixed(2)}`;
    document.querySelectorAll('.p-3 h4')[3].textContent = formatDateDisplay(lastOrder);
}
function renderOrderHistory(orders) {
    const tbody = document.querySelector("table.table tbody");
    tbody.innerHTML = "";

    orders.forEach(order => {
        const tr = document.createElement("tr");
        tr.innerHTML = `
            <td>#${order.id}</td>
            <td>${formatDateDisplay(order.created_at)}</td>
            <td>${order.item_count}</td>
            <td>$${parseFloat(order.total).toFixed(2)}</td>
            <td><span class="badge bg-${getStatusColor(order.status)}">${capitalize(order.status)}</span></td>
            <td>${order.payment_method}</td>
            <td>
                <a href="/duanweb2/admin/order-detail/page?id=${order.id}" class="btn btn-sm btn-primary">
                    <i class="fas fa-eye"></i> View
                </a>
            </td>
        `;
        tbody.appendChild(tr);
    });
}
function formatDateDisplay(dateStr) {
    const date = new Date(dateStr);
    return date.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
}

function getStatusColor(status) {
    switch (status) {
        case 'completed': return 'success';
        case 'pending': return 'warning';
        case 'cancelled': return 'danger';
        case 'delivering': return 'info';
        default: return 'secondary';
    }
}

function capitalize(str) {
    return str.charAt(0).toUpperCase() + str.slice(1);
}