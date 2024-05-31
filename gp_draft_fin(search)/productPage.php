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
?> <link href="CSS/productPage.css" rel="stylesheet" />


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- bootstrap css link  -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- bootstrap css link  -->

    <!-- font awsome link  -->
    <script src="https://kit.fontawesome.com/f139cdc8d9.js" crossorigin="anonymous"></script>
    <!-- font awsome link  -->

    <!-- CSS file link  -->
    <link rel="stylesheet" href="style.css">
    <!-- CSS file link  -->
    
    
    <title><?php echo htmlspecialchars($product['product_title'], ENT_QUOTES, 'UTF-8'); ?></title>
</head>
<body>
    <div class="container">
        <div class="Header">
            <!-- Nav bar  -->
<div class="container-fluid p-0">
   <!-- first child  --> 
   <nav class="navbar navbar-expand-lg bg-body-tertiary bg-info">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">LOGO</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="diaplay_all.php">Products</a>
        </li>
        <?php
if(!isset($_SESSION['username'])){
echo "<li class='nav-item'>
<a class='nav-link' href='./users_area/profile.php'>my account</a>
</li>";
}else{
  echo "<li class='nav-item'>
<a class='nav-link' href='./users_area/user_registration.php'>Register</a>
</li>";
}
?>
        
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping"></i><?php cart_item(); ?></a> <!--- call cart function --->
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Total price:<?php total_cart_price(); ?></a>
        </li>
      </ul>
      <!--- note: when you click shearch you are redirected to search product.php and you use a get method to get results --->
      <form class="d-flex" action="index.php" method="get">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_data">
       <input type="submit" value="Search" class="btn btn-outline-dark" name="search_data_product">
      </form>
      <?php
    search_product();
    ?>

    </div>
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
            <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
        </div>

        <div class="Similar-Products"></div>
    </div>
</body>
<script src="JS/javaScript.js"> 
</script>
</html>
