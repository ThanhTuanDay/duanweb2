let products = [];
let itemsPerPage = 10;
let currentPage = 1;
let categories = [];
document.getElementById('applyProductFilters').addEventListener('click', () => {
    const searchText = document.getElementById('productIdOrName').value.toLowerCase();
    const category = document.getElementById('productCategoryFilter').value;
    const priceMin = parseFloat(document.getElementById('priceMin').value) || 0;
    const priceMax = parseFloat(document.getElementById('priceMax').value) || Infinity;
    const stockMin = parseInt(document.getElementById('stockMin').value) || 0;
    const stockMax = parseInt(document.getElementById('stockMax').value) || Infinity;
    const statusActive = document.getElementById('statusActive').checked;
    const statusInactive = document.getElementById('statusInactive').checked;
    const statusOutOfStock = document.getElementById('statusOutOfStock').checked;

    const filtered = products.filter(product => {
        const nameMatch = product.name.toLowerCase().includes(searchText) || product.id.toString().includes(searchText);
        const categoryMatch = category === '' || product.category_id == category;
        const priceMatch = product.price >= priceMin && product.price <= priceMax;
        const stockMatch = product.stock >= stockMin && product.stock <= stockMax;

        let statusMatch = false;
        if (product.stock === 0 && statusOutOfStock) statusMatch = true;
        else if (product.status == 1 && product.stock > 0 && statusActive) statusMatch = true;
        else if (product.status == 0 && product.stock > 0 && statusInactive) statusMatch = true;

        return nameMatch && categoryMatch && priceMatch && stockMatch && statusMatch;
    });

    renderProducts(filtered);
    renderPagination(filtered.length, 1, itemsPerPage);
    const modal = bootstrap.Modal.getInstance(document.getElementById('filterProductsModal'));
    if (modal) modal.hide();
});

document.getElementById('resetProductFilters').addEventListener('click', () => {
    document.querySelector('#filterProductsModal form').reset();
    renderProducts(products, currentPage);
    renderPagination(products.length, currentPage, itemsPerPage);
});
document.getElementById('filterDropdown').addEventListener('click', function () {
    const modal = new bootstrap.Modal(document.getElementById('filterProductsModal'));
    const categorySelect = document.getElementById('productCategoryFilter');
    categorySelect.innerHTML = `<option value="">All Categories</option>`;

    categories.forEach(category => {
        const option = document.createElement('option');
        option.value = category.id;
        option.textContent = category.name;
        categorySelect.appendChild(option);
    });

    modal.show();
});
async function loadProducts() {
    const res = await fetch('/duanweb2/app/api/product.api.php?action=getProducts');
    const data = await res.json();
    if (data.success) {
        products = data.products;
        categories = data.categories;
        renderProducts(products, currentPage);
        renderPagination(products.length, currentPage, itemsPerPage);
    }
}
function renderProducts(products, page = 1) {
    const tbody = document.querySelector("tbody");
    tbody.innerHTML = "";

    const start = (page - 1) * itemsPerPage;
    const end = start + itemsPerPage;
    const paginated = products.slice(start, end);

    paginated.forEach(product => {

        const rawPrice = parseFloat(product.price);
        const formattedPrice = rawPrice.toLocaleString('de-DE', {
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        });
        const actionButton = (product.status === "0" || product.status === 0)
            ? `<button class="btn btn-success btn-open-product" data-id="${product.id}" data-name="${product.name}">
           <i class="fas fa-undo"></i>
       </button>`
            : `<button class="btn btn-danger btn-delete-product" data-id="${product.id}" data-name="${product.name}">
           <i class="fa fa-trash"></i>
       </button>`;
        const row = document.createElement("tr");
        row.innerHTML = `
            <td>#${product.id}</td>
            <td><div class="product-img"><img src="${product.image_url || '/placeholder.svg'}" alt="${product.name}"></div></td>
            <td>${product.name}</td>
            <td>${product.category_name}</td>
            <td>${formattedPrice} VNĐ</td>
            <td>${product.stock}</td>
            <td>
                ${product.stock == 0 ? '<span class="badge bg-danger">Out of Stock</span>' :
                product.status == 0 ? '<span class="badge bg-danger">Inactive</span>' :
                    product.stock < 10 ? '<span class="badge bg-warning">Low Stock</span>' :
                        '<span class="badge bg-success">Active</span>'}
            </td>
            <td>
                <div class="action-btns">
                    <button class="btn btn-sm btn-primary btn-edit" data-id="${product.id}" data-name="${product.name}" data-category="${product.category_id}" data-price="${product.price}" data-stock="${product.stock}" data-description="${product.description}" data-status="${product.status}" data-image="${product.image_url}" data-bs-toggle="modal" data-bs-target="#editProductModal"><i class="fas fa-edit"></i></button>
                    ${actionButton}
                    <button class="btn btn-primary btn-view-product" data-id="${product.id}" data-name="${product.name}" data-category="${product.category_name}" data-price="$${parseFloat(product.price).toFixed(2)}" data-description="${product.description || 'No description'}"><i class="fa fa-eye"></i></button>
                </div>
            </td>`;
        tbody.appendChild(row);
    });
    attachViewProductEvents();
    attachEditProductEvents();
    attachDeleteProductEvents();
    attachOpenProductEvents();
}
function renderPagination(total, currentPage, perPage) {
    const pagination = document.querySelector(".pagination");
    const paginationInfo = document.querySelector(".pagination-info");

    const totalPages = Math.ceil(total / perPage);
    const start = (currentPage - 1) * perPage + 1;
    const end = Math.min(currentPage * perPage, total);

    paginationInfo.innerHTML = `Showing <span>${start}</span> to <span>${end}</span> of <span>${total}</span> products`;

    let html = '';
    html += `<li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
        <a class="page-link" href="#" onclick="goToPage(${currentPage - 1})">Previous</a></li>`;

    for (let i = 1; i <= totalPages; i++) {
        html += `<li class="page-item ${i === currentPage ? 'active' : ''}">
            <a class="page-link" href="#" onclick="goToPage(${i})">${i}</a></li>`;
    }

    html += `<li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
        <a class="page-link" href="#" onclick="goToPage(${currentPage + 1})">Next</a></li>`;

    pagination.innerHTML = html;



}


