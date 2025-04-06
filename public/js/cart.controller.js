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
});


function addToCart(productId, quantity = 1) {
    cart.addToCart(productId, quantity);
}

function getUserCart() {
    return cart.getCart();
}


function updateQuantity(productId, quantity) {
    cart.updateQuantity(productId, quantity);
}

function removeItem(productId){
    cart.removeFromCart(productId);
}