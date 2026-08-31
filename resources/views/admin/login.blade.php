<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | MIRANSH LLC</title>
    <link rel="icon" type="image/png" href="/images/logo-icon.png">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        .admin-login-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #f0f4f8 0%, #e2e8f0 100%);
            padding: 20px;
        }
        .login-card {
            background: #ffffff;
            width: 100%;
            max-width: 440px;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 10px 25px -5px rgba(15, 76, 129, 0.1), 0 8px 10px -6px rgba(15, 76, 129, 0.05);
            border: 1px solid #e2e8f0;
        }
        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .login-header .brand-badge {
            display: inline-block;
            font-size: 24px;
            font-weight: 800;
            color: #0f4c81;
            margin-bottom: 8px;
        }
        .login-header .brand-badge span {
            color: #d97706;
        }
        .login-header h1 {
            font-size: 20px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 4px;
        }
        .login-header p {
            font-size: 14px;
            color: #64748b;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #334155;
            margin-bottom: 6px;
        }
        .form-control {
            width: 100%;
            padding: 12px 14px;
            font-size: 15px;
            border: 1.5px solid #cbd5e1;
            border-radius: 8px;
            outline: none;
            transition: all 0.2s;
            background: #f8fafc;
        }
        .form-control:focus {
            border-color: #0f4c81;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(15, 76, 129, 0.15);
        }
        .btn-submit {
            width: 100%;
            padding: 13px;
            background: #0f4c81;
            color: #ffffff;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        .btn-submit:hover {
            background: #0a365c;
        }
        .alert-danger {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 14px;
            margin-bottom: 20px;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 24px;
            font-size: 14px;
            color: #64748b;
            text-decoration: none;
        }
        .back-link:hover {
            color: #0f4c81;
            text-decoration: underline;
        }
        .hint-box {
            margin-top: 24px;
            padding: 12px;
            background: #f1f5f9;
            border-radius: 8px;
            font-size: 13px;
            color: #475569;
            line-height: 1.5;
        }
        .hint-box strong {
            color: #0f4c81;
        }
    </style>
</head>
<body>
    <div class="admin-login-wrapper">
        <div class="login-card">
            <div class="login-header">
                <div style="display: flex; justify-content: center; margin-bottom: 14px;">
                    <img src="/images/logo-icon.png" alt="MIRANSH LLC" style="width: 56px; height: 56px; border-radius: 50%; box-shadow: 0 6px 16px rgba(15, 44, 89, 0.25);">
                </div>
                <div class="brand-badge">MIRANSH <span>LLC</span></div>
                <h1>Admin Control Panel</h1>
                <p>Sign in to edit Services, About, & Company Info</p>
            </div>

            @if($errors->any())
                <div class="alert-danger">
                    ⚠️ {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('admin.login.submit', [], false) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email">Username or Email</label>
                    <input type="text" id="email" name="email" class="form-control" required placeholder="admin@miransh.jp" value="{{ old('email', 'admin@miransh.jp') }}" autofocus>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" required placeholder="••••••••" value="admin123">
                </div>

                <button type="submit" class="btn-submit">
                    Sign In to Dashboard →
                </button>
            </form>

            <!-- <div class="hint-box">
                🔑 <strong>Default Admin Credentials:</strong><br>
                Username: <code>admin@miransh.jp</code> &nbsp;|&nbsp; Password: <code>admin123</code>
            </div> -->

            <a href="{{ route('home') }}" class="back-link">← Return to Website</a>
        </div>
    </div>
</body>
</html>
