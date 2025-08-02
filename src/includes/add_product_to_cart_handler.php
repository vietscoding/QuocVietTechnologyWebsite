<?php
session_start();
include './db.php';

// Handle Add to Cart
$user_id = $_SESSION['user_id'] ?? null;
$show_notification = false;
if (isset($_POST['add_to_cart']) && isset($_POST['product_id'])) {
    if (!$user_id) {
        header("Location: ../login.php");
        exit();
    }
    $product_id = (int)$_POST['product_id'];
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
    $found = false;
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
    // If user is logged in, migrate to database
    if ($user_id) {
        // Get or create cart for user
        $sql_cart = "SELECT id FROM carts WHERE user_id = $user_id";
        $cart_result = $conn->query($sql_cart);
        $cart_id = null;
        if ($cart_result && $cart_result->num_rows > 0) {
            $cart = $cart_result->fetch_assoc();
            $cart_id = $cart['id'];
        } else {
            $sql_insert_cart = "INSERT INTO carts (user_id, created_at, updated_at) VALUES ($user_id, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
            $conn->query($sql_insert_cart);
            $cart_id = $conn->insert_id;
        }
        // Update or insert cart items
        foreach ($_SESSION['cart'] as $item) {
            $sql_check = "SELECT * FROM cart_items WHERE cart_id = $cart_id AND product_id = " . $item['id'];
            $result_check = $conn->query($sql_check);
            if ($result_check && $result_check->num_rows > 0) {
                $cart_item = $result_check->fetch_assoc();
                $new_quantity = $cart_item['quantity'] + $item['quantity'];
                $sql_update = "UPDATE cart_items SET quantity = $new_quantity WHERE cart_id = $cart_id AND product_id = " . $item['id'];
                $conn->query($sql_update);
            } else {
                $sql_insert = "INSERT INTO cart_items (cart_id, product_id, quantity) VALUES ($cart_id, " . $item['id'] . ", " . $item['quantity'] . ")";
                $conn->query($sql_insert);
            }
        }
        $_SESSION['cart'] = array(); // Clear session cart after migration
        $show_notification = true; // Set flag to show notification
        $_SESSION['cart_notification'] = true;
    }
    header("Location: ../home.php?id=" . $product_id . "&added=1");

    // if (isset($_SESSION['return_to'])) {
    //     // Tách để xử lý nối query string cho đúng
    //     $separator = (parse_url($_SESSION['return_to'], PHP_URL_QUERY)) ? '&' : '?';
    //     header("Location: " . $_SESSION['return_to'] . $separator . "id=" . $product_id . "&added=1");
    //     exit;
    // }
    // header("Location: " . strtok($_SERVER["REQUEST_URI"], '?') . "?added=1");
    exit();
}
