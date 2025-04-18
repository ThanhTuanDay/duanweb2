<?php
$params = ['image' => 'public/images/hero-bg.jpg'];
require dirname(__FILE__) . '/../layout/hero_section.php';
include dirname(__FILE__) . '/../layout/headersection.php';
include dirname(__FILE__) . '/../layout/slider.php';
require(dirname(__DIR__) . "../../controller/product.controller.php");
require(dirname(__DIR__) . "../../controller/category.controller.php");
$productController = new ProductController();
$categoryController = new CategoryController();
$categories = $categoryController->getAllCategory();
$page = isset($_GET['pagination']) ? (int) $_GET['pagination'] : 1;
$perPage = isset($_GET['per_page']) ? (int) $_GET['per_page'] : 9;

$total = $productController->countTotalProducts();
$totalPages = ceil($total / $perPage);
$current_filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';
$products = $productController->getProductsForMenu();
?>

</div>
<div id="cart-notifications-container" class="cart-notifications-container"></div>
<section class="offer_section layout_padding-bottom">

    <div class="offer_container">

        <div class="container ">
            <div class="row">
                <div class="col-md-6  ">
                    <div class="box ">
                        <div class="img-box">
                            <img src="/public/images/o1.jpg" alt="">
                        </div>
                        <div class="detail-box">
                            <h5>
                                Tasty Thursdays
                            </h5>
                            <h6>
                                <span>20%</span> Off
                            </h6>
                            <a href="">
                                Order Now <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                    viewBox="0 0 456.029 456.029" style="enable-background:new 0 0 456.029 456.029;"
                                    xml:space="preserve">
                                    <g>
                                        <g>
                                            <path d="M345.6,338.862c-29.184,0-53.248,23.552-53.248,53.248c0,29.184,23.552,53.248,53.248,53.248
                     c29.184,0,53.248-23.552,53.248-53.248C398.336,362.926,374.784,338.862,345.6,338.862z" />
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path d="M439.296,84.91c-1.024,0-2.56-0.512-4.096-0.512H112.64l-5.12-34.304C104.448,27.566,84.992,10.67,61.952,10.67H20.48
                     C9.216,10.67,0,19.886,0,31.15c0,11.264,9.216,20.48,20.48,20.48h41.472c2.56,0,4.608,2.048,5.12,4.608l31.744,216.064
                     c4.096,27.136,27.648,47.616,55.296,47.616h212.992c26.624,0,49.664-18.944,55.296-45.056l33.28-166.4
                     C457.728,97.71,450.56,86.958,439.296,84.91z" />
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path d="M215.04,389.55c-1.024-28.16-24.576-50.688-52.736-50.688c-29.696,1.536-52.224,26.112-51.2,55.296
                     c1.024,28.16,24.064,50.688,52.224,50.688h1.024C193.536,443.31,216.576,418.734,215.04,389.55z" />
                                        </g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6  ">
                    <div class="box ">
                        <div class="img-box">
                            <img src="public/images/o2.jpg" alt="">
                        </div>
                        <div class="detail-box">
                            <h5>
                                Pizza Days
                            </h5>
                            <h6>
                                <span>15%</span> Off
                            </h6>
                            <a href="">
                                Order Now <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                    viewBox="0 0 456.029 456.029" style="enable-background:new 0 0 456.029 456.029;"
                                    xml:space="preserve">
                                    <g>
                                        <g>
                                            <path d="M345.6,338.862c-29.184,0-53.248,23.552-53.248,53.248c0,29.184,23.552,53.248,53.248,53.248
                     c29.184,0,53.248-23.552,53.248-53.248C398.336,362.926,374.784,338.862,345.6,338.862z" />
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path d="M439.296,84.91c-1.024,0-2.56-0.512-4.096-0.512H112.64l-5.12-34.304C104.448,27.566,84.992,10.67,61.952,10.67H20.48
                     C9.216,10.67,0,19.886,0,31.15c0,11.264,9.216,20.48,20.48,20.48h41.472c2.56,0,4.608,2.048,5.12,4.608l31.744,216.064
                     c4.096,27.136,27.648,47.616,55.296,47.616h212.992c26.624,0,49.664-18.944,55.296-45.056l33.28-166.4
                     C457.728,97.71,450.56,86.958,439.296,84.91z" />
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path d="M215.04,389.55c-1.024-28.16-24.576-50.688-52.736-50.688c-29.696,1.536-52.224,26.112-51.2,55.296
                     c1.024,28.16,24.064,50.688,52.224,50.688h1.024C193.536,443.31,216.576,418.734,215.04,389.55z" />
                                        </g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- end offer section -->

