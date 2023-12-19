<?php
require "_dbconnect.php";
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false) {
    header("location: /hostel/index.php");
    exit;
}
$username = $_SESSION['username'];
$sql_ = "SELECT hostel_id FROM `users` WHERE user='$username'";
$result = mysqli_query($conn, $sql_);
$row = mysqli_fetch_assoc($result);
$hostel = $row['hostel_id'];
$tablename=$hostel."_attendance";
try{
$sql = "CREATE TABLE `users`.`$tablename` (`srno` INT(5) NOT NULL AUTO_INCREMENT , `Room_No` VARCHAR(4) NOT NULL , `NAME_OF_THE_STUDENTS` VARCHAR(30) NOT NULL , PRIMARY KEY (`srno`));";
$result = mysqli_query($conn, $sql);
}catch (mysqli_sql_exception $e) {
    echo "duplicate";
    header("location: _home.php?duplicate=1");
}
$sql = "SELECT srno, Room_No, NAME_OF_THE_STUDENTS FROM `$hostel`;";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    if($row["Room_No"]==NULL)
    {
      break;
    }
    $name_=$row["NAME_OF_THE_STUDENTS"];
    $room=$row["Room_No"];
    $sr=$row["srno"];
    $sql="INSERT INTO `users`.`$tablename` (`srno`, `Room_No`, `NAME_OF_THE_STUDENTS`) VALUES ('$sr', '$room', '$name_');";
    mysqli_query($conn, $sql);
}
header("location: _home.php?duplicate=0")
?>