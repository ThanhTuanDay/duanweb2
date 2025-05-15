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
                            <a href="#food-section">
                            ĐẶT HÀNG NGAY <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
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
                            <a href="#food-section">
                            ĐẶT HÀNG NGAY <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
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
            <h2>Thực đơn</h2>
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
                            Tìm kiếm sản phẩm
                        </div>
                        <div class="search-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <input type="text" name="search" id="search-input" placeholder="Tìm kiếm tên sản phẩm" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                        </div>
                    </div>
                    
                    <!-- Category Filter -->
                    <div class="filter-section">
                        <div class="filter-title collapsible-title">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                            </svg>
                            Loại sản phẩm
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
                            Khoảng giá
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
                                    <label>Giá thấp nhất</label>
                                    <input id="min-input" type="number" name="min_price" class="min-input" value="<?= isset($_GET['min_price']) ? intval($_GET['min_price']) : 0 ?>">
                                </div>
                                <div class="field">
                                    <label>Giá cao nhất</label>
                                    <input id="max-input" type="number" name="max_price" class="max-input" value="<?= isset($_GET['max_price']) ? intval($_GET['max_price']) : 1000000 ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Filter Buttons -->
                    
                </form>
                <div class="filter-buttons">
                        <button onclick="applyFilters(event)" class="filter-btn apply-btn">Lọc</button>
                        <button type="button" class="filter-btn reset-btn" id="reset-filters">Làm mới</button>
                    </div>
            </div>
            
            <!-- Menu Content -->
            <div class="menu-content">
                <div class="filters-content">
                    <div class="row grid" id="product-list">
                        
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
</section>
<!-- end food section -->
<!-- Product Detail Modal -->
<!-- Custom Product Detail Modal -->
<div id="customProductModal" class="custom-modal">
  <div class="custom-modal-overlay"></div>
  <div class="custom-modal-container">
    <button type="button" class="custom-modal-close" id="closeCustomModal">
      <i class="fas fa-times"></i>
    </button>
    
    <div class="custom-modal-content">
      <div class="product-modal-row">
        <!-- Product Image Column -->
        <div class="product-image-column">
          <div class="product-image-wrapper">
            <div class="image-zoom-container">
              <img src="/placeholder.svg" alt="" id="modal-product-image" class="product-detail-image">
              <div class="image-zoom-lens"></div>
            </div>
            <div class="image-zoom-result"></div>
            
            <!-- Image thumbnails -->
            <div class="product-thumbnails">
              <div class="thumbnail active" data-image-url="">
                <img src="/placeholder.svg" alt="" id="thumbnail-1">
              </div>
              <div class="thumbnail" data-image-url="">
                <img src="/placeholder.svg" alt="" id="thumbnail-2">
              </div>
              <div class="thumbnail" data-image-url="">
                <img src="/placeholder.svg" alt="" id="thumbnail-3">
              </div>
            </div>
          </div>
        </div>
        
        <!-- Product Details Column -->
        <div class="product-details-column">
          <div class="product-details-wrapper">
            <div class="product-category">
              <span class="badge" id="modal-product-category"></span>
            </div>
            
            <h2 class="product-title" id="modal-product-name"></h2>
            
            <div class="product-rating">
              <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
              </div>
              <span class="rating-count">(24 đánh giá)</span>
            </div>
            
            <div class="product-price" id="modal-product-price"></div>
            
            <div class="product-description">
              <p id="modal-product-description"></p>
            </div>
            
            <div class="product-meta">
              <div class="meta-item">
                <span class="meta-label">ID sản phẩm:</span>
                <span class="meta-value" id="modal-product-id"></span>
              </div>
              <div class="meta-item">
                <span class="meta-label">Tình trạng:</span>
                <span class="meta-value in-stock">Còn hàng</span>
              </div>
              <div class="meta-item">
                <span class="meta-label">Thời gian chuẩn bị:</span>
                <span class="meta-value">15-20 phút</span>
              </div>
            </div>
            
            <div class="product-actions">
              <div class="quantity-selector">
                <button class="quantity-btn minus" id="decrease-quantity">
                  <i class="fas fa-minus"></i>
                </button>
                <input type="number" id="product-quantity" value="1" min="1" max="99">
                <button class="quantity-btn plus" id="increase-quantity">
                  <i class="fas fa-plus"></i>
                </button>
              </div>
              
              <button class="add-to-cart-btn" id="modal-add-to-cart">
                <i class="fas fa-shopping-cart"></i>
                Thêm vào giỏ hàng
              </button>
            </div>
            
            <div class="product-share">
              <span class="share-label">Chia sẻ:</span>
              <div class="share-buttons">
                <a href="https://www.facebook.com/sharer/sharer.php?u=http://localhost/duanweb2/homepage" target="_blank" class="share-btn facebook">
                  <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" class="share-btn twitter">
                  <i class="fab fa-twitter"></i>
                </a>
                <a href="#" class="share-btn pinterest">
                  <i class="fab fa-pinterest-p"></i>
                </a>
                <a href="#" class="share-btn instagram">
                  <i class="fab fa-instagram"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Product Tabs Section -->
      <div class="product-tabs-section">
        <div class="custom-tabs">
          <div class="custom-tabs-nav">
            <button class="custom-tab-btn active" data-tab="details">Details</button>
            <button class="custom-tab-btn" data-tab="ingredients">Ingredients</button>
            <button class="custom-tab-btn" data-tab="nutrition">Nutrition</button>
            <button class="custom-tab-btn" data-tab="reviews">Reviews</button>
          </div>
          
          <div class="custom-tabs-content">
            <div class="custom-tab-pane active" id="details-tab">
              <div class="tab-content-inner">
                <p>Our signature dish is prepared with the finest ingredients, carefully selected to ensure the best flavor and quality. Each dish is made to order, ensuring freshness and perfect taste every time.</p>
                <p>Whether you're dining in or taking out, our commitment to excellence remains the same. We take pride in serving food that not only satisfies your hunger but also delights your taste buds.</p>
                <ul class="features-list">
                  <li><i class="fas fa-check"></i> Made with fresh ingredients</li>
                  <li><i class="fas fa-check"></i> No preservatives</li>
                  <li><i class="fas fa-check"></i> Chef's special recipe</li>
                  <li><i class="fas fa-check"></i> Prepared to order</li>
                </ul>
              </div>
            </div>
            
            <div class="custom-tab-pane" id="ingredients-tab">
              <div class="tab-content-inner">
                <div class="ingredients-list">
                  <div class="ingredient-item">
                    <div class="ingredient-icon">
                      <i class="fas fa-leaf"></i>
                    </div>
                    <div class="ingredient-details">
                      <h5>Fresh Vegetables</h5>
                      <p>Locally sourced, organic vegetables for the best flavor and nutrition.</p>
                    </div>
                  </div>
                  
                  <div class="ingredient-item">
                    <div class="ingredient-icon">
                      <i class="fas fa-drumstick-bite"></i>
                    </div>
                    <div class="ingredient-details">
                      <h5>Premium Protein</h5>
                      <p>High-quality, ethically sourced protein that's tender and flavorful.</p>
                    </div>
                  </div>
                  
                  <div class="ingredient-item">
                    <div class="ingredient-icon">
                      <i class="fas fa-cheese"></i>
                    </div>
                    <div class="ingredient-details">
                      <h5>Artisan Cheese</h5>
                      <p>Specially selected cheese that adds the perfect creamy texture.</p>
                    </div>
                  </div>
                  
                  <div class="ingredient-item">
                    <div class="ingredient-icon">
                      <i class="fas fa-seedling"></i>
                    </div>
                    <div class="ingredient-details">
                      <h5>Fresh Herbs</h5>
                      <p>Aromatic herbs that enhance the flavor profile of every dish.</p>
                    </div>
                  </div>
                </div>
                
                <div class="allergens-info">
                  <h5>Allergen Information</h5>
                  <p>Contains: Gluten, Dairy, Eggs</p>
                  <p>May contain traces of nuts and soy.</p>
                </div>
              </div>
            </div>
            
            <div class="custom-tab-pane" id="nutrition-tab">
              <div class="tab-content-inner">
                <div class="nutrition-facts">
                  <h5 class="nutrition-title">Nutrition Facts</h5>
                  <p class="serving-size">Serving Size: 1 portion (250g)</p>
                  
                  <div class="nutrition-table">
                    <div class="nutrition-row header">
                      <div class="nutrition-cell">Nutrient</div>
                      <div class="nutrition-cell">Amount</div>
                      <div class="nutrition-cell">% Daily Value*</div>
                    </div>
                    
                    <div class="nutrition-row">
                      <div class="nutrition-cell">Calories</div>
                      <div class="nutrition-cell">450</div>
                      <div class="nutrition-cell">-</div>
                    </div>
                    
                    <div class="nutrition-row">
                      <div class="nutrition-cell">Total Fat</div>
                      <div class="nutrition-cell">18g</div>
                      <div class="nutrition-cell">23%</div>
                    </div>
                    
                    <div class="nutrition-row sub">
                      <div class="nutrition-cell">Saturated Fat</div>
                      <div class="nutrition-cell">8g</div>
                      <div class="nutrition-cell">40%</div>
                    </div>
                    
                    <div class="nutrition-row sub">
                      <div class="nutrition-cell">Trans Fat</div>
                      <div class="nutrition-cell">0g</div>
                      <div class="nutrition-cell">-</div>
                    </div>
                    
                    <div class="nutrition-row">
                      <div class="nutrition-cell">Cholesterol</div>
                      <div class="nutrition-cell">55mg</div>
                      <div class="nutrition-cell">18%</div>
                    </div>
                    
                    <div class="nutrition-row">
                      <div class="nutrition-cell">Sodium</div>
                      <div class="nutrition-cell">850mg</div>
                      <div class="nutrition-cell">37%</div>
                    </div>
                    
                    <div class="nutrition-row">
                      <div class="nutrition-cell">Total Carbohydrate</div>
                      <div class="nutrition-cell">45g</div>
                      <div class="nutrition-cell">16%</div>
                    </div>
                    
                    <div class="nutrition-row sub">
                      <div class="nutrition-cell">Dietary Fiber</div>
                      <div class="nutrition-cell">3g</div>
                      <div class="nutrition-cell">11%</div>
                    </div>
                    
                    <div class="nutrition-row sub">
                      <div class="nutrition-cell">Sugars</div>
                      <div class="nutrition-cell">6g</div>
                      <div class="nutrition-cell">-</div>
                    </div>
                    
                    <div class="nutrition-row">
                      <div class="nutrition-cell">Protein</div>
                      <div class="nutrition-cell">22g</div>
                      <div class="nutrition-cell">44%</div>
                    </div>
                  </div>
                  
                  <p class="nutrition-disclaimer">* Percent Daily Values are based on a 2,000 calorie diet. Your daily values may be higher or lower depending on your calorie needs.</p>
                </div>
              </div>
            </div>
            
            <div class="custom-tab-pane" id="reviews-tab">
              <div class="tab-content-inner">
                <div class="reviews-summary">
                  <div class="rating-summary">
                    <div class="average-rating">4.5</div>
                    <div class="rating-stars">
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star-half-alt"></i>
                    </div>
                    <div class="rating-count">Based on 24 reviews</div>
                  </div>
                  
                  <div class="rating-bars">
                    <div class="rating-bar-item">
                      <div class="rating-label">5 Stars</div>
                      <div class="rating-bar">
                        <div class="rating-fill" style="width: 75%"></div>
                      </div>
                      <div class="rating-count">18</div>
                    </div>
                    
                    <div class="rating-bar-item">
                      <div class="rating-label">4 Stars</div>
                      <div class="rating-bar">
                        <div class="rating-fill" style="width: 17%"></div>
                      </div>
                      <div class="rating-count">4</div>
                    </div>
                    
                    <div class="rating-bar-item">
                      <div class="rating-label">3 Stars</div>
                      <div class="rating-bar">
                        <div class="rating-fill" style="width: 8%"></div>
                      </div>
                      <div class="rating-count">2</div>
                    </div>
                    
                    <div class="rating-bar-item">
                      <div class="rating-label">2 Stars</div>
                      <div class="rating-bar">
                        <div class="rating-fill" style="width: 0%"></div>
                      </div>
                      <div class="rating-count">0</div>
                    </div>
                    
                    <div class="rating-bar-item">
                      <div class="rating-label">1 Star</div>
                      <div class="rating-bar">
                        <div class="rating-fill" style="width: 0%"></div>
                      </div>
                      <div class="rating-count">0</div>
                    </div>
                  </div>
                </div>
                
                <div class="reviews-list">
                  <div class="review-item">
                    <div class="reviewer-avatar">
                      <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="John D.">
                    </div>
                    <div class="review-content">
                      <div class="reviewer-name">John D.</div>
                      <div class="review-date">2 days ago</div>
                      <div class="reviewer-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                      </div>
                      <div class="review-text">
                        <p>Absolutely delicious! The flavors were amazing and the portion size was perfect. I'll definitely be ordering this again on my next visit.</p>
                      </div>
                    </div>
                  </div>
                  
                  <div class="review-item">
                    <div class="reviewer-avatar">
                      <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Sarah M.">
                    </div>
                    <div class="review-content">
                      <div class="reviewer-name">Sarah M.</div>
                      <div class="review-date">1 week ago</div>
                      <div class="reviewer-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                      </div>
                      <div class="review-text">
                        <p>Great taste and quality. Would definitely order again! The service was also excellent.</p>
                      </div>
                    </div>
                  </div>
                  
                  <div class="review-item">
                    <div class="reviewer-avatar">
                      <img src="https://randomuser.me/api/portraits/men/67.jpg" alt="Michael T.">
                    </div>
                    <div class="review-content">
                      <div class="reviewer-name">Michael T.</div>
                      <div class="review-date">2 weeks ago</div>
                      <div class="reviewer-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                      </div>
                      <div class="review-text">
                        <p>One of the best meals I've had in a long time. The flavors were perfectly balanced and everything was fresh. Highly recommend!</p>
                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="review-form-container">
                  <h5>Write a Review</h5>
                  <form class="review-form">
                    <div class="form-group">
                      <label>Your Rating</label>
                      <div class="rating-selector">
                        <i class="far fa-star" data-rating="1"></i>
                        <i class="far fa-star" data-rating="2"></i>
                        <i class="far fa-star" data-rating="3"></i>
                        <i class="far fa-star" data-rating="4"></i>
                        <i class="far fa-star" data-rating="5"></i>
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label for="review-name">Your Name</label>
                      <input type="text" id="review-name" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                      <label for="review-email">Your Email</label>
                      <input type="email" id="review-email" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                      <label for="review-text">Your Review</label>
                      <textarea id="review-text" class="form-control" rows="4" required></textarea>
                    </div>
                    
                    <button type="submit" class="btn-submit-review">Submit Review</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- about section -->

