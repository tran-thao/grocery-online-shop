<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['product_id'])) {      
        $product_id = $_POST['product_id'];
        if (isset($_SESSION['cart'][$product_id])) {         
            $_SESSION['cart'][$product_id]['quantity']++;
        } else {
            $_SESSION['cart'][$product_id] = [
                'quantity' => 1,
            ];
        }


        $response = $_SESSION['cart'];

        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    } else {
        header('Content-Type: application/json');
        echo json_encode(['error' => true, 'message' => 'No product ID provided']);
        exit; 
    }
}
?>
