<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['product_id']) && isset($_POST['quantity'])) {
        $product_id = $_POST['product_id'];
        $quantity = intval($_POST['quantity']); 

        if ($quantity <= 0) {
        
            header('Content-Type: application/json');
            echo json_encode(['error' => true, 'message' => 'Invalid quantity']);
            exit;
        }
        
        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]['quantity'] = $quantity;
         
            header('Content-Type: application/json');
            echo json_encode($_SESSION['cart']);
            exit;
        } else {
            header('Content-Type: application/json');
            echo json_encode(['error' => true, 'message' => 'Product not found in the cart']);
            exit;
        }
    } else {
        header('Content-Type: application/json');
        echo json_encode(['error' => true, 'message' => 'Product ID or quantity not provided']);
        exit;
    }
} else {
    header('Content-Type: application/json');
    echo json_encode(['error' => true, 'message' => 'Invalid request method']);
    exit;
}
?>
