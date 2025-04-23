<?php
require(dirname(__DIR__) . "/../../controller/admin.controller.php");

function getStatusBadgeClass(string $status): string
{
    return match ($status) {
        'completed', 'delivered' => 'bg-success',
        'pending' => 'bg-secondary',
        'processing' => 'bg-warning',
        'shipped' => 'bg-info',
        'canceled', 'cancelled' => 'bg-danger',
        default => 'bg-dark'
    };
}
$adminController = new AdminController();
$data = $adminController->getDashboardData();

$totalOrders = $data['totalOrders'];
$totalRevenue = $data['totalRevenue'];
$totalCustomers = $data['totalCustomers'];
$totalProducts = $data['totalProducts'];
$topProducts = $data['topProducts'];
$recentOrders = $data['recentOrders'];
$topCategories = $data['topCategories'];


$labels = [];
$totals = [];

foreach ($data['topCategories'] as $row) {
    $labels[] = $row['category_name'];
    $totals[] = $row['total_sold'];
}

$categoryLabels = json_encode($labels);
$categoryTotals = json_encode($totals);
?>


< <!-- Main Content -->
    <div class="container-fluid">
        <h2 class="mb-4">Dashboard</h2>
        <div id="category-chart-data" data-labels='<?= json_encode($categoryLabels) ?>'
            data-values='<?= htmlspecialchars(json_encode($categoryTotals), ENT_QUOTES, 'UTF-8') ?>'>
        </div>
        <!-- Stats Cards -->
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <div class="stats-card">
                    <div class="stats-icon" style="background-color: rgba(220, 53, 69, 0.2); color: #dc3545;">
                        <i class="fas fa-shopping-bag"></i>
                    </div>
                    <div class="stats-info">
                        <h5>Total Orders</h5>
                        <h3><?= number_format($totalOrders) ?></h3>
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
                        <h3><?= number_format($totalRevenue) ?></h3>
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
                        <h3><?= number_format($totalCustomers) ?></h3>
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
                        <h3><?= number_format($totalProducts) ?></h3>
                        <p class="positive"><i class="fas fa-arrow-up"></i> 5.2% from last month</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts -->
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <h5 class="mb-0">Sales Overview</h5>
                            <div class="d-flex align-items-center gap-2 mt-2 mt-md-0">
                                <!-- Date Range Picker -->
                                <div class="date-range-picker d-flex align-items-center">
                                    <div class="input-group input-group-sm me-2">
                                        <span class="input-group-text bg-dark text-light border-secondary">From</span>
                                        <input type="date" class="form-control form-control-sm" id="dateFrom">
                                    </div>
                                    <div class="input-group input-group-sm me-2">
                                        <span class="input-group-text bg-dark text-light border-secondary">To</span>
                                        <input type="date" class="form-control form-control-sm" id="dateTo">
                                    </div>
                                    <button type="button" class="btn btn-sm btn-primary" id="applyDateRange">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </div>
                                <!-- Time Period Buttons -->
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-sm btn-outline-primary active">Weekly</button>
                                    <button type="button" class="btn btn-sm btn-outline-primary">Monthly</button>
                                    <button type="button" class="btn btn-sm btn-outline-primary">Yearly</button>
                                </div>
                            </div>
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
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Top Categories</h5>
                            <!-- Date Range Picker for Categories Chart -->
                            <div class="dropdown">
                                <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" id="categoryDateRange" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-calendar-alt me-1"></i> Date Range
                                </button>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-dark p-3" style="min-width: 300px;">
                                    <div class="mb-2">
                                        <label for="categoryDateFrom" class="form-label">From</label>
                                        <input type="date" class="form-control form-control-sm" id="categoryDateFrom">
                                    </div>
                                    <div class="mb-2">
                                        <label for="categoryDateTo" class="form-label">To</label>
                                        <input type="date" class="form-control form-control-sm" id="categoryDateTo">
                                    </div>
                                    <div class="d-grid">
                                        <button type="button" class="btn btn-sm btn-primary" id="applyCategoryDateRange">Apply</button>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                        <a href="/duanweb2/admin/orders/page" class="btn btn-sm btn-primary">View All</a>
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
                                    <?php foreach ($recentOrders as $order): ?>
                                        <tr>
                                            <td>#<?= strtoupper(substr($order['id'], 0, 8)) ?></td>
                                            <td><?= htmlspecialchars($order['user_id']) ?></td>
                                            <!-- Có thể thay bằng tên nếu em join users -->
                                            <td><?= date('M d, Y', strtotime($order['created_at'])) ?></td>
                                            <td>$<?= number_format($order['total_price'], 2) ?></td>
                                            <td>
                                                <span class="badge <?= getStatusBadgeClass($order['status']) ?>">
                                                    <?= ucfirst($order['status']) ?>
                                                </span>
                                            </td>
                                            <td>
                                                <a href="order-detail.php?id=<?= $order['id'] ?>"
                                                    class="btn btn-sm btn-primary">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Top Selling Products</h5>
                        <a href="/duanweb2/admin/product/page" class="btn btn-sm btn-primary">View All</a>
                    </div>
                    <div class="card-body">
                        <?php foreach ($topProducts as $product): ?>
                            <div class="recent-order-item">
                                <div class="recent-order-img">
                                    <img src="<?= htmlspecialchars($product['image_url']) ?>"
                                        alt="<?= htmlspecialchars($product['name']) ?>" height="50" width="50">
                                </div>
                                <div class="recent-order-info">
                                    <h6><?= htmlspecialchars($product['name']) ?></h6>
                                    <p>Sold: <?= number_format($product['total_sold']) ?> items</p>
                                </div>
                                <div class="recent-order-price">
                                    $<?= number_format($product['price'], 2) ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top Customers Section -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <h5 class="mb-0">Top Customers by Purchase Volume</h5>
                            <div class="d-flex align-items-center gap-2 mt-2 mt-md-0">
                                <!-- Customer Count Selector -->
                                <div class="input-group input-group-sm me-2" style="width: 150px;">
                                    <span class="input-group-text bg-dark text-light border-secondary">Show</span>
                                    <select class="form-select form-select-sm" id="customerCount">
                                        <option value="5" selected>5 Customers</option>
                                        <option value="10">10 Customers</option>
                                        <option value="15">15 Customers</option>
                                        <option value="20">20 Customers</option>
                                    </select>
                                </div>

                                <!-- Date Range Picker for Top Customers -->
                                <div class="date-range-picker d-flex align-items-center">
                                    <div class="input-group input-group-sm me-2">
                                        <span class="input-group-text bg-dark text-light border-secondary">From</span>
                                        <input type="date" class="form-control form-control-sm" id="customerDateFrom">
                                    </div>
                                    <div class="input-group input-group-sm me-2">
                                        <span class="input-group-text bg-dark text-light border-secondary">To</span>
                                        <input type="date" class="form-control form-control-sm" id="customerDateTo">
                                    </div>
                                    <button type="button" class="btn btn-sm btn-primary" id="applyCustomerFilter">
                                        <i class="fas fa-filter"></i> Apply
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover" id="topCustomersTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Customer</th>
                                        <th>Email</th>
                                        <th>Total Orders</th>
                                        <th>Total Spent</th>
                                        <th>Last Order</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Example data rows -->
                                    <tr>
                                        <td>1</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                
                                                <div>
                                                    <h6 class="mb-0">John Doe</h6>
                                                    <small class="text-muted">CUST001</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>john.doe@example.com</td>
                                        <td>24</td>
                                        <td>$2,845.50</td>
                                        <td>May 15, 2023</td>
                                        <td>
                                            <a href="/duanweb2/admin/cusomer-order-detail/page?userId=ad" class="btn btn-sm btn-primary">
                                                <i class="fas fa-eye me-1"></i>Details
                                            </a>
                                        </td>
                                    </tr>
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>