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
    <title>Document</title>
    <!-- bootstrap css link  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- bootstrap css link  -->
</head>
<style>
img{
    width:50%;
    margin:auto;
    display:block;
}
    </style>
<body>
    <!-- code for accessing user id  -->
    <?php
    $user_ip=getIPAddress();
    $get_user = "SELECT * FROM user_table WHERE user_ip='$user_ip'";
    $result=mysqli_query($con,$get_user);
    $run_query=mysqli_fetch_array($result);
    $user_id=$run_query['user_id'];

    ?>

    <div class="container">
        <h2 class="text-center text-info">payment options</h2>
        <div class="row d-flex justify-content-center align-items-center my-5">
            <div class="col-md-6">
            <a href="https://www.paypal.com/uk/home"><img src="../images/PayPal.svg.webp" alt=""></a>
            </div>
            <div class="col-md-6">
            <a href="order.php?user_id=<?php echo $user_id ?>"><h2 class="text-center">pay offline</h2></a>
            </div>
        </div>
    </div>
    
</body>

</html>