<?php

require('connection.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_POST['productId'];
    $price = $_POST['productPrice'];
    $category = $_POST['categoryList'];
    $desc = $_POST['productDescription'];
    $existingImage = $_POST['existingImage']; // Fetch existing image path

    // Define target directory for images
    $targetDir = "../img/";

    // Check if a new image is uploaded
    if (!empty($_FILES['productImage']['name'])) {
        $newImage = basename($_FILES["productImage"]["name"]);
        $targetFilePath = $targetDir . $newImage;

        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES["productImage"]["tmp_name"], $targetFilePath)) {
            $imageToSave = $targetFilePath; // Save full path: "../img/filename.jpeg"
        } else {
            echo json_encode(["error" => "Image upload failed"]);
            exit;
        }
    } else {
        $imageToSave = $existingImage; // Use the old image if no new one is uploaded
    }

    // Ensure image path consistency in DB
    if (!str_starts_with($imageToSave, "../img/")) {
        $imageToSave = "../img/" . $imageToSave;
    }

    // Update product in the database
    $query = "UPDATE products SET price=?, category=?, description=?, image=? WHERE id=?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("isssi", $price, $category, $desc, $imageToSave, $id);
    $stmt->execute();
    $stmt->close();
    $con->close();

    // Redirect back to product management page
    header("Location: admin/products.html");
    exit;
}
