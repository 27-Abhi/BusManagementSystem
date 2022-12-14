<?php
session_start();

if ($_SESSION['status'] != "Active") {
  header("location:../Login/dist/login.php");
}
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


$db = $conn;
$tableName = "quicktrips";
$columns = ['Trip_no', 'fuel', 'arrival_time', 'departure_time', 'km_count'];
//$busno=$_GET['BusNumber'];
$fetchData = fetch_data($db, $tableName, $columns);
function fetch_data($db, $tableName, $columns)
{
  if (empty($db)) {
    $msg = "Database connection error";
  } elseif (empty($columns) || !is_array($columns)) {
    $msg = "columns Name must be defined in an indexed array";
  } elseif (empty($tableName)) {
    $msg = "Table Name is empty";
  } else {
    //$columnName = implode(", ", $columns);
//joins
    $query1 = "SELECT * FROM `quicktrips`";
    //$query="SELECT * FROM Milage ORDER BY DESC";
//$db->query($query1);
    $result = $db->query($query1);
    if ($result == true) {
      if ($result->num_rows > 0) {
        $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $msg = $row;
      } else {
        $msg = "No Data Found";
      }
    } else {
      $msg = mysqli_error($db);
    }
  }
  return $msg;
}
?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Quick Trips</title>
  <link rel="icon" type="image/x-icon" href="../Images/favicon.ico">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <link rel="stylesheet" type="text/css" href="../Login/dist/style.css">
  <style>
    body {
      background: url("../Images/bg-dark.jpg") no-repeat center;
      background-size: cover;

    }
  </style>
</head>

<body>
  <nav id="mainNavbar" class="navbar navbar-light navbar-expand-md py-1 px-2 fixed-top"
    style="background-color: #0cb2f9;">
    <a class="navbar-brand" href="#">
      <img src="../Images/icon.png" width="45" height="35" class="d-inline-block align-middle" alt="">
      BUS MANAGEMENT SYSTEM
    </a>

    <button class="navbar-toggler" data-toggle="collapse" data-target="#navLinks" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-between" id="navLinks">


      <ul class="navbar-nav">
        <li class="nav-item">
          <a href="AdminDashboard.php" class="nav-link">HOME</a>
        </li>
        <li class="nav-item">
          <a href="../about.html" class="nav-link">ABOUT</a>
        </li>
        <li class="nav-item">
          <a href="../team.html" class="nav-link">TEAM</a>
        </li>


      </ul>
      <span class="nav-item ml-auto">
        <a class="nav-link" role="button" href="AdminDashboard.php">Go Back</a>
      </span>
      <span class="nav-item">
        <a class="nav-link" role="button" href="../Login/dist/logout.php">Logout</a>
      </span>


    </div>
  </nav>


  <div class="container" id="maindiv"  style="height:50%">
    <div>
      <div class="col-sm-25">

        <?php echo $deleteMsg ?? ''; ?>
        <div class="table-responsive">
          <table class="table table-hover table-bordered table-striped mb-0" style="text-align: center;">
            <thead>
              <tr>
                <th>S.N</th>
                <th>Trip Number</th>
                <th>Fuel</th>
                <th>Departure Time</th>
                <th>Arrival Time</th>
                <th>Km count</th>
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
                  <?php echo $data['Trip_no'] ?? ''; ?>
                </td>
                <td>
                  <?php echo $data['fuel'] ?? ''; ?>
                </td>
                <td>
                  <?php echo $data['departure_time'] ?? ''; ?>
                </td>
                <td>
                  <?php echo $data['arrival_time'] ?? ''; ?>
                </td>
                <td>
                  <?php echo $data['km_count'] ?? ''; ?>
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