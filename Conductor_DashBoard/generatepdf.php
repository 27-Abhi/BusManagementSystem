<?php 
Class dbObj{
    /* Database connection start */
    var $dbhost = "localhost";
    var $username = "root";
    var $password = "";
    var $dbname = "test4";
    var $conn;
    function getConnstring() {
    $con = mysqli_connect($this->dbhost, $this->username, $this->password, $this->dbname) or die("Connection failed: " . mysqli_connect_error());
    /* check connection */
    if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
    } else {
    $this->conn = $con;
    }
    return $this->conn;
    }
    }

$db = new dbObj();
$connString =  $db->getConnstring();
$display_heading = array('trip_no'=>'Trip Number', 'bus_no'=> 'Bus Number', 'Source'=> 'Source','Destination'=> 'Destination','TripDate'=> 'Date');
$result = mysqli_query($connString, "SELECT * FROM bus_details") or die("database error:". mysqli_error($connString));
$header = mysqli_query($connString, "SHOW columns FROM bus_details");
$pdf = new PDF();
//header
$pdf->AddPage();
//foter page
$pdf->AliasNbPages();
$pdf->SetFont('Arial','B',12);
foreach($header as $heading) {
$pdf->Cell(40,12,$display_heading[$heading['Field']],1);
}
foreach($result as $row) {
$pdf->Ln();
foreach($row as $column)
$pdf->Cell(40,12,$column,1);
}
$pdf->Output();
?>
