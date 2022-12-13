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
$tableName = "trip_real_details";
$columns = ['trip_no_real', 'fuel', 'arrival_time', 'departure_time', 'km_count'];
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
    $query1 = "SELECT * FROM `mileage`"; //mileage is a view
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
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="test.css">
</head>

<body class="grad" id="grad">

  <div class="container" id="Buttondiv">
    <a type="button" href="AdminDashboard.php" class="btn btn-primary" target="">Back</a>
    <!--Enter target href-->
  </div>


  <style>
    .graph {
      display: flex;
      margin: auto;
      padding: 10px;
      align-items: center;
    }
  </style>
  <div class="graph">
    <?php

    //BAR GRAPH CODE STARTS HERE
    $dataPoints = array();
    //Best practice is to create a separate file for handling connection to database
    try {
      // Creating a new connection.
      // Replace your-hostname, your-db, your-username, your-password according to your database
      $link = new \PDO(
        'mysql:host=localhost;dbname=test4;charset=utf8mb4',
        //'mysql:host=localhost;dbname=canvasjs_db;charset=utf8mb4',
        'root',
        //'root',
        '',
        //'',
        array(
            \PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_PERSISTENT => false
        )
      );

      $handle = $link->prepare("SELECT bus_no AS x,MILAGE AS y
   FROM `mileage`");
      $handle->execute();
      $result = $handle->fetchAll(\PDO::FETCH_OBJ);

      foreach ($result as $row) {
        array_push($dataPoints, array("x" => $row->x, "y" => $row->y));
      }
      $link = null;
    } catch (\PDOException $ex) {
      print($ex->getMessage());
    }

    ?>

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
            title: "Milage"
          },
          axisX: {
            title: "Trip Number"
          },
          data: [{
            indexLabel: "{x}",
            legendText: "{x}",
            showInLegend: true,
            type: "pie", //change type to bar, line, area, pie, etc  
            dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
      chart.render();
 
}
    </script>
    <style>
      .chartContainer {
        display: flex;
        justify-content: center;
        vertical-align: middle;
      }
    </style>

    <div id="chartContainer" margin:0 auto style="height: 300px; width: 30%;"></div>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>



  </div>

  <!-- GRAPH CODE ENDS HER -->

  <!-- SEARCH CODE STARTS HERE -->
  <div class="container" id="maindiv">
    <div>
      <div class="col-sm-25">

        <form align="center" action="milageBusNo.php" method="get">
          <div class="info">

            Search BY: Bus Number: <input type="number" placeholder="Bus Number" name="BusNumber"><br><br>
            <input class="btn btn-primary btn-lg btn-block" type="submit">
          </div>





          <?php echo $deleteMsg ?? ''; ?>
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>S.N</th>
                  <th>Bus Number</th>
                  <th>MILAGE</th>
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
                      echo "bus number not found";
                    } // if empty value fetched from database, echos bus no not found
                    else {
                      echo "$busNum";
                    } ?>
                  </td>
                  <td>
                    <?php if (!$busNum) {
                      echo "bus number not found";
                    } else {
                      echo $data['MILAGE'] ?? '';
                    } ?>
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