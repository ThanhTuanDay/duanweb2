<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Settings</h2>
        <button class="btn btn-primary" id="saveSettingsBtn">
            <i class="fas fa-save me-2"></i> Save Changes
        </button>
    </div>

    <ul class="nav nav-tabs mb-4" id="settingsTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="tax-tab" data-bs-toggle="tab" data-bs-target="#tax" type="button"
                role="tab" aria-controls="tax" aria-selected="true">
                <i class="fas fa-percentage me-2"></i> Tax Settings
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="coupons-tab" data-bs-toggle="tab" data-bs-target="#coupons" type="button"
                role="tab" aria-controls="coupons" aria-selected="false">
                <i class="fas fa-ticket-alt me-2"></i> Coupons
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="general-tab" data-bs-toggle="tab" data-bs-target="#general" type="button"
                role="tab" aria-controls="general" aria-selected="false">
                <i class="fas fa-sliders-h me-2"></i> General
            </button>
        </li>
    </ul>

    <div class="tab-content" id="settingsTabContent">
        <!-- Tax Settings Tab -->
        <div class="tab-pane fade show active" id="tax" role="tabpanel" aria-labelledby="tax-tab">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Tax Configuration</h5>
                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addTaxRuleModal">
                        <i class="fas fa-plus me-2"></i> Add Tax Rule
                    </button>
                </div>
                <div class="card-body">
                    <div class="settings-section">
                        <div class="settings-section-title">General Tax Settings</div>
                        <div class="row mb-3">

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="taxCalculationMethod" class="form-label">Tax Calculation Method</label>
                                    <select class="form-select" id="taxCalculationMethod">
                                        <option value="per_item">Per Item</option>
                                        <option value="per_order">Per Order</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="defaultTaxRate" class="form-label">Default Tax Rate (%)</label>
                                    <input type="number" class="form-control" id="defaultTaxRate" value="8.5"
                                        step="0.01" min="0">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="taxDisplayOption" class="form-label">Display Prices in Store</label>
                                    <select class="form-select" id="taxDisplayOption">
                                        <option value="including_tax">Including Tax</option>
                                        <option value="excluding_tax">Excluding Tax</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="taxRounding" class="form-label">Tax Rounding</label>
                                    <select class="form-select" id="taxRounding">
                                        <option value="round_up">Round Up</option>
                                        <option value="round_down">Round Down</option>
                                        <option value="round_nearest">Round to Nearest</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="enableTaxes" checked>
                            <label class="form-check-label" for="enableTaxes">Enable Taxes</label>
                        </div>
                    </div>

                    <div class="settings-section">
                        <div class="settings-section-title">Tax Rules</div>

                        <div class="tax-rule">
                            <div class="tax-rule-header">
                                <div class="tax-rule-title">Standard Rate</div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="taxRule1Status" checked>
                                    <label class="form-check-label" for="taxRule1Status">Active</label>
                                </div>
                            </div>
                            <div class="tax-rule-details">
                                <div class="tax-rule-detail">
                                    <div class="tax-rule-detail-label">Rate</div>
                                    <div class="tax-rule-detail-value">8.5%</div>
                                </div>
                                <div class="tax-rule-detail">
                                    <div class="tax-rule-detail-label">Country</div>
                                    <div class="tax-rule-detail-value">United States</div>
                                </div>
                                <div class="tax-rule-detail">
                                    <div class="tax-rule-detail-label">State</div>
                                    <div class="tax-rule-detail-value">All States</div>
                                </div>
                                <div class="tax-rule-detail">
                                    <div class="tax-rule-detail-label">Priority</div>
                                    <div class="tax-rule-detail-value">1</div>
                                </div>
                            </div>
                            <div class="tax-rule-actions">
                                <button class="btn btn-sm btn-info" data-bs-toggle="modal"
                                   >
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <button class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </div>
                        </div>

                        <div class="tax-rule">
                            <div class="tax-rule-header">
                                <div class="tax-rule-title">California Rate</div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="taxRule2Status" checked>
                                    <label class="form-check-label" for="taxRule2Status">Active</label>
                                </div>
                            </div>
                            <div class="tax-rule-details">
                                <div class="tax-rule-detail">
                                    <div class="tax-rule-detail-label">Rate</div>
                                    <div class="tax-rule-detail-value">9.5%</div>
                                </div>
                                <div class="tax-rule-detail">
                                    <div class="tax-rule-detail-label">Country</div>
                                    <div class="tax-rule-detail-value">United States</div>
                                </div>
                                <div class="tax-rule-detail">
                                    <div class="tax-rule-detail-label">State</div>
                                    <div class="tax-rule-detail-value">California</div>
                                </div>
                                <div class="tax-rule-detail">
                                    <div class="tax-rule-detail-label">Priority</div>
                                    <div class="tax-rule-detail-value">2</div>
                                </div>
                            </div>
                            <div class="tax-rule-actions">
                                <button class="btn btn-sm btn-info" data-bs-toggle="modal"
                                    data-bs-target="#editTaxRuleModal">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <button class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </div>
                        </div>

                        <div class="tax-rule">
                            <div class="tax-rule-header">
                                <div class="tax-rule-title">New York Rate</div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="taxRule3Status" checked>
                                    <label class="form-check-label" for="taxRule3Status">Active</label>
                                </div>
                            </div>
                            <div class="tax-rule-details">
                                <div class="tax-rule-detail">
                                    <div class="tax-rule-detail-label">Rate</div>
                                    <div class="tax-rule-detail-value">8.875%</div>
                                </div>
                                <div class="tax-rule-detail">
                                    <div class="tax-rule-detail-label">Country</div>
                                    <div class="tax-rule-detail-value">United States</div>
                                </div>
                                <div class="tax-rule-detail">
                                    <div class="tax-rule-detail-label">State</div>
                                    <div class="tax-rule-detail-value">New York</div>
                                </div>
                                <div class="tax-rule-detail">
                                    <div class="tax-rule-detail-label">Priority</div>
                                    <div class="tax-rule-detail-value">2</div>
                                </div>
                            </div>
                            <div class="tax-rule-actions">
                                <button class="btn btn-sm btn-info" data-bs-toggle="modal"
                                    data-bs-target="#editTaxRuleModal">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <button class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="settings-section">
                        <div class="settings-section-title">Tax Classes</div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Standard</td>
                                        <td>Standard tax class for most items</td>
                                        <td>
                                            <div class="action-btns">
                                                <button class="btn btn-sm btn-info"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-sm btn-danger"><i
                                                        class="fas fa-trash"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Reduced Rate</td>
                                        <td>Reduced tax rate for specific items</td>
                                        <td>
                                            <div class="action-btns">
                                                <button class="btn btn-sm btn-info"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-sm btn-danger"><i
                                                        class="fas fa-trash"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Zero Rate</td>
                                        <td>Zero tax rate for exempt items</td>
                                        <td>
                                            <div class="action-btns">
                                                <button class="btn btn-sm btn-info"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-sm btn-danger"><i
                                                        class="fas fa-trash"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <button class="btn btn-sm btn-primary mt-3" data-bs-toggle="modal"
                            data-bs-target="#addTaxClassModal">
                            <i class="fas fa-plus me-2"></i> Add Tax Class
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Coupons Tab -->
        <div class="tab-pane fade" id="coupons" role="tabpanel" aria-labelledby="coupons-tab">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Coupons Management</h5>
                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addCouponModal">
                        <i class="fas fa-plus me-2"></i> Add Coupon
                    </button>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <div class="row">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <div class="search-container">
                                    <input type="text" class="form-control" placeholder="Search coupons...">
                                    <i class="fas fa-search search-icon"></i>
                                </div>
                            </div>
                            <div class="col-md-6 d-flex justify-content-md-end align-items-center">
                                <div class="me-3">
                                    <select class="form-select form-select-sm">
                                        <option value="all">All Coupons</option>
                                        <option value="active">Active</option>
                                        <option value="expired">Expired</option>
                                        <option value="upcoming">Upcoming</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="coupon-card">
                        <span class="badge bg-success coupon-status">Active</span>
                        <div class="coupon-card-header">
                            <h5>Summer Special</h5>
                            <div class="coupon-code">SUMMER25</div>
                        </div>
                        <p>Get 25% off on all summer menu items</p>
                        <div class="coupon-details">
                            <div class="coupon-detail">
                                <div class="coupon-detail-label">Discount</div>
                                <div class="coupon-detail-value">25%</div>
                            </div>
                            <div class="coupon-detail">
                                <div class="coupon-detail-label">Valid From</div>
                                <div class="coupon-detail-value">Jun 1, 2023</div>
                            </div>
                            <div class="coupon-detail">
                                <div class="coupon-detail-label">Valid Until</div>
                                <div class="coupon-detail-value">Aug 31, 2023</div>
                            </div>
                            <div class="coupon-detail">
                                <div class="coupon-detail-label">Usage Limit</div>
                                <div class="coupon-detail-value">500 / 1000</div>
                            </div>
                        </div>
                        <div class="coupon-actions">
                            <button class="btn btn-sm btn-info" data-bs-toggle="modal"
                                data-bs-target="#editCouponModal">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                            <button class="btn btn-sm btn-secondary">
                                <i class="fas fa-chart-bar"></i> Usage Stats
                            </button>
                        </div>
                    </div>

                    <div class="coupon-card">
                        <span class="badge bg-warning coupon-status">Upcoming</span>
                        <div class="coupon-card-header">
                            <h5>New Customer</h5>
                            <div class="coupon-code">WELCOME15</div>
                        </div>
                        <p>15% off on first order for new customers</p>
                        <div class="coupon-details">
                            <div class="coupon-detail">
                                <div class="coupon-detail-label">Discount</div>
                                <div class="coupon-detail-value">15%</div>
                            </div>
                            <div class="coupon-detail">
                                <div class="coupon-detail-label">Valid From</div>
                                <div class="coupon-detail-value">Jul 15, 2023</div>
                            </div>
                            <div class="coupon-detail">
                                <div class="coupon-detail-label">Valid Until</div>
                                <div class="coupon-detail-value">Dec 31, 2023</div>
                            </div>
                            <div class="coupon-detail">
                                <div class="coupon-detail-label">Usage Limit</div>
                                <div class="coupon-detail-value">0 / 1000</div>
                            </div>
                        </div>
                        <div class="coupon-actions">
                            <button class="btn btn-sm btn-info" data-bs-toggle="modal"
                                data-bs-target="#editCouponModal">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                            <button class="btn btn-sm btn-secondary">
                                <i class="fas fa-chart-bar"></i> Usage Stats
                            </button>
                        </div>
                    </div>

                    <div class="coupon-card">
                        <span class="badge bg-danger coupon-status">Expired</span>
                        <div class="coupon-card-header">
                            <h5>Spring Sale</h5>
                            <div class="coupon-code">SPRING20</div>
                        </div>
                        <p>20% off on all menu items during spring</p>
                        <div class="coupon-details">
                            <div class="coupon-detail">
                                <div class="coupon-detail-label">Discount</div>
                                <div class="coupon-detail-value">20%</div>
                            </div>
                            <div class="coupon-detail">
                                <div class="coupon-detail-label">Valid From</div>
                                <div class="coupon-detail-value">Mar 1, 2023</div>
                            </div>
                            <div class="coupon-detail">
                                <div class="coupon-detail-label">Valid Until</div>
                                <div class="coupon-detail-value">May 31, 2023</div>
                            </div>
                            <div class="coupon-detail">
                                <div class="coupon-detail-label">Usage Limit</div>
                                <div class="coupon-detail-value">750 / 1000</div>
                            </div>
                        </div>
                        <div class="coupon-actions">
                            <button class="btn btn-sm btn-info" data-bs-toggle="modal"
                                data-bs-target="#editCouponModal">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                            <button class="btn btn-sm btn-secondary">
                                <i class="fas fa-chart-bar"></i> Usage Stats
                            </button>
                        </div>
                    </div>

                    <div class="coupon-card">
                        <span class="badge bg-success coupon-status">Active</span>
                        <div class="coupon-card-header">
                            <h5>Weekend Special</h5>
                            <div class="coupon-code">WEEKEND10</div>
                        </div>
                        <p>10% off on all orders during weekends</p>
                        <div class="coupon-details">
                            <div class="coupon-detail">
                                <div class="coupon-detail-label">Discount</div>
                                <div class="coupon-detail-value">10%</div>
                            </div>
                            <div class="coupon-detail">
                                <div class="coupon-detail-label">Valid From</div>
                                <div class="coupon-detail-value">Jan 1, 2023</div>
                            </div>
                            <div class="coupon-detail">
                                <div class="coupon-detail-label">Valid Until</div>
                                <div class="coupon-detail-value">Dec 31, 2023</div>
                            </div>
                            <div class="coupon-detail">
                                <div class="coupon-detail-label">Usage Limit</div>
                                <div class="coupon-detail-value">320 / 5000</div>
                            </div>
                        </div>
                        <div class="coupon-actions">
                            <button class="btn btn-sm btn-info" data-bs-toggle="modal"
                                data-bs-target="#editCouponModal">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                            <button class="btn btn-sm btn-secondary">
                                <i class="fas fa-chart-bar"></i> Usage Stats
                            </button>
                        </div>
                    </div>

                    
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

        <!-- General Settings Tab -->
        <div class="tab-pane fade" id="general" role="tabpanel" aria-labelledby="general-tab">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">General Settings</h5>
                </div>
                <div class="card-body">
                    <div class="settings-section">
                        <div class="settings-section-title">Store Information</div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="storeName" class="form-label">Store Name</label>
                                    <input type="text" class="form-control" id="storeName" value="Feane Restaurant">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="storeEmail" class="form-label">Store Email</label>
                                    <input type="email" class="form-control" id="storeEmail"
                                        value="info@feanerestaurant.com">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="storePhone" class="form-label">Store Phone</label>
                                    <input type="text" class="form-control" id="storePhone" value="+1 (555) 123-4567">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="storeCurrency" class="form-label">Currency</label>
                                    <select class="form-select" id="storeCurrency">
                                        <option value="USD" selected>USD ($)</option>
                                        <option value="EUR">EUR (€)</option>
                                        <option value="GBP">GBP (£)</option>
                                        <option value="CAD">CAD (C$)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="settings-section">
                        <div class="settings-section-title">Order Settings</div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="minimumOrderAmount" class="form-label">Minimum Order Amount</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-dark text-light border-secondary">VNĐ</span>
                                        <input type="number" class="form-control" id="minimumOrderAmount" value="10"
                                            step="0.01" min="0">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="deliveryFee" class="form-label">Delivery Fee</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-dark text-light border-secondary">VNĐ</span>
                                        <input type="number" class="form-control" id="deliveryFee" value="5" step="0.01"
                                            min="0">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="freeDeliveryEnabled" checked>
                            <label class="form-check-label" for="freeDeliveryEnabled">Enable Free Delivery for Orders
                                Above</label>
                        </div>
                        <div class="mb-3">
                            <div class="input-group" style="max-width: 200px;">
                                <span class="input-group-text bg-dark text-light border-secondary">VNĐ</span>
                                <input type="number" class="form-control" id="freeDeliveryThreshold" value="50"
                                    step="0.01" min="0">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Add Tax Rule Modal -->
