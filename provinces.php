<?php
require_once "./db.php";
require_once "./config.php";

class Provinces{
    public $province_id;
    public $province_name;
    public $reg_code;
    public $prov_code;
    public $country_id;
}

$db = new Connection();

$stmt = $db->connection->prepare("SELECT * FROM provinces");
$stmt->execute();

$data = $stmt->fetchAll(PDO::FETCH_CLASS, 'Provinces');

echo json_encode($data, JSON_PRETTY_PRINT);