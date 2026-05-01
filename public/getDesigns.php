<?php

use LDAP\Result;

require 'config.php';

$data = json_decode(file_get_contents('php://input'), true) ?? [];
$action = $data['action'] ?? '';

if($action === "getDesigns"){

    $designs = [];
    $design_drinkware = [];

    $sql = "SELECT * FROM Designs WHERE category = 'Design'";
    $result = $conn ->query($sql);

    if($result && $result->num_rows >0){
        while($row = $result ->fetch_assoc()){

            $designs [] = [
                "image" => $row['image'],
                "category" => $row['category']
            ];
        }

        $sql1 = "SELECT * FROM Designs WHERE category = 'Mugs'";
        $result1 = $conn -> query($sql1);

        if($result1 && $result->num_rows > 0){
            while($row1 = $result1 -> fetch_assoc()){

                $design_drinkware [] = [
                    "image" => $row1['image'],
                    "category" => $row1['category']
                ];
            }
        }else {
            http_response_code(500);
            echo json_encode(["success" => false, "message" => "DB Error"]);
            exit;
        }

        echo json_encode(["success" => true, "design" => $designs, "design_drinkware" => $design_drinkware]);
    }else {
        http_response_code(500);
        echo json_encode(["success" => false, "message" => "DB Error"]);
        exit;
    }
}else{
    http_response_code(400);
    echo json_encode(["success" => false, "message" => "Invalid Action"]);
    exit;
}