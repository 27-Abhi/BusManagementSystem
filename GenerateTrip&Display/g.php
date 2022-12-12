<?php

// database connection code
// $con = mysqli_connect('localhost', 'database_user', 'database_password','database');

$con = mysqli_connect('localhost', 'root', '','test4');

// get the post recor
//generating trip id
$query = "SELECT MAX(`trip_no`) AS LASTTRIP  FROM `bus_details`;";
  
// FETCHING DATA FROM DATABASE
$result  = mysqli_query($con, $query);
if ($result->num_rows > 0) 
    {
        // OUTPUT DATA OF EACH ROW
        while($row = $result->fetch_assoc())
        {
           $tripNO= $row['LASTTRIP'];
            $tripNO++;
            echo $tripNO;
        }
    }
    ?>