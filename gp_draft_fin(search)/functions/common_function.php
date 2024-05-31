<?php
// Include the connection file
//include('./includes/connect.php');

// Function to get products
function getProducts() {
    global $con;

    $select_query = "SELECT * FROM `products`";
    
    // Check if category or platform is set in the URL
    if(isset($_GET['category'])) {
        $category_id = $_GET['category'];
        $select_query .= " WHERE `category_id` = $category_id";
    } elseif(isset($_GET['platfrom'])) {
        $platfrom_id = $_GET['platfrom'];
        $select_query .= " WHERE `platfrom_id` = $platfrom_id";
    }

    // Add order by and limit clause
    $select_query .= " ORDER BY RAND() LIMIT 9";

    // Execute the query
    $result_query = mysqli_query($con, $select_query);

    // Check if query executed successfully
    if ($result_query) {
        // Loop through each row in the result set
        while ($row = mysqli_fetch_assoc($result_query)) {
            $product_id=$row['product_id'];  //if code not working remove this line 
                        // Output HTML for each product
            echo "<div class='col-md-4 mb-2'>
                <div class='card'>
                    <img src='./admin_area/product_images/{$row['product_image1']}' class='card-img-top' alt='{$row['product_title']}'>
                    <div class='card-body'>
                        <h5 class='card-title'>{$row['product_title']}</h5>
                        <p class='card-text'>{$row['product_description']}</p>
                        <p class='card-text'>price: {$row['product_price']}/-</p>
                        <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
                        <a href='productPage.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
                    </div>
                </div>
            </div>";
        }
    } else {
        // Output error if query fails
        echo "Error executing query: " . mysqli_error($con);
    }
}




//getting all products 
function get_all_products(){
    global $con;

    $select_query = "SELECT * FROM `products`";
    
    // Check if category or platform is set in the URL
    if(isset($_GET['category'])) {
        $category_id = $_GET['category'];
        $select_query .= " WHERE `category_id` = $category_id";
    } elseif(isset($_GET['platfrom'])) {
        $platfrom_id = $_GET['platfrom'];
        $select_query .= " WHERE `platfrom_id` = $platfrom_id";
    }

    // Add order by and limit clause
    $select_query .= " ORDER BY RAND()"; //no limite so we can display all products 

    // Execute the query
    $result_query = mysqli_query($con, $select_query);

    // Check if query executed successfully
    if ($result_query) {
        // Loop through each row in the result set
        while ($row = mysqli_fetch_assoc($result_query)) {
            $product_id=$row['product_id'];
            // Output HTML for each product
            echo "<div class='col-md-4 mb-2'>
                <div class='card'>
                    <img src='./admin_area/product_images/{$row['product_image1']}' class='card-img-top' alt='{$row['product_title']}'>
                    <div class='card-body'>
                        <h5 class='card-title'>{$row['product_title']}</h5>
                        <p class='card-text'>{$row['product_description']}</p>
                        <p class='card-text'>price: {$row['product_price']}/-</p>
                        <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
                        <a href='pruductPage.php' class='btn btn-secondary'>View more</a>
                    </div>
                </div>
            </div>";
        }
    } else {
        // Output error if query fails
        echo "Error executing query: " . mysqli_error($con);
    }
}




// Function to display platforms in sidebar
function getPlatfrom() {
    global $con;
    $select_platfrom = "SELECT * FROM platfrom";
    $result_platfrom = mysqli_query($con, $select_platfrom);
    while ($row_platfrom = mysqli_fetch_assoc($result_platfrom)) {
        echo "<li class='nav-item'>
                <a href='index.php?platfrom={$row_platfrom['platfrom_id']}' class='nav-link text-light'>{$row_platfrom['platfrom_title']}</a>
            </li>";
    }
}

// Function to display categories in sidebar
function getCategories() {
    global $con;
    $select_categories = "SELECT * FROM categories";
    $result_categories = mysqli_query($con, $select_categories);
    while ($row_category = mysqli_fetch_assoc($result_categories)) {
        echo "<li class='nav-item'>
                <a href='index.php?category={$row_category['category_id']}' class='nav-link text-light'>{$row_category['category_title']}</a>
            </li>";
    }
}


//searching products function

function search_product(){
    global $con;
    if(isset($_GET['search_data'])){ // Change 'search_data_product' to 'search_data'
        $search_data_value = mysqli_real_escape_string($con, $_GET['search_data']); // Correct parameter name
        $search_query = "SELECT * FROM products WHERE product_title LIKE '%$search_data_value%'";
        $result_query = mysqli_query($con, $search_query);
        // Check if query executed successfully
        if ($result_query) {
            // Check if there are any rows returned
            $num_of_rows = mysqli_num_rows($result_query); // Count the number of rows
            $num_of_items = "SELECT COUNT(product_id) As NumberOfProducts FROM products";
            if($num_of_rows == 0){
                echo "<h2 class='text-center text-danger'>No match for search term</h2>";
            } else {
                // Loop through each row in the result set
                while ($row = mysqli_fetch_assoc($result_query)) {
                    // Output HTML for each product
                    echo "<div class='col-md-4 mb-2'>
                        <div class='card'>
                            <img src='./admin_area/product_images/{$row['product_image1']}' class='card-img-top' alt='{$row['product_title']}'>
                            <div class='card-body'>
                                <h5 class='card-title'>{$row['product_title']}</h5>
                                <p class='card-text'>{$row['product_description']}</p>
                                <a href='#' class='btn btn-info'>Add to cart</a>
                                <a href='#' class='btn btn-secondary'>View more</a>
                            </div>
                        </div>
                    </div>";
                }
            }
        } else {
            // Output error if query fails
            echo "Error executing query: " . mysqli_error($con);
        } 
    }
}
  

