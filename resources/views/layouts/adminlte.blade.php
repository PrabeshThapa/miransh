<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MIRANSH LLC | @yield('title', '管理ポータル') - AdminLTE 3</title>
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
                <a class="nav-link" data-widget="pushmenu" href="#" role="button" title="メニュー開閉">
                    <i class="fas fa-bars"></i>
                </a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('admin.dashboard') }}" class="nav-link font-weight-bold">管理ホーム</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="/" target="_blank" class="nav-link text-primary" title="別タブで公開サイトを開く">
                    <i class="fas fa-external-link-alt mr-1"></i>公開サイト表示
                </a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto align-items-center">
            <!-- Language Switcher Component (Bilingual Enterprise Switcher) -->
            @php
                $currLang = strtolower(request()->query('lang', request()->cookie('admin_lang', session('admin_lang', 'ja'))));
                if (!in_array($currLang, ['ja', 'en'])) $currLang = 'ja';
            @endphp
            <li class="nav-item d-flex align-items-center mr-3" id="admin-lang-switcher-component">
                <!-- 1-Click Segmented Toggle Pill (Desktop & Tablet) -->
                <div class="admin-lang-switcher d-none d-sm-inline-flex border rounded-pill overflow-hidden bg-light shadow-xs p-1" role="group" aria-label="Bilingual Language Switcher">
                    <button type="button"
                            id="btn-lang-ja"
                            class="btn btn-xs font-weight-bold px-2 py-1 rounded-pill {{ $currLang === 'ja' ? 'btn-primary active text-white shadow-xs' : 'btn-light text-muted' }}"
                            onclick="switchAdminLanguage('ja', event)"
                            title="日本語に切り替え (Japanese)"
                            aria-pressed="{{ $currLang === 'ja' ? 'true' : 'false' }}">
                        <span class="mr-1">🇯🇵</span><span>日本語</span>
                    </button>
                    <button type="button"
                            id="btn-lang-en"
                            class="btn btn-xs font-weight-bold px-2 py-1 rounded-pill {{ $currLang === 'en' ? 'btn-primary active text-white shadow-xs' : 'btn-light text-muted' }}"
                            onclick="switchAdminLanguage('en', event)"
                            title="Switch to English (英語)"
                            aria-pressed="{{ $currLang === 'en' ? 'true' : 'false' }}">
                        <span class="mr-1">🇬🇧</span><span>English</span>
                    </button>
                </div>

                <!-- Dropdown Details Switcher (For mobile & dropdown context) -->
                <div class="dropdown ml-1">
                    <a class="nav-link dropdown-toggle btn btn-xs btn-outline-secondary d-flex align-items-center py-1 px-2 font-weight-bold text-dark rounded-pill border shadow-xs"
                       data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"
                       title="Language Switcher Menu / 言語切り替えメニュー ({{ $currLang === 'en' ? 'English' : '日本語' }})">
                        <i class="fas fa-globe text-primary mr-1"></i>
                        <span class="badge badge-pill {{ $currLang === 'en' ? 'badge-primary' : 'badge-dark' }} text-xs font-weight-bold px-1 py-0">{{ strtoupper($currLang) }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow border-0 p-2" style="min-width: 230px; border-radius: 10px;">
                        <div class="dropdown-header text-xs text-uppercase font-weight-bold text-muted px-2 py-1 d-flex align-items-center justify-content-between">
                            <span><i class="fas fa-language mr-1 text-primary"></i>{{ $currLang === 'en' ? 'Language Switcher' : '言語切り替え' }}</span>
                            <span class="badge badge-light border">{{ $currLang === 'en' ? 'Live Context' : '状態保持' }}</span>
                        </div>
                        <div class="dropdown-divider my-1"></div>
                        <a href="/admin/lang/ja"
                           class="dropdown-item rounded d-flex align-items-center justify-content-between py-2 px-2 {{ $currLang === 'ja' ? 'active font-weight-bold' : '' }}"
                           onclick="switchAdminLanguage('ja', event)">
                            <div class="d-flex align-items-center">
                                <span class="mr-2" style="font-size: 1.2rem;">🇯🇵</span>
                                <div>
                                    <div class="font-weight-bold">日本語</div>
                                    <small class="{{ $currLang === 'ja' ? 'text-white-50' : 'text-muted' }}">Japanese (JA)</small>
                                </div>
                            </div>
                            {!! $currLang === 'ja' ? '<i class="fas fa-check-circle text-white"></i>' : '<span class="badge badge-light border text-xs">切替</span>' !!}
                        </a>
                        <a href="/admin/lang/en"
                           class="dropdown-item rounded d-flex align-items-center justify-content-between py-2 px-2 mt-1 {{ $currLang === 'en' ? 'active font-weight-bold' : '' }}"
                           onclick="switchAdminLanguage('en', event)">
                            <div class="d-flex align-items-center">
                                <span class="mr-2" style="font-size: 1.2rem;">🇬🇧</span>
                                <div>
                                    <div class="font-weight-bold">English</div>
                                    <small class="{{ $currLang === 'en' ? 'text-white-50' : 'text-muted' }}">英語 (EN)</small>
                                </div>
                            </div>
                            {!! $currLang === 'en' ? '<i class="fas fa-check-circle text-white"></i>' : '<span class="badge badge-light border text-xs">Switch</span>' !!}
                        </a>
                        <div class="dropdown-divider my-2"></div>
                        <div class="px-2 py-1 text-xs text-muted d-flex align-items-center">
                            <i class="fas fa-shield-alt text-success mr-2"></i>
                            <span>{{ $currLang === 'en' ? 'Current page context & session preserved' : '現在の表示とセッションを安全に保持' }}</span>
                        </div>
                    </div>
                </div>
            </li>

            <!-- Inquiries Notifications Dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    @if(($unreadCount ?? 0) > 0)
                        <span class="badge badge-danger navbar-badge font-weight-bold">{{ $unreadCount }}</span>
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-header font-weight-bold">{{ $unreadCount ?? 0 }} 件の未対応お問い合わせ</span>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('admin.inquiries') }}" class="dropdown-item">
                        <i class="fas fa-envelope mr-2 text-primary"></i> お問い合わせ一覧へ
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('admin.inquiries', ['status' => 'unread']) }}" class="dropdown-item dropdown-footer">未読のお問い合わせを表示</a>
                </div>
            </li>

            <!-- User Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fas fa-user-circle fa-lg text-secondary"></i>
                    <span class="ml-1 d-none d-md-inline font-weight-bold">{{ Auth::user()->name ?? 'Administrator' }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                    <div class="dropdown-item bg-light text-center py-2">
                        <div class="font-weight-bold text-dark">{{ Auth::user()->name ?? 'Administrator' }}</div>
                        <small class="text-muted">{{ Auth::user()->email ?? 'admin@miransh.jp' }}</small>
                    </div>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('admin.password') }}" class="dropdown-item">
                        <i class="fas fa-key mr-2 text-warning"></i> パスワード変更
                    </a>
                    <a href="{{ route('admin.company') }}" class="dropdown-item">
                        <i class="fas fa-cog mr-2 text-secondary"></i> 会社設定
                    </a>
                    <div class="dropdown-divider"></div>
                    <form action="{{ route('admin.logout') }}" method="POST" class="m-0 p-0">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger font-weight-bold">
                            <i class="fas fa-sign-out-alt mr-2"></i> ログアウト
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
                    <span class="badge badge-success text-xs py-0 px-1 font-weight-normal">ログイン中</span>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>ダッシュボード概要</p>
                        </a>
                    </li>

                    <li class="nav-header">コンテンツ・広報管理</li>
                    <li class="nav-item">
                        <a href="{{ route('admin.company') }}" class="nav-link {{ request()->routeIs('admin.company') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-building"></i>
                            <p>会社情報・画像設定</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.about') }}" class="nav-link {{ request()->routeIs('admin.about') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-handshake"></i>
                            <p>企業理念・メッセージ</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.services') }}" class="nav-link {{ request()->routeIs('admin.services') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-briefcase"></i>
                            <p>提供サービス管理</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.stories') }}" class="nav-link {{ request()->routeIs('admin.stories') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-newspaper"></i>
                            <p>採用事例・実績管理</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.faqs') }}" class="nav-link {{ request()->routeIs('admin.faqs') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-question-circle"></i>
                            <p>よくある質問管理</p>
                        </a>
                    </li>

                    <li class="nav-header">コミュニケーション</li>
                    <li class="nav-item">
                        <a href="{{ route('admin.inquiries') }}" class="nav-link {{ request()->routeIs('admin.inquiries') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-envelope"></i>
                            <p>
                                お問い合わせ管理
                                @if(($unreadCount ?? 0) > 0)
                                    <span class="badge badge-danger right">{{ $unreadCount }}</span>
                                @endif
                            </p>
                        </a>
                    </li>

                    <li class="nav-header">システム & セキュリティ</li>
                    <li class="nav-item">
                        <a href="{{ route('admin.password') }}" class="nav-link {{ request()->routeIs('admin.password') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-key"></i>
                            <p>管理者パスワード変更</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.ai') }}" class="nav-link {{ request()->routeIs('admin.ai') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-robot"></i>
                            <p>Sakana AI 設定・診断</p>
                        </a>
                    </li>
                    <li class="nav-item mt-3">
                        <form action="{{ route('admin.logout') }}" method="POST" class="m-0 p-0">
                            @csrf
                            <button type="submit" class="nav-link btn btn-block btn-outline-danger text-left border-0" style="background: rgba(220, 53, 69, 0.15); color: #ff8b94 !important;">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>ログアウト</p>
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
                            @yield('page_title', 'ダッシュボード')
                        </h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right mb-0 text-xs">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">管理ホーム</a></li>
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
                        <strong>入力内容をご確認ください：</strong>
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
            btnJa.className = 'btn btn-xs font-weight-bold px-2 py-1 rounded-pill btn-primary active text-white shadow-xs';
            btnEn.className = 'btn btn-xs font-weight-bold px-2 py-1 rounded-pill btn-light text-muted';
            btnJa.setAttribute('aria-pressed', 'true');
            btnEn.setAttribute('aria-pressed', 'false');
        } else {
            btnEn.className = 'btn btn-xs font-weight-bold px-2 py-1 rounded-pill btn-primary active text-white shadow-xs';
            btnJa.className = 'btn btn-xs font-weight-bold px-2 py-1 rounded-pill btn-light text-muted';
            btnEn.setAttribute('aria-pressed', 'true');
            btnJa.setAttribute('aria-pressed', 'false');
        }
    }

    try {
        document.cookie = 'admin_lang=' + newLang + '; path=/; max-age=31536000; SameSite=Lax';
        localStorage.setItem('admin_lang', newLang);
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
    }

    currentUrl.pathname = path;
    currentUrl.searchParams.set('lang', newLang);
    var targetHref = currentUrl.toString();

    fetch('/admin/api/set-lang?lang=' + newLang, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ lang: newLang }),
        credentials: 'same-origin'
    })
    .catch(function() {
        return fetch('/admin/lang/' + newLang, { credentials: 'same-origin' });
    })
    .catch(function() {})
    .finally(function() {
        window.location.href = targetHref;
    });
}
window.setAdminLang = switchAdminLanguage;
</script>

@stack('scripts')
</body>
</html>
