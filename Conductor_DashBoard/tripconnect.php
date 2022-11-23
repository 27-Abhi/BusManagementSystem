<?php

// database connection code
// $con = mysqli_connect('localhost', 'database_user', 'database_password','database');

$con = mysqli_connect('localhost', 'root', '','test4');

// get the post records
$TripNumber= $_POST['TripNumber'];
$totalRevenue= $_POST['totalRevenue'];
$ticketsSold= $_POST['ticketsSold'];


// database insert SQL code

$sql = "INSERT INTO `trip_result`(`trip_no_result`, `revenue`, `tickets_sold`) 
  VALUES('$TripNumber', '$totalRevenue', '$ticketsSold')";

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
    <title>Trip Details</title>
</head>

<body>
    <form align="center" action="tripconnect.php" method="post">
        <div class="title">
            <a type="" href="../Login/dist/index.html">Log Out</a>
            <a type="" href="conductorDashboard.html">Go Back</a>
            <h2>Enter Passenger Details</h2>
        </div>

        <div class="info">

            Trip Number: <input type="number" placeholder="Trip Number" name="TripNumber"><br><br>

            Total Revenue: <input type="number" name="totalRevenue" placeholder="Revenue Generated"><br><br>
            Tickets Sold: <input type="number" name="ticketsSold" placeholder="Total Tickets Sold"><br><br>
            

        </div>


        <button type="submit" href="/">Submit</button>
    </form>
</body>

</html>