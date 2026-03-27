<?php //config file

ini_set('display_errors', 1);
error_reporting(E_ALL);

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header('Access-Control-Max-Age: 86400');
header('Content-Type: application/json; charset=utf-8');

require __DIR__ . '/../vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] !== 'OPTIONS') {
    header('Content-Type: application/json; charset=utf-8');
}

$host ="127.0.0.1";
$user ="root";
$password="123456";
$dbname="OMS";

$conn = new mysqli($host, $user, $password, $dbname, 3306);

if($conn->connect_error) {
    http_response_code(500);
    die(json_encode(["success" => false, "error" => "DB Connection failed"]));
}else {
    json_encode(["success" => true, "message" => "Connection Successfully established"]);
}

$conn->set_charset("utf8mb4");
$conn->query("SET NAMES 'utf8mb4'");