<section class="about_section layout_padding">
    <div class="container  ">

        <div class="row">
            <div class="col-md-6 ">
                <div class="img-box">
                    <img src="public/images/about-img.png" alt="">
                </div>
            </div>
            <div class="col-md-6">
                <div class="detail-box">
                    <div class="heading_container">
                        <h2>
                            Chúng tôi là Feane
                        </h2>
                    </div>
                    <p>
                        Không gian hiện đại, thực đơn phong phú, phục vụ chuyên nghiệp — nơi lý tưởng để thưởng thức ẩm thực và thư giãn cùng người thân, bạn bè.
                    </p>
                    <a href="">
                        Đọc thêmthêm
                    </a>
                </div>
            </div>

        </div>
    </div>
    </div>
</section>

<!-- end about section -->

<!-- book section -->
<section class="book_section layout_padding">
    <div class="container">
        <div class="heading_container">
            <h2>
                Book A Table
            </h2>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form_container">
                    <form action="">
                        <div>
                            <input type="text" class="form-control" placeholder="Your Name" />
                        </div>
                        <div>
                            <input type="text" class="form-control" placeholder="Phone Number" />
                        </div>
                        <div>
                            <input type="email" class="form-control" placeholder="Your Email" />
                        </div>
                        <div>
                            <select class="form-control nice-select wide">
                                <option value="" disabled selected>
                                    How many persons?
                                </option>
                                <option value="">
                                    2
                                </option>
                                <option value="">
                                    3
                                </option>
                                <option value="">
                                    4
                                </option>
                                <option value="">
                                    5
                                </option>
                            </select>
                        </div>
                        <div>
                            <input type="date" class="form-control">
                        </div>
                        <div class="btn_box">
                            <button>
                                Book Now
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="map_container ">
                    <div id="googleMap"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end book section -->

<!-- client section -->

<section class="client_section layout_padding-bottom">
    <div class="container">
        <div class="heading_container heading_center psudo_white_primary mb_45">
            <h2>
                What Says Our Customers
            </h2>
        </div>
        <div class="carousel-wrap row ">
            <div class="owl-carousel client_owl-carousel">
                <div class="item">
                    <div class="box">
                        <div class="detail-box">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam
                            </p>
                            <h6>
                                Moana Michell
                            </h6>
                            <p>
                                magna aliqua
                            </p>
                        </div>
                        <div class="img-box">
                            <img src="public/images/client1.jpg" alt="" class="box-img">
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="box">
                        <div class="detail-box">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam
                            </p>
                            <h6>
                                Mike Hamell
                            </h6>
                            <p>
                                magna aliqua
                            </p>
                        </div>
                        <div class="img-box">
                            <img src="public/images/client2.jpg" alt="" class="box-img">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="product-data" value='<?= htmlspecialchars(json_encode($products, JSON_UNESCAPED_UNICODE)) ?>'>
</section>

