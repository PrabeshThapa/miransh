<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MIRANSH LLC | 管理者ログイン - AdminLTE 3</title>
    <link rel="icon" type="image/png" href="/images/logo-icon.png">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.min.css">
    <!-- AdminLTE 3 CSS -->
    <link rel="stylesheet" href="/adminlte/css/adminlte.min.css" onerror="this.onerror=null;this.href='https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css'">

    <style>
        body.login-page {
            background: linear-gradient(135deg, #0c1a2f 0%, #172a45 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-box {
            width: 420px;
            max-width: 95%;
        }
        .card-primary.card-outline {
            border-top: 4px solid #0d6efd;
            border-radius: 12px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.35);
        }
        .login-logo a {
            color: #ffffff;
            font-weight: 800;
            letter-spacing: -0.5px;
            text-shadow: 0 2px 8px rgba(0,0,0,0.5);
        }
        .btn-primary {
            background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
            border: none;
            box-shadow: 0 4px 12px rgba(13, 110, 253, 0.35);
        }
    </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <!-- Logo -->
    <div class="login-logo mb-3 text-center">
        <a href="/">
            <img src="/images/logo-icon.png" alt="MIRANSH" style="width: 42px; height: 42px; vertical-align: middle; margin-right: 8px;">
            <b>MIRANSH</b> <span class="text-warning">ADMIN</span>
        </a>
        <div class="text-xs text-light mt-1" style="opacity: 0.85;">ミランス合同会社 管理統括コンソール</div>
    </div>

    <!-- Login Card -->
    <div class="card card-outline card-primary">
        <div class="card-header text-center py-3 bg-white">
            <h5 class="mb-0 font-weight-bold text-dark">
                <i class="fas fa-lock text-primary mr-2"></i>管理者認証
            </h5>
            <small class="text-muted">管理アカウントでログインしてください</small>
        </div>

        <div class="card-body login-card-body p-4">
            @if(session('error') || $errors->any())
                <div class="alert alert-danger py-2 px-3 text-sm mb-3">
                    <i class="fas fa-exclamation-circle mr-1"></i>
                    {{ session('error') ?? $errors->first() ?? 'ログイン認証に失敗しました。' }}
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success py-2 px-3 text-sm mb-3">
                    <i class="fas fa-check-circle mr-1"></i>
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('admin.login.submit') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label class="text-xs font-weight-bold text-secondary mb-1">メールアドレス または ユーザー名</label>
                    <div class="input-group">
                        <input type="text" name="email" class="form-control" placeholder="admin@miransh.jp または admin" value="{{ old('email', 'admin@miransh.jp') }}" required autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope text-secondary"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group mb-4">
                    <label class="text-xs font-weight-bold text-secondary mb-1">パスワード</label>
                    <div class="input-group">
                        <input type="password" name="password" class="form-control" placeholder="パスワードを入力" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock text-secondary"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row align-items-center mb-3">
                    <div class="col-7">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember" name="remember" checked>
                            <label for="remember" class="text-xs text-muted font-weight-normal">
                                ログイン状態を保持
                            </label>
                        </div>
                    </div>
                    <div class="col-5">
                        <button type="submit" class="btn btn-primary btn-block font-weight-bold">
                            <i class="fas fa-sign-in-alt mr-1"></i> ログイン
                        </button>
                    </div>
                </div>
            </form>

            <div class="callout callout-info p-2 mt-3 text-xs bg-light">
                <i class="fas fa-info-circle text-info mr-1"></i>
                <strong>初期アカウント情報:</strong><br>
                ユーザー名: <code>admin</code> (または <code>admin@miransh.jp</code>)<br>
                初期パスワード: <code>admin123</code> (または <code>admin</code>)
            </div>

            <div class="text-center mt-3 pt-2 border-top">
                <a href="/" class="text-xs text-muted">
                    <i class="fas fa-arrow-left mr-1"></i> 公開Webサイトへ戻る
                </a>
            </div>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
