<?php

require('check_post.php');
require('connection.php');

$product_id = $_POST['product_id'];
$user_id = $_SESSION['user_id'];

$query = "delete from cart where user_id = ? and product_id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("ii",$user_id,$product_id);

$stmt->execute();

$stmt->close();
$con->close();

echo json_encode(["success"=>"true","message"=>"Product removed from cart"]);