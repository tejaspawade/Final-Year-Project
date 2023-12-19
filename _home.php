<?php
require "_navbar.php";
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false) {
    header("location: /hostel/index.php");
    exit;
}
if (isset($_GET['duplicate'])) {
    if ($_GET['duplicate']) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Wrong</strong> Column already added.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>';
    } else {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!!! </strong> Added succesfully.
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
    <?php $user = $_SESSION['username'];
    echo '<title>' . $user . '</title>';
    ?>
</head>

<body>
    <!-- <h1>Hello, world!</h1> -->
    <div class="container my-5" style="width: 35rem" style="margin: auto;">
        <div class="alert alert-success" role="alert" style="max-width: 50rem;">
            <div class="container my-4">
                <div class="card-deck">
                    <div class="card" style="max-width: 15rem;">
                        <img src="CSS/date.png" alt="Card image cap" width="100%" height="50%">
                        <div class="card-body">
                            <h5 class="card-title">Add today's col</h5>
                            <p class="card-text">Befor taking Attendance Every day, Please Click on below Button to add Column of current dateattendance</p>
                        </div>
                        <div class="card-footer">
                            <a href="_addcol.php" class="btn btn-primary">Click</a>
                        </div>

                    </div>

                    <div class="card" style="max-width: 15rem;">
                        <img src="CSS/table.png" alt="Card image cap" width="100%" height="45%">
                        <div class="card-body">
                            <h5 class="card-title">Create Table</h5>
                            <p class="card-text">Use this to create the attendance table</p>
                        </div>
                        <div class="card-footer">
                            <a href="_attendanceTable.php" class="btn btn-primary">Click</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container my-5" style="max-width: 35rem" style="margin: auto;">
        <div class="alert alert-success" role="alert" style="max-width: 50rem;">
            <div class="container my-4">
                <div class="card-deck">
                    <div class="card" style="max-width: 15rem;">
                        <img src="CSS/pdf.png" alt="Card image cap" width="80%" height="50%" class="center">
                        <div class="card-body">
                            <h5 class="card-title">Details PDf</h5>
                            <p class="card-text">Use this to create the PDF of Studants Details</p>
                        </div>
                        <div class="card-footer">
                            <a href="_details_pdf.php" class="btn btn-primary">Click</a>
                        </div>
                    </div>

                    <div class="card" style="max-width: 15rem;">
                        <img src="CSS/pdf.png" alt="Card image cap" width="80%" height="50%" >
                        <div class="card-body">
                            <h5 class="card-title">Attendance PDf</h5>
                            <p class="card-text">Use this to create the PDF of Attendance of students</p>
                        </div>
                        <div class="card-footer">
                            <a href="_attendance_pdf.php" class="btn btn-primary">Click</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="container my-5" style="max-width: 35rem" style="margin: auto;">
        <div class="alert alert-success" role="alert" style="max-width: 50rem;">
            <div class="container my-4">
                <div class="card-deck">
                    <div class="card" style="max-width: 15rem;">
                        <img src="CSS/excel.png" alt="Card image cap" width="100%" height="50%">
                        <div class="card-body">
                            <h5 class="card-title"> Details Excel</h5>
                            <p class="card-text">Use this to create the Excelsheet of student details</p>
                        </div>
                        <div class="card-footer">
                            <a href="_details_excel.php" class="btn btn-primary">Click</a>
                        </div>
                    </div>

                    <div class="card" style="max-width: 15rem;">
                        <img src="CSS/excel.png" alt="Card image cap" width="100%" height="50%">
                        <div class="card-body">
                            <h5 class="card-title">Attendance Excel</h5>
                            <p class="card-text">Use this to create the Excel of student Attendance</p>
                        </div>
                        <div class="card-footer">
                            <a href="_attendance_excel.php" class="btn btn-primary">Click</a>
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