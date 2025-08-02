<?php
// var_dump($_SESSION);
session_start();
include './includes/db.php';
$_SESSION['return_to'] = $_SERVER['REQUEST_URI'];

if (isset($_SESSION['cart_notification']) && ($_SESSION["cart_notification"] == true)) {
    echo '<script>alert("Successfully");</script>';
    $_SESSION["cart_notification"] = false; // reset lại
}

// Handle Add to Cart via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart']) && isset($_POST['product_id'])) {
    $user_id = $_SESSION['user_id'] ?? null;
    if (!$user_id) {
        header("Location: login.php");
        exit();
    }
    $product_id = (int)$_POST['product_id'];
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
    $found = false;

    $stmt = $conn->prepare("SELECT name, price FROM products WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result && $result->num_rows > 0) {
        $product = $result->fetch_assoc();
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['id'] == $product_id) {
                $item['quantity'] += 1;
                $found = true;
                break;
            }
        }
        if (!$found) {
            $_SESSION['cart'][] = array(
                'id' => $product_id,
                'name' => $product['name'],
                'price' => $product['price'],
                'quantity' => 1
            );
        }
        // Debug: Check session cart
        var_dump($_SESSION['cart']); // Remove or comment out after testing

        // Migrate to database if logged in
        if ($user_id) {
            $stmt_cart = $conn->prepare("SELECT id FROM carts WHERE user_id = ?");
            $stmt_cart->bind_param("i", $user_id);
            $stmt_cart->execute();
            $cart_result = $stmt_cart->get_result();
            $cart_id = null;
            if ($cart_result && $cart_result->num_rows > 0) {
                $cart = $cart_result->fetch_assoc();
                $cart_id = $cart['id'];
            } else {
                $stmt_insert_cart = $conn->prepare("INSERT INTO carts (user_id, created_at, updated_at) VALUES (?, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");
                $stmt_insert_cart->bind_param("i", $user_id);
                $stmt_insert_cart->execute();
                $cart_id = $conn->insert_id;
            }
            foreach ($_SESSION['cart'] as $item) {
                $stmt_check = $conn->prepare("SELECT * FROM cart_items WHERE cart_id = ? AND product_id = ?");
                $stmt_check->bind_param("ii", $cart_id, $item['id']);
                $stmt_check->execute();
                $result_check = $stmt_check->get_result();
                if ($result_check && $result_check->num_rows > 0) {
                    $cart_item = $result_check->fetch_assoc();
                    $new_quantity = $cart_item['quantity'] + $item['quantity'];
                    $stmt_update = $conn->prepare("UPDATE cart_items SET quantity = ? WHERE cart_id = ? AND product_id = ?");
                    $stmt_update->bind_param("iii", $new_quantity, $cart_id, $item['id']);
                    $stmt_update->execute();
                } else {
                    $stmt_insert = $conn->prepare("INSERT INTO cart_items (cart_id, product_id, quantity) VALUES (?, ?, ?)");
                    $stmt_insert->bind_param("iii", $cart_id, $item['id'], $item['quantity']);
                    $stmt_insert->execute();
                }
            }
            // Reload cart from database into session
            $_SESSION['cart'] = array(); // Clear first
            $stmt_load_cart = $conn->prepare("SELECT c.product_id, p.name, p.price, c.quantity FROM cart_items c JOIN products p ON c.product_id = p.id WHERE c.cart_id = ?");
            $stmt_load_cart->bind_param("i", $cart_id);
            $stmt_load_cart->execute();
            $cart_result = $stmt_load_cart->get_result();
            while ($item = $cart_result->fetch_assoc()) {
                $_SESSION['cart'][] = $item;
            }
            var_dump($_SESSION['cart']); // Debug: Check reloaded cart
        }
    }
    $stmt->close();
    if (isset($stmt_cart)) $stmt_cart->close();
    if (isset($stmt_insert_cart)) $stmt_insert_cart->close();
    if (isset($stmt_check)) $stmt_check->close();
    if (isset($stmt_update)) $stmt_update->close();
    if (isset($stmt_insert)) $stmt_insert->close();
    if (isset($stmt_load_cart)) $stmt_load_cart->close();
    echo json_encode(['success' => true, 'cart' => $_SESSION['cart']]); // Return cart data
    exit();
}

$current_page = "product_searcher";

