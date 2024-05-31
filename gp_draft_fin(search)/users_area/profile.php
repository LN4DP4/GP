<!-- connect file -->
<?php
include('../includes/connect.php');
include('../functions/common_function.php');
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>welcome <?php echo $_SESSION['username'] ?> </title>
    <!-- bootstrap css link  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- bootstrap css link  -->

    <!-- font awsome link  -->
    <script src="https://kit.fontawesome.com/f139cdc8d9.js" crossorigin="anonymous"></script>
    <!-- font awsome link  -->

    <!-- CSS file link  -->
    <link rel="stylesheet" href="../sytle.css">
    <!-- CSS file link  -->

    <style>
      body{
  overflow-x: hidden;
}
.profile_img{
  width:90%;
  margin:auto;
  display:block;
  height:100%;
  object-fit:contain;
}
.edit_image{
    width: 100px;
    height: 100px;
    object-fit:contain;
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
          <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../diaplay_all.php">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="profile.php">My account</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../cart.php"><i class="fa-solid fa-cart-shopping"></i><?php cart_item(); ?></a> <!--- call cart function --->
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Total price:<?php total_cart_price(); ?></a>
        </li>
      </ul>
      <!--- note: when you click shearch you are redirected to search product.php and you use a get method to get results --->
      <form class="d-flex" action="../search_product.php" method="get">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_data">
       <input type="submit" value="Search" class="btn btn-outline-dark" name="search_data_product">
      </form>

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

      <!--- fourth child --->
      <div class="row">
        <div class="col-md-2">
            <ul class="navbar-nav bg-secondary text-center" style="height:100vh">
            <li class="nav-item bg-info">
          <a class="nav-link text-light" href="#"><h4>Your profile</h4></a>
        </li>

        <?php
$username = $_SESSION['username'];
$user_image_query = "SELECT * FROM `user_table` WHERE username='$username'";
$user_image_result = mysqli_query($con, $user_image_query);

if (!$user_image_result) {
    die("Query Failed: " . mysqli_error($con));
}

$row_image = mysqli_fetch_array($user_image_result);
$user_image = $row_image['user_image'];

echo "<li class='nav-item'>
        <img src='./user_images/$user_image' class='profile_img my-4' alt=''>
      </li>";

?>


        
        <li class="nav-item">
          <a class="nav-link text-light" href="profile.php">pending orders</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="profile.php?edit_account">edit account</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="profile.php?my_orders">my orders</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="profile.php?delete_account">delete account</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="logout.php">logout</a>
        </li>
            </ul>
        </div>
        <div class="col-md-10 text-center">
            <?php  get_user_order_details();   
            if(isset($_GET['edit_account'])){
                include('edit_account.php');
            }
            if(isset($_GET['my_orders'])){
                include('user_orders.php');
            }
            if(isset($_GET['delete_account'])){
              include('delete_account.php');
          }
            ?>



            
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