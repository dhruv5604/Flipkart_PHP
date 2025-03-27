<?php

require('connection.php');
require('check_post.php');

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $id = $_POST["id"];

    $query = 'select * from category where id = ?';
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $categories = [];

    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $categories[] = $row['category'];
        }
    }

    header('Content-Type: application/json');
    echo json_encode($categories);
}