<div class="modal fade" id="addTaxRuleModal" tabindex="-1" aria-labelledby="addTaxRuleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTaxRuleModalLabel">Add Tax Rule</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>

                    <div class="mb-3">
                        <label for="taxClassSelect" class="form-label">Tax Class</label>
                        <select class="form-select" id="taxClassSelect">
                            <option value="">Select Tax Class</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="taxRuleName" class="form-label">Rule Name</label>
                        <input type="text" class="form-control" id="taxRuleName" placeholder="Enter rule name">
                    </div>
                    <div class="mb-3">
                        <label for="taxRate" class="form-label">Tax Rate (%)</label>
                        <input type="number" class="form-control" id="taxRate" placeholder="Enter tax rate" step="0.01"
                            min="0">
                    </div>
                    <div class="mb-3">
                        <label for="taxCountry" class="form-label">Country</label>
                        <select class="form-select" id="taxCountry">
                            <option value="">Chọn đất nước</option>
                            <option value="VN">Việt Nam</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="taxState" class="form-label">State/Province</label>
                        <select class="form-select" id="taxState">
                            <option value="all">Tất cả các quận</option>
                            <option value="quận 8">Quận 8</option>
                            <option value="quận 7">Quận 7</option>
                            <option value="quận 6">Quận 6</option>
                            <option value="quận 5">Quận 5</option>
                            <option value="quận 4">Quận 4</option>
                            <option value="quận 3">Quận 3</option>
                            <option value="quận 2">Quận 2</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="taxPriority" class="form-label">Priority</label>
                        <input type="number" class="form-control" id="taxPriority" value="1" min="1">
                        <small class="text-muted">Higher priority rules are applied first</small>
                    </div>
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" id="taxRuleActive" checked>
                        <label class="form-check-label" for="taxRuleActive">Active</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Add Tax Rule</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Tax Rule Modal -->
