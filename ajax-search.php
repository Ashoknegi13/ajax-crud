<?php
// this is the code of search term how we can seaerch the  dynamic data from database
$searchterm = $_POST['search'];
include('conn.php');
$sql = "SELECT * FROM student WHERE first_name LIKE '{$searchterm}%' OR last_name LIKE  '{$searchterm}%'  ";
$result = mysqli_query($conn,$sql);
$output = "";
if(mysqli_num_rows($result)> 0) {
     $output .= "<table border='1px solid black'  width='100%' cellpadding='10px' cellspacing='0px'>
                    <tr>
                        <th> Id </th>
                        <th> Name </th>
                        <th> Operations </th>
                    </tr>";
                    while($row = mysqli_fetch_assoc($result)) {
                    $output .= "<tr>
                                   <td>{$row['id']}</td>
                                   <td>{$row['first_name']} {$row['last_name']}</td>
                                   <td>
                                        <button class='edit-btn' style='background-color:green;color:white;border-radius:20px;width:30%;cursor:pointer' data-eid='{$row['id']}'>Edit</button>
                                        <button class='delete-btn' style='background-color:red;color:white;border-radius:20px;width:30%;cursor:pointer' data-did='{$row['id']}'>Delete</button>
                                   </td>

                    </tr> ";
                }
                $output .= "</table>";
                echo $output;

}else{
    $output .= "<tr><td><h1>No record Found</h1></td><tr>";
    echo $output;
}

?>