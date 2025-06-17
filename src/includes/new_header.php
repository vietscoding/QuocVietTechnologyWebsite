<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="assets/css/new_style.css" /> -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->

</head>
<body>
    <header>
<!-- <div class="header-main">
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
      </form> -->
        <div class="header-main">
            <img src="../src/assets/images/new_quocvietlogo.png"
                 alt="Home - Quoc Viet Technology"
                 title="Home - Quoc Viet Technology"
                 id="logo"
                 data-dark-src="../src/assets/images/new_quocvietlogo.png"
                 data-light-src="../src/assets/images/new_quocvietlogo.png"
                 usemap="#home">
            <map>
                <area shape="default" href="new_home.php">
            </map>
            <form class="header-search" action="search.php" method="get">
                <input type="text" name="q" placeholder="Search..." aria-label="Search">
                <button type="submit"><i class="fas fa-search"></i></button>
            </form>
        </div>
        <img >
        <nav class="header-nav">
            <ul class="nav-list">
                <li class="nav-item"><a  href="login.php"">Login</a></li>
                <li class="nav-item"><a class="<?= ($current_page == 'profile') ? 'active' : '' ?>" href="profile.php">Profile</a></li>
                <li class="nav-item"><a class="<?= ($current_page == 'cart') ? 'active' : '' ?>" href="cart.php">My Cart</a></li>
                <li class="nav-item"><a class="<?= ($current_page == 'contact') ? 'active' : '' ?>" href="contact.php">Contact Us</a></li>
                <li class="nav-item"><a class="<?= ($current_page == 'home') ? 'active' : '' ?>" href="new_home.php">Home</a></li>
            </ul>
    </header>
</body>
</html>