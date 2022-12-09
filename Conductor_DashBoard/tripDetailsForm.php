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
    <link rel="stylesheet" type="text/css" href="tripDetails.css">

    <title>Conductor Trip Details</title>
</head>

<body id="grad" class="grad">
    <!-- <a class="button" href="../Login/dist/index.html">Log Out</a> -->
    <a class="button" href="conductorDashboard.php">Go Back</a>
    <div class="maindiv" id="maindiv">

        <form align="center" action="tripconnect.php" method="post">
            <div class="title">

                <h2>Enter Trip Details</h2>
            </div>

            <div class="info">

                <!-- Trip Number: <input type="number" placeholder="Trip Number" name="TripNumber"><br><br> -->
                <label>Trip Number</label>
                <select name="TripNumber" placeholder="Trip Number">
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

                <br><br>Total Revenue: <input type="number" name="totalRevenue" placeholder="Revenue Generated"><br><br>
                Tickets Sold: <input type="number" name="ticketsSold" placeholder="Total Tickets Sold"><br><br>


            </div>

            <br>

            <button type="submit" href="/">Submit</button>
        </form>
    </div>
</body>

</html>