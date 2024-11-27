

<?php
// Database connection
include 'dbhinc.php'; // Make sure this file contains your database connection details

header('Content-Type: application/json'); // Send JSON response

try {
    // Fetch total population
    $queryPopulation = "
        SELECT 
            (SELECT COUNT(*) FROM citizens) 
            - (SELECT COUNT(*) FROM death_records) AS total_population;
    ";
    $resultPopulation = $connect->query($queryPopulation);
    $totalPopulation = ($resultPopulation->num_rows > 0) ? $resultPopulation->fetch_assoc()['total_population'] : 0;

    // Fetch age distribution
    $queryAgeDistribution = "
        SELECT 
            CASE 
                WHEN age BETWEEN 0 AND 17 THEN '0-17'
                WHEN age BETWEEN 18 AND 35 THEN '18-35'
                WHEN age BETWEEN 36 AND 60 THEN '36-60'
                ELSE '60+' 
            END AS age_group,
            COUNT(*) AS count
        FROM (
            SELECT TIMESTAMPDIFF(YEAR, DOB, CURDATE()) AS age
            FROM citizens
        ) AS age_data
        GROUP BY age_group;
    ";
    $resultAgeDistribution = $connect->query($queryAgeDistribution);
    $ageDistribution = [];
    if ($resultAgeDistribution->num_rows > 0) {
        while ($row = $resultAgeDistribution->fetch_assoc()) {
            $ageDistribution[$row['age_group']] = $row['count'];
        }
    }

    // Return data as JSON
    echo json_encode([
        'total_population' => $totalPopulation,
        'age_distribution' => $ageDistribution
    ]);

} catch (Exception $e) {
    echo json_encode([
        'error' => 'Failed to fetch data: ' . $e->getMessage()
    ]);
}

$connect->close();

?>


<