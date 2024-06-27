<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header('Location: cart.php');
    exit;
}

$connection = mysqli_connect('localhost', 'root', '', 'assignment1');

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$unavailable_products = array();
$insufficient_stock_products = array();

foreach ($_SESSION['cart'] as $product_id => $item) {
    $query = "SELECT in_stock FROM products WHERE product_id = $product_id";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($connection));
    }

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $stock_quantity = $row['in_stock'];

        if ($item['quantity'] > $stock_quantity) {
         
            $insufficient_stock_products[] = $product_id;
        } elseif ($stock_quantity == 0) {
          
            $out_of_stock_products[] = $product_id;
        }
        } else {
            // Product not found
            $out_of_stock_products[] = $product_id;
        }
}

if (!empty($out_of_stock_products) || !empty($insufficient_stock_products)) {
    $error_message = '';
    if (!empty($out_of_stock_products)) {
        $error_message .= "Sorry, the following product(s) are currently out of stock: " . implode(', ', $out_of_stock_products) . ". ";
    }
    if (!empty($insufficient_stock_products)) {
        $error_message .= "Sorry, the following product(s) have insufficient stock: " . implode(', ', $insufficient_stock_products) . ". ";
    }


    header('Location: cart.php?error=' . urlencode($error_message));
    exit;
}

include 'update-stock.php';

mysqli_close($connection);

unset($_SESSION['cart']);

header('Location: order-success.php');
exit;
?>
