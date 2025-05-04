let settings = [];
let taxClasses = [];
let taxRules = [];
let coupons = [];
let deliveryFee = 0;
let applicationTaxRate = 0;
let cartItems = null;
// to get current year
function getYear() {
    var currentDate = new Date();
    var currentYear = currentDate.getFullYear();
    document.querySelector("#displayYear").innerHTML = currentYear;
}

getYear();
const getApplicableTaxRate = () => {
    const activeRules = taxRules
        .filter(rule => rule.is_active)
        .sort((a, b) => a.priority - b.priority);
    if (activeRules.length > 0) {
        return parseFloat(activeRules[0].rate || 0);
    }
    return 0;
};
document.addEventListener('DOMContentLoaded', function () {
    const toggleTitles = document.querySelectorAll('.collapsible-title');

    toggleTitles.forEach(title => {
        title.addEventListener('click', () => {
            const content = title.nextElementSibling;
            if (content.classList.contains('collapsible-content')) {
                content.classList.toggle('open');
            }
        });
    });
    const customModal = document.getElementById('customProductModal');
    const closeModalBtn = document.getElementById('closeCustomModal');
    const modalOverlay = document.querySelector('.custom-modal-overlay');

    // Close modal when clicking the close button or overlay
    closeModalBtn.addEventListener('click', closeCustomModal);
    modalOverlay.addEventListener('click', closeCustomModal);

    // Prevent clicks inside the modal from closing it
    document.querySelector('.custom-modal-container').addEventListener('click', function (e) {
        e.stopPropagation();
    });

    // Close modal with ESC key
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && customModal.classList.contains('active')) {
            closeCustomModal();
        }
    });

    // Custom tabs functionality
    const tabButtons = document.querySelectorAll('.custom-tab-btn');

    tabButtons.forEach(button => {
        button.addEventListener('click', function () {
            // Remove active class from all buttons and panes
            tabButtons.forEach(btn => btn.classList.remove('active'));
            document.querySelectorAll('.custom-tab-pane').forEach(pane => pane.classList.remove('active'));

            // Add active class to clicked button
            this.classList.add('active');

            // Show corresponding tab pane
            const tabId = this.getAttribute('data-tab');
            document.getElementById(`${tabId}-tab`).classList.add('active');
        });
    });

    // Quantity controls
    document.getElementById('increase-quantity').addEventListener('click', function () {
        const quantityInput = document.getElementById('product-quantity');
        quantityInput.value = parseInt(quantityInput.value);
    });

    document.getElementById('decrease-quantity').addEventListener('click', function () {
        const quantityInput = document.getElementById('product-quantity');
        const currentValue = parseInt(quantityInput.value);
        if (currentValue > 1) {
            quantityInput.value = currentValue;
        }
    });

    // Ensure quantity is always at least 1
    document.getElementById('product-quantity').addEventListener('change', function () {
        if (this.value < 1) {
            this.value = 1;
        }
    });

    // Handle thumbnail clicks
    document.querySelectorAll('.thumbnail').forEach(thumb => {
        thumb.addEventListener('click', function () {
            // Remove active class from all thumbnails
            document.querySelectorAll('.thumbnail').forEach(t => t.classList.remove('active'));

            // Add active class to clicked thumbnail
            this.classList.add('active');

            // Update main image
            const imgUrl = this.getAttribute('data-image-url') || this.querySelector('img').src;
            document.getElementById('modal-product-image').src = imgUrl;

            // Update zoom result background
            document.querySelector('.image-zoom-result').style.backgroundImage = `url('${imgUrl}')`;
        });
    });

    // Rating selector in review form
    document.querySelectorAll('.rating-selector i').forEach(star => {
        star.addEventListener('mouseover', function () {
            const rating = parseInt(this.getAttribute('data-rating'));

            // Reset all stars
            document.querySelectorAll('.rating-selector i').forEach(s => {
                s.className = 'far fa-star';
            });

            // Fill stars up to the hovered one
            document.querySelectorAll('.rating-selector i').forEach(s => {
                if (parseInt(s.getAttribute('data-rating')) <= rating) {
                    s.className = 'fas fa-star';
                }
            });
        });

        star.addEventListener('click', function () {
            const rating = parseInt(this.getAttribute('data-rating'));

            // Set the selected rating
            document.querySelectorAll('.rating-selector i').forEach(s => {
                if (parseInt(s.getAttribute('data-rating')) <= rating) {
                    s.className = 'fas fa-star';
                } else {
                    s.className = 'far fa-star';
                }
            });
        });
    });

    // Reset stars when mouse leaves the rating selector
    document.querySelector('.rating-selector').addEventListener('mouseleave', function () {
        // Find the selected rating
        const selectedStars = document.querySelectorAll('.rating-selector i.fas');
        const rating = selectedStars.length;

        // Reset all stars
        document.querySelectorAll('.rating-selector i').forEach(s => {
            s.className = 'far fa-star';
        });

        // Fill stars up to the selected rating
        document.querySelectorAll('.rating-selector i').forEach(s => {
            if (parseInt(s.getAttribute('data-rating')) <= rating) {
                s.className = 'fas fa-star';
            }
        });
    });

    // Prevent form submission (for demo)
    document.querySelector('.review-form').addEventListener('submit', function (e) {
        e.preventDefault();
        alert('Review submitted successfully!');
        this.reset();
    });
});
// Validate phone number
function isValidPhone(phone) {
    const phoneRegex = /^[+]?[(]?[0-9]{1,4}[)]?[-\s.]?[0-9]{1,4}[-\s.]?[0-9]{1,9}$/;
    return phoneRegex.test(phone);
}
document.addEventListener('DOMContentLoaded', function () {
    // Quantity controls
    document.getElementById('increase-quantity').addEventListener('click', function () {
        const quantityInput = document.getElementById('product-quantity');
        quantityInput.value = parseInt(quantityInput.value) + 1;
    });

    document.getElementById('decrease-quantity').addEventListener('click', function () {
        const quantityInput = document.getElementById('product-quantity');
        const currentValue = parseInt(quantityInput.value);
        if (currentValue > 1) {
            quantityInput.value = currentValue - 1;
        }
    });

    // Ensure quantity is always at least 1
    document.getElementById('product-quantity').addEventListener('change', function () {
        if (this.value < 1) {
            this.value = 1;
        }
    });
});
// isotope js
$(window).on('load', function () {
    $('.filters_menu li').click(function () {
        $('.filters_menu li').removeClass('active');
        $(this).addClass('active');

        var data = $(this).attr('data-filter');
        $grid.isotope({
            filter: data
        })
    });

    var $grid = $(".grid").isotope({
        itemSelector: ".all",
        percentPosition: false,
        masonry: {
            columnWidth: ".all"
        }
    })
});

