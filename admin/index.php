<?php
session_start();
require('../check-admin.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/index.css">
    </link>
    <style>
        body {
            background-color: white;
        }

        h1 {
            margin-top: 100px;
            text-align: center;
        }
    </style>
</head>

<body>
    
    <?php require_once 'nav-bar.php'; ?>

    <div class="container-fluid">
        <div class="container">
            <h1>Hello Admin, Welcome to the Admin Panel.</h1>
        </div>
    </div>
</body>

</html>