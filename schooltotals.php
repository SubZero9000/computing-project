<!DOCTYPE html>
<html>
    <head>
	<link rel="stylesheet" type="text/css" href="style.css">
    </head>
<body>
<div>
    <h2>School Totals</h2>
        <input name="btnBack" type="button" value="Back" onclick="window.open('selection.html','_self')"/>
</div>
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
$myQuery = "
  SELECT SUM(result_studpoints) AS total, stud_school
  FROM result
  JOIN students ON result.stud_id WHERE result.stud_id = students.stud_id
  GROUP BY stud_school
";
$result = mysqli_query($conn, $myQuery);

//Checks to see if $result query works.
if (!$result) {
echo "FAIL";
}

// Table containing the schools and each schools points in the event
echo "<table>";
echo "<tr>";
echo "<th>School</th>";
echo "<th>Total Points</th>";
echo "</tr>";
// Output.
while ($data = mysqli_fetch_assoc($result)) {
echo "<tr>";  
echo "<td>".$data['stud_school']."</td>"; 
echo "<td>".$data['total']."</td>";
echo "</tr>";
}
echo "</table>";

mysqli_close($conn);
?>
</body>
</html>

