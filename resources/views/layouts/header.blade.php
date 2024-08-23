{{-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href="#">
            <img src="{{ asset('path-to-your-logo/logo.png') }}" alt="Logo" style="height: 30px;">
            ANDAL PIPA ABADI PERKASA
        </a>

        <!-- Search Bar -->
        <form class="form-inline my-2 my-lg-0 ml-auto">
            <input class="form-control mr-sm-2" type="search" placeholder="Search for products, types and brands" aria-label="Search">
        </form>

        <!-- Shopping Cart and Phone Number -->
        <div class="navbar-nav">
            <a class="nav-item nav-link" href="#">
                <i class="fas fa-shopping-cart"></i> (0)
            </a>
            <a class="nav-item nav-link" href="tel:(042) 883219">
                <i class="fas fa-phone"></i> (042) 883219
            </a>
        </div>
    </div>

    <!-- Sub-navbar with Categories -->
    <div class="sub-navbar bg-light">
        <div class="container">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Untuk Anda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Besi Hollow dan Pipa Bulat</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Besi Kawat</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Plat Besi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Besi Batangan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Baja Ringan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Plat Gelombang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Besi Profil Struktural</a>
                </li>
            </ul>
        </div>
    </div>
</nav> --}}

<!-- Add your custom styles -->
{{-- <style>
    .navbar-brand img {
        height: 30px;
    }

    .form-inline input {
        width: 300px;
    }

    .sub-navbar .nav-link {
        padding: 10px 15px;
        color: #333;
    }

    .sub-navbar .nav-link.active {
        color: red;
    }
</style> --}}
{{-- <link href="{{ asset('css/navbar.css') }}" rel="stylesheet"> --}}



<style>
    header {
        background-color: #f9f1e8;
        padding: 10px 0;
        font-family: Arial, sans-serif;
    }

    .container {
        width: 90%;
        margin: 0 auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .header-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .header-left .logo img {
        width: 150px;
    }

    .header-middle {
        display: flex;
        align-items: center;
    }

    .category-dropdown {
        margin-right: 10px;
    }

    .dropdown-btn {
        background-color: #f5f5f5;
        border: none;
        padding: 10px;
        cursor: pointer;
    }

    .search-bar {
        display: flex;
        align-items: center;
        border: 1px solid #ddd;
        padding: 5px;
        border-radius: 5px;
    }

    .search-bar input {
        border: none;
        outline: none;
        padding: 5px;
        width: 300px;
    }

    .search-bar button {
        background-color: transparent;
        border: none;
        cursor: pointer;
    }

    .header-right {
        display: flex;
        align-items: center;
    }

    .cart-icon {
        margin-right: 20px;
        position: relative;
    }

    .cart-icon .cart-count {
        background-color: red;
        color: white;
        border-radius: 50%;
        padding: 2px 5px;
        position: absolute;
        top: -10px;
        right: -10px;
    }

    .contact-info {
        display: flex;
        align-items: center;
    }

    .contact-info i {
        margin-right: 5px;
    }

    .header-bottom {
        background-color: #fff;
        padding: 10px 0;
    }

    .navbar ul {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        justify-content: space-around;
    }

    .navbar ul li {
        margin: 0 10px;
    }

    .navbar ul li a {
        text-decoration: none;
        color: #333;
        font-weight: bold;
    }
</style>

<header>
    <div class="header-top">
        <div class="container">
            <div class="header-left">
                <a href="/" class="logo">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo">
                </a>
            </div>
            <div class="header-middle">
                <div class="category-dropdown">
                    <button class="dropdown-btn">Category</button>
                    <div class="dropdown-content">
                        <!-- Add your category options here -->
                    </div>
                </div>
                <div class="search-bar">
                    <input type="text" placeholder="Search for products, types and brands">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </div>
            </div>
            <div class="header-right">
                <div class="cart-icon">
                    <a href="/cart"><i class="fa fa-shopping-cart"></i><span class="cart-count">0</span></a>
                </div>
                <div class="contact-info">
                    <i class="fa fa-phone"></i> (042) 883219
                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom">
        <div class="container">
            <nav class="navbar">
                <ul>
                    <li><a href="#">Untuk Anda</a></li>
                    <li><a href="#">Besi Hollow dan Pipa Bulat</a></li>
                    <li><a href="#">Besi Kawat</a></li>
                    <li><a href="#">Plat Besi</a></li>
                    <li><a href="#">Besi Batangan</a></li>
                    <li><a href="#">Baja Ringan</a></li>
                    <li><a href="#">Plat Gelombang</a></li>
                    <li><a href="#">Besi Profil Struktural</a></li>
                </ul>
            </nav>
        </div>
    </div>
</header>
