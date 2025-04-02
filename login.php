<?php

require_once('connection.php');
require_once('check_post.php');

$name = $_POST['uname'];
$pass = $_POST['pass'];

$query = "SELECT * FROM User WHERE name = ? AND password = ?";
$stmt = $con->prepare($query);

if ($stmt) {
    $stmt->bind_param("ss", $name, $pass);
    $stmt->execute();

    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($result->num_rows > 0) {
        session_start();
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['uname'] = $name;
        $_SESSION['role'] = $row['role'];
        header("Location: /");
        exit();
    } else {
        echo "Invalid username or password.";
    }
    $stmt->close();
} else {
    echo "Error: " . $con->error;
}

$con->close();
