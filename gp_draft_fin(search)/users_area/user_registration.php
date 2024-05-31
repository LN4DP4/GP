<?php
// Include connect.php with proper error handling
$connect_path = '../includes/connect.php';
if (file_exists($connect_path)) {
    include $connect_path;
} else {
    die("Error: The file $connect_path does not exist.");
}

// Include common_function.php if needed
include('../functions/common_function.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user registration</title>
     <!-- bootstrap css link  -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- bootstrap css link  -->

</head>
<body>
    <div class="container-fluid my-3">
        <h2 class="text-center">New User Registration</h2>
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-12 col-xl-6">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-outline mb-4">
                        <!-- username  -->
                        <lable for="user_username" class="form-lable">username</lable>
                        <input type="text" id="user_username" class="form-control" placeholder="Enter your username" autocomplete="off" required="required" name="user_username"/>
                    </div>
                    <!-- email  -->
                    <div class="form-outline mb-4">
                        <lable for="user_email" class="form-lable">email</lable>
                        <input type="email" id="user_email" class="form-control" placeholder="Enter your email" autocomplete="off" required="required" name="user_email"/>
                    </div>
                    <!-- img  -->
                    <div class="form-outline mb-4">
                        <lable for="user_image" class="form-lable">user image</lable>
                        <input type="file" id="user_image" class="form-control" required="required" name="user_image"/>
                    </div>
                    <!-- password  -->
                    <div class="form-outline mb-4">
                        <lable for="user_password" class="form-lable">password</lable>
                        <input type="password" id="user_password" class="form-control" placeholder="Enter your password" autocomplete="off" required="required" name="user_password"/>
                    </div>
                    <!-- confirm password  -->
                    <div class="form-outline mb-4">
                        <lable for="conf_user_password" class="form-lable">confirm password</lable>
                        <input type="password" id="conf_user_password" class="form-control" placeholder="confirm your password" autocomplete="off" required="required" name="conf_user_password"/>
                    </div>
                    <!-- adress  -->
                    <div class="form-outline mb-4">
                        <lable for="user_address" class="form-lable">address</lable>
                        <input type="text" id="user_address" class="form-control" placeholder="Enter your address" autocomplete="off" required="required" name="user_address"/>
                    </div>
                     <!-- contact  -->
                     <div class="form-outline mb-4">
                        <lable for="user_contact" class="form-lable">contact</lable>
                        <input type="text" id="user_contact" class="form-control" placeholder="Enter your mobile number" autocomplete="off" required="required" name="user_contact"/>
                    </div>
                    <div class="mt-4 pt-2">
                        <input type="submit" value="register" class="bg-info py-2 px-3 border-0" name="user_register">
                        <P class="small fw-bold mt-2 pt-1">If you already have an account ? <a href="user_login.php"> Login</a></p>
                    </div>
                </form>

            </div>
        </div>
    </div>
    
</body>
</html>

  <!-- php code  -->
  <?php
if(isset($_POST['user_register'])){
    $user_username = $_POST['user_username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $hash_password=password_hash($user_password,PASSWORD_DEFAULT);
    $conf_user_password = $_POST['conf_user_password'];
    $user_address = $_POST['user_address'];
    $user_contact = $_POST['user_contact'];
    $user_image = $_FILES['user_image']['name'];
    $user_image_tmp = $_FILES['user_image']['tmp_name'];
    $user_ip = getIPAddress();

    // Select query to check if username or email already exists
    $select_query = "SELECT * FROM user_table WHERE username='$user_username' OR user_email='$user_email'";
    $result = mysqli_query($con, $select_query);
    $rows_count = mysqli_num_rows($result);
    
    // Check if username or email already exists or passwords do not match
    if($rows_count > 0){
        echo "<script>alert('Username or email are taken')</script>";
    } else if ($user_password !== $conf_user_password){
        echo "<script>alert('Passwords do not match')</script>";
    } else {
        // Insert query
        move_uploaded_file($user_image_tmp, "./user_images/$user_image");
        $insert_query = "INSERT INTO user_table (username, user_email, user_password, user_image, user_ip, user_address, user_mobile) VALUES ('$user_username', '$user_email', '$hash_password', '$user_image', '$user_ip', '$user_address', '$user_contact')";
        $sql_execute = mysqli_query($con, $insert_query);
        if($sql_execute){
            echo "<script>alert('Data inserted successfully')</script>";
        } else {
            die(mysqli_error($con));
        }
    }

    // Selecting cart items
    $select_cart_items = "SELECT * FROM cart_details WHERE ip_address='$user_ip'";
    $result_cart = mysqli_query($con, $select_cart_items);
    $rows_count_cart = mysqli_num_rows($result_cart);
    if($rows_count_cart > 0){
        $_SESSION['username'] = $user_username;
        echo "<script>alert('You have items in your cart')</script>";
        echo "<script>window.open('checkout.php','_self')</script>";
    } else {
        echo "<script>window.open('../index.php','_self')</script>"; 
    }
}
?>


