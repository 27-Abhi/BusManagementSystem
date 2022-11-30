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
$busno=$_GET['BusNumber'];

$query1 = "SELECT `bus_details`.`bus_no` AS `bus_no`, SUM(trip_result.revenue) AS revenue,SUM(trip_result.tickets_sold) as tickets_sold  
FROM (`bus_details` join `trip_result` on(`trip_result`.`trip_no_result` = `bus_details`.`trip_no`))
WHERE bus_no='$busno'";
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

  <link rel="stylesheet" type="text/css" href="driverDetails.css">
  <link rel="stylesheet" type="text/css" href="test.css">

</head>
<body class="grad" id="grad">
<div class="container" id="maindiv">
 <div class="row">
   <div class="col-sm-8">
    
   <form name="myform" align="center" action="SpecificRevenue.php" method="get">
        <div class="info">

            Search BY: Bus Number: <input type="number" placeholder="Bus Number" name="BusNumber"><br><br>
            <input class="btn btn-primary btn-lg btn-block" type="submit">
        </div>




        <script>  var name = document.forms["myForm"]["BusNumber"].value;
      if(name==" "){
      alert("Not a valid bus number");
      }</script>
    <?php echo $deleteMsg??''; ?>
    <div class="table-responsive">
      <table class="table table-bordered">
       <thead><tr><th>S.N</th>
         <th>Bus Number</th>
         <th>Revenue</th>
         <th>Tickets sold</th>
    </thead>
    <tbody>
  <?php
      if(is_array($fetchData)){      
      $sn=1;
      foreach($fetchData as $data){
    ?>
    
      <tr>
      <td><?php echo $sn; ?></td>
      <td><?php $busNum= $data['bus_no']??'';
      if(!$busNum){echo "bus number not found";} // if empty value fetched from database, echos bus no not found
      else{echo "$busNum";} ?></td>
      <td><?php if(!$busNum){echo "bus number not found";}
      else{ echo $data['revenue']??'';} ?></td>
      <td><?php if(!$busNum){echo "bus number not found";}
      else{ echo $data['tickets_sold']??'';} ?></td>
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