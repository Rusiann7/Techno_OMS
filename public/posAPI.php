<?php

require 'config.php';
require 'functions.php';

$data = json_decode(file_get_contents('php://input'), true) ?? [];
$action = $data['action'] ?? '';

if($action === "posFeature"){

    $itemId = $data['itemId'];
    $itemQuantity = $data['itemQuantity'];
    $itemRequest = $data['itemRequest'];
    $randomString = getRandomString(10);
    $design = $data['design'];

    $sql = "INSERT INTO Cart (product_id, user_id, quantity, request, design, reference_code, is_checkout, is_completed, is_deleted)
    VALUES ($itemId, 3, $itemQuantity, '$itemRequest', '$design', '$randomString', 1, 0, 0);";
   
   if($conn ->query($sql) === true){
    echo json_encode(["success" => true]);
   }else {
    http_response_code(500);
    echo json_encode(["success" => false, "message" => "DB Error"]);
    exit;
   }
}else {
    http_response_code(400);
    echo json_encode(["success" => false, "message" => "Invalid action"]);
    exit;
}