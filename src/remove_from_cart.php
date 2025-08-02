<?php
session_start();
include 'includes/db.php';

$user_id = $_SESSION['user_id'] ?? null;

if (!$user_id) {
    header("Location: login.php");
    exit();
}

// Get cart_id and product_id from URL
if (isset($_GET['cart_id']) && isset($_GET['product_id']) && is_numeric($_GET['cart_id']) && is_numeric($_GET['product_id'])) {
    $cart_id = (int)$_GET['cart_id'];
    $product_id = (int)$_GET['product_id'];

    // Verify the cart belongs to the user
    $sql_cart = "SELECT id FROM carts WHERE user_id = $user_id AND id = $cart_id";
    $cart_result = $conn->query($sql_cart);
    if ($cart_result && $cart_result->num_rows > 0) {
        // Delete the item from cart_items
        $sql_delete = "DELETE FROM cart_items WHERE cart_id = $cart_id AND product_id = $product_id";
        if ($conn->query($sql_delete) === TRUE) {
            // Redirect back to cart page
            header("Location: cart.php");
            exit();
        } else {
            die("Error removing item from cart.");
        }
    } else {
        die("Invalid cart or unauthorized access.");
    }
} else {
    die("Invalid parameters.");
}

$conn->close();
