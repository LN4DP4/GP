<?php
if(isset($_GET['edit_products'])){
    $edit_id = $_GET['edit_products'];

    $get_data = "SELECT * FROM `products` WHERE product_id = $edit_id";
    $result = mysqli_query($con, $get_data);

    if (!$result) {
        die('Query Failed: ' . mysqli_error($con));
    }

    $row = mysqli_fetch_assoc($result);

    $product_title = $row['product_title'];
    //echo $product_title;
    $product_description = $row['product_description'];
    $product_keywords = $row['product_keywords'];
    $category_id = $row['category_id'];
    $platfrom_id = $row['platfrom_id'];
    $product_image1 = $row['product_image1'];
    $product_image2 = $row['product_image2'];
    $product_image3 = $row['product_image3'];
    $product_price = $row['product_price'];

    //fetching category name (its 3am i need to sleep)
    $select_category = "SELECT * FROM `categories` WHERE category_id = $category_id";
    $result_category = mysqli_query($con, $select_category);
    $row_category = mysqli_fetch_assoc($result_category);
    $category_title = $row_category['category_title'];
    //echo $category_title;

    //fetching platfrom name 
    $select_platfrom = "SELECT * FROM `platfrom` WHERE platfrom_id = $platfrom_id";
    $result_platfrom = mysqli_query($con, $select_platfrom);
    $row_platfrom = mysqli_fetch_assoc($result_platfrom);
    $platfrom_title = $row_platfrom['platfrom_title'];
    //echo $platfrom_title;
}
?>



<div class="container mt-5">
    <h1 class="text-center">edit products</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_title" class="form-label">product title</label>
            <input type="text" id="product_title" value="<?php echo $product_title?>" name="product_title" class="form-control" required="required">
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_desc" class="form-label">product description</label>
            <input type="text" id="product_desc" name="product_desc" value="<?php echo $product_description?>" class="form-control" required="required">
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_keywords" class="form-label">product keywords</label>
            <input type="text" id="product_keywords" name="product_keywords" value="<?php echo $product_keywords?>" class="form-control" required="required">
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <select name="product_category" class="form-select">
            <label for="product_category" class="form-label">product category</label>
            <option value="<?php echo $category_title?>"><?php echo $category_title?></option>
            <?php
            $select_category_all = "SELECT * FROM `categories`";
            $result_category_all = mysqli_query($con, $select_category_all);
            while($row_category_all = mysqli_fetch_assoc($result_category_all)){
                $category_title=$row_category_all['category_title'];
                $category_id=$row_category_all['category_id'];
                echo "<option value='$category_id'>$category_title</option>";
            };
            

?>
            
            </select>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <select name="product_platfrom" class="form-select">
            <label for="product_platfrom" class="form-label">product platfrom</label>
            <option value="<?php echo $platfrom_title?>"><?php echo $platfrom_title?></option>
            <?php
            $select_platfrom_all = "SELECT * FROM `platfrom`";
            $result_platfrom_all = mysqli_query($con, $select_platfrom_all);
            while($row_platfrom_all = mysqli_fetch_assoc($result_platfrom_all)){
                $platfrom_title=$row_platfrom_all['platfrom_title'];
                $platfrom_id=$row_platfrom_all['platfrom_id'];
                echo "<option value='$platfrom_id'>$platfrom_title</option>";
            };
            

?>
            </select>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_image1" class="form-label">product image1</label>
            <div class="d-flex">
            <input type="file" id="product_image1" name="product_image1" class="form-control w-90 m-auto" required="required">
            <img src="./product_images/<?php echo $product_image1?>" alt="" class="pod_img">
            </div>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_image2" class="form-label">product image2</label>
            <div class="d-flex">
            <input type="file" id="product_image2" name="product_image2" class="form-control w-90 m-auto" required="required">
            <img src="./product_images/<?php echo $product_image2?>" alt="" class="pod_img">
            </div>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_image3" class="form-label">product image3</label>
            <div class="d-flex">
            <input type="file" id="product_image3" name="product_image3" class="form-control w-90 m-auto" required="required">
            <img src="./product_images/<?php echo $product_image3?>" alt="" class="pod_img">
            </div>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_price" class="form-label">product price</label>
            <input type="text" id="product_price" name="product_price" class="form-control" required="required" value="<?php echo $product_price?>">
        </div>
        <div class="text-center">
            <input type="submit" name="edit_product" value="confirm edit" class="btn btn-info px-3 mb-3">
        </div>
    </form>
</div>



<!-- logic for editing products -->
<?php

if(isset($_POST['edit_product'])){
    $product_title = $_POST['product_title'];
    $product_desc = $_POST['product_desc'];
    $product_keywords = $_POST['product_keywords'];
    $product_category = $_POST['product_category'];
    $product_platfrom = isset($_POST['product_platfrom']) ? $_POST['product_platfrom'] : ''; // Check if product_platfrom is set
    $product_price = $_POST['product_price'];

    $product_image1 = $_FILES['product_image1']['name'];
    $product_image2 = $_FILES['product_image2']['name'];
    $product_image3 = $_FILES['product_image3']['name'];

    $temp_image1 = $_FILES['product_image1']['tmp_name'];
    $temp_image2 = $_FILES['product_image2']['tmp_name'];
    $temp_image3 = $_FILES['product_image3']['tmp_name'];

    // Check if fields are empty
    if($product_title == '' or $product_desc == "" or $product_keywords == '' or $product_category == '' or $product_platfrom == '' or $product_image1 == '' or $product_image2 == '' or $product_image3 == '' or $product_price == ''){
        echo "<script>alert('Please fill in all of the fields');</script>";
    } else {
        move_uploaded_file($temp_image1, "./product_images/$product_image1");
        move_uploaded_file($temp_image2, "./product_images/$product_image2");
        move_uploaded_file($temp_image3, "./product_images/$product_image3");

        // Updating products 
        $update_product = "UPDATE `products` SET product_title='$product_title', product_description='$product_desc', product_keywords='$product_keywords',
            category_id='$product_category', platfrom_id='$product_platfrom', product_image1='$product_image1', product_image2='$product_image2', product_image3='$product_image3',
            product_price='$product_price', date=NOW() WHERE product_id=$edit_id";
        $result_update = mysqli_query($con, $update_product);
        if($result_update){
            echo "<script>alert('Product updated :)');</script>";
            echo "<script>window.open('./insert_product.php','_self');</script>";
        }
    }
}

?>                                              


