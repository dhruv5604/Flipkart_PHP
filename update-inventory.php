<?php

require 'check_post.php';
require 'connection.php';

$cart_id = $_POST['cart_id'];
$action = $_POST['action'];

$query = ($action === "plus")
? "update inventory set stock = stock - 1 where product_id = (select product_id from cart where id = ?)"
: (($action === "minus")
    ? "update inventory set stock = stock + 1 where product_id = (select product_id from cart where id = ?)"
    : "update inventory set stock = stock ");

$stmt = $con->prepare($query);
$stmt->bind_param("i", $cart_id);
$stmt->execute();
