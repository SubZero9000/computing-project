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
grabs the stud_fname, stud_sname, result_studpoints, result_position, studevent_result 
where the requirements of the specific stud_gender, stud_yrgroup and event_id is met */
$eygQuery = "
    SELECT  stud_fname, 
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
$result   = mysqli_query($conn, $eygQuery);

//Checks to see if $result query works
if (!$result) {
    echo "FAIL";
}

// A function that count the number of rows in the query $result
$noStudents = mysqli_num_rows($result);

// Output
while ($data = mysqli_fetch_assoc($result)) {
    $studName = $data['stud_fname'] . " " . $data['stud_sname'];
    // Outputs the results of the query
    echo $studName;
    // Text box
    $studName = str_replace(' ', '', $studName);
    $studName .= 'Result';
    echo "<input type='text' name='txtBox' value=" . $data['studevent_result'] . ">";
    // Drop-down list
    $studName = str_replace('Result', '', $studName);
    $studName .= 'Position';
    echo "<select name='cmbPosition'>";
    echo "<option>" . $data['result_position'] . "</option>";
    for ($i = 1; $i <= $noStudents; $i++) {
        echo "<option value='$i'>$i</option>";
    }
    echo "</select>";
    // Outputs the student points that is already in the database
    echo $data['result_studpoints'];
    echo "<br>";
}
echo "<br>";

mysqli_close($conn);
?>
</html>