<div class="modal fade" id="editTaxRuleModal" tabindex="-1" aria-labelledby="editTaxRuleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTaxRuleModalLabel">Edit Tax Rule</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="taxClassSelect" class="form-label">Tax Class</label>
                        <select class="form-select" id="editTaxClassSelect">
                            <option value="">Select Tax Class</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editTaxRuleName" class="form-label">Rule Name</label>
                        <input type="text" class="form-control" id="editTaxRuleName" value="Standard Rate">
                    </div>
                    <div class="mb-3">
                        <label for="editTaxRate" class="form-label">Tax Rate (%)</label>
                        <input type="number" class="form-control" id="editTaxRate" value="8.5" step="0.01" min="0">
                    </div>
                    <div class="mb-3">
                        <label for="editTaxCountry" class="form-label">Country</label>
                        <select class="form-select" id="editTaxCountry">
                            <option value="">Chọn đất nước</option>
                            <option value="VN" selected>Việt Nam</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editTaxState" class="form-label">State/Province</label>
                        <select class="form-select" id="editTaxState">
                            <option value="all">Tất cả các quận</option>
                            <option value="quận 8">Quận 8</option>
                            <option value="quận 7">Quận 7</option>
                            <option value="quận 6">Quận 6</option>
                            <option value="quận 5">Quận 5</option>
                            <option value="quận 4">Quận 4</option>
                            <option value="quận 3">Quận 3</option>
                            <option value="quận 2">Quận 2</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editTaxPriority" class="form-label">Priority</label>
                        <input type="number" class="form-control" id="editTaxPriority" value="1" min="1">
                        <small class="text-muted">Higher priority rules are applied first</small>
                    </div>
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" id="editTaxRuleActive" checked>
                        <label class="form-check-label" for="editTaxRuleActive">Active</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button onClick="saveEditTaxRule()" type="button" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Add Tax Class Modal -->
