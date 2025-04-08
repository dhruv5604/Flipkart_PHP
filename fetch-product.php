<?php

require('connection.php');
require('check_post.php');

$id = $_POST['id'];

$query = "select * from products where id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();
$products = $result->fetch_all(MYSQLI_ASSOC);

$query = "select * from inventory where product_id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();
$stock = $result->fetch_all(MYSQLI_ASSOC);

$query = "select * from category where id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $category_id);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $category = $row['category'];
}

header("Content-Type: application/json");
echo json_encode(['products' => $products, "category" => $category, "stock" => $stock]);
