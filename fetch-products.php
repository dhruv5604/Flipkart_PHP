<?php

require('connection.php');

$query = "select * from products";
$result = $con->query($query);

$products = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // if($row['status'] == 1){
            $products[] = $row;
        // }
        
    }
}

header('Content-Type: application/json');
echo json_encode($products);
