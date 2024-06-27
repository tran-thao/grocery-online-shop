<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lemi Mart</title>
    <link rel="stylesheet" href="style.css">
    <base href="http://localhost/assignment-1/">
    <script src="./script.js"></script>
</head>
<body>
    <div class="logo"><a href="./index.php"><img src="./img/Lemi_transparent.png" alt="Logo"></a></div>
    <div class="cart-container">
        <h2>Shopping Cart</h2>
        <table class="cart-table">
        <thead>
            <tr>
                <th></th>
                <th>Product name</th>
                <th>Quantity</th>
                <th>Product Price</th>
                <th>Total</th>
                <th></th> 
            </tr>
        </thead>
        <tbody>
           
            <?php
session_start();


if (isset($_GET['error'])) {
    $error_message = $_GET['error'];
    echo "<p>$error_message</p>";
}


$connection = mysqli_connect('localhost', 'root', '', 'assignment1');


if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}


$totalPrice = 0;
$disableOrderButton = false;


if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {

foreach ($_SESSION['cart'] as $product_id => $item) {

    $query = "SELECT * FROM products WHERE product_id = $product_id";


    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($connection));
    }


    if (mysqli_num_rows($result) > 0) {
    
        $row = mysqli_fetch_assoc($result);

        
        $subtotal = $row['unit_price'] * $item['quantity'];

        // Add subtotal to total price
        $totalPrice += $subtotal;

      
        echo "<tr>";
        echo "<td><img src='" . $row['image_url'] . "' alt='" . $row['product_name'] . "'></td>";
        echo "<td>" . $row['product_name'] . "</td>";
        echo "<td>";
        // Form to update the quantity
        echo "<form method='POST' class='update-form'>";
        echo "<input type='hidden' name='product_id' value='$product_id'>";
        echo "<input type='number' name='quantity' value='" . $item['quantity'] . "' min='1'>";
        echo "<button type='button' class='update-button'>Update</button>"; 
        echo "</form>";

        //echo "<span class='cart-item-quantity'>Quantity: " . $item['quantity'] . "</span>";
        echo "</td>";
        echo "<td>$" . $row['unit_price'] . "</td>";
        echo "<td>$" . number_format($subtotal, 2) . "</td>";
        echo "<td><button class='remove-item-button' data-product-id='$product_id'>Remove</button></td>";
        echo "</tr>";
        
    } else {
        echo "<tr><td colspan='5'>No product found with ID: $product_id</td></tr>";
    }
    }
    } else {
        
        echo "<p class='error-message'>Your shopping cart is empty.</p>";
    }


    mysqli_close($connection);

    // Display total price for the whole shopping cart
    echo "<td></td>
    <td></td>
    <td></td>
    <td>Total Price:</td>";
    echo "<td>$" . number_format($totalPrice, 2) . "</td>";
    echo "<div>Total Price: $" . number_format($totalPrice, 2) . "</div>";
    ?>
    </tbody>
    </table>


<form method="POST" action="clear-cart.php">
    <button class="clear-cart-button" type="submit">Clear Cart</button>
</form>

<?php
        if ($disableOrderButton) {

            echo "<button class='delivery-details-button' disabled>Place an order</button>";
        } else if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
            //echo "<p>Your shopping cart is empty. Please add items to proceed.</p>";
        } else {

            echo "<a href='delivery-details.php' class='delivery-details-button'>Place an order</a>";
        }
?>

<p><?php echo $errorMessage; ?></p>

</div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var removeButtons = document.querySelectorAll('.remove-item-button');
            removeButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var productId = button.getAttribute('data-product-id');
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', 'remove-item.php', true);
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                            // Reload the page to update the cart display
                            window.location.reload();
                        }
                    };
                    xhr.send('product_id=' + productId);
                });
            });
        });


document.addEventListener('DOMContentLoaded', function() {
    var updateForms = document.querySelectorAll('.update-form');
    updateForms.forEach(function(form) {
        var updateButton = form.querySelector('.update-button');
        var productId = form.querySelector('[name="product_id"]').value;
        
        updateButton.addEventListener('click', function() {
            var quantity = form.querySelector('[name="quantity"]').value;
            
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'update-quantity.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    window.location.reload(); // Reload the entire page
                    var quantitySpan = document.querySelector('.cart-item-quantity[data-product-id="' + productId + '"]');
                    if (quantitySpan) {
                        quantitySpan.textContent = 'Quantity: ' + quantity;
                    }
                }
            };
            xhr.send('product_id=' + productId + '&quantity=' + quantity);
        });
    });
});
    </script>
</body>
</html>
