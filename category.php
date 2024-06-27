<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lemi Mart</title>
    <link rel="stylesheet" href="./style.css">

</head>
<body>

    <?php include 'header.php'; ?>

    <div class="grid-container">
        <?php

        $connection = mysqli_connect('localhost', 'root', '', 'assignment1');


        if (!$connection) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $category_id = $_GET['category_id'];

        $query = "SELECT * FROM products WHERE category_id = $category_id";


        $result = mysqli_query($connection, $query);

        if (mysqli_num_rows($result) > 0) {
            // Display items as a grid view
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='grid-item'>";
                echo "<img src='" . $row['image_url'] . "' alt='" . $row['product_name'] . "'>";
                echo "<h3>" . $row['product_name'] . "</h3>";
                echo "<p>Unit: " . $row['unit_quantity'] . "</p>";
                echo "<p>Price: $" . $row['unit_price'] . "</p>";
                echo "<p>" . ($row['in_stock'] ? "In Stock" : "Out of Stock") . "</p>";
        // Check if the item is in stock
        if ($row['in_stock']) {
            // Display the "Add to Cart" button
            echo "<button class='add-to-cart-button' data-product-id='" . $row['product_id'] . "'>Add to Cart</button>";
        } else {
            echo "<button disabled class='out-of-stock'>Out of Stock</button>";
        }

        echo "</div>";
                }
            }
        
         else {
            echo "No items found in this category.";
        }

 
        mysqli_close($connection);
        ?>
    </div>
</body>
</html>
