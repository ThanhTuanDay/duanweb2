


$(document).ready(function () {
    $('#toggle-sidebar').on('click', function () {
        $('#sidebar').toggleClass('active');
        $('#main-content').toggleClass('active');
    })

   
        let currentPage = 1; 
        let perPage = 10; 
        let totalItems = 100; 
        let totalPages = Math.ceil(totalItems / perPage);

        // Function to render categories (replace this with your category item rendering)
        function renderCategories(categories) {
            let categoriesList=categories.map(category => {
                return `
                <div class="col-lg-4 col-md-6 mb-4">
                <div class="category-card">
                    <div class="category-card-img">
                        <img src="/placeholder.svg?height=150&width=300" alt="${category.name}">
                    </div>
                    <div class="category-card-body">
                        <h5 class="category-card-title">${category.name}</h5>
                        <p class="category-card-text">${category.product_count} products</p>
                        <div class="category-card-footer">
                            <span class="badge bg-success">${category.status}</span>
                        </div>
                    </div>
                </div>
                </div>
                `;
            });
            $('.container-category').append(categoriesList);

        }

        function updatePagination() {
            $('#pagination-start').text((currentPage - 1) * perPage + 1);
            $('#pagination-end').text(Math.min(currentPage * perPage, totalItems));
            $('#pagination-total').text(totalItems);

            $('#pagination-links').empty(); // Clear the pagination links

            $('#pagination-links').append(`
            <li class="page-item ${currentPage <= 1 ? 'disabled' : ''}" id="prev-page">
                <a class="page-link" href="javascript:void(0);">Previous</a>
            </li>
        `);

            // Add the page numbers
            for (let i = 1; i <= totalPages; i++) {
                $('#pagination-links').append(`
                <li class="page-item ${i === currentPage ? 'active' : ''}">
                    <a class="page-link" href="javascript:void(0);" data-page="${i}">${i}</a>
                </li>
            `);
            }

            // Add the "Next" button
            $('#pagination-links').append(`
            <li class="page-item ${currentPage >= totalPages ? 'disabled' : ''}" id="next-page">
                <a class="page-link" href="javascript:void(0);">Next</a>
            </li>
        `);
        }

        function fetchCategories(page) {
            $.ajax({
                url: '/duanweb2/app/api/category.api.php',
                type: 'GET',
                data: {
                    action: 'getPaginatedCategories',
                    page: page,
                    perPage: perPage
                },
                success: function (response) {
                    renderCategories(response.data);  
                    totalItems = response.totalItems; 
                    totalPages = Math.ceil(totalItems / perPage); 
                    updatePagination();
                }
            });
        }

        $(document).on('click', '.page-link', function () {
            const page = $(this).data('page');
            if (page && page !== currentPage) {
                currentPage = page;
                fetchCategories(currentPage);  
            }
        });

        // Click event for previous page
        $(document).on('click', '#prev-page', function () {
            if (currentPage > 1) {
                currentPage--;
                fetchCategories(currentPage); 
            }
        });

        // Click event for next page
        $(document).on('click', '#next-page', function () {
            if (currentPage < totalPages) {
                currentPage++;
                fetchCategories(currentPage);  
            }
        });

        $('#pagination-size').on('change', function () {
            perPage = parseInt($(this).val());
            currentPage = 1; 
            fetchCategories(currentPage);  
        });

        fetchCategories(currentPage);
    });


