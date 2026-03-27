<?php

require 'config.php';

$data = json_decode(file_get_contents('php://input'), true) ?? [];
$action = $data['action'] ?? '';

if($action === "addToCart"){

    $itemId = $data['itemId'];
    $itemQuantity = $data['itemQuantity'];
    $itemRequest = $data['itemRequest'];
    $userId = $data['userId'];

    $sql = "INSERT INTO Cart (product_id, user_id, quantity, request, is_checkout, is_completed)
    VALUE ($itemId, $userId, $itemQuantity, '$itemRequest', 0, 0);";

    if($conn -> query($sql) === true) {
        echo json_encode(["success" => true]);
    }else {
        echo json_encode(["success" => false, "message" => "Error in the DB"]);
        http_response_code(500);
    }
}else {
    echo json_encode(["success" => false, "message" => "Invalid Action"]);
    http_response_code(400);
}