function goToPage(page) {
    currentPage = page;
    renderProducts(products, currentPage);
    renderPagination(products.length, currentPage, itemsPerPage);
}


document.getElementById("pagination-size").addEventListener("change", function () {
    itemsPerPage = parseInt(this.value);
    currentPage = 1;
    renderProducts(products, currentPage);
    renderPagination(products.length, currentPage, itemsPerPage);
});
function attachViewProductEvents() {
    const productDetailModal = new bootstrap.Modal(document.getElementById('productDetailModal'));
    document.querySelectorAll('.btn-primary').forEach(button => {
        if (button.querySelector('.fa-eye')) {
            button.addEventListener('click', function (e) {
                e.preventDefault();


                const row = this.closest('tr');
                let productId = row.cells[0].textContent;
                const productName = row.cells[2].textContent;
                const productCategory = row.cells[3].textContent;
                const rawPrice = parseFloat(row.cells[4].textContent);
                const formattedPrice = rawPrice.toLocaleString('de-DE', {
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0
                });
                const productPrice = formattedPrice;
                const productStock = row.cells[5].textContent;
                const productStatus = row.cells[6].textContent;
                const productStatusClass = row.cells[6].querySelector('.badge').classList[1];
                const productImage = row.querySelector('.product-img img').src;
                const description = this.dataset.description || "No description.";
                document.getElementById('modal-product-name').textContent = productName;
                document.getElementById('modal-product-id').textContent = `#${productId}`;
                document.getElementById('modal-product-category').textContent = productCategory;
                document.getElementById('modal-product-price').textContent = productPrice;
                document.getElementById('modal-product-image').src = productImage;
                document.getElementById('modal-product-description').textContent = description;
                const statusBadge = document.getElementById('modal-product-status');
                statusBadge.textContent = productStatus;
                statusBadge.className = 'badge ' + productStatusClass;
                productId = productId.replace('#', '');

                // const totalSales = Math.floor(Math.random() * 2000) + 500;
                // const priceValue = parseFloat(productPrice.replace('$', ''));
                // const revenue = totalSales * priceValue;
                // const profitMargin = Math.floor(Math.random() * 20) + 30;
                // const profit = revenue * (profitMargin / 100);

                // document.getElementById('modal-product-total-sales').textContent = `${totalSales.toLocaleString()} units`;
                // document.getElementById('modal-product-revenue').textContent = `$${revenue.toLocaleString(undefined, { maximumFractionDigits: 2 })}`;
                // document.getElementById('modal-product-profit').textContent = `$${profit.toLocaleString(undefined, { maximumFractionDigits: 2 })}`;
                // document.getElementById('modal-product-margin').textContent = `${profitMargin}%`;

                if (productId) {
                    loadProductStats(productId);
                    createProductSalesChart(productId);
                }

                // document.getElementById('modal-product-sku').textContent = `SKU-${productId}${Math.floor(Math.random() * 1000)}`;
                document.getElementById('modal-product-inventory').textContent = `${productStock} đơn vị`;


                productDetailModal.show();
            });
        }
    });

}

