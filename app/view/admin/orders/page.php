<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feane Admin - Orders</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
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
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
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
    </div>

    <!-- Main Content -->
    <div class="main-content" id="main-content">
        <div class="topbar">
            <button class="toggle-sidebar" id="toggle-sidebar">
                <i class="fas fa-bars"></i>
            </button>
            <div class="user-info">
                <img src="/placeholder.svg?height=40&width=40" alt="Admin">
                <div class="dropdown">
                    <button class="dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        Admin User
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i> Profile</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i> Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Orders Management</h2>
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
                                    <input type="text" class="form-control" placeholder="Search orders...">
                                    <i class="fas fa-search search-icon"></i>
                                </div>
                                <div class="dropdown">
                                    <button class="btn btn-outline-primary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        Filter
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark" aria-labelledby="filterDropdown">
                                        <li><a class="dropdown-item" href="#">All Orders</a></li>
                                        <li><a class="dropdown-item" href="#">Pending</a></li>
                                        <li><a class="dropdown-item" href="#">Processing</a></li>
                                        <li><a class="dropdown-item" href="#">Shipped</a></li>
                                        <li><a class="dropdown-item" href="#">Delivered</a></li>
                                        <li><a class="dropdown-item" href="#">Cancelled</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
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
                                <tr>
                                    <td>#ORD-0025</td>
                                    <td>John Doe</td>
                                    <td>May 15, 2023</td>
                                    <td>$125.99</td>
                                    <td>Credit Card</td>
                                    <td><span class="badge bg-success">Delivered</span></td>
                                    <td>
                                        <div class="action-btns">
                                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#viewOrderModal"><i class="fas fa-eye"></i></button>
                                            <button class="btn btn-sm btn-info"><i class="fas fa-print"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#ORD-0024</td>
                                    <td>Jane Smith</td>
                                    <td>May 14, 2023</td>
                                    <td>$78.50</td>
                                    <td>PayPal</td>
                                    <td><span class="badge bg-warning">Processing</span></td>
                                    <td>
                                        <div class="action-btns">
                                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#viewOrderModal"><i class="fas fa-eye"></i></button>
                                            <button class="btn btn-sm btn-info"><i class="fas fa-print"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#ORD-0023</td>
                                    <td>Robert Johnson</td>
                                    <td>May 14, 2023</td>
                                    <td>$42.75</td>
                                    <td>Cash on Delivery</td>
                                    <td><span class="badge bg-info">Shipped</span></td>
                                    <td>
                                        <div class="action-btns">
                                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#viewOrderModal"><i class="fas fa-eye"></i></button>
                                            <button class="btn btn-sm btn-info"><i class="fas fa-print"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#ORD-0022</td>
                                    <td>Emily Davis</td>
                                    <td>May 13, 2023</td>
                                    <td>$96.25</td>
                                    <td>Credit Card</td>
                                    <td><span class="badge bg-danger">Cancelled</span></td>
                                    <td>
                                        <div class="action-btns">
                                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#viewOrderModal"><i class="fas fa-eye"></i></button>
                                            <button class="btn btn-sm btn-info"><i class="fas fa-print"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#ORD-0021</td>
                                    <td>Michael Wilson</td>
                                    <td>May 12, 2023</td>
                                    <td>$112.00</td>
                                    <td>PayPal</td>
                                    <td><span class="badge bg-success">Delivered</span></td>
                                    <td>
                                        <div class="action-btns">
                                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#viewOrderModal"><i class="fas fa-eye"></i></button>
                                            <button class="btn btn-sm btn-info"><i class="fas fa-print"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#ORD-0020</td>
                                    <td>Sarah Brown</td>
                                    <td>May 11, 2023</td>
                                    <td>$65.75</td>
                                    <td>Cash on Delivery</td>
                                    <td><span class="badge bg-primary">Pending</span></td>
                                    <td>
                                        <div class="action-btns">
                                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#viewOrderModal"><i class="fas fa-eye"></i></button>
                                            <button class="btn btn-sm btn-info"><i class="fas fa-print"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center mt-4">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- View Order Modal -->
    <div class="modal fade" id="viewOrderModal" tabindex="-1" aria-labelledby="viewOrderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewOrderModalLabel">Order Details - #ORD-0025</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="order-details-row">
                                <div class="order-details-label">Customer Information</div>
                                <div>John Doe</div>
                                <div>john.doe@example.com</div>
                                <div>+1 (555) 123-4567</div>
                            </div>
                            <div class="order-details-row">
                                <div class="order-details-label">Shipping Address</div>
                                <div>123 Main Street</div>
                                <div>Apt 4B</div>
                                <div>New York, NY 10001</div>
                                <div>United States</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="order-details-row">
                                <div class="order-details-label">Order Information</div>
                                <div><strong>Order ID:</strong> #ORD-0025</div>
                                <div><strong>Date:</strong> May 15, 2023</div>
                                <div><strong>Payment Method:</strong> Credit Card</div>
                                <div><strong>Status:</strong> <span class="badge bg-success">Delivered</span></div>
                            </div>
                            <div class="order-details-row">
                                <div class="order-details-label">Order Timeline</div>
                                <div class="timeline">
                                    <div class="timeline-item">
                                        <div class="timeline-date">May 15, 2023 - 18:30</div>
                                        <div class="timeline-content">Order delivered</div>
                                    </div>
                                    <div class="timeline-item">
                                        <div class="timeline-date">May 14, 2023 - 10:15</div>
                                        <div class="timeline-content">Order shipped</div>
                                    </div>
                                    <div class="timeline-item">
                                        <div class="timeline-date">May 13, 2023 - 14:45</div>
                                        <div class="timeline-content">Order processed</div>
                                    </div>
                                    <div class="timeline-item">
                                        <div class="timeline-date">May 13, 2023 - 09:20</div>
                                        <div class="timeline-content">Payment confirmed</div>
                                    </div>
                                    <div class="timeline-item">
                                        <div class="timeline-date">May 13, 2023 - 09:10</div>
                                        <div class="timeline-content">Order placed</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="order-details-row mt-4">
                        <div class="order-details-label">Order Items</div>
                        <div class="order-product-item">
                            <div class="order-product-img">
                                <img src="/placeholder.svg?height=50&width=50" alt="Delicious Burger">
                            </div>
                            <div class="order-product-info">
                                <h6>Delicious Burger</h6>
                                <p>Quantity: 2</p>
                            </div>
                            <div class="order-product-price">$31.98</div>
                        </div>
                        <div class="order-product-item">
                            <div class="order-product-img">
                                <img src="/placeholder.svg?height=50&width=50" alt="French Fries">
                            </div>
                            <div class="order-product-info">
                                <h6>French Fries</h6>
                                <p>Quantity: 2</p>
                            </div>
                            <div class="order-product-price">$17.00</div>
                        </div>
                        <div class="order-product-item">
                            <div class="order-product-img">
                                <img src="/placeholder.svg?height=50&width=50" alt="Cheese Pizza">
                            </div>
                            <div class="order-product-info">
                                <h6>Cheese Pizza</h6>
                                <p>Quantity: 1</p>
                            </div>
                            <div class="order-product-price">$18.99</div>
                        </div>
                        <div class="order-product-item">
                            <div class="order-product-img">
                                <img src="/placeholder.svg?height=50&width=50" alt="Chocolate Shake">
                            </div>
                            <div class="order-product-info">
                                <h6>Chocolate Shake</h6>
                                <p>Quantity: 2</p>
                            </div>
                            <div class="order-product-price">$12.50</div>
                        </div>
                    </div>
                    
                    <div class="row mt-4">
                        <div class="col-md-6 offset-md-6">
                            <div class="order-details-row">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Subtotal:</span>
                                    <span>$80.47</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Shipping:</span>
                                    <span>$5.99</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Tax:</span>
                                    <span>$8.05</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Discount:</span>
                                    <span>-$10.00</span>
                                </div>
                                <div class="d-flex justify-content-between fw-bold">
                                    <span>Total:</span>
                                    <span>$125.99</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="dropdown me-2">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="updateStatusDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            Update Status
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="updateStatusDropdown">
                            <li><a class="dropdown-item" href="#">Pending</a></li>
                            <li><a class="dropdown-item" href="#">Processing</a></li>
                            <li><a class="dropdown-item" href="#">Shipped</a></li>
                            <li><a class="dropdown-item" href="#">Delivered</a></li>
                            <li><a class="dropdown-item" href="#">Cancelled</a></li>
                        </ul>
                    </div>
                    <button type="button" class="btn btn-info me-2"><i class="fas fa-print me-2"></i> Print Invoice</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle Sidebar
        document.getElementById('toggle-sidebar').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('active');
            document.getElementById('main-content').classList.toggle('active');
        });
    </script>
</body>
</html>