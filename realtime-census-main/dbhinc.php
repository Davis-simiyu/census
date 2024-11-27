
  <?php
// Connect to the database
$server = "localhost";
$serveruser = "root";
$serverpassword = "";
$db = "population_census"; // Use an underscore instead of a space

// Establish the connection
$connect = mysqli_connect($server, $serveruser, $serverpassword, $db);

// Confirm connection
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

echo "Database connection successful!";
?>
