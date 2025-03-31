<?php
require('config.php');  
\Stripe\Stripe::setVerifySslCerts(false);

$token = $_POST['stripeToken'];
$amount = isset($_POST['total_amount']) ? intval($_POST['total_amount']) : 0;

if ($amount < 1) {
    die("Error: Total amount must be at least ₹0.01.");
}

try {
    $data = \Stripe\Charge::create([
        "amount" => $amount,
        "currency" => "inr",
        "description" => "Flipkart",
        "source" => $token
    ]);

    $order_id = $data->id;
    $txn_id = $data->balance_transaction;
    $paid_amount = $data->amount / 100; 
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
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
            <p><strong>Order ID:</strong> <?php echo $data['order_id'] ?? 'N/A'; ?></p>
            <p><strong>Transaction ID:</strong> <?php echo $data['txn_id'] ?? 'N/A'; ?></p>
            <p id="amount" data-amount="<?php echo $paid_amount; ?>"><strong>Amount Paid:</strong> ₹<?php echo $paid_amount ?? '0'; ?></p>
            <p><strong>Payment Status:</strong> Success</p>
        </div>
        <br>
        <a href="index.php" class="btn">Back to Home</a>
    </div>
    
    <script src="./js/checkout.js"></script>
</body>
</html>

