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

$stock = $result->fetch_all(MYSQLI_ASSOC);

echo json_encode($stock);
