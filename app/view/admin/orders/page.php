<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feane Admin - Orders</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"> -->
<!-- <style>
        :root {
            --primary: #ffbe33;
            --primary-dark: #e69c00;
            --secondary: #222831;
            --dark: #0c0c0c;
            --dark-light: #191919;
            --light: #ffffff;
            --gray: #6c757d;
            --success: #28a745;
            --danger: #dc3545;
            --warning: #ffc107;
            --info: #17a2b8;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        
        body {
            background-color: var(--dark);
            color: var(--light);
            min-height: 100vh;
            display: flex;
        }
        
        .sidebar {
            width: 250px;
            background-color: var(--dark-light);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            overflow-y: auto;
            transition: all 0.3s ease;
            z-index: 1000;
        }
        
        .sidebar-header {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .sidebar-header h3 {
            color: var(--primary);
            font-weight: 700;
            font-size: 24px;
            margin: 0;
        }
        
        .sidebar-menu {
            padding: 20px 0;
        }
        
        .menu-item {
            padding: 12px 20px;
            display: flex;
            align-items: center;
            color: var(--light);
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }
        
        .menu-item:hover {
            background-color: rgba(255, 255, 255, 0.05);
            color: var(--primary);
        }
        
        .menu-item.active {
            background-color: rgba(255, 255, 255, 0.05);
            color: var(--primary);
            border-left-color: var(--primary);
        }
        
        .menu-item i {
            margin-right: 10px;
            font-size: 18px;
        }
        
        .main-content {
            flex: 1;
            margin-left: 250px;
            padding: 20px;
            transition: all 0.3s ease;
        }
        
        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            background-color: var(--dark-light);
            padding: 15px 20px;
            border-radius: 5px;
        }
        
        .toggle-sidebar {
            background: none;
            border: none;
            color: var(--light);
            font-size: 20px;
            cursor: pointer;
        }
        
        .user-info {
            display: flex;
            align-items: center;
        }
        
        .user-info img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }
        
        .user-info .dropdown-toggle {
            background: none;
            border: none;
            color: var(--light);
        }
        
        .card {
            background-color: var(--dark-light);
            border: none;
            border-radius: 5px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .card-header {
            background-color: rgba(0, 0, 0, 0.2);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding: 15px 20px;
            font-weight: 500;
        }
        
        .card-body {
            padding: 20px;
        }
        
        .table {
            color: var(--light);
        }
        
        .table thead th {
            border-bottom-color: rgba(255, 255, 255, 0.1);
            font-weight: 500;
        }
        
        .table td, .table th {
            border-top-color: rgba(255, 255, 255, 0.1);
            vertical-align: middle;
        }
        
        .badge {
            padding: 5px 10px;
            font-weight: 500;
            border-radius: 30px;
        }
        
        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
        }
        
        .btn-primary:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
        }
        
        .form-control, .form-select {
            background-color: var(--dark);
            border-color: rgba(255, 255, 255, 0.1);
            color: var(--light);
        }
        
        .form-control:focus, .form-select:focus {
            background-color: var(--dark);
            border-color: var(--primary);
            color: var(--light);
            box-shadow: 0 0 0 0.25rem rgba(255, 190, 51, 0.25);
        }
        
        .search-container {
            position: relative;
            max-width: 300px;
        }
        
        .search-container .form-control {
            padding-right: 40px;
        }
        
        .search-icon {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray);
        }
        
        .order-details-row {
            margin-bottom: 15px;
        }
        
        .order-details-row:last-child {
            margin-bottom: 0;
        }
        
        .order-details-label {
            font-weight: 500;
            margin-bottom: 5px;
        }
        
        .order-product-item {
            display: flex;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .order-product-item:last-child {
            border-bottom: none;
        }
        
        .order-product-img {
            width: 50px;
            height: 50px;
            border-radius: 5px;
            overflow: hidden;
            margin-right: 15px;
        }
        
        .order-product-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .order-product-info {
            flex: 1;
        }
        
        .order-product-info h6 {
            margin: 0 0 5px;
            font-size: 14px;
        }
        
        .order-product-info p {
            margin: 0;
            font-size: 12px;
            color: var(--gray);
        }
        
        .order-product-price {
            font-weight: 600;
            color: var(--primary);
        }
        
        .timeline {
            position: relative;
            padding-left: 30px;
        }
        
        .timeline::before {
            content: '';
            position: absolute;
            left: 10px;
            top: 0;
            height: 100%;
            width: 2px;
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        .timeline-item {
            position: relative;
            padding-bottom: 20px;
        }
        
        .timeline-item:last-child {
            padding-bottom: 0;
        }
        
        .timeline-item::before {
            content: '';
            position: absolute;
            left: -30px;
            top: 0;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: var(--primary);
        }
        
        .timeline-date {
            font-size: 12px;
            color: var(--gray);
            margin-bottom: 5px;
        }
        
        .timeline-content {
            font-size: 14px;
        }
        
        @media (max-width: 992px) {
            .sidebar {
                left: -250px;
            }
            
            .sidebar.active {
                left: 0;
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .main-content.active {
                margin-left: 250px;
            }
        }
    </style> -->
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> -->
<!-- </head> -->
<!-- <body> -->
<!-- Sidebar -->
<!-- <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h3>Feane Admin</h3>
        </div>
        <div class="sidebar-menu">
            <a href="admin-dashboard.html" class="menu-item">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
            <a href="admin-products.html" class="menu-item">
                <i class="fas fa-hamburger"></i> Products
            </a>
            <a href="admin-categories.html" class="menu-item">
                <i class="fas fa-list"></i> Categories
            </a>
            <a href="admin-orders.html" class="menu-item active">
                <i class="fas fa-shopping-bag"></i> Orders
            </a>
            <a href="admin-users.html" class="menu-item">
                <i class="fas fa-users"></i> Users
            </a>
            <a href="#" class="menu-item">
                <i class="fas fa-cog"></i> Settings
            </a>
            <a href="#" class="menu-item">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </div> -->

<!-- Main Content -->



<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Orders Management</h2>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exportOrdersModal">
            <i class="fas fa-file-export me-2"></i> Export Orders
        </button>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h5 class="mb-0">All Orders</h5>
                </div>
                <div class="col-md-6">
                    <div class="d-flex justify-content-md-end">
                        <div class="search-container me-3">
                            <input id="search-input-id" type="text" class="form-control" placeholder="Search orders...">
                            <i class="fas fa-search search-icon"></i>
                        </div>
                        <button class="btn btn-outline-primary" type="button" data-bs-toggle="modal"
                            data-bs-target="#filterOrdersModal">
                            <i class="fas fa-filter me-2"></i> Filter
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="mb-4">
                <div class="row">
                    <div class="col-md-6 mb-3 mb-md-0">
                        
                    </div>
                    <div class="col-md-6 d-flex justify-content-md-end align-items-center">
                        <div class="me-3">
                            <select id="per-page-select" class="form-select form-select-sm">
                                <option value="10">10 per page</option>
                                <option value="25">25 per page</option>
                                <option value="50">50 per page</option>
                                <option value="100">100 per page</option>
                            </select>
                        </div>
                        <div>
                            <button class="btn btn-sm btn-outline-secondary me-2">
                                <i class="fas fa-print"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-secondary">
                                <i class="fas fa-download"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Date</th>
                            <th>Total</th>
                            <th>Payment Method</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>

            <nav aria-label="Page navigation">
                <ul id="paginationContainer" class="pagination justify-content-center mt-4">

                </ul>
                <div class="pagination-info">
                    <span>Showing <span id="pagination-start">1</span> to <span id="pagination-end">10</span> of <span
                            id="pagination-total">100</span> items</span>
                </div>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Order Statistics</h5>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6 mb-3">
                            <h3 class="mb-1" id="total-orders">0</h3>
                            <p class="text-muted mb-0">Total Orders</p>
                        </div>
                        <div class="col-6 mb-3">
                            <h3 class="mb-1" id="total-revenue">₫0</h3>
                            <p class="text-muted mb-0">Total Revenue</p>
                        </div>
                        <div class="col-6">
                            <h3 class="mb-1 text-success" id="completion-rate">0%</h3>
                            <p class="text-muted mb-0">Completion Rate</p>
                        </div>
                        <div class="col-6">
                            <h3 class="mb-1 text-danger" id="cancellation-rate">0%</h3>
                            <p class="text-muted mb-0">Cancellation Rate</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Recent Activities</h5>
                </div>
                <div class="card-body">
                    <div class="order-timeline">
                        <div class="timeline-item">
                            <div class="timeline-date">Today, 10:30 AM</div>
                            <div class="timeline-content">Order #ORD-0025 has been completed</div>
                            <div class="timeline-note">Customer: John Doe</div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-date">Today, 9:15 AM</div>
                            <div class="timeline-content">Order #ORD-0024 status changed to Processing</div>
                            <div class="timeline-note">Updated by: Admin User</div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-date">Yesterday, 3:45 PM</div>
                            <div class="timeline-content">New order #ORD-0024 received</div>
                            <div class="timeline-note">Customer: Jane Smith</div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-date">Yesterday, 1:20 PM</div>
                            <div class="timeline-content">New order #ORD-0023 received</div>
                            <div class="timeline-note">Customer: Robert Johnson</div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-date">May 13, 7:15 PM</div>
                            <div class="timeline-content">Order #ORD-0022 has been completed</div>
                            <div class="timeline-note">Customer: Emily Davis</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- View Order Modal -->
<div class="modal fade" id="viewOrderModal" tabindex="-1" aria-labelledby="viewOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewOrderModalLabel"></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="customer-info">
                            <div class="customer-avatar">
                                <img id="customer-avatar" src="/placeholder.svg?height=60&width=60"
                                    alt="Customer Avatar">
                            </div>
                            <div class="customer-details">
                                <h5></h5>
                                <p></p>
                            </div>
                        </div>
                        <div class="mb-3">
                            <p><strong>Email:</strong> <span id="customer-email"></span></p>
                            <p><strong>Phone:</strong> <span id="customer-phone"></span></p>
                        </div>
                        <div class="delivery-address">
                            <h6><i class="fas fa-map-marker-alt"></i> Delivery Address</h6>
                            <p>
                                <br<br>
                            </p>
                        </div>
                        <div class="payment-info">
                            <div class="payment-icon">
                                <i class="fab fa-cc-visa"></i>
                            </div>
                            <div class="payment-details">
                                <h6>Payment Method</h6>
                                <p></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="mb-0">Order Status</h6>
                            <span class="badge bg-success"></span>
                        </div>
                        <div class="mb-3">
                            <p><strong>Order Date:</strong> <span id="order-date"></span></p>
                            <p><strong>Order ID:</strong> <span id="order-id"></span></p>
                        </div>
                        <div class="order-timeline">
                            <!-- <div class="timeline-item">
                                <div class="timeline-date"></div>
                                <div class="timeline-content"></div>
                                <div class="timeline-note">Delivered by: Delivery Agent #12</div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-date">May 15, 2023, 12:30 PM</div>
                                <div class="timeline-content">Order Out for Delivery</div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-date">May 15, 2023, 11:15 AM</div>
                                <div class="timeline-content">Order Processing</div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-date">May 15, 2023, 10:30 AM</div>
                                <div class="timeline-content">Order Placed</div>
                            </div> -->
                        </div>
                    </div>
                </div>

                <hr>

                <h6 class="mb-3">Order Items</h6>
                <div class="order-items">
                    <!-- <div class="order-item">
                        <div class="order-item-img">
                            <img src="/placeholder.svg?height=50&width=50" alt="Delicious Pizza">
                        </div>
                        <div class="order-item-details">
                            <div class="order-item-name">Delicious Pizza</div>
                            <div class="order-item-price">$20.99 <span class="order-item-quantity">x 2</span></div>
                        </div>
                        <div class="ms-auto">
                            <strong>$41.98</strong>
                        </div>
                    </div>
                    <div class="order-item">
                        <div class="order-item-img">
                            <img src="/placeholder.svg?height=50&width=50" alt="Tasty Burger">
                        </div>
                        <div class="order-item-details">
                            <div class="order-item-name">Tasty Burger</div>
                            <div class="order-item-price">$15.99 <span class="order-item-quantity">x 1</span></div>
                        </div>
                        <div class="ms-auto">
                            <strong>$15.99</strong>
                        </div>
                    </div>
                    <div class="order-item">
                        <div class="order-item-img">
                            <img src="/placeholder.svg?height=50&width=50" alt="French Fries">
                        </div>
                        <div class="order-item-details">
                            <div class="order-item-name">French Fries</div>
                            <div class="order-item-price">$8.99 <span class="order-item-quantity">x 2</span></div>
                        </div>
                        <div class="ms-auto">
                            <strong>$17.98</strong>
                        </div>
                    </div> -->
                </div>

                <div class="order-summary">
                    <div class="order-summary-item">
                        <span>Subtotal</span>
                        <span></span>
                    </div>
                    <div class="order-summary-item">
                        <span>Delivery Fee</span>
                        <span></span>
                    </div>
                    <div class="order-summary-item">
                        <span>Tax</span>
                        <span></span>
                    </div>
                    <div class="order-summary-item">
                        <span>Discount</span>
                        <span></span>
                    </div>
                    <div class="order-summary-item">
                        <span>Total</span>
                        <span></span>
                    </div>
                </div>

                <div class="mt-4">
                    <h6 class="mb-2">Notes</h6>
                    <p class="mb-0">Please deliver to the front desk. No onions in the burger please.</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button id="update-status-btn" type="button" class="btn btn-info" data-bs-toggle="modal"
                    data-bs-target="#updateStatusModal">
                    <i class="fas fa-edit me-2"></i> Update Status
                </button>
                <button type="button" class="btn btn-primary">
                    <i class="fas fa-print me-2"></i> Print Invoice
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Update Status Modal -->
<div class="modal fade" id="updateStatusModal" tabindex="-1" aria-labelledby="updateStatusModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateStatusModalLabel">Update Order Status - #ORD-0025</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="orderStatus" class="form-label">Order Status</label>
                        <select class="form-select" id="orderStatus">
                            <option value="pending">Pending</option>
                            <option value="processing">Processing</option>
                            <option value="out-for-delivery">Out for Delivery</option>
                            <option value="completed" selected>Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="statusNote" class="form-label">Status Note (Optional)</label>
                        <textarea class="form-control" id="statusNote" rows="3"
                            placeholder="Add a note about this status change..."></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Notify Customer</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="notifyEmail" checked>
                            <label class="form-check-label" for="notifyEmail">
                                Send Email Notification
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="notifySMS" checked>
                            <label class="form-check-label" for="notifySMS">
                                Send SMS Notification
                            </label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Update Status</button>
            </div>
        </div>
    </div>
</div>

<!-- Export Orders Modal -->
<div class="modal fade" id="exportOrdersModal" tabindex="-1" aria-labelledby="exportOrdersModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exportOrdersModalLabel">Export Orders</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label">Date Range</label>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="exportDateFrom" class="form-label">From</label>
                                    <input type="date" class="form-control" id="exportDateFrom">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="exportDateTo" class="form-label">To</label>
                                    <input type="date" class="form-control" id="exportDateTo">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="exportStatus" class="form-label">Order Status</label>
                        <select class="form-select" id="exportStatus">
                            <option value="all" selected>All Statuses</option>
                            <option value="pending">Pending</option>
                            <option value="delivering">Delivering</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exportFormat" class="form-label">Export Format</label>
                        <select class="form-select" id="exportFormat">
                            <option value="csv" selected>CSV</option>
                            <option value="excel">Excel</option>
                            <option value="pdf">PDF</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Include Fields</label>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="includeOrderId" checked>
                                    <label class="form-check-label" for="includeOrderId">
                                        Order ID
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="includeCustomer" checked>
                                    <label class="form-check-label" for="includeCustomer">
                                        Customer Details
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="includeDate" checked>
                                    <label class="form-check-label" for="includeDate">
                                        Order Date
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="includeTotal" checked>
                                    <label class="form-check-label" for="includeTotal">
                                        Order Total
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="includeStatus" checked>
                                    <label class="form-check-label" for="includeStatus">
                                        Order Status
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Export</button>
            </div>
        </div>
    </div>
</div>

<!-- Filter Modal -->
<div class="modal fade" id="filterOrdersModal" tabindex="-1" aria-labelledby="filterOrdersModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filterOrdersModalLabel">Filter Orders</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <!-- Price Range Filter -->
                    <div class="mb-3">
                        <label class="form-label">Price Range</label>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group mb-2">
                                    <span class="input-group-text bg-dark text-light border-secondary">VNĐ</span>
                                    <input type="number" class="form-control" id="priceMin" placeholder="Min">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-text bg-dark text-light border-secondary">VNĐ</span>
                                    <input type="number" class="form-control" id="priceMax" placeholder="Max">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Order ID/Name Filter -->
                    <div class="mb-3">
                        <label for="orderNameFilter" class="form-label">Order ID/Name</label>
                        <input type="text" class="form-control" id="orderNameFilter"
                            placeholder="Search by order ID or name...">
                    </div>

                    <!-- Customer Name Filter -->
                    <div class="mb-3">
                        <label for="customerNameFilter" class="form-label">Customer Name</label>
                        <input type="text" class="form-control" id="customerNameFilter"
                            placeholder="Search by customer name...">
                    </div>

                    <!-- Order Status Filter -->
                    <div class="mb-3">
                        <label class="form-label">Order Status</label>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="statusPending" checked>
                                    <label class="form-check-label" for="statusPending">
                                        <span class="order-status status-pending"></span> Pending
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="statusProcessing" checked>
                                    <label class="form-check-label" for="statusProcessing">
                                        <span class="order-status status-processing"></span> Delivering
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="statusCompleted" checked>
                                    <label class="form-check-label" for="statusCompleted">
                                        <span class="order-status status-completed"></span> Completed
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="statusCancelled" checked>
                                    <label class="form-check-label" for="statusCancelled">
                                        <span class="order-status status-cancelled"></span> Cancelled
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Date Range Filter -->
                    <div class="mb-3">
                        <label class="form-label">Order Date</label>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label for="filterDateFrom" class="form-label">From</label>
                                    <input type="date" class="form-control" id="filterDateFrom">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label for="filterDateTo" class="form-label">To</label>
                                    <input type="date" class="form-control" id="filterDateTo">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Method Filter -->
                    <div class="mb-3">
                        <label class="form-label">Payment Method</label>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="paymentCredit" checked>
                                    <label class="form-check-label" for="paymentCredit">
                                        Credit Card
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="paymentDebit" checked>
                                    <label class="form-check-label" for="paymentDebit">
                                        Debit Card
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="paymentPaypal" checked>
                                    <label class="form-check-label" for="paymentPaypal">
                                        PayPal
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="paymentCash" checked>
                                    <label class="form-check-label" for="paymentCash">
                                        Cash on Delivery
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-outline-primary">Reset Filters</button>
                <button type="button" class="btn btn-primary">Apply Filters</button>
            </div>
        </div>
    </div>
</div>