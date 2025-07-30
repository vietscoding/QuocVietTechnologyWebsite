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
    $current_page = "contact";
    include 'includes/header.php';
    ?>

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card p-4" style="background:#e0e0e0;">
                    <h4>Contact Us through:</h4>
                    <p>Email: <a href="mailto:cskh@quocviet.vn">cskh@quocviet.vn</a></p>
                    <p>Telephone: <a href="tel:+84987654321">(+84) 987654321</a></p>
                    <div class="mb-3">
                        <span>Social Media: </span>
                        <a href="#" title="Facebook"><i class="bi bi-facebook"></i></a>
                        <a href="#" title="TikTok"><i class="bi bi-tiktok"></i></a>
                        <a href="#" title="YouTube"><i class="bi bi-youtube"></i></a>
                        <a href="#" title="Pinterest"><i class="bi bi-pinterest"></i></a>
                        <a href="#" title="Instagram"><i class="bi bi-instagram"></i></a>
                    </div>
                    <form>
                        <div class="mb-3">
                            <label for="message" class="form-label">Direct Message:</label>
                            <textarea class="form-control" id="message" rows="5" placeholder="Let us know what you would like us to hear from you..."></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" required>How would you like to receive feedback from Quoc Viet?</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="feedback_method" id="phone" value="phone">
                                <label class="form-check-label" for="phone">Through my phone number</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="feedback_method" id="email" value="email">
                                <label class="form-check-label" for="email">Through my email</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="feedback_method" id="both" value="both">
                                <label class="form-check-label" for="both">Both are ok</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="feedback_method" id="any" value="any">
                                <label class="form-check-label" for="any">Whatever you want</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-dark" onclick="sendFeedback()">Send</button>
                        <script>
                            function sendFeedback() {
                                alert("Thank you for your feedback! We will get back to you soon.");
                            }
                        </script>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>

</html>