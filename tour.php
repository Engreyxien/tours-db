<?php

require_once "./db.php";
require_once "./config.php";

class Tour{
    public $tour_id;
    public $tour_title;
    public $tour_description;
    public $tour_price;
    public $tour_duration;
    public $country_id;

}

$db = new Connection();

$stmt = $db->connection->prepare("SELECT * FROM tour");
$stmt->execute();

$data = $stmt->fetchAll(PDO::FETCH_CLASS, 'Tour');

echo json_encode($data, JSON_PRETTY_PRINT);