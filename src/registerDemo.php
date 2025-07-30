<?php
session_start();
require_once 'includes/database.php'; // File cấu hình kết nối database

// Kiểm tra nếu đã đăng nhập, chuyển hướng về trang chủ
// if (isset($_SESSION['user_id'])) {
//     header("Location: home.php");
//     exit;
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up - Quoc Viet Technology</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="<?php echo isset($bodyClass) ? htmlspecialchars($bodyClass) : ''; ?>">
    <header>
        <div class="container-fluid" style="text-align: center;">
            <a href="home.php" class="navbar-brand">
                <img class="img-fluid" src="assets/images/new_quocvietlogo.png" alt="Logo" style="width: 100px; height: auto;">
            </a>
        </div>
    </header>

    <div class="container mt-5" id="register-form" style="margin-bottom: 200px;">
        <h2 style="text-align: center;">Sign Up</h2>
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($_SESSION['error']);
                                            unset($_SESSION['error']); ?></div>
        <?php endif; ?>
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($_SESSION['success']);
                                                unset($_SESSION['success']); ?></div>
        <?php endif; ?>
        <form action="includes/authDemo.php" method="POST" autocomplete="off">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name" required>
                <label for="name" class="form-label">Full Name</label>
            </div>
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                <label for="email" class="form-label">Email</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                <label for="password" class="form-label">Password</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm your password" required>
                <label for="confirm_password" class="form-label">Confirm Password</label>
            </div>
            <button type="submit" class="btn btn-success" id="btnRegister" name="register">Sign Up</button>
        </form>
        <div class="footer" style="margin-top: 20px;">
            Have an account? <a href="login.php">Login</a>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>