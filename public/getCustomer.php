<?php

require 'config.php';

$data = json_decode(file_get_contents('php://input'), true) ?? [];
$action = $data['action'] ?? '';

if($action === "getCustomers"){

    $customers = [];
    $customerIdList = [];

    $sql = "SELECT u.email, u.created_at, u.id AS userID, c.fullname, c.id AS customerID,
    COUNT(cart.id) AS total_orders, cart.quantity
    FROM Users u
    INNER JOIN Customer c ON c.id = u.id
    LEFT JOIN Cart cart ON cart.user_id = u.id AND cart.is_checkout = 1";

    $result = $conn->query($sql);

    if($result && $result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $customers [] = [
                "email" => $row['email'],
                "created_at" => $row['created_at'],
                "fullname" => $row['fullname']
            ];
        }
    }

}else{
    echo json_encode(["success" => false, "message" => "Invalid Action"]);
    http_response_code(400);
}