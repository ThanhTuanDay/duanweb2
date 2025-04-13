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

  // Add click event listeners to all "Edit" buttons
  editButtons.forEach(btn => {
      btn.addEventListener('click', function () {
          // Populate the modal fields with user data
          document.getElementById('editName').value = this.dataset.name;
          document.getElementById('editAddress').value = this.dataset.address;
          document.getElementById('editPhone').value = this.dataset.phone;

          // Set the user ID on the "Save Changes" button
          document.getElementById('saveUserChanges').setAttribute('data-user-id', this.dataset.userId);
      });
  });

  // Handle the "Save Changes" button click
  document.getElementById('saveUserChanges').addEventListener('click', function () {
      const userId = this.getAttribute('data-user-id'); // Get the user ID from the button

      // Collect updated user data from the form fields
      const updatedUserData = {
          id: userId,
          name: document.getElementById('editName').value,
          address: document.getElementById('editAddress').value,
          phone: document.getElementById('editPhone').value
      };

      // Send the updated data to the API via AJAX
      $.ajax({
          url: '/duanweb2/app/api/users.api.php',
          type: 'POST',
          data: {
              action: 'updateUser',
              ...updatedUserData // Spread the updated user data into the request
          },
          success: function (response) {
              console.log("Raw response from API:", response);
              try {
                  const data = typeof response === 'string' ? JSON.parse(response) : response; // Parse only if it's a string
                  if (data.success) {
                      alert(data.message); // Show success message
                      location.reload(); // Reload the page to reflect changes
                  } else {
                      alert(data.message); // Show failure message
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