<?php
// require('stripe-php-master/init.php');
require_once 'vendor/autoload.php';

// $publishKey = "pk_test_51R8c7MPWmXkqaxc5vcsnss7f5jpSNOEre8ckqjiiVt7U0MiOOCzWPlzHwKgMmg8vBiqL6khXqfXoAwBQtM5z4r6g00XluWR2Eu";
// $secretKey = "sk_test_51R8c7MPWmXkqaxc5GXc9veWdrwlSBQZiRBW9c4xYpdQGXfKMCq3aKX16GspSUlUnn6Z6Xs2jqRMPdk2R4dDQYUH800Rcs5F99w";
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$secretKey = $_ENV['STRIPE_SECRET_KEY'];
\Stripe\Stripe::setApiKey($secretKey);
