<?php

require('check_post.php');
require('connection.php');

$user_id = $_SESSION['user_id'];

$query = "select o.id as order_id, o.order_status, o.total_amount, 
                 oi.product_name, oi.quantity, 
                 oi.product_img, oi.product_price, oi.product_offer
          from Orders o 
          join Order_Item oi on o.id = oi.order_id 
          where o.user_id = ?";

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
        "name" => $row['product_name'],
        "quantity" => $row['quantity'],
        "price" => $row['product_price'],
        "offer" => $row['product_offer'],
        "image" => $row['product_img']
    ];
}

echo json_encode(array_values($orders));
