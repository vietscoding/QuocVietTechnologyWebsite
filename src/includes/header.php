<!-- header.php -->
 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="assets/css/style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<header>
    <div class="header-main">
      <img src="../src/assets/images/Quoc Viet dark theme.png" 
           alt="Home - Quoc Viet Technology"
           title="Home - Quoc Viet Technology"
           id="logo"
           data-dark-src="../src/assets/images/Quoc Viet dark theme.png"
           data-light-src="../src/assets/images/QuocVietLogoLightTheme.png"
           usemap="#home"/>
      <map name="home">
        <area shape="default" coords="" href="index.php">
      </map>
      <form class="header-search" action="search.php" method="get">
        <input type="text" name="q" placeholder="Search..." aria-label="Search">
        <button type="submit"><i class="fas fa-search"></i></button>
      </form>
      <nav>
        <ul class="header-nav">
          <li><a href="index.php">Home</a></li>
          <li><a href="contact.php">Contact Us</a></li>
          <li><a href="cart.php">My Cart</a></li>
          <li><a href="profile.php">Profile</a></li>
          <li><a href="login.php">Login</a></li>
        </ul>
      </nav>
      <div class="theme-switch-wrapper" title="Toggle Theme">
          <label class="theme-switch" for="theme-toggle">
              <input type="checkbox" id="theme-toggle">
              <span class="slider">
                  <i class="fas fa-sun"></i>
                  <i class="fas fa-moon"></i>
              </span>
          </label>
      </div>
    </div>
</header>
<script src="assets/js/theme.js"></script>
</body>
</html>

