<?php
require "_navbar.php";
$exists = false;
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false) {
    header("location: index.php");
    exit;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require "_dbconnect.php";

    $room_no = $_POST["room_no"];
    // $romm_type = $_POST["romm_type"];
    $name = $_POST["name"];
    $tally_no = $_POST["tally_no"];
    $Adhar_no = $_POST["Adhar_no"];
    $college = $_POST["college"];
    $class_ = $_POST["class_"];
    $branch = $_POST["branch"];
    $village = $_POST["village"];
    $taluka = $_POST["taluka"];
    $rc_no = $_POST["rc_no"];
    $date_ = $_POST["date_"];
    $total_fee = $_POST["total_fee"];
    $amt = $_POST["amt"];
    $deposite = $_POST["deposite"];
    $dues = $_POST["dues"];
    $p_mo = $_POST["p_mo"];
    $s_mo = $_POST["s_mo"];
    $dob = $_POST["dob"];
    $email = $_POST["email"];
    $hostel = $_POST['hostel_name'];

    $sql = "UPDATE `$hostel` SET `NAME_OF_THE_STUDENTS` = '$name', `Tally No` = '$tally_no', `Adhar No` = '$Adhar_no', `College` = '$college', `CLASS` = '$class_', `BRANCH` = '$branch', `VILLAGE` = '$village', `Taluka` = '$taluka', `RC NO` = '$rc_no', `DATE` = '$date_', `Total Fee` = '$total_fee', `AMTT.` = '$amt', `DEPO.` = '$deposite', `DUES` = '$dues', `P.MO.NO.` = '$p_mo', `S.MO.NO.` = '$s_mo', `DOB` = '$dob', `E-mail` = '$email' WHERE `$hostel`.`Room_No` = '$room_no' AND `$hostel`.`NAME_OF_THE_STUDENTS` = '' LIMIT 1";
    $result = mysqli_query($conn, $sql);
}

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/login.css">
    <title>Add user</title>
</head>

<body>
    <?php
    if ($exists) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Wrong</strong> ' . $exists . ' .
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>';
    }

    ?>
        
        <form action="/hostel/partials/_newEntry.php" method="POST">
        <div class="headingsContainer">
                <h3>Add new Student</h3>
            </div>
            <div class="mainContainer">
                <label for="hostel_name">Hostel Name</label>
                <select id="hostel_name" name="hostel_name">
                    <option value="demo">demo</option>
                    <option value="demo_1">demo_1</option>
                    <option value="a2">a2</option>
                    <option value="a3">a3</option>
                </select>
            </div>
            <div class="form-group">
                <label for="room_no">Room Number</label>
                <input type="text" class="form-control" id="room_no" name="room_no" placeholder="Room Number">
            </div>
            <!-- <div class="form-group">
                <label for="romm_type">Room type</label>
                <input type="text" class="form-control" id="romm_type" name="romm_type" placeholder="Room Type">
            </div> -->
            <div class="form-group">
                <label for="name">Name of student</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Name of student">
            </div>
            <div class="form-group">
                <label for="tally_no">Tally Number</label>
                <input type="text" class="form-control" id="tally_no" name="tally_no" placeholder="Tally Number">
            </div>
            <div class="form-group">
                <label for="Adhar_no">Adhar Number</label>
                <input type="text" class="form-control" id="Adhar_no" name="Adhar_no" placeholder="Adhar Number">
            </div>
            <div class="form-group">
                <label for="college">College Name</label>
                <input type="text" class="form-control" id="college" name="college" placeholder="College Name">
            </div>
            <div class="form-group">
                <label for="class_">Class</label>
                <input type="text" class="form-control" id="class_" name="class_" placeholder="Class of Study">
            </div>
            <div class="form-group">
                <label for="branch">Branch</label>
                <input type="text" class="form-control" id="branch" name="branch" placeholder="Branch">
            </div>
            <div class="form-group">
                <label for="village">Village</label>
                <input type="text" class="form-control" id="village" name="village" placeholder="Village Name">
            </div>
            <div class="form-group">
                <label for="taluka">Taluka</label>
                <input type="text" class="form-control" id="taluka" name="taluka" placeholder="Taluka Name">
            </div>
            <div class="form-group">
                <label for="rc_no">RC Number</label>
                <input type="text" class="form-control" id="rc_no" name="rc_no" placeholder="RC number">
            </div>
            <div class="form-group">
                <label for="date_">Date of joining</label>
                <input type="date" class="form-control" id="date_" name="date_" placeholder="Date">
            </div>
            <div class="form-group">
                <label for="total_fee">Total Fees</label>
                <input type="text" class="form-control" id="total_fee" name="total_fee" placeholder="Total Fees">
            </div>
            <div class="form-group">
                <label for="amt">Amount</label>
                <input type="text" class="form-control" id="amt" name="amt" placeholder="Total Amount">
            </div>
            <div class="form-group">
                <label for="deposite">Deposite Amount</label>
                <input type="text" class="form-control" id="deposite" name="deposite" placeholder="Deposite">
            </div>
            <div class="form-group">
                <label for="dues">Dues (Pending Amount)</label>
                <input type="text" class="form-control" id="dues" name="dues" placeholder="Dues">
            </div>
            <div class="form-group">
                <label for="p_mo">Parents Mobile number</label>
                <input type="text" class="form-control" id="p_mo" name="p_mo" placeholder="Mobile Number">
            </div>
            <div class="form-group">
                <label for="s_mo">Student Mobile Number</label>
                <input type="text" class="form-control" id="s_mo" name="s_mo" placeholder="Mobile number">
            </div>
            <div class="form-group">
                <label for="dob">Date of Birth</label>
                <input type="date" class="form-control" id="dob" name="dob" placeholder="Date of birth">
            </div>
            <div class="form-group">
                <label for="emailEdit">Email</label>
                <input type="text" class="form-control" id="email" name="email" aria-describedby="emailHelp">
            </div>
            <button type="submit" class="btn btn-primary">ADD Student</button><br><br>
        </form>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>