<?php

require 'check_post.php';
require 'connection.php';

$cart_id = $_POST['cart_id'];
$action = $_POST['action'];

$operator = ($action === "plus") ? "-" : "+";

$query = "update inventory set stock = stock {$operator} 1 where product_id = (select product_id from cart where id = ?)";

$stmt = $con->prepare($query);
$stmt->bind_param("i", $cart_id);
$stmt->execute();

$operator = ($action === "plus") ? "+" : "-";

$query2 = "update cart set quantity = quantity {$operator} 1 where id = ?";

$stmt1 = $con->prepare($query2);
$stmt1->bind_param("i", $cart_id);
$stmt1->execute();
