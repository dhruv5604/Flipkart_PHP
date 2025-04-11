<?php
require_once('connection.php');
require_once('check_post.php');
session_start();

header("Content-Type: application/json");

$email_regex = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';

$email = htmlspecialchars($_POST['email']);
$pass = htmlspecialchars($_POST['pass']);
$errors = [];

if (is_null($email)) {
    $errors['span-email'] = 'Enter E-mail Address';
}

if (!preg_match($email_regex, $email)) {
    $errors['span-email'] = 'Enter valid email address';
}

if (is_null($pass)) {
    $errors['span-password'] = 'Enter password';
}

if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    $_SESSION['form_data'] = $_POST;
    header("Location: login");
    exit;
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
        $errors['span-password'] = 'Password is incorrect!';
    }
} else {
    $errors['span-email'] = 'No User Found!';
}

if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    $_SESSION['form_data'] = $_POST;
    header("Location: login");
    exit;
}

$stmt->close();
$con->close();
header("Location: /");
exit();
