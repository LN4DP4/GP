<h3 class="text-center">all orders</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-info">
        <?php
        $get_orders = "SELECT * FROM user_orders"; // Corrected query
        $result = mysqli_query($con, $get_orders);
        $row_count = mysqli_num_rows($result);
        echo "<tr>
            <th>sl no</th>
            <th>due amount</th>
            <th>invoice number</th>
            <th>total products</th>
            <th>order date</th>
            <th>status</th>
            <th>delete</th>
        </tr>
    </thead>
    <tbody class='bg-secondary'>";

if ($row_count == 0) {
    echo "<h2 class='text-center mt-5'>no orders</h2>"; // Added missing semicolon
} else {
    $number = 0;
    while ($row_data = mysqli_fetch_assoc($result)) {
        $order_id = $row_data['order_id'];
        $user_id = $row_data['user_id'];
        $amount_due = $row_data['amount_due'];
        $invoice_number = $row_data['invoice_number'];
        $total_products = $row_data['total_products'];
        $order_date = $row_data['order_date'];
        $order_status = $row_data['order_status'];
        $number++;
        echo "<tr>
            <td>$number</td>
            <td>$amount_due</td>
            <td>$invoice_number</td>
            <td>$total_products</td>
            <td>$order_date</td>
            <td>$order_status</td>
            <td><a href='' class='text-center'><i class='fa-solid fa-trash'></i></a></td>
        </tr>";
    }
}
?>
    </tbody>
</table>
