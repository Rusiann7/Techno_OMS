<?php

require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true) ?? [];
$action = $data['action'] ?? '';

if($action === "getOrders"){

    $orders = [];

    $sql = "
    SELECT p.product_name, p.category, p.price, c.quantity, 
    c.request, c.created_at, c.product_id, c.id AS cartId,
    c.is_checkout, c.is_completed, c.is_deleted,
    CASE 
        WHEN c.is_completed = 1 THEN 'Completed'
        WHEN c.is_deleted = 1 THEN 'Deleted'
        ELSE 'Pending'
    END AS status
    FROM Cart c 
    INNER JOIN Products p ON p.id = c.product_id
    WHERE c.is_checkout = 1
    ORDER BY c.created_at";

    $result = $conn->query($sql);

    if($result && $result->num_rows > 0){
        while($row = $result->fetch_assoc()){

            $orders [] = [
                "product_name" => $row['product_name'],
                "category" => $row['category'],
                "price" => $row['price'],
                "quantity" => $row['quantity'],
                "total" => $row['quantity'] * $row['price'],
                "request" => $row['request'],
                "created_at" => $row['created_at'],
                "cartId" => $row['cartId'],
                "status" => $row['status'],
            ];
        }

        echo json_encode(["success" => true, "orders" => $orders]);
    }else {
        http_response_code(500);
        echo json_encode(["success" => false, "message" => "DB error"]);
        exit;
    }

}else {
    http_response_code(400);
    echo json_encode(["success" => false, "message" => "Invalid Action"]);
    exit;
}