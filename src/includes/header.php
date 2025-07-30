<style>
  :root {
    --bg-color: #ffffff;
    --text-color: #000000;
  }

  [data-theme="dark"] {
    --bg-color: #1a1a1a;
    --text-color: #f0f0f0;
  }

  body {
    background-color: var(--bg-color);
    color: var(--text-color);
    transition: background-color 0.3s, color 0.3s;
  }


  .nav-item {
    margin: 0 10px;
    /* background-color: var(--accent-color); */
    /* border-radius: 5px; */
    margin-bottom: 1em;
    margin-top: 1em;

  }

  .nav-item a.nav-link {
    color: #fff;
    text-decoration: none;
    padding: 10px 15px;
    display: block;
    font-weight: bold;
    color: #000000;

    /* background-color: red; */
    /* border-radius: 20px; */
    /* color: black; */
  }

  .nav-item:hover {
    background-color: var(--accent-hover-color);
    transition: background-color 0.3s ease;
    /* border-bottom: var(--accent-color) 5px solid; */
    /* transition: border-bottom 0.3s ease; */
  }

  #the-header {
    position: sticky;
    top: 0;
    z-index: 1000;
    background-color: var(--bg-color);
  }

  /* Tuỳ chỉnh dropdown đa cấp */
  .dropdown-submenu {
    position: relative;
  }

  .dropdown-submenu>.dropdown-menu {
    top: 0;
    left: 100%;
    margin-top: -1px;
    display: none;
  }

  .dropdown-submenu:hover>.dropdown-menu {
    display: block;
  }

  /* 
  .dropdown-submenu>a::after {
    content: "\25B6";
    triangle right
    float: right;
    margin-top: 5px;
  } */
</style>


