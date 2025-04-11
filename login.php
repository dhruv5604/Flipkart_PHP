<?php
session_start();
if (isset($_SESSION['user_id'])) {
  header("Location: /");
}

$errors = $_SESSION['errors'] ?? '';
$form_data =  $_SESSION['form_data'] ?? '';

unset($_SESSION['errors']);
unset($_SESSION['form_data']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <link rel="stylesheet" href="../css/login.css" />
</head>

<body>
  <div class="main">
    <div class="container">
      <form id="sign-in-form" class="sign-in-form" action="../login-process.php" method="post">
        <div class="links">
          <a href="login" class="activeSignIn">
            <i class="fa-solid fa-user"></i> sign in
          </a>
          <a href="signup"><i class="fa-solid fa-user-plus"></i> sign up</a>
        </div>

        <div class="input-field">
          <i class="fa-solid fa-envelope"></i>
          <input type="text" placeholder="Email" id="email" name="email" value="<?= $form_data['email'] ?>" />
        </div>
        <span class="error" id="span-email">
          <?= $errors['span-email'] ?>
        </span>

        <div class="input-field">
          <i class="fa-solid fa-lock"></i>
          <input
            type="password"
            placeholder="Password"
            id="pass"
            name="pass"
            value="<?= $form_data['pass'] ?? '' ?>" />
        </div>
        <span class="error" id="span-password">
          <?= $errors['span-password'] ?? '' ?>
        </span>

        <p class="forget"><a href="#">forget password?</a></p>

        <div class="remember">
          <input type="checkbox" name="rememberme" id="rememberme" />
          <label for="rememberme">Remember Me</label>
        </div>

        <div>
          <button type="submit" class="submit" value="Sign In">
            <i class="fas fa-sign-in"></i> Sign In
          </button>
        </div>

        <div class="hveacc">
          <p>Don't have an account? <a href="signup">Sign Up</a></p>
        </div>
      </form>
    </div>
  </div>
  <script src="/js/login.js"></script>
</body>

</html>