<?php

require 'config.php';
require 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true) ?? [];
$action = $data['action'] ?? '';

if($action === "signup"){

    $email = $data['email'];
    $password = $data['password'];
    $conpassword = $data['conpassword'];
    $fullname = $data['fullname'];
    $role = $data['role'];
    $sqlRole = 0;
    $sqlTable = null;
    $randomString = getRandomString(10);

    switch ($role){
        case "admin":
            $sqlRole = 1;
            $sqlTable = "Admin";
            break;
        default:
            $sqlRole = 0;
            $sqlTable = "Customer";
    };

    if($password !== $conpassword){
        echo json_encode(["success" => false, "message" => "Password Mismatch"]);
        http_response_code(400);
        exit;
    }

    $sql = "SELECT * FROM Users WHERE email = '$email'";
    $result = $conn->query($sql);

    if($result-> num_rows === 0){

        $encrypt = password_hash( $password, PASSWORD_DEFAULT);
        
        $sql1 = "INSERT INTO Users (Email, password, reset, is_admin) 
        VALUES ('$email', '$encrypt', '$randomString', $sqlRole)";

        if($conn-> query($sql1) === true){

            $userID = $conn->insert_id;

            $sql2 = "INSERT INTO $sqlTable (fullname, user_id)
            VALUES ('$fullname',$userID)";

            if($conn-> query($sql2) === true){
                echo json_encode(["success" => true]);
                exit;
            }else {
                echo json_encode(["success" => false, "message" => "Failed to insert into $sqlTable"]);
                http_response_code(400);
                exit;
            }
        }else {
            http_response_code(400);
            echo json_encode(["success" => false, "message" => "Failed to insert into Users"]);
            exit;
        }
    }else {
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "User already exists"]);
        exit;
    }
}else {
    http_response_code(400);
    echo json_encode(["success" => false, "message" => "Invalid Action"]);
    exit;
}