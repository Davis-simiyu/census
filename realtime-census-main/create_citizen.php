<?php
// Include database connection
include 'dbhinc.php';

// Handle form submission
$message = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and fetch inputs
    $Name = mysqli_real_escape_string($connect, $_POST['Name']);
    $DateOfBirth = mysqli_real_escape_string($connect, $_POST['DateOfBirth']);
    $Age = (int)$_POST['Age']; // Ensure age is an integer
    $Gender = mysqli_real_escape_string($connect, $_POST['Gender']);
    $MaritalStatus = mysqli_real_escape_string($connect, $_POST['MaritalStatus']);
    $Address = mysqli_real_escape_string($connect, $_POST['Address']);
    $phone = mysqli_real_escape_string($connect, $_POST['phone']);

    // Insert into the database
    $sql = "INSERT INTO citizen (Name, DateOfBirth, Age, Gender, MaritalStatus, Address, phone)
            VALUES ('$Name', '$DateOfBirth', $Age, '$Gender', '$MaritalStatus', '$Address', '$phone')";

    if (mysqli_query($connect, $sql)) {
        $message = "<p style='color: green;'>Citizen registered successfully!</p>";
    } else {
        $message = "<p style='color: red;'>Error: " . mysqli_error($connect) . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citizen Registration</title>
    <link rel="stylesheet" href="ddd.css">
</head>

<body>
    <header>
        <h1>Citizen Registration</h1>
    </header>
    <main>
        <section class="form-section">
            <!-- Display success or error message -->
            <?php if (!empty($message)) echo $message; ?>

            <!-- Registration Form -->
            <form id="registrationForm" method="POST">
                <label for="Name">Full Name</label>
                <input type="text" id="Name" name="Name" required>

                <label for="DateOfBirth">Date of Birth</label>
                <input type="date" id="DateOfBirth" name="DateOfBirth" required>

                <label for="Age">Age</label>
                <input type="number" id="Age" name="Age" required>

                <label for="Gender">Select Gender:</label>
                <select id="Gender" name="Gender" required>
                    <option value="">--Choose Gender--</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                    <option value="Prefer Not to Say">Prefer Not to Say</option>
                </select>

                <label for="MaritalStatus">Marital Status</label>
                <select id="MaritalStatus" name="MaritalStatus" required>
                    <option value="">Select...</option>
                    <option value="Single">Single</option>
                    <option value="Married">Married</option>
                    <option value="Divorced">Divorced</option>
                    <option value="Widowed">Widowed</option>
                </select>

                <label for="Address">Address</label>
                <input type="text" id="Address" name="Address" required>

                <label for="phone">Phone Number</label>
                <input type="text" id="phone" name="phone" required>

                <button type="submit">Register Citizen</button>
            </form>
        </section>
    </main>

    <script>
        // JavaScript to enhance the form
        document.addEventListener('DOMContentLoaded', () => {
            const dobInput = document.getElementById('DateOfBirth');
            const ageInput = document.getElementById('Age');
            const phoneInput = document.getElementById('phone');
            const phoneError = document.getElementById('phoneError');
            const form = document.getElementById('phoneForm');


            // Calculate age automatically when DateOfBirth is entered
            dobInput.addEventListener('input', () => {
                const dob = new Date(dobInput.value);
                const today = new Date();
                let age = today.getFullYear() - dob.getFullYear();
                const monthDiff = today.getMonth() - dob.getMonth();

                if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dob.getDate())) {
                    age--;
                }

                ageInput.value = age >= 0 ? age : '';
            });

            // Validate phone number on input
            phoneInput.addEventListener('input', () => {
                const phonePattern = /^0[0-9]{0,9}$/; // Must start with '0' and have up to 10 digits
                const value = phoneInput.value;

                if (!phonePattern.test(value)) {
                    phoneError.textContent = "Phone number must start with 0 and contain only numbers.";
                } else if (value.length > 10) {
                    phoneError.textContent = "Phone number must not exceed 10 digits.";
                } else {
                    phoneError.textContent = ""; // Clear error if valid
                }
            });
                
            // Prevent form submission if phone number is invalid
            form.addEventListener('submit', (e) => {
                const value = phoneInput.value;

                if (value.length !== 10 || !/^0[0-9]{9}$/.test(value)) {
                    phoneError.textContent = "Phone number must be 10 digits and start with 0.";
                    e.preventDefault(); // Prevent form submission
                }
            });

                
        });
    </script>
</body>

</html>














