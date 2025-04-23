<?php
require(dirname(__DIR__) . "/../../controller/product.controller.php");
require(dirname(__DIR__) . "/../../controller/category.controller.php");

$productController = new ProductController();
$categoryController = new CategoryController();
$page = isset($_GET['pagination']) ? (int) $_GET['pagination'] : 1;
$perPage = isset($_GET['per_page']) ? (int) $_GET['per_page'] : 10;

$total = $productController->countTotalProducts();
$products = $productController->getPaginatedProducts($page, $perPage);
$totalPages = ceil($total / $perPage);

$categories = $categoryController->getAllCategory();



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['productName'] ?? '';
    $categoryId = $_POST['productCategory'] ?? '';
    $price = (float) $_POST['productPrice'] ?? 0;
    $stock = $_POST['productStock'] ?? 0;
    $description = $_POST['productDescription'] ?? '';
    $status = $_POST['productStatus'] ?? 'inactive';
    $featured = $_POST['productFeatured'] ?? 'no';


    if (isset($_FILES['productImage']) && $_FILES['productImage']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = realpath(__DIR__ . '/../../../../public/images') . '/';
        $filename = basename($_FILES['productImage']['name']);
        $targetPath = $uploadDir . $filename;

        if (move_uploaded_file($_FILES['productImage']['tmp_name'], $targetPath)) {
            echo "Upload thành công!";
        } else {
            echo "Upload thất bại!";
        }

        $targetPath = '/duanweb2/public/images/' . $filename;
    }

    $id = $_POST['productId'] ?? '';
    if ($id == '') {
        $productController->createProduct(
            new ProductDto(
                null,
                $name,
                $description,
                $price,
                $categoryId,
                $targetPath ?? '',
                $stock,
                'ee70a51b-0c45-11f0-ab99-6ef87da1f643',
                $status,
            )
        );
        header("Location: " . $_SERVER['REQUEST_URI']);
    } else {

        $oldImage = $_POST['oldProductImage'] ?? '';
        $result = $productController->updateProduct(
            new ProductDto(
                $id,
                $name,
                $description,
                $price,
                $categoryId,
                $targetPath ?? $oldImage,
                $stock,
                'ee70a51b-0c45-11f0-ab99-6ef87da1f643',
                $status,
            )
        );
        if ($result) {
            echo "Cập nhật sản phẩm thành công!";
            header("Location: " . $_SERVER['REQUEST_URI']);
        } else {
            echo "Sản phẩm đã từng bán, không thể cập nhật !";
        }
    }

    $products = $productController->getPaginatedProducts($page, $perPage);
}
?>




