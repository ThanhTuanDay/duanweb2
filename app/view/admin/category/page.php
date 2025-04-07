<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feane Admin - Categories</title>
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
        
        .category-img {
            width: 60px;
            height: 60px;
            border-radius: 5px;
            overflow: hidden;
        }
        
        .category-img img {
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
        
        .category-card {
            background-color: var(--dark-light);
            border-radius: 5px;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        
        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        
        .category-card-img {
            height: 150px;
            overflow: hidden;
        }
        
        .category-card-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .category-card-body {
            padding: 15px;
        }
        
        .category-card-title {
            font-size: 18px;
            font-weight: 500;
            margin-bottom: 5px;
        }
        
        .category-card-text {
            color: var(--gray);
            font-size: 14px;
            margin-bottom: 15px;
        }
        
        .category-card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
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
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
            <a href="admin-products.html" class="menu-item">
                <i class="fas fa-hamburger"></i> Products
            </a>
            <a href="admin-categories.html" class="menu-item active">
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


<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Categories Management</h2>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
            <i class="fas fa-plus me-2"></i> Add New Category
        </button>
    </div>

    <div class="row container-category">
        <!-- <div class="col-lg-4 col-md-6 mb-4">
                    <div class="category-card">
                        <div class="category-card-img">
                            <img src="/placeholder.svg?height=150&width=300" alt="Burger">
                        </div>
                        <div class="category-card-body">
                            <h5 class="category-card-title">Burger</h5>
                            <p class="category-card-text">12 products</p>
                            <div class="category-card-footer">
                                <span class="badge bg-success">Active</span>
                                <div class="action-btns">
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editCategoryModal"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="category-card">
                        <div class="category-card-img">
                            <img src="/placeholder.svg?height=150&width=300" alt="Pizza">
                        </div>
                        <div class="category-card-body">
                            <h5 class="category-card-title">Pizza</h5>
                            <p class="category-card-text">8 products</p>
                            <div class="category-card-footer">
                                <span class="badge bg-success">Active</span>
                                <div class="action-btns">
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editCategoryModal"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="category-card">
                        <div class="category-card-img">
                            <img src="/placeholder.svg?height=150&width=300" alt="Pasta">
                        </div>
                        <div class="category-card-body">
                            <h5 class="category-card-title">Pasta</h5>
                            <p class="category-card-text">6 products</p>
                            <div class="category-card-footer">
                                <span class="badge bg-success">Active</span>
                                <div class="action-btns">
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editCategoryModal"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="category-card">
                        <div class="category-card-img">
                            <img src="/placeholder.svg?height=150&width=300" alt="Fries">
                        </div>
                        <div class="category-card-body">
                            <h5 class="category-card-title">Fries</h5>
                            <p class="category-card-text">4 products</p>
                            <div class="category-card-footer">
                                <span class="badge bg-success">Active</span>
                                <div class="action-btns">
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editCategoryModal"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="category-card">
                        <div class="category-card-img">
                            <img src="/placeholder.svg?height=150&width=300" alt="Drinks">
                        </div>
                        <div class="category-card-body">
                            <h5 class="category-card-title">Drinks</h5>
                            <p class="category-card-text">10 products</p>
                            <div class="category-card-footer">
                                <span class="badge bg-success">Active</span>
                                <div class="action-btns">
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editCategoryModal"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="category-card">
                        <div class="category-card-img">
                            <img src="/placeholder.svg?height=150&width=300" alt="Desserts">
                        </div>
                        <div class="category-card-body">
                            <h5 class="category-card-title">Desserts</h5>
                            <p class="category-card-text">5 products</p>
                            <div class="category-card-footer">
                                <span class="badge bg-danger">Inactive</span>
                                <div class="action-btns">
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editCategoryModal"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
    </div>
    <div class="pagination-container">
        <ul id="pagination-links" class="pagination">
        </ul>
        <div class="pagination-info">
            <span>Showing <span id="pagination-start">1</span> to <span id="pagination-end">10</span> of <span id="pagination-total">100</span> items</span>
        </div>
    </div>
</div>


<!-- Add Category Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-dark">
            <div class="modal-header">
                <h5 class="modal-title" id="addCategoryModalLabel">Add New Category</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="categoryName" class="form-label">Category Name</label>
                        <input type="text" class="form-control" id="categoryName" placeholder="Enter category name">
                    </div>
                    <div class="mb-3">
                        <label for="categoryDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="categoryDescription" rows="3" placeholder="Enter category description"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="categoryImage" class="form-label">Category Image</label>
                        <input type="file" class="form-control" id="categoryImage">
                    </div>
                    <div class="mb-3">
                        <label for="categoryStatus" class="form-label">Status</label>
                        <select class="form-select" id="categoryStatus">
                            <option value="active" selected>Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Add Category</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Category Modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-dark">
            <div class="modal-header">
                <h5 class="modal-title" id="editCategoryModalLabel">Edit Category</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" id="saveBtnEditCategory" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </div>
</div>