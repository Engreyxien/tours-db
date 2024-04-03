<?php
require_once "./db.php";
require_once "./config.php";

class User{
    public $user_id;
    public $username;
    public $password;
    public $email_address;
    public $fullname;
    public $country_id;
    public $profile_picture;
}
$db = new Connection();
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    $query = "SELECT * FROM users";
    if (isset($_GET['user_id'])) {
        $query .= " WHERE user_id = :user_id";
        $stmt = $db->ready($query, ['user_id' => $_GET['user_id']]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
        $result = $stmt->fetch();
        echo json_encode($data, JSON_PRETTY_PRINT);
    } else {
        $stmt = $db->ready($query);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
        $result = $stmt->fetchAll();
        echo json_encode($result, JSON_PRETTY_PRINT);
    }
} else if ($method === 'POST'){
    $_POST = json_decode(file_get_contents('php://input'), true);
    $query = "INSERT INTO users (username, password, email_address, fullname, country_id) VALUES ( :username, :password, :email_address, :fullname, :country_id)";
    $db->ready($query, ['username' => $_POST['username'], 'password' => $_POST['password'], 'email_address' => $_POST['email_address'], 'fullname' => $_POST['fullname'], 'country_id' => $_POST['country_id']]);
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email_address = $_POST['email_address'];
    $fullname = $_POST['fullname'];
    $country_id = $_POST['country_id'];
    echo json_encode(["message" => "User created successfully.", "username" => $username, "password" => $password, "email_address" => $email_address, "fullname" => $fullname, "country_id" => $country_id], JSON_PRETTY_PRINT);
}