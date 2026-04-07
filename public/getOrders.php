<?php

require 'config.php';

$data = json_decode(file_get_contents('php://input'), true) ?? [];
$action = $data['action'] ?? '';

if($action === "getOrders"){

    $user_id = $data['userId'];
    $orders = [];

    $sql = "
    SELECT p.product_name, p.category, p.price, c.quantity, 
    c.request, c.created_at, c.product_id, c.id AS cartId,
    c.is_checkout, c.is_completed,
    CASE 
        WHEN c.is_completed = 1 THEN 'Completed'
        ELSE 'Pending'
    END AS status
    FROM Cart c 
    INNER JOIN Products p ON p.id = c.product_id
    WHERE user_id = $user_id AND c.is_checkout = 1
    ORDER BY c.created_at";

    $result = $conn->query($sql);

    if($result && $result->num_rows > 0){
        while($row = $result->fetch_assoc()){

            $orders [] = [
                "product_name" => $row['product_name'],
                "category" => $row['category'],
                "price" => $row['price'],
                "quantity" => $row['quantity'],
                "request" => $row['request'],
                "created_at" => $row['created_at'],
                "cartId" => $row['cartId'],
                "status" => $row['status'],
            ];
        }

        echo json_encode(["success" => true, "orders" => $orders]);
    }else {
        echo json_encode(["success" => false, "message" => "DB error"]);
        http_response_code(500);
    }

}else {
    echo json_encode(["success" => false, "message" => "Invalid Action"]);
    http_response_code(400);
}