<?php

session_start();
require('../check-admin.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous" />
  <link rel="stylesheet" href="../css/product.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

  <style>
    td button {
      width: 10px;
      margin: 10px;
      background: none;
      border: none;
    }
  </style>
</head>

<body>
  <?php
  require('nav-bar.php');
  ?>

  <h1 style="text-align: center">Welcome To Product Crud Operatidon</h1>

  <div class="form1">
    <form id="form1">
      <input type="hidden" id="productId" name="productId" />
      <input type="hidden" id="existingImage" name="existingImage" />
      <label for="productImage">Image URL:</label>
      <input
        type="file"
        name="productImage"
        id="productImage"
        accept="image/*"
        required />
      <label for="productPrice">Price:</label>
      <input type="number" name="productPrice" id="productPrice" required />
      <label for="categoryList">Category:</label>
      <select name="categoryList" id="categoryList"></select>
      <label for="productDescription">Name:</label>
      <input
        type="text"
        id="productDescription"
        name="productDescription"
        required />
      <label for="productOffer">Offer:</label>
      <input type="number" name="productOffer" id="productOffer" max="100" min="0">
      <label for="productStock">Stock:</label>
      <input type="number" id="productStock" name="productStock" />
      <input type="submit" value="Add product" />
    </form>
  </div>

  <table id="table1">
    <thead>
      <tr>
        <th class="inside-th">
          Product ID
          <button class="sort-btn" data-sort="id">
            <i class="fas fa-sort"></i>
          </button>
        </th>
        <th>Image</th>
        <th class="inside-th">
          Price
          <button class="sort-btn" data-sort="price">
            <i class="fas fa-sort"></i>
          </button>
        </th>
        <th>Name</th>
        <th>Category Id</th>
        <th>Offer</th>
        <th>Stock</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody id="product-list"></tbody>
  </table>

  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
  <script src="../js/products.js"></script>
</body>

</html>