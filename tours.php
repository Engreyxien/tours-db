<?php
// Database connection parameters
$host = 'localhost';
$dbname = 'tourist_website';
$username = 'root';
$password = '';

// Create a PDO connection to the database
$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
// Set the PDO error mode to exception
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Prepare and execute the SQL query to fetch tours
$stmt = $pdo->query("SELECT * FROM tours");

// Fetch all rows from the result set
$tours = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Output the fetched tours
foreach ($tours as $tour) {
    echo "Tour Name: {$tour['tour_name']}<br>";
    echo "Destination ID: {$tour['destination_id']}<br>";
    echo "Price: {$tour['price']}<br>";
    echo "Description: {$tour['description']}<br>";
    echo "<br>";
}

// Check if there was an error executing the query
if ($stmt === false) {
    // If an error occurs, handle it gracefully
    $errorInfo = $pdo->errorInfo();
    echo "Error: " . $errorInfo[2];
}
?>