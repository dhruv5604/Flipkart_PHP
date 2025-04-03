<?php
session_start();
require('../check-admin.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/index.css">
    </link>
    <link rel="stylesheet" href="../css/product.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
        body {
            background-color: white;
        }
        h1 {
            margin-top: 100px;
            text-align: center;
        }
        td button {
            width: 10%;
            background: none;
            border: none;
        }
        .id {
            width: 20%;
        }
        .category {
            width: 40%;
        }
        .action {
            width: 20%;
        }
    </style>
</head>

<body>

    <div class="container-fluid p-2">
        <nav class="navbar navbar-expand-lg navbar-light bg-white">
            <a class="navbar-brand" href="#">
                <img
                    src="../static/img/flipkartlogo.svg"
                    alt="Flipkart Logo"
                    class="img-fluid" />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-5">
                    <li class="nav-item me-3">
                        <a type="button" class="btn btn-primary" href="../index">HomePage</a>
                    </li>
                    <li class="nav-item me-3">
                        <a type="button" class="btn btn-primary" href="./products">Product Crud</a>
                    </li>
                    <li>
                        <a type="button" class="btn btn-primary" href="./category">Category crud</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

    <div class="form2">
        <form id="categoryForm">
            <input type="hidden" id="categoryId" name="categoryId">
            <input type="text" name="newCategory" id="newCategory" placeholder="Enter New Category" required>
            <button type="submit">Add Category</button>
        </form>
        <table>
            <thead>
                <tr>
                    <th class="id">Id</th>
                    <th class="category">Category</th>
                    <th class="action">Actions</th>
                </tr>
            </thead>
            <tbody id="category-list">
            </tbody>
        </table>
    </div>
    </div>

    <script src="../js/category.js"></script>
</body>

</html>