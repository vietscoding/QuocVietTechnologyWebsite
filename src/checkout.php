<?php
session_start();
include './includes/db.php';

$user_id = $_SESSION['user_id'] ?? null;


// tải name, email, phone number (input required)
// đơn hàng, hình ảnh, tên, (số lượng, giá -> tính tổng tiền thanh toán)

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
    if (empty($cart_items)) {
        echo '<script>alert("Your cart is empty can\'t proceed to checkout!")</script>';
        header("Location: cart.php");
        exit();
    } else {
        $get_user_name_and_email_query = "SELECT fullName, email FROM `users` WHERE id=$user_id";
        $result_of_get_user_name_and_email_query = $conn->query($get_user_name_and_email_query);

        $user_name = "Unknown";
        $user_email = "Unknown";
        // Lấy tên và email của user và lưu vào các biến 
        if ($result_of_get_user_name_and_email_query && $result_of_get_user_name_and_email_query->num_rows > 0) {
            $user_info = $result_of_get_user_name_and_email_query->fetch_assoc();
            $user_name = $user_info['fullName'];
            $user_email = $user_info['email'];
        }

        $user_address = "Unknown";
        $get_address_query = "SELECT * FROM `addresses` WHERE user_id=$user_id AND is_default=1";
        $result_of_get_address_query = $conn->query($get_address_query);
        if ($result_of_get_address_query && $result_of_get_address_query->num_rows > 0) {
            $address = $result_of_get_address_query->fetch_assoc();
            $street = $address['street'];
            $ward_commune = $address['ward_commune'];
            $district = $address['district'];
            $province_city = $address['province_city'];
            $user_address = "$street, $ward_commune, $district, $province_city";
        }
        $conn->close();
    }
} else {
    $conn->close();
    header("Location: login.php");
    exit();
}
?>



<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <style>
        .the-label {
            color: #45a049;
            font-weight: bold;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .section {
            margin-bottom: 20px;
        }

        .section h3 {
            color: #45a049;
            margin-bottom: 10px;
        }

        .input-group {
            margin-bottom: 10px;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .button {
            background-color: #45a049;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .button:hover {
            background-color: #45a049;
        }

        .payment-option {
            margin-top: 10px;
        }

        .payment-option button {
            background-color: #ffffffff;
            border: 1px solid #45a049;
            color: #45a049;
            padding: 8px 15px;
            margin-right: 10px;
            border-radius: 4px;
            cursor: pointer;
        }

        .payment-option button:hover {
            background-color: #9fd7a2ff;
        }

        .payment-method-btn.active {
            background-color: #45a049;
            color: white;
            border-color: #45a049;

        }

        .summary {
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 4px;
        }

        .summary p {
            margin: 5px 0;
        }

        .summary .total {
            font-weight: bold;
            color: #d32f2f;
        }
    </style>
</head>

<body>

    <!--

1. Lấy user_id
2. Lấy cart_id
3. Lấy thông tin về sản phẩm có trong cart rồi tải lên webpage
4. Lấy quantity và price -> tính ra số tiền cần thanh toán, rồi tải lên webpage
5. Khi người dùng nhấn thanh toán, update bảng order và order_items và gửi thông báo thành công

-->
    <div class="container">
        <div class="section">
            <h3>Delivery information</h3>
            <div class="input-group">
                <label class="the-label">Receiver's name</label>
                <input type="text" placeholder="Enter receiver's name" value="<?php echo htmlspecialchars($user_name ?? ''); ?>">
            </div>
            <div class="input-group">
                <label class="the-label">Receiver's phone number</label>
                <input type="text" placeholder="Enter receiver's phone number">
            </div>
            <div class="input-group">
                <label class="the-label">Receiver's email</label>
                <input type="text" placeholder="Enter receiver's email" value="<?php echo htmlspecialchars($user_email ?? ''); ?>">
            </div>

            <div class="input-group">
                <label class="the-label">Receiver's address</label>
                <input type="text" placeholder="Enter receiver's address" value="<?php echo htmlspecialchars($user_address ?? ''); ?>">
            </div>
        </div>

        <div class="section">
            <h3>Order information</h3>
            <div class="summary">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
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
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td colspan="4"><strong>Total</strong></td>
                            <td><strong>$<?= number_format(array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart_items)), 2) ?></strong></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="section">
            <h3>Payment method</h3>
            <span class="payment-option">
                <button class="payment-method-btn">Credit Cards</button>
            </span>
            <span class="payment-option">
                <button class="payment-method-btn">QR Code ZaloPay</button>
            </span>
            <span class="payment-option">
                <button class="payment-method-btn" id="place_order_btn">PayPal</button>
            </span>
        </div>

        <div class="section">
            <h3>Pay</h3>
            <div class="summary">
                <h1>$<?= number_format(array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart_items)), 2) ?></h1>
                <form method="POST" action="place_order.php">
                    <!-- các input ẩn nếu cần -->
                    <input type="hidden" name="place_order" value="1">
                    <button class="button" id="place_order_btn" type="submit">PLACE ORDER</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const buttons = document.querySelectorAll('.payment-method-btn');

        buttons.forEach(button => {
            button.addEventListener('click', function() {
                // Xoá class 'active' khỏi tất cả nút trước
                buttons.forEach(btn => btn.classList.remove('active'));

                // Thêm class 'active' cho nút được nhấn
                button.classList.add('active');
            });
        });
    </script>
    <script>
        document.getElementById('place_order_btn').addEventListener('click', function(e) {
            const phoneInput = document.getElementById('receiver_phone');
            const phone = phoneInput.value.trim();

            // Regex: chỉ cho phép số, dài từ 9-11 ký tự
            const phoneRegex = /^\d{9,11}$/;

            if (!phoneRegex.test(phone)) {
                e.preventDefault(); // Ngăn submit
                alert("❌ Invalid phone number. Please enter between 9 and 11 digits.");
                phoneInput.focus();
            } else {
                // Cho submit nếu hợp lệ (ở đây đang không có form, mày có thể thêm submit nếu cần)
                alert("✅ Valid phone number. Processing order...");
            }
        });
    </script>

</body>

</html>