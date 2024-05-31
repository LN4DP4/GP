<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
    <!-- Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Bootstrap CSS link -->

    <!-- Font Awesome link -->
    <script src="https://kit.fontawesome.com/f139cdc8d9.js" crossorigin="anonymous"></script>
    <!-- Font Awesome link -->

    <style>
        body {
            overflow: hidden;
        }
    </style>
</head>
<body>
    <div class="container-fluid m-3">
        <h2 class="text-center mb-5">Admin Registration</h2>
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-lg-6">
                <form action="" method="post">
                    <div class="form-outline mb-4">
                        <label for="admin_name" class="form-label">Username</label>
                        <input type="text" id="admin_name" name="admin_name" placeholder="Enter your username" required="required" class="form-control">
                    </div>
                    <div class="form-outline mb-4">
                        <label for="admin_email" class="form-label">Email</label>
                        <input type="email" id="admin_email" name="admin_email" placeholder="Enter your email" required="required" class="form-control">
                    </div>
                    <div class="form-outline mb-4">
                        <label for="admin_password" class="form-label">Password</label>
                        <input type="password" id="admin_password" name="admin_password" placeholder="Enter your password" required="required" class="form-control">
                    </div>
                    <div class="form-outline mb-4">
                        <label for="conf_admin_password" class="form-label">Confirm Password</label>
                        <input type="password" id="conf_admin_password" name="conf_admin_password" placeholder="Confirm your password" required="required" class="form-control">
                    </div>
                    <div>
                        <input type="submit" class="bg-info py-2 px-3 border-0" name="admin_register" value="Register">
                        <p class="small">Don't have an account? <a href="admin_login.php">Login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>


<?php
// Establish the database connection
$con = mysqli_connect("localhost", "root", "", "mystore");

// Check if the connection was successful
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['admin_register'])) {
    // Check if all required fields are set
    if (!isset($_POST['admin_name'], $_POST['admin_email'], $_POST['admin_password'], $_POST['conf_admin_password'])) {
        die("Please fill all the required fields");
    }

    $admin_name = $_POST['admin_name'];
    $admin_email = $_POST['admin_email'];
    $admin_password = $_POST['admin_password'];
    $conf_admin_password = $_POST['conf_admin_password'];

    // Check if passwords match
    if ($admin_password !== $conf_admin_password) {
        die("Passwords do not match");
    }

    $hash_password = password_hash($admin_password, PASSWORD_DEFAULT);

    // Select query to check if username or email already exists
    $select_query = "SELECT * FROM admin_table WHERE admin_name='$admin_name' OR admin_email='$admin_email'";
    $result = mysqli_query($con, $select_query);

    // Check if query execution was successful
    if (!$result) {
        die("Error: " . mysqli_error($con));
    }

    $rows_count = mysqli_num_rows($result);

    // Check if username or email already exists
    if ($rows_count > 0) {
        die("Username or email are taken");
    }

    // Insert query
    $insert_query = "INSERT INTO admin_table (admin_name, admin_email, password) VALUES ('$admin_name', '$admin_email', '$hash_password')";
    $sql_execute = mysqli_query($con, $insert_query);

    // Check if query execution was successful
    if ($sql_execute) {
        echo "<script>alert('Data inserted successfully')</script>";
    } else {
        die("Error: " . mysqli_error($con));
    }
}

// Close the database connection
mysqli_close($con);
?>

