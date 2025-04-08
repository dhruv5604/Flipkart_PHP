<?php
require_once('connection.php');
require_once('check_post.php');
session_start();

header("Content-Type: application/json");

$email_regex = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';

$email = htmlspecialchars($_POST['email']);
$pass = htmlspecialchars($_POST['pass']);

if(is_null($email)) {
    echo json_encode(["success" => false, "error_block" => "span-email", "message" => "Enter E-mail Address"]);
    exit();
}

if (!preg_match($email_regex, $email)) {
    echo json_encode(["success" => false, "error_block" => "span-email", "message" => "Enter valid email address"]);
    exit();
}

if (is_null($pass)) {
    echo json_encode(["success" => false, "error_block" => "span-password", "message" => "Enter password"]);
    exit();
}

$query = "SELECT id, name, password, email,role FROM User WHERE email = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $fetched_name = $row['name'];
    $fetched_pass = $row['password'];
    $fetched_email = $row['email'];

    if (password_verify($pass, $fetched_pass)) {
        $_SESSION['user_id'] = $row["id"];
        $_SESSION['uname'] = $row["name"];
        $_SESSION['role'] = $row["role"];
        $_SESSION['email'] = $row["email"];

        echo json_encode(["success" => true, "message" => "Login successful!"]);
    } else {
        echo json_encode(["success" => false, "error_block" => "span-password", "message" => "Password is incorrect!"]);
    }
} else {
    echo json_encode(["success" => false, "error_block" => "span-email", "message" => "No User Found!"]);
}

$stmt->close();
$con->close();
exit();
