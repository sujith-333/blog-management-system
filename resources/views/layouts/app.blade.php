<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>BlogYaari - Latest Updates</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8f9fb;
            color: #333;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ── Navbar ── */
        .navbar {
            background: #fff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .navbar-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .brand-logo {
            width: 38px; height: 38px;
            background: #4a6cf7;
            border-radius: 10px;
            display: flex; align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 800;
            font-size: 16px;
        }

        .brand-name {
            font-size: 20px;
            font-weight: 800;
            color: #1a1f2e;
        }

        .brand-name span { color: #4a6cf7; }

        .navbar-links {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-link {
            padding: 8px 16px;
            color: #6b7280;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            border-radius: 6px;
            transition: all 0.2s;
        }

        .nav-link:hover {
            color: #4a6cf7;
            background: #f0f4ff;
        }

        .nav-link.active {
            color: #4a6cf7;
            background: #f0f4ff;
        }

        .nav-admin-btn {
            padding: 8px 18px;
            background: #4a6cf7;
            color: #fff;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            border-radius: 6px;
            transition: background 0.2s;
            margin-left: 8px;
        }

        .nav-admin-btn:hover { background: #3a5ce5; }

        .hamburger-btn {
            display: none;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 22px;
            color: #333;
            padding: 4px;
        }

        .mobile-menu {
            display: none;
            background: #fff;
            border-top: 1px solid #f0f2f5;
            padding: 12px 24px;
        }

        .mobile-menu.open { display: block; }

        .mobile-menu a {
            display: block;
            padding: 10px 0;
            color: #374151;
            text-decoration: none;
            font-size: 15px;
            border-bottom: 1px solid #f9fafb;
        }

        .mobile-menu a:last-child { border-bottom: none; }

        /* ── Main Content ── */
        .main-content {
            flex: 1;
        }

        /* ── Footer ── */
        .footer {
            background: #1a1f2e;
            color: #8892a4;
            margin-top: auto;
        }

        .footer-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 24px 20px;
        }

        .footer-top {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 40px;
            margin-bottom: 30px;
        }

        .footer-brand .brand-logo {
            margin-bottom: 12px;
        }

        .footer-brand p {
            font-size: 14px;
            line-height: 1.7;
            color: #8892a4;
            max-width: 280px;
        }

        .footer-col h4 {
            color: #fff;
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .footer-col a {
            display: block;
            color: #8892a4;
            text-decoration: none;
            font-size: 14px;
            padding: 4px 0;
            transition: color 0.2s;
        }

        .footer-col a:hover { color: #fff; }

        .footer-bottom {
            border-top: 1px solid #2d3446;
            padding-top: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        .footer-bottom p { font-size: 13px; }

        .footer-bottom a {
            color: #4a6cf7;
            text-decoration: none;
            font-size: 13px;
        }

        @media (max-width: 768px) {
            .navbar-links { display: none; }
            .hamburger-btn { display: block; }
            .footer-top { grid-template-columns: 1fr; gap: 25px; }
            .footer-bottom { flex-direction: column; text-align: center; }
        }
    </style>
</head>
<body>

<!-- Navbar -->
<header class="navbar">
    <div class="navbar-inner">
        <a href="/blogs" class="navbar-brand">
            <div class="brand-logo">B</div>
            <span class="brand-name">Blog<span>Yaari</span></span>
        </a>

        <nav class="navbar-links">
            <a href="/blogs" class="nav-link {{ request()->is('blogs') ? 'active' : '' }}">Home</a>
            <a href="/blogs?category=1" class="nav-link">Admit Card</a>
            <a href="/blogs?category=2" class="nav-link">Result</a>
            <a href="/admin/login" class="nav-admin-btn">Admin</a>
        </nav>

        <button class="hamburger-btn" onclick="toggleMobileMenu()">&#9776;</button>
    </div>

    <div class="mobile-menu" id="mobile-menu">
        <a href="/blogs">Home</a>
        <a href="/blogs?category=1">Admit Card</a>
        <a href="/blogs?category=2">Result</a>
        <a href="/admin/login">Admin Panel</a>
    </div>
</header>

<!-- Main Content -->
<main class="main-content">
    @yield('content')
</main>

<!-- Footer -->
<footer class="footer">
    <div class="footer-inner">
        <div class="footer-top">
            <div class="footer-brand">
                <div class="brand-logo">B</div>
                <p style="margin-top:10px">
                    BlogYaari brings you the latest updates on admit cards,
                    exam results, and government job notifications.
                </p>
            </div>
            <div class="footer-col">
                <h4>Categories</h4>
                <a href="/blogs?category=1">Admit Card</a>
                <a href="/blogs?category=2">Result</a>
                <a href="/blogs">All Blogs</a>
            </div>
            <div class="footer-col">
                <h4>Quick Links</h4>
                <a href="/blogs">Home</a>
                <a href="/admin/login">Admin Panel</a>
            </div>
        </div>
        <div class="footer-bottom">
            <p>2024 BlogYaari. All rights reserved.</p>
            <a href="/admin/login">Admin Login</a>
        </div>
    </div>
</footer>

<script>
    function toggleMobileMenu() {
        document.getElementById('mobile-menu').classList.toggle('open');
    }
</script>

</body>
</html>