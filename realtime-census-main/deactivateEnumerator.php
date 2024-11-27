<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "population_census";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // SQL query to deactivate enumerator
    $sql = "UPDATE enumerators SET status = 'Inactive' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Enumerator deactivated successfully!";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>
