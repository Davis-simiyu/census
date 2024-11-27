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

// Fetching the enumerator details
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM enumerators WHERE id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newUsername = $_POST['username'];
    $newLocation = $_POST['location'];

    // SQL query to update enumerator
    $sql = "UPDATE enumerators SET username='$newUsername', location='$newLocation' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Enumerator updated successfully!";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Enumerator</title>
</head>
<body>
    <h2>Edit Enumerator</h2>
    <form action="editEnumerator.php?id=<?php echo $id; ?>" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?php echo $row['username']; ?>" required>

        <label for="location">Assigned Location:</label>
        <input type="text" id="location" name="location" value="<?php echo $row['location']; ?>" required>

        <button type="submit">Update Enumerator</button>
    </form>
</body>
</html>
