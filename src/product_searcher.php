<?php
session_start();
?>
<!-- product_searcher.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products | Quoc Viet Technology</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="../src/assets/css/style.css">
    <style>
        body {
            background: #f7f8fa;
            font-family: 'Segoe UI', Arial, sans-serif;
        }

        .search-layout {
            display: flex;
            gap: 2rem;
            max-width: 1600px;
            margin: 0 auto;
            padding: 2rem 0;
        }

        .filter-sidebar {
            width: 260px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            padding: 1.5rem 1rem;
            font-size: 1rem;
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
            color: #1565c0;
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
        }

        .product-toolbar {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }

        .product-toolbar button {
            background: #fff;
            border: 1.5px solid #1565c0;
            color: #1565c0;
            border-radius: 6px;
            padding: 0.5rem 1.2rem;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.2s, color 0.2s;
        }

        .product-toolbar button.active,
        .product-toolbar button:hover {
            background: #1565c0;
            color: #fff;
        }

        .product-list {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
        }

        .product-card {
            background: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            width: 260px;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 1.2rem 1rem 1.5rem 1rem;
            margin-bottom: 2rem;
            position: relative;
        }

        .product-card .discount-badge {
            position: absolute;
            top: 1rem;
            left: 1rem;
            background: #8e24aa;
            color: #fff;
            font-size: 0.95em;
            font-weight: bold;
            padding: 0.3em 0.8em;
            border-radius: 6px;
        }

        .product-card img {
            width: 180px;
            height: 120px;
            object-fit: contain;
            margin-bottom: 1rem;
        }

        .product-card .brand {
            font-size: 0.95em;
            color: #888;
            font-weight: 500;
            margin-bottom: 0.3rem;
            text-align: left;
            width: 100%;
        }

        .product-card .product-title {
            font-weight: bold;
            font-size: 1em;
            margin-bottom: 0.5rem;
            text-align: left;
            width: 100%;
            min-height: 2.2em;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .product-card .combo-badge {
            background: #fff;
            border: 1px solid #1565c0;
            color: #1565c0;
            font-size: 0.9em;
            font-weight: 500;
            border-radius: 6px;
            padding: 0.2em 0.7em;
            margin-bottom: 0.5rem;
            margin-top: 0.5rem;
            display: inline-block;
        }

        .product-card .price {
            font-weight: bold;
            color: #1565c0;
            font-size: 1.25em;
            margin-bottom: 0.3rem;
            text-align: left;
            width: 100%;
        }

        .product-card .old-price {
            color: #888;
            text-decoration: line-through;
            font-size: 0.95em;
            margin-right: 0.5em;
        }

        .product-card .discount-percent {
            color: #d32f2f;
            font-size: 0.95em;
            font-weight: 500;
        }

        .product-card .specs {
            background: #f7f8fa;
            border-radius: 8px;
            padding: 0.7em 0.7em;
            font-size: 0.95em;
            color: #333;
            margin-bottom: 0.7em;
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            gap: 0.7em;
        }

        .product-card .specs span {
            display: flex;
            align-items: center;
            gap: 0.3em;
            background: #fff;
            border-radius: 5px;
            padding: 0.2em 0.5em;
            border: 1px solid #e0e0e0;
            font-size: 0.95em;
        }

        .product-card .add-to-cart-btn {
            background: #fff;
            border: 2px solid #1565c0;
            color: #1565c0;
            border-radius: 8px;
            padding: 0.6em 0;
            width: 100%;
            font-weight: 500;
            font-size: 1em;
            cursor: pointer;
            transition: background 0.2s, color 0.2s;
            margin-top: auto;
        }

        .product-card .add-to-cart-btn:hover {
            background: #1565c0;
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
    <main>
        <div class="search-layout">
            <!-- Sidebar Filter -->
            <aside class="filter-sidebar">
                <div class="filter-group">
                    <div class="filter-group-title">Laptop Standard</div>
                    <ul class="filter-list">
                        <li><input type="checkbox" id="amd"><label for="amd">AMD</label></li>
                        <li><input type="checkbox" id="amd-ai"><label for="amd-ai">AMD AI</label></li>
                        <li><input type="checkbox" id="copilot"><label for="copilot">Copilot+ PC</label></li>
                        <li><input type="checkbox" id="intel-ai"><label for="intel-ai">Intel AI</label></li>
                    </ul>
                    <span class="filter-more">See more</span>
                </div>
                <div class="filter-group">
                    <div class="filter-group-title dropdown-toggle" onclick="toggleDropdown(this)">
                        Discrete Graphics
                        <span class="dropdown-arrow">&#9662;</span>
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
            </aside>
            <!-- Product Area -->
            <section class="product-area">
                <div class="product-toolbar">
                    <button class="active">Best Promotion</button>
                    <button>Lowest Price</button>
                    <button>Highest Price</button>
                    <button>Newest</button>
                    <button>Best Seller</button>
                </div>
                <div class="product-list">
                    <?php
                    // Example: Replace with your DB query
                    include 'includes/db.php';
                    $sql = "SELECT * FROM products LIMIT 5";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        $imgUrl = "assets/images/placeholder-image.webp";
                        $getImage = "SELECT url FROM product_images WHERE product_id = " . $row['id'] . " AND is_primary = 1 LIMIT 1";
                        $getImageResult = $conn->query($getImage);
                        if ($getImageResult && $getImageResult->num_rows > 0) {
                            $imgRow = $getImageResult->fetch_assoc();
                            $imgUrl = $imgRow['url'];
                        }
                        echo '<div class="product-card">';
                        echo '<div class="discount-badge">SAVE 2,700,000₫</div>';
                        echo '<img src="' . $imgUrl . '" alt="Product">';
                        echo '<div class="brand">' . htmlspecialchars($row['brand'] ?? 'ASUS') . '</div>';
                        echo '<div class="product-title">' . htmlspecialchars($row['name']) . '</div>';
                        echo '<div class="combo-badge">COMBO DISCOUNT ~ 300,000₫</div>';
                        echo '<div class="price">' . number_format($row['price'], 0, ',', '.') . '₫</div>';
                        echo '<span class="old-price">' . number_format($row['old_price'] ?? ($row['price'] + 3000000), 0, ',', '.') . '₫</span>';
                        echo '<span class="discount-percent">-8%</span>';
                        echo '<div class="specs">';
                        echo '<span>i5-14450HX</span>';
                        echo '<span>RTX 4050</span>';
                        echo '<span>16GB</span>';
                        echo '<span>512GB</span>';
                        echo '<span>16" WUXGA/IPS/165Hz</span>';
                        echo '</div>';
                        echo '<button class="add-to-cart-btn">Add to Cart</button>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </section>
        </div>
    </main>



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
    </script>

</body>

</html>