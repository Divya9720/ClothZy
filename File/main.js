// main.js

// store Cart ko localStorage 
let cart = JSON.parse(localStorage.getItem('cart')) || [];

// Function to add product to cart
function addToCart(product) {
  // Check product already in cart 
  const existing = cart.find(item => item.name === product.name);

  if (existing) {
    existing.qty += 1;
  } else {
    product.qty = 1;
    cart.push(product);
  }

  localStorage.setItem('cart', JSON.stringify(cart));
  alert(`${product.name} added to cart!`);
  updateCartCount();
}

// Update Cart count
function updateCartCount() {
  const countElem = document.getElementById('cart-count');
  if (countElem) {
    let totalQty = cart.reduce((sum, item) => sum + item.qty, 0);
    countElem.textContent = totalQty;
  }
}

// Event listeners when dom is loaded
document.addEventListener('DOMContentLoaded', () => {
  updateCartCount();

  const buttons = document.querySelectorAll('.add-to-cart');
  buttons.forEach(button => {
    button.addEventListener('click', (e) => {
      e.preventDefault();

      const product = {
        name: button.dataset.name,
        price: parseFloat(button.dataset.price),
        image: button.dataset.image
      };

      addToCart(product);
    });
  });
});


$(document).ready(function () {
  $(".owl-carousel").owlCarousel({
    loop: true,             
    nav: true,        
    dots: false,
    autoplay: true,
    autoplayTimeout: 1800,        
    margin: 0,              
    responsive: {
      0: {
        items: 1
      },
      576: {
        items: 2
      },
      768: {
        items: 3
      },
      992: {
        items: 4
      }
    }
  });
});

    document.getElementById("logout-tab").addEventListener("click", function () {
      alert("You have been logged out!");
      // window.location.href = "login.html"; // Optional
    });




