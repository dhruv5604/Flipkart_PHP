<?php

require('connection.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_POST['productId'];
    $price = $_POST['productPrice'];
    $category = $_POST['categoryList'];
    $desc = $_POST['productDescription'];
    $existingImage = $_POST['existingImage']; // Fetch existing image path
    // Define target directory for images
    $imageToSave = $existingImage; // Default to existing image

    // Check if a new image is uploaded
    if (!empty($_POST['productImage'])) {
        $newImage = $_POST["productImage"];
        $targetFilePath = "../img/" . $newImage; // Full path
        $imageToSave = $targetFilePath;
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
?>
