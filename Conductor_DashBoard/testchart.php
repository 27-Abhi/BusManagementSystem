<?php

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

    $handle = $link->prepare("SELECT bus_details.trip_no AS x,trip_result.revenue AS y
    FROM trip_result
    INNER JOIN bus_details ON bus_details.trip_no=trip_result.trip_no_result
    WHERE bus_details.bus_no='122'");
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
<!DOCTYPE HTML>
<html>

<head>
    <script>
        window.onload = function () {

            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                exportEnabled: true,
                theme: "light1", // "light1", "light2", "dark1", "dark2"
                title: {
                    text: "PHP Column Chart from Database"
                },
                data: [{
                    type: "line", //change type to bar, line, area, pie, etc  
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
        chart.render();
 
}
    </script>
</head>

<body>
    <div id="chartContainer" style="height: 370px; width: 100%;"></div>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>

</html