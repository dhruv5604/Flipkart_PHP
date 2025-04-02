<?php

require('check_post.php');
require('connection.php');

$user_id = $_SESSION['user_id'];

$query = "SELECT o.id AS order_id, o.order_status, o.total_amount, 
                 oi.product_id, oi.quantity, 
                 p.name, p.price, p.offer, p.image 
          FROM Orders o 
          JOIN Order_Item oi ON o.id = oi.order_id 
          JOIN products p ON oi.product_id = p.id 
          WHERE o.user_id = ?";

$stmt = $con->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$orders = [];

while ($row = $result->fetch_assoc()) {
    $order_id = $row['order_id'];

    if (!isset($orders[$order_id])) {
        $orders[$order_id] = [
            "order_id" => $row['order_id'],
            "status" => $row['order_status'],
            "total" => $row['total_amount'],
            "items" => []
        ];
    }

    $orders[$order_id]["items"][] = [
        "product_id" => $row['product_id'],
        "name" => $row['name'],
        "quantity" => $row['quantity'],
        "price" => $row['price'],
        "offer" => $row['offer'],
        "image" => $row['image']
    ];
}

echo json_encode(array_values($orders));
