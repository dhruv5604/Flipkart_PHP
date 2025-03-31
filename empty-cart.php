<?php
require('connection.php');
session_start();

if($_SERVER['REQUEST_METHOD'] == "GET"){

    $user_id = $_SESSION['user_id'];
    $total_amount = $_GET['amount'];

    $query_insert_order = "insert into Orders(user_id,total_amount,transaction_id) values(?,?,1)";
    $stmt = $con->prepare($query_insert_order);
    $stmt->bind_param("ii",$user_id,$total_amount);
    $stmt->execute();
    $stmt->close();

    $query_insert_orderItems = "insert into Order_Item(order_id,product_id,quantity,price) values(?,?,?,?)";
    

    $query_delete_cart = 'delete from cart where user_id = ?';
    $stmt = $con->prepare($query_delete_cart);
    $stmt->bind_param("i",$user_id);
    $stmt->execute();
    $stmt->close();
    $con->close();

}