<?php
include('../includes/connect.php');
//session_start();

// Ensure the database connection is established
if (!isset($con)) {
    die("Database connection failed.");
}

// Check if username is set in the session
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    die("Error: Username not set in session.");
}

// Get user details from the database
$get_user = "SELECT * FROM `user_table` WHERE username='$username'";
$result = mysqli_query($con, $get_user);

if (!$result) {
    die("Query Failed: " . mysqli_error($con));
}

$row_fetch = mysqli_fetch_assoc($result);

if ($row_fetch) {
    $user_id = $row_fetch['user_id'];
} else {
    die("Error: User not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All My Orders</title>
    <!-- Include Bootstrap CSS for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container my-5">
        <h3 class="text-center">All My Orders</h3>
        <table class="table table-bordered mt-5">
            <thead class="bg-info">
                <tr>
                    <th>Sl No</th>
                    <th>Amount Due</th>
                    <th>Total Products</th>
                    <th>Invoice Number</th>
                    <th>Date</th>
                    <th>Complete/Incomplete</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody class="bg-secondary text-light">
                <?php
                // Get order details from the database
                $get_order_details = "SELECT * FROM `user_orders` WHERE user_id=$user_id";
                $result_orders = mysqli_query($con, $get_order_details);

                if (!$result_orders) {
                    die("Query Failed: " . mysqli_error($con));
                }

                $number = 1;
                while ($row_orders = mysqli_fetch_assoc($result_orders)) {
                    $order_id = $row_orders['order_id'];
                    $amount_due = $row_orders['amount_due'];
                    $total_products = $row_orders['total_products'];
                    $invoice_number = $row_orders['invoice_number'];
                    $order_status = $row_orders['order_status'];
                    $order_status_text = ($order_status == 'pending') ? 'incomplete' : 'complete';
                    $order_date = $row_orders['order_date'];

                    echo "<tr>
                        <td>$number</td>
                        <td>$amount_due</td>
                        <td>$total_products</td>
                        <td>$invoice_number</td>
                        <td>$order_date</td>
                        <td>$order_status_text</td>";

                    if ($order_status_text == 'complete') {
                        echo "<td>paid</td>";
                    } else {
                        echo "<td><a href='confirm_payment.php?order_id=$order_id' '>confirm</a></td>";
                    }

                    echo "</tr>";

                    $number++;
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
