<?php

require 'config.php';
require 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true) ?? [];
$action = $data['action'] ?? '';

if($action === "orderItems"){

    $userID = $data['userId'];
    $items = $data['items'];
    $cartId = implode(",", $items);
    $randomString = getRandomString(10);

    $sql = "UPDATE Cart SET is_checkout = 1 WHERE user_id = $userID AND id IN ($cartId)";

    if($conn->query($sql) === true){
        echo json_encode(["success" => true]);
    }else{
        http_response_code(500);
        echo json_encode(["success" => false, "message" => "Error DB"]);
        exit;
    }

}else {
    http_response_code(400);
    echo json_encode(["success" => false, "message" => "Invalid Action"]);
    exit;
}