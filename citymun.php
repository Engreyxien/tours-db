<?php

require_once "./db.php";
require_once "./config.php";

class Citymun{
    public $citymun_id;
    public $citymun_name;
    public $reg_code;
    public $prov_code;
    public $citymun_code;
    public $country_id;

}

$db = new Connection();

$stmt = $db->connection->prepare("SELECT * FROM citymun");
$stmt->execute();

$data = $stmt->fetchAll(PDO::FETCH_CLASS, 'Citymun');

echo json_encode($data, JSON_PRETTY_PRINT);