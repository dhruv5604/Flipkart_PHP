<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
        body {
            background-color: #f1f1f1;
            height: 20px;
        }

        .order-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .toggle-items {
            cursor: pointer;
            color: blue;
            text-decoration: underline;
        }

        .order-items {
            display: none;
            margin-top: 10px;
        }

        .status {
            font-weight: bold;
        }

        .status.pending {
            color: orange;
        }

        .status.completed {
            color: green;
        }

        .status.cancelled {
            color: red;
        }
    </style>
    <link rel="stylesheet" href="./css/index.css">
</head>
<body>
    <?php
    require('nav-bar.php');
    ?>
    <div class="container mt-4 p-4">
        <h2 class="mb-4">My Orders</h2>

        <div id="order-list">
        </div>
    </div>
    <script src="./js/viewOrders.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>