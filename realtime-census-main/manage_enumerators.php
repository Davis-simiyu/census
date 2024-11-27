<?php
// Database connection settings
$host = "localhost";
$username = "root";
$password = "";
$dbname = "population_census"; // Change this to your database name

// Create a connection to the database
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted to add a new enumerator
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Secure password
    $location = $_POST['location'];

    // Insert new enumerator into the database
    $sql = "INSERT INTO enumerators (username, password, location) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $password, $location);

    if ($stmt->execute()) {
        echo "New enumerator added successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Get all enumerators from the database
$sql = "SELECT * FROM enumerators";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Enumerators</title>
    <link rel="stylesheet" href="admin_styles.css">
</head>
<body>
    <header>
        <h1>Manage Enumerators</h1>
    </header>
    <main>
        <!-- Add Enumerator Form -->
        <section>
            <h2>Add New Enumerator</h2>
            <form id="addEnumeratorForm" action="manage_enumerators.php" method="POST">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <label for="location">Assigned Location:</label>
                <input type="text" id="location" name="location" required>

                <button type="submit">Add Enumerator</button>
            </form>
        </section>

        <!-- Existing Enumerators List -->
        <section>
            <h2>Existing Enumerators</h2>
            <table>
                <tr>
                    <th>Username</th>
                    <th>Location</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>

                <?php
                // Display the enumerators in a table
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['location']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                        echo "<td>
                                <form method='POST' action='edit_enumerator.php'>
                                    <input type='hidden' name='id' value='" . $row['id'] . "' />
                                    <button type='submit' name='action' value='edit'>Edit</button>
                                    <button type='submit' name='action' value='deactivate'>Deactivate</button>
                                </form>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No enumerators found.</td></tr>";
                }
                ?>
            </table>
        </section>
    </main>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
