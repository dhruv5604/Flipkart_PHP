<?php

require('connection.php');

$query = "SELECT * FROM category";
$result = $con->query($query);

$categories = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($categories);
