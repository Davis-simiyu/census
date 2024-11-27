<?php
// Database connection settings
$host = "localhost"; // Database server
$username = "root"; // Database username
$password = ""; // Database password
$dbname = "population_census"; // Database name

// Create a connection to the database
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $childName = $_POST['childName'];
    $dob = $_POST['dob'];
    $placeOfBirth = $_POST['placeOfBirth'];
    $parentName = $_POST['parentName'];
        $location = $_POST['location'];


    // Handle file upload (allowing any file type)
    $birthCertificate = $_FILES['birthCertificate'];
    $uploadDir = "uploads/"; // Directory to save uploaded files
    $uploadFilePath = $uploadDir . basename($birthCertificate['name']);

    // Create upload directory if it doesn't exist
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Upload the file without restrictions
    if (!empty($birthCertificate['tmp_name']) && !empty($birthCertificate['name'])) {
        if (move_uploaded_file($birthCertificate['tmp_name'], $uploadFilePath)) {
            $fileUrl = $uploadFilePath; // Save the file path to the database
        } else {
            die("Error uploading the file. Please try again.");
        }
    } else {
        $fileUrl = null; // No file uploaded
    }

    // Prepare the SQL query to insert data into the database
    $sql = "INSERT INTO birth_records (child_name, dob, place_of_birth, parent_name, birth_certificate_path) 
            VALUES (?, ?, ?, ?, ?)";

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $childName, $dob, $placeOfBirth, $parentName, $fileUrl);

    // Execute the query
    if ($stmt->execute()) {
        echo "Birth record submitted successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and the connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Birth Data - Real-Time Population Census</title>
    <link rel="stylesheet" href="ddd.css">
    <style type="text/css">
        body{
            background-image: url('https://content.unops.org/photos/News-and-Stories/Features/_image1800x900/Kenya_Maternal-Health_DFID_UNICEF-MNCH_87A1081_John-Rae_2017.jpg');
        }
    </style>
</head>
<body>
    <header>
        <h1>Hospital Birth Data Submission</h1>
       <nav class="navbar">
            <ul>
                <li><a href="homee.html">Home</a></li>
              <!--  <li><a href="regestrstion.html">Register</a></li>
                <li><a href="govt.html">Dashboard</a></li>
                <li><a href="hospital.html">Hospital Birth Data</a></li>
                <li><a href="morgue.html">Morgue Death Data</a></li>-->
                <li><a href="Contact Page.html">Contact Us</a></li>
            <li><a href="aboutus.html">About Us</a></li>
            </ul>
        </nav>
    </header>
    
    <main>
        <section class="form-section">
            <h2>Submit New Birth Record</h2>
<form action="createhospital.php" method="post" enctype="multipart/form-data">
                <label for="childName">Child’s Full Name</label>
                <input type="text" id="childName" name="childName" required>

                <label for="dob">Date of Birth</label>
                <input type="date" id="dob" name="dob" required>

                <label for="placeOfBirth">Place of Birth</label>
                <input type="text" id="placeOfBirth" name="placeOfBirth" required>

                <label for="parentName">Parent/Guardian Name</label>
                <input type="text" id="parentName" name="parentName" required>

                <label for="birthCertificate">Upload Birth Certificate</label>
                <input type="file" id="birthCertificate" name="birthCertificate" accept=".jpg,.jpeg,.png,.pdf" required>
                <label for="location">Location</label>
                <input type="text" id="location" name="location" required>
                <span id="locationError" class="error"></span>


                <button type="submit">Submit Birth Record</button>
            </form>
        </section>
    </main>
    <footer>
        <p>© 2024 Real-Time Population Census System</p>
    </footer>
</body>
</html>
