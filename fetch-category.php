<?php

require('connection.php');
require('check_post.php');

$id = $_POST["id"];

$query = 'select * from category where id = ?';
$stmt = $con->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$categories = $result->fetch_all(MYSQLI_ASSOC);

header('Content-Type: application/json');
echo json_encode($categories);
