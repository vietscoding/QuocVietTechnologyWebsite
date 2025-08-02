<?php
session_start();
require_once '../includes/db.php'; // Hoặc 'includes/database.php' tùy đường dẫn

// Kết nối database
if ($conn->connect_error) {
    $_SESSION['error'] = "Database connection failed: " . $conn->connect_error;
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
            $_SESSION['error'] = "The confirm password is incorrect";
            header("Location: ../register.php");
            exit;
        }

        // Kiểm tra độ dài mật khẩu
        if (strlen($password) < 8) {
            $_SESSION['error'] = "Password must be at least 8 characters long.";
            header("Location: ../register.php");
            exit;
        }

        // Kiểm tra name hoặc email đã tồn tại
        $stmt = $conn->prepare("SELECT id FROM users WHERE fullName = ? OR email = ?");
        $stmt->bind_param("ss", $name, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $_SESSION['error'] = "Username or email already exists.";
            $stmt->close();
            header("Location: ../register.php");
            exit;
        }

        // Mã hóa mật khẩu
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Lưu thông tin vào database

        $role = 'customer'; // Mặc định là customer, có thể thay đổi nếu cần
        $stmt = $conn->prepare("INSERT INTO users (fullName, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $hashed_password, $role);

        if ($stmt->execute()) {
            $_SESSION['success'] = "Registration successful! Please login.";
            header("Location: ../login.php");
            exit;
        } else {
            $_SESSION['error'] = "Registration failed. Please try again.";
            header("Location: ../register.php");
            exit;
        }
        $stmt->close();
    } elseif (isset($_POST['login'])) {
        // Xử lý đăng nhập
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        // Truy vấn người dùng
        $stmt = $conn->prepare("SELECT id, fullName, email, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            // Kiểm tra mật khẩu
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['fullName'] = $user['fullName'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['success'] = "Login Successfully!";
                header("Location: ../home.php");
                exit;
            } else {
                $_SESSION['error'] = "Incorrect Password!";
            }
        } else {
            $_SESSION['error'] = "Email doesn't exist";
        }
        $stmt->close();

        header("Location: ../login.php");
        exit;
    }
}

$conn->close();
header("Location: " . ($_SERVER['HTTP_REFERER'] ?: '../home.php'));
exit;
