<?php

require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true) ?? [];
$action = $data['action'] ?? '';

if($action === "status") {

    $work = $data['work'];
    $id = $data['id'];
    $qnt = $data['qnt'];
    switch($work) {
        case "deleted":
            $sql = "UPDATE Cart SET is_deleted = 1 WHERE id = $id";
            if($conn->query($sql) === true) {
                http_response_code(200);
                echo json_encode(["success" => true]);
            } else {
                http_response_code(500);
                echo json_encode(["success" => false, "message" => "DB Error"]);
            }
            break;
        
        case "done":
            $row = $conn->query("SELECT product_id FROM Cart WHERE id = $id")->fetch_assoc();
            if (!$row) {
                http_response_code(404);
                echo json_encode(["success" => false, "message" => "Order not found"]);
                exit;
            }
            $product_id = $row['product_id'];
            
            $sql = "UPDATE Cart SET is_completed = 1 WHERE id = $id";
            $sql2 = "UPDATE Products SET stock = stock - $qnt WHERE id = $product_id";
            $sql3 = "UPDATE Products SET sold = sold + $qnt WHERE id = $product_id";
            
            if($conn->query($sql) === true && $conn->query($sql2) === true && $conn->query($sql3) === true){
                http_response_code(200);
                echo json_encode(["success" => true]);
            } else {
                http_response_code(500);
                echo json_encode(["success" => false, "message" => "DB Error during completion"]);
            }
            break;

        default:
            http_response_code(400);
            echo json_encode(["success" => false, "message" => "Invalid work action"]);
            break;
    }

}else{
    http_response_code(400);
    echo json_encode(["success" => false, "message" => "Invalid Action"]);
    exit;
}