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

foreach ($_SESSION['arrayNameResult'] as $value) {
$studResult = $_GET[$value];
echo $studResult;
echo "<br>";
}

foreach ($_SESSION['arrayNamePosition'] as $value) {
$studPosition = $_GET[$value];
echo $studPosition;
echo "<br>";
}

$insertQuery = "
    INSERT INTO result (studevent_result, result_position)
";

?>
</html>
