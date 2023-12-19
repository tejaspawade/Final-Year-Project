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

    <title>Login</title>
</head>

<body>
    <!-- <div class="container my-5"> -->
    <div class="container" style="margin: 100px;">
    <h1>Details</h1>
    </div>
    <div class="container my-5" style="overflow-x: auto;">
    <table class="table" id="myTable" style="overflow-x: auto;">
        <thead>
            <tr>
                <th scope="col">Room No</th>
                <th scope="col">Room Type</th>
                <th scope="col">NAME OF THE STUDENTS</th>
                <th scope="col">Tally No</th>
                <th scope="col">Adhar No</th>
                <th scope="col">College</th>
                <th scope="col">CLASS</th>
                <th scope="col">BRANCH</th>
                <th scope="col">VILLAGE</th>
                <th scope="col">Taluka</th>
                <th scope="col">RC NO</th>
                <th scope="col">DATE</th>
                <th scope="col">Total Fee</th>
                <th scope="col">AMTT.</th>
                <th scope="col">DEPO.</th>
                <th scope="col">DUES</th>
                <th scope="col">P.MO.NO.</th>
                <th scope="col">S.MO.NO.</th>
                <th scope="col">DOB</th>
                <th scope="col">E-mail</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // $date_ = date("Y/m/d");
            $student_name = $_SESSION['student_name'];
            $hostel_ = $_SESSION['hostel_'];
            $email = $_SESSION['email'];
            $mob_num = $_SESSION['mob_num'];
            $sql_ = "SELECT * FROM `$hostel_` WHERE `NAME_OF_THE_STUDENTS` LIKE '$student_name' AND `S.MO.NO.` LIKE '$mob_num' AND `E-mail` LIKE '$email';";
            $result = mysqli_query($conn, $sql_);
            $num = mysqli_num_rows($result);
            if ($num==0) {
                header('location: /hostel/_student.php?notfound=1');
            }
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row["Room_No"] == NULL) {
                    break;
                }
                $room_ = $row["Room_No"];
                echo '<tr>
              <td>' . $row["Room_No"] . '</td>
              <td>' . $row["Room Type"] . '</td>
              <td>' . $row["NAME_OF_THE_STUDENTS"] . '</td>
              <td>' . $row["Tally No"] . '</td>
              <td>' . $row["Adhar No"] . '</td>
              <td>' . $row["College"] . '</td>
              <td>' . $row["CLASS"] . '</td>
              <td>' . $row["BRANCH"] . '</td>
              <td>' . $row["VILLAGE"] . '</td>
              <td>' . $row["Taluka"] . '</td>
              <td>' . $row["RC NO"] . '</td>
              <td>' . $row["DATE"] . '</td>
              <td>' . $row["Total Fee"] . '</td>
              <td>' . $row["AMTT."] . '</td>
              <td>' . $row["DEPO."] . '</td>
              <td>' . $row["DUES"] . '</td>
              <td>' . $row["P.MO.NO."] . '</td>
              <td>' . $row["S.MO.NO."] . '</td>
              <td>' . $row["DOB"] . '</td>
              <td>' . $row["E-mail"] . '</td>
              </tr>';
            }
            ?>


        </tbody>
    </table>
        </div>
        <div class="container" style="margin: 100px;">
    <h1>Attendance</h1>
    </div>
    <div class="container my-5" style="overflow-x: auto;">
    <table class="table" id="myTable">
        <thead>
            <tr>
                <?php
                $tablename = $hostel_ . "_attendance";
                $sql_ = "SELECT COLUMN_NAME from INFORMATION_SCHEMA.COLUMNS where TABLE_NAME='$tablename';";
                $result = mysqli_query($conn, $sql_);
                while ($row = mysqli_fetch_assoc($result)) {
                    foreach ($row as $value) {
                        echo '
                        <th scope="col">' . $value . '</th>';
                    }
                }
                echo '</tr>
                </thead>
                <tbody>
                <tr>';
                $sql_ = "SELECT * FROM `$tablename` WHERE `Room_No` LIKE '$room_' AND `NAME_OF_THE_STUDENTS` LIKE '$student_name';";
                $result = mysqli_query($conn, $sql_);
                $row = mysqli_fetch_assoc($result);
                echo "\n";
                try{
                    foreach ($row as $value) {
                    echo '
                    <td scope="col">  ' . $value . '</td>';
                }}
                catch (mysqli_sql_exception $e) {
                    
                }
                echo '</tr></tbody>
                </table>';
                ?>
                </div>
                <!-- </div> -->
                <!-- Optional JavaScript -->
                <!-- jQuery first, then Popper.js, then Bootstrap JS -->
                <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>