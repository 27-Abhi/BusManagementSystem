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
    <link rel="stylesheet" type="text/css" href="tripDetails.css">

    <title>Add Driver</title>
</head>

<body id="grad" class="grad">
    <a class="button" href="../Login/dist/logout.php">Log Out</a>
    <a class="button" href="AdminDashboard.php">Go Back</a>
    <div class="maindiv" id="maindiv">

        <form align="center" action="AddDri.php" method="post">
            <div class="title">

                <h2>Enter Driver Credentials</h2>
            </div>

            <div class="info">
                DriverID: <input type="text" placeholder="Driver ID" name="did" required><br><br>
                Password: <input type="text" placeholder="password" name="pwd" required><br><br>
            </div>

            <br>
            <input type="submit" class="btn">
        </form>
    </div>
</body>

<?php

// database connection code
// $con = mysqli_connect('localhost', 'database_user', 'database_password','database');

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


?>

</html>