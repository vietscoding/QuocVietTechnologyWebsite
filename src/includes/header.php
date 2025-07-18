<header class="header">
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
      <a href="home.php" class="navbar-brand" style="margin-left: 1em">
        <img class="img-fluid" src="assets/images/new_quocvietlogo.png" alt="Logo" style="width: 100px; height: auto;">
      </a>
      <!-- <form class="header-search" action="search.php" method="get" style="display: inline">
          <input type="text" name="q" placeholder="Search..." aria-label="Search" style="display: inline-block; width: 200px; padding: 5px;">
          <button type="submit"><i class="fas fa-search"></i></button>
          <button type="submit " class="btn btn-outline-secondary" style="display: inline-block;">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
            </svg>
          </button>
        </form> -->

      <!-- Address -->
      <div>
        <span>Address: 123 Quoc Viet St, Hanoi, Vietnam</span>
      </div>
      <!-- Search bar -->
      <form class="header-search" action="search.php" method="get" style="display: flex; align-items: center; gap: 5px;">
        <input type="text" name="q" placeholder="Search..." aria-label="Search" style="width: 200px; padding: 5px; border: 1px solid #ccc; border-radius: 4px;">
        <button type="submit" class="btn btn-outline-secondary" style="padding: 5px 10px; border-radius: 4px;">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
          </svg>
        </button>
      </form>
      <!-- Language -->
      <div>
        <span>Language</span>
      </div>
      <!-- Light/Dark Mode toggle -->
      <div class="theme-switch-wrapper" title="Toggle Theme">
        <label class="theme-switch" for="theme-toggle">
          <input type="checkbox" id="theme-toggle">
          <span class="slider">
            <i class="fas fa-sun"></i>
            <i class="fas fa-moon"></i>
          </span>
        </label>
      </div>

      <!-- Navigation -->
      <div class="container-fluid justify-content-end">
        <ul class="nav ">
          <li class="nav-item">
            <a class="nav-link <?= ($current_page == 'home') ? 'active' : '' ?>" href="home.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= ($current_page == 'contact') ? 'active' : '' ?>" href="contact.php">Contact Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= ($current_page == 'cart') ? 'active' : '' ?>" href="cart.php">My Cart</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= ($current_page == 'profile') ? 'active' : '' ?>" href="profile.php">Profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="login.php">Login</a>
          </li>
        </ul>
      </div>

      <!-- Secondary Navigation -->

    </nav>
  </div>

  <!-- <div class="theme-switch-wrapper" title="Toggle Theme">
        <label class="theme-switch" for="theme-toggle">
            <input type="checkbox" id="theme-toggle">
            <span class="slider">
              
                <i class="fas fa-sun"></i>
                <i class="fas fa-moon"></i>
            </span>
        </label>
    </div> -->
  </div>
</header>