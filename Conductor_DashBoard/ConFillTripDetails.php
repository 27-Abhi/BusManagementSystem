<?php

// database connection code
// $con = mysqli_connect('localhost', 'database_user', 'database_password','database');

$con = mysqli_connect('localhost', 'root', '','test4');

// get the post records
$TripNumber= $_POST['TripNumber'];
$did= $_POST['did'];
$cid= $_POST['cid'];
$sdep= $_POST['sdep'];
$sarr= $_POST['sarr'];


// database insert SQL code

$sql = "INSERT INTO `trip_incharge`(`trip_no_incharge`,`Driver_emp_id`, `Conductor_emp_id`, `scheduled_dept_time`,`scheduled_arr_time`) 
  VALUES('$TripNumber', '$did', '$cid','$sdep','$sarr')";

// insert in database 
$rs = mysqli_query($con, $sql);

if($rs)
{
	echo "Recorded successfully";
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="tripDetails.css">

    <title>Conductor Trip Details</title>
</head>

<body id="grad" class="grad">
    <a class="button" href="../Login/dist/index.html">Log Out</a>
    <a class="button" href="conductorDashboard.html">Go Back</a>
    <div class="maindiv" id="maindiv">

        <form align="center" action="SuperAdmin.php" method="post">
            <div class="title">

                <h2>Enter Trip Incharge Details</h2>
            </div>

            <div class="info">

            Trip Number: <input type="number" placeholder="Trip Number" name="TripNumber"><br><br>
                Driver ID: <input type="number" placeholder="Bus Number" name="did"><br><br>
                ConductorID: <input type="text" placeholder="Source" name="cid"><br><br>
                Scheduled Departure: <input type="time" placeholder="Destination" name="sdep"><br><br>
                Scheduled Arriival: <input type="time" placeholder="Date" name="sarr"><br><br>
            </div>

            <br>

            <button type="submit" >Submit</button>
        </form>
    </div>
</body>

</html>