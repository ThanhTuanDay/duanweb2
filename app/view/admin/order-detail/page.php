<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4 fade-in">
        <h2>Chi tiết đơn hàng <span class="text-primary">#ORD12345</span></h2>
        <div>
            <a id="return-btn"  class="btn btn-outline-primary me-2">
                <i class="fas fa-arrow-left me-2"></i>Quay lại
            </a>
            <a href="#" class="btn btn-primary">
                <i class="fas fa-print me-2"></i>In hóa đơn 
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Order Info -->
        <div class="col-lg-8">
            <!-- Order Details Card -->
            <div class="card mb-4 slide-in-left" style="animation-delay: 0.1s;">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Thông tin đơn hàng </h5>
                    <span class="status-badge delivered">
                        <i class="fas fa-check-circle"></i>Đã giao hàng
                    </span>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="info-item">
                                <div class="info-icon"><i class="fas fa-hashtag"></i></div>
                                <div><strong>ID đơn hàng:</strong> #ORD12345</div>
                            </div>
                            <div class="info-item">
                                <div class="info-icon"><i class="fas fa-calendar"></i></div>
                                <div><strong>Ngày đặt hàng:</strong> May 15, 2023, 2:30 PM</div>
                            </div>
                            <div class="info-item">
                                <div class="info-icon"><i class="fas fa-credit-card"></i></div>
                                <div><strong>Phương thức thanh toán:</strong> Thanh toán khi nhận hàng  </div>
                            </div>
                            <div class="info-item">
                                <div class="info-icon"><i class="fas fa-money-check"></i></div>
                                <div>
                                    <strong>Trạng thái:</strong>
                                    <span class="status-badge paid">
                                        <i class="fas fa-check-circle"></i>Đã thanh toán
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" id="customer-info">
                            <div class="info-item">
                                <div class="info-icon"><i class="fas fa-user"></i></div>
                                <div id="customer-name"><strong>Tên khách hàng:</strong> John Doe</div>
                            </div>
                            <div class="info-item">
                                <div class="info-icon"><i class="fas fa-envelope"></i></div>
                                <div id="customer-email"><strong>Email:</strong> john.doe@example.com</div>
                            </div>
                            <div class="info-item">
                                <div class="info-icon"><i class="fas fa-phone"></i></div>
                                <div id="customer-phone"><strong>Số điện thoại  :</strong> +1 (555) 123-4567</div>
                            </div>
                            <div class="info-item">
                                <div class="info-icon"><i class="fas fa-id-card"></i></div>
                                <div id="customer-id"><strong>ID khách hàng:</strong> CUST001</div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="address-card">
                                <h6><i class="fas fa-shipping-fast"></i> Shipping Address</h6>
                                <p>John Doe</p>
                                <p>123 Main Street, Apt 4B</p>
                                <p>New York, NY 10001</p>
                                <p>United States</p>
                                <p class="mb-0">+1 (555) 123-4567</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="address-card">
                                <h6><i class="fas fa-file-invoice"></i> Billing Address</h6>
                                <p>John Doe</p>
                                <p>123 Main Street, Apt 4B</p>
                                <p>New York, NY 10001</p>
                                <p>United States</p>
                                <p class="mb-0">+1 (555) 123-4567</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Items Card -->
            <div class="card mb-4 slide-in-left" style="animation-delay: 0.2s;">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-shopping-cart me-2"></i>Đơn hàng</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th class="text-end">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="fade-in" style="animation-delay: 0.3s;">
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://via.placeholder.com/60" alt="Delicious Pizza" class="product-img me-3">
                                            <div>
                                                <h6 class="mb-0">Delicious Pizza</h6>
                                                <small class="text-muted">Large, Extra Cheese</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>$20.00</td>
                                    <td>2</td>
                                    <td class="text-end">$40.00</td>
                                </tr>
                                <tr class="fade-in" style="animation-delay: 0.4s;">
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://via.placeholder.com/60" alt="Tasty Burger" class="product-img me-3">
                                            <div>
                                                <h6 class="mb-0">Tasty Burger</h6>
                                                <small class="text-muted">Double Patty, Cheese</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>$15.00</td>
                                    <td>3</td>
                                    <td class="text-end">$45.00</td>
                                </tr>
                                <tr class="fade-in" style="animation-delay: 0.5s;">
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://via.placeholder.com/60" alt="French Fries" class="product-img me-3">
                                            <div>
                                                <h6 class="mb-0">French Fries</h6>
                                                <small class="text-muted">Large</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>$10.00</td>
                                    <td>2</td>
                                    <td class="text-end">$20.00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Delivery Information Card -->
            <!-- <div class="card mb-4 slide-in-left" style="animation-delay: 0.3s;">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-truck me-2"></i>Delivery Information</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="info-item">
                                <div class="info-icon"><i class="fas fa-shipping-fast"></i></div>
                                <div><strong>Delivery Method:</strong> Standard Delivery</div>
                            </div>
                            <div class="info-item">
                                <div class="info-icon"><i class="fas fa-barcode"></i></div>
                                <div><strong>Tracking Number:</strong> TRK789012345</div>
                            </div>
                            <div class="info-item">
                                <div class="info-icon"><i class="fas fa-calendar-check"></i></div>
                                <div><strong>Estimated Delivery:</strong> May 16, 2023</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <div class="info-icon"><i class="fas fa-building"></i></div>
                                <div><strong>Delivery Partner:</strong> FastDelivery</div>
                            </div>
                            <div class="info-item">
                                <div class="info-icon"><i class="fas fa-user-tie"></i></div>
                                <div><strong>Driver Name:</strong> Michael Brown</div>
                            </div>
                            <div class="info-item">
                                <div class="info-icon"><i class="fas fa-phone-alt"></i></div>
                                <div><strong>Driver Contact:</strong> +1 (555) 987-6543</div>
                            </div>
                        </div>
                    </div>

                    <div class="delivery-map bg-dark p-3 text-center rounded bounce-in" style="animation-delay: 0.6s;">
                        <div class="pulse"></div>
                        <img src="https://via.placeholder.com/600x300" alt="Delivery Map" class="img-fluid rounded">
                    </div>
                </div>
            </div> -->

            <!-- Customer Notes Card -->
            <div class="card mb-4 slide-in-left" style="animation-delay: 0.4s;">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-sticky-note me-2"></i>Ghi chú</h5>
                </div>
                <div class="card-body">
                    <div class="bg-light p-3 rounded border">
                        <i class="fas fa-quote-left text-primary me-2"></i>
                        <p class="mb-0">
                        Vui lòng để lại đơn hàng ở cửa. Bấm chuông cửa khi nhận hàng. Cảm ơn bạn!</p>
                        <i class="fas fa-quote-right text-primary ms-2"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Summary and Status -->
        <div class="col-lg-4">
            <!-- Order Summary Card -->
            <div class="card mb-4 slide-in-right" style="animation-delay: 0.1s;">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-file-invoice-dollar me-2"></i>Hóa đơn</h5>
                </div>
                <div class="card-body">
                    <div class="order-summary-item">
                        <span><i class="fas fa-shopping-basket text-primary me-2"></i>Tổng tạm</span>
                        <span>$105.00</span>
                    </div>
                    <div class="order-summary-item">
                        <span><i class="fas fa-truck text-primary me-2"></i>Phí vận chuyển</span>
                        <span>$5.99</span>
                    </div>
                    <div class="order-summary-item">
                        <span><i class="fas fa-percentage text-primary me-2"></i>Thuế</span>
                        <span>$9.32</span>
                    </div>
                    <div class="order-summary-item">
                        <span><i class="fas fa-tag text-primary me-2"></i>Giảm giá</span>
                        <span>-$10.50</span>
                    </div>
                    <div class="order-summary-item">
                        <span><i class="fas fa-hand-holding-usd text-primary me-2"></i>Tip</span>
                        <span>$5.00</span>
                    </div>
                    <div class="order-summary-item">
                        <span><i class="fas fa-money-bill-wave text-primary me-2"></i>Thành tiền</span>
                        <span>$114.81</span>
                    </div>
                </div>
            </div>

            <!-- Order Status Card -->
            <div class="card mb-4 slide-in-right" style="animation-delay: 0.2s;">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-tasks me-2"></i>Trạng thái đơn hàng</h5>
                </div>
                <div class="card-body">
                    <div class="order-status-timeline" id="statusTimeline">
                        <div class="timeline-item completed">
                            <div class="timeline-date"><i class="fas fa-clock"></i> May 15, 2023, 2:30 PM</div>
                            <div class="timeline-title"><i class="fas fa-shopping-cart"></i> Order Placed</div>
                            <div class="timeline-text">Order #ORD12345 has been placed successfully.</div>
                        </div>
                        <div class="timeline-item completed">
                            <div class="timeline-date"><i class="fas fa-clock"></i> May 15, 2023, 2:35 PM</div>
                            <div class="timeline-title"><i class="fas fa-credit-card"></i> Payment Confirmed</div>
                            <div class="timeline-text">Payment of $114.81 has been received.</div>
                        </div>
                        <div class="timeline-item completed">
                            <div class="timeline-date"><i class="fas fa-clock"></i> May 15, 2023, 2:45 PM</div>
                            <div class="timeline-title"><i class="fas fa-utensils"></i> Order Processing</div>
                            <div class="timeline-text">Your order is being prepared in the kitchen.</div>
                        </div>
                        <div class="timeline-item completed">
                            <div class="timeline-date"><i class="fas fa-clock"></i> May 15, 2023, 3:15 PM</div>
                            <div class="timeline-title"><i class="fas fa-check-circle"></i> Order Ready</div>
                            <div class="timeline-text">Your order is ready and waiting for pickup by delivery partner.</div>
                        </div>
                        <div class="timeline-item completed">
                            <div class="timeline-date"><i class="fas fa-clock"></i> May 15, 2023, 3:30 PM</div>
                            <div class="timeline-title"><i class="fas fa-truck"></i> Out for Delivery</div>
                            <div class="timeline-text">Your order is on the way with Michael Brown.</div>
                        </div>
                        <div class="timeline-item completed">
                            <div class="timeline-date"><i class="fas fa-clock"></i> May 15, 2023, 4:05 PM</div>
                            <div class="timeline-title"><i class="fas fa-home"></i> Delivered</div>
                            <div class="timeline-text">Your order has been delivered successfully.</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Actions Card -->
            <div class="card slide-in-right" style="animation-delay: 0.3s;">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-cogs me-2"></i>Tiện ích</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary">
                            <i class="fas fa-print me-2"></i>In hóa đơn
                        </button>
                        <button class="btn btn-outline-primary">
                            <i class="fas fa-envelope me-2"></i>Gửi qua email 
                        </button>
                        <button class="btn btn-outline-primary">
                            <i class="fas fa-download me-2"></i>Tải xuống 
                        </button>
                        <button class="btn btn-outline-warning">
                            <i class="fas fa-edit me-2"></i>Sửa đơn hàng
                        </button>
                        <button class="btn btn-outline-danger">
                            <i class="fas fa-times me-2"></i>Xóa đơn hàng
                        </button>
                    </div>
                </div>
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

    // Get order ID from URL
    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        const orderId = urlParams.get('id');

        if (orderId) {
            // In a real implementation, you would fetch order details from the server
            // For this static example, we'll just update the title
            const orderTitle = document.querySelector('h2 span.text-primary');
            if (orderTitle) {
                orderTitle.textContent = `#${orderId}`;
            }
        }

        // Animate timeline items
        const timelineItems = document.querySelectorAll('.timeline-item');
        let delay = 0;

        timelineItems.forEach(item => {
            setTimeout(() => {
                item.classList.add('show');
            }, delay);
            delay += 200;
        });

        // Add hover effect to buttons
        const buttons = document.querySelectorAll('.btn');
        buttons.forEach(button => {
            button.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-3px)';
            });

            button.addEventListener('mouseleave', function() {
                this.style.transform = '';
            });
        });

        // Add pulse animation to map
        const map = document.querySelector('.delivery-map');
        if (map) {
            map.addEventListener('mouseenter', function() {
                const pulse = this.querySelector('.pulse');
                if (pulse) {
                    pulse.style.animation = 'pulse 1s infinite';
                }
            });

            map.addEventListener('mouseleave', function() {
                const pulse = this.querySelector('.pulse');
                if (pulse) {
                    pulse.style.animation = 'pulse 2s infinite';
                }
            });
        }
    });
</script>
</body>

</html>