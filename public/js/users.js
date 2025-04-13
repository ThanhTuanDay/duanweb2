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
