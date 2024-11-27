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

// Processing the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $location = $_POST['location'];

    // Hashing the password before storing
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // SQL query to insert data
    $sql = "INSERT INTO enumerators (username, password, location) VALUES ('$username', '$hashedPassword', '$location')";

    if ($conn->query($sql) === TRUE) {
        echo "New enumerator added successfully!";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>
