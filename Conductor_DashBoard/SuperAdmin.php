<?php

// database connection code
// $con = mysqli_connect('localhost', 'database_user', 'database_password','database');

$con = mysqli_connect('localhost', 'root', '','test4');

// get the post records
$TripNumber= $_POST['TripNumber'];
$BusNumber= $_POST['BusNumber'];
$Source= $_POST['Source'];
$Destination= $_POST['Destination'];
$Date= $_POST['Date'];


// database insert SQL code

$sql = "INSERT INTO `Bus_details`(`trip_no`,`bus_no`, `Source`, `Destination`,`TripDate`) 
  VALUES('$TripNumber', '$BusNumber', '$Source','$Destination','$Date')";

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

                <h2>Enter Trip Details</h2>
            </div>

            <div class="info">

                Trip Number: <input type="number" placeholder="Trip Number" name="TripNumber"><br><br>
                Bus Number: <input type="number" placeholder="Bus Number" name="BusNumber"><br><br>
                Source: <input type="text" placeholder="Source" name="Source"><br><br>
                Destination: <input type="text" placeholder="Destination" name="Destination"><br><br>
                Date: <input type="date" placeholder="Date" name="Date"><br><br>
               
            </div>

            <br>

            <button type="submit">Submit</button>
        </form>
    </div>
</body>

</html>