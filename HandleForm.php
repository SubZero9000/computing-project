<!DOCTYPE html>
<html>
<head></head>

<body>
<!--CSS for HandleForm.php-->
<style>
	div {
		width: 100%;
		height: 240px;
		font-family: "sans-serif";
		border: 3px solid #0047b3; /*Blue border*/
		background-color: #4d94ff; /*Light Blue background*/
	}	

/* Button animation (from w3schools.com) */

.button {
  display: inline-block;
  padding: 15px 25px;
  cursor: pointer;
  text-align: center;	
  text-decoration: none;
  outline: none;
  color: #fff;
  background-color: #001f4d;
  border: none;
  border-radius: 15px;
  box-shadow: 0 9px #999;
  width: 250px;
}

.button:hover {background-color: #4d4dff}

.button:active {
  background-color: #4d4dff;
  box-shadow: 0 5px #666;
  transform: translateY(4px);

}
</style>

<div>
<center>
<h2>Form submitted successfully!</h2>
<!-- Returns user to resultEntryInputForm.php -->
<!--CODE FROM w3schools http://www.w3schools.com/jsref/met_his_back.asp-->
 <button class="button" onclick="goBack()">Return to previous page</button>

<script>
function goBack() {
    window.history.back();
}
</script>
<br>
<br>
<!-- Returns user to selection.html -->
<input name="btnBack" class="button" type="button" value="Return to home page" onclick="window.open('selection.html','_self')"/>
</center>
</div>

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
    //echo $points;
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

// Points for each student in the event
$studPoints = array();
$i = 0;
foreach ($arrayPoints as $value) {
    $studPoints[$i] = $value;
    $i++;
}

// UPDATE query loops through all the values of $studResult,
// $studPosition and $stud_id
for ($j = 0; $j < $i; $j++) {
    $updateQuery = "
  UPDATE result
  SET studevent_result = '$studResult[$j]',
      result_position = '$studPosition[$j]',
      result_studpoints = '$studPoints[$j]'
  WHERE result.stud_id = '$stud_id[$j]'
  ";
    
    $updateRow = mysqli_query($conn, $updateQuery);
}

mysqli_close($conn);
?>
</body>
</html>
