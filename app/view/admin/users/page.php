

    <!-- Sidebar -->


    <!-- Main Content -->
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Users Management</h2>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                    <i class="fas fa-plus me-2"></i> Add New User
                </button>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h5 class="mb-0">All Users</h5>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex justify-content-md-end">
                                <div class="search-container me-3">
                                    <input type="text" class="form-control" placeholder="Search users...">
                                    <i class="fas fa-search search-icon"></i>
                                </div>
                                <div class="dropdown">
                                    <button class="btn btn-outline-primary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        Filter
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark" aria-labelledby="filterDropdown">
                                        <li><a class="dropdown-item" href="#">All Users</a></li>
                                        <li><a class="dropdown-item" href="#">Admins</a></li>
                                        <li><a class="dropdown-item" href="#">Customers</a></li>
                                        <li><a class="dropdown-item" href="#">Active</a></li>
                                        <li><a class="dropdown-item" href="#">Inactive</a></li>
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
                                    <th>ID</th>
                                    <th>User</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Role</th>
                                    <th>Joined Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#U001</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="user-avatar me-2">
                                                <img src="/placeholder.svg?height=40&width=40" alt="John Doe">
                                            </div>
                                            <div>John Doe</div>
                                        </div>
                                    </td>
                                    <td>john.doe@example.com</td>
                                    <td>+1 (555) 123-4567</td>
                                    <td>Customer</td>
                                    <td>May 10, 2023</td>
                                    <td><span class="badge bg-success">Active</span></td>
                                    <td>
                                        <div class="action-btns">
                                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#viewUserModal"><i class="fas fa-eye"></i></button>
                                            <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#editUserModal"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#U002</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="user-avatar me-2">
                                                <img src="/placeholder.svg?height=40&width=40" alt="Jane Smith">
                                            </div>
                                            <div>Jane Smith</div>
                                        </div>
                                    </td>
                                    <td>jane.smith@example.com</td>
                                    <td>+1 (555) 987-6543</td>
                                    <td>Admin</td>
                                    <td>Apr 15, 2023</td>
                                    <td><span class="badge bg-success">Active</span></td>
                                    <td>
                                        <div class="action-btns">
                                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#viewUserModal"><i class="fas fa-eye"></i></button>
                                            <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#editUserModal"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#U003</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="user-avatar me-2">
                                                <img src="/placeholder.svg?height=40&width=40" alt="Robert Johnson">
                                            </div>
                                            <div>Robert Johnson</div>
                                        </div>
                                    </td>
                                    <td>robert.johnson@example.com</td>
                                    <td>+1 (555) 456-7890</td>
                                    <td>Customer</td>
                                    <td>May 5, 2023</td>
                                    <td><span class="badge bg-success">Active</span></td>
                                    <td>
                                        <div class="action-btns">
                                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#viewUserModal"><i class="fas fa-eye"></i></button>
                                            <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#editUserModal"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#U004</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="user-avatar me-2">
                                                <img src="/placeholder.svg?height=40&width=40" alt="Emily Davis">
                                            </div>
                                            <div>Emily Davis</div>
                                        </div>
                                    </td>
                                    <td>emily.davis@example.com</td>
                                    <td>+1 (555) 789-0123</td>
                                    <td>Customer</td>
                                    <td>Apr 28, 2023</td>
                                    <td><span class="badge bg-danger">Inactive</span></td>
                                    <td>
                                        <div class="action-btns">
                                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#viewUserModal"><i class="fas fa-eye"></i></button>
                                            <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#editUserModal"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#U005</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="user-avatar me-2">
                                                <img src="/placeholder.svg?height=40&width=40" alt="Michael Wilson">
                                            </div>
                                            <div>Michael Wilson</div>
                                        </div>
                                    </td>
                                    <td>michael.wilson@example.com</td>
                                    <td>+1 (555) 234-5678</td>
                                    <td>Customer</td>
                                    <td>Apr 20, 2023</td>
                                    <td><span class="badge bg-success">Active</span></td>
                                    <td>
                                        <div class="action-btns">
                                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#viewUserModal"><i class="fas fa-eye"></i></button>
                                            <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#editUserModal"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
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
    

    <!-- Add User Modal -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="firstName" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="firstName" placeholder="Enter first name">
                            </div>
                            <div class="col-md-6">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lastName" placeholder="Enter last name">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter email">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="tel" class="form-control" id="phone" placeholder="Enter phone number">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Enter password">
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm password">
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-select" id="role">
                                <option value="customer" selected>Customer</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status">
                                <option value="active" selected>Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Add User</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="editFirstName" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="editFirstName" value="John">
                            </div>
                            <div class="col-md-6">
                                <label for="editLastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="editLastName" value="Doe">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="editEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="editEmail" value="john.doe@example.com">
                        </div>
                        <div class="mb-3">
                            <label for="editPhone" class="form-label">Phone</label>
                            <input type="tel" class="form-control" id="editPhone" value="+1 (555) 123-4567">
                        </div>
                        <div class="mb-3">
                            <label for="editRole" class="form-label">Role</label>
                            <select class="form-select" id="editRole">
                                <option value="customer" selected>Customer</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editStatus" class="form-label">Status</label>
                            <select class="form-select" id="editStatus">
                                <option value="active" selected>Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
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

    <!-- View User Modal -->
    <div class="modal fade" id="viewUserModal" tabindex="-1" aria-labelledby="viewUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewUserModalLabel">User Details</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="user-details-header">
                        <div class="user-details-avatar">
                            <img src="/placeholder.svg?height=80&width=80" alt="John Doe">
                        </div>
                        <div class="user-details-info">
                            <h4>John Doe</h4>
                            <p>Customer</p>
                            <span class="badge bg-success">Active</span>
                        </div>
                    </div>
                    
                    <div class="user-stats">
                        <div class="user-stat-item">
                            <div class="user-stat-value">12</div>
                            <div class="user-stat-label">Orders</div>
                        </div>
                        <div class="user-stat-item">
                            <div class="user-stat-value">$458.75</div>
                            <div class="user-stat-label">Total Spent</div>
                        </div>
                        <div class="user-stat-item">
                            <div class="user-stat-value">May 10, 2023</div>
                            <div class="user-stat-label">Joined Date</div>
                        </div>
                    </div>
                    
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <h6 class="mb-3">Contact Information</h6>
                            <p><strong>Email:</strong> john.doe@example.com</p>
                            <p><strong>Phone:</strong> +1 (555) 123-4567</p>
                            <p><strong>Address:</strong> 123 Main Street, Apt 4B, New York, NY 10001, United States</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="mb-3">Recent Orders</h6>
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>#ORD-0025</td>
                                            <td>May 15, 2023</td>
                                            <td>$125.99</td>
                                            <td><span class="badge bg-success">Delivered</span></td>
                                        </tr>
                                        <tr>
                                            <td>#ORD-0018</td>
                                            <td>May 2, 2023</td>
                                            <td>$78.50</td>
                                            <td><span class="badge bg-success">Delivered</span></td>
                                        </tr>
                                        <tr>
                                            <td>#ORD-0012</td>
                                            <td>Apr 20, 2023</td>
                                            <td>$42.75</td>
                                            <td><span class="badge bg-success">Delivered</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info me-2" data-bs-toggle="modal" data-bs-target="#editUserModal">
                        <i class="fas fa-edit me-2"></i> Edit User
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>