<?php

require 'check_post.php';
require 'connection.php';

$cart_id = $_POST['cart_id'];
$action = $_POST['action'];

$query = ($action === "plus")
    ? "update inventory set stock = stock - 1 where product_id = (select product_id from cart where id = ?)"
    : "update inventory set stock = stock + 1 where product_id = (select product_id from cart where id = ?)";

$stmt = $con->prepare($query);
$stmt->bind_param("i", $cart_id);
$stmt->execute();

$query2 = ($action === "plus")
    ? "update cart set quantity = quantity + 1 where id = ?"
    :  "update cart set quantity = quantity - 1 where id = ?";

$stmt1 = $con->prepare($query2);
$stmt1->bind_param("i",$cart_id);
$stmt1->execute();
