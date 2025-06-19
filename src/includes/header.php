<!-- header.php -->
 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

</head>
<body>
<header>
    <div class="header-main">
      <img src="../src/assets/images/new_quocvietlogo.png" 
           alt="Home - Quoc Viet Technology"
           title="Home - Quoc Viet Technology"
           id="logo"
           data-dark-src="../src/assets/images/new_quocvietlogo.png"
           data-light-src="../src/assets/images/new_quocvietlogo.png"
           usemap="#home"/>
      <map name="home">
        <area shape="default" coords="" href="home.php">
      </map>
      <form class="header-search" action="search.php" method="get" style="display: inline">
        <input type="text" name="q" placeholder="Search..." aria-label="Search">
        <button type="submit"><i class="fas fa-search"></i></button>
      </form>
      <!-- <nav>
        <ul class="header-nav">
          <li><a href="home.php" style="text-decoration: none;">Home</a></li>
          <li><a href="contact.php" style="text-decoration: none;">Contact Us</a></li>
          <li><a href="cart.php" style="text-decoration: none;">My Cart</a></li>
          <li><a href="profile.php" style="text-decoration: none;">Profile</a></li>
          <li><a href="login.php" style="text-decoration: none;">Login</a></li>
        </ul>
      </nav> -->
      <div>
        <nav class="header-nav">
          <ul class="nav-list">
            <li class="nav-item"><a  href="login.php"">Login</a></li>
            <li class="nav-item"><a class="<?= ($current_page == 'profile') ? 'active' : '' ?>" href="profile.php">Profile</a></li>
            <li class="nav-item"><a class="<?= ($current_page == 'cart') ? 'active' : '' ?>" href="cart.php">My Cart</a></li>
            <li class="nav-item"><a class="<?= ($current_page == 'contact') ? 'active' : '' ?>" href="contact.php">Contact Us</a></li>
            <li class="nav-item"><a class="<?= ($current_page == 'home') ? 'active' : '' ?>" href="home.php">Home</a></li>
          </ul>
        </nav>
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
    </div>
</header>
<script src="assets/js/theme.js"></script>
</body>
</html>

