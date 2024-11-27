<?php
// Database connection settings
$host = "localhost";
$username = "root";
$password = "";
$dbname = "population_census";

// Create a connection to the database
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $deceasedName = $_POST['deceasedName'];
    $dateOfDeath = $_POST['dateOfDeath'];
    $causeOfDeath = $_POST['causeOfDeath'];
    $placeOfDeath = $_POST['placeOfDeath'];
        $location = $_POST['location'];


    // Handle file upload
    $deathCertificate = $_FILES['deathCertificate'];
    $uploadDir = "uploads/";  // Directory to store uploaded files
    $uploadFilePath = $uploadDir . basename($deathCertificate['name']);

    // Check if upload directory exists, create if it doesn't
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Check for file upload errors
    if ($deathCertificate['error'] !== UPLOAD_ERR_OK) {
        die("File upload error: " . $deathCertificate['error']);
    }

    // Move the uploaded file to the desired location
    if (move_uploaded_file($deathCertificate['tmp_name'], $uploadFilePath)) {
        $fileUrl = $uploadFilePath;  // Store file path in the database
    } else {
        die("Error uploading the file. Please try again.");
    }

    // Prepare and execute the SQL query
    $sql = "INSERT INTO death_records (deceased_name, date_of_death, cause_of_death, place_of_death, death_certificate_path) 
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $deceasedName, $dateOfDeath, $causeOfDeath, $placeOfDeath, $fileUrl);

    if ($stmt->execute()) {
        echo "Death record submitted successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the database connection
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
    <title>Morgue Death Data - Real-Time Population Census</title>
    <link rel="stylesheet" href="ddd.css">
</head>
<body>
    <!-- Header Section -->
    <header>
        <h1>Morgue Death Data Submission</h1>
        <nav class="navbar">
            <ul>
                <li><a href="homee.html">Home</a></li>
                <li><a href="Contact Page.html">Contact Us</a></li>
                <li><a href="aboutus.html">About Us</a></li>
            </ul>
        </nav>
    </header>

    <!-- Main Content Area -->
    <main>
        <section class="form-section">
            <h2>Submit New Death Record</h2>
            <p>Please provide accurate details for each field below.</p>
            <form action="createmorgue.php" method="post" enctype="multipart/form-data" class="data-form">
                <label for="deceasedName">Deceased Full Name</label>
                <input type="text" id="deceasedName" name="deceasedName" placeholder="Enter full name" required>

                <label for="dateOfDeath">Date of Death</label>
                <input type="date" id="dateOfDeath" name="dateOfDeath" required>

                <label for="causeOfDeath">Cause of Death</label>
                <input type="text" id="causeOfDeath" name="causeOfDeath" placeholder="Enter cause of death" required>

                <label for="placeOfDeath">Place of Death</label>
                <input type="text" id="placeOfDeath" name="placeOfDeath" placeholder="Enter place of death" required>

                <label for="deathCertificate">Upload Death Certificate</label>
                <input type="file" id="deathCertificate" name="deathCertificate" accept=".jpg,.jpeg,.png,.pdf" required>
                <label for="location">Location</label>
                <input type="text" id="location" name="location" required>
                <span id="locationError" class="error"></span>


                <button type="submit">Submit Death Record</button>
            </form>
        </section>
    </main>

    <!-- Footer Section -->
    <footer>
        <p>© 2024 Real-Time Population Census System | <a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
    </footer>
</body>
</html>
