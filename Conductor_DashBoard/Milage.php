<?php
//database connection
$hostName = "localhost";
$userName = "root";
$password = "";
$databaseName = "test4";
 $conn = new mysqli($hostName, $userName, $password, $databaseName);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


$db= $conn;
$tableName="trip_real_details";
$columns= ['trip_no_real', 'fuel','arrival_time','departure_time','km_count'];
$fetchData = fetch_data($db, $tableName, $columns);
function fetch_data($db, $tableName, $columns){
 if(empty($db)){
  $msg= "Database connection error";
 }elseif (empty($columns) || !is_array($columns)) { 
  $msg="columns Name must be defined in an indexed array";
 }elseif(empty($tableName)){
   $msg= "Table Name is empty";
}else{
//$columnName = implode(", ", $columns);
//joins
$query1 = "SELECT bus_details.bus_no,trip_real_details.trip_no_real,(km_count/trip_real_details.fuel) AS MILAGE
FROM bus_details
INNER JOIN trip_real_details ON trip_real_details.trip_no_real = bus_details.trip_no 
ORDER BY MILAGE DESC;";
//$query="SELECT * FROM Milage ORDER BY DESC";
//$db->query($query1);
$result = $db->query($query1);
if($result== true){ 
 if ($result->num_rows > 0) {
    $row= mysqli_fetch_all($result, MYSQLI_ASSOC);
    $msg= $row;
 } else {
    $msg= "No Data Found"; 
 }
}else{
  $msg= mysqli_error($db);
}
}
return $msg;
}
?>


<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
 <div class="row">
   <div class="col-sm-8">
    <?php echo $deleteMsg??''; ?>
    <div class="table-responsive">
      <table class="table table-bordered">
       <thead><tr><th>S.N</th>
         <th>TRIP Number</th>
         <th>Bus Number</th>
         <th>MILAGE</th>
    </thead>
    <tbody>
  <?php
      if(is_array($fetchData)){      
      $sn=1;
      foreach($fetchData as $data){
    ?>
      <tr>
      <td><?php echo $sn; ?></td>
      <td><?php echo $data['trip_no_real']??''; ?></td>
      <td><?php echo $data['bus_no']??''; ?></td>
      <td><?php echo $data['MILAGE']??''; ?></td>
     </tr>
     <?php
      $sn++;}}else{ ?>
      <tr>
        <td colspan="8">
    <?php echo $fetchData; ?>
  </td>
    <tr>
    <?php
    }?>
    </tbody>
     </table>
   </div>
</div>
</div>
</div>
</body>
</html>