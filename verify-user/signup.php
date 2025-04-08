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
        <marquee class="marq"> Welcome to SignUp page!!!</marquee>
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
            <label for="profilepic" class="profile">
              <i class="fa-solid fa-user"></i>
              <span class="tooltip">Select profile pic</span>
            </label>
          </div>

          <div class="input-field">
            <i class="fa-solid fa-globe"></i>
            <input
              type="text"
              placeholder="Username"
              id="uname"
              name="uname"
              required
            /><br />
          </div>

          <div class="input-field">
            <i class="fa-solid fa-envelope"></i>
            <input
              type="email"
              placeholder="Email"
              id="email"
              name="email"
              autocomplete="email"
              required
            /><br />
          </div>

          <div class="input-field">
            <i class="fa-solid fa-lock"></i>
            <input
              type="password"
              placeholder="Password"
              id="pass"
              name="pass"
              autocomplete="new-password"
              required
            /><br />
          </div>

          <div class="input-field">
            <i class="fa-solid fa-lock"></i>
            <input
              type="password"
              placeholder="Confirm Password"
              id="cpass"
              name="cpass"
              autocomplete="new-password"
              required
            />
          </div>

          <div class="input-field">
            <i class="fa-solid fa-phone"></i>
            <input
              type="text"
              placeholder="Mobile Number"
              id="num"
              name="num"
              pattern="[6-9]{1}[0-9]{9}"
              title="Enter 10 digits"
              required
            />
          </div>

          <div class="input-field" style="height: 40px">
            <input type="checkbox" name="rememberme" id="rememberme" required/>
            <label for="rememberme"
              >Accept <span class="tnc"> terms and conditions</span></label
            >
          </div>

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
