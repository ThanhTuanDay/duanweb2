document.getElementById('toggle-sidebar').addEventListener('click', function() {
    document.getElementById('sidebar').classList.toggle('active');
    document.getElementById('main-content').classList.toggle('active');
});
const statusTransitions = {
    pending: ['delivering', 'cancelled'],
    delivering: ['completed', 'cancelled'],
    completed: [], 
    cancelled: [] 
  };

$("#per-page-select").on("change", function () {
    perPage = parseInt($(this).val());
    paginateOrders(1);
});
const statusMap = {
    "pending": { text: "Pending", badge: "bg-primary" },
    "completed": { text: "Delivered", badge: "bg-success" },
    "delivering": { text: "Delivering", badge: "bg-warning" },
    "cancelled": { text: "Cancelled", badge: "bg-danger" },
    "shipped": { text: "Shipped", badge: "bg-info" },
};

function renderOrders(orders) {
    const $tbody = $("tbody");
    $tbody.empty();

    $.each(orders, function (index, order) {
        const statusInfo = statusMap[order.status] || { text: order.status, badge: "bg-secondary" };
        const formattedDate = new Date(order.created_at).toLocaleDateString("vi-VN");
        const formattedTotal = new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(order.total);

        const row = `
            <tr>
                <td>#${order.id}</td>
                <td>${order.user_name}</td>
                <td>${formattedDate}</td>
                <td>${formattedTotal}</td>
                <td>${order.payment_method}</td>
                <td><span class="badge ${statusInfo.badge}">${statusInfo.text}</span></td>
                <td>
                    <div class="action-btns">
                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#viewOrderModal" onclick="viewOrder('${order.id}')"><i class="fas fa-eye"></i></button>
                        <button class="btn btn-sm btn-info" onclick="printOrder('${order.id}')"><i class="fas fa-print"></i></button>
                    </div>
                </td>
            </tr>
        `;
        $tbody.append(row);
    });
}
function renderOrderStatistics(orders) {
    const totalOrders = orders.length;
    const completedOrders = orders.filter(o => o.status === 'completed').length;
    const cancelledOrders = orders.filter(o => o.status === 'cancelled').length;
    const totalRevenue = orders
        .filter(o => o.status === 'completed')
        .reduce((sum, o) => sum + parseFloat(o.total || 0), 0);

    const completionRate = totalOrders > 0 ? Math.round((completedOrders / totalOrders) * 100) : 0;
    const cancellationRate = totalOrders > 0 ? Math.round((cancelledOrders / totalOrders) * 100) : 0;

    $('#total-orders').text(totalOrders);
    $('#total-revenue').text(formatCurrency(totalRevenue));
    $('#completion-rate').text(`${completionRate}%`);
    $('#cancellation-rate').text(`${cancellationRate}%`);
}

$(document).ready(reloadData());

function reloadData(){
    $.ajax({
        url: '/duanweb2/app/api/order.api.php',
        method: 'GET',
        data: { action: 'getAllOrders' },
        dataType: 'json',
        success: function (data) {
            allOrders = data.order;
            recentOrders = data.recentOrder;
            renderOrderStatistics(allOrders);
            renderOrderTimeline(recentOrders);
            paginateOrders(1);
        },
        error: function (xhr, status, error) {
            console.error("Lỗi khi gọi API đơn hàng:", error);
        }
    });
}
$('#search-input-id').on('input', function () {
    const keyword = $(this).val().trim().toLowerCase();
    console.log(keyword)
    const filtered = allOrders.filter(order => order.id.toLowerCase().startsWith(keyword));

    if (filtered.length !== currentFilterOrder.length) {
        currentFilterOrder = filtered;
        paginateOrders(1);
    }
});
let allOrders = [];
let currentFilterOrder = [];
let perPage = 5;

