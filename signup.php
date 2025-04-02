<?php

require_once('connection.php');

require_once('check_post.php');

$name = $_POST['uname'];
$pass = $_POST['pass'];
$num = $_POST['num'];
$dob = $_POST['dob'];

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$query = "INSERT INTO User(name, password, contactNumber, dob) VALUES (?, ?, ?, ?)";
$stmt = $con->prepare($query);

if ($stmt) {
    $stmt->bind_param("ssss", $name, $pass, $num, $dob);
    $stmt->execute();
    $stmt->close();
    $_SESSION['uname'] = $name;
    header("Location: index.php");
    exit();
} else {
    echo "Error: " . $con->error;
}

$con->close();
