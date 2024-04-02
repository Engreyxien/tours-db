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
    
    // Prepare and execute the SQL query to fetch accommodation
    $stmt = $pdo->query("SELECT * FROM accommodation");
    
    // Fetch all rows from the result set
    $accommodations = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Output the fetched accommodation
    foreach ($accommodations as $accommodation) {
        echo "Accommodation Name: {$accommodation['accommodation_name']}<br>";
        echo "City ID: {$accommodation['city_id']}<br>";
        echo "Price: {$accommodation['price']}<br>";
        echo "Description: {$accommodation['description']}<br>";
        echo "<br>";
    }
} catch (PDOException $e) {
    // If an error occurs, handle it gracefully
    echo "Error: " . $e->getMessage();
}
?>
