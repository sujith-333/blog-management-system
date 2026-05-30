<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - BlogYaari</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f2f5;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-wrapper {
            display: flex;
            width: 100%;
            max-width: 900px;
            min-height: 520px;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0,0,0,0.12);
            margin: 20px;
        }

        /* Left Panel */
        .login-left {
            flex: 1;
            background: #1a1f2e;
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-left .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 50px;
        }

        .brand-icon {
            width: 46px; height: 46px;
            background: #4a6cf7;
            border-radius: 12px;
            display: flex; align-items: center;
            justify-content: center;
            font-size: 20px; font-weight: bold; color: #fff;
        }

        .brand-name {
            color: #fff;
            font-size: 22px;
            font-weight: 700;
        }

        .login-left h1 {
            color: #fff;
            font-size: 28px;
            font-weight: 800;
            margin-bottom: 12px;
            line-height: 1.3;
        }

        .login-left p {
            color: #8892a4;
            font-size: 14px;
            line-height: 1.7;
            margin-bottom: 40px;
        }

        .feature-list { list-style: none; }

        .feature-list li {
            color: #8892a4;
            font-size: 13px;
            padding: 7px 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .feature-list li span.dot {
            width: 8px; height: 8px;
            background: #4a6cf7;
            border-radius: 50%;
            flex-shrink: 0;
        }

        /* Right Panel */
        .login-right {
            flex: 1;
            background: #fff;
            padding: 50px 45px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-right h2 {
            font-size: 24px;
            font-weight: 800;
            color: #1a1f2e;
            margin-bottom: 6px;
        }

        .login-right .subtitle {
            color: #6b7280;
            font-size: 14px;
            margin-bottom: 35px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 7px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper input {
            width: 100%;
            padding: 12px 16px;
            border: 1.5px solid #e5e7eb;
            border-radius: 8px;
            font-size: 14px;
            color: #1a1f2e;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
            font-family: inherit;
        }

        .input-wrapper input:focus {
            border-color: #4a6cf7;
            box-shadow: 0 0 0 3px rgba(74,108,247,0.1);
        }

        .toggle-password {
            position: absolute;
            right: 14px; top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #9ca3af;
            font-size: 13px;
            user-select: none;
        }

        .toggle-password:hover { color: #4a6cf7; }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fca5a5;
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .login-btn {
            width: 100%;
            padding: 13px;
            background: #4a6cf7;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.2s, transform 0.1s;
            font-family: inherit;
            margin-top: 5px;
        }

        .login-btn:hover {
            background: #3a5ce5;
            transform: translateY(-1px);
        }

        .login-btn:active { transform: translateY(0); }

        .login-footer {
            margin-top: 25px;
            text-align: center;
            font-size: 13px;
            color: #9ca3af;
        }

        .login-footer a {
            color: #4a6cf7;
            text-decoration: none;
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 25px 0;
        }

        .divider hr {
            flex: 1;
            border: none;
            border-top: 1px solid #e5e7eb;
        }

        .divider span {
            font-size: 12px;
            color: #9ca3af;
        }

        .credentials-box {
            background: #f8f9fb;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 12px 16px;
            font-size: 12px;
            color: #6b7280;
        }

        .credentials-box strong { color: #374151; }

        @media (max-width: 640px) {
            .login-left { display: none; }
            .login-right { padding: 40px 25px; }
            .login-wrapper { margin: 15px; }
        }
    </style>
</head>
<body>

<div class="login-wrapper">

    <!-- Left Panel -->
    <div class="login-left">
        <div class="brand">
            <div class="brand-icon">B</div>
            <span class="brand-name">BlogYaari</span>
        </div>

        <h1>Welcome back, Admin</h1>
        <p>Manage your blog content, categories and more from one place.</p>

        <ul class="feature-list">
            <li><span class="dot"></span> Add, edit and delete blog posts</li>
            <li><span class="dot"></span> Manage categories</li>
            <li><span class="dot"></span> Rich text content editor</li>
            <li><span class="dot"></span> Image upload support</li>
            <li><span class="dot"></span> Live filtering and search</li>
        </ul>
    </div>

    <!-- Right Panel -->
    <div class="login-right">

        <h2>Sign in</h2>
        <p class="subtitle">Enter your credentials to access the admin panel</p>

        @if(session('error'))
            <div class="alert-error">
                <span>&#10007;</span> {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="/admin/login">
            @csrf

            <div class="form-group">
                <label for="email">Email Address</label>
                <div class="input-wrapper">
                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="admin@blog.com"
                        value="{{ old('email') }}"
                        required
                        autofocus
                    >
                </div>
                @error('email')
                    <div style="color:#ef4444;font-size:12px;margin-top:4px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-wrapper">
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Enter your password"
                        required
                    >
                    <span
                        class="toggle-password"
                        onclick="togglePass()"
                        id="toggle-label"
                    >Show</span>
                </div>
                @error('password')
                    <div style="color:#ef4444;font-size:12px;margin-top:4px;">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="login-btn">Sign In</button>
        </form>

        <div class="divider">
            <hr><span>default credentials</span><hr>
        </div>

        <div class="credentials-box">
            <strong>Email:</strong> admin@blog.com &nbsp;|&nbsp;
            <strong>Password:</strong> admin123
        </div>

        <div class="login-footer">
            <a href="/blogs">Go to website</a>
        </div>

    </div>
</div>

<script>
    function togglePass() {
        var input = document.getElementById('password');
        var label = document.getElementById('toggle-label');
        if (input.type === 'password') {
            input.type = 'text';
            label.textContent = 'Hide';
        } else {
            input.type = 'password';
            label.textContent = 'Show';
        }
    }
</script>

</body>
</html>