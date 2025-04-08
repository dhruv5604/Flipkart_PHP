<?php

require('connection.php');
require('check_post.php');

$category = trim($_POST['newCategory']);
$id = isset($_POST['categoryId']) ? intval($_POST['categoryId']) : 0;

if (empty($category)) {
    echo json_encode(["sucess" => false, "error_block" => "span-category", "message" => "Please Enter Category Name"]);
    exit;
}

$query = "SELECT category FROM category WHERE category = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("s", $category);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    if ($id > 0) {
        $query = "UPDATE category SET category = ? WHERE id = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("si", $category, $id);
    } else {
        $query = "INSERT INTO category (category) VALUES (?)";
        $stmt = $con->prepare($query);
        $stmt->bind_param("s", $category);
    }

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Category added/updated"]);
    } else {
        echo json_encode(["error" => "Database error"]);
    }

    $stmt->close();
} else {
    echo json_encode(["sucess" => false, "error_block" => "span-category", "message" => "Category already Exists!!"]);
}

$con->close();
exit;
