<?php
session_start();
include './includes/db.php';

if (isset($_SESSION['cart_notification']) && ($_SESSION["cart_notification"] == true)) {
    echo '<script>alert("Successfully");</script>';
    $_SESSION["cart_notification"] = false; // reset lại
}

$current_page = "product_detail";
$_SESSION['return_to'] = $_SERVER['REQUEST_URI'];

// Lấy sản phẩm từ database theo id, fallback to session if id is missing
$product = null;
$product_id = isset($_GET['id']) && is_numeric($_GET['id']) ? (int)$_GET['id'] : null;

if ($product_id) {
    $sql = "SELECT * FROM products WHERE id = $product_id";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        die("Product not found.");
    }
} elseif (isset($_SESSION['last_viewed_product_id'])) {
    $product_id = $_SESSION['last_viewed_product_id'];
    $sql = "SELECT * FROM products WHERE id = $product_id";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        die("Product not found.");
    }
} else {
    die("No product ID provided.");
}

// Lưu ID sản phẩm vừa xem vào session
if ($product_id) {
    $_SESSION['last_viewed_product_id'] = $product_id;
}

// Lấy hình ảnh chính từ product_images
$main_image = '';
$image_sql = "SELECT url FROM product_images WHERE product_id = $product_id AND is_primary = 1";
$image_result = $conn->query($image_sql);
if ($image_result && $image_result->num_rows > 0) {
    $main_image = $image_result->fetch_assoc()['url'];
}

// Handle Add to Cart
// $user_id = $_SESSION['user_id'] ?? null;
// $show_notification = false;
// if (isset($_POST['add_to_cart']) && isset($_POST['product_id'])) {
//     if (!$user_id) {
//         header("Location: login.php");
//         exit();
//     }
//     $product_id = (int)$_POST['product_id'];
//     if (!isset($_SESSION['cart'])) {
//         $_SESSION['cart'] = array();
//     }
//     $found = false;
//     foreach ($_SESSION['cart'] as &$item) {
//         if ($item['id'] == $product_id) {
//             $item['quantity'] += 1;
//             $found = true;
//             break;
//         }
//     }
//     if (!$found) {
//         $_SESSION['cart'][] = array(
//             'id' => $product_id,
//             'name' => $product['name'],
//             'price' => $product['price'],
//             'quantity' => 1
//         );
//     }
//     // If user is logged in, migrate to database
//     if ($user_id) {
//         // Get or create cart for user
//         $sql_cart = "SELECT id FROM carts WHERE user_id = $user_id";
//         $cart_result = $conn->query($sql_cart);
//         $cart_id = null;
//         if ($cart_result && $cart_result->num_rows > 0) {
//             $cart = $cart_result->fetch_assoc();
//             $cart_id = $cart['id'];
//         } else {
//             $sql_insert_cart = "INSERT INTO carts (user_id, created_at, updated_at) VALUES ($user_id, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
//             $conn->query($sql_insert_cart);
//             $cart_id = $conn->insert_id;
//         }
//         // Update or insert cart items
//         foreach ($_SESSION['cart'] as $item) {
//             $sql_check = "SELECT * FROM cart_items WHERE cart_id = $cart_id AND product_id = " . $item['id'];
//             $result_check = $conn->query($sql_check);
//             if ($result_check && $result_check->num_rows > 0) {
//                 $cart_item = $result_check->fetch_assoc();
//                 $new_quantity = $cart_item['quantity'] + $item['quantity'];
//                 $sql_update = "UPDATE cart_items SET quantity = $new_quantity WHERE cart_id = $cart_id AND product_id = " . $item['id'];
//                 $conn->query($sql_update);
//             } else {
//                 $sql_insert = "INSERT INTO cart_items (cart_id, product_id, quantity) VALUES ($cart_id, " . $item['id'] . ", " . $item['quantity'] . ")";
//                 $conn->query($sql_insert);
//             }
//         }
//         $_SESSION['cart'] = array(); // Clear session cart after migration
//         $show_notification = true; // Set flag to show notification
//     }
//     header("Location: ./product_detail.php?id=" . $product_id . "&added=1");
//     exit();
// }

