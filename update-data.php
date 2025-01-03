<?php
// this is update the user data when update button trigger
$user_id  = $_POST['id'];
$fname = $_POST['first_name'];
$lname = $_POST['last_name'];
include('conn.php');
$sql = "UPDATE student SET first_name = '{$fname}' , last_name = '{$lname}' WHERE id = {$user_id} ";
if(mysqli_query($conn,$sql)){
    echo 1;
}else{
    echo 0;
}
?>