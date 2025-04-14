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
$tnc = isset($_POST['rememberme']) && $_POST['rememberme'] === "on" ? 1 : 0;

$secure_pass = password_hash($pass, PASSWORD_DEFAULT);

$pass_regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/';
$username_regex = '/^[A-Za-z]{1}[A-Za-z0-9]+$/';
$num_regex = '/^[6-9]{1}[0-9]{9}$/';
$email_regex = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';

$errors = [];

if (!preg_match($username_regex, $name)) {
    $errors['span-username'] = 'Username contains only letters and numbers and must start with letter';
}

if (!preg_match($email_regex, $email)) {
    $errors['span-email'] = 'Enter valid email address';
}

if (!preg_match($pass_regex, $pass)) {
    $errors['span-password'] = 'Password should contain minimum 8 letters, 1 Uppercase, 1 lowercase, 1 special character and 1 digit';
}

if (empty($cnfpass)) {
    $errors['span-cpassword'] = 'Enter Confirm Password';
}

if ($pass !== $cnfpass) {
    $errors['span-password'] = 'Password and confirm password didn\'t match';
}

if (!preg_match($num_regex, $num)) {
    $errors['span-phone'] = 'Number should contain 10 digits and start with 6-9';
}

if ($tnc == 0) {
    $errors['span-tnc'] = 'Please accept terms and conditions';
}

if (!$con) {
    $errors['span-tnc'] = 'Database connection failed';
}

if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    $_SESSION['form_data'] = $_POST;
    header("Location: signup");
    exit;
}

$query = "SELECT email FROM User WHERE email = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $errors['span-email'] = 'Email already exists';
}

if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    $_SESSION['form_data'] = $_POST;
    header("Location: signup");
    exit;
}

$stmt->close();

$query1 = "INSERT INTO User(name, password, contactNumber, email,term_condition) VALUES (?, ?, ?, ?, ?)";
$stmt1 = $con->prepare($query1);

if ($stmt1) {
    $stmt1->bind_param("ssssi", $name, $secure_pass, $num, $email, $tnc);
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
header("Location: ../");
exit();
