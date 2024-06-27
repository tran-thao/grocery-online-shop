<?php

$connection = mysqli_connect('localhost', 'root', '', 'assignment1');

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $product_id => $item) {

        $query = "SELECT in_stock FROM products WHERE product_id = $product_id";
        $result = mysqli_query($connection, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $current_stock = $row['in_stock'];
            $new_stock = $current_stock - $item['quantity'];

            $update_query = "UPDATE products SET in_stock = $new_stock WHERE product_id = $product_id";
            $update_result = mysqli_query($connection, $update_query);

            if (!$update_result) {
                echo "Error updating stock quantity for product ID: $product_id";
            }
        } else {
            echo "Product not found with ID: $product_id";
        }
    }
} else {
    echo "Shopping cart is empty";
}
?>
