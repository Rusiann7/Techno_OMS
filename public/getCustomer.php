<?php

require 'config.php';

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
    COUNT(cart.id) AS total_orders
    FROM Users u
    INNER JOIN Customer c ON c.user_id = u.id
    LEFT JOIN Cart cart ON cart.user_id = u.id AND cart.is_checkout = 1
    GROUP BY u.id, u.email, u.created_at, c.fullname, c.id;";

    $result = $conn->query($sql);

    if($result && $result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $customers [] = [
                "email" => $row['email'],
                "created_at" => $row['created_at'],
                "fullname" => $row['fullname'],
                "total_orders" => $row['total_orders']
            ];
        }

        echo json_encode(["success" => true, "customers" => $customers]);

    }else {
        echo json_encode(["success" => false, "message" => "DB error"]);
        http_response_code(500);
        exit;
    }

}else{
    echo json_encode(["success" => false, "message" => "Invalid Action"]);
    http_response_code(400);
    exit;
}