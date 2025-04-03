<?php
require('connection.php');
require('check_post.php');
session_start();

$user_id = $_SESSION['user_id'];
$total_amount = $_POST['amount'];

$query_insert_order = "insert into Orders(user_id, total_amount, transaction_id) values (?, ?, 1)";
$stmt = $con->prepare($query_insert_order);
$stmt->bind_param("ii", $user_id, $total_amount);
$stmt->execute();

$order_id = $stmt->insert_id;
$stmt->close();

$query_select_cart = "select * from cart where user_id = ?";
$stmt = $con->prepare($query_select_cart);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();

$products = $result->fetch_all(MYSQLI_ASSOC);

$query_insert_orderItems = "insert into Order_Item(order_id, product_name,product_price,product_img,quantity,product_offer) values (?, ?, ?, ?, ?, ?)";
$stmt = $con->prepare($query_insert_orderItems);

foreach ($products as $product) {
    $product_id = $product['product_id'];
    $quantity = $product['quantity'];

    $query_product = "select name,image,price,offer from products where id = ?";
    $stmt_product = $con->prepare($query_product);
    $stmt_product->bind_param("i", var: $product_id);
    $stmt_product->execute();
    $stmt_product->bind_result($product_name, $product_img, $product_price, $product_offer);
    $stmt_product->fetch();
    $stmt_product->close();

    $stmt->bind_param("isisii", $order_id, $product_name, $product_price, $product_img, $quantity, $product_offer);
    $stmt->execute();
}
$stmt->close();

$query_delete_cart = "delete from cart where user_id = ?";
$stmt = $con->prepare($query_delete_cart);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->close();

$con->close();
