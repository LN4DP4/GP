<?php
if(isset($_GET['edit_platfrom'])){
    $edit_platfrom = $_GET['edit_platfrom'];
    //echo $edit_platfrom;

    $get_platfrom = "SELECT * FROM platfrom WHERE platfrom_id=$edit_platfrom";
    $result = mysqli_query($con, $get_platfrom);
    $row = mysqli_fetch_assoc($result);
    $platfrom_title = $row['platfrom_title'];
    //echo $platfrom_title;
}

if(isset($_POST['edit_pla'])){ // Fixed the name of the submit button
    $pla_title = $_POST['platfrom_title'];

    $update_query = "UPDATE platfrom SET platfrom_title='$pla_title' WHERE platfrom_id=$edit_platfrom";
    $result_pla = mysqli_query($con, $update_query);
    if($result_pla){
        echo "<script>alert('platfrom has been updated')</script>";
        echo "<script>window.open('./index.php?view_platfrom','_self')</script>";
    }
}
?>

<div class="container mt-3">
    <h1 class="text-center">edit platfrom</h1>
    <form action="" method="post" class="text-center">
        <div class="form-outline mb-4 w-50 m-auto"> <!-- Corrected typo in class name -->
            <label for="platfrom_title" class="form-label">platfrom title</label> <!-- Corrected typo in closing tag -->
            <input type="text" name="platfrom_title" id="platfrom_title" class="form-control" required="required"
            value='<?php echo $platfrom_title; ?>'>
        </div>
        <input type="submit" value="update platfrom" class="btn btn-info px-3 mb-3" name="edit_pla"> <!-- Corrected the name of the submit button -->
    </form>
</div>
