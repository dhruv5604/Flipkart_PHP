<?php

require('connection.php');
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $user_id = $_SESSION['user_id'];

    $query = 'select p.image,p.price,p.name,p.offer,c.id as cart_id, p.id as product_id,c.quantity,i.stock 
                from cart c join products p on c.product_id = p.id 
                join User u on u.id = c.user_id 
                join inventory i on i.product_id = p.id where u.id = ?';
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();

    $result = $stmt->get_result();

    $products = $result->fetch_all(MYSQLI_ASSOC);

    echo json_encode($products);
}
