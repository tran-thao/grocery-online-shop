<?php
$connection = mysqli_connect('localhost', 'root', '', 'assignment1');

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

session_start();
$cartItemCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
?>

<nav class="navbar">
    <ul>
        <?php
        $categories_query = "SELECT * FROM categories WHERE parent_id IS NULL";
        $categories_result = mysqli_query($connection, $categories_query);

        while ($category_row = mysqli_fetch_assoc($categories_result)) {
            $category_id = $category_row['category_id'];
            $category_name = $category_row['category_name'];

            $subcategories_query = "SELECT * FROM categories WHERE parent_id = $category_id";
            $subcategories_result = mysqli_query($connection, $subcategories_query);
            $has_subcategories = mysqli_num_rows($subcategories_result) > 0;

            echo "<li>";
            if ($has_subcategories) {
                echo "<div class='dropdown'>";
                echo "<button class='dropbtn'>$category_name</button>";
                echo "<div class='dropdown-content'>";
                while ($subcategory_row = mysqli_fetch_assoc($subcategories_result)) {
                    $subcategory_id = $subcategory_row['category_id'];
                    $subcategory_name = $subcategory_row['category_name'];
                    echo "<a href='category.php?category_id=$subcategory_id'>$subcategory_name</a>";
                }
                echo "</div>";
                echo "</div>";
            } else {
                echo "<a href='category.php?category_id=$category_id'>$category_name</a>";
            }
            echo "</li>";
        }
        ?>
        <!-- Display cart item count -->
        <li id="cart-link"><a href="cart.php"><i class="fa-solid fa-cart-shopping"></i> (<span id="cart-item-count"><?php echo $cartItemCount; ?></span>)</a></li>
    </ul>
</nav>

