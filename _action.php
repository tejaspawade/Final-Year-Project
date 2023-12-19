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
        $sno = $_POST["srnoEdit"];
        $user = $_POST["userEdit"];
        $designation = $_POST["designationEdit"];
        $hostel_id = $_POST["hostel_idEdit"];

        // Sql query to be executed
        $pass = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE `users` SET `user` = '$user' , `designation` = '$designation',`hostel_id` = '$hostel_id' WHERE `users`.`srno`= $sno ";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $update = true;
        }
    }
    if (isset($_POST['srnodelete'])) {
        $sno = $_POST["srnodelete"];
        $user = $_POST["userdelete"];
        $password = $_POST["passworddelete"];
        $hostel_id = $_POST["hostel_iddelete"];
        $sql = "DELETE FROM `users` WHERE `users`.`srno` = $sno";
        $result = mysqli_query($conn, $sql);
    }
}
// if (isset($_GET['delete_entry'])) {
//     $sno = $_GET['delete_entry'];
//     $delete = true;
//     $sql = "DELETE FROM `users` WHERE `srno` = $sno";
//     $result = mysqli_query($conn, $sql);
// } else {
//     echo "not deleted";
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

    <title>Welcome - <?php echo $_SESSION['username'] ?></title>
</head>

<body>
    <!-- edit modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit this Note</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="/hostel/partials/_action.php" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="srnoEdit" id="srnoEdit">
                        <div class="form-group">
                            <label for="title">User name</label>
                            <input type="text" class="form-control" id="userEdit" name="userEdit" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="title">Hostel ID</label>
                            <input type="text" class="form-control" id="hostel_idEdit" name="hostel_idEdit" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="designationEdit">Designation</label>
                            <select class="form-control" id="designationEdit" name="designationEdit">
                                <option>Rector</option>
                                <option>Admin</option>
                                <option>Registration</option>
                                <option>Management</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer d-block mr-auto">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- delete modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete this Note</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="/hostel/partials/_action.php" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="srnodelete" id="srnodelete">
                        <div class="form-group">
                            <label for="title">User name</label>
                            <input type="text" class="form-control" id="userdelete" name="userdelete" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="title">Hostel ID</label>
                            <input type="text" class="form-control" id="hostel_iddelete" name="hostel_iddelete" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="designation">Designation</label>
                            <input type="text" class="form-control" id="designationdelete" name="designationdelete" aria-describedby="emailHelp">
                        </div>
                    </div>
                    <div class="modal-footer d-block mr-auto">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Delete record</button>
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
    <div class="container" style="margin: 100px;">

        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">Sr. no</th>
                    <th scope="col">User</th>
                    <th scope="col">Hostel id</th>
                    <th scope="col">Designation</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM `users`";
                $result = mysqli_query($conn, $sql);
                $srno = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $srno = $srno + 1;
                    echo "<tr>
              <th scope='row'>" . $srno . "</th>
              <td>" . $row['user'] . "</td>
              <td>" . $row['hostel_id'] . "</td>
              <td>" . $row['designation'] . "</td>
              <td> <button class='edit btn btn-sm btn-primary' id=" . $row['srno'] . ">Edit</button> <button class='delete btn btn-sm btn-primary' id=" . $row['srno'] . ">Delete</button></td>
              </tr>";
                    // echo $row['srno']." Title: ".$row['title']." Desc: ".$row['description'];
                    // echo "<br>";
                }
                ?>


            </tbody>
        </table>

        <a class="btn btn-primary" href="adduser.php" role="button">ADD User</a>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        edits = document.getElementsByClassName('edit');
        Array.from(edits).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("edit ");
                tr = e.target.parentNode.parentNode;
                user = tr.getElementsByTagName("td")[0].innerText;
                hostel_id = tr.getElementsByTagName("td")[1].innerText;
                designation = tr.getElementsByTagName("td")[2].innerText;
                console.log(user, hostel_id, designation);
                userEdit.value = user;
                designationEdit.value = designation;
                hostel_idEdit.value = hostel_id;
                srnoEdit.value = e.target.id;
                console.log(e.target.id)
                $('#editModal').modal('toggle');
            })
        })
        deletes = document.getElementsByClassName('delete');
        Array.from(deletes).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("delete");
                tr = e.target.parentNode.parentNode;
                user = tr.getElementsByTagName("td")[0].innerText;
                hostel_id = tr.getElementsByTagName("td")[1].innerText;
                designation = tr.getElementsByTagName("td")[2].innerText;
                console.log(user, hostel_id, tr.getElementsByTagName("td")[2].innerText);
                userdelete.value = user;
                designationdelete.value = designation;
                hostel_iddelete.value = hostel_id;
                srnodelete.value = e.target.id;
                console.log(e.target.id)
                $('#deleteModal').modal('toggle');
            })
        })
    </script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
</body>

</html>