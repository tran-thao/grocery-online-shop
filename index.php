<?php include 'header.php';?>

<div class="category-section">
    <?php

    $connection = mysqli_connect('localhost', 'root', '', 'assignment1');

    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $categories_query = "SELECT * FROM categories WHERE parent_id IS NULL";
    $categories_result = mysqli_query($connection, $categories_query);

    // Display parent categories
    while ($category_row = mysqli_fetch_assoc($categories_result)) {
        $category_id = $category_row['category_id'];
        $category_name = $category_row['category_name'];

        echo "<div class='category'>";
        echo "<h2>$category_name</h2>";

        $subcategories_query = "SELECT * FROM categories WHERE parent_id = $category_id";
        $subcategories_result = mysqli_query($connection, $subcategories_query);

        // Display subcategories and products for each parent category
        echo "<div class='subcategory-products'>";
        while ($subcategory_row = mysqli_fetch_assoc($subcategories_result)) {
            $subcategory_id = $subcategory_row['category_id'];
            $subcategory_name = $subcategory_row['category_name'];

            // Display subcategory name
            echo "<h3>$subcategory_name <a class='see-more' href='category.php?category_id=$subcategory_id'>See more</a></h3>";

            $products_query = "SELECT * FROM products WHERE category_id = $subcategory_id LIMIT 3";
            $products_result = mysqli_query($connection, $products_query);

            echo "<div class='products-grid'>";
            while ($product_row = mysqli_fetch_assoc($products_result)) {
                $product_name = $product_row['product_name'];
                $product_image = $product_row['image_url']; 
                $product_price = $product_row['unit_price']; 

                echo "<div class='product'>";
                echo "<img src='$product_image' alt='$product_name'>";
                echo "<p>$product_name</p>";
                echo "<p>Price: $$product_price</p>";
                echo "</div>";
            }
            echo "</div>"; 
        }
        echo "</div>"; 
        echo "</div>"; 
    }

    mysqli_close($connection);
    ?>
</div>
