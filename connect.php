 <?php
// Connecting to SQL server
$servername = "localhost";
$username   = "root";
$password   = "Lampserve1";
$dbname     = "brent_athletics";

// Creates connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Checks whether or not a connection has been established
if (!$conn) {
    // If the connection fails, echo out an error
    echo "<h2><b><center>Connection to the database failed...</center></b></h2>";
    mysqli_close($conn);
} else {
    // If the connection succeeds, select the appropriate database
    mysqli_select_db("brent_athletics");
}
?> 
