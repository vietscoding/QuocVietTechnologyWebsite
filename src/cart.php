<?php
session_start();
include 'includes/db.php';

$user_id = $_SESSION['user_id'] ?? null;
$cart_items = array();

// Kiểm tra giỏ hàng trong database
if ($user_id) {
    // Get the cart ID for the user
    $sql_cart = "SELECT id FROM carts WHERE user_id = $user_id";
    $cart_result = $conn->query($sql_cart);
    if ($cart_result && $cart_result->num_rows > 0) {
        $cart = $cart_result->fetch_assoc();
        $cart_id = $cart['id'];
        // Get items from cart_items
        $sql_items = "SELECT ci.product_id, ci.quantity, p.name, p.price, p.brand, pi.url as main_image 
                      FROM cart_items ci 
                      JOIN products p ON ci.product_id = p.id 
                      JOIN product_images pi ON p.id = pi.product_id AND pi.is_primary = 1 
                      WHERE ci.cart_id = $cart_id";
        $items_result = $conn->query($sql_items);
        if ($items_result && $items_result->num_rows > 0) {
            while ($row = $items_result->fetch_assoc()) {
                $cart_items[] = $row;
            }
        }
    }
} else {
    // Redirect to login if not logged in
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <?php include 'includes/header.php'; ?>

    <div class="container mt-4">
        <h2>Shopping Cart</h2>
        <?php if (empty($cart_items)): ?>
            <p>Your cart is empty.</p>
        <?php else: ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cart_items as $item): ?>
                        <tr>
                            <td><img src="<?= htmlspecialchars($item['main_image']) ?>" style="width:50px;height:50px;object-fit:contain;"></td>
                            <td><?= htmlspecialchars($item['name']) ?> (<?= htmlspecialchars($item['brand']) ?>)</td>
                            <td>$<?= number_format($item['price'], 2) ?></td>
                            <td><?= htmlspecialchars($item['quantity']) ?></td>
                            <td>$<?= number_format($item['price'] * $item['quantity'], 2) ?></td>
                            <td><a href="remove_from_cart.php?cart_id=<?= $cart_id ?>&product_id=<?= $item['product_id'] ?>" class="btn btn-danger btn-sm">Remove</a></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="4"><strong>Total</strong></td>
                        <td><strong>$<?= number_format(array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart_items)), 2) ?></strong></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <a href="checkout.php" class="btn btn-success">Proceed to Checkout</a>
        <?php endif; ?>
    </div>

    <?php include 'includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>