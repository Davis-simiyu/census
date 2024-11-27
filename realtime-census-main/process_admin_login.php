<?php
session_start();
include 'dbhinc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check the database for the username
    $sql = "SELECT * FROM admin_users WHERE username = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        
        // Verify the password
        if (password_verify($password, $user['password_hash'])) {
            // Login successful
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = $username;
            header("Location: admin_dashboard.html");
            exit;
        } else {
            // Invalid password
            $error = "Invalid username or password.";
        }
    } else {
        // User not found
        $error = "Invalid username or password.";
    }

    $stmt->close();
    $connect->close();
}

?>

