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

// These gets the values entered in the drop-down lists and stores the values as
// variables.
$event   = $_GET['cmbEvent'];
$yrGroup = $_GET['cmbYrGroup'];
$gender  = $_GET['cmbGender'];

/* The query $eygQuery, where the 'eyg' stands for event, year group and gender, 
grabs the students who meet the requirements of the specific stud_gender, 
stud_yrgroup and event_id where a subquery is used to get the event_id. */
$eygQuery = "
  SELECT stud_fname, stud_sname, stud_id
  FROM students
  WHERE stud_gender = '$gender'
  AND stud_yrgroup = '$yrGroup'
  AND stud_id IN (SELECT stud_id FROM result WHERE event_id = '$event')  
";
$result = mysqli_query($conn, $eygQuery);

//Checks to see if $result query works
if (!$result) {
    echo "FAIL";
}

// Output
while ($data = mysqli_fetch_assoc($result)) {
    //echo $data['stud_fname'] . " " . $data['stud_sname'] . "<br />"; 
    $arrayName[] = $data['stud_id']." ".$data['stud_fname'] . " " . $data['stud_sname'];
}

// A function that count the number of rows in the query $result
$noStudents = mysqli_num_rows($result);

// outputs the text boxes and drop-down lists for each name in the array.
foreach ($arrayName as $value) {
    echo $value;
    $value = str_replace(' ', '', $value);
    $value .= 'Result';
    echo "<input type='text' name='$value' value='$value' />";
    $value = str_replace('Result', '', $value);
    $value .= 'Position';
    echo "<select name='$value'>";
       for ($i = 1; $i <= $noStudents; $i++){
         echo "<option value='$i'>$i</option>";
}
    echo "</select>";
    echo "<br>";
}

echo "<input type='submit' name='btnSubmit' value='Submit'>";   
echo "<br>";


$reversed = array_reverse($arrayPoints);
var_dump($reversed);

mysqli_close($conn);
?>
</html>
