<?php
session_start();

if ($_SESSION['status'] != "Active") {
    header("location:../Login/dist/login.php");
}
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
    <title>Trip Details</title>
    <link rel="icon" type="image/x-icon" href="../Images/favicon.ico">
    <link rel="stylesheet" type="text/css" href="driverDetails.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous">
</head>

<body id="grad" class="grad">
<nav id="mainNavbar" class="navbar navbar-light navbar-expand-md py-1 px-2 fixed-top" style="background-color: #0cb2f9;">
		<a class="navbar-brand" href="#">
			<img src="../../Images/icon.png" width="45" height="35" class="d-inline-block align-middle" alt="">
			BUS MANAGEMENT SYSTEM
		</a>

        <button class="navbar-toggler" data-toggle="collapse" data-target="#navLinks" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-between" id="navLinks">

		
            <ul class="navbar-nav">
				<li class="nav-item">
                    <a href="login.php" class="nav-link">HOME</a>
                </li>
                <li class="nav-item">
                    <a href="../../about.html" class="nav-link">ABOUT</a>
                </li>
                <li class="nav-item">
                    <a href="../../team.html" class="nav-link">TEAM</a>
                </li>
				
				
            </ul>
			
			<span class="nav-item">
				<a class="nav-link" role="button" href="adminlogin.php">Admin Login</a>
			</span>
			
        </div>
    </nav>

    <a class="button" href="../Conductor_DashBoard/Driver_DashBoard.php">Go Back</a>

    <div class="maindiv" id="maindiv">

        <form align="center" action="dconnect.php" method="post">
            <div id="title" class="title">

                <h2>Enter Trip Details</h2>
            </div>

            <div id="info" class="info">

                Trip Number: <select name="TripNumber" placeholder="Trip Number">
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
                </select><br><br>

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

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>

    <script>
        $(function () {
            $(document).scroll(function () {
                var $nav = $("#mainNavbar");
                $nav.toggleClass("scrolled", $(this).scrollTop() > $nav.height());
            });
        });
    </script>
	
</body>

</html>