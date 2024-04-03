<?php
require_once "./db.php";
require_once "./config.php";

class Country{
    public $country_id;
    public $country_name;
    public $country_description;
}

$db = new Connection();

$stmt = $db->connection->prepare("SELECT * FROM country");
$stmt->execute();

$data = $stmt->fetchAll(PDO::FETCH_CLASS, 'Country');

echo json_encode($data, JSON_PRETTY_PRINT);