//get ip adress function 
function getIPAddress() {  
    //whether ip is from the share internet  
     if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                $ip = $_SERVER['HTTP_CLIENT_IP'];  
        }  
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
     }  
//whether ip is from the remote address  
    else{  
             $ip = $_SERVER['REMOTE_ADDR'];  
     }  
     return $ip;  
}  
//$ip = getIPAddress();  
//echo 'User Real IP Address - '.$ip;  


// cart function
function cart(){
    if(isset($_GET['add_to_cart'])){
        global $con;
        $get_ip_add = getIPAddress();  
        $get_product_id = $_GET['add_to_cart'];
        $select_query = "SELECT * FROM cart_details WHERE ip_address='$get_ip_add' AND product_id='$get_product_id'"; //fetch all details from card and ip adress (both conditions have to work for it to work)
        $result_query = mysqli_query($con, $select_query);
        $num_of_rows = mysqli_num_rows($result_query);
        if($num_of_rows > 0){
            echo "<script>alert('This item is already in the cart');</script>";
            echo "<script>window.open('index.php','_self');</script>";
        } else {
            $insert_query = "INSERT INTO cart_details (product_id, ip_address, quantity) VALUES ('$get_product_id', '$get_ip_add', 0)";
            $result_query = mysqli_query($con, $insert_query);
            echo "<script>alert('item is added to cart');</script>";
            echo "<script>window.open('index.php','_self');</script>";
        }
    }
}


//function cart item numbers
function cart_item() {
    global $con;

    // Sanitize user input to prevent SQL injection
    $get_ip_add = mysqli_real_escape_string($con, getIPAddress());

    // Construct the SQL query
    $select_query = "SELECT * FROM cart_details WHERE ip_address='$get_ip_add'";

    // Execute the query
    $result_query = mysqli_query($con, $select_query);

    // Check if the query was successful
    if ($result_query) {
        // Get the number of rows returned by the query
        $count_cart_items = mysqli_num_rows($result_query);
        
        // Output the count
        echo $count_cart_items;
    } else {
        // Handle query execution failure
        echo "Error executing query: " . mysqli_error($con);
    }
}

// total price function 

function total_cart_price(){
    global $con; 
    $get_ip_add = getIPAddress();  
    $total = 0;
    $cart_query = "SELECT * FROM cart_details WHERE ip_address='$get_ip_add'";
    $result = mysqli_query($con, $cart_query);
    while ($row = mysqli_fetch_array($result)) {
        $product_id = $row['product_id'];
        $select_products = "SELECT * FROM products WHERE product_id='$product_id'";
        $result_products = mysqli_query($con, $select_products);
        while ($row_product_price = mysqli_fetch_array($result_products)) {
            $product_price = $row_product_price['product_price'];
            $total += $product_price;
        }
    }
    echo $total;
}


// get user details
function get_user_order_details(){
    global $con; 

    

    // Check if username is set in the session
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
    } else {
        echo "Error: Username not set in session.";
        return;
    }

    // Get user details from the database
    $get_details = "SELECT * FROM `user_table` WHERE username='$username'";
    $result_query = mysqli_query($con, $get_details);

    if (!$result_query) {
        die("Query Failed: " . mysqli_error($con));
    }

    // Fetch user details
    while ($row_query = mysqli_fetch_array($result_query)) {
        $user_id = $row_query['user_id'];

        // Check if certain GET parameters are not set
        if (!isset($_GET['edit_account']) && !isset($_GET['my_orders']) && !isset($_GET['delete_account'])) {
            // Get pending orders for the user
            $get_orders = "SELECT * FROM `user_orders` WHERE user_id=$user_id AND order_status='pending'";
            $result_orders_query = mysqli_query($con, $get_orders);

            if (!$result_orders_query) {
                die("Query Failed: " . mysqli_error($con));
            }

            $row_count = mysqli_num_rows($result_orders_query);
            if ($row_count > 0) {
                echo "<h3 class='text-center mt-5 mb-2'>You have <span class='text-danger'>$row_count</span> pending orders</h3>
                <p class='text-center'><a href='profile.php?my_orders' class='text-dark'>order details</a></p>";
            } else {
                echo "<h3 class='text-center'>You have no pending orders</h3>
                <p class='text-center'><a href='../index.php' class='text-dark'>explore products</a></p>";
            }
        }
    }
}
?>

