<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>
    <?php
    $current_page = "cart";
    include 'includes/header.php';
    ?>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-9">
                <h4 class="mb-3">Shopping Cart (4 items) <span class="float-end"><a href="#" class="text-dark" onclick="removeAll()">Remove All <i class="bi bi-trash"></i></a></span></h4>
                <!-- Cart Items -->
                <div id="cart-items">
                    <!-- Item 1 -->
                    <div class="card mb-3 p-3" style="background:#d3d3d3;">
                        <div class="row g-0 align-items-center">
                            <div class="col-md-2 text-center">
                                <img src="assets/images/product_placeholder.png" alt="Product" style="width:100px;height:100px;background:#eee;border-radius:8px;object-fit:cover;">
                            </div>
                            <div class="col-md-6">
                                <div><b>Name, Screen Size, CPU, RAM, Storage, OS, SKU, ádfasdfsfdsdf ffffffff ffffffsdf asdff ffasdfjqw erjiskjvdks dsfh jkvhkdhfk jdshfweuif ysiudcvhkj hgfioe</b></div>
                                <div class="text-muted" style="font-size:13px;text-decoration:line-through;">$249.99</div>
                                <div style="font-size:20px;font-weight:bold;">$299.99</div>
                                <div class="text-success" style="font-size:13px;">Save: $50.00 (16%)</div>
                            </div>
                            <div class="col-md-2 text-center">
                                <div class="input-group mb-2" style="width:120px;">
                                    <button class="btn btn-outline-dark" type="button">-</button>
                                    <input type="text" class="form-control text-center" value="1" style="width:40px;">
                                    <button class="btn btn-outline-dark" type="button">+</button>
                                </div>
                                <button class="btn btn-outline-dark w-100" type="button">Remove <i class="bi bi-trash"></i></button>
                            </div>
                        </div>
                    </div>
                    <!-- Item 2 -->
                    <div class="card mb-3 p-3" style="background:#d3d3d3;">
                        <div class="row g-0 align-items-center">
                            <div class="col-md-2 text-center">
                                <img src="assets/images/product_placeholder.png" alt="Product" style="width:100px;height:100px;background:#eee;border-radius:8px;object-fit:cover;">
                            </div>
                            <div class="col-md-6">
                                <div><b>Name, Screen Size, CPU, RAM, Storage, OS, SKU, ádfasdfsfdsdf ffffffff ffffffsdf asdff ffasdfjqw erjiskjvdks dsfh jkvhkdhfk jdshfweuif ysiudcvhkj hgfioe</b></div>
                                <div style="font-size:20px;font-weight:bold;">$19999.99</div>
                            </div>
                            <div class="col-md-2 text-center">
                                <div class="input-group mb-2" style="width:120px;">
                                    <button class="btn btn-outline-dark" type="button">-</button>
                                    <input type="text" class="form-control text-center" value="1" style="width:40px;">
                                    <button class="btn btn-outline-dark" type="button">+</button>
                                </div>
                                <button class="btn btn-outline-dark w-100" type="button">Remove <i class="bi bi-trash"></i></button>
                            </div>
                        </div>
                    </div>
                    <!-- Item 3 -->
                    <div class="card mb-3 p-3" style="background:#d3d3d3;">
                        <div class="row g-0 align-items-center">
                            <div class="col-md-2 text-center">
                                <img src="assets/images/product_placeholder.png" alt="Product" style="width:100px;height:100px;background:#eee;border-radius:8px;object-fit:cover;">
                            </div>
                            <div class="col-md-6">
                                <div><b>Name, Screen Size, CPU, RAM, Storage, OS, SKU, ádfasdfsfdsdf ffffffff ffffffsdf asdff ffasdfjqw erjiskjvdks dsfh jkvhkdhfk jdshfweuif ysiudcvhkj hgfioe</b></div>
                                <div class="text-muted" style="font-size:13px;text-decoration:line-through;">$249.99</div>
                                <div style="font-size:20px;font-weight:bold;">$299.99</div>
                                <div class="text-success" style="font-size:13px;">Save: $50.00 (16%)</div>
                            </div>
                            <div class="col-md-2 text-center">
                                <div class="input-group mb-2" style="width:120px;">
                                    <button class="btn btn-outline-dark" type="button">-</button>
                                    <input type="text" class="form-control text-center" value="1" style="width:40px;">
                                    <button class="btn btn-outline-dark" type="button">+</button>
                                </div>
                                <button class="btn btn-outline-dark w-100" type="button">Remove <i class="bi bi-trash"></i></button>
                            </div>
                        </div>
                    </div>
                    <!-- Item 4 -->
                    <div class="card mb-3 p-3" style="background:#d3d3d3;">
                        <div class="row g-0 align-items-center">
                            <div class="col-md-2 text-center">
                                <img src="assets/images/product_placeholder.png" alt="Product" style="width:100px;height:100px;background:#eee;border-radius:8px;object-fit:cover;">
                            </div>
                            <div class="col-md-6">
                                <div><b>Name, Screen Size, CPU, RAM, Storage, OS, SKU, ádfasdfsfdsdf ffffffff ffffffsdf asdff ffasdfjqw erjiskjvdks dsfh jkvhkdhfk jdshfweuif ysiudcvhkj hgfioe</b></div>
                                <div style="font-size:20px;font-weight:bold;">$299.99</div>
                            </div>
                            <div class="col-md-2 text-center">
                                <div class="input-group mb-2" style="width:120px;">
                                    <button class="btn btn-outline-dark" type="button">-</button>
                                    <input type="text" class="form-control text-center" value="1" style="width:40px;">
                                    <button class="btn btn-outline-dark" type="button">+</button>
                                </div>
                                <button class="btn btn-outline-dark w-100" type="button">Remove <i class="bi bi-trash"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Summary -->
            <div class="col-md-3">
                <div class="card p-3" style="background:#cfcfcf;">
                    <h5>Summary</h5>
                    <div class="mb-2">Item(s): <span class="float-end">$259.99</span></div>
                    <div class="mb-2">Promo discount: <span class="float-end text-danger">-$30.00</span></div>
                    <hr>
                    <div class="mb-3" style="font-size:20px;font-weight:bold;">Est. Total: <span class="float-end">$229.99</span></div>
                    <button class="btn btn-dark w-100">Checkout</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function removeAll() {
            if (confirm('Remove all items from cart?')) {
                document.getElementById('cart-items').innerHTML = '<div class="alert alert-info">Your cart is empty.</div>';
            }
        }
    </script>

    <?php include 'includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <script src="assets/js/script.js"></script>