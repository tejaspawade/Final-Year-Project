<?php
require "_navbar.php";
$update = false;

if (!isset($_SESSION['loggedin'])) {
    header("location: /hostel/index.php");
    exit;
}
require "_dbconnect.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['srnoEdit'])) {
        // Update the record
        $sno = $_POST['srnoEdit'];
        $room_no = $_POST["room_noEdit"];
        $romm_type = $_POST["romm_typeEdit"];
        $name = $_POST["nameEdit"];
        $tally_no = $_POST["tally_noEdit"];
        $Adhar_no = $_POST["Adhar_noEdit"];
        $college = $_POST["collegeEdit"];
        $class_ = $_POST["class_Edit"];
        $branch = $_POST["branchEdit"];
        $village = $_POST["villageEdit"];
        $taluka = $_POST["talukaEdit"];
        $district=$_POST["districtEdit"];
        $state=$_POST["stateEdit"];
        $utr_no = $_POST["utr_noEdit"];
        $utr_date = $_POST["utr_dateEdit"];
        $total_fee = $_POST["total_feeEdit"];
        $fee_paid = $_POST["fee_paidEdit"];
        $fee_recipt = $_POST["fee_reciptEdit"];
        $dues = $_POST["duesEdit"];
        $p_mo = $_POST["p_moEdit"];
        $s_mo = $_POST["s_moEdit"];
        $dob = $_POST["dobEdit"];
        $email = $_POST["emailEdit"];
        $remark = $_POST["remarkEdit"];
        $hostel = $_SESSION['hostel_id'];
        $tablename=$hostel."_attendance";

        // Sql query to be executed
        $sql = "UPDATE `$tablename` SET `Room_No` = '$room_no' ,`NAME_OF_THE_STUDENTS` = '$name' WHERE `$tablename`.`srno`= $sno ";
        $result = mysqli_query($conn, $sql);
        $sql = "UPDATE `$hostel` SET `Room_No` = '$room_no' , `Room Type` = '$romm_type',`NAME_OF_THE_STUDENTS` = '$name', `Tally No` = '$tally_no', `Adhar No` = '$Adhar_no', `College` = '$college', `CLASS` = '$class_', `BRANCH` = '$branch', `VILLAGE` = '$village', `Taluka` = '$taluka',`District` = '$district',`State` = '$state', `UTR NO` = '$utr_no', `UTR DATE` = '$utr_date', `Total Fee` = '$total_fee', `Fees Paid` = '$fee_paid', `Fee Recipt` = '$fee_recipt', `Fees Dues` = '$dues', `P.MO.NO.` = '$p_mo', `S.MO.NO.` = '$s_mo', `DOB` = '$dob', `E-mail` = '$email',`REMARK` = '$remark' WHERE `$hostel`.`srno`= $sno ";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $update = true;
        }
    }
}
if (isset($_GET['delete'])) {
    $srno = $_GET['delete'];
    $delete = true;
    $hostel = $_SESSION['hostel_id'];
    $tablename=$hostel."_attendance";
    // $sql = "DELETE FROM `$hostel` WHERE `$hostel`.`srno` = '$srno'";
    $sql = "UPDATE `$tablename` SET `NAME_OF_THE_STUDENTS` = '' WHERE `$tablename`.`srno`= $srno ";
    $result = mysqli_query($conn, $sql);
    $sql = "UPDATE `$hostel` SET `NAME_OF_THE_STUDENTS` = '', `Tally No` = '', `Adhar No` = '', `College` = '', `CLASS` = '', `BRANCH` = '', `VILLAGE` = '', `Taluka` = '',`District` ='',`State` ='', `UTR NO` = '', `UTR DATE` = '', `Total Fee` = '', `Fees Paid` = '', `Fee Recipt` = '', `Fees Dues` = '', `P.MO.NO.` = '', `S.MO.NO.` = '', `DOB` = '', `E-mail` = '',`REMARK` = '' WHERE `$hostel`.`srno`= $srno ";
    $result = mysqli_query($conn, $sql);
}
if (isset($_GET['room_no'])) {
    $show_room = $_GET['room_no'];
    $_SESSION['show_room']=$show_room;
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
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <title>Welcome - <?php echo $_SESSION['username'] ?></title>
</head>

<body>
    <!-- edit modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Information of student</h5>
                </div>
                <form action="/hostel/partials/_registration.php" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="srnoEdit" id="srnoEdit">
                        <div class="form-group">
                            <label for="title">Room Number</label>
                            <input type="text" class="form-control" id="room_noEdit" name="room_noEdit" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="Room_type">Room type</label>
                            <input type="text" class="form-control" id="romm_typeEdit" name="romm_typeEdit" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="Name">Name of student</label>
                            <input type="text" class="form-control" id="nameEdit" name="nameEdit" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="Tally">Tally Number</label>
                            <input type="text" class="form-control" id="tally_noEdit" name="tally_noEdit" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="Adhar">Adhar Number</label>
                            <input type="text" class="form-control" id="Adhar_noEdit" name="Adhar_noEdit" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="College">College Name</label>
                            <input type="text" class="form-control" id="collegeEdit" name="collegeEdit" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="Class">Class</label>
                            <input type="text" class="form-control" id="class_Edit" name="class_Edit" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="Branch">Branch</label>
                            <input type="text" class="form-control" id="branchEdit" name="branchEdit" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="Village">Village</label>
                            <input type="text" class="form-control" id="villageEdit" name="villageEdit" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="Taluka">Taluka</label>
                            <input type="text" class="form-control" id="talukaEdit" name="talukaEdit" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="District">District</label>
                            <input type="text" class="form-control" id="districtEdit" name="districtEdit" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="state">State</label>
                            <input type="text" class="form-control" id="stateEdit" name="stateEdit" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="utr_no">UTR Number</label>
                            <input type="text" class="form-control" id="utr_noEdit" name="utr_noEdit" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="utr_date">UTR Date</label>
                            <input type="date" class="form-control" id="utr_dateEdit" name="utr_dateEdit" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="title">Total Fees</label>
                            <input type="text" class="form-control" id="total_feeEdit" name="total_feeEdit" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="title">Fees Paid</label>
                            <input type="text" class="form-control" id="fee_paidEdit" name="fee_paidEdit" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="title">Fee Recipt</label>
                            <input type="text" class="form-control" id="fee_reciptEdit" name="fee_reciptEdit" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="title">Fee Dues (Pending Amount)</label>
                            <input type="text" class="form-control" id="duesEdit" name="duesEdit" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="title">Parents Mobile number</label>
                            <input type="text" class="form-control" id="p_moEdit" name="p_moEdit" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="title">Student Mobile Number</label>
                            <input type="text" class="form-control" id="s_moEdit" name="s_moEdit" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="title">Date of Birth</label>
                            <input type="date" class="form-control" id="dobEdit" name="dobEdit" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="title">Email</label>
                            <input type="text" class="form-control" id="emailEdit" name="emailEdit" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="title">Remark</label>
                            <input type="text" class="form-control" id="remarkEdit" name="remarkEdit" aria-describedby="emailHelp">
                        </div>
                    </div>
                    <div class="modal-footer d-block mr-auto">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php
    if ($update) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>Success!</strong> Your note has been updated successfully
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>×</span>
                </button>
            </div>";
    }
    ?>
    <div class="container my-5">
    <form name="atten" action="">
        <table class="table" id="myTable1">
            <thead>
                <tr>
                    <th scope="col">Sr no</th>
                    <th scope="col">Free</th>
                    <th scope="col">Capacity</th>
                    <th scope="col">Room No</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $username = $_SESSION['username'];
                $sql_ = "SELECT hostel_id FROM `users` WHERE user='$username'";
                $result = mysqli_query($conn, $sql_);
                $row = mysqli_fetch_assoc($result);
                $hostel = $row['hostel_id'];
                // $sql = "SELECT * FROM `$hostel` ORDER BY room_number;";
                $sql = "SELECT COUNT(if(NAME_OF_THE_STUDENTS='',1,null))as occupy,COUNT(if(NOT Room_No='',1,null))as Capacity,Room_No FROM `$hostel` GROUP BY Room_No ORDER BY occupy DESC";
                $result = mysqli_query($conn, $sql);
                $srno = 0;
                $row = mysqli_fetch_assoc($result);
                while ($row = mysqli_fetch_assoc($result)) {
                    $srno = $srno + 1;
                    echo '<tr>
              <th scope="row">' . $srno . '</th>
              <td>' . $row["occupy"] . '</td>
              <td>' . $row["Capacity"] . '</td>
              <td><button class="room_no btn btn-sm btn-primary" id=' . $row["Room_No"] . ' onClick="window.location.reload()">' . $row["Room_No"] . '</button></td>
              </tr>';
                }
                ?>
            </tbody>
        </table>
    </form>
    </div>

    <div class="container my-5" style="overflow-x: auto;">
        <table class="table" id="myTable">
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
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $date_ = date("Y/m/d");
                $username = $_SESSION['username'];
                $sql_ = "SELECT hostel_id FROM `users` WHERE user='$username'";
                $result = mysqli_query($conn, $sql_);
                $row = mysqli_fetch_assoc($result);
                $hostel = $row['hostel_id'];
                // $sql = "SELECT * FROM `$hostel` ORDER BY room_number;";

                $show_room=$_SESSION['show_room'];
                $sql = "SELECT * FROM `$hostel` where Room_No like '$show_room' ORDER BY 'Room No';";
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
              <td> <button class="edit btn btn-sm btn-primary" id=' . $row['srno'] . '>Edit</button><button class="delete btn btn-sm btn-secondary" id=' . $row['srno'] . '>Delete</button></td>
              </tr>';
                }
                ?>


            </tbody>
        </table>
    </div>

    <hr>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <script>
    edits = document.getElementsByClassName('room_no');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("room_no");
        room_no = e.target.id;
        console.log(e.target.id);
        $.ajax({
          type: "POST",
          url: `_registration.php?room_no=${room_no}`
        });
        e.preventDefault();
      })
    })
    </script>
    
    <script>
        edits = document.getElementsByClassName('edit');
        Array.from(edits).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("edit ");
                tr = e.target.parentNode.parentNode;
                room_no = tr.getElementsByTagName("td")[0].innerText;
                romm_type = tr.getElementsByTagName("td")[1].innerText;
                name = tr.getElementsByTagName("td")[2].innerText;
                tally_no = tr.getElementsByTagName("td")[3].innerText;
                Adhar_no = tr.getElementsByTagName("td")[4].innerText;
                college = tr.getElementsByTagName("td")[5].innerText;
                class_ = tr.getElementsByTagName("td")[6].innerText;
                branch = tr.getElementsByTagName("td")[7].innerText;
                village = tr.getElementsByTagName("td")[8].innerText;
                taluka = tr.getElementsByTagName("td")[9].innerText;
                district = tr.getElementsByTagName("td")[10].innerText;
                state = tr.getElementsByTagName("td")[11].innerText;
                utr_no = tr.getElementsByTagName("td")[12].innerText;
                utr_date = tr.getElementsByTagName("td")[13].innerText;
                total_fee = tr.getElementsByTagName("td")[14].innerText;
                fee_paid = tr.getElementsByTagName("td")[15].innerText;
                fee_recipt = tr.getElementsByTagName("td")[16].innerText;
                dues = tr.getElementsByTagName("td")[17].innerText;
                p_mo = tr.getElementsByTagName("td")[18].innerText;
                s_mo = tr.getElementsByTagName("td")[19].innerText;
                dob = tr.getElementsByTagName("td")[20].innerText;
                email = tr.getElementsByTagName("td")[21].innerText;
                remark = tr.getElementsByTagName("td")[22].innerText;
                console.log(room_no, name);
                room_noEdit.value = room_no;
                romm_typeEdit.value = romm_type;
                nameEdit.value = name;
                tally_noEdit.value = tally_no;
                Adhar_noEdit.value = Adhar_no;
                collegeEdit.value = college;
                class_Edit.value = class_;
                branchEdit.value = branch;
                villageEdit.value = village;
                talukaEdit.value = taluka;
                districtEdit.value = district;
                stateEdit.value = state;
                utr_noEdit.value = utr_no;
                utr_dateEdit.value = utr_date;
                total_feeEdit.value = total_fee;
                fee_paidEdit.value = fee_paid;
                fee_reciptEdit.value = fee_recipt;
                duesEdit.value = dues;
                p_moEdit.value = p_mo;
                s_moEdit.value = s_mo;
                dobEdit.value = dob;
                emailEdit.value = email;
                remarkEdit.value=remark;
                srnoEdit.value = e.target.id;
                console.log(e.target.id)
                $('#editModal').modal('toggle');
            })
        })
        deletes = document.getElementsByClassName('delete');
        Array.from(deletes).forEach((element) => {
            element.addEventListener("click", (e) => {
                srno = e.target.id;
                if (confirm("Are you sure you want to delete this record!")) {
                    console.log("yes", srno);
                    window.location = `_details.php?delete=${srno}`;
                }
            })
        })
    </script>
    <!-- <script src="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css"></script> -->
    <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#myTable1').DataTable();
        });
    </script>
</body>

</html>