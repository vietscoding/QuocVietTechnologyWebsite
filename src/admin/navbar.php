<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nav</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/admin_style.css">
    <style>
        .nav-link {
            color: #000000;
            
        }

        .nav-link:hover {
            background-color:rgb(77, 157, 28);
            color: #ffffff;
            text-decoration: none;
        }

        .active {
            background-color: rgb(77, 157, 28);
            color: #ffffff;
        }
        
    </style>
        
</head>
<body>
    <nav class="navbar navbar-expand-sm fixed-top" style="background-color: #E8E8E8; ">

        <div class="container justify-content-start" style="width:10%" >
            <a class="navbar-brand" href="dashboard.php">
                <img src="../assets/images/new_quocvietlogo.png" alt="Avatar Logo" style="width:40px;" class="rounded-pill"> 
            </a>
        </div>
        <div class="container-fluid justify-content-end">
            <ul class="nav justify-content-end" >
                <li class="nav-item"><a class="nav-link <?= ($current_page == 'dashboard') ? 'active' : '' ?>" href="dashboard.php">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link <?= ($current_page == 'manage_products') ? 'active nav-link' : '' ?>" href="manage_products.php">Products</a></li>
                <li class="nav-item"><a class="nav-link <?= ($current_page == 'manage_users') ? 'active nav-link' : '' ?>" href="manage_users.php">Users</a></li>
                <li class="nav-item"><a class="nav-link <?= ($current_page == 'manage_orders') ? 'active nav-link' : '' ?>" href="manage_orders.php">Orders</a></li>
                <li class="nav-item"><a class="nav-link <?= ($current_page == 'admin_profile') ? 'active nav-link' : '' ?>" href="admin_profile.php">Profile</a></li>
            </ul>
        </div>
    </nav>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>
</html>