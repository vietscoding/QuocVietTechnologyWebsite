<!-- index.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home | Quoc Viet Technology</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/css/style.css">
   <style>
    /* body {
      background-color: red;
    } 
    main { 
      padding: 20px;
    }
    .header-search {
      display: inline-block;
      margin-right: 20px;
    }
    .header-search input[type="text"] {
      width: 200px;
      padding: 5px;
    }
    .header-search button {
      padding: 5px 10px;
    } */
  </style>
</head>
<body id="body">


<?php 
    $current_page = "home";
    include 'includes/header.php';  
?>
  <main id="main-content">
  <div id="demo" class="carousel slide" data-bs-ride="carousel">

    <!-- Indicators/dots -->
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
      <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
      <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
    </div>

    <!-- The slideshow/carousel -->
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="assets/images/promotions/promotion1.jpg" alt="Promotion 1" class="d-block w-100">
      </div>
      <div class="carousel-item">
        <img src="assets/images/promotions/promotion2.jpg" alt="Promotion 2" class="d-block w-100">
      </div>
      <div class="carousel-item">
        <img src="assets/images/promotions/promotion3.jpg" alt="Promotion 3" class="d-block w-100">
      </div>
    </div>

    <!-- Left and right controls/icons -->
    <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>
  </div>

  </main>

<?php include 'includes/footer.php'; ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
  <script src="assets/js/script.js"></script>

</body>
</html>