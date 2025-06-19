<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login - Quoc Viet Technology</title>
  <link rel="stylesheet" href="assets/css/style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloud/flare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
  <header>
    <div>
      <img src="../src/assets/images/new_quocvietlogo.png" 
           alt="Home - Quoc Viet Technology"
           title="Home - Quoc Viet Technology"
           id="logo"
           data-dark-src="../src/assets/images/new_quocvietlogo.png"
           data-light-src="../src/assets/images/new_quocvietlogo.png"
           usemap="#home"
           style="margin-left: 20px; margin-right: auto; display: block; float: left; width: 100px; max-width: 20vw;"/>
      <map name="home">
        <area shape="default" coords="" href="home.php">
      </map>
    </div>  
    
    <div class="theme-switch-wrapper" title="Toggle Theme">
    <label class="theme-switch" for="theme-toggle">
        <input type="checkbox" id="theme-toggle">
        <span class="slider">
            <i class="fas fa-sun"></i>
            <i class="fas fa-moon"></i>
        </span>
    </label>
</div>
    <!-- <button id="theme-toggle" class="theme-toggle">Toggle Theme</button> -->
  </header>

  <div class="login-box">
    <h2>Login</h2>
    <form action="includes/auth.php" method="POST">
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required />
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required />
      </div>
      <button type="submit" class="login-button">Log In</button>
    </form>
    <div class="footer" style="margin-top: 20px;">
      Don't have an account? <a href="register.php">Sign up</a>
    </div>
  </div>

  <!-- <script src="../js/login.js"></script> -->
   <script src="assets/js/theme.js"></script>
</body>
</html>