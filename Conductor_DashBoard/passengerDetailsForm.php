<?php

// Connect to database
$con = mysqli_connect("localhost", "root", "", "test4");

// mysqli_connect("servername","username","password","database_name")

// Get all the categories from category table
$sql = "SELECT trip_no FROM `bus_details`";
$trip_nos = mysqli_query($con, $sql);
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

    <!-- <a class="button" href="../Login/dist/index.html">Log Out</a> -->
    <a class="button" href="conductorDashboard.php">Go Back</a>

    <form class="maindiv" id="maindiv" action="connect.php" method="post" align="center">
        <div class="title">
            <h2>Enter Passenger Details</h2>
        </div>

        <div class="info">
            <!--<input type="date" placeholder="Trip Date" name="date">!-->
            <!-- Trip Number: <input type="number" placeholder="Trip Number" name="TripNumber"><br><br> -->

            Trip Number:<select name="TripNumber" placeholder="Trip Number">
                <?php
                // use a while loop to fetch data
                // from the $all_categories variable
                // and individually display as an option
                while (
                    $bus_details = mysqli_fetch_array(
                        $trip_nos,
                    MYSQLI_ASSOC
                    )
                ):
                    ;
                ?>
                <option value="<?php echo $bus_details["trip_no"];
                    // The value we usually set is the primary key
                ?>">
                    <?php echo $bus_details["trip_no"];
                    // To show the category name to the user
                    ?>
                </option>
                <?php
                endwhile;
                // While loop must be terminated
                ?>
            </select>
            <br><br>Phone Number: <input type="value" id="tel" name="PhoneNumber" placeholder="Phone Number" /><br><br>
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