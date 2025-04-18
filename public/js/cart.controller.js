const data = document.getElementById("app-data");
const userId = data.getAttribute("data-user-id") || 'guest';
const cart = new CartModel(userId);

document.addEventListener("DOMContentLoaded", () => {
    if (!data) return;

    const productsRaw = data.getAttribute("data-products");
    const products = JSON.parse(productsRaw || "[]");

    if (products && products.length > 0) {
        const updatedProducts = products.map(product => {
            const price = parseFloat(product.price);
            let finalPrice = price;

            if (settings.enable_taxes) {
                const taxRate = applicationTaxRate || 0;

                if (settings.tax_calculation_method === 'per_item') {
                    finalPrice = price + (price * taxRate / 100);

                    if (settings.tax_rounding === 'round_up') {
                        finalPrice = Math.ceil(finalPrice);
                    } else if (settings.tax_rounding === 'round_down') {
                        finalPrice = Math.floor(finalPrice);
                    } else if (settings.tax_rounding === 'round_nearest') {
                        finalPrice = Math.round(finalPrice);
                    }
                }
            }

            return {
                ...product,
                final_price: finalPrice,
                currency: settings.currency || "VND"
            };
        });

        localStorage.setItem("store_cart", JSON.stringify(updatedProducts));
    }


    const pathname = window.location.pathname;
    if (pathname.includes("/success")) {
        clearCart();
    }
});
function clearCart() {
    cart.clearCart();
}

function addToCartWithQuantity(productId, quantity) {
    addToCart(null, productId, quantity);
}
function addToCart(event, productId, quantity = 1) {
    cart.addToCart(productId, quantity);
    if (event) {
        const cartIcon = event.currentTarget;
        if (cartIcon) {
            cartIcon.classList.add('cart-animation');
        }
    }
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