<?php
// Database connection
include 'dbhinc.php'; // Ensure this file contains your database connection details

// Initialize variables
$totalPopulation = 0;
$ageDistribution = [];
$enumerators = 0;
$adminUsers = 0;

try {
    // Fetch total population (from citizens minus the death records)
    $queryPopulation = "
        SELECT 
            (SELECT COUNT(*) FROM citizens) 
            - (SELECT COUNT(*) FROM death_records) AS total_population;
    ";
    $resultPopulation = $connect->query($queryPopulation);
    
    if (!$resultPopulation) {
        throw new Exception('Error executing query for total population: ' . $connect->error);
    }
    
    $totalPopulation = ($resultPopulation->num_rows > 0) ? $resultPopulation->fetch_assoc()['total_population'] : 0;

    // Fetch age distribution from citizens' birth date
    $queryAgeDistribution = "
        SELECT 
            CASE 
                WHEN TIMESTAMPDIFF(YEAR, DOB, CURDATE()) BETWEEN 0 AND 17 THEN '0-17'
                WHEN TIMESTAMPDIFF(YEAR, DOB, CURDATE()) BETWEEN 18 AND 35 THEN '18-35'
                WHEN TIMESTAMPDIFF(YEAR, DOB, CURDATE()) BETWEEN 36 AND 60 THEN '36-60'
                ELSE '60+' 
            END AS age_group,
            COUNT(*) AS count
        FROM citizens
        GROUP BY age_group;
    ";
    $resultAgeDistribution = $connect->query($queryAgeDistribution);
    
    if (!$resultAgeDistribution) {
        throw new Exception('Error executing query for age distribution: ' . $connect->error);
    }

    if ($resultAgeDistribution->num_rows > 0) {
        while ($row = $resultAgeDistribution->fetch_assoc()) {
            $ageDistribution[$row['age_group']] = $row['count'];
        }
    }

    // Fetch the number of enumerators and admin users
    $queryUsers = "
        SELECT 
            (SELECT COUNT(*) FROM enumerators) AS enumerators,
            (SELECT COUNT(*) FROM admin_users) AS admin_users
    ";
    $resultUsers = $connect->query($queryUsers);
    
    if (!$resultUsers) {
        throw new Exception('Error executing query for users: ' . $connect->error);
    }

    $users = $resultUsers->fetch_assoc();
    $enumerators = $users['enumerators'];
    $adminUsers = $users['admin_users'];

} catch (Exception $e) {
    // Handle errors
    echo "Error fetching data: " . $e->getMessage();
    exit;
}

$connect->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Real-Time Population Census</title>
    <link rel="stylesheet" href="ddd.css">
    <style>
        table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    background-color: white;
    border: 1px solid #ddd;
}

table th, table td {
    padding: 10px;
    text-align: center;
    border: 1px solid #ddd;
}
    </style>
</head>
<body>
    <header>
        <div class="logo-container">
            <h1>Population Census Dashboard</h1>
        </div>
        <nav class="navbar">
        
           <ul class="nav-links">
            <li><a href="homee.html">Home</a></li>
               <!-- <li><a href="regestrstion.html">Register</a></li>
            <li><a href="govt.html">Dashboard</a></li>
            <li><a href="hospital.html">Hospital Birth Data</a></li>
            <li><a href="morgue.html">Morgue Death Data</a></li>-->
            <li><a href="Contact Page.html">Contact Us</a></li>
            <li><a href="aboutus.html">About Us</a></li>
        </ul>
        </nav>
    </header>

    <main>
        <section class="dashboard">
            <h2>Demographic Data Overview</h2>

            <!-- Total Population -->
            <h3>Total Population</h3>
            <table id="population_table">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Count</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Total Population</td>
                        <td><?php echo $totalPopulation; ?></td>
                    </tr>
                    <tr>
                        <td>Enumerators</td>
                        <td><?php echo $enumerators; ?></td>
                    </tr>
                    <tr>
                        <td>Admin Users</td>
                        <td><?php echo $adminUsers; ?></td>
                    </tr>
                </tbody>
            </table>

            <!-- Age Distribution -->
            <h3>Age Distribution</h3>
            <table id="age_distribution_table">
                <thead>
                    <tr>
                        <th>Age Group</th>
                        <th>Count</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($ageDistribution as $ageGroup => $count) {
                        echo "<tr><td>{$ageGroup}</td><td>{$count}</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </main>

    <footer>
        <p>© 2024 Real-Time Population Census System</p>
    </footer>
</body>
</html>
