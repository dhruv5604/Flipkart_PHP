<?php
ini_set('display_errors', 1);
require('connection.php');
require('check_post.php');

$cart_id = $_POST['cart_id'];

$query = "select * from inventory i join cart c on i.product_id = c.product_id where c.id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $cart_id);
$stmt->execute();
$result = $stmt->get_result();

$stock = [];

while ($row = $result->fetch_assoc()) {
    $stock[] = $row;
}

echo json_encode($stock);
