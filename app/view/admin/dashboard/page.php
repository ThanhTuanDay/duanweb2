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
                    
                            <canvas id="categoryChart">

                            </canvas>
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
                                    <!-- <tr>
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
                                </tbody> -->
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
                        <!-- <div class="recent-order-item">
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
                        </div> -->
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
    </div>