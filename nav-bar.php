<div class="container-fluid p-2">
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <a class="navbar-brand" href="/">
            <img src="/static/img/flipkartlogo.svg" alt="Flipkart Logo" class="img-fluid">
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
                        <i class="fa-regular fa-user"></i> <?php echo $_SESSION['uname']; ?>
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
                        <li><a class="dropdown-item" href="view-orders">Orders</a></li>
                        <li><a class="dropdown-item" href="#">Wishlist</a></li>
                        <li><a class="dropdown-item" href="#">Rewards</a></li>
                    </ul>
                </li>
                <li class="nav-item me-3">
                    <button type="button" class="btn me-2" id="btn-cart" onclick="window.location.href = '../view-cart'"><i class="fa-solid fa-cart-shopping"></i> Cart</button>
                </li>
                <li class="nav-item me-3">
                    <button type="button" class="btn"><i class="fa-solid fa-shop"></i> Become a Seller</button>
                </li>
                <li class="nav-item me-3">
                    <div class="btn-group">
                        <button type="button" class="btn1" lis><img src="./static/img/3dots.svg"></button>
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
                                <a type="button" class="btn btn-primary" href="./admin/">Admin Panel</a>
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