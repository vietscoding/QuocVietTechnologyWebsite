<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/style.css">


</head>

<body>
    <?php
    $current_page = "profile";
    include 'includes/header.php';
    ?>

    <div class="container mt-4">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 mb-3">
                <div class="card p-3" style="background:#f3f3f3;">
                    <div class="d-flex align-items-center mb-3">
                        <img src="assets/images/new_quocvietlogo.png" alt="Avatar" style="width:40px;height:40px;border-radius:50%;margin-right:10px;">
                        <div>
                            <div style="font-size:14px;">Account of</div>
                            <div style="font-size:22px;font-weight:bold;">Viet Doan</div>
                        </div>
                    </div>
                    <ul class="list-unstyled mb-4">
                        <li><i class="bi bi-person-fill"></i> <b>Account Information</b></li>
                        <li><i class="bi bi-geo-alt-fill"></i> Addresses</li>
                        <li><i class="bi bi-bell-fill"></i> Notification</li>
                    </ul>
                    <button class="btn btn-dark w-100" onclick="confirmLogout()">Log out</button>
                </div>
            </div>
            <!-- Account Information -->
            <div class="col-md-6 mb-3">
                <div class="card p-4" style="background:#eaeaea;">
                    <h5 class="mb-3">Account Information</h5>
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-control" value="Viet Doan">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" value="exampleemail@gmail.com">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" value="passwordpassword" id="profilePassword">
                                <button class="btn btn-outline-secondary" type="button" onclick="togglePassword()"><i class="bi bi-eye"></i></button>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Date of Birth</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="dd/MM/yyyy">
                                <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sex</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sex" id="male" value="male">
                                <label class="form-check-label" for="male">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sex" id="female" value="female">
                                <label class="form-check-label" for="female">Female</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sex" id="other" value="other">
                                <label class="form-check-label" for="other">Other</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-dark">Update</button>
                    </form>
                </div>
            </div>
            <!-- Default Address -->
            <div class="col-md-3 mb-3">
                <div class="card p-4" style="background:#ededed;">
                    <h5 class="mb-3">Default Address</h5>
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Province/City</label>
                            <input type="text" class="form-control" value="Da Nang">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">District</label>
                            <input type="text" class="form-control" value="Cam Le">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Ward/Commune</label>
                            <input type="text" class="form-control" value="Khue Trung">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Specific Address</label>
                            <input type="text" class="form-control" value="50 Ong Ich Duong st.">
                        </div>
                        <button type="submit" class="btn btn-dark">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmLogout() {
            if (confirm('Are you sure you want to log out?')) {
                window.location.href = 'logout.php';
            }
        }

        function togglePassword() {
            var pwd = document.getElementById('profilePassword');
            if (pwd.type === 'password') {
                pwd.type = 'text';
            } else {
                pwd.type = 'password';
            }
        }
    </script>

    <?php include 'includes/footer.php'; ?>

    <script src="assets/js/script.js"></script>
</body>

</html>