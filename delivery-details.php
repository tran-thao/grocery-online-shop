<?php
session_start();

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {

    header('Location: cart.php');
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Details</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="logo"><a href="./index.php"><img src="./img/Lemi_transparent.png" alt="Logo"></a></div>
    <div class="delivery-details-container">
        <h2>Delivery Details</h2>
        <form action="place-order.php" method="post">
            <!-- Contact details -->
            <label for="first-name">First Name:</label>
            <input type="text" id="first-name" name="first-name" required>
            <label for="last-name">Last Name:</label>
            <input type="text" id="last-name" name="last-name" required>
            <label for="mobile-number">Mobile Number:</label>
            <input type="tel" id="mobile-number" name="mobile-number" required pattern="[0-9]{10}"> 
            <label for="email">Email Address:</label>
            <input type="email" id="email" name="email" required>
            
            <!-- Address section -->
            <label for="street">Street:</label>
            <input type="text" id="street" name="street" required>
            <label for="zip-code">Postal/Zip Code:</label>
            <input type="text" id="zip-code" name="zip-code" required pattern=.{4}>
            <label for="city">City/Suburb:</label>
            <input type="text" id="city" name="city" required>
            <label for="state">State:</label>
            <select id="state" name="state" required>
                <option value="" disabled selected>Select State/Territory</option>
                <option value="NSW">New South Wales</option>
                <option value="VIC">Victoria</option>
                <option value="QLD">Queensland</option>
                <option value="WA">Western Australia</option>
                <option value="SA">South Australia</option>
                <option value="TAS">Tasmania</option>
                <option value="ACT">Australian Capital Territory</option>
                <option value="NT">Northern Territory</option>
                <option value="Others">Others</option>
            </select>
            <label for="country">Country:</label>
            <input type="text" id="country" name="country" value="Australia" readonly>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
