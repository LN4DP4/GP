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
@session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user login</title>
     <!-- bootstrap css link  -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- bootstrap css link  -->

    <!-- remover scroll bar  -->
    <style> 
        body{
            overflow-x:hidden 
        }
    </style>

</head>
<body>
    <div class="container-fluid my-3">
        <h2 class="text-center">user login</h2>
        <div class="row d-flex align-items-center justify-content-center mt-5">
            <div class="col-lg-12 col-xl-6">
                <form action="" method="post" >
                    <div class="form-outline mb-4">
                        <!-- username  -->
                        <lable for="user_username" class="form-lable">username</lable>
                        <input type="text" id="user_username" class="form-control" placeholder="Enter your username" autocomplete="off" required="required" name="user_username"/>
                    </div>
                  
                   
                    <!-- password  -->
                    <div class="form-outline mb-4">
                        <lable for="user_password" class="form-lable">password</lable>
                        <input type="password" id="user_password" class="form-control" placeholder="Enter your password" autocomplete="off" required="required" name="user_password"/>
                    </div>
                    
                    
                    <div class="mt-4 pt-2">
                        <input type="submit" value="Login" class="bg-info py-2 px-3 border-0" name="user_login">
                        <P class="small fw-bold mt-2 pt-1">dont have an account ? <a href="user_registration.php"> Register</a></p>
                    </div>
                </form>

            </div>
        </div>
    </div>
    
</body>
</html>

<?php
if(isset($_POST['user_login'])){
    $user_username = $_POST['user_username'];
    $user_password = $_POST['user_password'];
    
    // Select query
    $select_query = "SELECT * FROM user_table WHERE username='$user_username'";
    $result = mysqli_query($con, $select_query);
    $row_count = mysqli_num_rows($result);
    $user_ip=getIPAddress();

    // cart item 
    $select_query_cart = "SELECT * FROM cart_details WHERE ip_address='$user_ip'";
    $select_cart=mysqli_query($con,$select_query_cart);
    $row_count_cart = mysqli_num_rows($select_cart); // Corrected assignment here
    
    if($row_count > 0){
        $_SESSION['username']=$user_username;
        $row_data = mysqli_fetch_assoc($result);
        // Verify password
        if(password_verify($user_password, $row_data['user_password'])){
            //echo "<script>alert('Login successful')</script>";
            if($row_count==1 and $row_count_cart==0){
                $_SESSION['username']=$user_username;
                echo "<script>alert('Login successful')</script>";
                echo "<script>window.open('profile.php','_self')</script>"; //if cart empty take to profile page
            }else{
                $_SESSION['username']=$user_username;
                echo "<script>alert('Login successful')</script>";
                echo "<script>window.open('payment.php','_self')</script>"; //if item in cart take to payment 
            }
        }else{
            echo "<script>alert('Wrong username or password')</script>";
        }
    }else{
        echo "<script>alert('Wrong username or password')</script>";
    }
}
?>



