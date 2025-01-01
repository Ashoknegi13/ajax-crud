<?php
// fetch a user id from ajax request send by .delete-btn click function
$user_id = $_POST['id'];
include('conn.php');
$sql = "DELETE  FROM student WHERE id = {$user_id}  ";
if(mysqli_query($conn, $sql)){
    echo 1;
}else{
    echo 0;
}
?>