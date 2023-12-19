<?php
require "_dbconnect.php";
/*******YOU DO NOT NEED TO EDIT ANYTHING BELOW THIS LINE*******/    
//create MySQL connection  
session_start();
$hostel=$_SESSION['hostel_id'];
$filename = $hostel.".xls"; // File Name
// Download file
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: application/vnd.ms-excel");
$result =mysqli_query($conn,"SELECT * FROM $hostel;");
// Write data to file
$flag = false;
while ($row = mysqli_fetch_assoc($result)) {
    if (!$flag) {
        // display field/column names as first row
        echo implode("\t", array_keys($row)) . "\r\n";
        $flag = true;
    }
    echo implode("\t", array_values($row)) . "\r\n";
}
?>