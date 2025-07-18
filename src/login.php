<!DOCTYPE html>
<html lang="en">
<!-- data-bs-theme="dark" -->

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - Quoc Viet Technology</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  <link rel="stylesheet" href="./assets/css/style.css">

</head>

<body>
  <header>
    <div class="container-fluid" style="text-align: center;">
      <img src="../src/assets/images/new_quocvietlogo.png"
        alt="Home - Quoc Viet Technology"
        title="Home - Quoc Viet Technology"
        id="logo"
        usemap="#home"
        style="width: 100px; height: auto;" />
      <map name="home">
        <area shape="default" coords="" href="home.php">
      </map>
    </div>

  </header>

  <!-- <div class="login-box">
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
  </div> -->

  <div class="container mt-5" id="login-form">
    <h2 style="text-align: center;">Login</h2>
    <form action="./includes/auth.php" method="POST">
      <div class="form-floating mb-3 mt-3">
        <input type="text" class="form-control" name="email" id="email" placeholder="Email" required />
        <label for="email">Email</label>
      </div>

      <div class="form-floating mb-3 mt-3">
        <input type="password" class="form-control" name="password" id="password" placeholder="Password" required />
        <label for="password">Password</label>
      </div>
      <span>Don't have an account? <a href="register.php" class="text-primary">Sign up</a></span>
      <button type="submit" class="btn btn-success" id="btnLogin">Log In</button>
    </form>

  </div>

  <!-- <script src="../js/login.js"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
  <script src="./assets/js/theme.js"></script>
</body>

</html>