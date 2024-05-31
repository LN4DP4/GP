<?php
include('includes/connect.php');
include('functions/common_function.php');

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Fetch product details from the database
    $query = "SELECT * FROM `products` WHERE `product_id` = $product_id";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
    } else {
        echo "Product not found.";
        exit;
    }
} else {
    echo "No product specified.";
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="CSS/productPage.css" rel="stylesheet" />
    
    <title><?php echo htmlspecialchars($product['product_title'], ENT_QUOTES, 'UTF-8'); ?></title>
</head>
<body>
    <div class="container">
        <div class="Header">
            <nav class="nav">
                <i class="uil uil-bars navOpenBtn"></i>
                <a href="#" class="logo">place holder</a>
                <ul class="nav-links">
                    <i class="uil uil-times navCloseBtn"></i>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Playstation</a></li>
                    <li><a href="#">Xbox</a></li>
                    <li><a href="#">PC</a></li>
                    <li><a href="#">Bestsellers</a></li>
                </ul>
                <i class="uil uil-search search-icon" id="searchIcon"></i>
                <div class="search-box">
                    <i class="uil uil-search search-icon"></i>
                    <input type="text" placeholder="Search here..." />
                </div>
            </nav>
        </div>

        <div class="Game-Display">
            <img id="mImg" class="productImg" src="./admin_area/product_images/<?php echo htmlspecialchars($product['product_image1'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($product['product_title'], ENT_QUOTES, 'UTF-8'); ?>">
        </div>

       <!-- <div class="Other-Displays">
            <img id="1img" src="./admin_area/product_images/<?php echo htmlspecialchars($product['product_image2'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($product['product_title'], ENT_QUOTES, 'UTF-8'); ?>">
            <img id="2img" src="./admin_area/product_images/<?php echo htmlspecialchars($product['product_image3'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($product['product_title'], ENT_QUOTES, 'UTF-8'); ?>">   
            <img id="3img" src="./admin_area/product_images/<?php echo htmlspecialchars($product['product_image4'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($product['product_title'], ENT_QUOTES, 'UTF-8'); ?>">
            <img id="4img" src="./admin_area/product_images/<?php echo htmlspecialchars($product['product_image5'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($product['product_title'], ENT_QUOTES, 'UTF-8'); ?>">
        </div>
-->

        <div id="text-container" class="Game-Description">
            <?php echo nl2br(htmlspecialchars($product['product_description'], ENT_QUOTES, 'UTF-8')); ?>
        </div>

        <div class="Buy-the-Product">
            <h2 class="price">£<?php echo htmlspecialchars($product['product_price'], ENT_QUOTES, 'UTF-8'); ?></h2>
            <button class="button" onclick="addToBasket(<?php echo $product['product_id']; ?>)">Add To Basket</button>
        </div>

        <div class="Similar-Products"></div>
    </div>
</body>
<script src="JS/javaScript.js"> 
</script>
</html>
