<?php
require "_navbar.php";
require "_dbconnect.php";
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false) {
    header("location: /hostel/index.php");
    exit;
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

    <title>Welcome - <?php echo $_SESSION['username'] ?></title>
</head>

<body>
    <div class="container my-4">
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">

                                <?php
                                $username = $_SESSION['username'];
                                $sql_ = "SELECT hostel_id FROM `users` WHERE user='$username'";
                                $result = mysqli_query($conn, $sql_);
                                $row = mysqli_fetch_assoc($result);
                                $hostel = $row['hostel_id'];
                                // $sql = "SELECT * FROM `$hostel` ORDER BY room_number;";
                                $sql = "SELECT COUNT(NAME_OF_THE_STUDENTS) as cap FROM `$hostel` WHERE NAME_OF_THE_STUDENTS NOT like ''";
                                $result = mysqli_query($conn, $sql);
                                $srno = 0;
                                $row = mysqli_fetch_assoc($result);
                                echo '<h5 class="card-title">Total Number of Students ' . $row['cap'] . ' in '.$hostel.'</h5>';
                                
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                            <h5 class="card-title">Total Student College wise</h5>
                                <?php
                                // $username = $_SESSION['username'];
                                // $sql_ = "SELECT hostel_id FROM `users` WHERE user='$username'";
                                // $result = mysqli_query($conn, $sql_);
                                // $row = mysqli_fetch_assoc($result);
                                // $hostel = $row['hostel_id'];
                                $sql = "SELECT COUNT(NAME_OF_THE_STUDENTS) as cap,College FROM `$hostel` WHERE NAME_OF_THE_STUDENTS NOT like '' GROUP BY College;";
                                $result = mysqli_query($conn, $sql);
                                $srno = 0;
                                $row = mysqli_fetch_assoc($result);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $srno = $srno + 1;
                                    echo 'There are <b>' . $row['cap'] . '</b> students from <b>' . $row['College'] . '</b><br>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 my-3">
                        <div class="card">
                            <div class="card-body">
                            <h5 class="card-title">Total Student Year wise</h5>
                                <?php
                                // $username = $_SESSION['username'];
                                // $sql_ = "SELECT hostel_id FROM `users` WHERE user='$username'";
                                // $result = mysqli_query($conn, $sql_);
                                // $row = mysqli_fetch_assoc($result);
                                // $hostel = $row['hostel_id'];
                                $sql = "SELECT COUNT(NAME_OF_THE_STUDENTS) as cap,CLASS FROM `$hostel` WHERE NAME_OF_THE_STUDENTS NOT like '' GROUP BY CLASS;";
                                $result = mysqli_query($conn, $sql);
                                $srno = 0;
                                $row = mysqli_fetch_assoc($result);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $srno = $srno + 1;
                                    echo 'There are <b>' . $row['cap'] . '</b> students from <b>' . $row['CLASS'] . '</b><br>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 my-3">
                        <div class="card">
                            <div class="card-body">
                            <h5 class="card-title">Total Student Branch wise</h5>
                                <?php
                                // $username = $_SESSION['username'];
                                // $sql_ = "SELECT hostel_id FROM `users` WHERE user='$username'";
                                // $result = mysqli_query($conn, $sql_);
                                // $row = mysqli_fetch_assoc($result);
                                // $hostel = $row['hostel_id'];
                                $sql = "SELECT COUNT(NAME_OF_THE_STUDENTS) as cap,BRANCH FROM `$hostel` WHERE NAME_OF_THE_STUDENTS NOT like '' GROUP BY BRANCH;";
                                $result = mysqli_query($conn, $sql);
                                $srno = 0;
                                $row = mysqli_fetch_assoc($result);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $srno = $srno + 1;
                                    echo 'There are <b>' . $row['cap'] . '</b> students from <b>' . $row['BRANCH'] . '</b><br>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>