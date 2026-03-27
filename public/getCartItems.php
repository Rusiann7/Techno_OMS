<?php

require 'config.php';

$data = json_decode(file_get_contents('php://input'), true) ?? [];
$action = $data['action'] ?? '';

if($action === "getItemsCart"){

    $user_id = $data['userId'];
    $cart = [];

    $sql = "SELECT p.product_name, p.category, p.price, c.quantity, c.request, c.created_at, c.product_id
    FROM Cart c 
    INNER JOIN Products p ON p.id = c.product_id
    WHERE user_id = $user_id";

    $result = $conn -> query($sql);

    if($result && $result->num_rows > 0){
        while($row = $result -> fetch_assoc()){

            $cart [] = [
                "product_name" => $row['product_name'],
                "category" => $row['category'],
                "price" => $row['price'],
                "quantity" => $row['quantity'],
                "request" => $row['request'],
                "created_at" => $row['created_at'],
                "product_id" => $row['product_id']
            ];
        }
        
        echo json_encode(["success" => true, "cart" => $cart]);
    }else {
        echo json_encode(["success" => false, "message" => "DB error"]);
        http_response_code(500);
    }
}else {
    echo json_encode(["success" => false, "message" => "Invalid Action"]);
    http_response_code(400);
}