function renderPagination(currentPage, totalPages) {
    const $pagination = $("#paginationContainer");
    $pagination.empty();

    const prevDisabled = currentPage === 1 ? "disabled" : "";
    $pagination.append(`
        <li class="page-item ${prevDisabled}">
            <a class="page-link" href="#" data-page="${currentPage - 1}">Previous</a>
        </li>
    `);

    for (let i = 1; i <= totalPages; i++) {
        const active = currentPage === i ? "active" : "";
        $pagination.append(`
            <li class="page-item ${active}">
                <a class="page-link" href="#" data-page="${i}">${i}</a>
            </li>
        `);
    }

    const nextDisabled = currentPage === totalPages ? "disabled" : "";
    $pagination.append(`
        <li class="page-item ${nextDisabled}">
            <a class="page-link" href="#" data-page="${currentPage + 1}">Next</a>
        </li>
    `);

    $pagination.find("a.page-link").off("click").on("click", function (e) {
        e.preventDefault();
        const page = parseInt($(this).data("page"));
        if (!isNaN(page)) {
            paginateOrders(page);
        }
    });
    const totalItems = currentFilterOrder.length;
    const start = (currentPage - 1) * perPage + 1;
    const end = Math.min(start + perPage - 1, totalItems);
    $("#pagination-start").text(start);
    $("#pagination-end").text(end);
    $("#pagination-total").text(totalItems);
}
function paginateOrders(page = 1) {
    let currentOrders = []
    if(currentFilterOrder.length > 0){
        currentOrders = currentFilterOrder;
    }else{
        currentOrders = allOrders;
    }
    
    const totalItems = currentOrders.length;
    const totalPages = Math.ceil(totalItems / perPage);
    const start = (page - 1) * perPage;
    const end = start + perPage;
    console.log(totalItems)
    currentOrders=currentOrders.slice(start,end)
    renderOrders(currentOrders);
    renderPagination(page, totalPages);
}
function renderOrderTimeline(recentOrders) {
    const $timelineContainer = $(".order-timeline");
    $timelineContainer.empty();

    recentOrders.forEach(order => {
        const dateText = new Date(order.created_at).toLocaleString("vi-VN", {
            day: "2-digit", month: "2-digit", year: "numeric",
            hour: "2-digit", minute: "2-digit"
        });

        let statusText = "";
        if (order.status === "pending") {
            statusText = `New order #${order.order_id} received`;
        } else {
            statusText = `Order #${order.order_id} status changed to ${order.status}`;
        }

        const timelineItem = `
            <div class="timeline-item">
                <div class="timeline-date">${dateText}</div>
                <div class="timeline-content">${statusText}</div>
                <div class="timeline-note">Customer: ${order.user_name}</div>
            </div>
        `;
        $timelineContainer.append(timelineItem);
    });
}

function viewOrder(orderId) {
    $.ajax({
        url: "/duanweb2/app/api/order.api.php",
        method: "GET",
        data: {
            action: "getOrderDetailById",
            orderId: orderId,
        },
        dataType: "json",
        success: function (response) {
            if (!response.success || !response.order) return;
            const { order, timeline, items } = response;
            const avatar = $('#customer-avatar');
            avatar.attr("alt", order.user_name);
            if (order.avatar_url) {
                avatar.attr("src", order.avatar_url);
            }
            $("#viewOrderModal .customer-details h5").text(order.user_name);
            $("#viewOrderModal .delivery-address p").html(order.delivery_address);
            $("#viewOrderModal .payment-details p").text(order.payment_method);
            $('#order-id').text(`#${order.id}`);
            $('#customer-email').text(order.user_email || 'Không có email');
            $('#customer-phone').text(order.user_phone || 'Không có số điện thoại');
            $('#order-date').text(new Date(order.created_at).toLocaleString("vi-VN"));
            $("#viewOrderModal .modal-title").text(`Order Details - #${order.id}`);
            $("#viewOrderModal .modal-body .badge")
                .text(order.status)
                .attr("class", `badge ${statusMap[order.status]?.badge || 'bg-secondary'}`);

            

            const $timeline = $("#viewOrderModal .order-timeline");
            $timeline.empty();
            timeline.forEach((item) => {
                $timeline.append(`
            <div class="timeline-item">
                <div class="timeline-date">${new Date(item.created_at).toLocaleString("vi-VN")}</div>
                <div class="timeline-content">${item.status}</div>
                <div class="timeline-note">${item.description || ""}</div>
            </div>
          `);
            });

            const $items = $("#viewOrderModal .order-items");
            $items.empty();
            let subtotal = 0;
            items.forEach((item) => {
                const price = item.price * item.quantity;
                subtotal += price;
                $items.append(`
            <div class="order-item">
                <div class="order-item-img">
                    <img src="${item.image_url}" height="50" width="50" alt="${item.name}">
                </div>
                <div class="order-item-details">
                    <div class="order-item-name">${item.name}</div>
                    <div class="order-item-price">${formatCurrency(item.price)} <span class="order-item-quantity">x ${item.quantity}</span></div>
                </div>
                <div class="ms-auto">
                    <strong>${formatCurrency(price)}</strong>
                </div>
            </div>
          `);
            });

            const deliveryFee = 20000;
            const tax = subtotal * 0.1;
            const discount = 0;
            const total = subtotal + deliveryFee + tax - discount;

            const $summary = $("#viewOrderModal .order-summary");
            $summary.html(`
          <div class="order-summary-item"><span>Subtotal</span><span>${formatCurrency(subtotal)}</span></div>
          <div class="order-summary-item"><span>Delivery Fee</span><span>${formatCurrency(deliveryFee)}</span></div>
          <div class="order-summary-item"><span>Tax</span><span>${formatCurrency(tax)}</span></div>
          <div class="order-summary-item"><span>Discount</span><span>${formatCurrency(discount)}</span></div>
          <div class="order-summary-item"><span>Total</span><span>${formatCurrency(total)}</span></div>
        `);

          
            const updateStatusBtn = document.querySelector('#update-status-btn');

            if (order.status === 'completed') {
                updateStatusBtn.setAttribute('disabled', true);
            } else {
                updateStatusBtn.removeAttribute('disabled');
                $('#update-status-btn').data('order-id', response.order.id);
                $('#update-status-btn').data('current-status', response.order.status);
            }
        },
        error: function () {
            alert("Lỗi khi lấy thông tin đơn hàng");
        },
    });
    setTimeout(() => {
        $("#viewOrderModal").modal("show");
    }, 500);
}