<!-- food section -->

<section class="food_section layout_padding-bottom" id="food-section">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>Our Menu</h2>
        </div>
        
        <!-- Mobile filter toggle button -->
        <button class="mobile-filter-toggle" id="mobile-filter-toggle">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
            </svg>
            Filter Options
        </button>
        
        <div class="menu-container">
            <!-- Filter Sidebar -->
            <div class="filter-sidebar" id="filter-sidebar">
                <form id="filter-form">
                    <!-- Search Filter -->
                    <div class="filter-section">
                        <div class="filter-title">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            Search Products
                        </div>
                        <div class="search-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <input type="text" name="search" id="search-input" placeholder="Search by name..." value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                        </div>
                    </div>
                    
                    <!-- Category Filter -->
                    <div class="filter-section">
                        <div class="filter-title collapsible-title">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                            </svg>
                            Categories
                        </div>
                        <ul class="category-list collapsible-content">
                            <?php 
                            $selected_categories = isset($_GET['categories']) ? $_GET['categories'] : [];
                            foreach ($categories as $category): 
                                $category_id = $category->getId();
                                $category_name = $category->getName();
                                $is_checked = in_array($category_id, $selected_categories) ? 'checked' : '';
                            ?>
                            <li class="category-item">
                                <input type="checkbox" name="categories[]" id="category-<?= $category_id ?>" value="<?= $category_id ?>" class="category-checkbox" <?= $is_checked ?>>
                                <label for="category-<?= $category_id ?>" class="category-label">
                                    <span class="custom-checkbox">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </span>
                                    <?= htmlspecialchars($category_name) ?>
                                </label>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    
                    <!-- Price Range Filter -->
                    <div class="filter-section">
                        <div class="filter-title">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Price Range
                        </div>
                        <div class="price-range">
                            <div class="price-slider">
                                <div class="price-progress"></div>
                            </div>
                            <div class="range-input">
                                <input type="range" class="min-range" min="0" max="1000000" value="<?= isset($_GET['min_price']) ? intval($_GET['min_price']) : 0 ?>" step="10000">
                                <input type="range" class="max-range" min="0" max="1000000" value="<?= isset($_GET['max_price']) ? intval($_GET['max_price']) : 1000000 ?>" step="10000">
                            </div>
                            <div class="price-input">
                                <div class="field">
                                    <label>Min Price</label>
                                    <input id="min-input" type="number" name="min_price" class="min-input" value="<?= isset($_GET['min_price']) ? intval($_GET['min_price']) : 0 ?>">
                                </div>
                                <div class="field">
                                    <label>Max Price</label>
                                    <input id="max-input" type="number" name="max_price" class="max-input" value="<?= isset($_GET['max_price']) ? intval($_GET['max_price']) : 1000000 ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Filter Buttons -->
                    
                </form>
                <div class="filter-buttons">
                        <button onclick="applyFilters(event)" class="filter-btn apply-btn">Apply Filters</button>
                        <button type="button" class="filter-btn reset-btn" id="reset-filters">Reset</button>
                    </div>
            </div>
            
            <!-- Menu Content -->
            <div class="menu-content">
                <div class="filters-content">
                    <div class="row grid" id="product-list">
                        <!-- <?php foreach ($products as $product):
                            $categoryClass = strtolower(str_replace(' ', '-', $product['category_slug']));
                            ?>
                            <div class="col-sm-6 col-lg-4 all <?= $categoryClass ?>">
                                <div class="box">
                                    <div>
                                        <div class="img-box">
                                            <img src="<?= htmlspecialchars($product['image_url']) ?>"
                                                alt="<?= htmlspecialchars($product['name']) ?>">
                                        </div>
                                        <div class="detail-box">
                                            <h5><?= htmlspecialchars($product['name']) ?></h5>
                                            <p class="description"
                                                style="height: 80px; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical;">
                                                <?= htmlspecialchars($product['description']) ?>
                                            </p>
                                            <div class="options">
                                                <h6><?= number_format($product['price'], 0, ',', '.') ?>₫</h6>
                                                <a href="javascript:void(0)" onclick="addToCart(event,'<?= $product['id'] ?>')">
                                                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                        viewBox="0 0 456.029 456.029"
                                                        style="enable-background:new 0 0 456.029 456.029;" xml:space="preserve">
                                                        <g>
                                                            <g>
                                                                <path d="M345.6,338.862c-29.184,0-53.248,23.552-53.248,53.248c0,29.184,23.552,53.248,53.248,53.248
                                 c29.184,0,53.248-23.552,53.248-53.248C398.336,362.926,374.784,338.862,345.6,338.862z" />
                                                            </g>
                                                        </g>
                                                        <g>
                                                            <g>
                                                                <path d="M439.296,84.91c-1.024,0-2.56-0.512-4.096-0.512H112.64l-5.12-34.304C104.448,27.566,84.992,10.67,61.952,10.67H20.48
                                 C9.216,10.67,0,19.886,0,31.15c0,11.264,9.216,20.48,20.48,20.48h41.472c2.56,0,4.608,2.048,5.12,4.608l31.744,216.064
                                 c4.096,27.136,27.648,47.616,55.296,47.616h212.992c26.624,0,49.664-18.944,55.296-45.056l33.28-166.4
                                 C457.728,97.71,450.56,86.958,439.296,84.91z" />
                                                            </g>
                                                        </g>
                                                        <g>
                                                            <g>
                                                                <path
                                                                    d="M215.04,389.55c-1.024-28.16-24.576-50.688-52.736-50.688c-29.696,1.536-52.224,26.112-51.2,55.296
                                 c1.024,28.16,24.064,50.688,52.224,50.688h1.024C193.536,443.31,216.576,418.734,215.04,389.55z" />
                                                            </g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?> -->
                    </div>
                </div>
                
                <!-- Pagination Navigation -->
                <div class="pagination-container mt-5">
                    <div class="row">
                        <div class="col-12">
                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-center">
                                    <!-- <?php if ($page > 1): ?>
                                        <li class="page-item">
                                            <a class="page-link"
                                                href="?pagination=<?php echo $page - 1; ?><?php echo $current_filter != 'all' ? '&filter=' . $current_filter : ''; ?><?php echo isset($_GET['search']) ? '&search=' . urlencode($_GET['search']) : ''; ?><?php echo isset($_GET['min_price']) ? '&min_price=' . intval($_GET['min_price']) : ''; ?><?php echo isset($_GET['max_price']) ? '&max_price=' . intval($_GET['max_price']) : ''; ?>"
                                                aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>
                                    <?php else: ?>
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>
                                    <?php endif; ?>

                                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                        <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                                            <a class="page-link"
                                                href="?pagination=<?php echo $i; ?><?php echo $current_filter != 'all' ? '&filter=' . $current_filter : ''; ?><?php echo isset($_GET['search']) ? '&search=' . urlencode($_GET['search']) : ''; ?><?php echo isset($_GET['min_price']) ? '&min_price=' . intval($_GET['min_price']) : ''; ?><?php echo isset($_GET['max_price']) ? '&max_price=' . intval($_GET['max_price']) : ''; ?>">
                                                <?php echo $i; ?>
                                            </a>
                                        </li>
                                    <?php endfor; ?>

                                    <?php if ($page < $totalPages): ?>
                                        <li class="page-item">
                                            <a class="page-link"
                                                href="?pagination=<?php echo $page + 1; ?><?php echo $current_filter != 'all' ? '&filter=' . $current_filter : ''; ?><?php echo isset($_GET['search']) ? '&search=' . urlencode($_GET['search']) : ''; ?><?php echo isset($_GET['min_price']) ? '&min_price=' . intval($_GET['min_price']) : ''; ?><?php echo isset($_GET['max_price']) ? '&max_price=' . intval($_GET['max_price']) : ''; ?>"
                                                aria-label="Next">
                                                <span aria-hidden="true">&raquo;</span>
                                            </a>
                                        </li>
                                    <?php else: ?>
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#" aria-label="Next">
                                                <span aria-hidden="true">&raquo;</span>
                                            </a>
                                        </li>
                                    <?php endif; ?> -->
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="product-data" value='<?= htmlspecialchars(json_encode($products, JSON_UNESCAPED_UNICODE)) ?>'>
</section>
<!-- end food section -->









