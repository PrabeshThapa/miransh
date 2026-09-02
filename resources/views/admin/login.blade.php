@extends('layouts.admin')

@section('title', 'AdminLTE Login | MIRANSH LLC')
@section('body_class', 'hold-transition login-page')

@push('styles')
<style>
    .login-page {
        background: linear-gradient(135deg, #0A1E3F 0%, #0F2C59 100%) !important;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .login-box {
        width: 440px;
    }
    @media (max-width: 576px) {
        .login-box { width: 90%; }
    }
</style>
@endpush

@section('content')
<div class="login-box">
    <div class="card card-outline card-primary shadow-lg">
        <div class="card-header text-center py-3 bg-white position-relative">
            <!-- Language toggle in login card -->
            <div class="position-absolute" style="top: 10px; right: 12px;">
                <div class="btn-group btn-group-sm" role="group">
                    <button type="button" class="btn btn-xs btn-primary font-weight-bold" id="btn-login-ja" onclick="setLoginLang('ja')">🇯🇵 日本語</button>
                    <button type="button" class="btn btn-xs btn-light font-weight-bold" id="btn-login-en" onclick="setLoginLang('en')">🇺🇸 EN</button>
                </div>
            </div>

            <a href="/" class="h1 font-weight-bold text-dark text-decoration-none mt-2 d-inline-block">
                <img src="/images/logo-icon.png" alt="MIRANSH Logo" class="brand-image img-circle elevation-2 mr-2" style="width: 38px; height: 38px; vertical-align: middle;">
                <span class="text-primary">MIRANSH</span> <small class="text-muted font-weight-light" style="font-size: 18px;">AdminLTE</small>
            </a>
            <div class="text-muted text-xs mt-1">
                <span class="admin-lang-ja">国際人材ソリューション・特定技能 管理ポータル</span>
                <span class="admin-lang-en">International HR & SSW Management Portal</span>
            </div>
        </div>
        <div class="card-body login-card-body">
            <p class="login-box-msg text-secondary text-sm">
                <span class="admin-lang-ja">管理者アカウントでログインしてください</span>
                <span class="admin-lang-en">Sign in to start your administrator session</span>
            </p>

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
                    <div class="col-7">
                        <div class="icheck-primary d-flex align-items-center">
                            <input type="checkbox" id="remember" checked>
                            <label for="remember" class="text-sm font-weight-normal text-muted ml-2 mb-0">
                                <span class="admin-lang-ja">ログイン情報を記憶</span>
                                <span class="admin-lang-en">Remember Me</span>
                            </label>
                        </div>
                    </div>
                    <div class="col-5">
                        <button type="submit" class="btn btn-primary btn-block font-weight-bold">
                            <i class="fas fa-sign-in-alt mr-1"></i>
                            <span class="admin-lang-ja">ログイン</span>
                            <span class="admin-lang-en">Log In</span>
                        </button>
                    </div>
                </div>
            </form>

            <div class="text-center mt-3 pt-3 border-top">
                <a href="/" class="text-secondary text-sm text-decoration-none">
                    <i class="fas fa-arrow-left mr-1"></i>
                    <span class="admin-lang-ja">公開ホームページへ戻る</span>
                    <span class="admin-lang-en">Back to Public Website</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function setLoginLang(lang) {
        localStorage.setItem('miransh_admin_lang', lang);
        document.documentElement.setAttribute('data-admin-lang', lang);
        const btnJa = document.getElementById('btn-login-ja');
        const btnEn = document.getElementById('btn-login-en');
        if (btnJa && btnEn) {
            if (lang === 'ja') {
                btnJa.className = 'btn btn-xs btn-primary font-weight-bold';
                btnEn.className = 'btn btn-xs btn-light font-weight-bold';
            } else {
                btnEn.className = 'btn btn-xs btn-primary font-weight-bold';
                btnJa.className = 'btn btn-xs btn-light font-weight-bold';
            }
        }
    }
    (function() {
        const savedLang = localStorage.getItem('miransh_admin_lang') || 'ja';
        setLoginLang(savedLang);
    })();
</script>
@endpush
