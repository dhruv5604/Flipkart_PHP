<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
session_start();
require('../check-admin.php');

$errors = $_SESSION['errors'] ?? '';
$form_data =  $_SESSION['form_data'] ?? '';

unset($_SESSION['errors']);
unset($_SESSION['form_data']);
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

        span {
            color: red;
        }
    </style>
</head>

<body>

    <?php
    require('nav-bar.php');
    ?>

    <div class="form2">
        <form id="categoryForm" action="../add-category" method="post">
            <input type="hidden" id="categoryId" name="categoryId">
            <input type="text" name="newCategory" id="newCategory" placeholder="Enter New Category" value="<?= $form_data['newCategory'] ?? '' ?>">
            <span id="span-category">
                <?= $errors['span-category'] ?? '' ?>
            </span>
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