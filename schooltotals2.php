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

// Sums upp all the points recieved by each student for specific school
$myQuery = "SELECT SUM(result_studpoints) AS total FROM result WHERE stud_id IN (SELECT stud_id FROM students WHERE stud_school = 'CCA')";
$result = mysqli_query($conn, $myQuery);
$data = mysqli_fetch_assoc($result);

echo "Total CCA: ".$data['total'];

mysqli_close($conn);
?>
</html>

