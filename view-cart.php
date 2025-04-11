<?php
ini_set('display_errors', 1);
require('is_login.php');
require('config.php');  
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Flipkart View Cart</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <link rel="stylesheet" href="./css/index.css">
  <style>
    body {
      background-color: #f1f1f1;
    }

    #cart-container {
      width: 60%;
      margin: 40px auto;
      background-color: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }

    .cart-item {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 15px 0;
      border-bottom: 1px solid #ddd;
    }

    .cart-item img {
      width: 100px;
      height: auto;
      border-radius: 5px;
    }

    .cart-item .item-details {
      flex: 1;
      margin-left: 20px;
    }

    .cart-item .item-details h5 {
      margin: 0;
      font-size: 18px;
    }

    .cart-item .item-details p {
      margin: 5px 0;
      color: gray;
    }

    .quantity {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .quantity button {
      background-color: #007bff;
      color: white;
      border: none;
      padding: 5px 10px;
      font-size: 16px;
      cursor: pointer;
    }

    .quantity input {
      width: 40px;
      text-align: center;
      border: 1px solid #ddd;
      border-radius: 3px;
    }

    .subtotal {
      text-align: right;
      font-size: 18px;
      font-weight: bold;
    }

    .place-order {
      width: 100%;
      padding: 12px;
      background-color: #ff9f00;
      border: none;
      color: white;
      font-size: 18px;
      border-radius: 5px;
      cursor: pointer;
      margin-top: 20px;
    }

    .place-order:hover {
      background-color: #f57c00;
    }
  </style>
</head>

<body>

  <?php
  require('nav-bar.php');
  ?>

  <div id="cart-container">
    <h2>Shopping Cart</h2>
    <div id="inside-cart">

    </div>
    <div class="subtotal"></div>

    <form action="process-payment.php" method="post" id="form1">
      <button class="btn btn-primary" id="checkout-btn">Pay</button>
    </form> 
  </div>

  <script src="./js/viewcart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
</body>

</html>