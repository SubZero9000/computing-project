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
/* loops through each row in the global $_SESSION variable which
contains the array and uses the $value to GET the data in the text
boxes and output them */

// studevent_result = 
foreach ($_SESSION['arrayNameResult'] as $value) {
$studResult = $_GET[$value];
echo $studResult;
echo "<br>";
}

// result_postion = 
foreach ($_SESSION['arrayNamePosition'] as $value) {
$studPosition = $_GET[$value];
echo $studPosition;
echo "<br>";
}

echo "<br>";

// stud_id = 
foreach ($_SESSION['arrayId'] as $value) {
echo $value;
echo "<br>";
}

// UPDATE query, this will update the studevent_result and result_position
// column in the database for the specific stud_id.
$updateQuery = "
    UPDATE result
    SET studevent_result = '00:20:33',
        result_position = '6'
    WHERE result.stud_id = '12'
";
$updateRow = mysqli_query($conn, $updateQuery);
mysqli_close($conn);
?>
</html>
