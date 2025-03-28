<?php

require('connection.php');
require('check_post.php');

$id = $_POST['productId'] ?? null;
$price = $_POST['productPrice'];
$category = $_POST['categoryList'];
$desc = $_POST['productDescription'];
$offer = $_POST['productOffer'];
$stock = $_POST['productStock'];
$existingImage = $_POST['existingImage'] ?? "";
$imageToSave = $existingImage;

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

try {
    $con->begin_transaction();

    if (!empty($id)) {
        $query = "UPDATE products SET price=?, category_id=?, name=?, image=?, offer=? WHERE id=?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("iissis", $price, $category_id, $desc, $imageToSave, $offer, $id);
        if ($stmt->execute()) {
            echo json_encode(["success" => true, "message" => "Product updated successfully"]);
        } else {
            throw new Exception("Database error in update");
        }
    } else {
        $query = "SELECT id FROM products WHERE name = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("s", $desc);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            $query = "INSERT INTO products (price, category_id, name, image, offer) VALUES (?, ?, ?, ?, ?)";
            $stmt = $con->prepare($query);
            $stmt->bind_param("iissi", $price, $category_id, $desc, $imageToSave, $offer);
            if ($stmt->execute()) {
                $product_id = $con->insert_id;
                $query = "INSERT INTO inventory(product_id, stock) VALUES(?, ?)";
                $stmt = $con->prepare($query);
                $stmt->bind_param("ii", $product_id, $stock);
                if (!$stmt->execute()) {
                    throw new Exception("Failed to insert into inventory");
                }
                echo json_encode(["success" => true, "message" => "Product added successfully"]);
            } else {
                throw new Exception("Failed to insert product");
            }
        } else {
            echo json_encode(["error" => "Product already exists"]);
        }
    }

    $con->commit();
} catch (Exception $e) {
    $con->rollback();
    echo json_encode(["error" => $e->getMessage()]);
}

$stmt->close();
$con->close();
exit;
