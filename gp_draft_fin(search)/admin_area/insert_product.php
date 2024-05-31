<?php
    include('../includes/connect.php');

    if(isset($_POST['insert_product'])) {
        $product_title = $_POST['product_title'];
        $description = $_POST['description'];
        $product_keyword = $_POST['product_keyword'];
        $product_category = $_POST['product_category'];
        $product_platfrom = $_POST['product_platfrom']; // corrected variable name
        $product_price = $_POST['product_price'];
        $product_status = 'true';

        // accessing images
        $product_image1 = $_FILES['product_image1']['name']; // corrected superglobal name
        $product_image2 = $_FILES['product_image2']['name']; // corrected superglobal name
        $product_image3 = $_FILES['product_image3']['name']; // corrected superglobal name

        // accessing images temp name
        $temp_image1 = $_FILES['product_image1']['tmp_name']; // corrected superglobal name
        $temp_image2 = $_FILES['product_image2']['tmp_name']; // corrected superglobal name
        $temp_image3 = $_FILES['product_image3']['tmp_name']; // corrected superglobal name

        // check for empty condition
        if($product_title == '' or $description == '' or $product_keyword == '' or $product_category == '' or $product_platfrom == '' or $product_price == '' or $product_image1 == '' or $product_image2 == '' or $product_image3 == '') {
            echo "<script>alert('Please fill in all the available fields')</script>";
            exit();
        } else {
            move_uploaded_file($temp_image1, "./product_images/$product_image1");
            move_uploaded_file($temp_image2, "./product_images/$product_image2");
            move_uploaded_file($temp_image3, "./product_images/$product_image3");

            // insert query
            $insert_products = "INSERT INTO products (product_title, product_description, product_keywords, category_id, platfrom_id, product_image1, product_image2, product_image3, product_price, date, status) VALUES ('$product_title', '$description', '$product_keyword', '$product_category', '$product_platfrom', '$product_image1', '$product_image2', '$product_image3', '$product_price', NOW(), '$product_status')";
            $result_query = mysqli_query($con, $insert_products);
            if($result_query) {
                echo "<script>alert('Successfully inserted the product')</script>";
            } else {
                echo "<script>alert('Error occurred while inserting the product')</script>";
            }
        }
    }
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>insert product-admin dashbord</title>

    <!-- bootstrap css link  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- bootstrap css link  -->

    <!-- font awsome link  -->
    <script src="https://kit.fontawesome.com/f139cdc8d9.js" crossorigin="anonymous"></script>
    <!-- font awsome link  -->

    <!-- CSS file link  -->
    <link rel="stylesheet" href="../style.css">
    <!-- CSS file link  -->

</head>
<body class="bg-light">
    <div class="container mt-3">
        <h1 class="text-center">insert products</h1>
        <!-- insert product form -->
        <form action="" method="post" enctype="multipart/form-data">
            <!-- title -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_title" class="form-label">Product title</label>
                <input type="text" name="product_title" id="product_title" class="form-control" placeholder="Enter product title" autocomplete="off" required="required"></input>
            </div>

            <!-- description -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="description" class="form-label">product description</label>
                <input type="text" name="description" id="description" class="form-control" placeholder="Enter product description" autocomplete="off" required="required"></input>
            </div>

             <!-- keyword -->
             <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_keyword" class="form-label">keyword</label>
                <input type="text" name="product_keyword" id="product_keyword" class="form-control" placeholder="Enter keyword" autocomplete="off" required="required"></input>
            </div>

            <!-- categories -->
            <div class="form-outline mb-4 w-50 m-auto">
                <select name="product_category" id="" class="form-select">
                    <option value="">Select a category</option>
                    <?php
                     $select_query = "SELECT * FROM categories"; // Removed single quotes around table name
                     $result_query = mysqli_query($con, $select_query);
                     while ($row = mysqli_fetch_assoc($result_query)) {
                     $category_title = $row['category_title'];
        $category_id = $row['category_id'];
        echo "<option value='$category_id'>$category_title</option>"; // Added $category_id to the value attribute
    }
                    ?>


                    
                </select>
            </div>

            <!-- platfrom -->
            <div class="form-outline mb-4 w-50 m-auto">
                <select name="product_platfrom" id="" class="form-select">
                <option value="">Select a platfrom</option>
                <?php
                     $select_query = "SELECT * FROM platfrom"; // Removed single quotes around table name
                     $result_query = mysqli_query($con, $select_query);
                     while ($row = mysqli_fetch_assoc($result_query)) {
                     $platfrom_title = $row['platfrom_title'];
        $platfrom_id = $row['platfrom_id'];
        echo "<option value='$platfrom_id'>$platfrom_title</option>"; // Added $category_id to the value attribute
    }
                    ?>
                </select>
            </div>

            <!-- image 1 -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image1" class="form-label">product image 1</label>
                <input type="file" name="product_image1" id="product_image1" class="form-control" required="required"></input>
            </div>

             <!-- image 2 -->
             <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image2" class="form-label">product image 2</label>
                <input type="file" name="product_image2" id="product_image2" class="form-control" required="required"></input>
            </div>

            <!-- image 3 -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image3" class="form-label">product image 3</label>
                <input type="file" name="product_image3" id="product_image3" class="form-control" required="required"></input>
            </div>

             <!-- price -->
             <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_price" class="form-label">Enter product price</label>
                <input type="text" name="product_price" id="product_price" class="form-control" placeholder="Enter price" autocomplete="off" required="required"></input>
            </div>

            <!-- submite btn -->
            <div class="form-outline mb-4 w-50 m-auto">
                <input type="submit" name="insert_product" class="btn btn-info mb-3 px-3" value="Insert Products"></input>
            </div>



        </form>
    </div>
    
</body>
</html>