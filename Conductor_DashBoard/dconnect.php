<?php

// database connection code
// $con = mysqli_connect('localhost', 'database_user', 'database_password','database');

$con = mysqli_connect('localhost', 'root', '','test4');

// get the post records
$TripNumber= $_POST['TripNumber'];
$fuelConsumption= $_POST['fuelConsumption'];
$actualArrivalTime= $_POST['actualArrivalTime'];
$actualDepTime= $_POST['actualDepTime'];
$kmCount= $_POST['kmCount']; 

// database insert SQL code

$sql = "INSERT INTO `trip_real_details`(`trip_no_real`, `fuel`, `arrival_time`, `departure_time`, `km_count`) 
  VALUES('$TripNumber', '$fuelConsumption', '$actualArrivalTime', '$actualDepTime', '$kmCount')";

// insert in database 
$rs = mysqli_query($con, $sql);

if($rs)
{
	echo "Contact Records Inserted";
}


?>