// Lưu ID sản phẩm vừa xem vào session nếu có
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $_SESSION['last_viewed_product_id'] = (int)$_GET['id'];
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products | Quoc Viet Technology</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        body {
            background: #f7f8fa;
            font-family: 'Segoe UI', Arial, sans-serif;
        }

        /* Thay đổi layout để filter và product-container nằm cạnh nhau */
        .search-layout {
            display: flex;
            gap: 2rem;
            max-width: 1600px;
            margin: 0 auto;
            padding: 2rem 0;
            align-items: flex-start;
            /* Đảm bảo filter và sản phẩm thẳng hàng trên */
        }

        .filter-sidebar {
            width: 260px;
            min-width: 220px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            padding: 1.5rem 1rem;
            font-size: 1rem;
            flex-shrink: 0;
            /* Không co lại khi màn hình nhỏ */
        }

        .filter-group {
            margin-bottom: 2rem;
        }

        .filter-group-title {
            font-weight: bold;
            margin-bottom: 0.7rem;
        }

        .filter-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .filter-list li {
            margin-bottom: 0.5rem;
        }

        .filter-list input[type="checkbox"] {
            margin-right: 8px;
        }

        .filter-more {
            color: #45a049;
            font-size: 0.95em;
            cursor: pointer;
            margin-top: 0.5rem;
            display: inline-block;
        }

        .product-area {
            flex: 1;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            padding: 1.5rem;
            min-width: 0;
            display: flex;
            flex-direction: column;
        }

        .product-container {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            justify-content: flex-start;
            align-items: stretch;
            background: #d4d4d4;
            padding: 2rem 1rem;
            width: 100%;
            box-sizing: border-box;
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
            -webkit-box-orient: vertical;
        }

        .product-description {
            font-size: 0.95em;
            color: #666;
            min-height: 3.2em;
            margin-bottom: 8px;
            flex-grow: 1;
            display: -webkit-box;
            -webkit-line-clamp: 1;
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

        .product-toolbar {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }

        .product-toolbar button {
            background: #fff;
            border: 1.5px solid #45a049;
            color: #45a049;
            border-radius: 6px;
            padding: 0.5rem 1.2rem;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.2s, color 0.2s;
        }

        .product-toolbar button.active,
        .product-toolbar button:hover {
            background: #45a049;
            color: #fff;
        }

        .filter-group-title {
            font-weight: bold;
            cursor: pointer;
            user-select: none;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .dropdown-arrow {
            margin-left: 8px;
            font-size: 1em;
            transition: transform 0.2s;
        }

        .filter-group.open .dropdown-arrow {
            transform: rotate(180deg);
        }

        @media (max-width: 1200px) {
            .search-layout {
                flex-direction: column;
            }

            .filter-sidebar {
                width: 100%;
                margin-bottom: 2rem;
            }

            .product-area {
                width: 100%;
            }

            .product-list {
                justify-content: center;
            }
        }
    </style>
</head>

<body>
    <?php include 'includes/header.php'; ?>
    <!-- Notification Toast -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="addToCartToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="3000">
            <div class="toast-header">
                <strong class="me-auto">Success</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Product added to cart successfully!
            </div>
        </div>
    </div>

    <main>
        <div class="search-layout">
            <!-- Sidebar Filter -->
            <aside class="filter-sidebar">
                <!-- Thêm nút Clear Filter vào trên Laptop Standard -->
                <div class="filter-group">
                    <button id="clear-filter-btn" style="display:hidden;margin-bottom:1rem;padding:4px 12px;border:none;background:#eee;color:red;border-radius:6px;cursor:pointer;font-size:0.95em;">
                        <strong>Clear Filter</strong>
                    </button>
                    <!-- <div style="display:flex;align-items:center;justify-content:space-between;"> -->
                    <div class="filter-group-title dropdown-toggle" onclick="toggleDropdown(this)">
                        Laptop Standard
                        <span class="dropdown-arrow"></span>
                    </div>
                    <!-- </div> -->
                    <ul class="filter-list" style="display:none;">
                        <li><input type="checkbox" id="amd"><label for="amd">AMD</label></li>
                        <li><input type="checkbox" id="amd-ai"><label for="amd-ai">AMD AI</label></li>
                        <li><input type="checkbox" id="copilot"><label for="copilot">Copilot+ PC</label></li>
                        <li><input type="checkbox" id="intel-ai"><label for="intel-ai">Intel AI</label></li>
                    </ul>
                </div>
                <!-- Brand filter -->
                <div class="filter-group" style="margin-bottom: 1rem; border-bottom: 1px solid #ddd; padding-bottom: 1rem;">
                    <div class="filter-group-title dropdown-toggle" onclick="toggleDropdown(this)">
                        Brands
                        <span class="dropdown-arrow"></span>
                    </div>
                    <ul class="filter-list" style="display:none;">
                        <li><input type="checkbox" id="brand-acer"><label for="brand-acer">Acer</label></li>
                        <li><input type="checkbox" id="brand-asus"><label for="brand-asus">Asus</label></li>
                        <li><input type="checkbox" id="brand-dell"><label for="brand-dell">Dell</label></li>
                        <li><input type="checkbox" id="brand-lenovo"><label for="brand-lenovo">Lenovo</label></li>
                        <li><input type="checkbox" id="brand-msi"><label for="brand-msi">MSI</label></li>
                        <li><input type="checkbox" id="brand-hp"><label for="brand-hp">HP</label></li>
                        <li><input type="checkbox" id="brand-gigabyte"><label for="brand-gigabyte">Gigabyte</label></li>
                    </ul>
                </div>
                <!-- Usage need filter -->
                <div class="filter-group" style="margin-bottom: 1rem; border-bottom: 1px solid #ddd; padding-bottom: 1rem;">
                    <div class="filter-group-title dropdown-toggle" onclick="toggleDropdown(this)">
                        Usage Need
                        <span class="dropdown-arrow"></span>
                    </div>
                    <ul class="filter-list" style="display:none;">
                        <li><input type="checkbox" id="need-gaming"><label for="need-gaming">Gaming</label></li>
                        <li><input type="checkbox" id="need-study"><label for="need-study">Study - Office</label></li>
                        <li><input type="checkbox" id="need-high-end"><label for="need-high-end">High-end - Luxury</label></li>
                        <li><input type="checkbox" id="need-graphics"><label for="need-graphics">Graphics - Engineering</label></li>
                        <li><input type="checkbox" id="need-thin-light"><label for="need-thin-light">Thin and Light - Fashion</label></li>
                    </ul>
                </div>
                <!-- CPU filter -->
                <div class="filter-group" style="margin-bottom: 1rem; border-bottom: 1px solid #ddd; padding-bottom: 1rem;">
                    <div class="filter-group-title dropdown-toggle" onclick="toggleDropdown(this)">
                        CPU
                        <span class="dropdown-arrow"></span>
                    </div>
                    <ul class="filter-list" style="display:none;">
                        <li><input type="checkbox" id="amdryzen5"><label for="amdryzen5">AMD Ryzen 5</label></li>
                        <li><input type="checkbox" id="amdryzen7"><label for="amdryzen7">AMD Ryzen 7</label></li>
                        <li><input type="checkbox" id="amdryzen9"><label for="amdryzen9">AMD Ryzen 9</label></li>
                        <li><input type="checkbox" id="amdryzenai9"><label for="amdryzenai9">AMD Ryzen AI 9</label></li>
                        <li><input type="checkbox" id="intelcorei3"><label for="intelcorei3">Intel Core i3</label></li>
                        <li><input type="checkbox" id="intelcorei5"><label for="intelcorei5">Intel Core i5</label></li>
                        <li><input type="checkbox" id="intelcorei7"><label for="intelcorei7">Intel Core i7</label></li>
                        <li><input type="checkbox" id="intelcorei9"><label for="intelcorei9">Intel Core i9</label></li>
                        <li><input type="checkbox" id="intelcoreultra"><label for="intelcoreultra">Intel Core Ultra</label></li>
                    </ul>
                </div>
                <div class="filter-group" style="margin-bottom: 1rem; border-bottom: 1px solid #ddd; padding-bottom: 1rem;">
                    <div class="filter-group-title dropdown-toggle" onclick="toggleDropdown(this)">
                        GPU
                        <span class="dropdown-arrow"></span>
                    </div>
                    <ul class="filter-list" style="display:none;">
                        <li><input type="checkbox" id="mx570a"><label for="mx570a">GeForce MX570A</label></li>
                        <li><input type="checkbox" id="rtx2050"><label for="rtx2050">GeForce RTX™ 2050</label></li>
                        <li><input type="checkbox" id="rtx3050"><label for="rtx3050">GeForce RTX™ 3050</label></li>
                        <li><input type="checkbox" id="rtx3060"><label for="rtx3060">GeForce RTX™ 3060</label></li>
                        <li><input type="checkbox" id="rtx4050"><label for="rtx4050">GeForce RTX™ 4050</label></li>
                        <li><input type="checkbox" id="rtx4060"><label for="rtx4060">GeForce RTX™ 4060</label></li>
                        <li><input type="checkbox" id="rtx4070"><label for="rtx4070">GeForce RTX™ 4070</label></li>
                        <li><input type="checkbox" id="rtx4080"><label for="rtx4080">GeForce RTX™ 4080</label></li>
                        <li><input type="checkbox" id="rtx4090"><label for="rtx4090">GeForce RTX™ 4090</label></li>
                        <li><input type="checkbox" id="rtx5050"><label for="rtx5050">GeForce RTX™ 5050</label></li>
                        <li><input type="checkbox" id="rtx5060"><label for="rtx5060">GeForce RTX™ 5060</label></li>
                        <li><input type="checkbox" id="rtx5070ti"><label for="rtx5070ti">GeForce RTX™ 5070Ti</label></li>
                        <li><input type="checkbox" id="rtx5080"><label for="rtx5080">GeForce RTX™ 5080</label></li>
                    </ul>
                </div>
                <!-- RAM Filters -->
                <div class="filter-group" style="margin-bottom: 1rem; border-bottom: 1px solid #ddd; padding-bottom: 1rem;">
                    <div class="filter-group-title dropdown-toggle" onclick="toggleDropdown(this)">
                        RAM
                        <span class="dropdown-arrow"></span>
                    </div>
                    <ul class="filter-list" style="display:none;">
                        <li><input type="checkbox" id="ram8gb"><label for="ram8gb">8 GB</label></li>
                        <li><input type="checkbox" id="ram16gb"><label for="ram16gb">16 GB</label></li>
                        <li><input type="checkbox" id="ram32gb"><label for="ram32gb">32 GB</label></li>
                        <li><input type="checkbox" id="ram64gb"><label for="ram64gb">64 GB</label></li>
                    </ul>
                </div>
                <!-- SSD Filters -->
                <div class="filter-group" style="margin-bottom: 1rem; border-bottom: 1px solid #ddd; padding-bottom: 1rem;">
                    <div class="filter-group-title dropdown-toggle" onclick="toggleDropdown(this)">
                        SSD
                        <span class="dropdown-arrow"></span>
                    </div>
                    <ul class="filter-list" style="display:none;">
                        <li><input type="checkbox" id="ssd256gb"><label for="ssd256gb">256 GB</label></li>
                        <li><input type="checkbox" id="ssd512gb"><label for="ssd512gb">512 GB</label></li>
                        <li><input type="checkbox" id="ssd1tb"><label for="ssd1tb">1 TB</label></li>
                        <li><input type="checkbox" id="ssd2tb"><label for="ssd2tb">2 TB</label></li>
                    </ul>
                </div>
                <!-- Screen Size Filters -->
                <div class="filter-group" style="margin-bottom: 1rem; border-bottom: 1px solid #ddd; padding-bottom: 1rem;">
                    <div class="filter-group-title dropdown-toggle" onclick="toggleDropdown(this)">
                        Screen Size
                        <span class="dropdown-arrow"></span>
                    </div>
                    <ul class="filter-list" style="display:none;">
                        <li><input type="checkbox" id="screen13-5"><label for="screen13-5">13.5"</label></li>
                        <li><input type="checkbox" id="screen14"><label for="screen14">14"</label></li>
                        <li><input type="checkbox" id="screen14-5"><label for="screen14-5">14.5"</label></li>
                        <li><input type="checkbox" id="screen15-6"><label for="screen15-6">15.6"</label></li>
                        <li><input type="checkbox" id="screen16"><label for="screen16">16"</label></li>
                        <li><input type="checkbox" id="screen17"><label for="screen17">17"</label></li>
                        <li><input type="checkbox" id="screen17-3"><label for="screen17-3">17.3"</label></li>
                    </ul>
                </div>
            </aside>
            <!-- Product Area -->
            <section class="product-area">
                <div class="product-toolbar">
                    <button data-sort="price_desc">Decreasing</button>
                    <button data-sort="price_asc" class="active">Ascending</button>
                    <button data-sort="date_desc">Newest</button>
                    <button data-sort="bestseller_desc">Best Seller</button>
                </div>
                <div class="product-container">
                    <?php
                    include './includes/db.php';
                    // Kiểm tra kết nối
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }
                    $sql = "SELECT id, name, model, screen_size, processor, graphics, memory, storage, price FROM products LIMIT 10";
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
                            echo '  <div class="product-rating">★★★★★</div>';
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
                            echo '  <form method="POST" action="./includes/add_product_to_cart_handler.php" class="add-to-cart-button">';
                            echo '    <input type="hidden" name="product_id" value="' . $row['id'] . '">';
                            echo '    <button type="submit" name="add_to_cart" class="add-to-cart">Add to Cart</button>';
                            echo '  </form>';
                            echo '</div>';
                        }
                    } else {
                        echo "<p>No products found</p>";
                    }
                    $conn->close();
                    ?>
                </div>
            </section>
        </div>
    </main>
    <!-- Notification Toast -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="addToCartToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="3000">
            <div class="toast-header">
                <strong class="me-auto">Success</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Product added to cart successfully!
            </div>
        </div>
    </div>
    <?php include 'includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <script src="assets/js/script.js"></script>
    <script>
        function toggleDropdown(el) {
            const group = el.parentElement;
            const list = group.querySelector('.filter-list');
            group.classList.toggle('open');
            list.style.display = list.style.display === 'none' ? 'block' : 'none';
        }

        document.querySelectorAll('.filter-list input[type="checkbox"]').forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                reloadProducts();
            });
        });

        let currentSort = 'price_asc'; // mặc định

        document.querySelectorAll('.product-toolbar button').forEach(function(btn) {
            btn.addEventListener('click', function() {
                currentSort = btn.getAttribute('data-sort');
                reloadProducts();
                document.querySelectorAll('.product-toolbar button').forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
            });
        });

        // Update reloadProducts function
        function reloadProducts() {
            const filters = [];
            document.querySelectorAll('.filter-list input[type="checkbox"]:checked').forEach(function(cb) {
                filters.push(cb.id);
            });

            fetch('./ajax/ajax_product_search.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'

                    },
                    body: JSON.stringify({
                        filters: filters,
                        sort: currentSort
                    })
                })
                .then(res => res.text())
                .then(html => {
                    document.querySelector('.product-container').innerHTML = html;
                    document.querySelectorAll('.add-to-cart-button').forEach(form => {
                        form.addEventListener('submit', function(e) {
                            e.preventDefault();
                            const formData = new FormData(form);
                            fetch('./includes/add_product_to_cart_handler.php', { // Sử dụng URL cố định
                                    method: 'POST',
                                    body: formData
                                })
                                .then(response => response.json())
                                .then(data => {
                                    console.log('Response:', data); // Debug phản hồi
                                    if (data.success) {
                                        const toast = new bootstrap.Toast(document.getElementById('addToCartToast'));
                                        toast.show();
                                        reloadProducts();
                                        updateCartDisplay(data.cart);
                                    } else {
                                        console.error('Add to cart failed:', data);
                                    }
                                })
                                .catch(error => console.error('Error:', error));
                        });
                    });
                });
        }

        // Function to update cart display (example implementation)
        function updateCartDisplay(cart) {
            let cartSummary = document.getElementById('cart-summary');
            if (!cartSummary) {
                cartSummary = document.createElement('div');
                cartSummary.id = 'cart-summary';
                cartSummary.style.position = 'fixed';
                cartSummary.style.top = '10px';
                cartSummary.style.right = '10px';
                cartSummary.style.background = '#fff';
                cartSummary.style.padding = '10px';
                cartSummary.style.border = '1px solid #ddd';
                cartSummary.style.borderRadius = '5px';
                cartSummary.style.zIndex = '1000';
                document.body.appendChild(cartSummary);
            }
            if (cart && cart.length > 0) {
                cartSummary.innerHTML = `Cart: ${cart.length} items<br>` + cart.map(item => `${item.name} (x${item.quantity})`).join('<br>');
            } else {
                cartSummary.innerHTML = 'Cart is empty';
            }
        }

        // Xử lý hiển thị nút "Xóa bộ lọc"
        const clearFilterBtn = document.getElementById('clear-filter-btn');
        const filterCheckboxes = document.querySelectorAll('.filter-list input[type="checkbox"]');

        filterCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', () => {
                const anyChecked = Array.from(filterCheckboxes).some(cb => cb.checked);
                clearFilterBtn.style.display = anyChecked ? 'inline-block' : 'hidden';
            });
        });

        clearFilterBtn.addEventListener('click', () => {
            filterCheckboxes.forEach(cb => cb.checked = false);
            clearFilterBtn.style.display = 'hidden';
            reloadProducts();
        });
    </script>
    <div id="cart-summary"></div>
</body>

</html>