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

// Ensure user_id is set in the GET request
if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    echo $user_id;
} else {
    die("Error: user_id is not set.");
}

// Getting total items and total price of all items
$get_ip_address = getIPAddress();
$total_price = 0;
$cart_query_price = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_address'";
$result_cart_price = mysqli_query($con, $cart_query_price);

if (!$result_cart_price) {
    die("Query Failed: " . mysqli_error($con));
}

$invoice_number = mt_rand();
$status = 'pending';
$count_products = mysqli_num_rows($result_cart_price);

while ($row_price = mysqli_fetch_assoc($result_cart_price)) {
    $product_id = $row_price['product_id'];
    $quantity = isset($row_price['quantity']) && $row_price['quantity'] > 0 ? $row_price['quantity'] : 1; // Ensure quantity is at least 1

    $select_product = "SELECT * FROM `products` WHERE product_id=$product_id";
    $run_price = mysqli_query($con, $select_product);

    if (!$run_price) {
        die("Query Failed: " . mysqli_error($con));
    }

    while ($row_product_price = mysqli_fetch_assoc($run_price)) {
        $product_price = $row_product_price['product_price'];
        $total_price += $product_price * $quantity; // Calculate total price based on quantity
    }
}

$subtotal = $total_price;

// Insert order into user_orders table
$insert_orders = "INSERT INTO `user_orders` (user_id, amount_due, invoice_number, total_products, order_date, order_status) 
                  VALUES ('$user_id', '$subtotal', '$invoice_number', '$count_products', NOW(), '$status')";
$result_query = mysqli_query($con, $insert_orders);
if ($result_query) {
    echo "<script>alert('Orders are submitted successfully')</script>";
    echo "<script>window.open('profile.php', '_self')</script>";
} else {
    die("Query Failed: " . mysqli_error($con));
}

// Insert pending orders into orders_pending table for each product in the cart
mysqli_data_seek($result_cart_price, 0); // Reset the result pointer to the start
while ($row_price = mysqli_fetch_assoc($result_cart_price)) {
    $product_id = $row_price['product_id'];
    $quantity = isset($row_price['quantity']) && $row_price['quantity'] > 0 ? $row_price['quantity'] : 1; // Ensure quantity is at least 1

    $insert_pending_orders = "INSERT INTO `orders_pending` (user_id, invoice_number, product_id, quantity, order_status) 
                              VALUES ('$user_id', '$invoice_number', '$product_id', '$quantity', '$status')";
    $result_pending_orders = mysqli_query($con, $insert_pending_orders);

    if (!$result_pending_orders) {
        die("Query Failed: " . mysqli_error($con));
    }
}

// Delete items from cart after payment
$empty_cart = "DELETE FROM `cart_details` WHERE ip_address='$get_ip_address'";
$result_delete = mysqli_query($con, $empty_cart);

if (!$result_delete) {
    die("Query Failed: " . mysqli_error($con));
}
?>
