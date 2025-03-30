<!-- <!DOCTYPE html> -->
<!-- <html lang="en"> -->
<!-- <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feane Admin - Products</title>
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
        
        .product-img {
            width: 60px;
            height: 60px;
            border-radius: 5px;
            overflow: hidden;
        }
        
        .product-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .action-btns {
            display: flex;
            gap: 5px;
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
        
        .form-label {
            margin-bottom: 0.5rem;
        }
        
        .modal-content {
            background-color: var(--dark-light);
            color: var(--light);
        }
        
        .modal-header {
            border-bottom-color: rgba(255, 255, 255, 0.1);
        }
        
        .modal-footer {
            border-top-color: rgba(255, 255, 255, 0.1);
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
</head> -->
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
            <a href="admin-products.html" class="menu-item active">
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
    </div> -->

    <!-- Main Content -->
    <!-- <div class="main-content" id="main-content"> -->
        <!-- <div class="topbar">
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
        </div> -->

        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Products Management</h2>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
                    <i class="fas fa-plus me-2"></i> Add New Product
                </button>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h5 class="mb-0">All Products</h5>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex justify-content-md-end">
                                <div class="search-container me-3">
                                    <input type="text" class="form-control" placeholder="Search products...">
                                    <i class="fas fa-search search-icon"></i>
                                </div>
                                <div class="dropdown">
                                    <button class="btn btn-outline-primary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        Filter
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark" aria-labelledby="filterDropdown">
                                        <li><a class="dropdown-item" href="#">All Categories</a></li>
                                        <li><a class="dropdown-item" href="#">Burger</a></li>
                                        <li><a class="dropdown-item" href="#">Pizza</a></li>
                                        <li><a class="dropdown-item" href="#">Pasta</a></li>
                                        <li><a class="dropdown-item" href="#">Fries</a></li>
                                        <li><a class="dropdown-item" href="#">Drinks</a></li>
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
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#P001</td>
                                    <td>
                                        <div class="product-img">
                                            <img src="/placeholder.svg?height=60&width=60" alt="Delicious Burger">
                                        </div>
                                    </td>
                                    <td>Delicious Burger</td>
                                    <td>Burger</td>
                                    <td>$15.99</td>
                                    <td>45</td>
                                    <td><span class="badge bg-success">Active</span></td>
                                    <td>
                                        <div class="action-btns">
                                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editProductModal"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                            <button class="btn btn-sm btn-info"><i class="fas fa-eye"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#P002</td>
                                    <td>
                                        <div class="product-img">
                                            <img src="/placeholder.svg?height=60&width=60" alt="Cheese Pizza">
                                        </div>
                                    </td>
                                    <td>Cheese Pizza</td>
                                    <td>Pizza</td>
                                    <td>$18.99</td>
                                    <td>32</td>
                                    <td><span class="badge bg-success">Active</span></td>
                                    <td>
                                        <div class="action-btns">
                                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editProductModal"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                            <button class="btn btn-sm btn-info"><i class="fas fa-eye"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#P003</td>
                                    <td>
                                        <div class="product-img">
                                            <img src="/placeholder.svg?height=60&width=60" alt="French Fries">
                                        </div>
                                    </td>
                                    <td>French Fries</td>
                                    <td>Fries</td>
                                    <td>$8.50</td>
                                    <td>60</td>
                                    <td><span class="badge bg-success">Active</span></td>
                                    <td>
                                        <div class="action-btns">
                                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editProductModal"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                            <button class="btn btn-sm btn-info"><i class="fas fa-eye"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#P004</td>
                                    <td>
                                        <div class="product-img">
                                            <img src="/placeholder.svg?height=60&width=60" alt="Pasta Carbonara">
                                        </div>
                                    </td>
                                    <td>Pasta Carbonara</td>
                                    <td>Pasta</td>
                                    <td>$14.75</td>
                                    <td>28</td>
                                    <td><span class="badge bg-success">Active</span></td>
                                    <td>
                                        <div class="action-btns">
                                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editProductModal"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                            <button class="btn btn-sm btn-info"><i class="fas fa-eye"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#P005</td>
                                    <td>
                                        <div class="product-img">
                                            <img src="/placeholder.svg?height=60&width=60" alt="Chocolate Shake">
                                        </div>
                                    </td>
                                    <td>Chocolate Shake</td>
                                    <td>Drinks</td>
                                    <td>$6.25</td>
                                    <td>0</td>
                                    <td><span class="badge bg-danger">Out of Stock</span></td>
                                    <td>
                                        <div class="action-btns">
                                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editProductModal"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                            <button class="btn btn-sm btn-info"><i class="fas fa-eye"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#P006</td>
                                    <td>
                                        <div class="product-img">
                                            <img src="/placeholder.svg?height=60&width=60" alt="Veggie Pizza">
                                        </div>
                                    </td>
                                    <td>Veggie Pizza</td>
                                    <td>Pizza</td>
                                    <td>$16.50</td>
                                    <td>15</td>
                                    <td><span class="badge bg-warning">Low Stock</span></td>
                                    <td>
                                        <div class="action-btns">
                                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editProductModal"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                            <button class="btn btn-sm btn-info"><i class="fas fa-eye"></i></button>
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
    <!-- </div> -->

    <!-- Add Product Modal -->
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Add New Product</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="productName" class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="productName" placeholder="Enter product name">
                            </div>
                            <div class="col-md-6">
                                <label for="productCategory" class="form-label">Category</label>
                                <select class="form-select" id="productCategory">
                                    <option selected>Select category</option>
                                    <option value="burger">Burger</option>
                                    <option value="pizza">Pizza</option>
                                    <option value="pasta">Pasta</option>
                                    <option value="fries">Fries</option>
                                    <option value="drinks">Drinks</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="productPrice" class="form-label">Price</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control" id="productPrice" placeholder="0.00" step="0.01">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="productStock" class="form-label">Stock Quantity</label>
                                <input type="number" class="form-control" id="productStock" placeholder="Enter quantity">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="productDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="productDescription" rows="3" placeholder="Enter product description"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="productImage" class="form-label">Product Image</label>
                            <input type="file" class="form-control" id="productImage">
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="productStatus" class="form-label">Status</label>
                                <select class="form-select" id="productStatus">
                                    <option value="active" selected>Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="productFeatured" class="form-label">Featured</label>
                                <select class="form-select" id="productFeatured">
                                    <option value="no" selected>No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Add Product</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Product Modal -->
    <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="editProductName" class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="editProductName" value="Delicious Burger">
                            </div>
                            <div class="col-md-6">
                                <label for="editProductCategory" class="form-label">Category</label>
                                <select class="form-select" id="editProductCategory">
                                    <option>Select category</option>
                                    <option value="burger" selected>Burger</option>
                                    <option value="pizza">Pizza</option>
                                    <option value="pasta">Pasta</option>
                                    <option value="fries">Fries</option>
                                    <option value="drinks">Drinks</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="editProductPrice" class="form-label">Price</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control" id="editProductPrice" value="15.99" step="0.01">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="editProductStock" class="form-label">Stock Quantity</label>
                                <input type="number" class="form-control" id="editProductStock" value="45">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="editProductDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="editProductDescription" rows="3">Veniam debitis quaerat officiis quasi cupiditate quo, quisquam velit, magnam voluptatem repellendus sed eaque</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="editProductImage" class="form-label">Product Image</label>
                            <div class="d-flex align-items-center mb-2">
                                <div class="product-img me-3">
                                    <img src="/placeholder.svg?height=60&width=60" alt="Current Image">
                                </div>
                                <span>Current Image</span>
                            </div>
                            <input type="file" class="form-control" id="editProductImage">
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="editProductStatus" class="form-label">Status</label>
                                <select class="form-select" id="editProductStatus">
                                    <option value="active" selected>Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="editProductFeatured" class="form-label">Featured</label>
                                <select class="form-select" id="editProductFeatured">
                                    <option value="no">No</option>
                                    <option value="yes" selected>Yes</option>
                                </select>
                            </div>
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

  