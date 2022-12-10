<?php
require_once("../phpChart_Lite/conf.php");
?>
<!DOCTYPE HTML>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>phpChart - A Basic Chart</title>
</head>

<body>

    <?php
    $pc = new C_PhpChartX(array(array(100, 9, 5, 12, 14)), 'basic_chart');
    $pc->draw();
    ?>

</body>

</html>