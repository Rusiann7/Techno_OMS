<?php

require 'config.php';

$data = json_decode(file_get_contents('php://input'), true) ?? [];
$action = $data['action'] ?? '';

if($action === "getProducts"){

    $products = [];
    $product_id = [];

    $sql = "SELECT * FROM Products";
    $result = $conn->query($sql);

    if($result && $result-> num_rows > 0){
        while($row = $result -> fetch_assoc()){
            $product_id = $row['id'];

            $products [] = [
                "product_id" => $row['id'],
                "product_name" => $row['product_name'],
                "product_cat" => $row['category'],
                "product_desc" => $row['description'],
                "product_price" => $row['price']
            ];
        }

        echo json_encode(["success" => true, "products" => $products, "product_id" => $product_id]);
    }else {
        echo json_encode(["success" => false, "message" => "Failed to gather data"]);
        http_response_code(500);
    }
}else {
    echo json_encode(["success" => false, "message" => "Invalid action"]);
    http_response_code(400);
}