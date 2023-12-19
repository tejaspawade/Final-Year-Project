<?php
$notfound=0;
require '_navbar.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_name = $_POST["student_name"];
    $hostel_ = $_POST["hostel"];
    $email = $_POST["email"];
    $mob_num = $_POST["mob_num"];
    session_start();
    $_SESSION['loggedin'] = true;
    $_SESSION['student_name'] = $student_name;
    $_SESSION['hostel_'] =  $hostel_;
    $_SESSION['email'] = $email ;
    $_SESSION['mob_num'] = $mob_num;
    $_SESSION['designation']='student';
    header("location: _studentDetails.php");
}
if (isset($_GET['notfound']))
{
    if($_GET['notfound']){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Wrong!!! </strong> Record not found. Please Enter Correct details .
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>';
    }
    $notfound=0;
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
            <form action="_student.php" method="POST">
            <div class="headingsContainer">
                <h3>Login</h3>
            </div>
                <div class="form-group">
                    <label for="hostel">Hostel Name</label>
                    <input type="text" class="form-control" id="hostel" name="hostel" aria-describedby="emailHelp" placeholder="Hostel Name">
                </div>
                <div class="form-group">
                    <label for="student_name">Student name</label>
                    <input type="text" class="form-control" id="student_name" name="student_name" placeholder="Enter Name">
                    <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                </div>
                <div class="form-group">
                    <label for="email">Email Id</label>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="mob_num">Mobile number</label>
                    <input type="text" class="form-control" id="mob_num" name="mob_num" aria-describedby="emailHelp" placeholder="Mobile number">
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>