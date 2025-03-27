<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <style>
        
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="./css/index.css">
    

    <style>
      /* Reset section-specific styles */
/* Ensure cards expand properly */
section .card {
    display: block !important;  /* Remove flex to prevent forced alignment */
    width: 100% !important;
    max-height: unset !important;
    padding: 20px !important;
}

/* Fix layout inside the card */
section .card-body {
    display: flex;
    flex-direction: column;  /* Stack items vertically */
    align-items: flex-start;  /* Align text properly */
    flex-wrap: wrap;  /* Ensure wrapping */
    gap: 10px; /* Space between elements */
}

/* Ensure image does not shrink or overlap */
section .card img {
    width: 100% !important;
    height: auto !important;
    max-width: 150px; /* Adjust based on requirement */
}

/* Fix row alignment */
.row.align-items-center {
    display: flex;
    flex-wrap: wrap;  /* Allow items to wrap */
    justify-content: space-between;  /* Proper spacing */
}


    </style>

  </head>
  <body>

    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <a class="navbar-brand" href="#">
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
                    <button type="button" class="btn me-2"><i class="fa-solid fa-cart-shopping"></i> Cart</button>
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
                    if($_SESSION['role'] == 'admin'){
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

    <section class="vh-100" style="background-color: #f1f1f1;">
        <div class="container h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col">
              <p><span class="h2">Shopping Cart </span><span class="h4">(1 item in your cart)</span></p>
      
              <div class="card mb-4">
                <div class="card-body p-4">
      
                  <div class="row align-items-center">
                    <div class="col-md-2">
                      <img src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/E-commerce/Products/1.webp"
                        class="img-fluid" alt="Generic placeholder image">
                    </div>
                    <div class="col-md-2 d-flex justify-content-center">
                      <div>
                        <p class="small text-muted mb-4 pb-2">Name</p>
                        <p class="lead fw-normal mb-0">iPad Air</p>
                      </div>
                    </div>
                    <div class="col-md-2 d-flex justify-content-center">
                      <div>
                        <p class="small text-muted mb-4 pb-2">Color</p>
                        <p class="lead fw-normal mb-0"><i class="fas fa-circle me-2" style="color: #fdd8d2;"></i>
                          pink rose</p>
                      </div>
                    </div>
                    <div class="col-md-2 d-flex justify-content-center">
                      <div>
                        <p class="small text-muted mb-4 pb-2">Quantity</p>
                        <p class="lead fw-normal mb-0">1</p>
                      </div>
                    </div>
                    <div class="col-md-2 d-flex justify-content-center">
                      <div>
                        <p class="small text-muted mb-4 pb-2">Price</p>
                        <p class="lead fw-normal mb-0">$799</p>
                      </div>
                    </div>
                    <div class="col-md-2 d-flex justify-content-center">
                      <div>
                        <p class="small text-muted mb-4 pb-2">Total</p>
                        <p class="lead fw-normal mb-0">$799</p>
                      </div>
                    </div>
                  </div>
      
                </div>
              </div>
      
              <div class="card mb-5">
                <div class="card-body p-4">
      
                  <div class="float-end">
                    <p class="mb-0 me-5 d-flex align-items-center">
                      <span class="small text-muted me-2">Order total:</span> <span
                        class="lead fw-normal">$799</span>
                    </p>
                  </div>
      
                </div>
              </div>
      
              <div class="d-flex justify-content-end">
                <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-light btn-lg me-2">Continue shopping</button>
                <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg">Add to cart</button>
              </div>
      
            </div>
          </div>
        </div>
      </section>
  </body>
</html>