// Lấy hình ảnh phụ
$thumb_sql = "SELECT url FROM product_images WHERE product_id = $product_id AND is_primary = 0 LIMIT 4";
$thumb_result = $conn->query($thumb_sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($product['name']) ?> | Product Detail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <?php include 'includes/header.php'; ?>

    <div class="container mt-4">
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

        <!-- Product info -->
        <div class="card p-3 mb-3 bg-light">
            <div class="row g-4">
                <!-- Product Images -->
                <div class="col-md-4 text-center">
                    <img src="<?= htmlspecialchars($main_image) ?>" alt="Product" class="img-fluid rounded" style="height:220px;object-fit:cover;">
                    <div class="mt-3 d-flex justify-content-center gap-2">
                        <?php while ($thumb = $thumb_result->fetch_assoc()): ?>
                            <img src="<?= htmlspecialchars($thumb['url']) ?>" style="width:50px;height:50px;border-radius:5px;object-fit:cover;background:#eee;">
                        <?php endwhile; ?>
                    </div>
                </div>

                <!-- Product Content -->
                <div class="col-md-5">
                    <h4><?= htmlspecialchars($product['name']) ?></h4>
                    <p>Brand: <strong><?= htmlspecialchars($product['brand']) ?></strong></p>

                    <div class="mb-3">
                        <span class="text-muted text-decoration-line-through">$<?= number_format($product['price'] * 1.1, 2) ?></span>
                        <span class="fs-4 fw-bold text-danger">$<?= number_format($product['price'], 2) ?></span>
                    </div>

                    <div class="mb-2">Color:
                        <span class="btn btn-outline-dark btn-sm">Black</span>
                        <span class="btn btn-outline-dark btn-sm">White</span>
                    </div>

                    <form method="POST" action="./includes/add_product_to_cart_handler.php">
                        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                        <button type="submit" name="add_to_cart" class="btn btn-success mt-2">Add to Cart</button>
                    </form>
                </div>

                <!-- Tech Specs -->
                <div class="col-md-3">
                    <div class="card p-3 bg-white">
                        <h5 class="mb-3">Quick Specs</h5>
                        <ul class="list-unstyled small">
                            <li><strong>Processor:</strong> <?= htmlspecialchars($product['processor']) ?></li>
                            <li><strong>Graphics:</strong> <?= htmlspecialchars($product['graphics']) ?></li>
                            <li><strong>Memory:</strong> <?= htmlspecialchars($product['memory']) ?></li>
                            <li><strong>Storage:</strong> <?= htmlspecialchars($product['storage']) ?></li>
                            <li><strong>Screen Size:</strong> <?= htmlspecialchars($product['screen_size']) ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Description & Full Specs -->
        <div class="row mb-3">
            <div class="col-md-8">
                <div class="card p-3 bg-white">
                    <h5>Product Description</h5>
                    <p><?= nl2br(htmlspecialchars($product['description'])) ?></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-3 bg-white">
                    <h5>Full Specifications</h5>
                    <table class="table table-sm">
                        <tbody>
                            <tr>
                                <td>Processor</td>
                                <td><?= htmlspecialchars($product['processor']) ?></td>
                            </tr>
                            <tr>
                                <td>Graphics</td>
                                <td><?= htmlspecialchars($product['graphics']) ?></td>
                            </tr>
                            <tr>
                                <td>Memory</td>
                                <td><?= htmlspecialchars($product['memory']) ?></td>
                            </tr>
                            <tr>
                                <td>Storage</td>
                                <td><?= htmlspecialchars($product['storage']) ?></td>
                            </tr>
                            <tr>
                                <td>Screen Size</td>
                                <td><?= htmlspecialchars($product['screen_size']) ?></td>
                            </tr>
                            <tr>
                                <td>Resolution</td>
                                <td><?= htmlspecialchars($product['resolution']) ?></td>
                            </tr>
                            <tr>
                                <td>Usage Need</td>
                                <td><?= htmlspecialchars($product['usage_need']) ?></td>
                            </tr>
                            <tr>
                                <td>Stock</td>
                                <td><?= htmlspecialchars($product['stock']) ?></td>
                            </tr>
                            <tr>
                                <td>Created At</td>
                                <td><?= htmlspecialchars($product['created_at']) ?></td>
                            </tr>
                            <tr>
                                <td>Updated At</td>
                                <td><?= htmlspecialchars($product['updated_at']) ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        <div class="card p-3 bg-light">
            <h5>Related Products</h5>
            <div class="d-flex align-items-center">
                <button class="btn btn-outline-secondary me-2"><i class="bi bi-chevron-left"></i></button>
                <div class="d-flex flex-row gap-3 w-100 overflow-auto">
                    <?php
                    $related_sql = "SELECT * FROM products WHERE brand = '" . $conn->real_escape_string($product['brand']) . "' AND id != $product_id LIMIT 3";
                    $related_result = $conn->query($related_sql);
                    while ($rel = $related_result->fetch_assoc()):
                        $rel_main_image = '';
                        $rel_image_sql = "SELECT url FROM product_images WHERE product_id = " . $rel['id'] . " AND is_primary = 1";
                        $rel_image_result = $conn->query($rel_image_sql);
                        if ($rel_image_result && $rel_image_result->num_rows > 0) {
                            $rel_main_image = $rel_image_result->fetch_assoc()['url'];
                        }
                    ?>
                        <div class="card p-2" style="min-width:150px;">
                            <img src="<?= htmlspecialchars($rel_main_image) ?>" style="width:100%;height:100px;object-fit:cover;border-radius:8px;">
                            <div class="small"><?= htmlspecialchars($rel['name']) ?></div>
                            <div class="fw-bold">$<?= number_format($rel['price'], 2) ?></div>
                            <a href="product_detail.php?id=<?= $rel['id'] ?>" class="btn btn-success btn-sm w-100 mt-1">View</a>
                        </div>
                    <?php endwhile; ?>
                </div>
                <button class="btn btn-outline-secondary ms-2"><i class="bi bi-chevron-right"></i></button>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
    <script>
        // Show notification if product was just added
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('added') === '1') {
                const toast = new bootstrap.Toast(document.getElementById('addToCartToast'));
                toast.show();
                // Remove the 'added' parameter from the URL while preserving the id
                const newUrl = window.location.pathname + '?id=' + <?= $product_id ?>;
                window.history.replaceState({}, document.title, newUrl);
            }
        });
    </script>
</body>

</html>