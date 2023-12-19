<?php
require "_navbar.php";
require "_dbconnect.php";
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false) {
  header("location: /hostel/index.php");
  exit;
}
// $date_ = date("Y/m/d");
// $username = $_SESSION['username'];
// $sql_ = "SELECT hostel_id FROM `users` WHERE user='$username'";
// $result = mysqli_query($conn, $sql_);
// $row = mysqli_fetch_assoc($result);
// $hostel = $row['hostel_id'];
// $tablename = $hostel . "_attendance";
// if (isset($_GET['present'])) {
//   $sno = $_GET['present'];
//   $delete = true;
//   $sql = "UPDATE `$tablename` SET `$date_` = 'p' WHERE `$tablename`.`srno` =$sno;";
//   $result = mysqli_query($conn, $sql);
// }
// if (isset($_GET['absent'])) {
//   $sno = $_GET['absent'];
//   $delete = true;
//   $sql = "UPDATE `$tablename` SET `$date_` = 'a' WHERE `$tablename`.`srno` =$sno;";
//   $result = mysqli_query($conn, $sql);
// }
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
  <h1></h1>
  <div class="container">
    <div class="alert alert-success" role="alert">
      <h4 class="alert-heading">Welcome - <?php echo $_SESSION['username'] ?></h4>
      <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
      <hr>
      <p class="mb-0">Whenever you need to, be sure to use this link to <a href="logout.php">logout</a></p><br>
      <a class="btn btn-primary" href="_report.php" role="button">Submit</a>
    </div>
  </div>

  <!-- student data -->
  <div class="container my-5">
    <form name="atten" action="">
      <table class="table" id="myTable">
        <thead>
          <tr>
            <th scope="col">Sr. no</th>
            <th scope="col">room_number</th>
            <th scope="col">Name</th>
            <th scope="col">Action</th>
            <th scope="col">Current Status</th>
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
          $tablename = $hostel . "_attendance";
          // $sql = "SELECT * FROM `$hostel` ORDER BY room_number;";
          $sql = "SELECT * FROM `$tablename` ORDER BY 'Room No';";
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
              <td>' . $row["NAME_OF_THE_STUDENTS"] . '</td>
              <td>  <button class="present btn btn-sm btn-primary" id=' . $row["srno"] . ' onClick="Reload()">present</button> <button class="leave btn btn-sm btn-primary" id=' . $row["srno"] . ' onClick="Reload()">Leave</button> <button class="absent btn btn-sm btn-primary" id=' . $row["srno"] . ' onClick="Reload()">absent</button></td>
              <td>' . $row["$date_"] . '</td>
              </tr>';
          }
          ?>


        </tbody>
      </table>

    </form>
  </div>


  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
  <script>
    edits = document.getElementsByClassName('present');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("present");
        srno = e.target.id;
        console.log(e.target.id);
        $.ajax({
          type: "POST",
          url: `_demo.php?present=${srno}`,
          data: srno,
        });
        e.preventDefault();
      })
    })
    // window.location.reload();
    edits = document.getElementsByClassName('absent');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("absent");
        srno = e.target.id;
        console.log(e.target.id);
        $.ajax({
          type: "POST",
          url: `_demo.php?absent=${srno}`,
          data: srno,
        });
        e.preventDefault();
      })
    })
    edits = document.getElementsByClassName('leave');
        Array.from(edits).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("leave");
                srno = e.target.id;
                console.log(e.target.id);
                $.ajax({
                    type: "POST",
                    url: `_demo.php?leave=${srno}`,
                    data: srno,
                });
                e.preventDefault();
            })
        })
    // window.location.reload();
  </script>

  <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
  <script>
        function Reload(){
            document.getElementById('myTable').innerHTML;
            location.reload();
        }
    </script>
  <!-- <script>
    $(document).ready(function() {
      $('#myTable').DataTable();
    });
  </script> -->
</body>

</html>