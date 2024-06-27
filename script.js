//handle adding items to the cart
document.addEventListener('DOMContentLoaded', function() {
    var addToCartButtons = document.querySelectorAll('.add-to-cart-button');
    console.log(addToCartButtons);
    addToCartButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            console.log("clicked add to cart button");
            var productId = button.getAttribute('data-product-id');
            console.log("add to cart product id: " + productId);
            var xhr = new XMLHttpRequest();
            xhr.open('POST', './update-cart.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    console.log(xhr.responseText);
                    updateCartItemCount();
                }
            };
            xhr.send('product_id=' + productId);
        });
    });
});


function updateCartItemCount() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'get-cart-item-count.php', true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            var cartItemCountElement = document.getElementById('cart-item-count');
            if (cartItemCountElement) {
                cartItemCountElement.textContent = response.cartItemCount;
            }
        }
    };
    xhr.send();
}

updateCartItemCount();
setInterval(updateCartItemCount, 5000);





