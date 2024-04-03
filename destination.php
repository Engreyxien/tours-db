<?php

require_once "./db.php";
require_once "./config.php";

class Destination{
    public $destination_id;
    public $destination_name;
    public $destination_description;
    public $tour_id;
}


$db = new Connection();

$stmt = $db->connection->prepare("SELECT * FROM destination");
$stmt->execute();

$data = $stmt->fetchAll(PDO::FETCH_CLASS, 'Destination');

echo json_encode($data, JSON_PRETTY_PRINT);