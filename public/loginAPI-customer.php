<?php

require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

use Firebase\JWT\JWT;

define('JWT_SECRET_KEY', 'technoOMStechnoOMStechnoOMStechnoOMStechnoOMS');
define('JWT_EXPIRE_TIME', 3600);

$data = json_decode(file_get_contents('php://input'), true) ?? [];
$action = $data['action'] ?? '';

if($action === "loginC"){

    $email = $data['email'];
    $password = $data['password'];
    $loginData = [];
    $tokenPayload = [];
    $jsonPayload = [];

    $sql = "SELECT u.id AS user_id, u.email, u.password, c.id AS customer_id, c.fullname, c.user_id FROM Users u INNER JOIN Customer c ON c.user_id = u.id WHERE u.email='$email'";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        $loginData = $result->fetch_assoc();

        if(password_verify($password, $loginData['password'])){
            
           $tokenPayload=[
                'user_id' => $loginData['user_id'],
                'email' => $loginData['email'],
                'iat' => time(),
                'exp' => time() + JWT_EXPIRE_TIME
            ];

            $token = JWT::encode($tokenPayload, JWT_SECRET_KEY, 'HS256');

            echo json_encode([
                "success" => true,
                "token" => $token,
                "fullName" => $loginData['fullname'],
                "user_id" => $loginData['user_id']
            ]);
        }else {
            echo json_encode(["success" => false, "message" => "Password Error"]);
            http_response_code(400);
        }
    }else {
        echo json_encode(["success" => false, "message" => "Email not found"]);
        http_response_code(400);
    }
}else {
    echo json_encode(["success" => false, "message" => "Invalid Action"]);
    http_response_code(400);
}