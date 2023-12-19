<?php
require "_navbar.php";
$exists = false;
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false) {
    header("location: index.php");
    exit;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require "_dbconnect.php";

    $username = $_POST["username"];
    $hostel_id = $_POST["hostel_id"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    $desig = $_POST["desig"];
    $exists = false;
    $exist = "select * from users where user='$username'";
    $result = mysqli_query($conn, $exist);
    $num = mysqli_num_rows($result);
    if ($num > 0) {
        $exists = "User already exist";
    } else {

        if ($password == $cpassword) {
            $pass=password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`user`, `password`, `hostel_id`,`designation`) VALUES ('$username', '$pass', '$hostel_id','$desig');";
            $res = mysqli_query($conn, $sql);
            if ($res) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!!! </strong> Your account is created, you can login.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            }
        } else {
            $exists = "Password not match";
        }
    }
}

?>
<!-- change command -->
<!-- UPDATE `users` SET `hostel_id` = 'a2' WHERE `users`.`srno` = 2; -->
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
    <div class="container-sm my-4">
        <form action="adduser.php" method="POST">
            <div class="headingsContainer">
                <h3>Add user</h3>
            </div>

            <div class="mainContainer">
                <div class="form-group">
                    <label for="desig">Designation</label>
                    <select class="form-control" id="desig" name="desig">
                        <option>Rector</option>
                        <option>Admin</option>
                        <option>Registration</option>
                        <option>Management</option>
                    </select>
                </div>
                <label for="username">User name</label>
                <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp" placeholder="Enter Username">
                <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->

                <label for="hostel_id">Hostel ID</label>
                <input type="text" class="form-control" id="hostel_id" name="hostel_id" aria-describedby="emailHelp" placeholder="Enter Hostel ID">
                <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->

                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">

                <label for="cpassword">Confirm Password</label>
                <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder=" Confirm Password">
                <small id="emailHelp" class="form-text text-muted">Make sure you enter same password</small>
            </div>
            <button type="submit" class="btn btn-primary">ADD user</button><br><br>
        </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>