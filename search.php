<?php
include('search-results.php');

$connection = mysqli_connect('localhost', 'root', '', 'assignment1');

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$searchKeyword = $_GET['q']; 

$query = "SELECT * FROM products WHERE product_name LIKE '%$searchKeyword%'";

$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) > 0) {
    echo "<div class='grid-container'>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='grid-item'>";
        echo "<img src='" . $row['image_url'] . "' alt='" . $row['product_name'] . "'>";
        echo "<h3>" . $row['product_name'] . "</h3>";
        echo "<p>Unit: " . $row['unit_quantity'] . "</p>";
        echo "<p>Price: $" . $row['unit_price'] . "</p>";
        echo "<p>" . ($row['in_stock'] ? "In Stock" : "Out of Stock") . "</p>";
        echo "<button class='add-to-cart-button' data-product-id='" . $row['product_id'] . "'>Add to Cart</button>";
        echo "</div>";
    }
    echo "</div>";
} else {
    echo "No results found";
}

mysqli_close($connection);


