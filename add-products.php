<?php

require('connection.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_POST['productId'] ?? null;
    $price = $_POST['productPrice'];
    $category = $_POST['categoryList'];
    $desc = $_POST['productDescription'];
    $existingImage = $_POST['existingImage'] ?? "";
    $imageToSave = $existingImage;

    $query = "select * from products where name = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $desc);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        $query = "SELECT id FROM category WHERE category = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("s", $category);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $category_id = $row['id'];
        } else {
            echo json_encode(["error" => "Invalid category"]);
            exit;
        }

        if (!empty($_FILES['productImage']['name'])) {
            $uploadDir = realpath("../img") . "/";
            $newImage = basename($_FILES["productImage"]["name"]);
            $targetFilePath = $uploadDir . $newImage;

            if (!is_writable($uploadDir)) {
                echo json_encode(["error" => "Upload directory is not writable: " . $uploadDir]);
                exit;
            }

            if ($_FILES["productImage"]["error"] !== UPLOAD_ERR_OK) {
                echo json_encode(["error" => "File upload error: " . $_FILES["productImage"]["error"]]);
                exit;
            }

            if (move_uploaded_file($_FILES["productImage"]["tmp_name"], $targetFilePath)) {
                $imageToSave = "../img/" . $newImage;
            } else {
                echo json_encode(["error" => "Image upload failed. Check folder permissions."]);
                exit;
            }
        }

        if (!empty($id)) {
            $query = "UPDATE products SET price=?, category_id=?, name=?, image=? WHERE id=?";
            $stmt = $con->prepare($query);
            $stmt->bind_param("iissi", $price, $category_id, $desc, $imageToSave, $id);
        } else {
            $query = "INSERT INTO products (price, category_id, name, image) VALUES (?, ?, ?, ?)";
            $stmt = $con->prepare($query);
            $stmt->bind_param("iiss", $price, $category_id, $desc, $imageToSave);
        }

        if ($stmt->execute()) {
            echo json_encode(["success" => true, "message" => "Product added/updated successfully"]);
        } else {
            echo json_encode(["error" => "Database error"]);
        }

        $stmt->close();
        $con->close();
        exit;
    } else {
        echo json_encode(["error" => "Product already exists"]);
    }
}
