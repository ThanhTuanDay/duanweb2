function blockUser(button) {
  const userId = $(button).data("user-id"); // Get the user ID from the button

  if (confirm(`Are you sure you want to block user with ID: ${userId}?`)) {
    $.ajax({
      url: "/duanweb2/app/api/users.api.php",
      type: "POST",
      data: {
        action: "blockUser",
        id: userId,
      },
      success: function (data) {
        console.log("Parsed response:", data);
        if (data.success) {
          alert(data.message); 
          location.reload(); 
        } else {
          alert(data.message); 
        }
      },
    });
  }
}

function unBlockUser(button) {
  const userId = $(button).data("user-id");

  if (confirm(`Are you sure you want to unblock user with ID: ${userId}?`)) {
    $.ajax({
      url: "/duanweb2/app/api/users.api.php",
      type: "POST",
      data: {
        action: "unblockUser",
        id: userId,
      },
      success: function (data) {
        console.log("Parsed response:", data); 
        if (data.success) {
          alert(data.message); 
          location.reload(); 
        } else {
          alert(data.message); 
        }
      },
    });
  }
}

document.addEventListener('DOMContentLoaded', function () {
  const editButtons = document.querySelectorAll('.btn-edit');

  editButtons.forEach(btn => {
      btn.addEventListener('click', function () {
          document.getElementById('editName').value = this.dataset.name;
          document.getElementById('editAddress').value = this.dataset.address;
          document.getElementById('editPhone').value = this.dataset.phone;
          document.getElementById('saveUserChanges').setAttribute('data-user-id', this.dataset.userId);
      });
  });

  document.getElementById('saveUserChanges').addEventListener('click', function () {
      const userId = this.getAttribute('data-user-id');
      const updatedUserData = {
          id: userId,
          name: document.getElementById('editName').value,
          address: document.getElementById('editAddress').value,
          phone: document.getElementById('editPhone').value
      };
      $.ajax({
          url: '/duanweb2/app/api/users.api.php',
          type: 'POST',
          data: {
              action: 'updateUser',
              ...updatedUserData
          },
          success: function (response) {
              console.log("Raw response from API:", response);
              try {
                  const data = typeof response === 'string' ? JSON.parse(response) : response;
                  if (data.success) {
                      alert(data.message); 
                      location.reload(); 
                  } else {
                      alert(data.message);
                  }
              } catch (error) {
                  console.error('Error parsing response:', error);
                  alert('An error occurred while processing the response.');
              }
          },
          error: function () {
              alert('An error occurred while updating the user.');
          }
      });
  });
});

document.addEventListener('DOMContentLoaded', function () {
  const searchInput = document.getElementById('searchUsers');
  const userTableBody = document.querySelector('table tbody');
  console.log('User table body:', userTableBody); // Debugging line

  let debounceTimeout;

  // Debounced search function
  searchInput.addEventListener('input', function () {
      clearTimeout(debounceTimeout); // Clear the previous timeout
      debounceTimeout = setTimeout(() => {
          const query = searchInput.value.trim();
          console.log('Search query:', query); // Debugging line

          // Make an AJAX request to fetch filtered users
          $.ajax({
              url: '/duanweb2/app/api/users.api.php',
              type: 'GET',
              data: {
                  action: 'search',
                  query: query
              },
              success: function (data) {
                  // Clear the table body
                  userTableBody.innerHTML = '';

                  // Populate the table with the filtered users
                  if (data.success && data.users.length > 0) {
                      data.users.forEach(user => {
                          const row = `
                              <tr>
                                  <td>${user.id}</td>
                                  <td>
                                      <div class="d-flex align-items-center">
                                          <div class="user-avatar me-2">
                                              <img src="/placeholder.svg?height=40&width=40" alt="${user.name}">
                                          </div>
                                          <div>${user.name}</div>
                                      </div>
                                  </td>
                                  <td>${user.email}</td>
                                  <td>${user.phone}</td>
                                  <td>${user.role}</td>
                                  <td>${user.created_at}</td>
                                  <td>
                                      ${user.is_block === 0 
                                          ? '<span class="badge bg-success">Active</span>' 
                                          : '<span class="badge bg-danger">Inactive</span>'}
                                  </td>
                                  <td>
                                      <div class="action-btns d-flex">
                                          <button class="btn btn-sm btn-primary btn-edit" data-bs-toggle="modal"
                                              data-bs-target="#editUserModal" data-user-id="${user.id}"
                                              data-name="${user.name}" data-phone="${user.phone}"
                                              data-address="${user.address}">
                                              <i class="fas fa-edit"></i>
                                          </button>
                                          <button class="btn btn-sm btn-danger" onclick="blockUser(${user.id})">
                                              <i class="fa fa-ban"></i>
                                          </button>
                                          <button class="btn btn-sm btn-success" onclick="unBlockUser(${user.id})">
                                              <i class="fa fa-lock-open"></i>
                                          </button>
                                      </div>
                                  </td>
                              </tr>
                          `;
                          userTableBody.insertAdjacentHTML('beforeend', row);
                      });
                  } else {
                      userTableBody.innerHTML = '<tr><td colspan="8" class="text-center">No users found.</td></tr>';
                  }
              },
              error: function (xhr, status, error) {
                  console.error('Error fetching users:', error);
              }
          });
      }, 300); // Delay of 300ms for debounce
  });
});