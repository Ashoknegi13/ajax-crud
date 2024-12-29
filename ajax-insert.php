<?php
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];

include("conn.php");
$sql = "INSERT INTO student(first_name , last_name)VALUES('{$firstname}','{$lastname}')  ";
if(mysqli_query($conn, $sql)) {
    echo 1;
}else{
    echo 0;
}
?>