$('#update-status-btn').on('click', function () {
    const orderId = $(this).data('order-id');
    const currentStatus = $(this).data('current-status');

    const allowedStatuses = statusTransitions[currentStatus] || [];

    const $select = $('#orderStatus');
    $select.empty();

    allowedStatuses.forEach(status => {
        const label = {
            pending: "Pending",
            delivering: "Delivering",
            completed: "Completed",
            cancelled: "Cancelled"
        }[status];

        $select.append(`<option value="${status}">${label}</option>`);
    });

    $('#updateStatusModal button.btn-primary').prop('disabled', allowedStatuses.length === 0);

    $('#updateStatusModal').data('order-id', orderId);
});
function formatCurrency(amount) {
    return new Intl.NumberFormat("vi-VN", {
        style: "currency",
        currency: "VND",
    }).format(amount);
}


$('#updateStatusModal .btn-primary').on('click', function () {
    const newStatus = $('#orderStatus').val();
    const note = $('#statusNote').val();
    const currentOrderId = $('#updateStatusModal').data('order-id');
    if (!newStatus) {
        alert("Please select a status.");
        return;
    }

    if (!confirm(`Bạn có chắc chắn muốn cập nhật trạng thái sang "${newStatus}" không?`)) {
        return;
    }

    $.ajax({
        url: '/duanweb2/app/api/order.api.php',
        method: 'POST',
        data: {
            action: 'updateOrderStatus',
            orderId: currentOrderId,
            status: newStatus,
            description: note
        },
        success: function (res) {
            const json = typeof res === 'string' ? JSON.parse(res) : res;

            if (json.success) {
                alert("Cập nhật trạng thái thành công!");
                $('#updateStatusModal').modal('hide');
                reloadData();
            } else {
                alert(json.message || 'Có lỗi xảy ra khi cập nhật trạng thái.');
            }
        },
        error: function () {
            alert('Lỗi kết nối đến server khi cập nhật trạng thái.');
        }
    });
});