<div class="modal fade" id="addTaxClassModal" tabindex="-1" aria-labelledby="addTaxClassModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTaxClassModalLabel">Add Tax Class</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="taxClassName" class="form-label">Class Name</label>
                        <input type="text" class="form-control" id="taxClassName" placeholder="Enter class name">
                    </div>
                    <div class="mb-3">
                        <label for="taxClassDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="taxClassDescription" rows="3"
                            placeholder="Enter description"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Add Tax Class</button>
            </div>
        </div>
    </div>
</div>

<!-- Add Coupon Modal -->
<div class="modal fade" id="addCouponModal" tabindex="-1" aria-labelledby="addCouponModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCouponModalLabel">Add Coupon</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="couponName" class="form-label">Coupon Name</label>
                                <input type="text" class="form-control" id="couponName" placeholder="Enter coupon name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="couponCode" class="form-label">Coupon Code</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="couponCode"
                                        placeholder="Enter coupon code">
                                    <button class="btn btn-outline-secondary" type="button">Generate</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="couponDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="couponDescription" rows="2"
                            placeholder="Enter description"></textarea>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="discountType" class="form-label">Discount Type</label>
                                <select class="form-select" id="discountType">
                                    <option value="percentage">Percentage Discount</option>
                                    <option value="fixed">Fixed Amount Discount</option>
                                    <option value="free_shipping">Free Shipping</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="discountAmount" class="form-label">Discount Amount</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="discountAmount"
                                        placeholder="Enter amount" step="0.01" min="0">
                                    <span class="input-group-text bg-dark text-light border-secondary">%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validFrom" class="form-label">Valid From</label>
                                <input type="date" class="form-control" id="validFrom">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validUntil" class="form-label">Valid Until</label>
                                <input type="date" class="form-control" id="validUntil">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="minimumSpend" class="form-label">Minimum Spend</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-dark text-light border-secondary">VNĐ</span>
                                    <input type="number" class="form-control" id="minimumSpend"
                                        placeholder="Enter amount" step="0.01" min="0">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="maximumSpend" class="form-label">Maximum Spend</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-dark text-light border-secondary">VNĐ</span>
                                    <input type="number" class="form-control" id="maximumSpend"
                                        placeholder="Enter amount" step="0.01" min="0">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="usageLimit" class="form-label">Usage Limit</label>
                                <input type="number" class="form-control" id="usageLimit" placeholder="Enter limit"
                                    min="0">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="usageLimitPerUser" class="form-label">Usage Limit Per User</label>
                                <input type="number" class="form-control" id="usageLimitPerUser"
                                    placeholder="Enter limit" min="0">
                            </div>
                        </div>
                    </div>
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" id="couponActive" checked>
                        <label class="form-check-label" for="couponActive">Active</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="submitAddCouponBtn">Add Coupon</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Coupon Modal -->
