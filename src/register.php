<?php 
$page = basename($_SERVER['PHP_SELF']);
$bodyClass = '';
if ($page === 'login.php') $bodyClass = 'login-page';
if ($page === 'register.php') $bodyClass = 'register-page';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sign up - Quoc Viet Technology</title>
  <link rel="stylesheet" href="assets/css/style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="<?= $bodyClass ?>">
  <header>
    <div style="display: flex; align-items: flex-start; justify-content: flex-start; width: 100%;">
      <img src="../src/assets/images/Quoc Viet dark theme.png" 
           alt="Home - Quoc Viet Technology"
           title="Home - Quoc Viet Technology"
           id="logo"
           data-dark-src="../src/assets/images/Quoc Viet dark theme.png"
           data-light-src="../src/assets/images/QuocVietLogoLightTheme.png"
           usemap="#home"
           style="margin-left: 20px; margin-right: auto; display: block; float: left; width: 100px; max-width: 20vw;"/>
      <map name="home">
        <area shape="default" coords="" href="index.php">
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
  </header>
  <div class="login-box" id="register-box" style="margin-bottom: 200px">
    <h2>Sign Up</h2>
    <form action="includes/auth.php" method="POST" autocomplete="off">
      <div class="form-group">
        <label for="fullname">First and Last Name</label>
        <input type="text" id="fullname" name="fullname" required />
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required />
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required />
      </div>
      <div class="form-group">
        <label for="confirm_password">Confirm Password</label>
        <input type="password" id="confirm_password" name="confirm_password" required />
      </div>
      <button type="submit" class="login-button">Sign Up</button>
    </form>
    <div class="footer" style="margin-top: 20px;">
      Have an account? <a href="login.php">Login</a>
    </div>
  </div>
<?php include '../src/includes/footer.php'; ?>  
  <script src="assets/js/theme.js"></script>
</body>
</html>
