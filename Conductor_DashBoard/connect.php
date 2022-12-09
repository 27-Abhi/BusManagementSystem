<?php

// database connection code
// $con = mysqli_connect('localhost', 'database_user', 'database_password','database');

$con = mysqli_connect('localhost', 'root', '','test4');


$query = "SELECT MAX(`ticket_id`) AS LASTTRIP  FROM `passenger`;";
  
$result  = mysqli_query($con, $query);
if ($result->num_rows > 0) 
    {
        // OUTPUT DATA OF EACH ROW
        while($row = $result->fetch_assoc())
        {
            $TicketID= $row['LASTTRIP'];
            $TicketID++;
        }
    }

// get the post records
$TripNumber= $_POST['TripNumber'];
$PhoneNumber= $_POST['PhoneNumber'];
//$TicketID= $_POST['TicketID'];
$sourceChoice= $_POST['sourceChoice'];
$destinationChoice= $_POST['destinationChoice']; 
$Ticketprice= $_POST['Ticketprice'];




// database insert SQL code

$sql = "INSERT INTO `passenger`(`trip_no_passenger`, `phone_no`, `ticket_id`, `Passenger_source`, `Passenger_destination`, `ticket_price`)   VALUES('$TripNumber', '$PhoneNumber', '$TicketID', '$sourceChoice', '$destinationChoice', '$Ticketprice')";

// insert in database 
$rs = mysqli_query($con, $sql);

if($rs)
{
	echo "Tickets generated. ticket id is '{$TicketID}'";
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="driverDetails.css">
    <title>Passenger Details</title>
</head>

<body id="grad" class="grad">

    <a class="button" href="../Login/dist/index.html">Log Out</a>
    <a class="button" href="conductorDashboard.html">Go Back</a>
    
    <form class="maindiv" id="maindiv" action="connect.php" method="post" align="center">
        <div class="title">
            <h2>Enter Passenger Details</h2>
        </div>

        <div class="info">
            <!--<input type="date" placeholder="Trip Date" name="date">!-->
            Trip Number: <input type="number" placeholder="Trip Number" name="TripNumber"><br><br>
            Phone Number: <input type="number" id="tel" name="PhoneNumber" placeholder="Phone Number" /><br><br>
            <!-- Ticket ID: <input type="text" name="TicketID" placeholder="Ticket ID"><br><br> -->

            Select Source Bus stop: <input type="text" name="sourceChoice" placeholder="Source bus stop"><br><br>
            <!-- <select name="sourceChoice" placeholder="Source bus stop">
                <option value="first">Vasco</option>
                <option value="second" selected>Verna</option>
                <option value="third">Margao</option>
            </select><br><br> -->
            Select Destination Bus stop: <input type="text" name="destinationChoice"
                placeholder="Destination bus stop"><br><br>
            <!-- <select name="destinationChoice" placeholder="Destination bus stop">
                <option value="first" selected>Vasco</option>
                <option value="second">Verna</option>
                <option value="third">Margao</option>
            </select><br><br> -->

            Ticket Price: <input name="Ticketprice" type="number"><br><br>

        </div>


        <button type="submit">Submit</button>
    </form>
</body>

</html>