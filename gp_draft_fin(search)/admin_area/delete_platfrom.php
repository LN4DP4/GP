<?php
if(isset($_GET['delete_platfrom'])){
    $delete_platfrom = $_GET['delete_platfrom'];
    //echo $delete_platfrom;

    $delete_query = "DELETE FROM platfrom WHERE platfrom_id=$delete_platfrom";
    $result = mysqli_query($con, $delete_query);
    if($result){
        echo "<script>alert('platfrom deleted :)');</script>";
        echo "<script>window.open('./index.php?view_platfrom','_self');</script>";
    }
}
?>
