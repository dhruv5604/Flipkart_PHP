<?php

require('connection.php');
require('check_post.php');

ini_set('display_errors', 1);

$id = $_POST['productId'] ?? null;
$price = $_POST['productPrice'];
$category = $_POST['categoryList'];
$desc = $_POST['productDescription'];
$offer = $_POST['productOffer'];
$stock = $_POST['productStock'];
$existingImage = $_POST['existingImage'] ?? "";
$imageToSave = $existingImage;

$errors = [];

if (empty($price)) {
    $errors['price'] = 'Please Enter price';
} else if (!is_numeric($price)) {
    $errors['price'] = 'Please Enter Numbers only';
} else if ($price < 0) {
    $errors['price'] = 'Price Must be greate than 0';
}

if (empty($category)) {
    $errors['category'] = 'Please select category';
}

if (empty($desc)) {
    $errors['name'] = 'Please Enter Name';
}

if (empty($offer)) {
    $errors['offer'] = 'Please Enter offer';
} else if (!is_numeric($offer)) {
    $errors['offer'] = 'Please Enter Numbers only';
} else if ($offer > 100 || $offer < 0) {
    $errors['offer'] = 'Discount must be greater than 0 and less than 100';
}

if (empty($stock)) {
    $errors['stock'] = 'Please Enter stock';
}

if (!empty($_FILES['productImage']['name'])) {
    $uploadDir = realpath("static/uploaded-img") . "/";
    $originalName = basename($_FILES["productImage"]["name"]);
    $fileExtension = pathinfo($originalName, PATHINFO_EXTENSION);
    $fileNameOnly = pathinfo($originalName, PATHINFO_FILENAME);

    $newImage = $fileNameOnly . '_' . time() . '.' . $fileExtension;
    $targetFilePath = $uploadDir . $newImage;

    if (!is_writable($uploadDir)) {
        echo json_encode(["sucess" => false, "error_block" => "span-image", "message" => "Upload directory is not writable: "]);
        exit;
    }

    if ($_FILES["productImage"]["error"] !== UPLOAD_ERR_OK) {
        echo json_encode(["sucess" => false, "error_block" => "span-image", "message" => "File upload error: " . $_FILES["productImage"]["error"]]);
        exit;
    }

    if (move_uploaded_file($_FILES["productImage"]["tmp_name"], $targetFilePath)) {
        $imageToSave = "../static/uploaded-img/" . $newImage;
    } else {
        echo json_encode(["sucess" => false, "error_block" => "span-image", "message" => "Image upload failed. Check folder permissions."]);
        exit;
    }
}

if (empty($imageToSave)) {
    $errors['image'] = 'Please Enter Image';
}

if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    $_SESSION['form_data'] = $_POST;
    header("Location: admin/products.php");
    exit;
}

try {
    $con->begin_transaction();

    if (!empty($id)) {
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
        $query = "UPDATE products SET price=?, category_id=?, name=?, image=?, offer=? WHERE id=?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("iissii", $price, $category_id, $desc, $imageToSave, $offer, $id);

        if ($stmt->execute()) {
            $stmt->close();

            $query = "UPDATE inventory SET stock = ? WHERE product_id = ?";
            $stmt = $con->prepare($query);
            $stmt->bind_param("ii", $stock, $id);

            if ($stmt->execute()) {
                header('Content-Type: application/json');
                echo json_encode(["success" => true, "message" => "Product updated successfully"]);
            } else {
                echo json_encode(["error" => "Failed to update inventory"]);
            }
            $stmt->close();
        } else {
            echo json_encode(["error" => "Database error in update"]);
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
                if ($stmt->execute()) {
                    echo json_encode(["success" => true, "message" => "Product added successfully"]);
                } else {
                    echo json_encode(["error" => "Failed to insert into inventory"]);
                }
                $stmt->close();
            } else {
                echo json_encode(["error" => "Failed to insert product"]);
            }
        } else {
            echo json_encode(["sucess" => false, "error_block" => "span-description", "message" => "Product already exists."]);
            exit;
        }
    }
    $con->commit();
} catch (Exception $e) {
    $con->rollback();
    echo json_encode(["error" => $e->getMessage()]);
}

$con->close();
exit;
