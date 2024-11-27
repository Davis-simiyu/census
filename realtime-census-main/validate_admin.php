<?php
session_start();

// Include database connection
include 'dbhinc.php';



// Check if form data has been sent via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Fetch and sanitize input
    $username = mysqli_real_escape_string($connect, trim($_POST['username']));
    $password = trim($_POST['password']);

    // Validate input fields
    if (empty($username) || empty($password)) {
        header("Location: admin_login.php?error=Username and password are required.");
        exit();
    }

    // Query to find the admin in the database
    $sql = "SELECT * FROM admin_users WHERE username = '$username'";
    $result = mysqli_query($connect, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $admin = mysqli_fetch_assoc($result);

        // Use password_verify to check the hashed password
        if (password_verify($password, $admin['password_hash'])) {
            // Set session variables upon successful login
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = $username;

            // Redirect to admin dashboard
            header("Location: admin_dashboard.php");
            exit();
        } else {
            // Invalid password
            header("Location: admin_login.php?error=Invalid password.");
            exit();
        }
    } else {
        // Admin not found in the database
        header("Location: admin_login.php?error=Admin not found.");
        exit();
    }
} else {
    // Redirect to login if accessed without POST
    header("Location: admin_login.php?error=No request found.");
    exit();
}

// Close the database connection
mysqli_close($connect);
?>
