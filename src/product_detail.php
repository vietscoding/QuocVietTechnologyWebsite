<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Detail</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <?php
    $current_page = "product_detail";
    include 'includes/header.php';
    ?>
    <div class="container mt-4">
        <div class="card p-3 mb-3" style="background:#ededed;">
            <div class="row g-3">
                <div class="col-md-3 text-center">
                    <img src="assets/images/product_placeholder.png" alt="Product" style="width:150px;height:150px;background:#eee;border-radius:8px;object-fit:cover;">
                    <div class="mt-2 d-flex justify-content-center gap-2">
                        <img src="assets/images/product_placeholder.png" style="width:40px;height:40px;background:#eee;border-radius:5px;">
                        <img src="assets/images/product_placeholder.png" style="width:40px;height:40px;background:#eee;border-radius:5px;">
                        <img src="assets/images/product_placeholder.png" style="width:40px;height:40px;background:#eee;border-radius:5px;">
                        <img src="assets/images/product_placeholder.png" style="width:40px;height:40px;background:#eee;border-radius:5px;">
                    </div>
                </div>
                <div class="col-md-6">
                    <div><b>Name, Screen Size, CPU, RAM, Storage, OS, SKU, ádfasdfsfdsdf rmmm ffffffsdf asdff ffasdfjqw erjiskjvdks dsfh jkvhkdhfk jdshfweuif ysiudcvhkj hgfioe</b></div>
                    <div>Brand: Lenovo | SKU: 241104397</div>
                    <div class="mt-2">Color: <span class="btn btn-outline-dark btn-sm">Black</span> <span class="btn btn-outline-dark btn-sm">White</span></div>
                    <div class="mt-3">
                        <span class="text-muted" style="text-decoration:line-through;">$249.99</span>
                        <span style="font-size:24px;font-weight:bold;">$299.99</span>
                    </div>
                    <button class="btn btn-dark mt-2">Add to Cart</button>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-8">
                <div class="card p-3 mb-3" style="background:#f3f3f3;">
                    <h5>Product Description</h5>
                    <ul>
                        <li>8GB Soldered RAM And Expandable Space; 320GB DDR4 RAM for smooth multitasking</li>
                        <li>256GB SSD And 1TB HDD for storage</li>
                        <li>Intel Core i5 12th Gen Processor</li>
                        <li>15.6" FHD IPS Display, 1920x1080</li>
                        <li>Windows 11 Home, Office 2021</li>
                        <li>Intel Iris Xe Graphics</li>
                        <li>Battery: 45Wh, up to 8 hours</li>
                        <li>Ports: 2x USB 3.2, 1x Type-C, 1x HDMI, 1x Audio Jack</li>
                        <li>Weight: 1.7kg</li>
                        <li>Warranty: 2 Years</li>
                        <li>Customized Lenovo V15 Series Laptop</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-3 mb-3" style="background:#f3f3f3;">
                    <h5>Specifications</h5>
                    <table class="table table-sm">
                        <tbody>
                            <tr>
                                <td>CPU</td>
                                <td>Intel Core i5 12th Gen</td>
                            </tr>
                            <tr>
                                <td>RAM</td>
                                <td>8GB DDR4</td>
                            </tr>
                            <tr>
                                <td>Storage</td>
                                <td>256GB SSD + 1TB HDD</td>
                            </tr>
                            <tr>
                                <td>Display</td>
                                <td>15.6" FHD IPS</td>
                            </tr>
                            <tr>
                                <td>Graphics</td>
                                <td>Intel Iris Xe</td>
                            </tr>
                            <tr>
                                <td>OS</td>
                                <td>Windows 11 Home</td>
                            </tr>
                            <tr>
                                <td>Battery</td>
                                <td>45Wh</td>
                            </tr>
                            <tr>
                                <td>Weight</td>
                                <td>1.7kg</td>
                            </tr>
                            <tr>
                                <td>Warranty</td>
                                <td>2 Years</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card p-3 mb-3" style="background:#e0e0e0;">
            <h5>Related Products</h5>
            <div class="d-flex align-items-center">
                <button class="btn btn-outline-dark me-2"><i class="bi bi-chevron-left"></i></button>
                <div class="d-flex flex-row gap-3 w-100">
                    <div class="card p-2" style="width:150px;background:#ededed;">
                        <img src="assets/images/product_placeholder.png" style="width:100px;height:100px;background:#eee;border-radius:8px;object-fit:cover;">
                        <div style="font-size:13px;">Name, Screen Size, CPU, RAM, Storage, OS, SKU</div>
                        <div style="font-weight:bold;">$999.99</div>
                        <button class="btn btn-dark btn-sm w-100">Add</button>
                    </div>
                    <div class="card p-2" style="width:150px;background:#ededed;">
                        <img src="assets/images/product_placeholder.png" style="width:100px;height:100px;background:#eee;border-radius:8px;object-fit:cover;">
                        <div style="font-size:13px;">Name, Screen Size, CPU, RAM, Storage, OS, SKU</div>
                        <div style="font-weight:bold;">$999.99</div>
                        <button class="btn btn-dark btn-sm w-100">Add</button>
                    </div>
                    <div class="card p-2" style="width:150px;background:#ededed;">
                        <img src="assets/images/product_placeholder.png" style="width:100px;height:100px;background:#eee;border-radius:8px;object-fit:cover;">
                        <div style="font-size:13px;">Name, Screen Size, CPU, RAM, Storage, OS, SKU</div>
                        <div style="font-weight:bold;">$999.99</div>
                        <button class="btn btn-dark btn-sm w-100">Add</button>
                    </div>
                </div>
                <button class="btn btn-outline-dark ms-2"><i class="bi bi-chevron-right"></i></button>
            </div>
        </div>
    </div>
    <?php include 'includes/footer.php'; ?>
    <script src="assets/js/script.js"></script>
</body>

</html>