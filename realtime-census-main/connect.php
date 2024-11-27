<?php
// Database configuration
$server = "localhost";      // Server name (default is localhost for XAMPP)
$username = "root";         // Database username (default is root for XAMPP)
$password = "";             // Database password (leave blank for XAMPP)
$database = "population census";   // Your database name (replace with your actual database name)

// Establish the database connection
$connect = new mysqli($server, $username, $password, $database);

// Check for connection errors
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

// Connection successful message for debugging (can be commented out in production)
// echo "Connected to the database successfully!";
?>
