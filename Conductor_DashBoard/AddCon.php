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

    <title>Add Conductor </title>
</head>

<body id="grad" class="grad">
    <a class="button" href="../Login/dist/logout.php">Log Out</a>
    <a class="button" href="AdminDashboard.php">Go Back</a>
    <div class="maindiv" id="maindiv">

        <form align="center" action="AddCon.php" method="post">
            <div class="title">

                <h2>Enter Conductor Credentials</h2>
            </div>

            <div class="info">
                ConductorID: <input type="text" placeholder="Conductor ID" name="Cid"><br><br>
                Password: <input type="text" placeholder="password" name="pwd"><br><br>
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
$cid = $_POST['Cid'];



// database insert SQL code

$sql = "INSERT INTO `login`(`user_name`,`password`) 
  VALUES('$cid', '$pwd')";

// insert in database 
$rs = mysqli_query($con, $sql);

if ($pwd != '') {
    echo "<script>alert('Conductor ADDED!')</script>";
}


?>

</html>