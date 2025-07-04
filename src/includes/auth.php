<?php
session_start();
require_once '../includes/db.php'; // Đảm bảo bạn đã có file kết nối DB

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    // Truy vấn người dùng theo email
    $stmt = $conn->prepare("SELECT id, email, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        // So sánh mật khẩu
        if (password_verify($password, $user['password'])) {
            // Đăng nhập thành công
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            header("Location: ../dashboard.php");
            exit();
        } else {
            $error = "Sai mật khẩu.";
        }
    } else {
        $error = "Email không tồn tại.";
    }
}
?>