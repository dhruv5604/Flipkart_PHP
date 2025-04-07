<?php

require('connection.php');

$query = "select p.*, i.stock,i.id as cart_id from products p join inventory i on p.id = i.product_id";
$result = $con->query($query);

$products = $result->fetch_all(MYSQLI_ASSOC);

header('Content-Type: application/json');
echo json_encode($products);
