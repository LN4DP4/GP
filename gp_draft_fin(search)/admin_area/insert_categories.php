<!-- used to connect to sql database  -->
<?php

include('../includes/connect.php');

// Condition for php file
if(isset($_POST['insert_cat'])){
  // Whatever data is in the input filed it will be put in the database when button is clicked (This is working)
  $category_title = $_POST['cat_title']; // Input field is called cat_title, this accesses the value using the POST method and stores it inside the variable category_title

  // Select data from database
  $select_query = "SELECT * FROM categories WHERE category_title='$category_title'";
  $result_select = mysqli_query($con, $select_query);
  $number = mysqli_num_rows($result_select);
  if($number > 0){
    // Check condition if number of rows is greater than 0 which means it's already in database, it will show the alert below
    echo "<script>alert('This category is already present inside the database')</script>";
  } else {
    $insert_query = "INSERT INTO categories (category_title) VALUES ('$category_title')";
    $result = mysqli_query($con, $insert_query);
    if($result){
      // This will display a message if the query was carried out 
      echo "<script>alert('Category has been inserted successfully')</script>";
    }
  }
}

?>





<!-- insert catgories code for adime pannle  -->
<!-- use GET request to display this on the index.html admine pannle  -->
<h2 class="text-center">Insert Categories</h2>
<form action="" method="post" class="mb-2">
<div class="input-group w-90 mb-2">
  <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa receipt"></i></span>
  <input type="text" class="form-control" name="cat_title" placeholder="insert categories" aria-label="Username" aria-describedby="basic-addon1">
</div>

<div class="input-group w-10 mb-2 m-auto">
  <input type="submit" class="bg-info border-0 p-2 my-3" name="insert_cat" value="Insert Categories"> 
  
</div>

</form>

