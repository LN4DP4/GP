<!-- connect file -->
<?php
include('includes/connect.php');
include('functions/common_function.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test shop</title>
    <!-- bootstrap css link  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- bootstrap css link  -->

    <!-- font awsome link  -->
    <script src="https://kit.fontawesome.com/f139cdc8d9.js" crossorigin="anonymous"></script>
    <!-- font awsome link  -->

    <!-- CSS file link  -->
    <link rel="stylesheet" href="style.css">
    <!-- CSS file link  -->

    <style>
      body{
  overflow-x: hidden;
}

    </style>

</head>
<body>
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
<!-- calling cart function -->
<?php
cart();
?>


</div>

<!--- second child --->
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
      <ul class="navbar-nav me-auto">
      
        <?php
        if(!isset($_SESSION['username'])){
          echo "<li class='nav-item'>
          <a class='nav-link' href='#'>Welcome guest</a>
        </li>";
        }else{
          echo "<li class='nav-item'>
          <a class='nav-link' href='#'>Welcome ".$_SESSION['username']."</a>
        </li>";
        }
        if(!isset($_SESSION['username'])){
          echo "<li class='nav-item'>
          <a class='nav-link' href='./users_area/user_login.php'>Login</a>
        </li>";
        }else{
          echo "<li class='nav-item'>
          <a class='nav-link' href='./users_area/logout.php'>Logout</a>
        </li>";
        }


        ?>
      </ul>
     </nav>

      <!--- third child --->
      <div class="bg-light">
      <h3 class="text-center">Hidden store</h3>
      <p class="text-center">place holder text</p>
     </div>

<!--- banner --->
<div class = "banner-conatiner">
            <div class="banner">
                <div class="banner-text">
                    <h2>LIMITED TIME OFFER</h2>
                    <h1>SALE</h1>
                    <button id="btn">SHOP NOW</button>
                </div>
            </div>
        </div>
     <!--- banner --->

     <!--- fouth child --->
     <div class="row px-1">
      <div class="col-md-10">
        <!--- products --->
        <div class="row">
<!--- Fetching products --->
<?php
    // calling function 
    getproducts();
    //$ip = getIPAddress();  
    //echo 'User Real IP Address - '.$ip;
    
    
    
?>



         <!-- <div class="col-md-4 mb-2">
          <div class="card">
  <img src="./images/imagenotfound.png" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="btn btn-info">Add to cart</a>
    <a href="#" class="btn btn-secondary">View more</a>
  </div>
</div>
</div> -->

<!-- row end -->
</div>
<!-- col end -->
</div>



      <!--- side nav --->
      <div class="col-md-2 bg-secondary p-0">
        <!--- brands to be displayed --->
        <ul class="navbar-nav me-auto text-center">
          <li class="nav-item bg-info">
            <a href="#" class="nav-link text-light"><h4>Platform</h4></a>
          </li>

          <!--- php code to display items in data base on side bar --->
          <?php
          getplatfrom();
         
          ?>
<!--- php code to display items in data base on side bar --->

        
        </ul>

        <!--- catgories to be displayed --->
        <ul class="navbar-nav me-auto text-center">
          <li class="nav-item bg-info">
            <a href="#" class="nav-link text-light"><h4>catogories</h4></a>
          </li>

          <!--- php code to display items in data base on side bar --->
          <?php
          getcategories();
          
          ?>
<!--- php code to display items in data base on side bar --->


        </ul>
        
      </div>
     </div>

    

     



</body>

<!--- footer --->
<footer class="footer">
        <div class="footer-container">
            <div class="row">
                <div class="footer-col">
                    <h4>place holder</h4>
                    <ul>
                        <li><a href="#">place holder</a></li>
                        <li><a href="#">place holder</a></li>
                        <li><a href="#">place holder</a></li>
                        <li><a href="#">place holder</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>place holder</h4>
                    <ul>
                        <li><a href="#">place holder</a></li>
                        <li><a href="#">place holder</a></li>
                        <li><a href="#">place holder</a></li>
                        <li><a href="#">place holder</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>place holder</h4>
                    <ul>
                        <li><a href="#">place holder</a></li>
                        <li><a href="#">place holder</a></li>
                        <li><a href="#">place holder</a></li>
                        <li><a href="#">place holder</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>place holder</h4>
                    <div class="social-links">
                        <a href="#"><i class="fa-brands fa-facebook"></i></a>
                        <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
                        <a href="#"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#"><i class="fa-brands fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

  <!--- footer --->
   
<!-- bootstrap js link  -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<!-- bootstrap js link  -->

</html>