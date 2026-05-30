<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Panel - BlogYaari</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f2f5;
            color: #333;
            min-height: 100vh;
            overflow-x: hidden;
        }

        .sidebar {
            width: 250px;
            min-height: 100vh;
            background: #1a1f2e;
            display: flex;
            flex-direction: column;
            position: fixed;
            left: 0; top: 0;
            z-index: 100;
            transition: transform 0.3s ease;
        }

        .sidebar-brand {
            padding: 25px 20px;
            border-bottom: 1px solid #2d3446;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand-icon {
            width: 42px; height: 42px;
            background: #4a6cf7;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 18px; font-weight: bold; color: #fff;
        }

        .brand-text { color: #fff; }
        .brand-text h3 { font-size: 16px; font-weight: 700; }
        .brand-text span { font-size: 12px; color: #8892a4; }

        .sidebar-menu { padding: 20px 0; flex: 1; }

        .menu-label {
            font-size: 10px; font-weight: 700;
            color: #8892a4; letter-spacing: 1.5px;
            padding: 10px 20px 6px;
            text-transform: uppercase;
        }

        .menu-item {
            display: flex; align-items: center; gap: 12px;
            padding: 11px 20px;
            color: #8892a4;
            text-decoration: none;
            font-size: 14px;
            transition: all 0.2s;
            border-left: 3px solid transparent;
        }

        .menu-item:hover {
            color: #fff;
            background: #252b3b;
            border-left-color: #4a6cf7;
        }

        .menu-item.active {
            color: #fff;
            background: #252b3b;
            border-left-color: #4a6cf7;
        }

        .menu-item .icon {
            width: 20px; text-align: center; font-size: 15px;
        }

        .menu-item .badge {
            margin-left: auto;
            background: #4a6cf7;
            color: #fff;
            font-size: 11px;
            padding: 2px 7px;
            border-radius: 10px;
        }

        .sidebar-footer {
            padding: 15px 20px;
            border-top: 1px solid #2d3446;
        }

        .admin-info {
            display: flex; align-items: center; gap: 10px;
            margin-bottom: 12px;
        }

        .admin-avatar {
            width: 36px; height: 36px;
            background: #4a6cf7;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-weight: bold; font-size: 14px;
        }

        .admin-name { color: #fff; font-size: 13px; font-weight: 600; }
        .admin-role { color: #8892a4; font-size: 11px; }

        .logout-btn {
            display: flex; align-items: center; gap: 8px;
            width: 100%; padding: 9px 12px;
            background: #2d3446; border: none;
            border-radius: 6px; color: #ff6b6b;
            font-size: 13px; cursor: pointer;
            text-decoration: none;
            transition: background 0.2s;
        }

        .logout-btn:hover { background: #3a4258; }

        .main-wrapper {
            margin-left: 250px;
            width: calc(100% - 250px);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            overflow-x: hidden;
        }

        .topbar {
            background: #fff;
            padding: 15px 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 1px 4px rgba(0,0,0,0.08);
            position: sticky;
            top: 0;
            z-index: 50;
            width: 100%;
        }

        .topbar-left { display: flex; align-items: center; gap: 15px; }

        .hamburger {
            display: none;
            background: none; border: none;
            cursor: pointer; font-size: 20px; color: #333;
        }

        .page-title { font-size: 18px; font-weight: 700; color: #1a1f2e; }

        .topbar-right { display: flex; align-items: center; gap: 15px; }

        .topbar-btn {
            padding: 8px 18px;
            background: #4a6cf7; color: #fff;
            border: none; border-radius: 6px;
            font-size: 13px; font-weight: 600;
            text-decoration: none; cursor: pointer;
            transition: background 0.2s;
        }

        .topbar-btn:hover { background: #3a5ce5; }

        .page-content {
            padding: 30px;
            flex: 1;
            width: 100%;
            box-sizing: border-box;
        }

        .alert {
            padding: 13px 18px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-success { background: #d1fae5; color: #065f46; border: 1px solid #a7f3d0; }
        .alert-error   { background: #fee2e2; color: #991b1b; border: 1px solid #fca5a5; }

        .btn {
            padding: 8px 18px; border: none; border-radius: 6px;
            cursor: pointer; font-size: 13px; font-weight: 600;
            text-decoration: none; display: inline-block;
            transition: all 0.2s;
        }

        .btn-primary   { background: #4a6cf7; color: #fff; }
        .btn-primary:hover   { background: #3a5ce5; }
        .btn-success   { background: #10b981; color: #fff; }
        .btn-success:hover   { background: #059669; }
        .btn-danger    { background: #ef4444; color: #fff; }
        .btn-danger:hover    { background: #dc2626; }
        .btn-warning   { background: #f59e0b; color: #fff; }
        .btn-warning:hover   { background: #d97706; }
        .btn-secondary { background: #6b7280; color: #fff; }
        .btn-secondary:hover { background: #4b5563; }

        .sidebar-overlay {
            display: none;
            position: fixed; top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 99;
        }

        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .sidebar-overlay.open { display: block; }
            .main-wrapper { margin-left: 0; width: 100%; }
            .hamburger { display: block; }
            .page-content { padding: 20px 15px; }
            .topbar { padding: 12px 15px; }
        }
    </style>
</head>
<body>

<div class="sidebar-overlay" id="overlay" onclick="closeSidebar()"></div>

<aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <div class="brand-icon">B</div>
        <div class="brand-text">
            <h3>BlogYaari</h3>
            <span>Admin Panel</span>
        </div>
    </div>

    <nav class="sidebar-menu">
        <div class="menu-label">Main</div>

        <a href="/admin/dashboard"
           class="menu-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
            <span class="icon">&#9632;</span>
            Dashboard
            <span class="badge">{{ \App\Models\Blog::count() }}</span>
        </a>

        <a href="/blogs" target="_blank" class="menu-item">
            <span class="icon">&#9675;</span>
            View Website
        </a>

        <div class="menu-label">Blog Management</div>

        <a href="/admin/blogs/create"
           class="menu-item {{ request()->is('admin/blogs/create') ? 'active' : '' }}">
            <span class="icon">+</span>
            Add New Blog
        </a>

        <a href="/admin/dashboard"
           class="menu-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
            <span class="icon">&#9776;</span>
            All Blogs
        </a>
    </nav>

    <div class="sidebar-footer">
        <div class="admin-info">
            <div class="admin-avatar">
                {{ strtoupper(substr(session('admin_name', 'A'), 0, 1)) }}
            </div>
            <div>
                <div class="admin-name">{{ session('admin_name', 'Admin') }}</div>
                <div class="admin-role">Administrator</div>
            </div>
        </div>
        <form method="POST" action="/admin/logout">
            @csrf
            <button type="submit" class="logout-btn">
                <span>&#10148;</span> Logout
            </button>
        </form>
    </div>
</aside>

<div class="main-wrapper">
    <div class="topbar">
        <div class="topbar-left">
            <button class="hamburger" onclick="toggleSidebar()">&#9776;</button>
            <span class="page-title">@yield('page-title', 'Dashboard')</span>
        </div>
        <div class="topbar-right">
            <a href="/admin/blogs/create" class="topbar-btn">+ Add Blog</a>
        </div>
    </div>

    <div class="page-content">
        @if(session('success'))
            <div class="alert alert-success">
                <span>&#10003;</span> {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">
                <span>&#10007;</span> {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </div>
</div>

<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('open');
        document.getElementById('overlay').classList.toggle('open');
    }

    function closeSidebar() {
        document.getElementById('sidebar').classList.remove('open');
        document.getElementById('overlay').classList.remove('open');
    }
</script>

</body>
</html>