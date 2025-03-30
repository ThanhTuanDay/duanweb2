<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feane Admin - Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.css">
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
        
        .stats-card {
            background-color: var(--dark-light);
            border-radius: 5px;
            padding: 20px;
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .stats-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 24px;
        }
        
        .stats-info h5 {
            font-size: 14px;
            color: var(--gray);
            margin-bottom: 5px;
        }
        
        .stats-info h3 {
            font-size: 24px;
            margin: 0;
        }
        
        .stats-info p {
            font-size: 13px;
            margin: 5px 0 0;
        }
        
        .stats-info p.positive {
            color: var(--success);
        }
        
        .stats-info p.negative {
            color: var(--danger);
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
        
        .btn-outline-primary {
            color: var(--primary);
            border-color: var(--primary);
        }
        
        .btn-outline-primary:hover {
            background-color: var(--primary);
            border-color: var(--primary);
        }
        
        .chart-container {
            position: relative;
            height: 300px;
        }
        
        .recent-order-item {
            display: flex;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .recent-order-item:last-child {
            border-bottom: none;
        }
        
        .recent-order-img {
            width: 50px;
            height: 50px;
            border-radius: 5px;
            overflow: hidden;
            margin-right: 15px;
        }
        
        .recent-order-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .recent-order-info {
            flex: 1;
        }
        
        .recent-order-info h6 {
            margin: 0 0 5px;
            font-size: 14px;
        }
        
        .recent-order-info p {
            margin: 0;
            font-size: 12px;
            color: var(--gray);
        }
        
        .recent-order-price {
            font-weight: 600;
            color: var(--primary);
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
        
        @media (max-width: 576px) {
            .stats-card {
                flex-direction: column;
                text-align: center;
            }
            
            .stats-icon {
                margin-right: 0;
                margin-bottom: 15px;
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
            <a href="admin-dashboard.html" class="menu-item active">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
            <a href="admin-products.html" class="menu-item">
                <i class="fas fa-hamburger"></i> Products
            </a>
            <a href="admin-categories.html" class="menu-item">
                <i class="fas fa-list"></i> Categories
            </a>
            <a href="admin-orders.html" class="menu-item">
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
            <h2 class="mb-4">Dashboard</h2>
            
            <!-- Stats Cards -->
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="stats-card">
                        <div class="stats-icon" style="background-color: rgba(220, 53, 69, 0.2); color: #dc3545;">
                            <i class="fas fa-shopping-bag"></i>
                        </div>
                        <div class="stats-info">
                            <h5>Total Orders</h5>
                            <h3>1,258</h3>
                            <p class="positive"><i class="fas fa-arrow-up"></i> 15.8% from last month</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="stats-card">
                        <div class="stats-icon" style="background-color: rgba(255, 193, 7, 0.2); color: #ffc107;">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div class="stats-info">
                            <h5>Revenue</h5>
                            <h3>$15,852</h3>
                            <p class="positive"><i class="fas fa-arrow-up"></i> 8.2% from last month</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="stats-card">
                        <div class="stats-icon" style="background-color: rgba(40, 167, 69, 0.2); color: #28a745;">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stats-info">
                            <h5>Total Customers</h5>
                            <h3>854</h3>
                            <p class="positive"><i class="fas fa-arrow-up"></i> 12.5% from last month</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="stats-card">
                        <div class="stats-icon" style="background-color: rgba(23, 162, 184, 0.2); color: #17a2b8;">
                            <i class="fas fa-hamburger"></i>
                        </div>
                        <div class="stats-info">
                            <h5>Total Products</h5>
                            <h3>45</h3>
                            <p class="positive"><i class="fas fa-arrow-up"></i> 5.2% from last month</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Charts -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Sales Overview</h5>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-sm btn-outline-primary active">Weekly</button>
                                <button type="button" class="btn btn-sm btn-outline-primary">Monthly</button>
                                <button type="button" class="btn btn-sm btn-outline-primary">Yearly</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="salesChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Top Categories</h5>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="categoryChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Recent Orders and Top Products -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Recent Orders</h5>
                            <a href="admin-orders.html" class="btn btn-sm btn-primary">View All</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Customer</th>
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>#ORD-0025</td>
                                            <td>John Doe</td>
                                            <td>May 15, 2023</td>
                                            <td>$125.99</td>
                                            <td><span class="badge bg-success">Delivered</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>#ORD-0024</td>
                                            <td>Jane Smith</td>
                                            <td>May 14, 2023</td>
                                            <td>$78.50</td>
                                            <td><span class="badge bg-warning">Processing</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>#ORD-0023</td>
                                            <td>Robert Johnson</td>
                                            <td>May 14, 2023</td>
                                            <td>$42.75</td>
                                            <td><span class="badge bg-info">Shipped</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>#ORD-0022</td>
                                            <td>Emily Davis</td>
                                            <td>May 13, 2023</td>
                                            <td>$96.25</td>
                                            <td><span class="badge bg-danger">Cancelled</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>#ORD-0021</td>
                                            <td>Michael Wilson</td>
                                            <td>May 12, 2023</td>
                                            <td>$112.00</td>
                                            <td><span class="badge bg-success">Delivered</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Top Selling Products</h5>
                            <a href="admin-products.html" class="btn btn-sm btn-primary">View All</a>
                        </div>
                        <div class="card-body">
                            <div class="recent-order-item">
                                <div class="recent-order-img">
                                    <img src="/placeholder.svg?height=50&width=50" alt="Delicious Burger">
                                </div>
                                <div class="recent-order-info">
                                    <h6>Delicious Burger</h6>
                                    <p>Sold: 254 items</p>
                                </div>
                                <div class="recent-order-price">$15.99</div>
                            </div>
                            <div class="recent-order-item">
                                <div class="recent-order-img">
                                    <img src="/placeholder.svg?height=50&width=50" alt="Cheese Pizza">
                                </div>
                                <div class="recent-order-info">
                                    <h6>Cheese Pizza</h6>
                                    <p>Sold: 186 items</p>
                                </div>
                                <div class="recent-order-price">$18.99</div>
                            </div>
                            <div class="recent-order-item">
                                <div class="recent-order-img">
                                    <img src="/placeholder.svg?height=50&width=50" alt="French Fries">
                                </div>
                                <div class="recent-order-info">
                                    <h6>French Fries</h6>
                                    <p>Sold: 152 items</p>
                                </div>
                                <div class="recent-order-price">$8.50</div>
                            </div>
                            <div class="recent-order-item">
                                <div class="recent-order-img">
                                    <img src="/placeholder.svg?height=50&width=50" alt="Pasta Carbonara">
                                </div>
                                <div class="recent-order-info">
                                    <h6>Pasta Carbonara</h6>
                                    <p>Sold: 134 items</p>
                                </div>
                                <div class="recent-order-price">$14.75</div>
                            </div>
                            <div class="recent-order-item">
                                <div class="recent-order-img">
                                    <img src="/placeholder.svg?height=50&width=50" alt="Chocolate Shake">
                                </div>
                                <div class="recent-order-info">
                                    <h6>Chocolate Shake</h6>
                                    <p>Sold: 98 items</p>
                                </div>
                                <div class="recent-order-price">$6.25</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
    <script>
        // Toggle Sidebar
        document.getElementById('toggle-sidebar').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('active');
            document.getElementById('main-content').classList.toggle('active');
        });
        
        // Sales Chart
        const salesCtx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(salesCtx, {
            type: 'line',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                datasets: [{
                    label: 'Sales',
                    data: [1200, 1900, 1500, 2500, 1800, 3000, 2800],
                    backgroundColor: 'rgba(255, 190, 51, 0.2)',
                    borderColor: '#ffbe33',
                    borderWidth: 2,
                    tension: 0.3,
                    pointBackgroundColor: '#ffbe33',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(255, 255, 255, 0.1)'
                        },
                        ticks: {
                            color: '#fff'
                        }
                    },
                    x: {
                        grid: {
                            color: 'rgba(255, 255, 255, 0.1)'
                        },
                        ticks: {
                            color: '#fff'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
        
        // Category Chart
        const categoryCtx = document.getElementById('categoryChart').getContext('2d');
        const categoryChart = new Chart(categoryCtx, {
            type: 'doughnut',
            data: {
                labels: ['Burger', 'Pizza', 'Pasta', 'Fries', 'Drinks'],
                datasets: [{
                    data: [35, 25, 20, 15, 5],
                    backgroundColor: [
                        '#dc3545',
                        '#ffc107',
                        '#28a745',
                        '#17a2b8',
                        '#6c757d'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#fff',
                            padding: 15,
                            usePointStyle: true,
                            pointStyle: 'circle'
                        }
                    }
                },
                cutout: '70%'
            }
        });
    </script>
</body>
</html>