<?php

session_start();

if ($_SESSION['role'] != "admin") {
    header("Location: ../index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/product.css" />
</head>

<body>
    <h1>Product Management System</h1>
    <form id="form1">
        <input type="hidden" id="productId" name="productId" />
        <label for="productImage">Image URL:</label>
        <input type="file" name="productImage" id="productImage" accept="image/*" />
        <label for="productPrice">Price:</label>
        <input type="number" name="productPrice" id="productPrice" required />
        <label for="categoryList">Category:</label>
        <select name="categoryList" id="categoryList">
        </select>
        <label for="productDescription">Description:</label>
        <textarea id="productDescription" name="productDescription" required></textarea>
        <input type="submit" value="Update Product">
    </form>
    <script src="../js/edit.js"></script>
</body>

</html>