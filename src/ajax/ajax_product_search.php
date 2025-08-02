<?php
// filepath: src/ajax_product_search.php
include '../includes/db.php';
session_start(); // Đảm bảo session được khởi động
$data = json_decode(file_get_contents('php://input'), true);
$filters = $data['filters'] ?? [];
$sort = $data['sort'] ?? 'price_asc';

// Xây dựng câu truy vấn dựa trên $filters
$where = [];

// [Giữ nguyên các điều kiện $where như trước đó]

// Brand filters
if (in_array('brand-acer', $filters)) $where[] = "brand LIKE '%Acer%'";
if (in_array('brand-asus', $filters)) $where[] = "brand LIKE '%ASUS%'";
if (in_array('brand-dell', $filters)) $where[] = "brand LIKE '%Dell%'";
if (in_array('brand-hp', $filters)) $where[] = "brand LIKE '%HP%'";
if (in_array('brand-lenovo', $filters)) $where[] = "brand LIKE '%Lenovo%'";
if (in_array('brand-msi', $filters)) $where[] = "brand LIKE '%MSI%'";
if (in_array('brand-gigabyte', $filters)) $where[] = "brand LIKE '%Gigabyte%'";

// Usage filters
if (in_array('need-gaming', $filters)) $where[] = "usage_need LIKE '%Gaming%'";
if (in_array('need-study', $filters)) $where[] = "usage_need LIKE '%Study - Office%'";
if (in_array('need-high-end', $filters)) $where[] = "usage_need LIKE '%High-end - Luxury%'";
if (in_array('need-graphics', $filters)) $where[] = "usage_need LIKE '%Graphics - Engineering%'";
if (in_array('need-thin-light', $filters)) $where[] = "usage_need LIKE '%Thin and Light - Fashion%'";

// CPU filters
if (in_array('amdryzen5', $filters)) $where[] = "processor LIKE '%AMD Ryzen 5%'";
if (in_array('amdryzen7', $filters)) $where[] = "processor LIKE '%AMD Ryzen 7%'";
if (in_array('amdryzen9', $filters)) $where[] = "processor LIKE '%AMD Ryzen 9%'";
if (in_array('amdryzenai9', $filters)) $where[] = "processor LIKE '%AMD Ryzen AI 9%'";
if (in_array('intelcorei3', $filters)) $where[] = "processor LIKE '%Intel Core i3%'";
if (in_array('intelcorei5', $filters)) $where[] = "processor LIKE '%Intel Core i5%'";
if (in_array('intelcorei7', $filters)) $where[] = "processor LIKE '%Intel Core i7%'";
if (in_array('intelcorei9', $filters)) $where[] = "processor LIKE '%Intel Core i9%'";
if (in_array('intelcoreultra', $filters)) $where[] = "processor LIKE '%Intel Core Ultra%'";

// GPU filters
if (in_array('mx570a', $filters)) $where[] = "graphics LIKE '%570%'";
if (in_array('rtx2050', $filters)) $where[] = "graphics LIKE '%2050%'";
if (in_array('rtx3050', $filters)) $where[] = "graphics LIKE '%3050%'";
if (in_array('rtx3060', $filters)) $where[] = "graphics LIKE '%3060%'";
if (in_array('rtx4050', $filters)) $where[] = "graphics LIKE '%4050%'";
if (in_array('rtx4060', $filters)) $where[] = "graphics LIKE '%4060%'";
if (in_array('rtx4070', $filters)) $where[] = "graphics LIKE '%4070%'";
if (in_array('rtx4080', $filters)) $where[] = "graphics LIKE '%4080%'";
if (in_array('rtx5050', $filters)) $where[] = "graphics LIKE '%5050%'";
if (in_array('rtx5060', $filters)) $where[] = "graphics LIKE '%5060%'";
if (in_array('rtx5070', $filters)) $where[] = "graphics LIKE '%5070%'";
if (in_array('rtx5070Ti', $filters)) $where[] = "graphics LIKE '%5070Ti%'";
if (in_array('rtx5080', $filters)) $where[] = "graphics LIKE '%5080%'";

// RAM filters
if (in_array('ram8gb', $filters)) $where[] = "memory LIKE '%8%'";
if (in_array('ram16gb', $filters)) $where[] = "memory LIKE '%16%'";
if (in_array('ram32gb', $filters)) $where[] = "memory LIKE '%32%'";
if (in_array('ram64gb', $filters)) $where[] = "memory LIKE '%64%'";
if (in_array('ssd256gb', $filters)) $where[] = "storage LIKE '%256%'";
if (in_array('ssd512gb', $filters)) $where[] = "storage LIKE '%512%'";
if (in_array('ssd1tb', $filters)) $where[] = "storage LIKE '%1 TB%'";
if (in_array('ssd2tb', $filters)) $where[] = "storage LIKE '%2 TB%'";

// Screen Size filters
if (in_array('screen13-5', $filters)) $where[] = "screen_size LIKE '%13.5%'";
if (in_array('screen14', $filters)) $where[] = "screen_size LIKE '%14%'";
if (in_array('screen14-5', $filters)) $where[] = "screen_size LIKE '%14.5%'";
if (in_array('screen15-6', $filters)) $where[] = "screen_size LIKE '%15.6%'";
if (in_array('screen16', $filters)) $where[] = "screen_size LIKE '%16%'";
if (in_array('screen17', $filters)) $where[] = "screen_size LIKE '%17%'";
if (in_array('screen17-3', $filters)) $where[] = "screen_size LIKE '%17.3%'";

$orderBy = '';
switch ($sort) {
    case 'price_asc':
        $orderBy = 'ORDER BY price ASC';
        break;
    case 'price_desc':
        $orderBy = 'ORDER BY price DESC';
        break;
    case 'data_desc':
        $orderBy = 'ORDER BY created_at DESC';
        break;
    case 'best_seller_desc':
        $orderBy = 'ORDER BY stock DESC';
        break;
    default:
        $orderBy = '';
}

$sql = "SELECT id, name, model, screen_size, processor, graphics, memory, storage, price FROM products";
if ($where) $sql .= " WHERE " . implode(' AND ', $where);
$sql .= " $orderBy ";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
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
        echo '  <form method="POST" action="../includes/add_product_to_cart_handler.php" class="add-to-cart-button">'; // Giữ action cố định
        echo '    <input type="hidden" name="product_id" value="' . $row['id'] . '">';
        echo '    <button type="submit" name="add_to_cart" class="add-to-cart">Add to Cart</button>';
        echo '  </form>';
        echo '</div>';
    }
} else {
    echo "<h3>No products found!</h3>";
}
$conn->close();
