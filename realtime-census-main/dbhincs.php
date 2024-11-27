<?php
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = "";     // Replace with your database password
$dbname = "population_census"; // Replace with your database name

// Create connection
$connect = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}
?>
