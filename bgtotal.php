<!DOCTYPE html>
<html>
<?php
// Connecting to SQL server
$servername = "localhost";
$username = "root";
$password = "Lampserve1";
$dbname = "brent_athletics";

// Creates connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
die("Connection failed: " . mysqli_connect_error());
} else {
	echo "Connected!";
}
echo "<br>";

// Sum of boys and girls
$myQuery = "
  SELECT SUM(result_studpoints) AS totalbg, stud_gender
  FROM result
  JOIN students ON result.stud_id WHERE result.stud_id = students.stud_id
  GROUP BY stud_gender
";
$result = mysqli_query($conn, $myQuery);

// Checks to see if result query works
if (!$result) {
echo "FAIL";
}

// Output
while ($data = mysqli_fetch_assoc($result)) {
echo "Total " . $data['stud_gender'] . ": " . $data['totalbg'] . "<br />"; 
}

mysqli_close($conn);
?>
</html>

