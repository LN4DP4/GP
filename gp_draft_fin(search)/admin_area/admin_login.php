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
    <title>admine login</title>
    <!-- bootstrap css link  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- bootstrap css link  -->

    <!-- font awsome link  -->
    <script src="https://kit.fontawesome.com/f139cdc8d9.js" crossorigin="anonymous"></script>
    <!-- font awsome link  -->
    <style>
        body{
            overflow:hidden;
        }
        </style>
</head>
<body>
    <div class="container-fluid m-3">
        <h2 class="text-center mb-5">admine registration</h2>
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-lg-6">
            <form action="" method="post">
                <div class="form-outline mb-4">
                    <label for="admin_name" class="form-label">username</label>
                    <input type="text" id="admin_name" name="admin_name" placeholder="enter your username" required="required" class="form-control">
                </div>
                <div class="form-outline mb-4">
                    <label for="admin_password" class="form-label">password</label>
                    <input type="admin_password" id="admin_password" name="admin_password" placeholder="enter your password" required="required" class="form-control">
                </div>
                <div>
                   <input type="submit" class="bg-info py-2 px-3 border-o" name="admin_login" value="Login">
                   <p class="small">do you already have an account? <a href="admin_registration.php">register</a></p>
                </div>
            </form>
    </div>
        </div>
</div>
</body>
</html>

<?php
if(isset($_POST['admin_login'])){
    $admin_name = $_POST['admin_name'];
    $admin_password = $_POST['admin_password'];
    
    // Select query
    $select_query = "SELECT * FROM admin_table WHERE admin_name='$admin_name'";
    $result = mysqli_query($con, $select_query);
    $row_count = mysqli_num_rows($result);
    //$user_ip=getIPAddress();

    
    if($row_count > 0){
        $_SESSION['admin_name']=$admin_name;
        $row_data = mysqli_fetch_assoc($result);
        // Verify password
        if(password_verify($admin_password, $row_data['admin_password'])){
            //echo "<script>alert('Login successful')</script>";
            if($row_count==1 and $row_count_cart==0){
                $_SESSION['admin_name']=$admin_name;
                echo "<script>alert('Login successful')</script>";
                echo "<script>window.open('index.php?list_users','_self')</script>"; //if cart empty take to profile page
            }else{
                $_SESSION['admin_name']=$admin_name;
                echo "<script>alert('Login successful')</script>";
                echo "<script>window.open('index.php?list_users','_self')</script>"; //if item in cart take to payment 
            }
        }else{
            echo "<script>alert('Wrong username or password')</script>";
        }
    }else{
        echo "<script>alert('Wrong username or password')</script>";
    }
}
?>