<?php
session_start();
if (isset($_SESSION['user_id'])) {
  header("Location: /");
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/login.css" />
  </head>

  <body>
    <div class="mainSign">
      <div class="container">
        <form id="sign-up-form" class="sign-up-form">
          <div class="links">
            <a href="login"><i class="fa-solid fa-user"></i> sign in</a>
            <a href="signup" class="activeSignup"
              ><i class="fa-solid fa-user-plus"></i> sign up</a
            >
          </div>
          
          <div>
            <input
              type="file"
              id="profilepic"
              name="profilepic"
              style="display: none"
            />
          </div>

          <div class="input-field">
            <i class="fa-solid fa-globe"></i>
            <input
              type="text"
              placeholder="Username"
              id="uname"
              name="uname" />
              <br />
            </div>
            <span class="error" id="span-username"></span>

          <div class="input-field">
            <i class="fa-solid fa-envelope"></i>
            <input
              type="text"
              placeholder="Email"
              id="email"
              name="email"
              autocomplete="email" />
            <br />
          </div>
          <span class="error" id="span-email"></span>

          <div class="input-field">
            <i class="fa-solid fa-lock"></i>
            <input
              type="password"
              placeholder="Password"
              id="pass"
              name="pass"
              autocomplete="new-password" />
            <br />
          </div>
          <span class="error" id="span-password"></span>

          <div class="input-field">
            <i class="fa-solid fa-lock"></i>
            <input
              type="password"
              placeholder="Confirm Password"
              id="cpass"
              name="cpass"
              autocomplete="new-password" />
          </div>
          <span class="error" id="span-cpassword"></span>

          <div class="input-field">
            <i class="fa-solid fa-phone"></i>
            <input
              type="text"
              placeholder="Mobile Number"
              id="num"
              name="num"
              pattern="[6-9]{1}[0-9]{9}"
              title="Enter 10 digits" />
          </div>
          <span class="error" id="span-phone"></span>

          <div class="input-field" style="height: 40px">
            <input type="checkbox" name="rememberme" id="rememberme" />
            <label for="rememberme">
              Accept <span class="tnc"> terms and conditions</span>
              </label>
          </div>
          <span class="error" id="span-tnc"></span>

          <div
            class="input-field"
            style="width: 100%; background-color: #f1f1f1"
          >
            <button type="submit" class="submit" value="Sign up">
              Sign Up
            </button>
          </div>

          <div class="hveacc">
            <p>Already have an account? <a href="login.php">Sign In</a></p>
          </div>
        </form>
      </div>
    </div>

    <script src="../js/login.js"></script>
  </body>
</html>
