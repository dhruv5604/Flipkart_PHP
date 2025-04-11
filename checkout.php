<?php
require('connection.php');

$order_id = $_GET['order_id'];

$query = "select transaction_id,total_amount from Orders where id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $order_id);
$stmt->execute();
$stmt->bind_result($transaction_id, $total_amount);
$stmt->fetch();
$stmt->close();
$con->close();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 50px;
            background-color: #f8f9fa;
        }

        .container {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: inline-block;
        }

        .success-icon {
            color: green;
            font-size: 50px;
            margin-bottom: 20px;
        }

        .order-details {
            text-align: left;
            display: inline-block;
            margin-top: 20px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <i class="fa fa-check-circle success-icon"></i>
        <h2>Payment Successful!</h2>
        <p>Thank you for your purchase. Your transaction has been completed.</p>

        <div class="order-details">
            <p><strong>Order ID:</strong> <?= $order_id?></p>
            <p><strong>Transaction ID:</strong> <?= $transaction_id?> </p>
            <p><strong>Amount Paid:</strong> ₹ <?= $total_amount?></p>
            <p><strong>Payment Status:</strong> Success</p>
        </div>
        <br>
        <a href="index.php" class="btn">Back to Home</a>
    </div>
    
</body>
</html>