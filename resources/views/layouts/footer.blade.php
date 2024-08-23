<footer class="footer">
    <div class="container">
        <div class="row">
            <!-- Logo and Social Media Links -->
            <div class="col-lg-4 col-md-12 footer-left">
                <img src="{{ asset('path-to-your-logo/logo-footer.png') }}" alt="Logo" class="footer-logo">
                <div class="social-links">
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            <!-- Address -->
            <div class="col-lg-4 col-md-6 footer-middle">
                <p><i class="fas fa-map-marker-alt"></i> Jl. Jombang Raya No.26, Pd. Aren, Kec.Pd. Aren, Kota Tangerang Selatan, Banten 15224</p>
                <p><i class="fas fa-phone-alt"></i> +62 878 8211 2000</p>
            </div>
            <!-- Operating Hours and Contact -->
            <div class="col-lg-4 col-md-6 footer-right">
                <p><i class="fas fa-clock"></i> Monday – Saturday<br>07:30 – 16:30</p>
                <p><i class="fas fa-envelope"></i> team@andalprima.co.id</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center copyright">
                <p>© 2022-2024 PT. Andal Prima Adhitama Perkasa. All rights reserved. | Developed by Thriveworks</p>
            </div>
        </div>
    </div>
</footer>

<!-- Add your custom styles here -->
<style>
    .footer {
        background-color: #D71F26; /* Warna merah sesuai gambar */
        padding: 40px 0;
        color: #fff;
    }

    .footer-logo {
        width: 200px;
        margin-bottom: 20px;
    }

    .social-links {
        margin-top: 20px;
    }

    .social-links a {
        color: #fff;
        margin-right: 15px;
        font-size: 18px;
    }

    .social-links a:hover {
        color: #E8D8C3; /* Warna krem untuk hover */
    }

    .footer-left,
    .footer-middle,
    .footer-right {
        margin-bottom: 20px;
    }

    .footer-middle p,
    .footer-right p {
        font-size: 16px;
        margin: 10px 0;
    }

    .footer-middle i,
    .footer-right i {
        margin-right: 10px;
    }

    .footer-middle p:first-of-type,
    .footer-right p:first-of-type {
        margin-top: 0;
    }

    .copyright {
        margin-top: 20px;
        font-size: 14px;
        color: #ddd;
    }

    @media (max-width: 768px) {
        .footer-left,
        .footer-middle,
        .footer-right {
            text-align: center;
        }

        .footer-logo {
            margin-bottom: 10px;
        }
    }
</style>