// nice select
$(document).ready(function () {
    $('select').niceSelect();
});

/** google_map js **/
// function myMap() {
//     var mapProp = 
//         center: new google.maps.LatLng(40.712775, -74.005973),
//         zoom: 18,
//     };
//     var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
// }

// client section owl carousel
$(".client_owl-carousel").owlCarousel({
    loop: true,
    margin: 0,
    dots: false,
    nav: true,
    navText: [],
    autoplay: true,
    autoplayHoverPause: true,
    navText: [
        '<i class="fa fa-angle-left" aria-hidden="true"></i>',
        '<i class="fa fa-angle-right" aria-hidden="true"></i>'
    ],
    responsive: {
        0: {
            items: 1
        },
        768: {
            items: 2
        },
        1000: {
            items: 2
        }
    }
});
const dataInput = document.getElementById('product-data') || null;
let allProducts = null;
if (dataInput) {
    const jsonData = document.getElementById('product-data').value || null;
    allProducts = JSON.parse(jsonData || null);
}
document.addEventListener('DOMContentLoaded', getSettings());
async function getSettings(cartData = null) {
    const response = await fetch('/duanweb2/app/api/settings.api.php?action=getSettings');
    const data = await response.json();

    if (data.success) {
        settings = data.general;
        taxClasses = data.tax.classes;
        taxRules = data.tax.rules;
        coupons = data.coupons;
        deliveryFee = parseInt(data.general.delivery_fee) || 0;
    }
    if (cartData) {
        window.cartItems = cartData;
        updateCart(cartData);
    }
}