async function loadProductStats(productId) {
    try {
        const response = await fetch(`/duanweb2/app/api/order.api.php?action=getStats&id=${productId}`);
        const result = await response.json();

        if (result.success && result.data) {
            const stats = result.data;
            document.getElementById('modal-product-total-sales').textContent = `${Number(stats.total_sales).toLocaleString()} đơn vị`;
            document.getElementById('modal-product-revenue').textContent = `$${Number(stats.revenue).toLocaleString(undefined, { maximumFractionDigits: 2 })}`;
            document.getElementById('modal-product-profit').textContent = `$${Number(stats.profit).toLocaleString(undefined, { maximumFractionDigits: 2 })}`;
            document.getElementById('modal-product-margin').textContent = `${stats.profit_margin}%`;
        }
    } catch (err) {
        console.error("Failed to load product stats", err);
    }
}
function attachEditProductEvents() {
    const editButtons = document.querySelectorAll('.btn-edit');

    editButtons.forEach(btn => {
        btn.addEventListener('click', function () {

            const rawPrice = parseFloat(this.dataset.price);
            const formattedPrice = rawPrice.toLocaleString('de-DE', {
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            });
            document.getElementById('editProductId').value = this.dataset.id;
            document.getElementById('editProductName').value = this.dataset.name;
            document.getElementById('editProductCategory').value = this.dataset.category;
            document.getElementById('editProductPrice').value = formattedPrice;
            document.getElementById('editProductStock').value = this.dataset.stock;
            document.getElementById('editProductDescription').value = this.dataset.description;
            document.getElementById('editProductStatus').value = this.dataset.status;
            // document.getElementById('editProductFeatured').value = this.dataset.featured ?? 'no';
            document.getElementById('oldProductImage').value = this.dataset.image;
            document.getElementById('editProductImage').src = this.dataset.image;
                
            const currentImg = document.getElementById('current-product-image');
            if (currentImg && this.dataset.image) {
                currentImg.src = this.dataset.image;
            }
        });
    });
}

function attachDeleteProductEvents() {
    document.querySelectorAll('.btn-delete-product').forEach(button => {
        button.addEventListener('click', async function () {
            const id = this.dataset.id;
            const name = this.dataset.name;
            console.log(id);
            const confirmed = confirm(`Bạn có chắc chắn muốn xóa sản phẩm "${name}" với id ${id} không?`);
            if (!confirmed) return;

            try {
                const res = await fetch('http://localhost/duanweb2/delete-product', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: new URLSearchParams({
                        id: id,
                        _method: 'DELETE'
                    })
                });

                const responseText = await res.text();

                if (res.ok) {
                    if (responseText.trim() === 'sold') {
                        const blockConfirmed = confirm("Sản phẩm đã được bán. Bạn có muốn xóa không? (Sản phẩm sẽ bị block)");
                        if (blockConfirmed) {
                            await blockProduct(id);
                        }
                    } else if (responseText.trim() === 'deleted') {
                        alert('Đã xóa sản phẩm.');
                        location.reload();
                    } else {
                        alert('Phản hồi không xác định từ server: ' + responseText);
                    }
                } else {
                    alert('Lỗi: ' + responseText);
                }

            } catch (error) {
                console.error('Lỗi khi gửi yêu cầu xóa:', error);
                alert('Xóa thất bại do lỗi kết nối');
            }
        });
    });
}

function attachOpenProductEvents() {
    const openButtons = document.querySelectorAll('.btn-open-product');

    openButtons.forEach(button => {
        button.addEventListener('click', function () {
            const id = this.dataset.id;
            const name = this.dataset.name;

            if (!confirm(`Bạn có chắc chắn muốn mở lại sản phẩm "${name}"?`)) return;

            fetch("/duanweb2/app/api/product.api.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `action=openProduct&id=${id}`
            })
                .then(res => res.text())
                .then(result => {
                    if (result === "opened") {
                        alert("Sản phẩm đã được mở lại!");
                        loadProducts();
                    } else {
                        alert("Sản phẩm đã được mở lại!");
                        location.reload();
                    }
                })
                .catch(err => {
                    console.error("Lỗi:", err);
                    alert("Đã xảy ra lỗi.");
                });
        });
    });
}

