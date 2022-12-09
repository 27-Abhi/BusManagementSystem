<?php

// database connection code
// $con = mysqli_connect('localhost', 'database_user', 'database_password','database');

$con = mysqli_connect('localhost', 'root', '', 'test4');

// Connect to database

// Get all the categories from category table
$sql = "SELECT trip_no FROM `bus_details`"; //for drop down
$trip_nos = mysqli_query($con, $sql);


// get the post records
$TripNumber = $_POST['TripNumber'];
$fuelConsumption = $_POST['fuelConsumption'];
$actualArrivalTime = $_POST['actualArrivalTime'];
$actualDepTime = $_POST['actualDepTime'];
$kmCount = $_POST['kmCount'];

// database insert SQL code

$sql = "INSERT INTO `trip_real_details`(`trip_no_real`, `fuel`, `arrival_time`, `departure_time`, `km_count`) 
  VALUES('$TripNumber', '$fuelConsumption', '$actualArrivalTime', '$actualDepTime', '$kmCount')";

// insert in database 
$rs = mysqli_query($con, $sql);

if ($rs) {
    echo "Records Inserted";
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trip Details</title>
    <link rel="stylesheet" type="text/css" href="driverDetails.css">
</head>

<body id="grad" class="grad">

    <a class="button" href="../Login/dist/index.html">Log Out</a>

    <div class="maindiv" id="maindiv">

        <form align="center" action="dconnect.php" method="post">
            <div id="title" class="title">

                <h2>Enter Trip Details</h2>
            </div>

            <div id="info" class="info">

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

                Fuel consumed: <input class="signup-text-input" type="number" name="fuelConsumption"
                    placeholder="Fuel consumed" /><br><br>

                Actual Arrival Time: <input class="signup-text-input" type="time" name="actualArrivalTime"
                    placeholder="Actual Arrival Time" /><br><br>

                Actual Departure Time: <input type="time" class="signup-text-input" name="actualDepTime"
                    placeholder="Actual Departure Time" /><br><br>

                Kilometer Count: <input name="kmCount" class="signup-text-input" placeholder="Kilometer count"
                    type="number" /><br><br>

            </div>


            <button type="submit" href="/">Submit</button>
        </form>
    </div>
</body>

</html>