<?php

require('connection.php');

$query = "SELECT * FROM category";
$result = $con->query($query);

$categories = [];

$categories = $result->fetch_all(MYSQLI_ASSOC);

header('Content-Type: application/json');
echo json_encode($categories);
