<?php

require('connection.php');

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
    }

    header("Content-Type: application/json");
    echo json_encode($products);
}