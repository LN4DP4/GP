<?php


if (isset($_GET['edit_account'])) {
    if (isset($_SESSION['username'])) {
        $user_session_name = $_SESSION['username'];
    } else {
        die("Error: Username not set in session.");
    }

    // Corrected the SQL query syntax
    $select_query = "SELECT * FROM `user_table` WHERE username='$user_session_name'";
    $result_query = mysqli_query($con, $select_query);

    if (!$result_query) {
        die("Query Failed: " . mysqli_error($con));
    }

    $row_fetch = mysqli_fetch_assoc($result_query);

    if ($row_fetch) {
        $user_id = $row_fetch['user_id'];
        $username = $row_fetch['username'];
        $user_email = $row_fetch['user_email'];
        $user_address = $row_fetch['user_address'];
        $user_mobile = $row_fetch['user_mobile'];
        $user_image = isset($row_fetch['user_image']) ? $row_fetch['user_image'] : '';

        if (isset($_POST['user_update'])) {
            $update_id = $user_id;
            $username = $_POST['user_username'];
            $user_email = $_POST['user_email'];
            $user_address = $_POST['user_address'];
            $user_mobile = $_POST['user_mobile'];
            $user_image_new = $_FILES['user_image']['name'];
            $user_image_tmp = $_FILES['user_image']['tmp_name']; // Corrected the key from 'tmp' to 'tmp_name'

            if (!empty($user_image_new)) {
                move_uploaded_file($user_image_tmp, "./user_images/$user_image_new");
                $user_image = $user_image_new;
            }

            // Update query
            $update_data = "UPDATE `user_table` SET username='$username', user_email='$user_email', user_image='$user_image', user_address='$user_address', user_mobile='$user_mobile' WHERE user_id=$update_id";
            $result_query_update = mysqli_query($con, $update_data);

            if ($result_query_update) {
                echo "<script>alert('Data updated successfully')</script>";
                echo "<script>window.open('logout.php', '_self')</script>";
            } else {
                die("Update Query Failed: " . mysqli_error($con));
            }
        }
    } else {
        die("Error: User not found.");
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit account</title>
</head>
<body>
    <h3 class="text-center mb-4">edit account</h3>
    <form action="" method="post" enctype="multipart/form-date" class="text-center">
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" value="<?php echo $username    ?>" name="user_username">
        </div>
        <div class="form-outline mb-4">
            <input type="email" class="form-control w-50 m-auto" name="user_email" value="<?php echo $user_email    ?>">
        </div>
        <div class="form-outline mb-4 d-flex w-50 m-auto">
            <input type="file" class="form-control w-50 m-auto" name="user_image">
            <img src="./user_images/ <?php echo $user_image?>" alt="" class="edit_image">
        </div>
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" name="user_address" value="<?php echo $user_address    ?>">
        </div>
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" name="user_mobile" value="<?php echo $user_mobile    ?>">
        </div>

        <input type="submit" value="Update" class="bg-info py-2 px-3 border-0" name="user_update">
    </form>
</body>
</html>