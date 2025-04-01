<?php
require('connection.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == "GET") {

    $user_id = $_SESSION['user_id'];
    $total_amount = $_GET['amount'];

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

    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }

    $query_insert_orderItems = "insert into Order_Item(order_id, product_id, quantity, price) values (?, ?, ?, ?)";
    $stmt = $con->prepare($query_insert_orderItems);

    foreach ($products as $product) {
        $product_id = $product['product_id'];
        $quantity = $product['quantity'];

        $query_price = "select price from products where id = ?";
        $stmt_price = $con->prepare($query_price);
        $stmt_price->bind_param("i", $product_id);
        $stmt_price->execute();
        $stmt_price->bind_result($price);
        $stmt_price->fetch();
        $stmt_price->close();

        $stmt->bind_param("iiii", $order_id, $product_id, $quantity, $price);
        $stmt->execute();
    }
    $stmt->close();

    $query_delete_cart = "delete from cart where user_id = ?";
    $stmt = $con->prepare($query_delete_cart);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->close();

    $con->close();
}
?>
