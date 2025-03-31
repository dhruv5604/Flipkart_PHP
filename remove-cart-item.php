<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require('check_post.php');
require('connection.php');
$user_id = $_SESSION['user_id'];
$cart_id = $_POST['cart_id'];
$quantity = $_POST['quantity'];
$product_id = $_POST['product_id'];

$query = "delete from cart where id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i",$cart_id);

if($stmt->execute()){
    $query = "update inventory set stock = stock + ? where product_id = ?";
    $stmt1 = $con->prepare($query);
    $stmt1->bind_param("ii",$quantity,$product_id);
    $stmt1->execute();
}

$stmt->close();
$stmt1->close();
$con->close();

echo json_encode(["success"=>"true","message"=>"Product removed from cart"]);