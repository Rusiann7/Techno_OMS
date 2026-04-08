<?php

require 'config.php';

$data = json_decode(file_get_contents('php://input'), true) ?? [];
$action = $data['action'] ?? '';

if($action === "status") {

    $work = $data['work'];
    $id = $data['id'];
    $sql = "";

    switch($work) {
        case "deleted":
            $sql = "UPDATE Cart SET is_deleted = 1 WHERE id = $id";
            break;
        
        default:
            $sql = "UPDATE Cart SET is_completed = 1 WHERE id = $id";
    };

    if($conn ->query($sql) === true){
        http_response_code(200);
        echo json_encode(["success" => true]);
    }else {
        http_response_code(500);
        echo json_encode(["success" => false, "message" => "DB Error"]);
    }
}else{
    http_response_code(400);
    echo json_encode(["success" => false, "message" => "Invalid Action"]);
    exit;
}