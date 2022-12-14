<?php

session_start();

if ($_SESSION['status'] != "Active") {
    header("location:../Login/dist/login.php");
}

// database connection code
// $con = mysqli_connect('localhost', 'database_user', 'database_password','database');

$con = mysqli_connect('localhost', 'root', '', 'test4');

// get the post records
$TripNumber = $_POST['TripNumber'];
$did = $_POST['did'];
$cid = $_POST['cid'];
$sdep = $_POST['sdep'];
$sarr = $_POST['sarr'];


// database insert SQL code

$sql = "INSERT INTO `trip_incharge`(`trip_no_incharge`,`Driver_emp_id`, `Conductor_emp_id`, `scheduled_dept_time`,`scheduled_arr_time`) 
  VALUES('$TripNumber', '$did', '$cid','$sdep','$sarr')";

// insert in database 
$rs = mysqli_query($con, $sql);

if ($rs) {
    echo "<p style='color:#EA1C2C;margin:70px 0px 0px 0px;'>Recorded successfully.</p>";
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
    <a class="button" href="../Login/dist/login.php">Log Out</a>
    <a class="button" href="AdminDashboard.php">Go Back</a>
    <div class="maindiv" id="maindiv">

        <form align="center" action="ConFillTripDetails.php" method="post">
            <div class="title">

                <h2>Enter Trip Incharge Details</h2>
            </div>

            <div class="info">

                Trip Number: <input type="number" placeholder="Trip Number" name="TripNumber" required><br><br>
                Driver ID: <input type="number" placeholder="Bus Number" name="did" required><br><br>
                ConductorID: <input type="text" placeholder="Source" name="cid" required><br><br>
                Scheduled Departure: <input type="time" placeholder="Destination" name="sdep" required><br><br>
                Scheduled Arriival: <input type="time" placeholder="Date" name="sarr" required><br><br>
            </div>

            <br>

            <button type="submit">Submit</button>
        </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
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