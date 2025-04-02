<?php
require('connection.php');
require('check_post.php');
session_start();

$product_id = $_POST['product_id'];
$user_id = $_SESSION['user_id'];

$query = "select * from cart where user_id=? and product_id=?";
$stmt = $con->prepare($query);
$stmt->bind_param("ii", $user_id, $product_id);
$stmt->execute();

if ($stmt->get_result()->num_rows > 0) {
    echo json_encode(["success" => "false", "message" => "Product already exists in cart"]);
    exit;
}

$query = "insert into cart(user_id,product_id) values(?,?)";
$stmt = $con->prepare($query);
$stmt->bind_param("ii", $user_id, $product_id);
$stmt->execute();

echo json_encode(["success" => "true", "message" => "Product successfully added to cart"]);
