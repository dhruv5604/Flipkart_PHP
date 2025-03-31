<?php
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

  <div class="container-fluid p-2">
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
      <a class="navbar-brand" href="index.php">
        <img src="./img/flipkartlogo.svg" alt="Flipkart Logo" class="img-fluid">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <div class="input-group ms-4 me-4">
          <span class="input-group-text" id="span4search">
            <i class="fa-solid fa-magnifying-glass"></i>
          </span>
          <input type="text" class="form-control" placeholder="Search for Products, Brands, and More"
            aria-describedby="span4search">
        </div>
        <ul class="navbar-nav ms-5">
          <li class="nav-item dropdown me-3">
            <button type="button" class="btn loginbtn btn-outline-primary dropdown-toggle me-4"
              data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa-regular fa-user"></i> Login
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">New Customer <span class="text-primary">Sign
                    Up</span></a>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="#">My Profile</a></li>
              <li><a class="dropdown-item" href="#">Flipkart Plus zone</a></li>
              <li><a class="dropdown-item" href="#">Orders</a></li>
              <li><a class="dropdown-item" href="#">Wishlist</a></li>
              <li><a class="dropdown-item" href="#">Rewards</a></li>
            </ul>
          </li>
          <li class="nav-item me-3">
            <button type="button" class="btn me-2" id="btn-cart"><i class="fa-solid fa-cart-shopping"></i> Cart</button>
          </li>
          <li class="nav-item me-3">
            <button type="button" class="btn"><i class="fa-solid fa-shop"></i> Become a Seller</button>
          </li>
          <li class="nav-item me-3">
            <div class="btn-group">
              <button type="button" class="btn1" lis><img src="./img/3dots.svg"></button>
              <ul class="listfor3dot">
                <li>Notifications</li>
                <li>24X7 Customer Care</li>
                <li>Advertise</li>
                <li>Download App</li>
              </ul>
            </div>
          </li>
          <?php
          if ($_SESSION['role'] == 'admin') {
            echo '<li>
                                <a type="button" class="btn btn-primary" href="./admin/index.php">Admin Panel</a>
                            </li>';
          }
          ?>
          <li>
            <a type="button" class="btn btn-primary logout-btn" href="logout.php">Logout</a>
          </li>
        </ul>
      </div>
    </nav>
  </div>

  <div id="cart-container">
    <h2>Shopping Cart</h2>
    <div id="inside-cart">

    </div>
    <div class="subtotal"></div>

    <form action="checkout.php" method="post" id="form1" >
       
    </form>

    <!-- <button class="place-order">Place Order</button> -->
  </div>

  <script src="./js/viewcart.js"></script>
</body>

</html>