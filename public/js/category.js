


$(document).ready(function () {
    $('#toggle-sidebar').on('click', function () {
        $('#sidebar').toggleClass('active');
        $('#main-content').toggleClass('active');
    })
    let currentPage = 1;
    let perPage = 5;
    let totalItems = 100;
    let totalPages = Math.ceil(totalItems / perPage);
    // Render list Categories with params ;
    function renderCategories(categories) {
        if (categories.length > 0) {
            let categoriesList = categories.map(category => {
                $('.container-category').empty()
                return `
                <div class="col-lg-4 col-md-6 mb-4"  data-category-id="${category.id}">
                <div class="category-card">
                    <div class="category-card-img">
                        <img src=${category.images_url} alt="${category.name}">
                    </div>
                    <div class="category-card-body">
                        <h5 class="category-card-title">${category.name}</h5>
                        <p class="category-card-text">${category.description} products</p>
                        <div class="category-card-footer">
                            <span class="badge bg-success">${category.status === 1 && 'active'}</span>
                          <button class="btn btn-primary edit_category" id="" data-bs-toggle="modal" data-bs-target="#editCategoryModal"
                            data-id="${category.id}"
                            data-name="${category.name}"
                            data-description="${category.description}"
                            data-image="${category.images_url}"
                            data-status="${category.status}">
                        <i class="fas fa-plus me-2"></i> Edit Category
                    </button>
                        </div>
                    </div>
                </div>
                </div>
                `;
            });
            $('.container-category').append(categoriesList);
        }
        else {
            $('.container-category').append('')
        }

    }
    // render Modal detail Category
    const renderModalItem = (categoryItem) => {
        let description = categoryItem.description || '';
        return `  <form>
                    <input type="hidden" name="id" value=${categoryItem.id} />
                    <div class="mb-3">
                        <label for="editCategoryName" class="form-label">Category Name</label>
                        <input type="text" name="name" class="form-control" id="editCategoryName" value="${categoryItem.name}">
                    </div>
                    <div class="mb-3">
                        <label for="editCategoryDescription" class="form-label">Description</label>
                          <input type="hidden" name="description" id="editCategoryHiddenDescription" value="${description}" />
                            <textarea class="form-control editCategoryDescription" id="editCategoryDescription" rows="3">${description}</textarea>

                    </div>
                    <div class="mb-3">
                        <label for="editCategoryImage" class="form-label">Category Image</label>
                        <div class="d-flex align-items-center mb-2">
                            <div class="category-img me-3">
                                <img id="currentImage" src="${categoryItem.image}?height=60&width=60" alt="Current Image">
                                 <input type="hidden" name="images_url" id="fileInput" value=${categoryItem.image} />
                            </div>
                            <span>Current Image</span>
                        </div>
                        <input type="file" class="form-control custom-cursor-on-hover" id="editCategoryImage">
                    </div>
                    <div class="mb-3">
                        <label for="editCategoryStatus" class="form-label">Status</label>
                        <select class="form-select" name="status" id="editCategoryStatus">
                            <option value="active" ${categoryItem.status == 1 && 'selected'} >Active</option>
                            <option value="inactive" ${categoryItem.status == 0 && 'selected'}>Inactive</option>
                        </select>
                    </div>
                </form>`
    }
    //Event edit show modal 
    $(document).on('click', '.edit_category', function () {
        const categoryData = {
            id: $(this).data('id'),
            name: $(this).data('name'),
            description: $(this).data('description'),
            image: $(this).data('image'),
            status: $(this).data('status')
        };
        $('#editCategoryModal .modal-body').html(renderModalItem(categoryData))

    });
    $(document).on('change', '#editCategoryImage', function (event) {

        var fileDisplayArea = document.getElementById('currentImage');

        var file = event.target.files[0];

        var imageType = /image.*/;

        if (file.type.match(imageType)) {
            var reader = new FileReader();

            reader.onload = function (e) {
                fileDisplayArea.src = e.target.result;
            }

            reader.readAsDataURL(file);
        } else {
            fileDisplayArea.innerHTML = "File not supported!"
        }



    });
    console.log($('#editCategoryDescription'));

    $(document).on('input', '.editCategoryDescription', function (e) {
        let description = $(this).val();
        $('#editCategoryHiddenDescription').val(description);

    });


    $('#saveBtnEditCategory').on('click', function () {
        let updatedData = {
            id: $('#editCategoryModal input[name="id"]').val(),
            name: $('#editCategoryModal input[name="name"]').val(),
            description: $('#editCategoryHiddenDescription').val(),
            images_files: $('#editCategoryImage').prop('files')[0],
            status: $('#editCategoryModal select[name="status"]').val()
        };

        let formData = new FormData();
        formData.append('id', updatedData.id);
        formData.append('name', updatedData.name);
        formData.append('description', updatedData.description);
        formData.append('status', updatedData.status);
        formData.append('image', updatedData.images_files);
        formData.append('action', 'updateCategory');
        $.ajax({
            url: '/duanweb2/app/api/category.api.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response) {
                    $('#editCategoryModal').modal('hide');
                    fetchCategories(currentPage);
                } else {
                    alert(response.message);
                }
            },
            error: function () {
                alert('Error while updating category.');
            }
        });
    });

    //Pagination
    function updatePagination() {
        $('#pagination-start').text((currentPage - 1) * perPage + 1);
        $('#pagination-end').text(Math.min(currentPage * perPage, totalItems));
        $('#pagination-total').text(totalItems);

        $('#pagination-links').empty();

        $('#pagination-links').append(`
            <li class="page-item ${currentPage <= 1 ? 'disabled' : ''}" id="prev-page">
                <a class="page-link" href="javascript:void(0);">Previous</a>
            </li>
        `);

        for (let i = 1; i <= totalPages; i++) {
            $('#pagination-links').append(`
                <li class="page-item ${i === currentPage ? 'active' : ''}">
                    <a class="page-link" href="javascript:void(0);" data-page="${i}">${i}</a>
                </li>
            `);
        }

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

    $(document).on('click', '#prev-page', function () {
        if (currentPage > 1) {
            currentPage--;
            fetchCategories(currentPage);
        }
    });

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


