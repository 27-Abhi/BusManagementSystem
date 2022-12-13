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
    
    <title>Passenger Details</title>
    <link rel="icon" type="image/x-icon" href="../Images/favicon.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="driverDetails.css">
    <link rel="stylesheet" type="text/css" href="../Login/dist/style.css">
    <style>
        body {
            background: url("../Images/bg-dark.jpg") no-repeat center;
            background-size: cover;
                      
        }
    </style>
</head>

<body>

    <nav id="mainNavbar" class="navbar navbar-light navbar-expand-md py-1 px-2 fixed-top" style="background-color: #0cb2f9;">
		<a class="navbar-brand" href="conductorDashboard.php">
			<img src="../Images/icon.png" width="45" height="35" class="d-inline-block align-middle" alt="">
			BUS MANAGEMENT SYSTEM
		</a>

        <button class="navbar-toggler" data-toggle="collapse" data-target="#navLinks" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-between" id="navLinks">

		
            <ul class="navbar-nav">
				<li class="nav-item">
                    <a href="conductorDashboard.php" class="nav-link">HOME</a>
                </li>
                <li class="nav-item">
                    <a href="../about.html" class="nav-link">ABOUT</a>
                </li>
                <li class="nav-item">
                    <a href="../team.html" class="nav-link">TEAM</a>
                </li>
				
				
            </ul>
			<span class="nav-item ml-auto">
                <a class="nav-link" role="button" href="conductorDashboard.php">Go Back</a>
			</span>
			<span class="nav-item">
				<a class="nav-link" role="button" href="../Login/dist/logout.php">Logout</a>
			</span>
            
			
        </div>
    </nav>
       
    <div class="maindiv" id="maindiv" style="width: 30%; padding:2%;">
        <form action="connect.php" method="post">
            <div class="title">
                <h2 class="text-center">Enter Passenger Details</h2>
            </div>
            <br>
            <div class="info">
                <!--<input type="date" placeholder="Trip Date" name="date">!-->
                <!-- Trip Number: <input type="number" placeholder="Trip Number" name="TripNumber"><br><br> -->
                <div class="form-group">
                <label>Trip Number:</label>
                <select class="form-control" name="TripNumber" placeholder="Trip Number">
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
                </div>

                <div class="form-group">
                    <label for="PhoneNumber">Phone Number</label>
                    <input class="form-control" type="number" id="tel" name="PhoneNumber" placeholder="Phone Number">
                </div>
            
                <div class="form-group">
                    <label>Select Source Bus stop: </label>
                    <input class="form-control" type="text" name="sourceChoice" placeholder="Source bus stop">
                    <!-- <select name="sourceChoice" placeholder="Source bus stop">
                        <option value="first">Vasco</option>
                        <option value="second" selected>Verna</option>
                        <option value="third">Margao</option>
                    </select><br><br> -->
                </div>
                <div class="form-group">
                <label>Select Destination Bus stop: </label>
                <input class="form-control" type="text" name="destinationChoice" placeholder="Destination bus stop">
                <!-- <select name="destinationChoice" placeholder="Destination bus stop">
                    <option value="first" selected>Vasco</option>
                    <option value="second">Verna</option>
                    <option value="third">Margao</option>
                </select><br><br> -->
                </div>
                <div class="form-group">
                <label>Ticket Price: </label>
                <input class="form-control" placeholder="Ticket Price" name="Ticketprice" type="number">
                </div>
            </div>
            
            

            <button type="submit">Submit</button>
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