<div class="modal fade" id="editCouponModal" tabindex="-1" aria-labelledby="editCouponModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCouponModalLabel">Edit Coupon</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="editCouponName" class="form-label">Coupon Name</label>
                                <input type="text" class="form-control" id="editCouponName" value="Summer Special">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="editCouponCode" class="form-label">Coupon Code</label>
                                <input type="text" class="form-control" id="editCouponCode" value="SUMMER25">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="editCouponDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="editCouponDescription"
                            rows="2">Get 25% off on all summer menu items</textarea>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="editDiscountType" class="form-label">Discount Type</label>
                                <select class="form-select" id="editDiscountType">
                                    <option value="percentage" selected>Percentage Discount</option>
                                    <option value="fixed">Fixed Amount Discount</option>
                                    <option value="free_shipping">Free Shipping</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="editDiscountAmount" class="form-label">Discount Amount</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="editDiscountAmount" value="25"
                                        step="0.01" min="0">
                                    <span class="input-group-text bg-dark text-light border-secondary">%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="editValidFrom" class="form-label">Valid From</label>
                                <input type="date" class="form-control" id="editValidFrom" value="2023-06-01">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="editValidUntil" class="form-label">Valid Until</label>
                                <input type="date" class="form-control" id="editValidUntil" value="2023-08-31">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="editMinimumSpend" class="form-label">Minimum Spend</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-dark text-light border-secondary">VNĐ</span>
                                    <input type="number" class="form-control" id="editMinimumSpend" value="20"
                                        step="0.01" min="0">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="editMaximumSpend" class="form-label">Maximum Spend</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-dark text-light border-secondary">VNĐ</span>
                                    <input type="number" class="form-control" id="editMaximumSpend" value="200"
                                        step="0.01" min="0">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="editUsageLimit" class="form-label">Usage Limit</label>
                                <input type="number" class="form-control" id="editUsageLimit" value="1000" min="0">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="editUsageLimitPerUser" class="form-label">Usage Limit Per User</label>
                                <input type="number" class="form-control" id="editUsageLimitPerUser" value="1" min="0">
                            </div>
                        </div>
                    </div>
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" id="editCouponActive" checked>
                        <label class="form-check-label" for="editCouponActive">Active</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Toggle Sidebar
    document.getElementById('toggle-sidebar').addEventListener('click', function () {
        document.getElementById('sidebar').classList.toggle('active');
        document.getElementById('main-content').classList.toggle('active');
    });

    // Initialize date inputs with current date
    document.addEventListener('DOMContentLoaded', function () {
        const today = new Date();
        const formatDate = (date) => {
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const day = String(date.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        };

        // Set date values for coupon modals
        document.getElementById('validFrom').value = formatDate(today);

        const futureDate = new Date(today);
        futureDate.setMonth(futureDate.getMonth() + 3);
        document.getElementById('validUntil').value = formatDate(futureDate);

        // Save settings button alert
        document.getElementById('saveSettingsBtn').addEventListener('click', function () {
            alert('Settings saved successfully!');
        });

        // Generate random coupon code
        const generateBtn = document.querySelector('.input-group button');
        if (generateBtn) {
            generateBtn.addEventListener('click', function () {
                const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                let code = '';
                for (let i = 0; i < 8; i++) {
                    code += chars.charAt(Math.floor(Math.random() * chars.length));
                }
                document.getElementById('couponCode').value = code;
            });
        }
    });
</script>
</body>

</html>