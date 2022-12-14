<?php
session_start();

if ($_SESSION['status'] != "Active") {
    header("location:../Login/dist/login.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Driver</title>
    <link rel="icon" type="image/x-icon" href="../Images/favicon.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="tripDetails.css">
    <link rel="stylesheet" type="text/css" href="../Login/dist/style.css">
    <style>
        body {
            background: url("../Images/bg-dark.jpg") no-repeat center;
            background-size: cover;

        }
    </style>
</head>

<body>
    <nav id="mainNavbar" class="navbar navbar-light navbar-expand-md py-1 px-2 fixed-top"
        style="background-color: #0cb2f9;">
        <a class="navbar-brand" href="conductorDashboard.php">
            <img src="../Images/icon.png" width="45" height="35" class="d-inline-block align-middle" alt="">
            BUS MANAGEMENT SYSTEM
        </a>

        <button class="navbar-toggler" data-toggle="collapse" data-target="#navLinks" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-between" id="navLinks">


            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="AdminDashboard.php" class="nav-link">HOME</a>
                </li>
                <li class="nav-item">
                    <a href="../about.html" class="nav-link">ABOUT</a>
                </li>
                <li class="nav-item">
                    <a href="../team.html" class="nav-link">TEAM</a>
                </li>


            </ul>
            <span class="nav-item ml-auto">
                <a class="nav-link" role="button" href="AdminDashboard.php">Go Back</a>
            </span>
            <span class="nav-item">
                <a class="nav-link" role="button" href="../Login/dist/logout.php">Logout</a>
            </span>


        </div>
    </nav>

    <div class="maindiv" id="maindiv" style="width: 30%;">

        <form action="AddDri.php" method="post">
            <div class="title">

                <h2 class="text-center">Add Driver Credentials</h2><br>
            </div>

            <div class="form-group">
                <div class="form-group">
                    <label>Driver ID: </label>
                    <input class="form-control" placeholder="Driver ID" name="did" maxlength="4">
                </div>
                <div class="form-group">
                    <label>Password: </label>
                    <input class="form-control" type="text" placeholder="Password" name="pwd">
                </div>
                <br>
                <button class="btn-item btn-block" style="width: 100%;" name='sub' type="submit">Submit</button>
            </div>
        </form>
    </div>
</body>

<?php

// database connection code
// $con = mysqli_connect('localhost', 'database_user', 'database_password','database');
if (isset($_POST['sub'])) {
    $con = mysqli_connect('localhost', 'root', '', 'test4');

    // get the post records
    $pwd = $_POST['pwd'];
    $did = $_POST['did'];



    // database insert SQL code

    $sql = "INSERT INTO `login_driver`(`user_name`,`password`) 
  VALUES('$did', '$pwd')";

    // insert in database 
    $rs = mysqli_query($con, $sql);

    if ($pwd != '') {
        echo "<script>alert('Driver ADDED!')</script>";
    }

}
?>

</html>