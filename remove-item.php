<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['product_id'])) {
        $product_id = $_POST['product_id'];

        unset($_SESSION['cart'][$product_id]);
        header('Content-Type: application/json');
        echo json_encode(['success' => true]);
        exit; 
    } else {
      
        header('Content-Type: application/json');
        echo json_encode(['error' => true, 'message' => 'No product ID provided']);
        exit; 
    }
}
