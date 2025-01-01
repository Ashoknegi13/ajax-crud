<?php
  // this is the code , first i fetch a data from database so this datacan show  in input fields

$user_id = $_GET['id'];
include('conn.php');

$sql = "SELECT * FROM student WHERE id = {$user_id} ";
$result = mysqli_query($conn,$sql);
$output = "";
if(mysqli_num_rows($result)> 0){
    while($row = mysqli_fetch_assoc($result)){
   $output .= "<tr><form id='update-form'>
                   <td>First Name : <input type='text' id='first_name' name='first_name'  value='{$row['first_name']}'>  <br>
                    last Name : <input type='text' id='last_name' name='last_name'  value='{$row['last_name']}'>  <br>
                   <input type='submit' id='update-btn' name='first_name'  value='Update' data-uid='{$row['id']}'> </td>
                    </form>
                   </tr>";
     }  
                echo $output;
}

?>