<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AdminLTE Login | MIRANSH LLC</title>
    <link rel="icon" type="image/png" href="/images/logo-icon.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <style>
        .login-page {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            min-height: 100vh;
        }
        .login-box {
            width: 420px;
        }
        @media (max-width: 576px) {
            .login-box { width: 90%; }
        }
    </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="card card-outline card-primary shadow-lg">
        <div class="card-header text-center py-3 bg-white">
            <a href="/" class="h1 font-weight-bold text-dark text-decoration-none">
                <img src="/images/logo-icon.png" alt="MIRANSH Logo" class="brand-image img-circle elevation-2 mr-2" style="width: 38px; height: 38px; vertical-align: middle;">
                <span class="text-primary">MIRANSH</span> <small class="text-muted font-weight-light" style="font-size: 18px;">AdminLTE</small>
            </a>
            <div class="text-muted text-xs mt-1">International HR & Student Support System</div>
        </div>
        <div class="card-body login-card-body">
            <p class="login-box-msg text-secondary text-sm">Sign in to start your administrator session</p>

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show text-sm py-2">
                    <i class="icon fas fa-ban mr-1"></i> {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('admin.login.submit', [], false) }}" method="POST">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" name="email" class="form-control" placeholder="Email / Username" value="admin@miransh.jp" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>

                <div class="callout callout-info py-2 px-3 mb-3 bg-light">
                    <h6 class="text-xs font-weight-bold text-info mb-1"><i class="fas fa-info-circle mr-1"></i> Demo Credentials:</h6>
                    <p class="text-xs text-muted mb-0">Email: <code>admin@miransh.jp</code> | Pass: <code>password</code> or <code>admin123</code></p>
                </div>

                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary d-flex align-items-center">
                            <input type="checkbox" id="remember" checked>
                            <label for="remember" class="text-sm font-weight-normal text-muted ml-2 mb-0">
                                Remember Me
                            </label>
                        </div>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block font-weight-bold">
                            <i class="fas fa-sign-in-alt mr-1"></i> Log In
                        </button>
                    </div>
                </div>
            </form>

            <div class="text-center mt-3 pt-3 border-top">
                <a href="/" class="text-secondary text-sm text-decoration-none">
                    <i class="fas fa-arrow-left mr-1"></i> Back to Public Website
                </a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>
</html>
