<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sign up - Quoc Viet Technology</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  <link rel="stylesheet" href="./assets/css/style.css" />
</head>

<body class="<?= $bodyClass ?>">
  <header>
    <!-- <div class="container-fluid" style="text-align: center;">
      <img src="../src/assets/images/new_quocvietlogo.png"
        alt="Home - Quoc Viet Technology"
        title="Home - Quoc Viet Technology"
        id="logo"
        usemap="#home"
        style="width: 100px; height: auto;" />
      <map name="home">
        <area shape="default" coords="" href="home.php">
      </map>
    </div> -->
    <div class="container-fluid" style="text-align: center;">
      <a href="home.php" class="navbar-brand">
        <img class="img-fluid" src="assets/images/new_quocvietlogo.png" alt="Logo" style="width: 100px; height: auto; align-items: center; justify-content: center;" />
      </a>
    </div>
  </header>
  <div class="container mt-5" id="register-form">
    <h2 style="text-align: center;">Sign Up</h2>
    <form action="./includes/auth.php" method="POST" autocomplete="off">
      <div class="form-floating mb-3 mt-3">
        <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Enter your full name" required />
        <label for="fullname" class="form-label">First and Last Name</label>
      </div>
      <div class="form-floating mb-3 mt-3">
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required />
        <label for="email" class="form-label">Email</label>
      </div>
      <div class="form-floating mb-3 mt-3">
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required />
        <label for="password" class="form-label">Password</label>
      </div>
      <div class="form-floating mb-3 mt-3">
        <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm your password" required />
        <label for="pwd" class="form-label">Confirm Password</label>
      </div>
      <button type="submit" class="btn btn-success" id="btnRegister">Sign Up</button>
    </form>
    <div class="footer" style="margin-top: 20px;">
      Have an account? <a href="login.php">Login</a>
    </div>
  </div>

  <?php include '../src/includes/footer.php'; ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
  <script src="assets/js/theme.js"></script>
</body>

</html>