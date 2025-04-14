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