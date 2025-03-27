<?php

require('connection.php');
require('check_post.php');  

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $id = $_POST['id'];
    
    $query = "select * from products where id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i",$id);
    $stmt->execute();
    $result = $stmt->get_result();
    $products = [];

    while($row = $result->fetch_assoc()){
        $products[] = $row;
        $category_id = $row['category_id'];
    }
    
    $query = "select * from category where id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $category_id);
    $stmt->execute();
    $result = $stmt->get_result();

    while($row = $result->fetch_assoc()){
        $category = $row['category'];
    }

    header("Content-Type: application/json");
    echo json_encode(['products' => $products , "category" => $category]);
}