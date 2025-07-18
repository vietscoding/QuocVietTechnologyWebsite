<style>
    .footer-section {
        /* color: red; */
        /* align-items: ; */
        min-width: 220px;
        margin-bottom: 20px;
    }

    .footer-content {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 30px;
    }

    .footer-content>.footer-section {
        margin-right: 0;
    }

    @media (max-width: 900px) {
        .footer-content {
            flex-direction: column;
            align-items: center;
        }

        .footer-section {
            width: 100%;
            min-width: unset;
        }
    }

    .footer-content>div>* {
        text-align: left;
    }

    .footer.justify-content-center {
        margin-top: 5em;
    }
</style>

<footer class="footer justify-content-center" style="background-color: #f8f9fa; padding: 20px; text-align: center;">
    <div class="footer-content">
        <div class="footer-section" style="display: inline-block; margin-right: 50px;">
            <h4>Policy</h4>
            <p><a href="#" style="display: block;">Delivery Policy</p>
            <p><a href="#" style="display: block;">Return Policy</a></p>
            <p><a href="#" style="display: block;">Warranty Policy</a></p>
            <p><a href="#" style="display: block;">User Information Security Policy</a></p>
            <p><a href="#" style="display: block;">Purchase Policy</a></p>
        </div>

        <div class="footer-section" style="display: inline-block; margin-right: 50px;">
            <h4>Showroom</h4>
            <p><strong>Address</strong>: 50 Example St, Ward/Commune, District, Province/City</p>
            <p><strong>Tel</strong>: (+84) 987654321</p>
            <p><strong>Email</strong>: showroom@quocviet.vn</p>
            <p><strong>Open - Close time</strong>: 7a.m. - 5p.m.</p>
            <p><strong>Reflecting warranty/repair quality</strong>: (+84) 987654321</p>


        </div>

        <div class="footer-section" style="display: inline-block; margin-right: 50px;">
            <h4>Warranty/Repair Center</h4>
            <p><strong>Address</strong>: 50 Example St, Ward/Commune, District, Province/City</p>
            <p><strong>Tel</strong>: (+84) 987654321</p>
            <p><strong>Email</strong>: showroom@quocviet.vn</p>
            <p><strong>Open - Close time</strong>: 7a.m. - 5p.m.</p>
            <p><strong>Reflecting warranty/repair quality</strong>: (+84) 987654321</p>
        </div>
    </div>
    <hr>
    <div class="footer-bottom">
        <div class="footer-section" style="display: block;">
            <ul>
                <li class="footer-item" style="display: inline; margin-right: 50px;"><a href="about.php">About Us</a></li>
                <li class="footer-item" style="display: inline; margin-right: 50px;"><a href="contact.php">Contact Us</a></li>
                <li class="footer-item" style="display: inline; margin-right: 50px;"><a href="terms.php">Terms & Conditions</a></li>
                <li class="footer-item" style="display: inline;"><a href="privacy.php">Privacy Policy</a></li>
            </ul>
        </div>
        <!-- <div class="footer-section" style="display: inline-block;">
            <div class="social-icons" style="display: inline-block;">
                <a href="#"><i class="fab fa-facebook-f" style="display: inline;"></i></a>
                <a href="#"><i class="fab fa-twitter" style="display: inline;"></i></a>
                <a href="#"><i class="fab fa-instagram" style="display: inline;"></i></a>
                <a href="#"><i class="fab fa-linkedin-in" style="display: inline;"></i></a>
            </div>
        </div> -->
        <p>© 2025 Quoc Viet Technology. All rights reserved.</p>
    </div>
</footer>