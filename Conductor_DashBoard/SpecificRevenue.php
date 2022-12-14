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


$db = $conn;
$tableName = "trip_real_details";

$columns = ['trip_no_real', 'fuel', 'arrival_time', 'departure_time', 'km_count'];
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
    $busno = $_GET['BusNumber'];

    $query1 = "SELECT `bus_details`.`bus_no` AS `bus_no`, SUM(trip_result.revenue) AS revenue,SUM(trip_result.tickets_sold) as tickets_sold  
FROM (`bus_details` join `trip_result` on(`trip_result`.`trip_no_result` = `bus_details`.`trip_no`))
WHERE bus_no='$busno'";
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

  <title>Bus Revenue</title>
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
        <a class="nav-link" role="button" href="AllBusRevenue.php">Go Back</a>
      </span>
      <span class="nav-item">
        <a class="nav-link" role="button" href="../Login/dist/logout.php">Logout</a>
      </span>


    </div>
  </nav>

  <div class="container" id="maindiv">
    <div>
      <div class="col-sm-25">

        <form name="myform" align="center" action="SpecificRevenue.php" method="get">
          <div class="info">
            <br>
            Search by Bus Number: <input class="form-control" type="number" placeholder="Bus Number"
              name="BusNumber"><br>
            <input class="btn btn-primary btn-block" type="submit">
          </div>
        </form>

        <br>


        <?php echo $deleteMsg ?? ''; ?>
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>#</th>
                <th>Bus Number</th>
                <th>Revenue</th>
                <th>Tickets Sold</th>
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
                  <?php $busNum = $data['bus_no'] ?? '';
                    if (!$busNum) {
                      echo "<script>alert('incorrect bus number')</script>";
                      echo "Bus number not found";
                    } // if empty value fetched from database, echos bus no not found
                    else {
                      echo "$busNum";
                    } ?>
                </td>
                <td>
                  <?php if (!$busNum) {
                      echo "Bus number not found";
                    } else {
                      echo $data['revenue'] ?? '';
                    } ?>
                </td>
                <td>
                  <?php if (!$busNum) {
                      echo "Bus number not found";
                    } else {
                      echo $data['tickets_sold'] ?? '';
                    }
                    ?>
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

<!-- 
// $busno = $_GET['BusNumber'];
// $dataPoints = array();
// //Best practice is to create a separate file for handling connection to database
// try {
//   // Creating a new connection.
//   // Replace your-hostname, your-db, your-username, your-password according to your database
//   $link = new \PDO(
//     'mysql:host=localhost;dbname=test4;charset=utf8mb4',
//     //'mysql:host=localhost;dbname=canvasjs_db;charset=utf8mb4',
//     'root',
//     //'root',
//     '',
//     //'',
//     array(
//         \PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
//         \PDO::ATTR_PERSISTENT => false
//     )
//   );

//   $handle = $link->prepare("SELECT bus_details.trip_no AS x,trip_result.revenue AS y
//     FROM trip_result
//     INNER JOIN bus_details ON bus_details.trip_no=trip_result.trip_no_result
//     WHERE bus_details.bus_no='$busno'");
//   $handle->execute();
//   $result = $handle->fetchAll(\PDO::FETCH_OBJ);

//   foreach ($result as $row) {
//     array_push($dataPoints, array("x" => $row->x, "y" => $row->y));
//   }
//   $link = null;
// } catch (\PDOException $ex) {
//   print($ex->getMessage());
// }

?>
<!DOCTYPE HTML>
<html>

<head>
  <script>
    window.onload = function () {

      var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        exportEnabled: true,
        theme: "light2", // "light1", "light2", "dark1", "dark2"

        title: {
          text: "Revenue"
        },
        axisY: {
          title: "INR"
        },
        axisX: {
          title: "Trip Number"
        },
        data: [{
          type: "bar", //change type to bar, line, area, pie, etc  
          dataPoints: <?php// echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
    chart.render();
 
}

  </script>
  <style>
    #chartContainer {
      display: flex;
      justify-content: center;


    }
  </style>
</head>

<body>
  <div id="chartContainer" style="height: 320px; width: 50%;"></div>
  <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>

</html> -->