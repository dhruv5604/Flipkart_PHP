<?php
session_start();
if (!isset($_SESSION['uname'])) {
    header('Location:login');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="./css/index.css">
    </link>
    <title>Flipkart</title>
</head>

<body>
    <?php
    require('nav-bar.php');
    ?>

    <div class="container d-flex justify-content-center flex-wrap mt-3 p-4">
        <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-3 d-flex justify-content-center">
            <button class="btn text-center">
                <img class="img-fluid" src="./img/grocery.webp" alt="Grocery">
                <strong>Grocery</strong>
            </button>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-3 d-flex justify-content-center">
            <button class="btn text-center">
                <img class="img-fluid" src="./img/mobile.webp" alt="Mobile">
                <strong>Mobile</strong>
            </button>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-3 d-flex justify-content-center">
            <button class="btn text-center">
                <img class="img-fluid" src="./img/grocery.webp" alt="Fashion">
                <strong>Fashion</strong>
            </button>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-3 d-flex justify-content-center">
            <button class="btn text-center">
                <img class="img-fluid" src="./img/applicens.webp" alt="Appliances">
                <strong>Appliances</strong>
            </button>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-3 d-flex justify-content-center">
            <button class="btn text-center">
                <img class="img-fluid" src="./img/flight.webp" alt="Flights">
                <strong>Flights</strong>
            </button>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-3 d-flex justify-content-center">
            <button class="btn text-center">
                <img class="img-fluid" src="./img/grocery.webp" alt="Flights">
                <strong>Grocery</strong>
            </button>
        </div>
    </div>

    <div class="container mt-3">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="./img/caresol1.webp" class="d-block w-100 img-fluid" alt="caresol1">
                </div>
                <div class="carousel-item">
                    <img src="./img/caresol2.webp" class="d-block w-100 img-fluid" alt="caresol2">
                </div>
                <div class="carousel-item">
                    <img src="./img/caresol3.webp" class="d-block w-100 img-fluid" alt="caresol3">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <div class="container mt-3 p-2">
        <div class="row ms-2">
            <h4>Best of Electronics</h4>
        </div>
    </div>

    <div class="container">
        <div class="d-flex">
            <div class="row" style="width: 100%;">
                <div class="d-flex instruments2">
                    <div class="cards-wrapper">
                        <div class="card">
                            <img src="img/soft.jpeg" class="card-img-top img-fluid" alt="soft toy">
                            <div class="card-body">
                                <p class="card-text">Soft Toys</p>
                                <strong class="card-text">Upto 70% off</strong>
                            </div>
                        </div>
                        <div class="card">
                            <img src="img/coffee.jpeg" class="card-img-top img-fluid" alt="Coffee Powder">
                            <div class="card-body ">
                                <p class="card-text ">Coffee Powder</p>
                                <strong class="card-text">Upto 80% off</strong>
                            </div>
                        </div>
                        <div class="card">
                            <img src="img/musi.jpeg" class="card-img-top mb-3" alt="Musical Keyboards">
                            <div class="card-body ">
                                <p class="card-text ">Musical Keyboards</p>
                                <strong class="card-text ">Upto 70% off</strong>
                            </div>
                        </div>
                        <div class="card">
                            <img src="img/guitar.jpeg" class="card-img-top img-fluid" alt="Strings Instruments">
                            <div class="card-body ">
                                <p class="card-text ">Strings Instruments</p>
                                <strong class="card-text">Upto 70% off</strong>
                            </div>
                        </div>
                        <div class="card">
                            <img src="img/microphone.jpeg" class="card-img-top img-fluid" alt="Microphones">
                            <div class="card-body mt-4">
                                <p class="card-text ">Microphones</p>
                                <strong class="card-text">Upto 70% off</strong>
                            </div>
                        </div>
                        <div class="card">
                            <img src="img/cycle.jpeg" class="card-img-top mb-5" alt="Non-Geared Cycles">
                            <div class="card-body ">
                                <p class="card-text">Non-Geared Cycles</p>
                                <strong class="card-text ">Upto 40% off</strong>
                            </div>
                        </div>
                        <div class="card">
                            <img src="img/cycle.jpeg" class="card-img-top mb-5" alt="Non-Geared Cycles">
                            <div class="card-body ">
                                <p class="card-text">Non-Geared Cycles</p>
                                <strong class="card-text ">Upto 40% off</strong>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="dn" style="width: 20%;">
                    <div>
                        <img src="https://rukminim1.flixcart.com/fk-p-flap/260/810/image/d5d599c240c9b2ea.jpeg?q=20"
                            alt="" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="category-container"></div>

    <div class="container mt-3 p-2">
        <div class="row ms-2">
            <h4>Beauty,Food,Toys and more</h4>
        </div>
    </div>

    <div class="container instruments mb-3 ">

        <div class="d-flex">
            <div class="cards-wrapper">
                <div class="card">
                    <img src="img/soft.jpeg" class="card-img-top img-fluid" alt="soft Toy image">
                    <div class="card-body">
                        <p class="card-text">Soft Toys</p>
                        <strong class="card-text">Upto 70% off</strong>
                    </div>
                </div>
                <div class="card">
                    <img src="img/coffee.jpeg" class="card-img-top img-fluid" alt="Coffee Powder">
                    <div class="card-body ">
                        <p class="card-text ">Coffee Powder</p>
                        <strong class="card-text">Upto 80% off</strong>
                    </div>
                </div>
                <div class="card">
                    <img src="img/musi.jpeg" class="card-img-top mb-3" alt="Musical Keyboards">
                    <div class="card-body ">
                        <p class="card-text ">Musical Keyboards</p>
                        <strong class="card-text ">Upto 70% off</strong>
                    </div>
                </div>
                <div class="card">
                    <img src="img/guitar.jpeg" class="card-img-top img-fluid" alt="Strings Instruments">
                    <div class="card-body ">
                        <p class="card-text ">Strings Instruments</p>
                        <strong class="card-text">Upto 70% off</strong>
                    </div>
                </div>
                <div class="card">
                    <img src="img/microphone.jpeg" class="card-img-top img-fluid" alt="Microphones">
                    <div class="card-body mt-4">
                        <p class="card-text ">Microphones</p>
                        <strong class="card-text">Upto 70% off</strong>
                    </div>
                </div>
                <div class="card">
                    <img src="img/cycle.jpeg" class="card-img-top mb-5" alt="Non-Geared Cycles">
                    <div class="card-body ">
                        <p class="card-text">Non-Geared Cycles</p>
                        <strong class="card-text ">Upto 40% off</strong>
                    </div>
                </div>
                <div class="card">
                    <img src="img/cycle.jpeg" class="card-img-top mb-5" alt="Non-Geared Cycles">
                    <div class="card-body ">
                        <p class="card-text">Non-Geared Cycles</p>
                        <strong class="card-text ">Upto 40% off</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid footer">
        <div class="container">
            <div class="row">
                <div class="col-md quick-links">
                    <h5>Quick Links</h5>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Offers</a></li>
                        <li><a href="#">Cart</a></li>
                        <li><a href="#">Account</a></li>
                    </ul>
                </div>
                <div class="col-md info-links">
                    <h5>Information</h5>
                    <ul>
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms & Conditions</a></li>
                    </ul>
                </div>
                <div class="col-md social-icons">
                    <h5>Follow Us</h5>
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
                <div class="col-md help">
                    <h5>Help</h5>
                    <ul>
                        <li><a href="#">Payments</a></li>
                        <li><a href="#">Cancellation and Returns</a></li>
                        <li><a href="#">Shipping</a></li>
                        <li><a href="#">FAQ</a></li>
                    </ul>
                </div>
                <div class="col-md contact-link">
                    <h5>Contact Information</h5>
                    <ul>
                        <li><a href="#">Email: support@flipkart.com</a></li>
                        <li><a href="#">Phone: 1234-567-890</a></li>
                    </ul>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-12 text-center">
                    <p>&copy; 2025 Flipkart. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </div>

    <script src="./js/index.js" type="module"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>