$('#filterOrdersModal .btn-primary').on('click', function () {
    const priceMin = parseFloat($('#priceMin').val()) || 0;
    const priceMax = parseFloat($('#priceMax').val()) || Infinity;
    const orderName = $('#orderNameFilter').val().trim().toLowerCase();
    const customerName = $('#customerNameFilter').val().trim().toLowerCase();
    const dateFrom = $('#filterDateFrom').val();
    const dateTo = $('#filterDateTo').val();

    const statuses = [];
    if ($('#statusPending').is(':checked')) statuses.push('pending');
    if ($('#statusProcessing').is(':checked')) statuses.push('delivering');
    if ($('#statusCompleted').is(':checked')) statuses.push('completed');
    if ($('#statusCancelled').is(':checked')) statuses.push('cancelled');

    const payments = [];
    if ($('#paymentCredit').is(':checked')) payments.push('credit card');
    if ($('#paymentDebit').is(':checked')) payments.push('debit card');
    if ($('#paymentPaypal').is(':checked')) payments.push('paypal');
    if ($('#paymentCash').is(':checked')) payments.push('cod'); 

    const filteredOrders = allOrders.filter(order => {
        const total = order.total || 0;
        const matchPrice = total >= priceMin && total <= priceMax;

        const matchOrderName = !orderName || order.id.toLowerCase().includes(orderName) || order.user_name.toLowerCase().includes(orderName);
        const matchCustomer = !customerName || order.user_name.toLowerCase().includes(customerName);
        const matchStatus = statuses.length === 0 || statuses.includes(order.status.toLowerCase());
        const matchPayment = payments.length === 0 || payments.includes(order.payment_method.toLowerCase());
        const createdAt = new Date(order.created_at);
        const matchDate =
            (!dateFrom || createdAt >= new Date(dateFrom)) &&
            (!dateTo || createdAt <= new Date(dateTo + 'T23:59:59'));

        return matchPrice && matchOrderName && matchCustomer && matchStatus && matchPayment && matchDate;
    });

    currentFilterOrder = filteredOrders;
    paginateOrders(1);
    $('#filterOrdersModal').modal('hide');
});

// Reset filter
$('#filterOrdersModal .btn-outline-primary').on('click', function () {
    $('#filterOrdersModal input').val('');
    $('#filterOrdersModal input[type="checkbox"]').prop('checked', true);
    currentFilterOrder = [];
    paginateOrders(1);
});
function printOrder(orderId) {
    console.log("In đơn hàng:", orderId);
}



$('#exportOrdersModal .btn-primary').on('click', function () {
    const exportFrom = $('#exportDateFrom').val();
    const exportTo = $('#exportDateTo').val();
    const status = $('#exportStatus').val();
    const format = $('#exportFormat').val();

    
    const includeFields = {
        id: $('#includeOrderId').is(':checked'),
        customer: $('#includeCustomer').is(':checked'),
        date: $('#includeDate').is(':checked'),
        items: $('#includeItems').is(':checked'),
        total: $('#includeTotal').is(':checked'),
        status: $('#includeStatus').is(':checked'),
    };

    let exportData = allOrders.filter(order => {
        const matchStatus = status === 'all' || order.status === status;
        const matchDate = (!exportFrom || new Date(order.created_at) >= new Date(exportFrom)) &&
                          (!exportTo || new Date(order.created_at) <= new Date(exportTo));
        return matchStatus && matchDate;
    });

    if (exportData.length === 0) {
        alert('No orders found to export.');
        return;
    }

    const rows = exportData.map(order => {
        const row = {};
        if (includeFields.id) row['Order ID'] = order.id;
        if (includeFields.customer) row['Customer'] = order.user_name;
        if (includeFields.date) row['Order Date'] = new Date(order.created_at).toLocaleString("vi-VN");
        if (includeFields.total) row['Total'] = order.total;
        if (includeFields.status) row['Status'] = order.status;
        return row;
    });

    if (format === 'csv') {
        exportToCSV(rows);
    } else if (format === 'excel') {
        exportToExcel(rows);
    } else if (format === 'pdf') {
        exportToPDF(rows);
    }

    $('#exportOrdersModal').modal('hide');
});
function exportToCSV(data) {
    if (!data || data.length === 0) return;

    const csvHeader = Object.keys(data[0]).join(',');
    const csvRows = data.map(row => Object.values(row).map(v => `"${v}"`).join(','));

    const csvContent = "\uFEFF" + [csvHeader, ...csvRows].join('\n'); // Thêm BOM ở đầu
    const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
    const link = document.createElement('a');

    link.href = URL.createObjectURL(blob);
    link.download = 'orders_export.csv';
    link.click();
}

function exportToExcel(data) {
    const ws = XLSX.utils.json_to_sheet(data);
    const wb = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(wb, ws, "Orders");

    XLSX.writeFile(wb, "orders_export.xlsx");
}
function exportToPDF(data) {
    const doc = new jspdf.jsPDF({encoding: "UTF-8" });
    const headers = [Object.keys(data[0])];
    const rows = data.map(row => Object.values(row));

    doc.autoTable({
        head: headers,
        body: rows
    });

    doc.save('orders_export.pdf');
}
