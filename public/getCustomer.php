<?php

require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true) ?? [];
$action = $data['action'] ?? '';

if($action === "getCustomers"){

    $customers = [];
    $customerIdList = [];

    $sql = "SELECT 
    u.id AS userID,
    u.email, 
    u.created_at, 
    c.fullname, 
    c.id AS customerID,
    COUNT(DISTINCT cart.id) AS total_orders,
    SUM(IFNULL(cart.quantity * p.price, 0)) AS total_spent
    FROM Users u
    INNER JOIN Customer c ON c.user_id = u.id
    LEFT JOIN Cart cart ON cart.user_id = u.id AND cart.is_checkout = 1
    LEFT JOIN Products p ON p.id = cart.product_id
    GROUP BY u.id, u.email, u.created_at, c.fullname, c.id;";

    $result = $conn->query($sql);

    if($result && $result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $customers [] = [
                "email" => $row['email'],
                "created_at" => $row['created_at'],
                "fullname" => $row['fullname'],
                "total_orders" => $row['total_orders'],
                "total_spent" => $row['total_spent']
            ];
        }

        echo json_encode(["success" => true, "customers" => $customers]);

    }else {
        http_response_code(500);
        echo json_encode(["success" => false, "message" => "DB error"]);
        exit;
    }

}else{
    http_response_code(400);
    echo json_encode(["success" => false, "message" => "Invalid Action"]);
    exit;
}