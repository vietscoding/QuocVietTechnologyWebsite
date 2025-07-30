<?php
session_start();
require_once '../includes/database.php'; // Hoặc 'includes/database.php' tùy đường dẫn

// Kết nối database
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error) {
    $_SESSION['error'] = "Kết nối database thất bại: " . $conn->connect_error;
    header("Location: " . ($_SERVER['HTTP_REFERER'] ?: '../home.php'));
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['register'])) {
        // Xử lý đăng ký
        // $username = trim($_POST['username']);
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $confirm_password = trim($_POST['confirm_password']);

        // Kiểm tra xác nhận mật khẩu
        if ($password !== $confirm_password) {
            $_SESSION['error'] = "Mật khẩu xác nhận không khớp.";
            header("Location: ../registerDemo.php");
            exit;
        }

        // Kiểm tra độ dài mật khẩu
        if (strlen($password) < 8) {
            $_SESSION['error'] = "Mật khẩu phải dài ít nhất 8 ký tự.";
            header("Location: ../registerDemo.php");
            exit;
        }

        // Kiểm tra name hoặc email đã tồn tại
        $stmt = $conn->prepare("SELECT id FROM users WHERE name = ? OR email = ?");
        $stmt->bind_param("ss", $name, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $_SESSION['error'] = "Tên đăng nhập hoặc email đã tồn tại.";
            $stmt->close();
            header("Location: ../registerDemo.php");
            exit;
        }

        // Mã hóa mật khẩu
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Lưu thông tin vào database

        $role = 'customer'; // Mặc định là customer, có thể thay đổi nếu cần
        $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $hashed_password, $role);

        if ($stmt->execute()) {
            $_SESSION['success'] = "Đăng ký thành công! Vui lòng đăng nhập.";
            header("Location: ../login.php");
            exit;
        } else {
            $_SESSION['error'] = "Đăng ký thất bại. Vui lòng thử lại.";
            header("Location: ../registerDemo.php");
            exit;
        }
        $stmt->close();
    } elseif (isset($_POST['login'])) {
        // Xử lý đăng nhập
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        // Truy vấn người dùng
        $stmt = $conn->prepare("SELECT id, fullname, email, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            // Kiểm tra mật khẩu
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['fullname'] = $user['fullname'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['success'] = "Đăng nhập thành công.";
                header("Location: ../home.php");
                exit;
            } else {
                $_SESSION['error'] = "Mật khẩu không đúng.";
            }
        } else {
            $_SESSION['error'] = "Email không tồn tại.";
        }
        $stmt->close();

        header("Location: ../login.php");
        exit;
    }
}

$conn->close();
header("Location: " . ($_SERVER['HTTP_REFERER'] ?: '../home.php'));
exit;
