<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="inputFormStyle.css">
	</head>

<body>
<?php
// Connecting to SQL server
$servername = "localhost";
$username   = "root";
$password   = "Lampserve1";
$dbname     = "brent_athletics";

// Creates connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

session_start();

// These gets the values entered in the drop-down lists and stores the values as
// variables.
$event   = $_GET['cmbEvent'];
$yrGroup = $_GET['cmbYrGroup'];
$gender  = $_GET['cmbGender'];

// Query for title NEW ADD TO DOCS!!!!
$eventNameQuery = "SELECT event_name FROM event WHERE event_id = '$event'";
$eventNameResult = mysqli_query($conn, $eventNameQuery);

while ($data = mysqli_fetch_assoc($eventNameResult)) {
$eventName = $data['event_name'];
}

echo "<div>";
echo "<h2>Year $yrGroup ($gender) - $eventName</h2>";
echo "<input name='btnBack' class='backbtn' type='button' value='Back' onclick='window.open('selection.html','_self')'/>";
echo "</div>";

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    echo "Connected!";
}
echo "<br>";

/* The query $eygQuery, where the 'eyg' stands for event, year group and gender, 
grabs the stud_fname, stud_sname, result_studpoints, result_position, studevent_result 
where the requirements of the specific stud_gender, stud_yrgroup and event_id is met */
$eygQuery = "
    SELECT  s.stud_id AS student_id,
            stud_fname, 
            stud_sname, 
            result_studpoints, 
            result_position, 
            studevent_result 
    FROM 
        students s
            INNER JOIN 
        result r on 
        s.stud_id = r.stud_id
    WHERE 
        stud_gender  = '$gender'
    AND stud_yrgroup = '$yrGroup'
    AND r.event_id   = '$event'  
";

$result = mysqli_query($conn, $eygQuery);

//Checks to see if $result query works
if (!$result) {
    echo "FAIL";
}

// A function that count the number of rows in the query $result
$noStudents = mysqli_num_rows($result);

echo "<table>";
echo "<tr>";
echo "<th>Names</th>";
echo "<th>Result</th>";
echo "<th>Position</th>";
echo "<th>Points</th>";
echo "</tr>";

// Output
// $j is the current row being fetched
$j = 0;
while ($data = mysqli_fetch_assoc($result)) {
    $studId = $data['student_id'];
    $studName = $data['stud_fname'] . " " . $data['stud_sname'];
    $studNameResult = $data['stud_fname'] . $data['stud_sname']."Result";
    $studNamePosition = $data['stud_fname'] . $data['stud_sname']."Position";

    //Array contains the stud_id's
    $arrayId[] = $studId;

echo "<tr>";

    // Outputs the results of the query
echo "<td>".$studName."</td>";
    echo "<form action='HandleForm.php' method='GET'>";
    // Text box
    echo "<td><center><input class='txtBox' type='text' name='$studNameResult' value=" . $data['studevent_result'] . "></center></td>";

    // Array contains $studNameResult
    $arrayNameResult[] = $studNameResult;

    // Drop-down list
    echo "<td><center><select name='$studNamePosition'>";
    echo "<option>" . $data['result_position'] . "</option>";
    for ($i = 1; $i <= $noStudents; $i++) {
        echo "<option value='$i'>$i</option>";   
    }
    echo "</select></center></td>";

    // Array contains $studNamePosition
    $arrayNamePosition[] = $studNamePosition;

// Outputs the points gained for each student in the event
echo "<td><center>".$_SESSION['arrayPoints'][$j]."</center></td>";
// Increments, so if fetches each row listed
$j++;
echo "</tr>";
}
echo "</table>";
echo "<br>";
//print_r($_SESSION['arrayPoints']);

echo "<input type='Submit' class='button' name='btnSubmit' value='Submit'>";
echo "</form>";
// Transferring array to HandleForm.php
$_SESSION['arrayNameResult'] = $arrayNameResult;
$_SESSION['arrayNamePosition'] = $arrayNamePosition;
$_SESSION['arrayId'] = $arrayId;
$_SESSION['noStudents'] = $noStudents;

//FOR TEST PURPOSES...
//var_dump($arrayNameResult);
//var_dump($arrayNamePosition);
//var_dump($arrayId);
mysqli_close($conn);
?>
</body>
</html>
