<!-- used to connect to sql database  -->
<?php

include('../includes/connect.php');

// Condition for php file
if(isset($_POST['insert_platfrom'])){
  // Whatever data is in the input filed it will be put in the database when button is clicked (This is working)
  $platfrom_title = $_POST['platfrom_title']; // Input field is called cat_title, this accesses the value using the POST method and stores it inside the variable category_title

  // Select data from database
  $select_query = "SELECT * FROM platfrom WHERE platfrom_title='$platfrom_title'";
  $result_select = mysqli_query($con, $select_query);
  $number = mysqli_num_rows($result_select);
  if($number > 0){
    // Check condition if number of rows is greater than 0 which means it's already in database, it will show the alert below
    echo "<script>alert('This platfrom is already present inside the database')</script>";
  } else {
    $insert_query = "INSERT INTO platfrom (platfrom_title) VALUES ('$platfrom_title')";
    $result = mysqli_query($con, $insert_query);
    if($result){
      // This will display a message if the query was carried out 
      echo "<script>alert('platfrom has been inserted successfully')</script>";
    }
  }
}

?>



<!-- insert platfrom code for adime pannle  -->
<!-- use GET request to display this on the index.html admine pannle  -->
<h2 class="text-center">Insert platfrom</h2>
<form action="" method="post" class="mb-2">
<div class="input-group w-90 mb-2">
  <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa receipt"></i></span>
  <input type="text" class="form-control" name="platfrom_title" placeholder="insert platfrom" aria-label="platfrom" aria-describedby="basic-addon1">
</div>

<div class="input-group w-10 mb-2 m-auto">
  <input type="submit" class="bg-info border-0 p-2 my-3" name="insert_platfrom" value="Insert platfrom"> 
</div>

</form>