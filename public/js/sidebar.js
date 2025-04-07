document.addEventListener("DOMContentLoaded", function () {
    const currentPath = window.location.pathname; 
    const match = currentPath.match(/\/admin\/([^\/]+)\/page/); 

    if (match && match[1]) {
      const currentPage = match[1]; 
      const menuItems = document.querySelectorAll(".sidebar-menu .menu-item");

      menuItems.forEach((item) => {
        const href = item.getAttribute("href");
        if (href && href.includes(`/admin/${currentPage}/page`)) {
          item.classList.add("active");
        } else {
          item.classList.remove("active");
        }
      });
    }
});