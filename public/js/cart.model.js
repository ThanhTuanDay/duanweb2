class CartModel {
    constructor(userId) {
        
        this.userId = userId;
        this.key = `cart_${userId}`;
        this.storeKey = `store_cart`;
    }

    isProductExist(productId) {
        const storeCart = this.getStoreCart();
        return storeCart.some(product => product.id === productId);
    }

    getStoreCart() {
        const cart = localStorage.getItem(this.storeKey);
        return cart ? JSON.parse(cart) : [];
    }

    getCart() {
        const reorderItem = localStorage.getItem("reorderItem");
        if(reorderItem){
            return JSON.parse(reorderItem);
        }
        const cart = localStorage.getItem(this.key);
        return cart ? JSON.parse(cart) : [];
    }

    saveCart(cart) {
        localStorage.setItem(this.key, JSON.stringify(cart));
    }

    addToCart(productId, quantity = 1) {
        const storeCart = this.getStoreCart();
        const userCart = this.getCart();

        const product = storeCart.find(p => p.id === productId);
        if (!product) {
            console.warn('Sản phẩm không tồn tại trong store cart');
            return;
        }

        const existingItem = userCart.find(item => item.id === productId);
        if (existingItem) {
            existingItem.quantity += quantity;
        } else {
            userCart.push({
                ...product,
                quantity,
            });
        }

        this.saveCart(userCart);
    }

    updateQuantity(productId, quantity) {
        const cart = this.getCart();
        const item = cart.find(p => p.id === productId);
        if (item) {
            item.quantity = Math.max(1, Math.min(10, quantity));
            this.saveCart(cart);
        }
    }

    getTotal() {
        const cart = this.getCart();
        return cart.reduce((sum, item) => sum + item.price * item.quantity, 0);
    }

    getItemCount() {
        const cart = this.getCart();
        return cart.reduce((count, item) => count + item.quantity, 0);
    }

    removeFromCart(productId) {
        const userCart = this.getCart().filter(item => item.id !== productId);
        this.saveCart(userCart);
    }

    clearCart() {
        localStorage.removeItem(this.key);
    }

    getCartTotal() {
        const cart = this.getUserCart();
        return cart.reduce((total, item) => total + item.price * item.quantity, 0);
    }
}
