<?php

require('connection.php');
require('check_post.php');

$id = $_POST['id'];

$query = "select p.*, c.category from products p join category c on p.category_id = c.id where p.id = ?";
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

while ($row = $result->fetch_assoc()) {
    $category = $row['category'];
}

header("Content-Type: application/json");
echo json_encode(['products' => $products, "stock" => $stock]);
