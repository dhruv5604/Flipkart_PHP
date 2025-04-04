<?php
require_once('connection.php');
require_once('check_post.php');
session_start();

header("Content-Type: application/json");

$email = htmlspecialchars($_POST['email']);
$pass = htmlspecialchars($_POST['pass']);

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
        echo json_encode(["success" => false, "message" => "Password is incorrect!"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "No User Found!"]);
}

$stmt->close();
$con->close();
exit();
