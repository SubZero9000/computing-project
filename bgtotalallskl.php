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

// FUNCTION which calculates the sum of the boys and girls for each school 

function bgTotSkl($bgTotSkl_SchoolName, $conn)
{
    // This if statement prevents SQL injection
    if (isset($bgTotSkl_SchoolName)) {
        $bgTotSkl_SchoolName = mysqli_real_escape_string($conn, $bgTotSkl_SchoolName);
    }
    // Query called $bgTotSkl_Query, uses php variable called $bgTotSkl_SchoolName inorder 
    // to provide an input to specify a specific school
    $bgTotSkl_Query = "SELECT SUM(result_studpoints) AS totalbg, stud_gender
    FROM result
    JOIN students ON result.stud_id WHERE result.stud_id = students.stud_id
    AND stud_school = '$bgTotSkl_SchoolName' 
    GROUP BY stud_gender";
    $mainQuery      = mysqli_query($conn, $bgTotSkl_Query);
    
    // Above $mainQuery executes query and stores the results as a table called $mainQuery  
    // $data stores the results of the query for each line within while loop
    while ($data = mysqli_fetch_assoc($mainQuery)) {
        echo "Total $bgTotSkl_SchoolName " . $data['stud_gender'] . ": " . $data['totalbg'] . "<br>";
    }
}

// MySQL Query gets the distinct Schools in database
// The distinct schools are then stored in an array called $allSchools 
$sllSchoolsQuery = "SELECT DISTINCT stud_school AS schools FROM students";
$schoolNames     = mysqli_query($conn, $sllSchoolsQuery);
while ($row = mysqli_fetch_assoc($schoolNames)) {
    $arraySkl[] = $row['schools'];
}
var_dump($arraySkl);
echo "<br>";

// This will loop through the associative array called $arraySkl
// Executing function
foreach ($arraySkl as $value) {
    bgTotSkl($value, $conn);
}
mysqli_close($conn);
?>
</html>
