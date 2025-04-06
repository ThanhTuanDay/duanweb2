const data = document.getElementById("app-data");
const userId = data.getAttribute("data-user-id") || 'guest';
const cart = new CartModel(userId);

document.addEventListener("DOMContentLoaded", () => {
    if (!data) return;

    const productsRaw = data.getAttribute("data-products");
    const products = JSON.parse(productsRaw || "[]");

    if (products && products.length > 0) {

        localStorage.setItem("store_cart", JSON.stringify(products));
    }


    const pathname = window.location.pathname;
    if(pathname.includes("/success")){
        const key = `cart_${userId}`;
        console.log(key);
        clearCart(key);
    }
});
function clearCart(userId) {
    const cartKey = `cart_${userId}`;
    cart.clearCart(cartKey);
}


function addToCart(event, productId, quantity = 1) {
    cart.addToCart(productId, quantity);
    const cartIcon = event.currentTarget.querySelector('svg');
    cartIcon.classList.add('cart-animation');
    setTimeout(() => {
        cartIcon.classList.remove('cart-animation');
    }, 500);
    showCartNotification(data.message || 'Item added to cart successfully!');
}
function showCartNotification(message) {
    const container = document.getElementById('cart-notifications-container');

    // Create a new notification element
    const notification = document.createElement('div');
    notification.className = 'cart-notification';

    // Create notification content
    const content = document.createElement('div');
    content.className = 'cart-notification-content';

    // Add check icon
    const icon = document.createElement('i');
    icon.className = 'fa fa-check-circle';
    content.appendChild(icon);

    // Add message
    const messageElement = document.createElement('span');
    messageElement.textContent = message;
    content.appendChild(messageElement);

    // Add content to notification
    notification.appendChild(content);

    // Add notification to container
    container.appendChild(notification);

    // Trigger reflow to enable transition
    notification.offsetHeight;

    // Show notification
    notification.classList.add('show');

    // Remove notification after 3 seconds
    setTimeout(() => {
        notification.classList.remove('show');

        // After transition ends, remove the element from DOM
        setTimeout(() => {
            container.removeChild(notification);
        }, 300); // Match this with your transition duration
    }, 3000);
}
function getUserCart() {
    return cart.getCart();
}


function updateQuantity(productId, quantity) {
    cart.updateQuantity(productId, quantity);
}

function removeItem(productId) {
    cart.removeFromCart(productId);
}