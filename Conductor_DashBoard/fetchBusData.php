<?php
session_start();

if ($_SESSION['status'] != "Active") {
  header("location:../Login/dist/login.php");
}

?>

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
$tableName="bus_details";
$columns= ['bus_no', 'trip_no','Source','Destination','TripDate'];
$fetchData = fetch_data($db, $tableName, $columns);
function fetch_data($db, $tableName, $columns){
if(empty($db)){
$msg= "Database connection error";
}elseif (empty($columns) || !is_array($columns)) {
$msg="columns Name must be defined in an indexed array";
}elseif(empty($tableName)){
$msg= "Table Name is empty";
}else{
$columnName = implode(", ", $columns);
$query = "SELECT ".$columnName." FROM $tableName"." ";
$result = $db->query($query);
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
  <link rel="stylesheet" type="text/css" href="test.css">
</head>

<body class="grad" id="grad">

  <div class="container" id="Buttondiv">
    <a type="button" class="btn btn-primary" target="">Back</a>
    <!--Enter target href-->
  </div>
  <div class="container" id="maindiv">
    <div>
      <div class="col-sm-25">
        <?php echo $deleteMsg ?? ''; ?>
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>S.N</th>
                <th>Bus Number</th>
                <th>Trip Number</th>
                <th>Source</th>
                <th>Destination</th>
                <th>TripDate</th>
            </thead>
            <tbody>
              <?php
  if (is_array($fetchData)) {
    $sn = 1;
    foreach ($fetchData as $data) {
  ?>
              <tr>
                <td>
                  <?php echo $sn; ?>
                </td>
                <td>
                  <?php echo $data['bus_no'] ?? ''; ?>
                </td>
                <td>
                  <?php echo $data['trip_no'] ?? ''; ?>
                </td>
                <td>
                  <?php echo $data['Source'] ?? ''; ?>
                </td>
                <td>
                  <?php echo $data['Destination'] ?? ''; ?>
                </td>
                <td>
                  <?php echo $data['TripDate'] ?? ''; ?>
                </td>
              </tr>
              <?php
      $sn++;
    }
  } else { ?>
              <tr>
                <td colspan="8">
                  <?php echo $fetchData; ?>
                </td>
              <tr>
                <?php
  } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</body>

</html>