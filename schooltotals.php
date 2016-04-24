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
// Runs the connection script
require_once("connect.php");
echo "<br>";

// Sums upp all the points recieved by each student for specific school
$myQuery = "
  SELECT SUM(result_studpoints) AS total, stud_school
  FROM result
  JOIN students ON result.stud_id WHERE result.stud_id = students.stud_id
  GROUP BY stud_school
";
// Runs $myQuery
$result  = mysqli_query($conn, $myQuery);

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
// Output
while ($data = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $data['stud_school'] . "</td>";
    echo "<td>" . $data['total'] . "</td>";
    echo "</tr>";
}
echo "</table>";

// Closes the connection
mysqli_close($conn);
?> 
</body>
</html>
