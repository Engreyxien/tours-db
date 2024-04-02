<?php
// Database connection parameters
$host = 'localhost';
$dbname = 'tourist_website';
$username = 'root';
$password = '';

try {
    // Create a PDO connection to the database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Prepare and execute the SQL query to fetch destinations
    $stmt = $pdo->query("SELECT * FROM destinations");
    
    // Fetch all rows from the result set
    $destinations = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Output the fetched destinations
    foreach ($destinations as $destination) {
        echo "Destination Name: {$destination['destination_name']}<br>";
        echo "Country ID: {$destination['country_id']}<br>";
        echo "Description: {$destination['description']}<br>";
        echo "<br>";
    }
} catch (PDOException $e) {
    // If an error occurs, handle it gracefully
    echo "Error: " . $e->getMessage();
}
?>
