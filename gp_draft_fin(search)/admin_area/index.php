<?php
include('../includes/connect.php');
include('../functions/common_function.php');

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashbord</title>
    <!-- bootstrap css link  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- bootstrap css link  -->

    <!-- font awsome link  -->
    <script src="https://kit.fontawesome.com/f139cdc8d9.js" crossorigin="anonymous"></script>
    <!-- font awsome link  -->

    <!-- CSS file link  -->
    <link rel="stylesheet" href="../style.css">
    <!-- CSS file link  -->

    <!-- tempory css style  -->
    <style>

.admin_image{
  width: 100px;
  object-fit: contain;
}
.pod_img{
    width: 100px;
    object-fit:contain;
}
    </style>
<!-- tempory css style  -->

</head>
<body>
    <!-- navbar  -->
    <div class="div container-fluid">
        <!-- first child  -->
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <div class="container-fluid">
                <h1>admin area</h1>
                <nav class="navbar navbar-expand-lg">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="" class="nav-link">Welcom Guest</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </nav>

        <!-- second child  -->
        <div class="bg-light">
            <h3 class="text-center p-2">mange details</h3>
        </div>

        <!-- third child  -->
        <div class="row">
            <div class="col-md-12 bg-secondary p-1 d-flex align-items-center">
                <div class="px-5">
                    <a href="#"><img src="../images/imagenotfound.png" alt="" class="admin_image"></a>
                    <p class="text-light text-center">admin name</p>
                </div>

            



                <!-- each href use a get request to display code on index.html  -->
                <div class="button text-center">
                    <a type="button" class="btn btn-large btn-info" href="insert_product.php">Insert product</a>
                    <a type="button" class="btn btn-large btn-info" href="index.php?view_products">View products</a>
                    <a type="button" class="btn btn-large btn-info" href="index.php?insert_category">Insert categories</a>
                    <a type="button" class="btn btn-large btn-info" href="index.php?view_categories">View categories</a>
                    <a type="button" class="btn btn-large btn-info" href="index.php?insert_platfrom">insert platform</a>
                    <a type="button" class="btn btn-large btn-info" href="index.php?view_platfrom">view platform</a>
                    <a type="button" class="btn btn-large btn-info" href="index.php?list_orders">all orders</a>
                    <a type="button" class="btn btn-large btn-info" href="index.php?list_payments">all payments</a>
                    <a type="button" class="btn btn-large btn-info" href="index.php?list_users">list user</a>
                    <a type="button" class="btn btn-large btn-info" href="">logout</a>
                </div>
            </div>
        </div>
    </div>


    <!-- fourth child  -->
    <!-- uses GET request to display html file on the admin panle  -->
    <div class="container my-3">
                    <?php 
                    if(isset($_GET['insert_category'])){
                        include('insert_categories.php');
                    }
                    if(isset($_GET['insert_platfrom'])){
                        include('insert_platfrom.php');
                    }
                    if(isset($_GET['view_products'])){
                        include('view_products.php');
                    }
                    if(isset($_GET['edit_products'])){
                        include('edit_products.php');
                    }
                    if(isset($_GET['delete_product'])){
                        include('delete_product.php');
                    }
                    if(isset($_GET['view_categories'])){
                        include('view_categories.php');
                    }
                    if(isset($_GET['view_platfrom'])){
                        include('view_platfrom.php');
                    }
                    if(isset($_GET['edit_category'])){
                        include('edit_category.php');
                    }
                    if(isset($_GET['edit_platfrom'])){
                        include('edit_platfrom.php');
                    }
                    if(isset($_GET['delete_category'])){
                        include('delete_category.php');
                    }
                    if(isset($_GET['delete_platfrom'])){
                        include('delete_platfrom.php');
                    }
                    if(isset($_GET['list_orders'])){
                        include('list_orders.php');
                    }
                    if(isset($_GET['list_payments'])){
                        include('list_payments.php');
                    }
                    if(isset($_GET['list_users'])){
                        include('list_users.php');
                    }
                    ?>
                </div>



  
    
</body>

<!-- bootstrap js link  -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<!-- bootstrap js link  -->

</html>