<!-- Sidebar -->
<?php
require(dirname(__DIR__) . "/../../controller/user.controller.php");

$userController = new UserController();
$allusers = $userController->getAllUsers();

$totoalUsers = count($allusers);
$page = isset($_GET['pagination']) ? (int) $_GET['pagination'] : 1;
$perPage = isset($_GET['per_page']) ? (int) $_GET['per_page'] : 2;
$totalPages = ceil($totoalUsers / $perPage);
$users = $userController->getUsersPaginated($perPage, $page);
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

<!-- Main Content -->
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Users Management</h2>
        <!-- <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                    <i class="fas fa-plus me-2"></i> Add New User
                </button> -->
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
                            <input type="text" class="form-control" id="searchUsers" placeholder="Search users...">
                            <i class="fas fa-search search-icon"></i>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-outline-primary dropdown-toggle" type="button" id="filterDropdown"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Filter
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark"
                                aria-labelledby="filterDropdown">
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
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?= $user['id'] ?></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="user-avatar me-2">
                                            <img src="/placeholder.svg?height=40&width=40" alt="John Doe">
                                        </div>
                                        <div><?= $user['name'] ?></div>
                                    </div>
                                </td>
                                <td><?= $user['email'] ?></td>
                                <td><?= $user['phone'] ?></td>
                                <td><?= $user['role'] ?></td>
                                <td><?= $user['created_at'] ?></td>
                                <?php if ($user['is_block'] === 0): ?>
                                    <td><span class="badge bg-success">Active</span></td>
                                <?php else: ?>
                                    <td><span class="badge bg-danger">Inactive</span></td>
                                <?php endif; ?>
                                <td>
                                    <div class="action-btns d-flex">
                                        <button class="btn btn-sm btn-primary btn-edit" data-bs-toggle="modal"
                                            data-bs-target="#editUserModal" data-user-id="<?= $user['id'] ?>"
                                            data-name="<?= $user['name'] ?>" data-phone="<?= $user['phone'] ?>"
                                            data-address="<?= $user['address'] ?>">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#viewUserModal" data-user-id="<?= $user['id'] ?>"
                                            onclick="blockUser(this)">

                                            <i class="fa fa-ban"></i></button>
                                        <button class="btn btn-sm btn-success" data-user-id="<?= $user['id'] ?>"
                                            onclick="unBlockUser(this)"><i class="fa fa-lock-open"></i></button>
                                    </div>
                                </td>
                            </tr>

                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <!-- Previous Button -->
                    <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                        <a class="page-link" href="?pagination=<?= max(1, $page - 1) ?>&per_page=<?= $perPage ?>"
                            tabindex="-1" aria-disabled="<?= $page <= 1 ? 'true' : 'false' ?>">Previous</a>
                    </li>

                    <!-- Page Numbers -->
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                            <a class="page-link" href="?pagination=<?= $i ?>&per_page=<?= $perPage ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>

                    <!-- Next Button -->
                    <li class="page-item <?= $page >= $totalPages ? 'disabled' : '' ?>">
                        <a class="page-link"
                            href="?pagination=<?= min($totalPages, $page + 1) ?>&per_page=<?= $perPage ?>"
                            aria-disabled="<?= $page >= $totalPages ? 'true' : 'false' ?>">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="editName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="editName" name="name">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="editAddress" class="form-label">Address</label>
                        <input type="text" class="form-control" id="editAddress" name="address">
                    </div>
                    <div class="mb-3">
                        <label for="editPhone" class="form-label">Phone</label>
                        <input type="tel" class="form-control" id="editPhone" name="phone">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="saveUserChanges">Save Changes</button>
            </div>
        </div>
    </div>
</div>