<?php

require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true) ?? [];
$action = $data['action'] ?? '';

if($action === "editProducts"){

    $id = $data['id'];
    $cat = $data['cat'];
    $desc = $data['desc'];
    $name = $data['name'];
    $price = $data['price'];

    $sql = "UPDATE Products SET product_name = '$name', category = '$cat', description = '$desc', price = $price WHERE id = $id";

    if($conn-> query($sql) === true){
        echo json_encode(["success" => true]);
    }else{
        http_response_code(500);
        echo json_encode(["success" => false, "message" => "DB Error"]);
        exit;
    }
}else{
    http_response_code(400);
    echo json_encode(["success" => false, "message" => "Invalid Action"]);
    exit;
}