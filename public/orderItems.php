<?php

require 'config.php';
require 'functions.php';

$data = json_decode(file_get_contents('php://input'), true) ?? [];
$action = $data['action'] ?? '';

if($action === "orderItems"){

    $userID = $data['userId'];
    $items = $data['items'];
    $cartId = implode(",", $items);
    $randomString = getRandomString(10);

    $sql = "UPDATE Cart SET is_checkout = 1 WHERE user_id = $userID AND id = $cartId";

    if($conn->query($sql) === true){
        echo json_encode(["success" => true]);
    }else{
        echo json_encode(["sucess" => false, "message" => "Error DB"]);
        http_response_code(500);
    }

}else {
    echo json_encode(["success" => false, "message" => "Invalid Action"]);
    http_response_code(400);
}