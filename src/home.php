<?php
session_start();
?>

<!-- index.php -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home | Quoc Viet Technology</title>
  <link rel="stylesheet" href="../src/assets/css/style.css">
  <style>
    body {
      background-color: red;
    }

    .product-container {
      display: flex;
      flex-wrap: wrap;
      gap: 1.5rem;
      justify-content: center;
      align-items: stretch;
      background: #d4d4d4;
      padding: 2rem 1rem;
    }

    .product-card {
      flex: 1 1 220px;
      max-width: 260px;
      min-width: 220px;
      display: flex;
      flex-direction: column;
      background: #f6f6f6;
      border: 1px solid #ddd;
      border-radius: 8px;
      box-sizing: border-box;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);
      margin: 0;
      padding: 16px 12px;
      height: 100%;

    }

    .product-card:hover {
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      transform: scale(1.005);
      transition: all 0.2s ease;
    }

    .product-image {
      width: 100%;
      height: 150px;
      background: #fefefe;
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 12px;
    }

    .product-image img {
      max-width: 100%;
      max-height: 100%;
      object-fit: contain;
      border-radius: 8px;
    }

    .product-name {
      font-size: 1.1em;
      font-weight: bold;
      min-height: 2.5em;
      margin-bottom: 8px;
      display: -webkit-box;
      -webkit-line-clamp: 1;
      /* 👈 Số dòng muốn hiển thị */
      -webkit-box-orient: vertical;
      overflow: hidden;
    }

    .product-description {
      font-size: 0.95em;
      color: #666;
      min-height: 3.2em;
      margin-bottom: 8px;
      flex-grow: 1;
      display: -webkit-box;
      -webkit-line-clamp: 1;
      /* 👈 Số dòng muốn hiển thị */
      -webkit-box-orient: vertical;
      overflow: hidden;
    }

    .product-price {
      font-weight: bold;
      color: #333;
      font-size: 1.2em;
      margin-bottom: 8px;
    }

    .product-rating {
      color: #ff9800;
    }

    .product-image,
    .product-name,
    .product-description,
    .product-price,
    .product-rating,
    .add-to-cart-button {
      margin-bottom: 15px;
    }

    .add-to-cart {
      border-radius: 5px;
      background-color: #4caf50;
      color: white;
      padding: 10px 10px;
      border: 2px solid #4caf50;
      cursor: pointer;
      font-size: 1em;
      width: 100%;
      transition: background-color 0.3s, border-color 0.3s;
    }

    .add-to-cart-button {}

    .add-to-cart:hover {
      background-color: #45a049;
      border-color: #45a049;
      transition: background-color 0.3s ease, border-color 0.3s ease;
    }



    @media (max-width: 700px) {
      .product-card {
        flex: 1 1 100%;
        width: 200px;
        /* Đảm bảo sản phẩm không quá nhỏ */
      }

      .product-container {
        flex-direction: column;
        align-items: center;
        width: 100%;
      }
    }

    @media screen and (max-width: 880px) {
      .product-card {
        width: calc(100% - 2rem);
        /* Chiếm toàn bộ chiều rộng trừ khoảng cách */
      }

    }

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
      /* transition: background-color 0.3s, color 0.3s; */
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
      background-color: red;
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

    /* .featured-laptops {
      margin: 0 auto;
      max-width: 1200px;
      padding: 20px;
    } */


    #featured-laptops,
    #fantastic-deals,
    #high-end-laptops {
      margin-left: 10rem;
      margin-right: 10rem;
    }

    /* 
  .dropdown-submenu>a::after {
    content: "\25B6";
    triangle right
    float: right;
    margin-top: 5px;
  } */
  </style>
</head>

