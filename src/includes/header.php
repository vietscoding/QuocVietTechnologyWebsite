<!-- header.php -->
 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/css/style.css">


    <!-- <link rel="stylesheet" href="../assets/css/admin_style.css"> -->
  <style>

  </style>
</head>
<body>
  
<header>
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
    
    
    <nav class="navbar navbar-expand-sm bg-light justify-content-end">
      <!-- <div class="container-fluid">
        <img src="../src/assets/images/new_quocvietlogo.png" 
              class="img-fluid"
              alt="Home - Quoc Viet Technology"
              title="Home - Quoc Viet Technology"
              id="logo"
              data-dark-src="../src/assets/images/new_quocvietlogo.png"
              data-light-src="../src/assets/images/new_quocvietlogo.png"
              usemap="#home"/>
        <map name="home">
          <area shape="default" coords="" href="home.php">
        </map> -->
        <a href="home.php" class="navbar-brand">
          <img class="img-fluid" src="assets/images/new_quocvietlogo.png" alt="Logo" style="width: 100px; height: auto;">
        </a>
        <form class="header-search" action="search.php" method="get" style="display: inline">
          <input type="text" name="q" placeholder="Search..." aria-label="Search">
          <button type="submit"><i class="fas fa-search"></i></button>
        </form>
      <!-- </div> -->
        
      <div class="container-fluid justify-content-end">
        <ul class="nav ">
          <li class="nav-item"><a class="nav-link <?= ($current_page == 'home') ? 'active' : '' ?>" href="home.php">Home</a></li>
          <li class="nav-item"><a class="nav-link <?= ($current_page == 'contact') ? 'active' : '' ?>" href="contact.php">Contact Us</a></li>
          <li class="nav-item"><a class="nav-link <?= ($current_page == 'cart') ? 'active' : '' ?>" href="cart.php">My Cart</a></li>
          <li class="nav-item"><a class="nav-link <?= ($current_page == 'profile') ? 'active' : '' ?>" href="profile.php">Profile</a></li>
          <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
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
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script> -->

</body>
</html>

