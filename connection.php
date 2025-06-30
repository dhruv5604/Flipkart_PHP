<?php
require 'vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$server = $_ENV['DB_SERVER'];
$username = $_ENV['DB_USERNAME'];
$dbpassword = $_ENV['DB_PASSWORD'];
$database = $_ENV['DB_DATABASE'];

$con = mysqli_connect($server, $username, $dbpassword, $database);