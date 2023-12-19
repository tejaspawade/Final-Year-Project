<?php
$login = false;
require "_navbar.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require "_dbconnect.php";
    $username = $_POST["username"];
    $password = $_POST["password"];
    $sql = "select * from users where user='$username'";
    $res = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($res);
    if ($num == 1) {
        while ($row = mysqli_fetch_assoc($res)) {
            if (password_verify($password, $row['password'])) {
                $login = true;
                // session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;
                $sql_ = "SELECT * FROM `users` WHERE user='$username'";
                $result = mysqli_query($conn, $sql_);
                $row = mysqli_fetch_assoc($result);
                $hostel = $row['hostel_id'];
                $designation = $row['designation'];
                $_SESSION['hostel_id'] = $hostel;
                $_SESSION['designation'] = $designation;
                if ($designation == 'Admin' or $designation == 'Rector') {
                    header("location: _home.php");
                }
                if ($designation == 'Management') {
                    header("location: _hosteldetails.php");
                }
                if ($designation == 'Registration') {
                    header("location: _registration.php");
                } else {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Wrong Credentails!!!</strong> Credentails not found. Please contact the Admin .
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
                }
            }
        }
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Wrong Credentails!!!</strong> Credentails not found. Please contact the Admin .
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>';
    } else {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Wrong Credentails!!!</strong> Credentails not found. Please contact the Admin .
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>';
    }
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
    <title>Login</title>
</head>

<body>
    <!-- <h1>Hello, world!</h1> -->
    <div class="container-sm my-4">
        <!-- <div class="text-center my-4">
            <img src="partials/logo.jpg" class="rounded" width="300" height="300" alt="...">
        </div> -->

        <!-- <h1 class="text-center"> Login</h1> -->
        <form action="user.php" method="POST">
            <div class="headingsContainer">
                <h3>Sign in</h3>
            </div>
            <div class="mainContainer">
                <label for="username">User name</label>
                <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp" placeholder="Enter Username">
                <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->

                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            </div>
            <button type="submit" class="button-68">Login</button>
        </form>
    </div>
    <?php

    ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>