// to get current year
function getYear() {
    var currentDate = new Date();
    var currentYear = currentDate.getFullYear();
    document.querySelector("#displayYear").innerHTML = currentYear;
}

getYear();

// Validate phone number
function isValidPhone(phone) {
    const phoneRegex = /^[+]?[(]?[0-9]{1,4}[)]?[-\s.]?[0-9]{1,4}[-\s.]?[0-9]{1,9}$/;
    return phoneRegex.test(phone);
}
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
function myMap() {
    var mapProp = {
        center: new google.maps.LatLng(40.712775, -74.005973),
        zoom: 18,
    };
    var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
}

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
if(dataInput) {
    const jsonData = document.getElementById('product-data').value || null;
    allProducts = JSON.parse(jsonData || null);
}


if (allProducts) {
    const itemsPerPage = 6;
    let currentPage = 1;
    let filteredProducts = [...allProducts];
    // if food section is loaded with pagination, scroll to it
    window.addEventListener('DOMContentLoaded', () => {
        // const urlParams = new URLSearchParams(window.location.search);
        // const pathname = window.location.pathname;
        // if (urlParams.has('pagination') || pathname.includes('/menu')) {
        //     const section = document.getElementById('food-section');
        //     if (section) {
        //         section.scrollIntoView({ behavior: 'smooth' });
        //     }
        // }

    });

    document.addEventListener('DOMContentLoaded', function () {
        // Price Range Slider
        const rangeInput = document.querySelectorAll(".range-input input");
        const priceInput = document.querySelectorAll(".price-input input");
        const progress = document.querySelector(".price-progress");
        const priceGap = 50000;

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

        renderProducts(allProducts, currentPage);
    });

    function renderProducts(products, page = 1) {
        const productList = document.getElementById('product-list');
        productList.innerHTML = '';

        const start = (page - 1) * itemsPerPage;
        const end = start + itemsPerPage;
        const paginatedItems = products.slice(start, end);

        if (paginatedItems.length === 0) {
            productList.innerHTML = '<p class="text-center w-100">Không tìm thấy sản phẩm nào.</p>';
            return;
        }

        paginatedItems.forEach(product => {
            const productHTML = `
            <div class="col-sm-6 col-lg-4 all ${product.category_slug}">
                <div class="box">
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
                                <h6>${Number(product.price).toLocaleString('vi-VN')}₫</h6>
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

        renderPagination(products.length, page);
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
