<!-- connect file -->
<?php
include('includes/connect.php');
include('functions/common_function.php');
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cart detials</title>
    <!-- bootstrap css link  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- bootstrap css link  -->

    <!-- font awsome link  -->
    <script src="https://kit.fontawesome.com/f139cdc8d9.js" crossorigin="anonymous"></script>
    <!-- font awsome link  -->

    <!-- CSS file link  -->
    <link rel="stylesheet" href="sytle.css">
    <!-- CSS file link  -->

    <style>
      .cart_img{
  width: 50px;
  height: 50px;
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
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="diaplay_all.php">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./users_area/user_registration.php">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping"></i><?php cart_item(); ?></a> <!--- call cart function --->
        </li>
        
      </ul>
      

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

    <!-- fourth child-table -->
    <div class="container">
        <div class="row">
          <form action="" method="post">
            <table class="table table-bordered text-center">
                

                  <!-- php code to fetch item data for cart section -->
                  <?php
    global $con; 
    $get_ip_add = getIPAddress();  
    $total = 0;
    $cart_query = "SELECT * FROM cart_details WHERE ip_address='$get_ip_add'";
    $result = mysqli_query($con, $cart_query);
    $result_count=mysqli_num_rows($result);
    if($result_count>0){
      echo "<thead>
      <tr>
          <th>product title</th>
          <th>product image</th>
          <th>quantity</th>
          <th>total price</th>
          <th>remove</th>
          <th colspan='2'>operations</th>
      </tr>
  </thead>
  <tbody>";
    
    while ($row = mysqli_fetch_array($result)) {
        $product_id = $row['product_id'];
        $select_products = "SELECT * FROM products WHERE product_id='$product_id'";
        $result_products = mysqli_query($con, $select_products);
        while ($row_product_price = mysqli_fetch_array($result_products)) {
            $product_price = $row_product_price['product_price'];
            $product_title = $row_product_price['product_title'];
            $product_image1 = $row_product_price['product_image1'];
            $total += $product_price;
?>
            <tr>
                <td><?php echo $product_title; ?></td>
                <td><img src="./product_image/<?php echo $product_image1; ?>" alt="" class="cart_img"></td>  <!-- img not working :( ) -->
                <td><input type="text" name="qty" id="" class="form-input w-50"></td>

                 <!-- can only update quantiy if one item is in the cart, if there are more than one you get an error  -->
                <?php

                          $get_ip_add = getIPAddress();

                           if(isset($_POST['update_cart'])){

                               $quantities=$_POST['qty'];

                               $update_cart = "UPDATE `cart_details` SET quantity=$quantities WHERE ip_address='$get_ip_add'";

                               $result_products_quantity=mysqli_query($con, $update_cart);

                               $total=$total;

                               $total=$total*$quantities;

                               

                           }

                          ?>
                          <!-- can only update quantiy if one item is in the cart, if there are more than one you get an error  -->




                <td><?php echo $product_price; ?></td>
                <td><input type="checkbox" name="removeitem[]" value="<?php echo $product_id ?>"></td>
                <td>
                   <!-- <button class="bg-info px-3 py-2 border-0 mx-3">update</button> -->
                   <input type="submit" value="Update Cart" class="bg-info px-3 py-2 border-0 mx-3" name="update_cart">
                    <!-- <button class="bg-info px-3 py-2 border-0 mx-3">remove</button> -->
                    <input type="submit" value="remove Cart" class="bg-info px-3 py-2 border-0 mx-3" name="remove_cart">
                </td>
            </tr>
<?php
        }
    }
  }
  else{
    echo "<h2 class='text-center'>Cart is empty</h2>";
  }
?>
                </tbody>
            </table>

            <!-- subtotal -->
            <div class="d-flex mb-5">
            <?php
$get_ip_add = getIPAddress(); // Assuming getIPAddress() is defined elsewhere
$cart_query = "SELECT * FROM cart_details WHERE ip_address='$get_ip_add'";
$result = mysqli_query($con, $cart_query);
$result_count = mysqli_num_rows($result);

if ($result_count > 0) {
    echo "<h4 class='px-3'>Subtotal: <strong>$total</strong></h4>
          <form method='post'>
            <input type='submit' value='Continue Shopping' class='bg-info px-3 py-2 border-0 mx-3' name='continue_shopping'>
            <button class='bg-secondary p-3 py-2 border-0'><a href='./users_area/checkout.php' class='text-light text-decoration-none'>Checkout</a></button>
          </form>";
} else {
    echo "<form method='post'>
            <input type='submit' value='Continue Shopping' class='bg-info px-3 py-2 border-0 mx-3' name='continue_shopping'>
          </form>";
}

if (isset($_POST['continue_shopping'])) {
    echo "<script>window.open('index.php','_self')</script>";
}
?>

                
            </div>
        </div>
</div>
</form>

<!-- function to remove itemes -->
<?php
function remove_cart_item(){
  global $con;
  if(isset($_POST['remove_cart'])){
    foreach($_POST['removeitem'] as $remove_id){
      echo $remove_id;
      $delete_query="DELETE FROM cart_details WHERE product_id=$remove_id";
      $run_delete=mysqli_query($con,$delete_query);
      if($run_delete){
        echo "<script>window.open('cart.php','_self')</script>";
      }
    }
  }
}
remove_cart_item();
?>


   

    

     



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