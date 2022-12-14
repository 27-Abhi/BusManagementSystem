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
$tableName = "trip_result";
$columns = ['trip_no_result', 'revenue', 'tickets_sold'];
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
    $query1 = "SELECT * FROM `RevenuePerBus`"; //mileage is a view
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

  <title>Revenue Generated</title>
  <link rel="icon" type="image/x-icon" href="../Images/favicon.ico">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../Login/dist/style.css">
  <style>
    body {
      background: url("../Images/bg-dark.jpg") no-repeat center;
      background-size: cover;

    }

    .graph {
      display: flex;
      margin: auto;
      padding: 10px;
      align-items: center;
    }

    .chartContainer {
      display: flex;
      justify-content: center;
      vertical-align: middle;
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

  <div class="" style="height: 70%; width: 70%;">
    <div class="row">
      <div class="col-sm">
        <!-- Pie chart code starts here -->
        <div class='graph'>

          <?php
          //$busno = $_GET['BusNumber'];
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

            $handle = $link->prepare("SELECT bus_no AS x,revenue AS y FROM `RevenuePerBus`");
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
                  title: "INR"
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

          <div id="chartContainer" style="height: 100%; width: 100%;"></div> <!--   container for graphs -->

          <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

        </div>
      </div>

      <div class="container col-sm">
        <div class="" id="maindiv">
          <div>
            <div class="col-sm-25">

              <form name="myform" align="center" action="SpecificRevenue.php" method="get">
                <div class="form-group">
                  <br>
                  Search by Bus Number: <input class="form-control" type="number" placeholder="Bus Number"
                    name="BusNumber"><br>
                  <input class="btn btn-primary btn-lg btn-block" type="submit">
                </div>
              </form>
              <?php echo $deleteMsg ?? ''; ?>
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Bus Number</th>
                      <th>Revenue Generated</th>
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
                        <?php echo $data['bus_no'] ?? ''; ?>
                      </td>
                      <td>
                        <?php echo $data['revenue'] ?? ''; ?>
                      </td>
                      <td>
                        <?php echo $data['tickets_sold'] ?? ''; ?>
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
      </div>
    </div>
  </div>



  <!-- Pie chart code ends here -->


</body>

</html>