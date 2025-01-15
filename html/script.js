document.addEventListener("DOMContentLoaded", () => {
    const homeSection = document.getElementById("homeSection");
    const allMangaSection = document.getElementById("allMangaSection");
    const cartSection = document.getElementById("cartSection");
    const cartItemsDiv = document.getElementById("cartItems");
    const checkoutButton = document.getElementById("checkoutButton");
  
    const homeLink = document.getElementById("homeLink");
    const allMangaLink = document.getElementById("allMangaLink");
    const cartLink = document.getElementById("cartLink");
  
    let cart = [];
  
    // Navigation
    homeLink.addEventListener("click", () => {
      showSection(homeSection);
    });
  
    allMangaLink.addEventListener("click", () => {
      showSection(allMangaSection);
    });
  
    cartLink.addEventListener("click", () => {
      showCart();
      showSection(cartSection);
    });
  
    // Add to Cart
    document.querySelectorAll(".add-to-cart").forEach(button => {
      button.addEventListener("click", event => {
        const mangaItem = event.target.closest(".manga-item");
        const mangaId = mangaItem.getAttribute("data-id");
        const mangaTitle = mangaItem.getAttribute("data-title");
        const mangaPrice = mangaItem.getAttribute("data-price");
  
        const existingItem = cart.find(item => item.id === mangaId);
        if (existingItem) {
          existingItem.quantity++;
        } else {
          cart.push({ id: mangaId, title: mangaTitle, price: mangaPrice, quantity: 1 });
        }
  
        alert(`เพิ่ม "${mangaTitle}" ลงในตะกร้าสินค้าเรียบร้อยแล้ว!`);
      });
    });
  
    // Show Cart
    function showCart() {
      cartItemsDiv.innerHTML = "";
  
      if (cart.length === 0) {
        cartItemsDiv.innerHTML = "<p>ไม่มีสินค้าในตะกร้า</p>";
        checkoutButton.classList.add("hidden");
      } else {
        cart.forEach(item => {
          const itemDiv = document.createElement("div");
          itemDiv.textContent = `${item.title} - ${item.quantity} เล่ม - ${item.price * item.quantity} บาท`;
          cartItemsDiv.appendChild(itemDiv);
        });
        checkoutButton.classList.remove("hidden");
        
      }
    }
    
  
    // Section Navigation Helper
    function showSection(section) {
      [homeSection, allMangaSection, cartSection].forEach(sec => sec.classList.add("hidden"));
      section.classList.remove("hidden");
    }
  });
  