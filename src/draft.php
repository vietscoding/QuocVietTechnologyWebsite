<?php
// Kết nối CSDL
$conn = new mysqli('localhost', 'root', '', 'ten_database'); // thay đổi cho đúng

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$product = null;

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int)$_GET['id'];
    $sql = "SELECT * FROM products WHERE id = $id";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        echo "Không tìm thấy sản phẩm.";
        exit;
    }
} else {
    echo "ID không hợp lệ.";
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($product['name']) ?></title>
    <style>
        body {
            font-family: sans-serif;
        }

        .container {
            display: flex;
            border: 1px solid #000;
            padding: 10px;
        }

        .left,
        .middle,
        .right {
            border: 1px solid #000;
            padding: 10px;
        }

        .left {
            width: 30%;
        }

        .middle {
            width: 40%;
        }

        .right {
            width: 30%;
            text-align: center;
        }

        .thumbnail-container {
            display: flex;
            gap: 5px;
            margin-top: 10px;
        }

        .thumbnail {
            width: 40px;
            height: 40px;
            border: 1px solid #000;
        }

        .qty-control {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin: 10px 0;
        }

        .qty-btn {
            width: 25px;
            height: 25px;
            cursor: pointer;
        }

        .add-to-cart {
            background-color: #cfe8cf;
            border: 1px solid #000;
            padding: 10px;
            cursor: pointer;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">

        <!-- LEFT: Hình ảnh -->
        <div class="left">
            <div style="border:1px solid #000; height:300px; text-align:center; line-height:300px;">
                <img src="<?= htmlspecialchars($product['main_image']) ?>" alt="Product Image" style="max-width:100%; max-height:100%;">
            </div>
            <div class="thumbnail-container">
                <?php
                // Giả định có nhiều ảnh phụ (ví dụ: thumbnail1, thumbnail2,...)
                for ($i = 1; $i <= 4; $i++) {
                    $thumb = $product['thumbnail' . $i] ?? '';
                    if ($thumb) {
                        echo '<div class="thumbnail"><img src="' . htmlspecialchars($thumb) . '" width="100%" height="100%"></div>';
                    }
                }
                ?>
                <button>see more</button>
            </div>
        </div>

        <!-- MIDDLE: Thông tin sản phẩm -->
        <div class="middle">
            <p><?= nl2br(htmlspecialchars($product['description'])) ?></p>

            <p><strong>BRAND:</strong> <?= htmlspecialchars($product['brand']) ?></p>

            <div style="border:1px solid #000; padding:5px;">
                <p><strong>Specification:</strong></p>
                <p>CPU: <?= htmlspecialchars($product['cpu']) ?></p>
                <p>GPU: <?= htmlspecialchars($product['gpu']) ?></p>
                <p>RAM: <?= htmlspecialchars($product['ram']) ?></p>
                <p>STORAGE: <?= htmlspecialchars($product['storage']) ?></p>
                <p>SCREEN SIZE: <?= htmlspecialchars($product['screen_size']) ?></p>
            </div>
        </div>

        <!-- RIGHT: Giá và nút mua -->
        <div class="right">
            <div style="border:1px solid #000; padding:5px;">
                <h2>$<?= htmlspecialchars($product['price']) ?></h2>
            </div>

            <div class="qty-control">
                <button class="qty-btn">-</button>
                <span>1</span>
                <button class="qty-btn">+</button>
            </div>

            <button class="add-to-cart">Add to cart</button>
        </div>

    </div>
</body>

</html>