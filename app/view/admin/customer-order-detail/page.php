<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Customer Order History</h2>
        <a href="/duanweb2/admin/dashboard/page" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
        </a>
    </div>

    <!-- Customer Profile Card -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-2 text-center">

                </div>
                <div class="col-md-5">
                    <h4 id="name-text">John Doe</h4>
                    <p class=" mb-1">
                        <i class="fas fa-envelope me-2"></i>
                    </p>
                    <p class=" mb-1">
                        <i class="fas fa-phone me-2"></i>
                    </p>
                    <p class=" mb-1">
                        <i class="fas fa-map-marker-alt me-2"></i>
                    </p>
                    <p class=" mb-0">
                        <i class="fas fa-calendar-alt me-2"></i>
                    </p>
                </div>
                <div class="col-md-5">
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="p-3 border rounded bg-light">
                                <h6 class="mb-1">Total Orders</h6>
                                <h4 class="mb-0">24</h4>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 border rounded bg-light">
                                <h6 class="mb-1">Total Spent</h6>
                                <h4 class="mb-0">$2,845.50</h4>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 border rounded bg-light">
                                <h6 class="mb-1">Avg. Order Value</h6>
                                <h4 class="mb-0">$118.56</h4>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 border rounded bg-light">
                                <h6 class="mb-1">Last Order</h6>
                                <h4 class="mb-0">May 15, 2023</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Order History -->
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Order History</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Date</th>
                            <th>Items</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Payment Method</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#ORD12345</td>
                            <td>May 15, 2023</td>
                            <td>3</td>
                            <td>$125.99</td>
                            <td>
                                <span class="badge bg-success">Delivered</span>
                            </td>
                            <td>Credit Card</td>
                            <td>
                                <a href="order-detail.html?id=ORD12345" class="btn btn-sm btn-primary">
                                    <i class="fas fa-eye"></i> View
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>#ORD12340</td>
                            <td>May 10, 2023</td>
                            <td>2</td>
                            <td>$89.50</td>
                            <td>
                                <span class="badge bg-success">Delivered</span>
                            </td>
                            <td>PayPal</td>
                            <td>
                                <a href="order-detail.html?id=ORD12340" class="btn btn-sm btn-primary">
                                    <i class="fas fa-eye"></i> View
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>#ORD12335</td>
                            <td>May 5, 2023</td>
                            <td>4</td>
                            <td>$156.75</td>
                            <td>
                                <span class="badge bg-success">Delivered</span>
                            </td>
                            <td>Credit Card</td>
                            <td>
                                <a href="order-detail.html?id=ORD12335" class="btn btn-sm btn-primary">
                                    <i class="fas fa-eye"></i> View
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>#ORD12330</td>
                            <td>Apr 28, 2023</td>
                            <td>1</td>
                            <td>$45.99</td>
                            <td>
                                <span class="badge bg-success">Delivered</span>
                            </td>
                            <td>PayPal</td>
                            <td>
                                <a href="order-detail.html?id=ORD12330" class="btn btn-sm btn-primary">
                                    <i class="fas fa-eye"></i> View
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>#ORD12325</td>
                            <td>Apr 22, 2023</td>
                            <td>2</td>
                            <td>$78.50</td>
                            <td>
                                <span class="badge bg-success">Delivered</span>
                            </td>
                            <td>Credit Card</td>
                            <td>
                                <a href="order-detail.html?id=ORD12325" class="btn btn-sm btn-primary">
                                    <i class="fas fa-eye"></i> View
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>#ORD12320</td>
                            <td>Apr 15, 2023</td>
                            <td>3</td>
                            <td>$112.25</td>
                            <td>
                                <span class="badge bg-success">Delivered</span>
                            </td>
                            <td>PayPal</td>
                            <td>
                                <a href="order-detail.html?id=ORD12320" class="btn btn-sm btn-primary">
                                    <i class="fas fa-eye"></i> View
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>#ORD12315</td>
                            <td>Apr 10, 2023</td>
                            <td>1</td>
                            <td>$39.99</td>
                            <td>
                                <span class="badge bg-success">Delivered</span>
                            </td>
                            <td>Credit Card</td>
                            <td>
                                <a href="order-detail.html?id=ORD12315" class="btn btn-sm btn-primary">
                                    <i class="fas fa-eye"></i> View
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>#ORD12310</td>
                            <td>Apr 5, 2023</td>
                            <td>2</td>
                            <td>$85.50</td>
                            <td>
                                <span class="badge bg-success">Delivered</span>
                            </td>
                            <td>PayPal</td>
                            <td>
                                <a href="order-detail.html?id=ORD12310" class="btn btn-sm btn-primary">
                                    <i class="fas fa-eye"></i> View
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>#ORD12305</td>
                            <td>Mar 28, 2023</td>
                            <td>4</td>
                            <td>$165.75</td>
                            <td>
                                <span class="badge bg-success">Delivered</span>
                            </td>
                            <td>Credit Card</td>
                            <td>
                                <a href="order-detail.html?id=ORD12305" class="btn btn-sm btn-primary">
                                    <i class="fas fa-eye"></i> View
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>#ORD12300</td>
                            <td>Mar 22, 2023</td>
                            <td>2</td>
                            <td>$92.50</td>
                            <td>
                                <span class="badge bg-success">Delivered</span>
                            </td>
                            <td>PayPal</td>
                            <td>
                                <a href="order-detail.html?id=ORD12300" class="btn btn-sm btn-primary">
                                    <i class="fas fa-eye"></i> View
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>

    document.getElementById('toggle-sidebar').addEventListener('click', function() {
        document.getElementById('sidebar').classList.toggle('active');
        document.getElementById('main-content').classList.toggle('active');
    });

   
    document.addEventListener('DOMContentLoaded', function() {
        const today = new Date();
        const thirtyDaysAgo = new Date(today);
        thirtyDaysAgo.setDate(today.getDate() - 30);

    
        const formatDate = (date) => {
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const day = String(date.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        };


        const customerDateFrom = document.getElementById('customerDateFrom');
        const customerDateTo = document.getElementById('customerDateTo');

        if (customerDateFrom) customerDateFrom.value = formatDate(thirtyDaysAgo);
        if (customerDateTo) customerDateTo.value = formatDate(today);
    });
</script>