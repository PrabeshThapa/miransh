@php
    $currLang = strtolower(request()->query('lang', request()->cookie('admin_lang', session('admin_lang', 'ja'))));
    if (!in_array($currLang, ['ja', 'en'])) $currLang = 'ja';
    $isEn = ($currLang === 'en');
@endphp
<!DOCTYPE html>
<html lang="{{ $currLang }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MIRANSH LLC | @yield('title', $isEn ? 'Admin Portal' : '管理ポータル') - AdminLTE 3</title>
    <link rel="icon" type="image/png" href="/images/logo-icon.png">
    
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- AdminLTE 3 CSS (Local fallback to CDN) -->
    <link rel="stylesheet" href="/adminlte/css/adminlte.min.css" onerror="this.onerror=null;this.href='https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css'">
    
    <style>
        .brand-link {
            background-color: #0c1a2f !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
        }
        .main-sidebar {
            background-color: #0b1526 !important;
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
        }
        .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active,
        .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active:hover {
            background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%) !important;
            color: #ffffff !important;
            box-shadow: 0 4px 12px rgba(13, 110, 253, 0.35);
            font-weight: 600;
        }
        .nav-sidebar .nav-link {
            border-radius: 6px;
            margin-bottom: 2px;
            font-size: 0.9rem;
            color: #c2c7d0;
            transition: all 0.15s ease-in-out;
        }
        .nav-sidebar .nav-link:hover {
            color: #ffffff;
            background-color: rgba(255, 255, 255, 0.08);
        }
        .nav-sidebar .nav-header {
            color: #6c757d;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            padding: 0.8rem 1rem 0.3rem;
        }
        .content-wrapper {
            background-color: #f4f6f9;
        }
        .main-header {
            border-bottom: 1px solid #dee2e6;
        }
        .card {
            border-radius: 8px;
            box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.08);
            border: 1px solid rgba(0,0,0,0.06);
            margin-bottom: 1.25rem;
        }
        .card-header {
            background-color: #ffffff;
            border-bottom: 1px solid rgba(0,0,0,0.06);
            padding: 0.85rem 1.25rem;
        }
        .card-title {
            font-size: 1.05rem;
            font-weight: 600;
        }
        .small-box {
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            overflow: hidden;
        }
        .upload-dropzone {
            border: 2px dashed #cbd5e1;
            border-radius: 8px;
            padding: 24px;
            text-align: center;
            background: #f8fafc;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .upload-dropzone:hover {
            border-color: #0d6efd;
            background: #f0f7ff;
        }
        .preview-img {
            max-height: 180px;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid #e2e8f0;
        }
        .lang-toggle-group {
            display: inline-flex;
            align-items: center;
            background: #F1F5F9;
            border: 1px solid #CBD5E1;
            border-radius: 9999px;
            padding: 2px;
            flex-shrink: 0;
        }
        .lang-btn {
            border: none;
            background: transparent;
            padding: 4px 12px;
            font-size: 12px;
            font-weight: 700;
            color: #64748B;
            border-radius: 9999px;
            cursor: pointer;
            transition: all 0.2s ease;
            white-space: nowrap;
            line-height: 1.4;
            text-decoration: none !important;
        }
        .lang-btn:hover {
            color: #0F2C59;
        }
        .lang-btn.active {
            background: #0d6efd;
            color: #FFFFFF !important;
            box-shadow: 0 2px 4px rgba(13, 110, 253, 0.25);
        }
    </style>
    @stack('styles')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button" title="{{ $isEn ? 'Toggle Menu' : 'メニュー開閉' }}">
                    <i class="fas fa-bars"></i>
                </a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('admin.dashboard', ['lang' => $currLang]) }}" class="nav-link font-weight-bold">{{ $isEn ? 'Admin Home' : '管理ホーム' }}</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="/" target="_blank" class="nav-link text-primary" title="{{ $isEn ? 'Open Public Site in New Tab' : '別タブで公開サイトを開く' }}">
                    <i class="fas fa-external-link-alt mr-1"></i>{{ $isEn ? 'View Public Site' : '公開サイト表示' }}
                </a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto align-items-center">
            <!-- Language Switcher Component (Frontend Exact Matching Toggle) -->
            <li class="nav-item d-flex align-items-center mr-3" id="admin-lang-switcher-component">
                <div class="lang-toggle-group" id="admin-lang-toggle" role="group" aria-label="Language Switcher">
                    <button type="button"
                            id="btn-lang-ja"
                            class="lang-btn {{ $currLang === 'ja' ? 'active' : '' }}"
                            onclick="switchAdminLanguage('ja', event)"
                            title="日本語 (Japanese / NP)"
                            aria-pressed="{{ $currLang === 'ja' ? 'true' : 'false' }}">
                        日本語
                    </button>
                    <button type="button"
                            id="btn-lang-en"
                            class="lang-btn {{ $currLang === 'en' ? 'active' : '' }}"
                            onclick="switchAdminLanguage('en', event)"
                            title="English (EN)"
                            aria-pressed="{{ $currLang === 'en' ? 'true' : 'false' }}">
                        EN
                    </button>
                </div>
            </li>

            <!-- Inquiries Notifications Dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#" title="{{ $isEn ? 'Inquiry Notifications' : '通知' }}">
                    <i class="far fa-bell"></i>
                    @if(($unreadCount ?? 0) > 0)
                        <span class="badge badge-danger navbar-badge font-weight-bold">{{ $unreadCount }}</span>
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-header font-weight-bold">{{ $isEn ? ($unreadCount ?? 0) . ' Pending Inquiries' : ($unreadCount ?? 0) . ' 件の未対応お問い合わせ' }}</span>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('admin.inquiries') }}" class="dropdown-item">
                        <i class="fas fa-envelope mr-2 text-primary"></i> {{ $isEn ? 'View All Inquiries' : 'お問い合わせ一覧へ' }}
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('admin.inquiries', ['status' => 'unread']) }}" class="dropdown-item dropdown-footer">{{ $isEn ? 'View Unread Only' : '未読のお問い合わせを表示' }}</a>
                </div>
            </li>

            <!-- User Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fas fa-user-circle fa-lg text-secondary"></i>
                    <span class="ml-1 d-none d-md-inline font-weight-bold">{{ Auth::user()->name ?? 'Administrator' }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-md dropdown-menu-right shadow border-0">
                    <div class="dropdown-item bg-light text-center py-2">
                        <div class="font-weight-bold text-dark">{{ Auth::user()->name ?? ($isEn ? 'Administrator' : '管理者') }}</div>
                        <small class="text-muted"><i class="fas fa-shield-alt text-success mr-1"></i>{{ $isEn ? 'Super Admin' : '特権管理者' }}</small>
                    </div>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('admin.password') }}" class="dropdown-item">
                        <i class="fas fa-key mr-2 text-warning"></i> {{ $isEn ? 'Change Password' : 'パスワード変更' }}
                    </a>
                    <a href="{{ route('admin.company') }}" class="dropdown-item">
                        <i class="fas fa-cog mr-2 text-secondary"></i> {{ $isEn ? 'Company Settings' : '会社設定' }}
                    </a>
                    <div class="dropdown-divider"></div>
                    <form action="{{ route('admin.logout') }}" method="POST" class="m-0 p-0">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger font-weight-bold">
                            <i class="fas fa-sign-out-alt mr-2"></i> {{ $isEn ? 'Log Out' : 'ログアウト' }}
                        </button>
                    </form>
                </div>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{ route('admin.dashboard') }}" class="brand-link">
            <img src="/images/logo-icon.png" alt="MIRANSH Logo" class="brand-image img-circle elevation-3" style="opacity: .95">
            <span class="brand-text font-weight-bold text-white">MIRANSH <span class="text-warning">ADMIN</span></span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
                <div class="image">
                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 34px; height: 34px; font-size: 14px; font-weight: bold;">
                        <i class="fas fa-user-shield"></i>
                    </div>
                </div>
                <div class="info">
                    <a href="{{ route('admin.password') }}" class="d-block font-weight-bold text-light">
                        {{ Auth::user()->name ?? 'Administrator' }}
                    </a>
                    <span class="badge badge-success text-xs py-0 px-1 font-weight-normal">{{ $isEn ? 'Online' : 'ログイン中' }}</span>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard', ['lang' => $currLang]) }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>{{ $isEn ? 'Dashboard Overview' : 'ダッシュボード概要' }}</p>
                        </a>
                    </li>

                    <li class="nav-header">{{ $isEn ? 'CONTENT & PR MANAGEMENT' : 'コンテンツ・広報管理' }}</li>
                    <li class="nav-item">
                        <a href="{{ route('admin.company', ['lang' => $currLang]) }}" class="nav-link {{ request()->routeIs('admin.company') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-building"></i>
                            <p>{{ $isEn ? 'Company & Images' : '会社情報・画像設定' }}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.about', ['lang' => $currLang]) }}" class="nav-link {{ request()->routeIs('admin.about') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-handshake"></i>
                            <p>{{ $isEn ? 'Corporate Philosophy' : '企業理念・メッセージ' }}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.services', ['lang' => $currLang]) }}" class="nav-link {{ request()->routeIs('admin.services') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-briefcase"></i>
                            <p>{{ $isEn ? 'Services Management' : '提供サービス管理' }}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/vacancies?lang={{ $currLang }}" class="nav-link {{ request()->is('admin/vacancies*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-tie"></i>
                            <p>{{ $isEn ? 'Job Vacancies' : '自社求人情報管理' }}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.stories', ['lang' => $currLang]) }}" class="nav-link {{ request()->routeIs('admin.stories') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-newspaper"></i>
                            <p>{{ $isEn ? 'Stories & Case Studies' : '採用事例・実績管理' }}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.faqs', ['lang' => $currLang]) }}" class="nav-link {{ request()->routeIs('admin.faqs') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-question-circle"></i>
                            <p>{{ $isEn ? 'FAQ Management' : 'よくある質問管理' }}</p>
                        </a>
                    </li>

                    <li class="nav-header">{{ $isEn ? 'COMMUNICATION' : 'コミュニケーション' }}</li>
                    <li class="nav-item">
                        <a href="{{ route('admin.inquiries', ['lang' => $currLang]) }}" class="nav-link {{ request()->routeIs('admin.inquiries') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-envelope"></i>
                            <p>
                                {{ $isEn ? 'Inquiry Inbox' : 'お問い合わせ管理' }}
                                @if(($unreadCount ?? 0) > 0)
                                    <span class="badge badge-danger right">{{ $unreadCount }}</span>
                                @endif
                            </p>
                        </a>
                    </li>

                    <li class="nav-header">{{ $isEn ? 'SYSTEM & SECURITY' : 'システム & セキュリティ' }}</li>
                    <li class="nav-item">
                        <a href="{{ route('admin.password', ['lang' => $currLang]) }}" class="nav-link {{ request()->routeIs('admin.password') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-key"></i>
                            <p>{{ $isEn ? 'Change Password' : '管理者パスワード変更' }}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.ai', ['lang' => $currLang]) }}" class="nav-link {{ request()->routeIs('admin.ai') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-robot"></i>
                            <p>{{ $isEn ? 'Sakana AI Diagnostics' : 'Sakana AI 設定・診断' }}</p>
                        </a>
                    </li>
                    <li class="nav-item mt-3">
                        <form action="{{ route('admin.logout') }}" method="POST" class="m-0 p-0">
                            @csrf
                            <button type="submit" class="nav-link btn btn-block btn-outline-danger text-left border-0" style="background: rgba(220, 53, 69, 0.15); color: #ff8b94 !important;">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>{{ $isEn ? 'Log Out' : 'ログアウト' }}</p>
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2 align-items-center">
                    <div class="col-sm-6">
                        <h4 class="m-0 font-weight-bold text-dark">
                            @yield('page_title', $isEn ? 'Dashboard' : 'ダッシュボード')
                        </h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right mb-0 text-xs">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ $isEn ? 'Admin Home' : '管理ホーム' }}</a></li>
                            @yield('breadcrumb')
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Flash Alerts -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show shadow-sm mb-3" role="alert">
                        <i class="fas fa-check-circle mr-2"></i>
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show shadow-sm mb-3" role="alert">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show shadow-sm mb-3" role="alert">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        <strong>{{ $isEn ? 'Please review the following errors:' : '入力内容をご確認ください：' }}</strong>
                        <ul class="mb-0 mt-1 pl-3 text-sm">
                            @foreach($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @yield('content')
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer text-sm py-2">
        <div class="float-right d-none d-sm-inline">
            <span class="text-muted">MIRANSH Management Portal</span>
        </div>
        <strong>Copyright &copy; {{ date('Y') }} <a href="/" target="_blank">MIRANSH LLC</a>.</strong> All rights reserved.
    </footer>
</div>
<!-- ./wrapper -->

@stack('modals')

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/adminlte/js/adminlte.min.js" onerror="this.onerror=null;this.src='https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js'"></script>

<script>
function switchAdminLanguage(newLang, e) {
    if (e) {
        e.preventDefault();
        e.stopPropagation();
    }

    var btnJa = document.getElementById('btn-lang-ja');
    var btnEn = document.getElementById('btn-lang-en');
    if (btnJa && btnEn) {
        if (newLang === 'ja') {
            btnJa.className = 'lang-btn active';
            btnEn.className = 'lang-btn';
            btnJa.setAttribute('aria-pressed', 'true');
            btnEn.setAttribute('aria-pressed', 'false');
        } else {
            btnEn.className = 'lang-btn active';
            btnJa.className = 'lang-btn';
            btnEn.setAttribute('aria-pressed', 'true');
            btnJa.setAttribute('aria-pressed', 'false');
        }
    }

    try {
        localStorage.setItem('admin_lang', newLang);
        localStorage.setItem('miransh_language', newLang);
        sessionStorage.setItem('admin_lang', newLang);
        document.cookie = 'admin_lang=' + newLang + '; path=/; max-age=31536000; SameSite=None; Secure';
        document.cookie = 'admin_lang=' + newLang + '; path=/; max-age=31536000; SameSite=Lax';
    } catch(err) {}

    var currentUrl = new URL(window.location.href);
    var path = currentUrl.pathname;

    if (path.indexOf('/admin/en/') === 0) {
        path = '/admin/' + newLang + '/' + path.substring(10);
    } else if (path === '/admin/en') {
        path = '/admin/' + newLang;
    } else if (path.indexOf('/admin/ja/') === 0) {
        path = '/admin/' + newLang + '/' + path.substring(10);
    } else if (path === '/admin/ja') {
        path = '/admin/' + newLang;
    } else if (path.indexOf('/en/admin') === 0) {
        path = '/' + newLang + path.substring(3);
    } else if (path.indexOf('/ja/admin') === 0) {
        path = '/' + newLang + path.substring(3);
    }

    currentUrl.pathname = path;
    currentUrl.searchParams.set('lang', newLang);
    var targetHref = currentUrl.toString();

    try {
        window.dispatchEvent(new CustomEvent('adminLanguageChanged', { detail: { lang: newLang } }));
    } catch(err) {}

    fetch('/admin/api/set-lang?lang=' + newLang, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ lang: newLang }),
        credentials: 'include'
    })
    .catch(function() {
        return fetch('/admin/lang/' + newLang, { credentials: 'include' });
    })
    .catch(function() {})
    .finally(function() {
        window.location.href = targetHref;
    });
}
window.setAdminLang = switchAdminLanguage;

// Sticky auto-propagator across admin panel tabs and links
(function() {
    var currentLang = '{{ $currLang }}';

    try {
        var stored = localStorage.getItem('admin_lang') || localStorage.getItem('miransh_language');
        if (stored && (stored === 'en' || stored === 'ja')) {
            var u = new URL(window.location.href);
            if (!u.searchParams.has('lang') && stored !== currentLang) {
                u.searchParams.set('lang', stored);
                window.location.replace(u.toString());
                return;
            }
        }
    } catch(e) {}

    document.addEventListener('click', function(evt) {
        var a = evt.target && evt.target.closest ? evt.target.closest('a') : null;
        if (!a || !a.href) return;
        try {
            var targetUrl = new URL(a.href, window.location.origin);
            if (targetUrl.origin === window.location.origin && 
                targetUrl.pathname.indexOf('/admin') === 0 && 
                !targetUrl.pathname.includes('/logout') && 
                !targetUrl.pathname.includes('/api/')) {
                if (!targetUrl.searchParams.has('lang')) {
                    targetUrl.searchParams.set('lang', currentLang);
                    a.href = targetUrl.toString();
                }
            }
        } catch(err) {}
    }, true);

    document.addEventListener('submit', function(evt) {
        var form = evt.target;
        if (!form || !form.action) return;
        try {
            var targetUrl = new URL(form.action, window.location.origin);
            if (targetUrl.origin === window.location.origin && 
                targetUrl.pathname.indexOf('/admin') === 0 && 
                !targetUrl.pathname.includes('/logout')) {
                if (!targetUrl.searchParams.has('lang')) {
                    targetUrl.searchParams.set('lang', currentLang);
                    form.action = targetUrl.toString();
                }
                if (!form.querySelector('input[name="lang"]') && !form.querySelector('input[name="admin_lang"]')) {
                    var hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = 'lang';
                    hiddenInput.value = currentLang;
                    form.appendChild(hiddenInput);
                }
            }
        } catch(err) {}
    }, true);
})();
</script>

@stack('scripts')
</body>
</html>
