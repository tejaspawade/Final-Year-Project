<?php
require "_dbconnect.php";
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false) {
    header("location: /hostel/index.php");
    exit;
  }
$date_ = date("Y/m/d");
$username = $_SESSION['username'];
$sql_ = "SELECT hostel_id FROM `users` WHERE user='$username'";
$result = mysqli_query($conn, $sql_);
$row = mysqli_fetch_assoc($result);
$hostel = $row['hostel_id'];
$tablename=$hostel."_attendance";
try{
    $sql = "ALTER TABLE `$tablename` ADD `$date_` VARCHAR(4) NOT NULL ;";
    mysqli_query($conn, $sql);
}catch (mysqli_sql_exception $e) {
    header("location: _home.php?duplicate=1");
}
header("location: _home.php?duplicate=0");
?>