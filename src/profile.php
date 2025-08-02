<?php
session_start();
include './includes/db.php';

$user_id = $_SESSION['user_id'] ?? null;

if ($user_id) {
    # get user info
    $get_user_info_query = "SELECT * FROM `users` WHERE id = $user_id";
    $result_of_get_user_info_query = $conn->query($get_user_info_query);

    $full_name = "Unknown";
    $email = "Unknown";
    $gender = "Unknown";
    $password = "Unknown";
    $dob = "Unknown";
    if ($result_of_get_user_info_query && $result_of_get_user_info_query->num_rows > 0) {
        $user_info = $result_of_get_user_info_query->fetch_assoc();
        $full_name = $user_info['fullName'];
        $email = $user_info['email'];
        $gender = $user_info['gender'];
        $password = $user_info['password'];
        $dob = $user_info['DOB'];
    }


    $get_address_query = "SELECT * FROM `addresses` WHERE user_id=$user_id AND is_default=1";
    $result_of_get_address_query = $conn->query($get_address_query);
    if ($result_of_get_address_query && $result_of_get_address_query->num_rows > 0) {
        $address = $result_of_get_address_query->fetch_assoc();
        $street =  $address['street'];
        $ward_commune = $address['ward_commune'];
        $district = $address['district'];
        $province_city = $address['province_city'];
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
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
                            <div style="font-size:22px;font-weight:bold;"><?php echo htmlspecialchars($full_name ?? ''); ?></div>
                        </div>
                    </div>
                    <!-- <ul class="list-unstyled mb-4">
                        <li><i class="bi bi-person-fill"></i> <b>Account Information</b></li>
                        <li><i class="bi bi-geo-alt-fill"></i> Addresses</li>
                        <li><i class="bi bi-bell-fill"></i> Notification</li>
                    </ul> -->
                    <button class="btn btn-danger w-100" onclick="confirmLogout()">Log out</button>
                </div>
            </div>
            <!-- Account Information -->
            <div class="col-md-6 mb-3">
                <div class="card p-4" style="background:#eaeaea;">
                    <h5 class="mb-3">Account Information</h5>
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($full_name ?? ''); ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" value="<?php echo htmlspecialchars($email ?? ''); ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" value="<?php echo htmlspecialchars($password ?? ''); ?>" id="profilePassword">
                                <button class="btn btn-outline-secondary" type="button" onclick="togglePassword()"><i class="bi bi-eye"></i></button>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Date of Birth</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="dd/MM/yyyy"
                                    value="<?php echo htmlspecialchars($dob ?? ''); ?>">
                                <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Gender</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sex" id="male" value="male"
                                    checked>
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
                        <button type="submit" class="btn btn-dark" onclick="alert('Update info successfully!')">Update</button>
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
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($province_city ?? ''); ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">District</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($district ?? ''); ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Ward/Commune</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($ward_commune ?? ''); ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Street</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($street ?? ''); ?>">
                        </div>
                        <button type="submit" class="btn btn-dark" onclick="alert('Update info successfully!')">Update</button>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>