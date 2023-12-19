<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

require "_navbar.php";
require "_dbconnect.php";
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false) {
    header("location: index.php");
    exit;
}
$date_ = date("Y/m/d");
$username = $_SESSION['username'];
$sql_ = "SELECT hostel_id FROM `users` WHERE user='$username'";
$result = mysqli_query($conn, $sql_);
$row = mysqli_fetch_assoc($result);
$hostel = $row['hostel_id'];
$tablename = $hostel . "_attendance";
$sql = "SELECT * FROM `$tablename` WHERE `$date_` LIKE 'a'";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    if ($row["Room_No"] == NULL) {
        break;
    }
    $name_ = $row["NAME_OF_THE_STUDENTS"];
    $room = $row["Room_No"];
    $sql = "SELECT * FROM `$hostel` WHERE `Room_No` LIKE '$room' AND `NAME_OF_THE_STUDENTS` LIKE '$name_';";
    $result_1 = mysqli_query($conn, $sql);
    $row_1 = mysqli_fetch_assoc($result_1);
    $mobile_p = $row_1['P.MO.NO.'];
    $mobile_s = $row_1['S.MO.NO.'];
    $email_ = $row_1['E-mail'];

    $to = "somebody@example.com";
    $subject = "Your child $name_ is not present";
    $txt = "Pleade confirm it !!!! $mobile_p, $mobile_s";
    // $headers = "From: amitnirmal7387@gmail.com";
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'hostelattendance09@gmail.com';
    $mail->Password = 'foifuvqreaapobgn';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->setFrom('hostelattendance09@gmail.com');
    $mail->addAddress($email_);
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $txt;
    $mail->send();
    // mail($email_, $subject, $txt, $headers);
}
header("location: _report.php?done=1");
?>