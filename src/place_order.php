<?php
session_start();
include './includes/db.php';

$user_id = $_SESSION['user_id'] ?? null;

if (!$user_id) {
    header("Location: login.php");
    exit();
}

// Lấy cart_id của user
$sql = "SELECT id FROM carts WHERE user_id = $user_id";
$result = $conn->query($sql);
if (!$result || $result->num_rows === 0) {
    die("Cart not found");
}
$cart_id = $result->fetch_assoc()['id'];

// Lấy tất cả sản phẩm trong giỏ
$sql_items = "SELECT ci.product_id, ci.quantity, p.price 
              FROM cart_items ci 
              JOIN products p ON ci.product_id = p.id 
              WHERE ci.cart_id = $cart_id";

$items_result = $conn->query($sql_items);
if (!$items_result || $items_result->num_rows === 0) {
    die("Cart is empty");
}

// Bắt đầu tính tổng tiền
$total = 0;
$items = [];
while ($row = $items_result->fetch_assoc()) {
    $items[] = $row;
    $total += $row['price'] * $row['quantity'];
}


// Tạo đơn hàng
$now = date('Y-m-d H:i:s');
$sql_order = "INSERT INTO orders (user_id, total_amount, created_at) 
              VALUES ($user_id, $total, '$now')";
$conn->query($sql_order);

$order_id = $conn->insert_id; // Lấy ID đơn hàng mới tạo

// Thêm từng item vào order_items
foreach ($items as $item) {
    $pid = $item['product_id'];
    $qty = $item['quantity'];
    $price = $item['price'];
    $sql_item = "INSERT INTO order_items (order_id, product_id, quantity, unit_price, original_price)
                 VALUES ($order_id, $pid, $qty, $price, $price)";
    $conn->query($sql_item);
}

// (Tùy): Xoá cart_items sau khi đặt hàng
$conn->query("DELETE FROM cart_items WHERE cart_id = $cart_id");

// (Tùy): Hiển thị thông báo
echo "<script>alert('🛒 Order successful!'); window.location.href='home.php';</script>";

$conn->close();