<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feane Admin - Products</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
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

        .table td,
        .table th {
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

        .form-control,
        .form-select {
            background-color: var(--dark);
            border-color: rgba(255, 255, 255, 0.1);
            color: var(--light);
        }

        .form-control:focus,
        .form-select:focus {
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

        /* Product Detail Modal Styles */
        .modal-content {
            border: none;
            border-radius: 8px;
        }

        .product-image {
            text-align: center;
        }

        .product-image img {
            max-width: 100%;
            border-radius: 5px;
        }

        .detail-label {
            display: block;
            color: var(--gray);
            font-size: 14px;
            margin-bottom: 5px;
        }

        .detail-value {
            font-weight: 500;
        }

        .card {
            border-width: 1px;
            margin-bottom: 20px;
        }

        .card-header {
            font-weight: 500;
        }

        .table-dark {
            background-color: transparent;
        }

        .table-dark td,
        .table-dark th {
            border-color: rgba(255, 255, 255, 0.1);
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

            .img-thumb {
                width: 50px;
                height: 50px;
                object-fit: cover;
                border-radius: 5px;
            }

            .pagination-info {
                color: var(--gray);
                font-size: 14px;
            }

            .pagination-options {
                width: 140px;
            }

            .pagination .page-link {
                background-color: var(--dark);
                border-color: rgba(255, 255, 255, 0.1);
                color: var(--light);
            }

            .pagination .page-item.active .page-link {
                background-color: var(--primary);
                border-color: var(--primary);
                color: var(--dark);
            }

            .pagination .page-item.disabled .page-link {
                background-color: var(--dark);
                border-color: rgba(255, 255, 255, 0.1);
                color: var(--gray);
            }

            .pagination .page-link:hover:not(.disabled) {
                background-color: var(--primary-dark);
                border-color: var(--primary-dark);
                color: var(--light);
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
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
                            <button class="btn btn-outline-primary dropdown-toggle" type="button" id="filterDropdown"
                            >
                                Filter
                            </button>
                            
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
                        <?php foreach ($products as $product): ?>
                            <tr>
                                <td>#<?= htmlspecialchars($product['id']) ?></td>
                                <td>
                                    <div class="product-img">
                                        <img src="<?= htmlspecialchars($product['image_url'] ?? '/placeholder.svg') ?>"
                                            alt="<?= htmlspecialchars($product['name']) ?>">
                                    </div>
                                </td>
                                <td><?= htmlspecialchars($product['name']) ?></td>
                                <td><?= htmlspecialchars($product['category_name']) ?></td>
                                <td>$<?= number_format($product['price'], 2) ?></td>
                                <td><?= $product['stock'] ?></td>
                                <td>
                                    <?php if ((int) $product['stock'] === 0): ?>
                                        <span class="badge bg-danger">Out of Stock</span>
                                    <?php elseif ((int) $product['status'] === 0): ?>
                                        <span class="badge bg-danger">Inactive</span>
                                    <?php elseif ((int) $product['stock'] < 10): ?>
                                        <span class="badge bg-warning">Low Stock</span>
                                    <?php else: ?>
                                        <span class="badge bg-success">Active</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="action-btns">
                                        <button class="btn btn-sm btn-primary btn-edit" data-id="<?= $product['id'] ?>"
                                            data-name="<?= htmlspecialchars($product['name'], ENT_QUOTES) ?>"
                                            data-category="<?= $product['category_id'] ?>"
                                            data-price="<?= $product['price'] ?>" data-stock="<?= $product['stock'] ?>"
                                            data-description="<?= htmlspecialchars($product['description'], ENT_QUOTES) ?>"
                                            data-status="<?= $product['status'] ?>"
                                            data-image="<?= $product['image_url'] ?>" data-bs-toggle="modal"
                                            data-bs-target="#editProductModal">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <button class="btn btn-danger btn-delete-product" data-id="<?= $product['id'] ?>"
                                            data-name="<?= htmlspecialchars($product['name']) ?>">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        <button class="btn btn-primary btn-view-product" data-id="<?= $product['id'] ?>"
                                            data-name="<?= htmlspecialchars($product['name']) ?>"
                                            data-category="<?= htmlspecialchars($product['category_name']) ?>"
                                            data-price="$<?= number_format($product['price'], 2) ?>"
                                            data-description="<?= htmlspecialchars($product['description'] ?? 'No description') ?>">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <nav aria-label="Product pagination" class="mt-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="pagination-info">
                        <!-- Showing <span id="pagination-start"></span>
                        to
                        <span id="pagination-end"></span>
                        of
                        <span id="pagination-total"></span> products -->
                    </div>
                    <ul class="pagination justify-content-center">
                        <!-- <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                            <a class="page-link"
                                href="?pagination=<?= $page - 1 ?>&per_page=<?= $perPage ?>">Previous</a>
                        </li>

                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                                <a class="page-link" href="?pagination=<?= $i ?>&per_page=<?= $perPage ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>

                        <li class="page-item <?= $page >= $totalPages ? 'disabled' : '' ?>">
                            <a class="page-link" href="?pagination=<?= $page + 1 ?>&per_page=<?= $perPage ?>">Next</a>
                        </li> -->
                    </ul>
                    <div class="pagination-options">
                        <select class="form-select form-select-sm" id="pagination-size">
                            <option value="10">10 per page</option>
                            <option value="25">25 per page</option>
                            <option value="50">50 per page</option>
                            <option value="100">100 per page</option>
                        </select>
                    </div>
                </div>
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
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="productName" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="productName" name="productName"
                                placeholder="Enter product name">
                        </div>
                        <div class="col-md-6">
                            <label for="productCategory" class="form-label">Category</label>
                            <select class="form-select" id="productCategory" name="productCategory">
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?= htmlspecialchars($category->getId()) ?>">
                                        <?= htmlspecialchars($category->getName()) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="productPrice" class="form-label">Price</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" id="productPrice" name="productPrice"
                                    placeholder="0.00" step="0.01">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="productStock" class="form-label">Stock Quantity</label>
                            <input type="number" class="form-control" id="productStock" name="productStock"
                                placeholder="Enter quantity">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="productDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="productDescription" name="productDescription" rows="3"
                            placeholder="Enter product description"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="productImage" class="form-label">Product Image</label>
                        <input type="file" class="form-control" id="productImage" name="productImage" accept="image/*">
                        <div class="mt-2">
                            <img id="previewImage" src="" alt="Preview Image" style="max-width: 150px; display: none; border-radius: 8px; border: 1px solid #ddd;">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="productStatus" class="form-label">Status</label>
                            <select class="form-select" id="productStatus" name="productStatus">
                                <option value="active" selected>Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <!-- <div class="col-md-6">
                            <label for="productFeatured" class="form-label">Featured</label>
                            <select class="form-select" id="productFeatured">
                                <option value="no" selected>No</option>
                                <option value="yes">Yes</option>
                            </select>
                        </div> -->
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Add Product</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <!-- <button type="submit" class="btn btn-primary">Add Product</button> -->
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
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="row mb-3">
                        <input type="hidden" id="editProductId" name="productId">
                        <div class="col-md-6">
                            <label for="editProductName" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="editProductName" name="productName"
                                value="Delicious Burger">
                        </div>
                        <div class="col-md-6">
                            <label for="editProductCategory" class="form-label">Category</label>
                            <select class="form-select" id="editProductCategory" name="productCategory">
                                <option>Select category</option>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?= htmlspecialchars($category->getId()) ?>">
                                        <?= htmlspecialchars($category->getName()) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="editProductPrice" class="form-label">Price</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" id="editProductPrice" value="15.99"
                                    step="0.01" name="productPrice">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="editProductStock" class="form-label">Stock Quantity</label>
                            <input type="number" class="form-control" id="editProductStock" value="45"
                                name="productStock">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="editProductDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="editProductDescription" name="productDescription"
                            rows="3">Veniam debitis quaerat officiis quasi cupiditate quo, quisquam velit, magnam voluptatem repellendus sed eaque</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="editProductImage" class="form-label">Product Image</label>
                        <div class="d-flex align-items-center mb-2">
                            <div class="product-img me-3">
                                <img id="current-product-image" src="/placeholder.svg?height=60&width=60"
                                    alt="Current Image">
                            </div>
                            <span>Current Image</span>
                        </div>
                        <input type="file" class="form-control" id="editProductImage" name="productImage">
                        <input type="hidden" id="oldProductImage" name="oldProductImage">
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="editProductStatus" class="form-label">Status</label>
                            <select class="form-select" id="editProductStatus" name="productStatus">
                                <option value="active" selected>Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <!-- <div class="col-md-6">
                            <label for="editProductFeatured" class="form-label">Featured</label>
                            <select class="form-select" id="editProductFeatured">
                                <option value="no">No</option>
                                <option value="yes" selected>Yes</option>
                            </select>
                        </div> -->
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="filterProductsModal" tabindex="-1" aria-labelledby="filterProductsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filterProductsModalLabel">Filter Products</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <!-- Product ID / Name -->
                    <div class="mb-3">
                        <label for="productIdOrName" class="form-label">Product ID / Name</label>
                        <input type="text" class="form-control" id="productIdOrName" placeholder="Search by ID or name...">
                    </div>

                    <!-- Category -->
                    <div class="mb-3">
                        <label for="productCategoryFilter" class="form-label">Category</label>
                        <select class="form-select" id="productCategoryFilter">
                            <option value="">All Categories</option>
                            <!-- Inject category options dynamically -->
                        </select>
                    </div>

                    <!-- Price Range -->
                    <div class="mb-3">
                        <label class="form-label">Price Range</label>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group mb-2">
                                    <span class="input-group-text bg-dark text-light border-secondary">VNĐ</span>
                                    <input type="number" class="form-control" id="priceMin" placeholder="Min">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-text bg-dark text-light border-secondary">VNĐ</span>
                                    <input type="number" class="form-control" id="priceMax" placeholder="Max">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Stock Range -->
                    <div class="mb-3">
                        <label class="form-label">Stock Range</label>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="number" class="form-control mb-2" id="stockMin" placeholder="Min Stock">
                            </div>
                            <div class="col-md-6">
                                <input type="number" class="form-control" id="stockMax" placeholder="Max Stock">
                            </div>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="statusActive" checked>
                            <label class="form-check-label" for="statusActive">Active</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="statusInactive" checked>
                            <label class="form-check-label" for="statusInactive">Inactive</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="statusOutOfStock" checked>
                            <label class="form-check-label" for="statusOutOfStock">Out of Stock</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-outline-primary" id="resetProductFilters">Reset Filters</button>
                <button type="button" class="btn btn-primary" id="applyProductFilters">Apply Filters</button>
            </div>
        </div>
    </div>
</div>

<!-- Product Detail Modal -->
<div class="modal fade" id="productDetailModal" tabindex="-1" aria-labelledby="productDetailModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-dark text-light">
            <div class="modal-header">
                <h5 class="modal-title" id="productDetailModalLabel">Product Details</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="product-image mb-3">
                            <img src="https://via.placeholder.com/300" alt="Product Image" id="modal-product-image"
                                class="img-fluid rounded">
                        </div>
                        <div class="product-status mb-3">
                            <span class="badge bg-success" id="modal-product-status">In Stock</span>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h4 id="modal-product-name">Product Name</h4>
                        <p class="text-muted" id="modal-product-id">#12345</p>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <span class="detail-label">Category:</span>
                                    <span class="detail-value" id="modal-product-category">Category A</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <span class="detail-label">Price:</span>
                                    <span class="detail-value" id="modal-product-price">$99.99</span>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">

                            <div class="col-md-6">
                                <div class="detail-item">
                                    <span class="detail-label">Inventory:</span>
                                    <span class="detail-value" id="modal-product-inventory">125 units</span>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="detail-item">
                                    <span class="detail-label">Description:</span>
                                    <p class="detail-value" id="modal-product-description">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam auctor, nisl
                                        eget ultricies tincidunt, nisl nisl aliquam nisl, eget ultricies nisl nisl eget
                                        nisl.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <div class="row">
                    <div class="col-md-6">
                        <div class="card bg-dark border-primary mb-3">
                            <div class="card-header bg-primary bg-opacity-25 text-primary">
                                <h5 class="mb-0">Sales Performance</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <div class="detail-item">
                                            <span class="detail-label">Total Sales:</span>
                                            <h4 class="detail-value" id="modal-product-total-sales">1,245 units</h4>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <div class="detail-item">
                                            <span class="detail-label">Revenue:</span>
                                            <h4 class="detail-value" id="modal-product-revenue">$12,450</h4>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="detail-item">
                                            <span class="detail-label">Profit:</span>
                                            <h4 class="detail-value text-success" id="modal-product-profit">$4,980</h4>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="detail-item">
                                            <span class="detail-label">Profit Margin:</span>
                                            <h4 class="detail-value text-success" id="modal-product-margin">40%</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card bg-dark border-warning mb-3">
                            <div class="card-header bg-warning bg-opacity-25 text-warning">
                                <h5 class="mb-0">Monthly Sales Trend</h5>
                            </div>
                            <div class="card-body">
                                <canvas id="productSalesChart" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


</div>
