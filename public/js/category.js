


$(document).ready(function () {
    $('#toggle-sidebar').on('click', function () {
        $('#sidebar').toggleClass('active');
        $('#main-content').toggleClass('active');
    })
    function showCartNotification(message, type = 'success') {
        const container = $('#notifications-container'); 

        if (!container.length) {
            console.error('Notification container not found!');
            return;
        }

        const notification = $('<div>', { class: `notification ${type}` });

        const content = $('<div>', { class: 'notification-content' });

        const icon = $('<i>', { class: type === 'success' ? 'fa fa-check-circle' : 'fa fa-exclamation-circle' });

        content.append(icon, $('<span>', { text: message }));

        notification.append(content);

        container.append(notification);

        notification[0].offsetHeight;

        notification.addClass('show');

        setTimeout(() => {
            notification.removeClass('show');
            setTimeout(() => notification.remove(), 300); 
        }, 3000);
    }

    let currentPage = 1;
    let perPage = 6;
    let totalItems = 100;
    let totalPages = Math.ceil(totalItems / perPage);
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
                    <button class="btn btn-danger delete_category"      data-name="${category.name}" data-id="${category.id}" data-bs-toggle="modal" data-bs-target="#deleteModal">
                        Delete 
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
                                 <input type="hidden" name="images_url" id="fileInput" value="${categoryItem.image}" />
                            </div>
                            <span>Current Image</span>
                        </div>
                        <input type="file" class="form-control custom-cursor-on-hover" value="${categoryItem.image}" id="editCategoryImage">
                    </div>
                    <div class="mb-3">
                        <label for="editCategoryStatus" class="form-label">Status</label>
                        <select class="form-select" name="status" id="editCategoryStatus">
                            <option value="1" ${categoryItem.status == 1 && 'selected'} >Active</option>
                            <option value="0" ${categoryItem.status == 0 && 'selected'}>Inactive</option>
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
    $(document).on('click', '.delete_category', function () {
        const id = $(this).data('id');
        const name = $(this).data('name')
        $('#deleteModal .modal-body').html(`<p>Bạn có chắc là muốn xóa danh mục tên là ${name}</p>`)
        $('#saveDeleteCategory').attr('data-id', id);
        
    });
    // BTn-delete category
    $('#saveDeleteCategory').on('click', function () {
        const id = $(this).data('id');
        $.ajax({
            url: '/duanweb2/app/api/category.api.php',
            type: 'POST',
            data: {
                action: 'deleteCategory',
                categoryId: id 
            },
            success: function (response) {
                if (response[0].success) {

                    $('#deleteModal').modal('hide');
                    showCartNotification('Danh mục xóa thành công!', 'success');

                    fetchCategories(currentPage);
                    location.reload();
                } else {
                    showCartNotification('Danh mục xóa thất bại ', 'error');
                    $('#deleteModal').modal('hide');

                }
            },
            error: function () {
                showCartNotification('Có lỗi trong việc xóa danh mục', 'error');
            } 
        })
        
  })

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
        formData.append('currentImage', $('#currentImage').attr('src'));
        formData.append('action', 'updateCategory');
        $.ajax({
            url: '/duanweb2/app/api/category.api.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response[0].success) {
                    showCartNotification('Danh mục cập nhật Thành công!', 'success');  
                    $('#editCategoryModal').modal('hide');
                    fetchCategories(currentPage);
                } else {
                    showCartNotification('Hiện tại sản phẩm này đang bán nên không thể update được danh mục', 'error');
                }
            },
            error: function () {
                showCartNotification('Xảy ra lỗi trong việc cập nhật.', 'error');
            }
        });
    });
    $(document).on('input', '#categoryDescription', function (e) {
        let description = $(this).val();
        $('#categoryDescriptionHidden').val(description);

    });
    $('#saveBtnCreateCategory').on('click', function () {
        let createData = {
            name: $('#addCategoryModal input[name="name"]').val(),
            description: $('#categoryDescriptionHidden').val(),
            images_files: $('#categoryImage').prop('files')[0],
            status: $('#addCategoryModal select[name="status"]').val()
        };
        let formData = new FormData();
        formData.append('name', createData.name);
        formData.append('description', createData.description);
        formData.append('status', createData.status);
        formData.append('image', createData.images_files);
        formData.append('action', 'createCategory');
        $.ajax({
            url: '/duanweb2/app/api/category.api.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log(response)
                if (response[0].success) {

                    $('#addCategoryModal').modal('hide');
                    showCartNotification('Danh mục thêm thành công!', 'success');

                    fetchCategories(currentPage);
                } else {
                    showCartNotification('Danh mục thêm thất bại ', 'error');
                    $('#addCategoryModal').modal('hide');

                }
            },
            error: function () {
                showCartNotification('Có lỗi trong việc thêm  danh mục', 'error');
            }
        })
    })
    //Pagination
    function updatePagination(currentPage, perPage, totalItems) {
        const totalPages = Math.ceil(totalItems / perPage);

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
                updatePagination(currentPage, perPage, totalItems);
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


