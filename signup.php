<?php
ini_set("display_errors", 1);
header("Content-Type: application/json"); 

require_once('connection.php');
require_once('check_post.php');

$name = htmlspecialchars($_POST['uname']);
$pass = htmlspecialchars($_POST['pass']);
$cnfpass  = htmlspecialchars($_POST['cpass']);
$num = htmlspecialchars($_POST['num']);
$email = htmlspecialchars($_POST['email']);
$secure_pass = password_hash($pass, PASSWORD_DEFAULT);

$pass_regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/';
$username_regex = '/^[A-Za-z]{1}[A-Za-z0-9]+$/';
$num_regex = '/^[6-9]{1}[0-9]{9}/';
$email_regex = '/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/';

if(!preg_match($username_regex,$name)){
    echo json_encode(["success" => false, "message" => "Username contains only letters and numbers and must start with letter"]);
    exit();
}

if(!preg_match($email_regex,$email)){
    echo json_encode(["success" => false, "message" => "Enter valid email address"]);
    exit();
}

if(!preg_match($pass_regex,$pass)){
    echo json_encode(["success" => false, "message" => "Password should contain minimum 8 letters, 1 Uppercase, 1 lowercase, 1 special character and 1 digit"]);
    exit();
}

if(!preg_match($num_regex,$num)){
    echo json_encode(["success" => false, "message" => "Number should contain 10 digits and start with 6-9"]);
    exit();
}

if (!$con) {
    echo json_encode(["success" => false, "message" => "Database connection failed"]);
    exit();
}

if ($pass !== $cnfpass) {
    echo json_encode(["success" => false, "message" => "Password and confirm password didn't match"]);
    exit();
}

$query = "SELECT email FROM User WHERE email = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo json_encode(["success" => false, "message" => "Email already exists"]);
    exit();
}

$stmt->close();

$query1 = "INSERT INTO User(name, password, contactNumber, email) VALUES (?, ?, ?, ?)";
$stmt1 = $con->prepare($query1);

if ($stmt1) {
    $stmt1->bind_param("ssss", $name, $secure_pass, $num, $email);
    if ($stmt1->execute()) {
        echo json_encode(["success" => true, "message" => "User registered successfully"]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to register user"]);
    }
    $stmt1->close();
} else {
    echo json_encode(["success" => false, "message" => "Database error: " . $con->error]);
}

$con->close();
exit();