document.addEventListener("DOMContentLoaded", loadProducts);




document.getElementById('toggle-sidebar').addEventListener('click', function () {
    document.getElementById('sidebar').classList.toggle('active');
    document.getElementById('main-content').classList.toggle('active');
});


// let currentPage = 1;
// let perPage = 10;

// document.addEventListener('DOMContentLoaded', () => {
//     loadProducts();

//     document.getElementById('pagination-size').addEventListener('change', (e) => {
//         perPage = parseInt(e.target.value);
//         currentPage = 1;
//         loadProducts();
//     });
// });

// function loadProducts() {
//     fetch(`product-api.php?page=${currentPage}&per_page=${perPage}`)
//         .then(res => res.json())
//         .then(data => {
//             renderProducts(data.products);
//             renderPagination(data.total, data.page, data.per_page);
//         });
// }


async function blockProduct(id) {
    try {
        const res = await fetch('http://localhost/duanweb2/block-product', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                id: id,
                _method: 'BLOCk'
            })
        });

        const result = await res.text();

        if (res.ok) {
            alert('Sản phẩm đã được block thành công!');
            location.reload();
        } else {
            alert('Không thể block sản phẩm: ' + result);
        }
    } catch (error) {
        console.error('Lỗi khi block sản phẩm:', error);
        alert('Có lỗi xảy ra khi gửi yêu cầu block sản phẩm.');
    }
}


document.getElementById('productImage').addEventListener('change', function (event) {
    const file = event.target.files[0];
    const preview = document.getElementById('previewImage');

    if (file) {
        const reader = new FileReader();

        reader.onload = function (e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        };

        reader.readAsDataURL(file);
    } else {
        preview.src = '';
        preview.style.display = 'none';
    }
});

document.getElementById('editProductImage').addEventListener('change', function (event) {
    const file = event.target.files[0];
    const preview = document.getElementById('current-product-image');

    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            preview.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
});

async function createProductSalesChart(productId) {
    const ctx = document.getElementById('productSalesChart').getContext('2d');

    if (window.productChart) {
        window.productChart.destroy();
    }

    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
        'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

    try {
        const response = await fetch(`/duanweb2/app/api/product.api.php?action=getMonthlySales&id=${productId}`);
        const result = await response.json();

        const salesMap = {};
        result.data.forEach(item => {
            salesMap[item.month] = parseInt(item.total);
        });


        const chartData = months.map(month => salesMap[month] ?? 0);

        window.productChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: months,
                datasets: [{
                    label: 'Units Sold',
                    data: chartData,
                    backgroundColor: 'rgba(255, 193, 7, 0.2)',
                    borderColor: '#ffc107',
                    borderWidth: 2,
                    tension: 0.3,
                    pointBackgroundColor: '#ffc107',
                    pointBorderColor: '#000',
                    pointBorderWidth: 2,
                    pointRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(255, 255, 255, 0.1)' },
                        ticks: { color: '#fff' }
                    },
                    x: {
                        grid: { color: 'rgba(255, 255, 255, 0.1)' },
                        ticks: { color: '#fff' }
                    }
                },
                plugins: {
                    legend: { display: false }
                }
            }
        });
    } catch (error) {
        console.error("Error loading chart data:", error);
    }
}

document.getElementById('productPrice').addEventListener('input', function (e) {
    const raw = e.target.value;
    const digitsOnly = raw.replace(/\./g, '').replace(/\D/g, '');

    if (digitsOnly) {
        const formatted = new Intl.NumberFormat('de-DE').format(digitsOnly);
        e.target.value = formatted;
    } else {
        e.target.value = '';
    }
});

document.getElementById('editProductPrice').addEventListener('input', function (e) {
    const raw = e.target.value;
    const digitsOnly = raw.replace(/\./g, '').replace(/\D/g, '');

    if (digitsOnly) {
        const formatted = new Intl.NumberFormat('de-DE').format(digitsOnly);
        e.target.value = formatted;
    } else {
        e.target.value = '';
    }
});z