 <!-- bootstrap css link  -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- bootstrap css link  -->

    <!-- font awsome link  -->
    <script src="https://kit.fontawesome.com/f139cdc8d9.js" crossorigin="anonymous"></script>
    <!-- font awsome link  -->

    <!-- CSS file link  -->
    <link rel="stylesheet" href="../style.css">
    <!-- CSS file link  -->
<h3 class="text-center">all stock</h3>
<table class="table table-bordered mt-5">
<thead class="bg-info">
    <tr>
        <th>product id</th>
        <th>product title</th>
        <th>product image</th>
        <th>product price</th>
        <th>total sold</th>
        <th>status</th>
        <th>edit</th>
        <th>delete</th>
    </tr>
</thead>
<tbody class="bg-secondary text-light">
<?php
$get_products="SELECT * FROM `products`";
$result=mysqli_query($con,$get_products);
$number=0;
if (!$result) {
    die('Query Failed: ' . mysqli_error($con));
}
while($row=mysqli_fetch_assoc($result)){
    $product_id=$row['product_id'];
    $product_title=$row['product_title'];
    $product_image1=$row['product_image1'];
    $product_price=$row['product_price'];
    $status=$row['status'];
    $number++;
    ?>
    
    <tr class='text-center'>
        <td><?php echo $number; ?></td>
        <td><?php echo $product_title; ?></td>
        <td><img src='./product_images/<?php echo $product_image1;?>' class='pod_img'/></td>
        <td><?php echo $product_price;?></td>
        <td><?php 
    $get_count = "SELECT * FROM `orders_pending` WHERE product_id = $product_id";
    $result_count = mysqli_query($con, $get_count);
    if (!$result_count) {
        die('Query Failed: ' . mysqli_error($con));
    }
    $rows_count = mysqli_num_rows($result_count);
    echo $rows_count;
?></td>

        <td><?php echo $status;?></td>
        <td><a href='index.php?edit_products=<?php echo $product_id; ?>'><i class='fa-solid fa-pen-to-square'></i></a></td>
        <td><a href='index.php?delete_product=<?php echo $product_id; ?>'><i class='fa-solid fa-trash'></i></td>

    </tr>
    <?php
}
?>

    
</tbody>
</table>