<header class="header" id="the-header">
  <div>
    <nav class="navbar navbar-expand-sm bg-light justify-content-end">
      <a href="home.php" class="navbar-brand" style="margin-left: 1em">
        <img class="img-fluid" src="assets/images/new_quocvietlogo.png" alt="Logo" style="width: 100px; height: auto;">
      </a>
      <!-- Address -->

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
      <button id="theme-toggle">Toggle Theme</button>


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
          <?php if (isset($_SESSION['user_id'])): ?>

            <li class="nav-item">
              <a class="nav-link <?= ($current_page == 'profile') ? 'active' : '' ?>" href="profile.php">Profile</a>
            </li>
          <?php else: ?>
            <li class="nav-item">
              <a class="nav-link" href="login.php">Login</a>
            </li>
          <?php endif; ?>
        </ul>
      </div>


    </nav>
  </div>
  <!-- Secondary Navigation -->

  <div class="container-fluid">
    <ul class="nav">
      <li class="nav-item">
        <div class="dropdown">
          <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
            Menu
          </button>
          <ul class="dropdown-menu">

            <!-- Thương hiệu -->
            <li class="dropdown-submenu">
              <a class="dropdown-item dropdown-toggle" href="#">Brands</a>
              <ul class="dropdown-menu">
                <!-- Apple -->
                <!-- <li class="dropdown-submenu">
                  <a class="dropdown-item dropdown-toggle" href="#">
                    <img src="../public/images/brand_logo/apple.png" alt="Apple Logo"> Apple (Macbook)
                  </a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">MacBook Air M1</a></li>
                    <li><a class="dropdown-item" href="#">MacBook Air M2</a></li>
                    <li><a class="dropdown-item" href="#">MacBook Air M3 13"</a></li>
                    <li><a class="dropdown-item" href="#">MacBook Air M3 15"</a></li>
                    <li><a class="dropdown-item" href="#">MacBook Pro 13" M2</a></li>
                    <li><a class="dropdown-item" href="#">MacBook Pro 14"</a></li>
                    <li><a class="dropdown-item" href="#">MacBook Pro 16"</a></li>
                    <li><a class="dropdown-item" href="#">MacBook Air</a></li>
                    <li><a class="dropdown-item" href="#">MacBook Pro</a></li>
                  </ul>
                </li> -->

                <!-- Acer -->
                <li class="dropdown-submenu">
                  <a class="dropdown-item dropdown-toggle" href="#">
                    <img src="../public/images/brand_logo/acer.png" alt="Acer Logo"> Acer
                  </a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Acer Aspire – Popular, office, study</a></li>
                    <li><a class="dropdown-item" href="#">Acer Swift – Thin, light, long battery life, highly portable</a></li>
                    <li><a class="dropdown-item" href="#">Acer Nitro – Popular gaming</a></li>
                    <li><a class="dropdown-item" href="#">Acer Predator – High-end gaming, high performance</a></li>
                    <li><a class="dropdown-item" href="#">Acer TravelMate – For business, durable mobility</a></li>
                    <li><a class="dropdown-item" href="#">Acer Chromebook – Running ChromeOS, cheap</a></li>
                  </ul>
                </li>
                <!-- ASUS -->
                <li class="dropdown-submenu">
                  <a class="dropdown-item dropdown-toggle" href="#">
                    <img src="../public/images/brand_logo/asus.png" alt="ASUS Logo"> ASUS
                  </a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">ASUS VivoBook – Popular, student, office</a></li>
                    <li><a class="dropdown-item" href="#">ASUS ZenBook – Thin, light, high-end, good battery</a></li>
                    <li><a class="dropdown-item" href="#">ASUS TUF – Popular gaming, well-built</a></li>
                    <li><a class="dropdown-item" href="#">ASUS ROG (Republic of Gamers) – High-end gaming, flagship</a></li>
                    <li><a class="dropdown-item" href="#">ASUS ExpertBook – Business, productivity</a></li>
                    <li><a class="dropdown-item" href="#">ASUS Chromebook – Affordable, lightweight</a></li>
                  </ul>
                </li>
                <!-- Dell -->
                <li class="dropdown-submenu">
                  <a class="dropdown-item dropdown-toggle" href="#">
                    <img src="../public/images/brand_logo/dell.png" alt="Dell Logo"> Dell
                  </a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Dell Inspiron – Mainstream</a></li>
                    <li><a class="dropdown-item" href="#">Dell Vostro – Office and small business</a></li>
                    <li><a class="dropdown-item" href="#">Dell XPS – Premium, thin, elegant</a></li>
                    <li><a class="dropdown-item" href="#">Dell Latitude – Business, government, high security</a></li>
                    <li><a class="dropdown-item" href="#">Dell Precision – Workstation</a></li>
                    <li><a class="dropdown-item" href="#">Dell Alienware – High-end gaming</a></li>
                  </ul>
                </li>
                <li class="dropdown-submenu">
                  <a class="dropdown-item dropdown-toggle" href="#">
                    <img src="../public/images/brand_logo/lenovo.png" alt="Lenovo Logo"> Lenovo
                  </a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Lenovo IdeaPad – Mainstream, students</a></li>
                    <li><a class="dropdown-item" href="#">Lenovo Yoga – Thin, light, flexible</a></li>
                    <li><a class="dropdown-item" href="#">Lenovo Legion – High-end gaming, excellent performance</a></li>
                    <li><a class="dropdown-item" href="#">Lenovo LOQ – Mid-range gaming (successor to IdeaPad Gaming)</a></li>
                    <li><a class="dropdown-item" href="#">Lenovo ThinkBook – Small and medium business</a></li>
                    <li><a class="dropdown-item" href="#">Lenovo ThinkPad – Business line, renowned for durability and performance</a></li>
                  </ul>
                </li>
                <li class="dropdown-submenu">
                  <a class="dropdown-item dropdown-toggle" href="#">
                    <img src="../public/images/brand_logo/msi.png" alt="MSI Logo"> MSI
                  </a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">MSI Modern – Office, students</a></li>
                    <li><a class="dropdown-item" href="#">MSI Prestige – Thin, light, more premium than Modern</a></li>
                    <li><a class="dropdown-item" href="#">MSI Creator Z / Content Creation Series – For designers and creators</a></li>
                    <li><a class="dropdown-item" href="#">MSI GF Series – Budget gaming</a></li>
                    <li><a class="dropdown-item" href="#">MSI Katana / Sword / Cyborg – Mid-range gaming</a></li>
                    <li><a class="dropdown-item" href="#">MSI Vector / Raider / Titan – High-end gaming, Workstation</a></li>
                  </ul>
                </li>
                <li class="dropdown-submenu">
                  <a class="dropdown-item dropdown-toggle" href="#">
                    <img src="../public/images/brand_logo/hp.png" alt="HP Logo"> HP
                  </a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">HP 14 / HP 15 – Popular, cheap</a></li>
                    <li><a class="dropdown-item" href="#">HP Pavilion – Mid-range, popular in Vietnam</a></li>
                    <li><a class="dropdown-item" href="#">HP ENVY – High-end, thin and light, beautiful screen</a></li>
                    <li><a class="dropdown-item" href="#">HP Victus – Popular Gaming</a></li>
                    <li><a class="dropdown-item" href="#">HP Omen – High-end Gaming</a></li>
                    <li><a class="dropdown-item" href="#">HP ProBook – Small and medium businesses</a></li>
                    <li><a class="dropdown-item" href="#">HP EliteBook – High-end businesses</a></li>
                    <li><a class="dropdown-item" href="#">HP ZBook – Mobile Workstation</a></li>
                  </ul>
                </li>
                <li class="dropdown-submenu">
                  <a class="dropdown-item dropdown-toggle" href="#">
                    <img src="../public/images/brand_logo/gigabyte.png" alt="Gigabyte Logo"> Gigabyte
                  </a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Gigabyte G5 / G6 – Popular Gaming Laptop</a></li>
                    <li><a class="dropdown-item" href="#">Gigabyte AORUS – High-end Gaming</a></li>
                    <li><a class="dropdown-item" href="#">Gigabyte AERO – Laptop for content creators</a></li>
                    <li><a class="dropdown-item" href="#">Gigabyte U Series (rare) – Thin and light, office</a></li>
                  </ul>
                </li>
              </ul>
            </li>

            <!-- Nhu cầu -->
            <li class="dropdown-submenu">
              <a class="dropdown-item dropdown-toggle" href="#">Needs</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="product_searcher.php">High-end - Luxury</a></li>
                <li><a class="dropdown-item" href="product_searcher.php">Study - Office</a></li>
                <li><a class="dropdown-item" href="product_searcher.php">Graphics - Engineering</a></li>
                <li><a class="dropdown-item" href="product_searcher.php">Gaming</a></li>
                <li><a class="dropdown-item" href="product_searcher.php">Thin and Light - Fashion</a></li>
              </ul>
            </li>

            <!-- By price -->
            <li class="dropdown-submenu">
              <a class="dropdown-item dropdown-toggle" href="#">By price</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Under 10 million</a></li>
                <li><a class="dropdown-item" href="#">From 10 to 15 million</a></li>
                <li><a class="dropdown-item" href="#">From 15 to 20 million</a></li>
                <li><a class="dropdown-item" href="#">From 20 to 25 million</a></li>
                <li><a class="dropdown-item" href="#">From 30 to 35 million</a></li>
                <li><a class="dropdown-item" href="#">Over 40 million</a></li>
              </ul>
            </li>

          </ul>
        </div>
      </li>
      <li class="nav-item"><a class="nav-link" href="product_searcher.php">Best Sellers</a></li>
      <li class="nav-item"><a class="nav-link" href="product_searcher.php">Brands</a></li>
      <li class="nav-item"><a class="nav-link" href="product_searcher.php">Fantastic Deals</a></li>
      <li class="nav-item"><a class="nav-link" href="product_searcher.php">High-end Laptops</a></li>
    </ul>
  </div>
</header>