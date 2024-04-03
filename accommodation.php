<?php 
require_once "./db.php";
require_once "./config.php";


class Accommodation{
    public $accommodation_id;
    public $accommodation_name;
    public $accommodation_description;
    public $accomodation_type;
    public $accommodation_price;
    public $accommodation_address;
    public $contact_info;
    public $destination_id;
    public $citymun_id;
}

$db = new Connection();

$stmt = $db->connection->prepare("SELECT * FROM accommodation");
$stmt->execute();

$data = $stmt->fetchAll(PDO::FETCH_CLASS, 'Accommodation');

echo json_encode($data, JSON_PRETTY_PRINT);