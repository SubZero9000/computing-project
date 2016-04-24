<!DOCTYPE html>
<html>
    <head>
	<link rel="stylesheet" type="text/css" href="style.css">
    </head>
<body>
<div>
    <h2>Boys and Girls totals</h2>
        <input name="btnBack" type="button" value="Back" onclick="window.open('selection.html','_self')"/>
</div>
<?php
// Runs the connection script
require_once("connect.php");
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

// Output: Table containing boys and the girls totals for the overall event
echo "<table>";
echo "<tr>";
echo "<th>Gender</th>";
echo "<th>Total Points</th>";
echo "</tr>";
while ($data = mysqli_fetch_assoc($result)) {
echo "<tr>"; 
echo "<td>".$data['stud_gender']."</td>";
echo "<td>".$data['totalbg']."</td>";
echo "</tr>";
}
echo "</table>";

mysqli_close($conn);
?>
</body>
</html>

