class Product {
    constructor(id, name, price, image) {
      this.id = id;
      this.name = name;
      this.price = price;
      this.image = image;
    }
  
    renderProduct() {
      return `
        <div class="product-item">
          <img src="${this.image}" alt="${this.name}">
          <h3>${this.name}</h3>
          <p>$${this.price.toFixed(2)}</p>
          <button data-id="${this.id}">Add to Cart</button>
        </div>
      `;
    }
  }
  
  class Cart {
    constructor() {
      this.items = [];
    }
  
    addProduct(product) {
      this.items.push(product);
      this.renderCart();
    }
  
    removeProduct(productId) {
      this.items = this.items.filter(item => item.id !== productId);
      this.renderCart();
    }
  
    clearCart() {
      this.items = [];
      this.renderCart();
    }
  
    getTotalPrice() {
      return this.items.reduce((total, product) => total + product.price, 0);
    }
  
    renderCart() {
      const cartItemsContainer = document.getElementById('cart-items');
      const totalPriceElement = document.getElementById('total-price');
  
      if (this.items.length === 0) {
        cartItemsContainer.innerHTML = '<p>Your cart is empty.</p>';
        totalPriceElement.innerHTML = 'Total: $0.00';
      } else {
        cartItemsContainer.innerHTML = this.items
          .map(item => `
            <div>
              <p>${item.name} - $${item.price.toFixed(2)}</p>
              <button data-id="${item.id}" class="remove-btn">Remove</button>
            </div>
          `)
          .join('');
  
        totalPriceElement.innerHTML = `Total: $${this.getTotalPrice().toFixed(2)}`;
      }
    }
  }
  
  const productsData = [
    new Product(1, 'Apple Watch Series 10', 499.99, 'apple-watch-series10-intro.jpg'),
    new Product(2, 'iPhone 16e', 599.99, 'iphone16e.jpg'),
    new Product(2, 'iPhone 16', 799.99, 'iphone16.jpg'),
    new Product(3, 'iphone 16 Pro', 999.99, 'iphone16-pro.jpg'),
    new Product(4, 'Macbook M4 Pro', 1499.99, 'macbook1.jpg'),
  ];
  
  const cart = new Cart();
  
  document.addEventListener('DOMContentLoaded', () => {
    const productListContainer = document.getElementById('product-list');
  
    productsData.forEach(product => {
      productListContainer.innerHTML += product.renderProduct();
    });
 
    productListContainer.addEventListener('click', (event) => {
      if (event.target.tagName === 'BUTTON') {
        const productId = event.target.dataset.id;
        const selectedProduct = productsData.find(product => product.id == productId);
        cart.addProduct(selectedProduct);
      }
    });
  

    document.getElementById('cart-items').addEventListener('click', (event) => {
      if (event.target.classList.contains('remove-btn')) {
        const productId = event.target.dataset.id;
        cart.removeProduct(Number(productId)); 
      }
    });
  
 
    document.getElementById('clear-cart').addEventListener('click', () => {
      cart.clearCart();
    });
  });
  