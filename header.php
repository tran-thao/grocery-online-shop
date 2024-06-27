<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lemi Mart</title>
    <link rel="stylesheet" href="./style.css">
    <base href="http://localhost/assignment-1/">
    <script src="./script.js"></script>
    <script src="https://kit.fontawesome.com/98fd7ffeba.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="top-bar">
        <div class="logo"><a href="./index.php"><img src="./img/Lemi_transparent.png" alt="Logo"></a></div>
        <div class="search-bar">
            <form action="search.php" method="get">
            <input type="text" placeholder="Search products" name="q" class="search-box">
            <button type="submit" class="search-button">Search</button>
            </form>
        </div>
    </div>
    
    <?php include 'navigation.php';?>
</body>
</html>
