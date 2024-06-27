<?php
session_start();

$cartItemCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;

header('Content-Type: application/json');
echo json_encode(['cartItemCount' => $cartItemCount]);
?>