<body id="body">

  <?php
  $current_page = "home";
  include 'includes/header.php';
  ?>
  <main>
    <!-- Promotions Slider
    <div class="container-fluid mb-4">
      <div class="card p-4" style="background:#ededed;min-height:180px;position:relative;width:80%; justify-content: center; margin: auto;">
        <button class="btn btn-outline-dark position-absolute top-50 start-0 translate-middle-y" style="z-index:2;"><i class="bi bi-chevron-left"></i></button>
        <div class="text-center" style="font-size:2rem;">Promotions</div>
        <button class="btn btn-outline-dark position-absolute top-50 end-0 translate-middle-y" style="z-index:2;"><i class="bi bi-chevron-right"></i></button>
      </div>
    </div> -->

    <!-- Brands -->
    <div class="container mb-4">
      <h5>Brands available at Quoc Viet Laptops <a href="#" " style=" font-size:14px; justify-content: flex-start;"> See more ></a></h5>
      <div class="row g-3">
        <a href="product_searcher.php" class="brands col-8 col-md-2 text-center">
          <div class="col-8 col-md-2 text-center "><img src="../public/images/brand_logo/acer.png" style="width:30px;"></div>
        </a>
        <!-- <div class="col-8 col-md-2 text-center brands"><img src="../public/images/brand_logo/apple.png" style="width:30px;"></div> -->
        <a href="product_searcher.php" class="brands col-8 col-md-2 text-center">
          <div class="col-8 col-md-2 text-center"><img src="../public/images/brand_logo/asus.png" style="width:30px;"></div>
        </a>
        <a href="product_searcher.php" class="brands col-8 col-md-2 text-center">
          <div class="col-8 col-md-2 text-center"><img src="../public/images/brand_logo/dell.png" style="width:30px;"></div>
        </a>
        <a href="product_searcher.php" class="brands col-8 col-md-2 text-center">
          <div class="col-8 col-md-2 text-center"><img src="../public/images/brand_logo/gigabyte.png" style="width:30px;"></div>
        </a>
        <a href="product_searcher.php" class="brands col-8 col-md-2 text-center">
          <div class="col-8 col-md-2 text-center"><img src="../public/images/brand_logo/hp.png" style="width:30px;"></div>
        </a>
        <a href="product_searcher.php" class="brands col-8 col-md-2 text-center">
          <div class="col-8 col-md-2 text-center"><img src="../public/images/brand_logo/lenovo.png" style="width:30px;"></div>
        </a>
        <a href="product_searcher.php" class="brands col-8 col-md-2 text-center">
          <div class="col-8 col-md-2 text-center"><img src="../public/images/brand_logo/msi.png" style="width:30px;"></div>
        </a>
      </div>
    </div>
    <!-- Usage Needs Section -->
    <div class="container mb-4">
      <div style="background:#ededed;padding:10px 0;margin-bottom:1rem;">
        <h3 style="margin:0 1rem 1rem 1rem;">Usage Needs <span class="float-end" style="font-size:14px;">See more &gt;</span></h3>
      </div>
      <div class="usage-need-container" style="display:flex;gap:1.5rem;justify-content:center;align-items:stretch;">
        <!-- Premium / Luxury -->
        <div class="usage-need-card"
          style="
          flex:1 1 120px;
          max-width:140px;
          background:#fff;
          border:1px solid #e0e0e0;
          border-radius:8px;
          box-sizing:border-box;
          padding:16px 8px;
          text-align:center;
          ">
          <a href="#" class="usage-need-link">
            <div style="background:#a5ffe8;border-radius:8px;padding:8px 0 0 0;margin-bottom:8px;">
              <img src="assets/images/premium.webp" alt="Office" style="width:80px;height:60px;object-fit:contain;">
            </div>
            <div style="font-weight:500;">Premium</div>
          </a>
        </div>
        <!-- Student / Office -->
        <div class="usage-need-card" style="flex:1 1 120px;max-width:140px;background:#fff;border:1px solid #e0e0e0;border-radius:8px;box-sizing:border-box;padding:16px 8px;text-align:center;">
          <a href="#" class="usage-need-link">
            <div style="background:#ffc0ab;border-radius:8px;padding:8px 0 0 0;margin-bottom:8px;">
              <img src="assets/images/study-office.webp" alt="Student" style="width:80px;height:60px;object-fit:contain;">
            </div>
            <div style="font-weight:500;">Student</div>
          </a>
        </div>
        <!-- Gaming -->
        <div class="usage-need-card" style="flex:1 1 120px;max-width:140px;background:#fff;border:1px solid #e0e0e0;border-radius:8px;box-sizing:border-box;padding:16px 8px;text-align:center;">
          <a href="#" class="usage-need-link">
            <div style="background:#f7774d;border-radius:8px;padding:8px 0 0 0;margin-bottom:8px;">
              <img src="assets/images/gaming.webp" alt="Gaming" style="width:80px;height:60px;object-fit:contain;">
            </div>
            <div style="font-weight:500;">Gaming</div>
          </a>
        </div>
        <!-- Graphics -->
        <div class="usage-need-card" style="flex:1 1 120px;max-width:140px;background:#fff;border:1px solid #e0e0e0;border-radius:8px;box-sizing:border-box;padding:16px 8px;text-align:center;">
          <a href="#" class="usage-need-link">
            <div style="background:#f8ec45;border-radius:8px;padding:8px 0 0 0;margin-bottom:8px;">
              <img src="assets/images/graphics-engineering.webp" alt="Graphics" style="width:80px;height:60px;object-fit:contain;">
            </div>
            <div style="font-weight:500;">Graphics</div>
          </a>
        </div>
        <!-- Slim & Light -->
        <div class="usage-need-card" style="flex:1 1 120px;max-width:140px;background:#fff;border:1px solid #e0e0e0;border-radius:8px;box-sizing:border-box;padding:16px 8px;text-align:center;">
          <a href="#" class="usage-need-link">
            <div style="background:#f0c3cf;border-radius:8px;padding:8px 0 0 0;margin-bottom:8px;">
              <img src="assets/images/slim-fashionable.webp" alt="Slim & Fashionable" style="width:80px;height:60px;object-fit:contain;">
            </div>
            <div style="font-weight:500;">Slim</div>
          </a>
        </div>
      </div>
    </div>
    <!-- Featured Laptops -->
    <div id="featured-laptops">
      <div style="background:#ededed;padding:10px 0; ">
        <h3 style="margin:0 1rem 1rem 1rem;">Featured Laptops <span class="float-end" style="font-size:14px;">See more ></span></h3>
      </div>
      <div class="product-container">

        <?php
        include 'includes/db.php';
        // Kiểm tra kết nối
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        } else {
          // echo "Kết nối thành công";
        }
        # Get product details
        $sql = "SELECT id, name, model, screen_size, processor, graphics, memory, storage, price FROM products LIMIT 5";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            // Lấy ảnh chính của sản phẩm
            $getImage = "SELECT url FROM product_images WHERE product_id = " . $row['id'] . " AND is_primary = 1 LIMIT 1";
            $getImageResult = $conn->query($getImage);
            $imgUrl = "assets/images/placeholder-image.webp";
            if ($getImageResult && $getImageResult->num_rows > 0) {
              $imgRow = $getImageResult->fetch_assoc();
              $imgUrl = $imgRow['url'];
            }
            echo '<div class="product-card">';
            echo '  <a href="product_detail.php?id=' . $row['id'] . '" style="text-decoration:none;color:inherit;">';
            echo '  <div class="product-image">';
            echo '    <img src="' . $imgUrl . '" alt="Product Image">';
            echo '  </div>';
            echo '  <div class="product-rating">★★★★☆</div>';
            echo '  <div class="product-name">' . $row['name'] . '</div>';
            echo '  <div class="product-description">';
            echo '    <p class="card-text" style="flex-grow:1;min-height:70px;">' . $row['name'] . ' | ' . $row['model'] . ' | ' . $row['screen_size'] . ' | ' . $row['processor'] . ' | ' . $row['graphics'] . ' | ' . $row['memory'] . 'GB | ' . $row['storage'] . '</p>';
            echo '  </div>';

            echo '  <div class="product-specs">';
            echo '    <span><img src="assets/images/product_specs_icon/cpu.svg" alt="CPU Icon"> ' . $row['processor'] . '<br></span>';
            echo '    <span><img src="assets/images/product_specs_icon/gpu-card.svg" alt="GPU Icon"> ' . $row['graphics'] . '<br></span>';
            echo '    <span><img src="assets/images/product_specs_icon/memory.svg" alt="RAM Icon"> ' . $row['memory'] . 'GB<br></span>';
            echo '    <span><img src="assets/images/product_specs_icon/ssd-storage.svg" alt="Storage Icon"> ' . $row['storage'] . '<br></span>';
            echo '    <span><img src="assets/images/product_specs_icon/screen.svg" alt="Screen Icon"> ' . $row['screen_size'] . '<br><br></span>';
            echo '  </div>';

            echo '  <div class="product-price">$' . number_format($row['price'], 2) . '</div>';

            echo '  </a>';
            echo '  <div class="add-to-cart-button">';
            echo '    <button class="add-to-cart">Add to Cart</button>';
            echo '  </div>';
            echo '</div>';
          }
        } else {
          echo "<p>No products found</p>";
        }
        $conn->close();
        ?>
      </div>

    </div>

    <!-- Fantastic Deals -->
    <div id="fantastic-deals">
      <div>
        <h5>Fantastic Deals <span class="float-end" style="font-size:14px;">See more ></span></h5>
      </div>
      <div class="product-container">

        <?php
        include 'includes/db.php';
        // Kiểm tra kết nối
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        } else {
          // echo "Kết nối thành công";
        }
        # Get product details
        $sql = "SELECT id, name, model, screen_size, processor, graphics, memory, storage, price FROM products ORDER BY price ASC LIMIT 5";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            // Lấy ảnh chính của sản phẩm
            $getImage = "SELECT url FROM product_images WHERE product_id = " . $row['id'] . " AND is_primary = 1 LIMIT 1";
            $getImageResult = $conn->query($getImage);
            $imgUrl = "assets/images/placeholder-image.webp";
            if ($getImageResult && $getImageResult->num_rows > 0) {
              $imgRow = $getImageResult->fetch_assoc();
              $imgUrl = $imgRow['url'];
            }
            echo '<div class="product-card">';
            echo '  <a href="product_detail.php?id=' . $row['id'] . '" style="text-decoration:none;color:inherit;">';
            echo '  <div class="product-image">';
            echo '    <img src="' . $imgUrl . '" alt="Product Image">';
            echo '  </div>';
            echo '  <div class="product-rating">★★★★☆</div>';
            echo '  <div class="product-name">' . $row['name'] . '</div>';
            echo '  <div class="product-description">';
            echo '    <p class="card-text" style="flex-grow:1;min-height:70px;">' . $row['name'] . ' | ' . $row['model'] . ' | ' . $row['screen_size'] . ' | ' . $row['processor'] . ' | ' . $row['graphics'] . ' | ' . $row['memory'] . 'GB | ' . $row['storage'] . '</p>';
            echo '  </div>';

            echo '  <div class="product-specs">';
            echo '    <span><img src="assets/images/product_specs_icon/cpu.svg" alt="CPU Icon"> ' . $row['processor'] . '<br></span>';
            echo '    <span><img src="assets/images/product_specs_icon/gpu-card.svg" alt="GPU Icon"> ' . $row['graphics'] . '<br></span>';
            echo '    <span><img src="assets/images/product_specs_icon/memory.svg" alt="RAM Icon"> ' . $row['memory'] . 'GB<br></span>';
            echo '    <span><img src="assets/images/product_specs_icon/ssd-storage.svg" alt="Storage Icon"> ' . $row['storage'] . '<br></span>';
            echo '    <span><img src="assets/images/product_specs_icon/screen.svg" alt="Screen Icon"> ' . $row['screen_size'] . '<br><br></span>';
            echo '  </div>';

            echo '  <div class="product-price">$' . number_format($row['price'], 2) . '</div>';

            echo '  </a>';
            echo '  <div class="add-to-cart-button">';
            echo '    <button class="add-to-cart">Add to Cart</button>';
            echo '  </div>';
            echo '</div>';
          }
        } else {
          echo "<p>No products found</p>";
        }
        $conn->close();
        ?>
      </div>

    </div>

    <!-- High-end Laptops -->
    <div id="high-end-laptops">
      <div>
        <h5>High-end Laptops <span class="float-end" style="font-size:14px;">See more ></span></h5>
      </div>
      <div class="product-container">

        <?php
        include 'includes/db.php';
        // Kiểm tra kết nối
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        } else {
          // echo "Kết nối thành công";
        }
        # Get product details
        $sql = "SELECT id, name, model, screen_size, processor, graphics, memory, storage, price FROM products ORDER BY price DESC LIMIT 5";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            // Lấy ảnh chính của sản phẩm
            $getImage = "SELECT url FROM product_images WHERE product_id = " . $row['id'] . " AND is_primary = 1 LIMIT 1";
            $getImageResult = $conn->query($getImage);
            $imgUrl = "assets/images/placeholder-image.webp";
            if ($getImageResult && $getImageResult->num_rows > 0) {
              $imgRow = $getImageResult->fetch_assoc();
              $imgUrl = $imgRow['url'];
            }
            echo '<div class="product-card">';
            echo '  <a href="product_detail.php?id=' . $row['id'] . '" style="text-decoration:none;color:inherit;">';
            echo '  <div class="product-image">';
            echo '    <img src="' . $imgUrl . '" alt="Product Image">';
            echo '  </div>';
            echo '  <div class="product-rating">★★★★☆</div>';
            echo '  <div class="product-name">' . $row['name'] . '</div>';
            echo '  <div class="product-description">';
            echo '    <p class="card-text" style="flex-grow:1;min-height:70px;">' . $row['name'] . ' | ' . $row['model'] . ' | ' . $row['screen_size'] . ' | ' . $row['processor'] . ' | ' . $row['graphics'] . ' | ' . $row['memory'] . 'GB | ' . $row['storage'] . '</p>';
            echo '  </div>';

            echo '  <div class="product-specs">';
            echo '    <span><img src="assets/images/product_specs_icon/cpu.svg" alt="CPU Icon"> ' . $row['processor'] . '<br></span>';
            echo '    <span><img src="assets/images/product_specs_icon/gpu-card.svg" alt="GPU Icon"> ' . $row['graphics'] . '<br></span>';
            echo '    <span><img src="assets/images/product_specs_icon/memory.svg" alt="RAM Icon"> ' . $row['memory'] . 'GB<br></span>';
            echo '    <span><img src="assets/images/product_specs_icon/ssd-storage.svg" alt="Storage Icon"> ' . $row['storage'] . '<br></span>';
            echo '    <span><img src="assets/images/product_specs_icon/screen.svg" alt="Screen Icon"> ' . $row['screen_size'] . '<br><br></span>';
            echo '  </div>';

            echo '  <div class="product-price">$' . number_format($row['price'], 2) . '</div>';

            echo '  </a>';
            echo '  <div class="add-to-cart-button">';
            echo '    <button class="add-to-cart">Add to Cart</button>';
            echo '  </div>';
            echo '</div>';
          }
        } else {
          echo "<p>No products found</p>";
        }
        $conn->close();
        ?>
      </div>
    </div>

  </main>

  <?php include 'includes/footer.php'; ?>
  <script src="assets/js/script.js"></script>

</body>

</html>