document.addEventListener('DOMContentLoaded', function () {
    const editButtons = document.querySelectorAll('.btn-edit');

    editButtons.forEach(btn => {
        btn.addEventListener('click', function () {
            document.getElementById('editProductId').value = this.dataset.id;
            document.getElementById('editProductName').value = this.dataset.name;
            document.getElementById('editProductCategory').value = this.dataset.category;
            document.getElementById('editProductPrice').value = this.dataset.price;
            document.getElementById('editProductStock').value = this.dataset.stock;
            document.getElementById('editProductDescription').value = this.dataset.description;
            document.getElementById('editProductStatus').value = this.dataset.status;
            document.getElementById('editProductFeatured').value = this.dataset.featured;
            document.getElementById('oldProductImage').value = this.dataset.image;
            const currentImg = document.getElementById('current-product-image');
            if (currentImg && this.dataset.image) {
                currentImg.src = this.dataset.image;
            }

            document.getElementById('editProductId').value = this.dataset.id;
        });
    });

    document.querySelectorAll('.btn-delete-product').forEach(button => {
        button.addEventListener('click', async function () {
            const id = this.dataset.id;
            const name = this.dataset.name;

            const confirmed = confirm(`Bạn có chắc chắn muốn xóa sản phẩm "${name}" không?`);
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

});

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
                id: id ,
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
// function renderProducts(products) {
//     const tbody = document.getElementById('product-table-body');
//     tbody.innerHTML = "";

//     products.forEach(p => {
//         const status = p.stock === 0 ? "Out of Stock" :
//             p.stock < 10 ? "Low Stock" : "Active";

//         const badge = p.stock === 0 ? "danger" :
//             p.stock < 10 ? "warning" : "success";

//         tbody.innerHTML += `
//             <tr>
//                 <td>#${p.id}</td>
//                 <td><div class="product-img"><img src="${p.image_url || '/placeholder.svg'}" alt="${p.name}"></div></td>
//                 <td>${p.name}</td>
//                 <td>${p.category_name}</td>
//                 <td>$${parseFloat(p.price).toFixed(2)}</td>
//                 <td>${p.stock}</td>
//                 <td><span class="badge bg-${badge}">${status}</span></td>
//                 <td>
//                     <div class="action-btns">
//                         <button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
//                         <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
//                         <button class="btn btn-sm btn-info"><i class="fas fa-eye"></i></button>
//                     </div>
//                 </td>
//             </tr>
//         `;
//     });
// }

// function renderPagination(total, page, perPage) {
//     const totalPages = Math.ceil(total / perPage);
//     const pagination = document.getElementById('pagination-links');
//     const info = document.getElementById('pagination-info');

//     pagination.innerHTML = '';
//     info.innerHTML = `Showing ${(page - 1) * perPage + 1} to ${Math.min(page * perPage, total)} of ${total} products`;

//     // Previous
//     pagination.innerHTML += `
//         <li class="page-item ${page <= 1 ? 'disabled' : ''}">
//             <a class="page-link" href="#" onclick="changePage(${page - 1})">Previous</a>
//         </li>
//     `;

//     for (let i = 1; i <= totalPages; i++) {
//         pagination.innerHTML += `
//             <li class="page-item ${i === page ? 'active' : ''}">
//                 <a class="page-link" href="#" onclick="changePage(${i})">${i}</a>
//             </li>
//         `;
//     }

//     pagination.innerHTML += `
//         <li class="page-item ${page >= totalPages ? 'disabled' : ''}">
//             <a class="page-link" href="#" onclick="changePage(${page + 1})">Next</a>
//         </li>
//     `;
// }

// function changePage(page) {
//     event.preventDefault();
//     currentPage = page;
//     loadProducts();
// }




const productDetailModal = new bootstrap.Modal(document.getElementById('productDetailModal'));
document.querySelectorAll('.btn-primary').forEach(button => {
    if (button.querySelector('.fa-eye')) {
        button.addEventListener('click', function (e) {
            e.preventDefault();


            const row = this.closest('tr');
            const productId = row.cells[0].textContent;
            const productName = row.cells[2].textContent;
            const productCategory = row.cells[3].textContent;
            const productPrice = row.cells[4].textContent;
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


            const totalSales = Math.floor(Math.random() * 2000) + 500;
            const priceValue = parseFloat(productPrice.replace('$', ''));
            const revenue = totalSales * priceValue;
            const profitMargin = Math.floor(Math.random() * 20) + 30;
            const profit = revenue * (profitMargin / 100);

            document.getElementById('modal-product-total-sales').textContent = `${totalSales.toLocaleString()} units`;
            document.getElementById('modal-product-revenue').textContent = `$${revenue.toLocaleString(undefined, { maximumFractionDigits: 2 })}`;
            document.getElementById('modal-product-profit').textContent = `$${profit.toLocaleString(undefined, { maximumFractionDigits: 2 })}`;
            document.getElementById('modal-product-margin').textContent = `${profitMargin}%`;


            // document.getElementById('modal-product-sku').textContent = `SKU-${productId}${Math.floor(Math.random() * 1000)}`;
            document.getElementById('modal-product-inventory').textContent = `${productStock} units`;


            createProductSalesChart();

            productDetailModal.show();
        });
    }
});

function createProductSalesChart() {
    const ctx = document.getElementById('productSalesChart').getContext('2d');


    if (window.productChart) {
        window.productChart.destroy();
    }
    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'];
    const salesData = Array.from({ length: 6 }, () => Math.floor(Math.random() * 300) + 50);

    window.productChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: months,
            datasets: [{
                label: 'Units Sold',
                data: salesData,
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
                    grid: {
                        color: 'rgba(255, 255, 255, 0.1)'
                    },
                    ticks: {
                        color: '#fff'
                    }
                },
                x: {
                    grid: {
                        color: 'rgba(255, 255, 255, 0.1)'
                    },
                    ticks: {
                        color: '#fff'
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
}