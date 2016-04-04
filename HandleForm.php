<!DOCTYPE html>
<html>
<?php
// Connecting to SQL server
$servername = "localhost";
$username   = "root";
$password   = "Lampserve1";
$dbname     = "brent_athletics";

// Creates connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    echo "Connected!";
}
echo "<br>";

session_start();
// Values of the text box (txtBox)
$i = 0;
$studResult = array();
foreach ($_SESSION['arrayNameResult'] as $value) {
    $studResult[$i] = $_GET[$value];
    $i++;
}

// Values of drop-down lists (cmbPosition)
$studPosition = array();
$i = 0;
foreach ($_SESSION['arrayNamePosition'] as $value) {
    $studPosition[$i] = $_GET[$value];
    $i++;
// Calculates the points for each student in the event
    $points = ($_SESSION['noStudents']+1) - $_GET[$value]; 
    echo $points;
// Array which stores all the values of $points.
    $arrayPoints[] = $points; 
}

// $_SESSION variable stores the array $arraypoints
$_SESSION['arrayPoints'] = $arrayPoints;

// stud_id of the specific studuents
$stud_id = array();
$i = 0;
foreach ($_SESSION['arrayId'] as $value) {
    $stud_id[$i] = $value;
    $i++;
}

// UPDATE query loops through all the values of $studResult,
// $studPosition and $stud_id
for ($j = 0; $j < $i; $j++) {
    $updateQuery = "
  UPDATE result
  SET studevent_result = '$studResult[$j]',
    result_position = '$studPosition[$j]'
  WHERE result.stud_id = '$stud_id[$j]'
  ";
    
    $updateRow = mysqli_query($conn, $updateQuery);
}

mysqli_close($conn);
?>
</html>