if (allProducts) {
    const itemsPerPage = 6;
    let currentPage = 1;
    let filteredProducts = [...allProducts];
    window.addEventListener('DOMContentLoaded', () => {
    });

    document.addEventListener('DOMContentLoaded', function () {
        const searchContainer = document.getElementById("search-container")
        const searchBtn = document.getElementById("search-btn")
        const searchBtn1 = document.getElementById("search-btn1")
        const searchInput = document.getElementById("search-input-navbar")
        const searchResults = document.getElementById("search-results")
        const rangeInput = document.querySelectorAll(".range-input input");
        const priceInput = document.querySelectorAll(".price-input input");
        const progress = document.querySelector(".price-progress");
        const priceGap = 50000;
        searchBtn1.addEventListener("click", (e) => {
            document.getElementById("food-section").scrollIntoView({ behavior: "smooth" });
            document.getElementById("search-input").focus()
        })

        priceInput.forEach(input => {
            input.addEventListener("input", e => {
                let minVal = parseInt(priceInput[0].value);
                let maxVal = parseInt(priceInput[1].value);

                if ((maxVal - minVal >= priceGap) && maxVal <= 1000000) {
                    if (e.target.className === "min-input") {
                        rangeInput[0].value = minVal;
                        progress.style.left = (minVal / rangeInput[0].max) * 100 + "%";
                    } else {
                        rangeInput[1].value = maxVal;
                        progress.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
                    }
                }
            });
        });

        rangeInput.forEach(input => {
            input.addEventListener("input", e => {
                let minVal = parseInt(rangeInput[0].value);
                let maxVal = parseInt(rangeInput[1].value);

                if (maxVal - minVal < priceGap) {
                    if (e.target.className === "min-range") {
                        rangeInput[0].value = maxVal - priceGap;
                    } else {
                        rangeInput[1].value = minVal + priceGap;
                    }
                } else {
                    priceInput[0].value = minVal;
                    priceInput[1].value = maxVal;
                    progress.style.left = (minVal / rangeInput[0].max) * 100 + "%";
                    progress.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
                }
            });
        });

        // Initialize price slider position
        let minVal = parseInt(rangeInput[0].value);
        let maxVal = parseInt(rangeInput[1].value);
        progress.style.left = (minVal / rangeInput[0].max) * 100 + "%";
        progress.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";

        // Reset Filters
        document.getElementById('reset-filters').addEventListener('click', function () {
            // Reset search
            document.getElementById('search-input').value = '';

            // Reset categories
            document.querySelectorAll('.category-checkbox').forEach(checkbox => {
                checkbox.checked = false;
            });

            // Reset price range
            document.querySelector('.min-range').value = 0;
            document.querySelector('.max-range').value = 1000000;
            document.querySelector('.min-input').value = 0;
            document.querySelector('.max-input').value = 1000000;
            progress.style.left = "0%";
            progress.style.right = "0%";

            // Submit the form
            document.getElementById('filter-form').submit();
        });
        

        // Mobile filter toggle
        document.getElementById('mobile-filter-toggle').addEventListener('click', function () {
            const sidebar = document.getElementById('filter-sidebar');
            sidebar.classList.toggle('active');
        });
        searchBtn.addEventListener("click", (e) => {
            e.preventDefault()
            searchContainer.classList.toggle("active")

            if (searchContainer.classList.contains("active")) {
                setTimeout(() => {
                    searchInput.focus()
                }, 300)
            } else {
                searchInput.value = ""
                searchResults.innerHTML = ""
                searchContainer.classList.remove("has-results")
            }
        })

        document.addEventListener("click", (e) => {
            if (!searchContainer.contains(e.target)) {
                searchContainer.classList.remove("active")
                searchInput.value = ""
                searchResults.innerHTML = ""
                searchContainer.classList.remove("has-results")
            }
        })
        searchInput.addEventListener("input", function () {
            const query = this.value.toLowerCase().trim()

            if (query.length < 2) {
                searchResults.innerHTML = ""
                searchContainer.classList.remove("has-results")
                return
            }

            const filteredProducts = allProducts.filter((product) => product.name.toLowerCase().includes(query))

            if (filteredProducts.length > 0) {
                searchResults.innerHTML = ""

                filteredProducts.forEach((product) => {
                    const resultItem = document.createElement("a")
                    resultItem.href = "#"
                    resultItem.className = "search-result-item"
                    resultItem.innerHTML = `
                            <img src="${product.image_url}" alt="${product.name}" class="search-result-img">
                            <div class="search-result-info">
                                <div class="search-result-name">${product.name}</div>
                                <div class="search-result-price">$${Number(product.price).toFixed(2)}</div>
                            </div>
                        `

                    resultItem.addEventListener("click", (e) => {
                        e.preventDefault()
                        searchContainer.classList.remove("active")
                        searchInput.value = ""
                        searchResults.innerHTML = ""
                        searchContainer.classList.remove("has-results")
                        const foodSection = document.getElementById("food-section");
                        if (foodSection) {
                          foodSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
                        }
                        openCustomModal(product.id, allProducts)
                    })

                    searchResults.appendChild(resultItem)
                })

                searchContainer.classList.add("has-results")
            } else {
                searchResults.innerHTML = '<div class="search-no-results">No products found</div>'
                searchContainer.classList.add("has-results")
            }
        })

        renderProducts(allProducts, currentPage);

    });


    function renderProducts(products, page = 1, general = {}) {
        const productList = document.getElementById('product-list');
        productList.innerHTML = '';

        const start = (page - 1) * itemsPerPage;
        const end = start + itemsPerPage;

        const paginatedItems = products.slice(start, end);

        if (paginatedItems.length === 0) {
            productList.innerHTML = '<p class="text-center w-100">Không tìm thấy sản phẩm nào.</p>';
            return;
        }

        const { enable_taxes, tax_display_option, currency } = settings;



        const taxRate = enable_taxes ? getApplicableTaxRate() : 0;
        applicationTaxRate = taxRate;
        paginatedItems.forEach(product => {
            if (product.status == 0) return;
            let finalPrice = Number(product.price);


            if (enable_taxes && tax_display_option === 'including_tax') {
                const taxAmount = (finalPrice * taxRate) / 100;
                finalPrice += taxAmount;
            }

            const productHTML = `
                <div class="col-sm-6 col-lg-4 all ${product.category_slug}">
                    <div class="box product-box" data-product-id="${product.id}">
                        <div>
                            <div class="img-box">
                                <img src="${product.image_url}" alt="${product.name}">
                            </div>
                            <div class="detail-box">
                                <h5>${product.name}</h5>
                                <p class="description"
                                    style="height: 80px; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical;">
                                    ${product.description}
                                </p>
                                <div class="options">
                                    <h6>${Number(finalPrice).toLocaleString('vi-VN')}₫</h6>
                                    <a href="javascript:void(0)" onclick="addToCart(event,'${product.id}')">
                                        🛒
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            productList.innerHTML += productHTML;
        });
        document.querySelectorAll('.product-box').forEach(box => {
            box.addEventListener('click', function (e) {
                if (e.target.tagName === 'A' || e.target.closest('a')) {
                    return;
                }

                const productId = this.getAttribute('data-product-id');
                openCustomModal(productId, products);
            });
        });
        renderPagination(products.length, page);
    }

    function openCustomModal(productId, products) {
        const product = products.find(p => p.id === productId);

        if (!product) return;

        // Set modal content
        document.getElementById('modal-product-name').textContent = product.name;
        document.getElementById('modal-product-image').src = product.image_url;
        document.getElementById('modal-product-image').alt = product.name;

        // Set thumbnails (using the same image for demo, in real app you'd use different images)
        document.getElementById('thumbnail-1').src = product.image_url;
        document.getElementById('thumbnail-2').src = product.image_url;
        document.getElementById('thumbnail-3').src = product.image_url;

        // Calculate price with tax if needed
        let finalPrice = Number(product.price);
        if (settings.enable_taxes && settings.tax_display_option === 'including_tax') {
            const taxAmount = (finalPrice * applicationTaxRate) / 100;
            finalPrice += taxAmount;
        }

        document.getElementById('modal-product-price').textContent = `${Number(finalPrice).toLocaleString('vi-VN')}₫`;
        document.getElementById('modal-product-description').textContent = product.description;
        document.getElementById('modal-product-category').textContent = product.category_name || 'General';
        document.getElementById('modal-product-id').textContent = product.id;

        // Reset quantity
        document.getElementById('product-quantity').value = 1;

        // Set up add to cart button
        const addToCartBtn = document.getElementById('modal-add-to-cart');

        addToCartBtn.onclick = function () {
            const quantity = parseInt(document.getElementById('product-quantity').value);
            addToCartWithQuantity(product.id, quantity);
            // Close the modal
            closeCustomModal();
        };

        // Initialize image zoom
        initImageZoom();

        // Reset tabs to first tab
        document.querySelectorAll('.custom-tab-btn').forEach((btn, index) => {
            btn.classList.toggle('active', index === 0);
        });

        document.querySelectorAll('.custom-tab-pane').forEach((pane, index) => {
            pane.classList.toggle('active', index === 0);
        });

        // Show the modal
        document.getElementById('customProductModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    function closeCustomModal() {
        document.getElementById('customProductModal').classList.remove('active');
        document.body.style.overflow = '';
    }
    // Improved image zoom functionality
    function initImageZoom() {
        const container = document.querySelector('.image-zoom-container');
        const img = document.getElementById('modal-product-image');
        const lens = document.querySelector('.image-zoom-lens');
        const result = document.querySelector('.image-zoom-result');

        // Wait for the image to load to get correct dimensions
        img.onload = function () {
            // Set the background image of the result div
            result.style.backgroundImage = `url('${img.src}')`;

            // Get dimensions
            const imgRect = img.getBoundingClientRect();
            const containerRect = container.getBoundingClientRect();

            // Function to update zoom on mouse move
            const moveLens = (e) => {
                e.preventDefault();

                // Get cursor position relative to the page
                let mouseX = e.clientX;
                let mouseY = e.clientY;

                // Handle touch events
                if (e.touches) {
                    mouseX = e.touches[0].clientX;
                    mouseY = e.touches[0].clientY;
                }

                // Get the position of the image
                const imgRect = img.getBoundingClientRect();

                // Calculate cursor position relative to the image
                let x = mouseX - imgRect.left;
                let y = mouseY - imgRect.top;

                // Ensure x and y are within image boundaries
                x = Math.max(0, Math.min(x, imgRect.width));
                y = Math.max(0, Math.min(y, imgRect.height));

                // Calculate lens position (centered on cursor)
                const lensWidth = lens.offsetWidth;
                const lensHeight = lens.offsetHeight;

                let lensX = x - lensWidth / 2;
                let lensY = y - lensHeight / 2;

                // Constrain lens to image boundaries
                lensX = Math.max(0, Math.min(lensX, imgRect.width - lensWidth));
                lensY = Math.max(0, Math.min(lensY, imgRect.height - lensHeight));

                // Position the lens
                lens.style.left = `${lensX}px`;
                lens.style.top = `${lensY}px`;
                lens.style.display = 'block';

                // Calculate the ratio between result and lens
                const ratioX = result.offsetWidth / lensWidth;
                const ratioY = result.offsetHeight / lensHeight;

                // Calculate the background position for the result
                const resultX = lensX * ratioX;
                const resultY = lensY * ratioY;

                // Update the background position of the result
                result.style.backgroundSize = `${imgRect.width * ratioX}px ${imgRect.height * ratioY}px`;
                result.style.backgroundPosition = `-${resultX}px -${resultY}px`;
                result.style.display = 'block';
            };

            // Event listeners for mouse/touch movement
            container.addEventListener('mousemove', moveLens);
            container.addEventListener('touchmove', moveLens);

            // Show lens and result when mouse enters the container
            container.addEventListener('mouseenter', function () {
                lens.style.opacity = '1';
                result.style.opacity = '1';
            });

            // Hide lens and result when mouse leaves the container
            container.addEventListener('mouseleave', function () {
                lens.style.opacity = '0';
                result.style.opacity = '0';
            });
        };


        if (img.complete) {
            img.onload();
        }
    }


    function applyFilters(event) {
        event.preventDefault();
        const keyword = document.getElementById("search-input").value.trim().toLowerCase();
        const selectedCategories = Array.from(document.querySelectorAll(".category-checkbox:checked")).map(cb => cb.value);
        const minPrice = parseInt(document.querySelector(".min-input").value) || 0;
        const maxPrice = parseInt(document.querySelector(".max-input").value) || 1000000;

        filteredProducts = allProducts.filter(p => {
            const matchName = p.name.toLowerCase().includes(keyword);
            const matchCategory = selectedCategories.length === 0 || selectedCategories.includes(p.category_id);
            const matchPrice = p.price >= minPrice && p.price <= maxPrice;
            return matchName && matchCategory && matchPrice;
        });

        currentPage = 1;
        renderProducts(filteredProducts, currentPage);
    }








    function renderPagination(totalItems, currentPage) {
        const totalPages = Math.ceil(totalItems / itemsPerPage);
        const paginationContainer = document.querySelector(".pagination");

        if (!paginationContainer) return;

        paginationContainer.innerHTML = '';

        // Previous button
        paginationContainer.innerHTML += `
        <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
            <a class="page-link" href="javascript:void(0)" onclick="changePage(${currentPage - 1})">&laquo;</a>
        </li>
    `;

        // Page numbers
        for (let i = 1; i <= totalPages; i++) {
            paginationContainer.innerHTML += `
            <li class="page-item ${i === currentPage ? 'active' : ''}">
                <a class="page-link" href="javascript:void(0)" onclick="changePage(${i})">${i}</a>
            </li>
        `;
        }

        // Next button
        paginationContainer.innerHTML += `
        <li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
            <a class="page-link" href="javascript:void(0)" onclick="changePage(${currentPage + 1})">&raquo;</a>
        </li>
    `;
    }


    function changePage(page) {
        currentPage = page;
        renderProducts(filteredProducts, currentPage);
    }

}
