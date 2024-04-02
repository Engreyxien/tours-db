<?php
// Database connection parameters
$host = 'localhost'; // or your host name
$dbname = 'tourist_website'; // your database name
$username = 'root'; // your database username
$password = ''; // your database password, if any

try {
    // Create a PDO connection to the database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Prepare and execute the SQL query to fetch cities
    $stmt = $pdo->query("SELECT * FROM cities");
    
    // Fetch all rows from the result set
    $cities = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Output the fetched cities
    foreach ($cities as $city) {
        echo "City: {$city['name']}<br>";
        echo "Country: {$city['country']}<br>";
        echo "Attractions: {$city['attractions']}<br>";
        echo "Hotels: {$city['hotels']}<br>";
        echo "<br>";
    }
} catch (PDOException $e) {
    // If an error occurs, handle it gracefully
    echo "Error: " . $e->getMessage();
}
?>
