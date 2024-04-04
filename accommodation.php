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
    public $user_id;
}

$db = new Connection();

$method = $_SERVER["REQUEST_METHOD"];

if ($method === "GET") {
  if (isset($_GET["accommodation_id"]) || isset($_GET["user_id"])) {
    $where_clauses = [];
    foreach ($_GET as $key => $param) {
      $where_clauses[] = "$key = :$key";
    }
    $query = "SELECT * FROM accommodation WHERE " . implode(" AND ", $where_clauses);
    $stmt = $db->ready($query, $_GET);
    $stmt->setFetchMode(PDO::FETCH_CLASS, "Accommodation");
    $result = $stmt->fetchAll();
    echo json_encode($result, JSON_PRETTY_PRINT);
  } else {
    $query = "SELECT * FROM accommodation";
    $stmt = $db->ready($query);
    $stmt->setFetchMode(PDO::FETCH_CLASS, "Accommodation");
    $result = $stmt->fetchAll();
    echo json_encode($result, JSON_PRETTY_PRINT);
  }
} else if ($method === "POST") {
  $_POST = json_decode(file_get_contents('php://input'), true);
  $query = "INSERT INTO accommodation (accommodation_name, accommodation_description, accommodation_type, accommodation_price, accommodation_address, contact_info, destination_id, citymun_id, user_id) VALUES ( :accommodation_name, :accommodation_description, :accommodation_type, :accommodation_price, :accommodation_address, :contact_info, :destination_id, :citymun_id, :user_id)";
  $db->ready($query, [
    "accommodation_name" => $_POST["accommodation_name"],
    "accommodation_description" => $_POST["accommodation_description"],
    "accommodation_type" => $_POST["accommodation_type"],
    "accommodation_address" => $_POST["accommodation_address"],
    "accommodation_price" => $_POST["accommodation_price"],
    "contact_info" => $_POST["contact_info"],
    "destination_id" => $_POST["destination_id"],
    "citymun_id" => $_POST["citymun_id"],
    "user_id" => $_POST["user_id"]
  ]);
  echo json_encode([
    "message" => "Data inserted"
  ], JSON_PRETTY_PRINT);
} else if ($method === "PUT") {
  $_PUT = json_decode(file_get_contents('php://input'), true);
  $query = "UPDATE accommodation SET accommodation_name = :accommodation_name, accommodation_description = :accommodation_description, accommodation_type = :accommodation_type, accommodation_price = :accommodation_price, contact_info = :contact_info, destination_id = :destination_id, citymun_id = :citymun_id, 
  WHERE accommodation_id = :accommodation_id";
  $db->ready($query, [
    "accommodation_name" => $_PUT["accommodation_name"],
    "accommodation_description" => $_PUT["accommodation_description"],
    "accommodation_type" => $_PUT["accommodation_type"],
    "accommodation_price" => $_PUT["accommodation_price"],
    "accommodation_address" => $_PUT["accommodation_address"],
    "contact_info" => $_PUT["contact_info"],
    "destination_id" => $_PUT["destination_id"],
    "citymun_id" => $_PUT["citymun_id"],
    "accommodation_id" => $_GET["accommodation_id"],
  ]);
  echo json_encode([
    "message" => "Data updated"
  ], JSON_PRETTY_PRINT);
} else if ($method === "DELETE") {
  $query = "DELETE from tasks WHERE task_id = :task_id";
  $db->ready($query, [
    "task_id" => $_GET["task_id"]
  ]);
  echo json_encode([
    "message" => "Data deleted"
  ], JSON_PRETTY_PRINT);
}