<?php
if(session_start())
{
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false) {
        $set_ = false;
    } 
    else {
        $set_ = true;
    }
}
else{
    session_start();
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false) {
        $set_ = false;
    } 
    else {
        $set_ = true;
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="CSS/index.css">
</head>

<body>
    <?php
    echo '<nav class="main-nav">
    <div class="Logo">
        <img src="CSS/Logo-2-4.png" alt="" width="350" height="80">
    </div>
    <div class="menu-link">
    <ul>';

    if(!$set_){
        echo'
            </ul>
            </div>
    </nav>';
        }
    if ($set_) {
    if($_SESSION['designation']=='Management' or $_SESSION['designation']=='student' or $_SESSION['designation']=='Registration')
    {
        echo'<li class="nav-item active">
        <a class="nav-link" href="/hostel/partials/logout.php">Logout</a>
    </li>
    </ul>
            </div>
    </nav>';
    }
    else{
        if($_SESSION['designation']=='Admin')
        {
            echo'
                 <li >
                        <a class="nav-link" href="/hostel/partials/_action.php">Users Action</a>
                    </li>';
        }
        echo'       <li class="nav-item active">
                        <a class="nav-link" href="/hostel/partials/_attendance.php">Attendance</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="/hostel/partials/_details.php">Details</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="/hostel/partials/_home.php">Home</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="/hostel/partials/_stat.php">Statistics</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="/hostel/partials/logout.php">Logout</a>
                    </li>
                    
                </ul>
                <br>
                <br>
        </div>
    </nav>';
    } 
}
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>