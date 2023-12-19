<?php
require "_navbar.php";
require "_dbconnect.php";
$_SESSION['hostel_name'] = "a3";
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false) {
    header("location: /hostel/index.php");
    exit;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hostel_name = $_POST["hostel_name"];
    $_SESSION['hostel_name'] = $hostel_name;
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
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
    <title>Login</title>
</head>

<body>
    <div class="container" style="margin: 100px;">
        <form action="_hosteldetails.php" method="POST">
            <div class="form-group">
                <label for="hostel_name">Hostel Name</label>
                <select id="hostel_name" name="hostel_name">
                    <option value="">Select the hostel name</option>
                    <option value="a3">A3</option>
                    <option value="a4">A4</option>
                    <option value="a6">A6</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Show</button>
        </form>
    </div>

    <div class="container my-5" style="overflow-x: auto;">
        <h3>Details <?php echo $_SESSION['hostel_name']; ?></h1>
            <div class="container my-4">
                <div class="jumbotron jumbotron-fluid">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-body">

                                        <?php
                                        $hostel = $_SESSION['hostel_name'];
                                        // $sql = "SELECT * FROM `$hostel` ORDER BY room_number;";
                                        $sql = "SELECT COUNT(NAME_OF_THE_STUDENTS) as cap FROM `$hostel` WHERE NAME_OF_THE_STUDENTS NOT like ''";
                                        $result = mysqli_query($conn, $sql);
                                        $srno = 0;
                                        $row = mysqli_fetch_assoc($result);
                                        echo '<h5 class="card-title">Total Number of Students ' . $row['cap'] . '</h5>';

                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Total Student College wise</h5>
                                        <?php
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




            <table class="table" id="myTable1">
                <thead>
                    <tr>
                        <th scope="col">Sr. no</th>
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
                        <th scope="col">District</th>
                        <th scope="col">State</th>
                        <th scope="col">UTR NO</th>
                        <th scope="col">UTR DATE</th>
                        <th scope="col">Total Fee</th>
                        <th scope="col">Fees Paid</th>
                        <th scope="col">Fee Recipt</th>
                        <th scope="col">Fee DUES</th>
                        <th scope="col">P.MO.NO.</th>
                        <th scope="col">S.MO.NO.</th>
                        <th scope="col">DOB</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Remark</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $hostel_name = $_SESSION['hostel_name'];
                    $sql = "SELECT * FROM `$hostel_name` ORDER BY 'Room_No';";
                    $result = mysqli_query($conn, $sql);
                    $srno = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        if ($row["Room_No"] == NULL) {
                            break;
                        }
                        $srno = $srno + 1;
                        echo '<tr>
              <th scope="row">' . $srno . '</th>
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
              <td>' . $row["District"] . '</td>
              <td>' . $row["State"] . '</td>
              <td>' . $row["UTR NO"] . '</td>
              <td>' . $row["UTR DATE"] . '</td>
              <td>' . $row["Total Fee"] . '</td>
              <td>' . $row["Fees Paid"] . '</td>
              <td>' . $row["Fee Recipt"] . '</td>
              <td>' . $row["Fees Dues"] . '</td>
              <td>' . $row["P.MO.NO."] . '</td>
              <td>' . $row["S.MO.NO."] . '</td>
              <td>' . $row["DOB"] . '</td>
              <td>' . $row["E-mail"] . '</td>
              <td>' . $row["REMARK"] . '</td>
              </tr>';
                    }
                    ?>


                </tbody>
            </table>
    </div>

    <div class="container my-5" style="overflow-x: auto;">
        <h2>Attendance</h2>
        <table class="table" id="myTable2">
            <thead>
                <tr>
                    <?php
                    $tablename = $hostel_name . "_attendance";
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
                    $sql_ = "SELECT * FROM `$tablename` ORDER BY 'Room No';";
                    $result = mysqli_query($conn, $sql_);
                    // $row = mysqli_fetch_assoc($result);
                    $stuff = array(1, 2, 3);
                    echo "\n";
                    while ($row = mysqli_fetch_assoc($result)) {
                        foreach ($row as $value) {
                            echo '
                    <td scope="col">  ' . $value . '</td>';
                        }
                        echo '</tr>';
                    }
                    echo '</tbody>
                </table>';
                    ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- <script src="//cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#myTable1').DataTable();
        });
    </script> -->
    <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable1').DataTable();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#myTable2').DataTable();
        });
    </script>
</body>

</html>