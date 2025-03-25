<?php

require('connection.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $category = $_POST['newCategory'];
    $id = isset($_POST['categoryId']) ? intval($_POST['categoryId']) : 0;

    if ($id > 0) {
        // **Update Category**
        $query = "UPDATE category SET category = ? WHERE id = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("si", $category, $id);
    } else {
        // **Insert New Category**
        $query = "INSERT INTO category (category) VALUES (?)";
        $stmt = $con->prepare($query);
        $stmt->bind_param("s", $category);
    }

    $stmt->execute();
    $stmt->close();
    $con->close();
    header("Location: admin/category.html");
}
