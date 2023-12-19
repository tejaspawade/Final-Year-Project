<?php
require "_navbar.php";
require "_dbconnect.php";
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false) {
    header("location: /hostel/index.php");
    exit;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date_ = date("Y/m/d");
    $username = $_SESSION['username'];
    $sql_ = "SELECT hostel_id FROM `users` WHERE user='$username'";
    $result = mysqli_query($conn, $sql_);
    $row = mysqli_fetch_assoc($result);
    $hostel = $row['hostel_id'];
    $tablename = $hostel . "_attendance";
    if (isset($_GET['present'])) {
        $sno = $_GET['present'];
        $delete = true;
        $sql = "UPDATE `$tablename` SET `$date_` = 'p' WHERE `$tablename`.`srno` =$sno;";
        $result = mysqli_query($conn, $sql);
    }
    if (isset($_GET['absent'])) {
        $sno = $_GET['absent'];
        $delete = true;
        $sql = "UPDATE `$tablename` SET `$date_` = 'a' WHERE `$tablename`.`srno` =$sno;";
        $result = mysqli_query($conn, $sql);
    }
    if (isset($_GET['leave'])) {
        $sno = $_GET['leave'];
        $delete = true;
        $sql = "UPDATE `$tablename` SET `$date_` = 'L' WHERE `$tablename`.`srno` =$sno;";
        $result = mysqli_query($conn, $sql);
    }
}
?>
