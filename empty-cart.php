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

    // Get the last inserted order_id
    $order_id = $stmt->insert_id;
    $stmt->close();

    // Fetch cart items
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

    // Insert into Order_Item table
    $query_insert_orderItems = "insert into Order_Item(order_id, product_id, quantity, price) values (?, ?, ?, ?)";
    $stmt = $con->prepare($query_insert_orderItems);

    foreach ($products as $product) {
        $product_id = $product['product_id'];
        $quantity = $product['quantity'];

        // Fetch product price
        $query_price = "select price from products where id = ?";
        $stmt_price = $con->prepare($query_price);
        $stmt_price->bind_param("i", $product_id);
        $stmt_price->execute();
        $stmt_price->bind_result($price);
        $stmt_price->fetch();
        $stmt_price->close();

        // Insert into Order_Item
        $stmt->bind_param("iiii", $order_id, $product_id, $quantity, $price);
        $stmt->execute();
    }
    $stmt->close();

    // Clear the cart
    $query_delete_cart = "delete from cart where user_id = ?";
    $stmt = $con->prepare($query_delete_cart);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->close();

    $con->close();
}
?>
