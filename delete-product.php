<?php

require('connection.php');
require('check_post.php');

$id = $_POST['id'];

$query = "delete from products where id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();

$stmt->close();
$con->close();

header('Content-Type: application/json');
echo json_encode(['status' => 'success']);
