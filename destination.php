<?php
require_once "./db.php";
require_once "./config.php";

class Destination {
    public $destination_id;
    public $destination_name;
    public $destination_description;
    public $tour_id;
    public $user_id;
}

$db = new Connection();
$method = $_SERVER["REQUEST_METHOD"];

if ($method === "GET") {
    if (isset($_GET["destination_id"]) || isset($_GET["user_id"])) {
        $where_clauses = [];
        foreach ($_GET as $key => $param) {
            $where_clauses[] = "$key = :$key";
        }
        $query = "SELECT * FROM destination WHERE " . implode(" AND ", $where_clauses);
        $stmt = $db->ready($query, $_GET);
        $stmt->setFetchMode(PDO::FETCH_CLASS, "Destination");
        $result = $stmt->fetchAll();
        echo json_encode($result, JSON_PRETTY_PRINT);
    } else {
        $query = "SELECT * FROM destination";
        $stmt = $db->ready($query);
        $stmt->setFetchMode(PDO::FETCH_CLASS, "Destination");
        $result = $stmt->fetchAll();
        echo json_encode($result, JSON_PRETTY_PRINT);
    }
} else if ($method === "POST") {
    $_POST = json_decode(file_get_contents('php://input'), true);
    $query = "INSERT INTO destination (destination_name, destination_description, tour_id, user_id) VALUES ( :destination_name, :destination_description, :tour_id, :user_id)";
    $db->ready($query, [
        "destination_name" => $_POST["destination_name"],
        "destination_description" => $_POST["destination_description"],
        "tour_id" => $_POST["tour_id"],
        "user_id" => $_POST["user_id"],
    ]);
    echo json_encode([
        "message" => "Data inserted"
    ], JSON_PRETTY_PRINT);
    
} else if ($method === "PUT") {
  $_PUT = json_decode(file_get_contents('php://input'), true);
  $query = "UPDATE destination SET destination_name = :destination_name, destination_description = :destination_description, tour_id = :tour_id, user_id = :user_id
  WHERE destination_id = :destination_id";
  $db->ready($query, [
      "destination_name" => $_PUT["destination_name"],
      "destination_description" => $_PUT["destination_description"],
      "tour_id" => $_PUT["tour_id"],
      "user_id" => $_PUT["user_id"],
      "destination_id" => $_PUT["destination_id"]
  ]);
  echo json_encode([
      "message" => "Destination Updated"
  ], JSON_PRETTY_PRINT);

} else if ($method === "DELETE") {
    $query = "DELETE from destination WHERE destination_id = :destination_id";
    $db->ready($query, [
        "destination_id" => $_GET["destination_id"]
    ]);
    echo json_encode([
        "message" => "Destination deleted"
    ], JSON_PRETTY_PRINT);
}
?>