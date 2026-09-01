<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MIRANSH AdminLTE | Management Portal</title>
    <link rel="icon" type="image/png" href="/images/logo-icon.png">
    
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,600,700&display=fallback">
    <!-- Font Awesome Icons 6.5.1 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- AdminLTE 3.2.0 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <!-- DataTables Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css">
    <!-- Toastr & SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <style>
        body {
            font-family: "Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }
        .brand-link .brand-image {
            float: left;
            line-height: .8;
            margin-left: .8rem;
            margin-right: .5rem;
            margin-top: -3px;
            max-height: 33px;
            width: auto;
        }
        .small-box .icon > i {
            font-size: 68px;
            top: 15px;
            right: 15px;
            opacity: 0.25;
            transition: all 0.3s;
        }
        .small-box:hover .icon > i {
            font-size: 74px;
            opacity: 0.4;
        }
        .preview-img-box {
            border: 1px solid #ced4da;
            border-radius: 6px;
            object-fit: cover;
            background: #ffffff;
        }
        .table-middle td, .table-middle th {
            vertical-align: middle !important;
        }
        .cursor-pointer {
            cursor: pointer;
        }
        .status-badge {
            font-size: 11px;
            font-weight: 700;
            padding: 4px 8px;
            border-radius: 4px;
        }
        .timeline-inverse .time-label > span {
            font-weight: 700;
            padding: 5px 12px;
        }
        body.dark-mode .card:not(.card-outline) {
            background-color: #343a40;
        }
        body.dark-mode .preview-img-box {
            border-color: #4b545c;
            background: #343a40;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

    @php
        $pendingInquiriesCount = $inquiries->where('status', '!=', 'resolved')->count();
        $newInquiriesCount = $inquiries->whereIn('status', ['new', '未対応', null])->count();
        $resolvedInquiriesCount = $inquiries->where('status', 'resolved')->count();
        $inProgressInquiriesCount = $inquiries->where('status', 'in_progress')->count();
        $currentAdminUser = Auth::user();
    @endphp

    <!-- Top Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom shadow-sm">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button" title="サイドバー切り替え">
                    <i class="fas fa-bars"></i>
                </a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('admin.dashboard', ['tab' => 'dashboard'], false) }}" class="nav-link font-weight-bold {{ $activeTab === 'dashboard' ? 'text-primary' : '' }}">
                    <i class="fas fa-tachometer-alt mr-1"></i> ダッシュボード
                </a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('admin.dashboard', ['tab' => 'inquiries'], false) }}" class="nav-link {{ $activeTab === 'inquiries' ? 'text-primary font-weight-bold' : '' }}">
                    <i class="fas fa-envelope mr-1"></i> お問い合わせ
                    @if($newInquiriesCount > 0)
                        <span class="badge badge-danger ml-1">{{ $newInquiriesCount }}</span>
                    @endif
                </a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('home', [], false) }}" target="_blank" class="nav-link text-info">
                    <i class="fas fa-external-link-alt mr-1"></i> 公開サイト確認 ↗
                </a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto align-items-center">
            
            <!-- Dark / Light Mode Switcher -->
            <li class="nav-item">
                <a class="nav-link" href="javascript:void(0)" onclick="toggleAdminDarkMode()" title="ダークモード / ライトモード切替">
                    <i class="fas fa-moon" id="theme-toggle-icon"></i>
                </a>
            </li>

            <!-- Inquiries & Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#" title="お問い合わせ通知">
                    <i class="far fa-bell"></i>
                    @if($pendingInquiriesCount > 0)
                        <span class="badge badge-warning navbar-badge">{{ $pendingInquiriesCount }}</span>
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right shadow-sm">
                    <span class="dropdown-header font-weight-bold">{{ $inquiries->count() }} 件のお問い合わせ ({{ $pendingInquiriesCount }} 件 未完了)</span>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('admin.dashboard', ['tab' => 'inquiries'], false) }}" class="dropdown-item">
                        <i class="fas fa-envelope text-primary mr-2"></i> {{ $newInquiriesCount }} 件の新着メッセージ
                        <span class="float-right text-muted text-sm font-weight-bold">新規</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('admin.dashboard', ['tab' => 'inquiries'], false) }}" class="dropdown-item">
                        <i class="fas fa-clock text-warning mr-2"></i> {{ $inProgressInquiriesCount }} 件の対応中案件
                        <span class="float-right text-muted text-sm">進行中</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('admin.dashboard', ['tab' => 'inquiries'], false) }}" class="dropdown-item dropdown-footer text-primary font-weight-bold">すべてのお問い合わせを見る</a>
                </div>
            </li>

            <!-- Fullscreen Toggle -->
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button" title="全画面表示切替">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>

            <!-- User Menu -->
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                    <img src="{{ $company->ceo_image ?? '/images/ceo_portrait.jpg' }}" class="user-image img-circle elevation-1" alt="User" onerror="this.src='/images/logo-icon.png'">
                    <span class="d-none d-md-inline font-weight-bold">{{ $currentAdminUser->name ?? 'Admin' }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right shadow">
                    <li class="user-header bg-primary">
                        <img src="{{ $company->ceo_image ?? '/images/ceo_portrait.jpg' }}" class="img-circle elevation-2" alt="User" onerror="this.src='/images/logo-icon.png'">
                        <p class="font-weight-bold">
                            {{ $currentAdminUser->name ?? 'Administrator' }}
                            <small class="d-block">{{ $currentAdminUser->email ?? 'admin@miransh.jp' }}</small>
                        </p>
                    </li>
                    <li class="user-body bg-light py-2">
                        <div class="row text-center text-xs">
                            <div class="col-4">
                                <a href="{{ route('admin.dashboard', ['tab' => 'inquiries'], false) }}" class="text-dark font-weight-bold">リード<br><span class="badge badge-primary">{{ $inquiries->count() }}</span></a>
                            </div>
                            <div class="col-4">
                                <a href="{{ route('admin.dashboard', ['tab' => 'services'], false) }}" class="text-dark font-weight-bold">分野<br><span class="badge badge-success">{{ $services->count() }}</span></a>
                            </div>
                            <div class="col-4">
                                <a href="{{ route('admin.dashboard', ['tab' => 'stories'], false) }}" class="text-dark font-weight-bold">事例<br><span class="badge badge-info">{{ $stories->count() }}</span></a>
                            </div>
                        </div>
                    </li>
                    <li class="user-footer d-flex justify-content-between">
                        <a href="{{ route('admin.dashboard', ['tab' => 'users'], false) }}" class="btn btn-default btn-flat text-sm"><i class="fas fa-user-cog mr-1"></i> アカウント</a>
                        <a href="{{ route('admin.logout', [], false) }}" class="btn btn-danger btn-flat text-sm"><i class="fas fa-sign-out-alt mr-1"></i> ログアウト</a>
                    </li>
                </ul>
            </li>

            <!-- Control Sidebar Toggle -->
            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button" title="システム情報">
                    <i class="fas fa-th-large"></i>
                </a>
            </li>
        </ul>
    </nav>

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{ route('admin.dashboard', [], false) }}" class="brand-link bg-dark text-decoration-none">
            <img src="/images/logo-icon.png" alt="MIRANSH Logo" class="brand-image img-circle elevation-3" style="opacity: .9">
            <span class="brand-text font-weight-bold">MIRANSH</span>
            <span class="badge badge-primary font-weight-normal text-xs ml-1">AdminLTE</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
                <div class="image">
                    <img src="{{ $company->ceo_image ?? '/images/ceo_portrait.jpg' }}" class="img-circle elevation-2" alt="User" onerror="this.src='/images/logo-icon.png'">
                </div>
                <div class="info">
                    <a href="{{ route('admin.dashboard', ['tab' => 'users'], false) }}" class="d-block font-weight-bold text-white">{{ $currentAdminUser->name ?? 'Administrator' }}</a>
                    <span class="badge badge-success text-xs"><i class="fas fa-circle text-xs mr-1"></i> 管理者 (Laravel 12)</span>
                </div>
            </div>

            <!-- Sidebar Search -->
            <div class="form-inline mb-2">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="メニュー検索..." aria-label="Search" oninput="filterAdminSidebar(this.value)">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false" id="adminSidebarMenu">
                    
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard', ['tab' => 'dashboard'], false) }}" class="nav-link {{ $activeTab === 'dashboard' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>
                                ダッシュボード & 分析
                                <span class="right badge badge-primary">KPI</span>
                            </p>
                        </a>
                    </li>

                    <li class="nav-header font-weight-bold text-uppercase text-secondary">CORE MANAGEMENT</li>
                    
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard', ['tab' => 'inquiries'], false) }}" class="nav-link {{ $activeTab === 'inquiries' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-envelope"></i>
                            <p>
                                お問い合わせ・リード
                                <span class="badge badge-warning right">{{ $inquiries->count() }}</span>
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard', ['tab' => 'company'], false) }}" class="nav-link {{ $activeTab === 'company' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-building"></i>
                            <p>会社情報 & CEOメディア</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard', ['tab' => 'about'], false) }}" class="nav-link {{ $activeTab === 'about' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-award"></i>
                            <p>企業理念 & About Us</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard', ['tab' => 'services'], false) }}" class="nav-link {{ $activeTab === 'services' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-briefcase"></i>
                            <p>
                                特定技能・事業内容
                                <span class="badge badge-info right">{{ $services->count() }}</span>
                            </p>
                        </a>
                    </li>

                    <li class="nav-header font-weight-bold text-uppercase text-secondary">CONTENT & ARTICLES</li>

                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard', ['tab' => 'stories'], false) }}" class="nav-link {{ $activeTab === 'stories' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-newspaper"></i>
                            <p>
                                採用事例・お知らせ
                                <span class="badge badge-success right">{{ $stories->count() }}</span>
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard', ['tab' => 'faqs'], false) }}" class="nav-link {{ $activeTab === 'faqs' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-question-circle"></i>
                            <p>
                                FAQ よくある質問
                                <span class="badge badge-secondary right">{{ $faqs->count() }}</span>
                            </p>
                        </a>
                    </li>

                    <li class="nav-header font-weight-bold text-uppercase text-secondary">AI & SYSTEM</li>

                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard', ['tab' => 'ai'], false) }}" class="nav-link {{ $activeTab === 'ai' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-microchip"></i>
                            <p>
                                Sakana AI 相談エンジン
                                <span class="badge badge-success right">稼働中</span>
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard', ['tab' => 'users'], false) }}" class="nav-link {{ $activeTab === 'users' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-shield"></i>
                            <p>管理者アカウント設定</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard', ['tab' => 'timeline'], false) }}" class="nav-link {{ $activeTab === 'timeline' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-history"></i>
                            <p>操作ログ・タイムライン</p>
                        </a>
                    </li>

                    <li class="nav-item mt-3">
                        <a href="{{ route('home', [], false) }}" target="_blank" class="nav-link bg-secondary text-white">
                            <i class="nav-icon fas fa-external-link-alt"></i>
                            <p>公開サイトを開く ↗</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2 align-items-center">
                    <div class="col-sm-6">
                        <h1 class="m-0 font-weight-bold text-dark">
                            @if($activeTab === 'dashboard')
                                <i class="fas fa-chart-pie text-primary mr-2"></i> ダッシュボード & KPI分析
                            @elseif($activeTab === 'company')
                                <i class="fas fa-building text-primary mr-2"></i> 会社基本情報・代表者メディア管理
                            @elseif($activeTab === 'about')
                                <i class="fas fa-award text-primary mr-2"></i> 企業理念・会社紹介 (About Us)
                            @elseif($activeTab === 'services')
                                <i class="fas fa-briefcase text-primary mr-2"></i> 特定技能分野・事業案内 管理
                            @elseif($activeTab === 'stories')
                                <i class="fas fa-newspaper text-primary mr-2"></i> 採用事例・お知らせ 記事管理
                            @elseif($activeTab === 'faqs')
                                <i class="fas fa-question-circle text-primary mr-2"></i> よくある質問 (FAQ) 管理
                            @elseif($activeTab === 'inquiries')
                                <i class="fas fa-envelope text-primary mr-2"></i> お問い合わせ・リード対応管理
                            @elseif($activeTab === 'users')
                                <i class="fas fa-user-shield text-primary mr-2"></i> 管理者アカウント & セキュリティ
                            @elseif($activeTab === 'timeline')
                                <i class="fas fa-history text-primary mr-2"></i> システムアクティビティ・操作タイムライン
                            @else
                                <i class="fas fa-microchip text-primary mr-2"></i> Sakana AI 相談エンジン設定 & 診断
                            @endif
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard', [], false) }}"><i class="fas fa-home"></i> ホーム</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard', [], false) }}">AdminLTE v3</a></li>
                            <li class="breadcrumb-item active text-capitalize">{{ $activeTab }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content pb-5">
            <div class="container-fluid">

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                        <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <!-- KPI stat row -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-info shadow-sm">
                            <div class="inner">
                                <h3>{{ $inquiries->count() }}</h3>
                                <p>総お問い合わせ受信件数</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <a href="{{ route('admin.dashboard', ['tab' => 'inquiries'], false) }}" class="small-box-footer">
                                リード一覧を開く <i class="fas fa-arrow-circle-right ml-1"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning shadow-sm">
                            <div class="inner">
                                <h3>{{ $pendingInquiriesCount }}</h3>
                                <p>未対応・対応中案件</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <a href="{{ route('admin.dashboard', ['tab' => 'inquiries'], false) }}" class="small-box-footer">
                                未対応リードを処理 <i class="fas fa-arrow-circle-right ml-1"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success shadow-sm">
                            <div class="inner">
                                <h3>{{ $services->count() }}</h3>
                                <p>支援対応 特定技能分野数</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-briefcase"></i>
                            </div>
                            <a href="{{ route('admin.dashboard', ['tab' => 'services'], false) }}" class="small-box-footer">
                                分野一覧を管理 <i class="fas fa-arrow-circle-right ml-1"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger shadow-sm">
                            <div class="inner">
                                <h3>{{ $stories->count() }}</h3>
                                <p>公開中事例・お知らせ</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-newspaper"></i>
                            </div>
                            <a href="{{ route('admin.dashboard', ['tab' => 'stories'], false) }}" class="small-box-footer">
                                記事を管理・作成 <i class="fas fa-arrow-circle-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- TAB 0: DASHBOARD & CHARTS -->
                @if($activeTab === 'dashboard')
                <div class="row">
                    <!-- Chart 1: Inquiries Trend -->
                    <div class="col-lg-7">
                        <div class="card card-primary card-outline shadow-sm">
                            <div class="card-header bg-white">
                                <h3 class="card-title font-weight-bold">
                                    <i class="fas fa-chart-area text-primary mr-1"></i> 月別 お問い合わせ & 採用相談推移 (Monthly Trends)
                                </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart">
                                    <canvas id="inquiriesTrendChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                            </div>
                            <div class="card-footer bg-light py-2">
                                <div class="row text-center text-xs">
                                    <div class="col-sm-4 border-right">
                                        <div class="font-weight-bold text-success"><i class="fas fa-arrow-up mr-1"></i> +28.5%</div>
                                        <span class="text-muted">前月比 相談件数</span>
                                    </div>
                                    <div class="col-sm-4 border-right">
                                        <div class="font-weight-bold text-primary">介護・飲食・製造</div>
                                        <span class="text-muted">主需要分野</span>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="font-weight-bold text-info">{{ $resolvedInquiriesCount }} / {{ $inquiries->count() }}</div>
                                        <span class="text-muted">対応完了率</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Chart 2: Visa Categories Breakdown -->
                    <div class="col-lg-5">
                        <div class="card card-info card-outline shadow-sm">
                            <div class="card-header bg-white">
                                <h3 class="card-title font-weight-bold">
                                    <i class="fas fa-chart-pie text-info mr-1"></i> 相談分野別シェア (Sector Breakdown)
                                </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart">
                                    <canvas id="sectorsDonutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Inquiries & Quick Action Row -->
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card card-secondary card-outline shadow-sm">
                            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                                <h3 class="card-title font-weight-bold">
                                    <i class="fas fa-list text-secondary mr-1"></i> 最新のお問い合わせ・リード速報
                                </h3>
                                <a href="{{ route('admin.dashboard', ['tab' => 'inquiries'], false) }}" class="btn btn-primary btn-xs font-weight-bold">
                                    すべて表示 ({{ $inquiries->count() }}) <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover table-middle mb-0 text-sm">
                                        <thead>
                                            <tr>
                                                <th>お名前 / 企業名</th>
                                                <th>ご相談分野</th>
                                                <th>メッセージ概要</th>
                                                <th>状況</th>
                                                <th class="text-right">アクション</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($inquiries->take(5) as $inq)
                                            <tr>
                                                <td>
                                                    <div class="font-weight-bold">{{ $inq->name }}</div>
                                                    <small class="text-muted">{{ $inq->company_name ?: $inq->email }}</small>
                                                </td>
                                                <td><span class="badge badge-info">{{ $inq->service_interest ?: '全般' }}</span></td>
                                                <td class="text-truncate" style="max-width: 220px;">{{ $inq->message }}</td>
                                                <td>
                                                    <span class="badge {{ $inq->status === 'resolved' ? 'badge-success' : ($inq->status === 'in_progress' ? 'badge-warning' : 'badge-danger') }} py-1 px-2">
                                                        {{ $inq->status === 'resolved' ? '対応済' : ($inq->status === 'in_progress' ? '対応中' : '未対応') }}
                                                    </span>
                                                </td>
                                                <td class="text-right">
                                                    <button type="button" class="btn btn-default btn-xs" onclick='openInquiryDetailModal(@json($inq))' title="詳細">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr><td colspan="5" class="text-center py-3 text-muted">お問い合わせはありません</td></tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card card-success card-outline shadow-sm">
                            <div class="card-header bg-white">
                                <h3 class="card-title font-weight-bold">
                                    <i class="fas fa-bolt text-success mr-1"></i> クイックアクション
                                </h3>
                            </div>
                            <div class="card-body">
                                <button type="button" class="btn btn-primary btn-block mb-2 text-left font-weight-bold" onclick="openStoryCreateModal()">
                                    <i class="fas fa-plus mr-2"></i> 新規 採用事例・お知らせを投稿
                                </button>
                                <a href="{{ route('admin.dashboard', ['tab' => 'company'], false) }}" class="btn btn-outline-info btn-block mb-2 text-left font-weight-bold">
                                    <i class="fas fa-camera mr-2"></i> 代表者顔写真・バナーの変更
                                </a>
                                <a href="{{ route('admin.dashboard', ['tab' => 'ai'], false) }}" class="btn btn-outline-success btn-block mb-2 text-left font-weight-bold">
                                    <i class="fas fa-robot mr-2"></i> Sakana AI 相談モデルの診断
                                </a>
                                <a href="{{ route('home', [], false) }}" target="_blank" class="btn btn-outline-secondary btn-block text-left font-weight-bold">
                                    <i class="fas fa-external-link-alt mr-2"></i> 公開ホームページを確認 ↗
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- TAB 1: Company Profile & Media -->
                @if($activeTab === 'company')
                <div class="card card-primary card-outline shadow-sm">
                    <div class="card-header bg-white">
                        <h3 class="card-title font-weight-bold">
                            <i class="fas fa-building text-primary mr-1"></i> 会社基本情報・代表者設定・トップバナー設定
                        </h3>
                    </div>
                    <form action="{{ route('admin.company.update', [], false) }}" method="POST">
                        @csrf
                        <div class="card-body">
                            
                            <!-- CEO Image -->
                            <div class="callout callout-info mb-4">
                                <h5 class="font-weight-bold text-primary"><i class="fas fa-user-tie mr-1"></i> 1. 代表者（CEO）情報 & 顔写真設定</h5>
                                <p class="text-sm text-muted mb-0">ウェブサイト上の代表挨拶セクションに表示される代表者顔写真とメッセージです。</p>
                            </div>

                            <div class="row align-items-center mb-4 p-3 bg-light rounded border mx-0">
                                <div class="col-md-3 text-center mb-3 mb-md-0">
                                    <img id="preview_ceo_img" src="{{ $company->ceo_image ?? '/images/ceo_portrait.jpg' }}" alt="CEO Photo" class="preview-img-box img-thumbnail shadow-sm" style="width: 140px; height: 140px;" onerror="this.src='/images/ceo_portrait.jpg'">
                                </div>
                                <div class="col-md-9">
                                    <h6 class="font-weight-bold text-dark mb-1">代表者 顔写真アップロード (Upload CEO Portrait)</h6>
                                    <p class="text-xs text-muted mb-3">JPEG, PNG, WebP形式対応。ファイルを選択すると自動的に即時アップロード・保存されます。</p>
                                    
                                    <div class="d-flex flex-wrap gap-2 align-items-center">
                                        <label class="btn btn-primary btn-sm mb-0 mr-2 cursor-pointer font-weight-bold">
                                            <i class="fas fa-upload mr-1"></i> 写真ファイルを選択
                                            <input type="file" accept="image/*" class="d-none" onchange="handleAdminUpload(this, 'input_ceo_image', 'preview_ceo_img', 'ceo_status', 'ceo_image')">
                                        </label>
                                        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="resetImageDefault('input_ceo_image', 'preview_ceo_img', '/images/ceo_portrait.jpg', 'ceo_status', 'ceo_image')">
                                            <i class="fas fa-undo mr-1"></i> デフォルト写真に戻す
                                        </button>
                                    </div>
                                    <div id="ceo_status" class="badge badge-success text-xs mt-2 py-1 px-2" style="display: {{ $company->ceo_image ? 'inline-block' : 'none' }};">
                                        ✓ 現在の写真が設定されています
                                    </div>
                                    <input type="hidden" id="input_ceo_image" name="ceo_image" value="{{ $company->ceo_image ?? '/images/ceo_portrait.jpg' }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold">代表社員 日本語氏名 <span class="text-danger">*</span></label>
                                    <input type="text" name="ceo_name_ja" class="form-control" value="{{ $company->ceo_name_ja ?? 'ギリ ラム クリシュナ' }}" required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold">代表社員 英語氏名 <span class="text-danger">*</span></label>
                                    <input type="text" name="ceo_name_en" class="form-control" value="{{ $company->ceo_name_en ?? 'Giri Ram Krishna' }}" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold">代表役職名 (日本語)</label>
                                    <input type="text" name="ceo_role_ja" class="form-control" value="{{ $company->ceo_role_ja ?? '代表社員' }}">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold">代表役職名 (英語)</label>
                                    <input type="text" name="ceo_role_en" class="form-control" value="{{ $company->ceo_role_en ?? 'Representative Member' }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold">代表挨拶 (CEO Message - Japanese)</label>
                                    <textarea name="ceo_message_ja" class="form-control" rows="6">{{ $company->ceo_message_ja }}</textarea>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold">代表挨拶 (CEO Message - English)</label>
                                    <textarea name="ceo_message_en" class="form-control" rows="6">{{ $company->ceo_message_en }}</textarea>
                                </div>
                            </div>

                            <!-- Hero Banner -->
                            <div class="callout callout-info mt-4 mb-4">
                                <h5 class="font-weight-bold text-primary"><i class="fas fa-image mr-1"></i> 2. トップヒーローバナー & 背景画像設定</h5>
                                <p class="text-sm text-muted mb-0">トップページのメインビジュアル画像とキャッチコピーです。</p>
                            </div>

                            <div class="row align-items-center mb-4 p-3 bg-light rounded border mx-0">
                                <div class="col-md-5 text-center mb-3 mb-md-0">
                                    <img id="preview_hero_img" src="{{ $company->hero_image ?? '/images/hero_banner.jpg' }}" alt="Hero Banner" class="preview-img-box img-fluid shadow-sm" style="max-height: 160px; width: 100%; object-fit: cover;" onerror="this.src='/images/hero_banner.jpg'">
                                </div>
                                <div class="col-md-7">
                                    <h6 class="font-weight-bold text-dark mb-1">バナー画像をアップロード (Upload Hero Banner)</h6>
                                    <p class="text-xs text-muted mb-3">16:9横長比率推奨 (1920×1080など)。即時アップロード・反映されます。</p>
                                    
                                    <div class="d-flex flex-wrap gap-2 align-items-center">
                                        <label class="btn btn-primary btn-sm mb-0 mr-2 cursor-pointer font-weight-bold">
                                            <i class="fas fa-upload mr-1"></i> バナーファイルを選択
                                            <input type="file" accept="image/*" class="d-none" onchange="handleAdminUpload(this, 'input_hero_image', 'preview_hero_img', 'hero_status', 'hero_image')">
                                        </label>
                                        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="resetImageDefault('input_hero_image', 'preview_hero_img', '/images/hero_banner.jpg', 'hero_status', 'hero_image')">
                                            <i class="fas fa-undo mr-1"></i> デフォルトバナーに戻す
                                        </button>
                                    </div>
                                    <div id="hero_status" class="badge badge-success text-xs mt-2 py-1 px-2" style="display: {{ $company->hero_image ? 'inline-block' : 'none' }};">
                                        ✓ 現在のバナー画像が設定されています
                                    </div>
                                    <input type="hidden" id="input_hero_image" name="hero_image" value="{{ $company->hero_image ?? '/images/hero_banner.jpg' }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold">キャッチコピー (日本語)</label>
                                    <input type="text" name="hero_title_ja" class="form-control" value="{{ $company->hero_title_ja ?? '日本企業と海外人材をつなぐ、' }}">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold">強調ワード (日本語)</label>
                                    <input type="text" name="hero_title_accent_ja" class="form-control" value="{{ $company->hero_title_accent_ja ?? '信頼の架け橋。' }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold">キャッチコピー (英語)</label>
                                    <input type="text" name="hero_title_en" class="form-control" value="{{ $company->hero_title_en ?? 'Bridging Japanese Enterprises and' }}">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold">強調ワード (英語)</label>
                                    <input type="text" name="hero_title_accent_en" class="form-control" value="{{ $company->hero_title_accent_en ?? 'Global Talent with Trust.' }}">
                                </div>
                            </div>

                            <!-- Corporate Info -->
                            <div class="callout callout-info mt-4 mb-4">
                                <h5 class="font-weight-bold text-primary"><i class="fas fa-info-circle mr-1"></i> 3. 会社基本概要 & 連絡先情報</h5>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold">会社名 (日本語) <span class="text-danger">*</span></label>
                                    <input type="text" name="name_ja" class="form-control" value="{{ $company->name_ja }}" required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold">Company Name (English) <span class="text-danger">*</span></label>
                                    <input type="text" name="name_en" class="form-control" value="{{ $company->name_en }}" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold">法人番号 (Corporate Number)</label>
                                    <input type="text" name="corporate_number" class="form-control" value="{{ $company->corporate_number }}">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold">登録支援機関・許認可番号</label>
                                    <input type="text" name="license" class="form-control" value="{{ $company->license }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold">電話番号</label>
                                    <input type="text" name="phone" class="form-control" value="{{ $company->phone }}">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold">メールアドレス</label>
                                    <input type="email" name="email" class="form-control" value="{{ $company->email }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold">所在地住所 (日本語)</label>
                                    <input type="text" name="address_ja" class="form-control" value="{{ $company->address_ja }}">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold">Headquarters Address (English)</label>
                                    <input type="text" name="address_en" class="form-control" value="{{ $company->address_en }}">
                                </div>
                            </div>

                        </div>
                        <div class="card-footer bg-white text-right">
                            <button type="submit" class="btn btn-primary px-4 font-weight-bold">
                                <i class="fas fa-save mr-1"></i> 設定を保存する (Save Changes)
                            </button>
                        </div>
                    </form>
                </div>
                @endif

                <!-- TAB 2: Philosophy & About -->
                @if($activeTab === 'about')
                <div class="card card-primary card-outline shadow-sm">
                    <div class="card-header bg-white">
                        <h3 class="card-title font-weight-bold">
                            <i class="fas fa-award text-primary mr-1"></i> 企業理念・会社紹介・強み (About Us)
                        </h3>
                    </div>
                    <form action="{{ route('admin.about.update', [], false) }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label class="font-weight-bold">見出し (Headline - Japanese) <span class="text-danger">*</span></label>
                                <input type="text" name="title_ja" class="form-control" value="{{ $about->title_ja }}" required>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">見出し (Headline - English) <span class="text-danger">*</span></label>
                                <input type="text" name="title_en" class="form-control" value="{{ $about->title_en }}" required>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold">ミッション・理念 (Mission - Japanese)</label>
                                    <textarea name="mission_ja" class="form-control" rows="4">{{ $about->mission_ja }}</textarea>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold">ミッション・理念 (Mission - English)</label>
                                    <textarea name="mission_en" class="form-control" rows="4">{{ $about->mission_en }}</textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold">ビジョン・展望 (Vision - Japanese)</label>
                                    <textarea name="vision_ja" class="form-control" rows="4">{{ $about->vision_ja }}</textarea>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold">ビジョン・展望 (Vision - English)</label>
                                    <textarea name="vision_en" class="form-control" rows="4">{{ $about->vision_en }}</textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold">詳細紹介文 (Detailed Story - Japanese)</label>
                                    <textarea name="story_ja" class="form-control" rows="6">{{ $about->story_ja }}</textarea>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold">詳細紹介文 (Detailed Story - English)</label>
                                    <textarea name="story_en" class="form-control" rows="6">{{ $about->story_en }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-white text-right">
                            <button type="submit" class="btn btn-primary px-4 font-weight-bold">
                                <i class="fas fa-save mr-1"></i> 理念設定を保存する
                            </button>
                        </div>
                    </form>
                </div>
                @endif

                <!-- TAB 3: Services -->
                @if($activeTab === 'services')
                <div class="card card-primary card-outline shadow-sm">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h3 class="card-title font-weight-bold">
                            <i class="fas fa-briefcase text-primary mr-1"></i> 特定技能分野・事業案内 管理 ({{ $services->count() }} 分野)
                        </h3>
                        <button type="button" class="btn btn-primary btn-sm font-weight-bold" onclick="openServiceCreateModal()">
                            <i class="fas fa-plus mr-1"></i> 新規分野を追加
                        </button>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-middle mb-0">
                                <thead>
                                    <tr>
                                        <th style="width: 70px;">順番</th>
                                        <th>アイコン</th>
                                        <th>分野名 (日本語 / 英語)</th>
                                        <th>説明抜粋</th>
                                        <th class="text-right" style="width: 140px;">操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($services as $svc)
                                    <tr>
                                        <td><span class="badge badge-secondary">{{ $svc->sort_order ?? 0 }}</span></td>
                                        <td>
                                            <div class="btn btn-sm btn-outline-primary"><i class="fas fa-{{ $svc->icon ?? 'briefcase' }}"></i></div>
                                        </td>
                                        <td>
                                            <div class="font-weight-bold text-primary">{{ $svc->title_ja }}</div>
                                            <div class="text-muted text-xs">{{ $svc->title_en }}</div>
                                        </td>
                                        <td class="text-truncate" style="max-width: 300px;">{{ $svc->desc_ja }}</td>
                                        <td class="text-right">
                                            <button type="button" class="btn btn-default btn-xs mr-1" onclick='openServiceEditModal(@json($svc))' title="編集">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-xs" onclick="confirmDeleteService({{ $svc->id }}, '{{ addslashes($svc->title_ja) }}')" title="削除">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr><td colspan="5" class="text-center py-4 text-muted">分野データがありません</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endif

                <!-- TAB 4: Stories -->
                @if($activeTab === 'stories')
                <div class="card card-primary card-outline shadow-sm">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h3 class="card-title font-weight-bold">
                            <i class="fas fa-newspaper text-primary mr-1"></i> 採用事例・最新お知らせ 記事管理 ({{ $stories->count() }} 件)
                        </h3>
                        <button type="button" class="btn btn-primary btn-sm font-weight-bold" onclick="openStoryCreateModal()">
                            <i class="fas fa-plus mr-1"></i> 新規記事を作成
                        </button>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-middle mb-0">
                                <thead>
                                    <tr>
                                        <th style="width: 100px;">日付</th>
                                        <th>カテゴリ</th>
                                        <th>記事タイトル (日本語 / 英語)</th>
                                        <th>注目</th>
                                        <th class="text-right" style="width: 140px;">操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($stories as $st)
                                    <tr>
                                        <td class="text-nowrap text-sm font-weight-bold">{{ $st->published_date }}</td>
                                        <td><span class="badge badge-info">{{ $st->category_ja ?? '事例' }}</span></td>
                                        <td>
                                            <div class="font-weight-bold text-dark">{{ $st->title_ja }}</div>
                                            <div class="text-muted text-xs">{{ $st->title_en }}</div>
                                        </td>
                                        <td>
                                            @if($st->featured)
                                                <span class="badge badge-warning text-xs"><i class="fas fa-star mr-1"></i> トップ注目</span>
                                            @else
                                                <span class="badge badge-light text-xs text-muted">通常</span>
                                            @endif
                                        </td>
                                        <td class="text-right">
                                            <button type="button" class="btn btn-default btn-xs mr-1" onclick='openStoryEditModal(@json($st))' title="編集">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-xs" onclick="confirmDeleteStory({{ $st->id }}, '{{ addslashes($st->title_ja) }}')" title="削除">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr><td colspan="5" class="text-center py-4 text-muted">記事データがありません</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endif

                <!-- TAB 5: FAQs -->
                @if($activeTab === 'faqs')
                <div class="card card-primary card-outline shadow-sm">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h3 class="card-title font-weight-bold">
                            <i class="fas fa-question-circle text-primary mr-1"></i> よくある質問 (FAQ) 管理 ({{ $faqs->count() }} 件)
                        </h3>
                        <button type="button" class="btn btn-primary btn-sm font-weight-bold" onclick="openFaqCreateModal()">
                            <i class="fas fa-plus mr-1"></i> 新規質問を追加
                        </button>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-middle mb-0">
                                <thead>
                                    <tr>
                                        <th style="width: 70px;">順序</th>
                                        <th style="width: 140px;">カテゴリ</th>
                                        <th>質問 (Q)</th>
                                        <th>回答 (A)</th>
                                        <th class="text-right" style="width: 140px;">操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($faqs as $fq)
                                    <tr>
                                        <td><span class="badge badge-secondary">{{ $fq->sort_order ?? 0 }}</span></td>
                                        <td><span class="badge badge-light border">{{ $fq->category_ja ?? '一般' }}</span></td>
                                        <td class="font-weight-bold text-dark" style="max-width: 250px;">{{ $fq->question_ja }}</td>
                                        <td class="text-muted text-sm text-truncate" style="max-width: 320px;">{{ $fq->answer_ja }}</td>
                                        <td class="text-right">
                                            <button type="button" class="btn btn-default btn-xs mr-1" onclick='openFaqEditModal(@json($fq))' title="編集">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-xs" onclick="confirmDeleteFaq({{ $fq->id }})" title="削除">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr><td colspan="5" class="text-center py-4 text-muted">FAQデータがありません</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endif

                <!-- TAB 6: Inquiries & Leads -->
                @if($activeTab === 'inquiries')
                <div class="card card-primary card-outline shadow-sm">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h3 class="card-title font-weight-bold">
                            <i class="fas fa-envelope text-primary mr-1"></i> 受信お問い合わせ・企業リード管理 ({{ $inquiries->count() }} 件)
                        </h3>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-middle mb-0" id="inquiriesTable">
                                <thead>
                                    <tr>
                                        <th>受信日時</th>
                                        <th>お名前 / 企業名</th>
                                        <th>連絡先</th>
                                        <th>ご相談分野</th>
                                        <th>状況</th>
                                        <th class="text-right">操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($inquiries as $inq)
                                    <tr>
                                        <td class="text-nowrap text-xs text-muted">{{ $inq->created_at }}</td>
                                        <td>
                                            <div class="font-weight-bold text-dark">{{ $inq->name }}</div>
                                            @if($inq->company_name)
                                                <small class="text-secondary d-block"><i class="fas fa-building mr-1"></i> {{ $inq->company_name }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="text-xs font-weight-bold"><a href="mailto:{{ $inq->email }}" class="text-primary"><i class="fas fa-envelope mr-1"></i> {{ $inq->email }}</a></div>
                                            @if($inq->phone)
                                                <div class="text-xs text-muted mt-1"><i class="fas fa-phone mr-1"></i> {{ $inq->phone }}</div>
                                            @endif
                                        </td>
                                        <td><span class="badge badge-info">{{ $inq->service_interest ?: '全般相談' }}</span></td>
                                        <td>
                                            <select class="form-control form-control-sm text-xs font-weight-bold" onchange="updateInquiryStatus({{ $inq->id }}, this.value)">
                                                <option value="new" {{ ($inq->status === 'new' || !$inq->status) ? 'selected' : '' }}>🔴 未対応</option>
                                                <option value="in_progress" {{ $inq->status === 'in_progress' ? 'selected' : '' }}>🟡 対応中</option>
                                                <option value="resolved" {{ $inq->status === 'resolved' ? 'selected' : '' }}>🟢 完了</option>
                                            </select>
                                        </td>
                                        <td class="text-right text-nowrap">
                                            <button type="button" class="btn btn-default btn-xs mr-1" onclick='openInquiryDetailModal(@json($inq))' title="内容確認">
                                                <i class="fas fa-eye"></i> 詳細
                                            </button>
                                            <button type="button" class="btn btn-danger btn-xs" onclick="confirmDeleteInquiry({{ $inq->id }}, '{{ addslashes($inq->name) }}')" title="削除">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr><td colspan="6" class="text-center py-4 text-muted">お問い合わせはありません</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endif

                <!-- TAB 7: Sakana AI Engine -->
                @if($activeTab === 'ai')
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card card-success card-outline shadow-sm">
                            <div class="card-header bg-white">
                                <h3 class="card-title font-weight-bold">
                                    <i class="fas fa-microchip text-success mr-1"></i> Sakana AI 相談エンジン設定
                                </h3>
                            </div>
                            <form action="{{ route('admin.sakana.config', [], false) }}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="font-weight-bold">モデル選択 (Model Alias)</label>
                                        <select name="sakana_model" class="form-control">
                                            <option value="gemini-2.5-flash">Gemini 2.5 Flash (推奨・超高速・日本語最適化)</option>
                                            <option value="gemini-2.5-pro">Gemini 2.5 Pro (高度な在留資格・法令推論)</option>
                                            <option value="sakana-evo-1">Sakana Evo-1 Hybrid Engine</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold">Sakana AI / Gemini API キー</label>
                                        <div class="input-group">
                                            <input type="password" name="sakana_key" id="sakana_key_input" class="form-control" placeholder="AIzaSy... (設定済みはそのまま維持)">
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-outline-secondary" onclick="togglePasswordVisibility('sakana_key_input')"><i class="fas fa-eye"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold">相談AI システムプロンプト</label>
                                        <textarea class="form-control" rows="4" readonly>MIRANSH株式会社の特定技能外国人受入れ支援（介護、外食、ビルクリーニング、製造業等）に関する高度専門カウンセラーとして、親身かつ法令順守に基づいた回答を行います。</textarea>
                                    </div>
                                </div>
                                <div class="card-footer bg-white text-right">
                                    <button type="submit" class="btn btn-success px-4 font-weight-bold">
                                        <i class="fas fa-save mr-1"></i> AI設定を保存
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card card-info card-outline shadow-sm">
                            <div class="card-header bg-white">
                                <h3 class="card-title font-weight-bold">
                                    <i class="fas fa-stethoscope text-info mr-1"></i> AIエンジン診断・接続テスト
                                </h3>
                            </div>
                            <div class="card-body">
                                <p class="text-sm text-muted">Sakana AI / Gemini 相談エンジンへの接続疎通テストを実行します。</p>
                                <button type="button" class="btn btn-outline-primary btn-block mb-3 font-weight-bold" onclick="runAiDiagnostic()">
                                    <i class="fas fa-play mr-2"></i> 疎通テスト実行 (Test Connection)
                                </button>
                                <div id="aiTestConsole" class="p-3 bg-dark text-success rounded text-xs" style="min-height: 150px; font-family: monospace; overflow-y: auto;">
                                    > System ready. Click "Test Connection" to check Sakana AI status...
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- TAB 8: Users & Security -->
                @if($activeTab === 'users')
                <div class="row">
                    <div class="col-lg-7">
                        <div class="card card-primary card-outline shadow-sm">
                            <div class="card-header bg-white">
                                <h3 class="card-title font-weight-bold">
                                    <i class="fas fa-user-shield text-primary mr-1"></i> 管理者アカウント & パスワード設定
                                </h3>
                            </div>
                            <form action="{{ route('admin.profile.update', [], false) }}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="font-weight-bold">管理者 ユーザー名 <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control" value="{{ $currentAdminUser->name ?? 'admin' }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold">管理者 メールアドレス <span class="text-danger">*</span></label>
                                        <input type="email" name="email" class="form-control" value="{{ $currentAdminUser->email ?? 'admin@miransh.jp' }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold">新しいパスワード (変更する場合のみ入力)</label>
                                        <input type="password" name="new_password" class="form-control" placeholder="••••••••">
                                        <small class="text-muted">空欄の場合は現在のパスワードを維持します。</small>
                                    </div>
                                </div>
                                <div class="card-footer bg-white text-right">
                                    <button type="submit" class="btn btn-primary px-4 font-weight-bold">
                                        <i class="fas fa-save mr-1"></i> アカウント情報を更新
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="card card-secondary card-outline shadow-sm">
                            <div class="card-header bg-white">
                                <h3 class="card-title font-weight-bold"><i class="fas fa-shield-alt text-secondary mr-1"></i> セキュリティステータス</h3>
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-unbordered text-sm">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>CSRF 保護</span>
                                        <span class="badge badge-success">有効 (Active)</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>パスワードハッシュ</span>
                                        <span class="badge badge-success">Bcrypt (Cost 10)</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>セッション管理</span>
                                        <span class="badge badge-info">Secure Cookie</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>フレームワーク</span>
                                        <span class="badge badge-dark font-weight-bold">Laravel 12 + AdminLTE v3</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- TAB 9: Timeline -->
                @if($activeTab === 'timeline')
                <div class="card card-primary card-outline shadow-sm">
                    <div class="card-header bg-white">
                        <h3 class="card-title font-weight-bold"><i class="fas fa-history text-primary mr-1"></i> システム運用タイムライン</h3>
                    </div>
                    <div class="card-body">
                        <div class="timeline">
                            <div class="time-label">
                                <span class="bg-primary">2026.09.01</span>
                            </div>
                            <div>
                                <i class="fas fa-check bg-success"></i>
                                <div class="timeline-item shadow-sm">
                                    <span class="time"><i class="fas fa-clock"></i> 10:45</span>
                                    <h3 class="timeline-header font-weight-bold text-primary">AdminLTE v3.2 完全統合</h3>
                                    <div class="timeline-body text-sm">
                                        Laravel 12 Bladeビューおよび Node.js API 双方において、AdminLTE v3 完全パッケージのUI・KPIダッシュボード・CRUDモーダル・Chart.jsグラフを配備しました。
                                    </div>
                                </div>
                            </div>
                            <div>
                                <i class="fas fa-microchip bg-info"></i>
                                <div class="timeline-item shadow-sm">
                                    <span class="time"><i class="fas fa-clock"></i> 09:30</span>
                                    <h3 class="timeline-header font-weight-bold text-dark">Sakana AI 相談エンジン稼働</h3>
                                    <div class="timeline-body text-sm">
                                        特定技能ビザ・外国人留学生就業支援用のバイリンガルAIカウンセリングチャットが正常稼働しています。
                                    </div>
                                </div>
                            </div>
                            <div>
                                <i class="fas fa-clock bg-gray"></i>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

            </div>
        </section>
    </div>

    <!-- Modals Container -->
    <!-- 1. Inquiry Detail Modal -->
    <div class="modal fade" id="inquiryDetailModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content shadow-lg">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title font-weight-bold"><i class="fas fa-envelope-open-text mr-2"></i> お問い合わせ詳細</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label class="text-xs text-muted mb-0">お名前</label>
                            <div id="modal_inq_name" class="font-weight-bold text-dark"></div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="text-xs text-muted mb-0">企業・団体名</label>
                            <div id="modal_inq_company" class="font-weight-bold text-dark"></div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="text-xs text-muted mb-0">メールアドレス</label>
                            <div><a href="#" id="modal_inq_email" class="font-weight-bold text-primary"></a></div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="text-xs text-muted mb-0">電話番号</label>
                            <div id="modal_inq_phone" class="font-weight-bold text-dark"></div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="text-xs text-muted mb-0">関心分野</label>
                            <div><span id="modal_inq_service" class="badge badge-info"></span></div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="text-xs text-muted mb-0">受信日時</label>
                            <div id="modal_inq_date" class="text-muted text-sm"></div>
                        </div>
                    </div>
                    <hr>
                    <div>
                        <label class="text-xs text-muted mb-1">お問い合わせ本文</label>
                        <div id="modal_inq_message" class="p-3 bg-light rounded border text-dark" style="white-space: pre-wrap; font-size: 14px;"></div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <a href="#" id="modal_inq_reply_btn" class="btn btn-success font-weight-bold"><i class="fas fa-reply mr-1"></i> 返信メールを作成</a>
                    <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. Service Modal -->
    <div class="modal fade" id="serviceModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content shadow-lg">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title font-weight-bold" id="serviceModalTitle"><i class="fas fa-briefcase mr-2"></i> 分野の追加・編集</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form id="serviceForm" method="POST" action="{{ route('admin.services.store', [], false) }}">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="font-weight-bold">分野名 (日本語) <span class="text-danger">*</span></label>
                                <input type="text" name="title_ja" id="svc_title_ja" class="form-control" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="font-weight-bold">Title (English) <span class="text-danger">*</span></label>
                                <input type="text" name="title_en" id="svc_title_en" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="font-weight-bold">アイコン名 (FontAwesome)</label>
                                <input type="text" name="icon" id="svc_icon" class="form-control" placeholder="heart-pulse, utensils, etc.">
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="font-weight-bold">表示順序</label>
                                <input type="number" name="sort_order" id="svc_sort_order" class="form-control" value="0">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="font-weight-bold">説明 (日本語) <span class="text-danger">*</span></label>
                                <textarea name="desc_ja" id="svc_desc_ja" class="form-control" rows="4" required></textarea>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="font-weight-bold">Description (English) <span class="text-danger">*</span></label>
                                <textarea name="desc_en" id="svc_desc_en" class="form-control" rows="4" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">キャンセル</button>
                        <button type="submit" class="btn btn-primary font-weight-bold"><i class="fas fa-save mr-1"></i> 保存する</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- 3. Story Modal -->
    <div class="modal fade" id="storyModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content shadow-lg">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title font-weight-bold" id="storyModalTitle"><i class="fas fa-newspaper mr-2"></i> 記事の追加・編集</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form id="storyForm" method="POST" action="{{ route('admin.stories.store', [], false) }}">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="font-weight-bold">タイトル (日本語) <span class="text-danger">*</span></label>
                                <input type="text" name="title_ja" id="st_title_ja" class="form-control" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="font-weight-bold">Title (English) <span class="text-danger">*</span></label>
                                <input type="text" name="title_en" id="st_title_en" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label class="font-weight-bold">カテゴリ (日本語)</label>
                                <input type="text" name="category_ja" id="st_category_ja" class="form-control" value="採用事例">
                            </div>
                            <div class="col-md-4 form-group">
                                <label class="font-weight-bold">公開日付 (YYYY-MM-DD)</label>
                                <input type="date" name="published_date" id="st_published_date" class="form-control" value="{{ date('Y-m-d') }}">
                            </div>
                            <div class="col-md-4 form-group d-flex align-items-center pt-4">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="featured" id="st_featured" class="custom-control-input" value="1">
                                    <label class="custom-control-label font-weight-bold text-warning" for="st_featured">★ トップ注目記事</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="font-weight-bold">要約 (日本語) <span class="text-danger">*</span></label>
                                <textarea name="summary_ja" id="st_summary_ja" class="form-control" rows="4" required></textarea>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="font-weight-bold">Summary (English) <span class="text-danger">*</span></label>
                                <textarea name="summary_en" id="st_summary_en" class="form-control" rows="4" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">キャンセル</button>
                        <button type="submit" class="btn btn-primary font-weight-bold"><i class="fas fa-save mr-1"></i> 記事を保存</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- 4. FAQ Modal -->
    <div class="modal fade" id="faqModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content shadow-lg">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title font-weight-bold" id="faqModalTitle"><i class="fas fa-question-circle mr-2"></i> FAQの追加・編集</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form id="faqForm" method="POST" action="{{ route('admin.faqs.store', [], false) }}">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-8 form-group">
                                <label class="font-weight-bold">カテゴリ (日本語)</label>
                                <input type="text" name="category_ja" id="faq_category_ja" class="form-control" value="特定技能・受入れ">
                            </div>
                            <div class="col-md-4 form-group">
                                <label class="font-weight-bold">表示順序</label>
                                <input type="number" name="sort_order" id="faq_sort_order" class="form-control" value="0">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">質問 (Question - Japanese) <span class="text-danger">*</span></label>
                            <input type="text" name="question_ja" id="faq_question_ja" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">回答 (Answer - Japanese) <span class="text-danger">*</span></label>
                            <textarea name="answer_ja" id="faq_answer_ja" class="form-control" rows="4" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">キャンセル</button>
                        <button type="submit" class="btn btn-primary font-weight-bold"><i class="fas fa-save mr-1"></i> FAQを保存</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="main-footer">
        <strong>Copyright &copy; {{ date('Y') }} <a href="{{ route('home', [], false) }}">MIRANSH LLC</a>.</strong>
        All rights reserved. Powered by Laravel 12 & AdminLTE v3.2.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 3.2.0
        </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <div class="p-3 control-sidebar-content">
            <h5 class="font-weight-bold"><i class="fas fa-cog mr-1"></i> システム環境</h5>
            <hr class="mb-3 border-secondary">
            <p class="text-xs text-muted mb-2">Framework: <strong>Laravel 12 / PHP 8.2+</strong></p>
            <p class="text-xs text-muted mb-2">Admin UI: <strong>AdminLTE 3.2.0 (Bootstrap 4)</strong></p>
            <p class="text-xs text-muted mb-3">AI Engine: <strong>Sakana AI / Gemini</strong></p>
            <button type="button" class="btn btn-outline-light btn-block btn-sm" onclick="toggleAdminDarkMode()">
                <i class="fas fa-adjust mr-1"></i> テーマ切替 (Dark/Light)
            </button>
        </div>
    </aside>
</div>

<!-- jQuery & Bootstrap 4 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<!-- Chart.js 3.9.1 -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    // Dark mode state
    function toggleAdminDarkMode() {
        $('body').toggleClass('dark-mode');
        const isDark = $('body').hasClass('dark-mode');
        localStorage.setItem('admin_dark_mode', isDark ? '1' : '0');
        $('#theme-toggle-icon').toggleClass('fa-moon fa-sun');
    }
    if (localStorage.getItem('admin_dark_mode') === '1') {
        $('body').addClass('dark-mode');
        $('#theme-toggle-icon').removeClass('fa-moon').addClass('fa-sun');
    }

    // Sidebar search filter
    function filterAdminSidebar(val) {
        val = val.toLowerCase().trim();
        $('#adminSidebarMenu .nav-item').each(function() {
            const text = $(this).text().toLowerCase();
            if (!val || text.includes(val)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }

    // Image Upload
    function handleAdminUpload(input, hiddenInputId, previewImgId, statusId, targetField) {
        if (!input.files || !input.files[0]) return;
        const file = input.files[0];
        const formData = new FormData();
        formData.append('image', file);
        formData.append('target_field', targetField);

        toastr.info('画像をアップロード中...', 'アップロード');
        fetch('/api/admin/upload-image', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                $('#' + hiddenInputId).val(data.url);
                $('#' + previewImgId).attr('src', data.url);
                $('#' + statusId).show().text('✓ アップロード完了');
                toastr.success('画像が正常に保存されました', '完了');
            } else {
                toastr.error(data.error || 'アップロードに失敗しました', 'エラー');
            }
        })
        .catch(err => {
            toastr.error('通信エラーが発生しました', 'エラー');
        });
    }

    function resetImageDefault(hiddenInputId, previewImgId, defaultUrl, statusId) {
        $('#' + hiddenInputId).val(defaultUrl);
        $('#' + previewImgId).attr('src', defaultUrl);
        $('#' + statusId).show().text('✓ デフォルトに戻しました');
        toastr.info('デフォルト画像にリセットしました');
    }

    // Modals
    function openInquiryDetailModal(inq) {
        $('#modal_inq_name').text(inq.name || '-');
        $('#modal_inq_company').text(inq.company_name || '未記入');
        $('#modal_inq_email').text(inq.email || '-').attr('href', 'mailto:' + inq.email);
        $('#modal_inq_phone').text(inq.phone || '未記入');
        $('#modal_inq_service').text(inq.service_interest || '全般');
        $('#modal_inq_date').text(inq.created_at || '-');
        $('#modal_inq_message').text(inq.message || '本文なし');
        $('#modal_inq_reply_btn').attr('href', 'mailto:' + inq.email + '?subject=' + encodeURIComponent('【MIRANSH】お問い合わせへのご回答'));
        $('#inquiryDetailModal').modal('show');
    }

    function updateInquiryStatus(id, status) {
        fetch('/admin/inquiries/' + id + '/status', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({ status: status })
        })
        .then(r => r.json())
        .then(res => {
            toastr.success('対応ステータスを更新しました');
        })
        .catch(() => toastr.error('ステータス更新に失敗しました'));
    }

    function confirmDeleteInquiry(id, name) {
        Swal.fire({
            title: 'お問い合わせを削除しますか？',
            text: name + '様からのお問い合わせを完全に削除します。',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: '削除する',
            cancelButtonText: 'キャンセル'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '/admin/inquiries/' + id + '/delete';
                const csrf = document.createElement('input');
                csrf.type = 'hidden';
                csrf.name = '_token';
                csrf.value = '{{ csrf_token() }}';
                form.appendChild(csrf);
                document.body.appendChild(form);
                form.submit();
            }
        });
    }

    // Service Modals
    function openServiceCreateModal() {
        $('#serviceModalTitle').html('<i class="fas fa-plus mr-2"></i> 新規分野を追加');
        $('#serviceForm').attr('action', '{{ route("admin.services.store", [], false) }}');
        $('#svc_title_ja').val('');
        $('#svc_title_en').val('');
        $('#svc_icon').val('briefcase');
        $('#svc_sort_order').val('0');
        $('#svc_desc_ja').val('');
        $('#svc_desc_en').val('');
        $('#serviceModal').modal('show');
    }

    function openServiceEditModal(svc) {
        $('#serviceModalTitle').html('<i class="fas fa-edit mr-2"></i> 分野の編集: ' + svc.title_ja);
        $('#serviceForm').attr('action', '/admin/services/' + svc.id);
        $('#svc_title_ja').val(svc.title_ja);
        $('#svc_title_en').val(svc.title_en);
        $('#svc_icon').val(svc.icon || 'briefcase');
        $('#svc_sort_order').val(svc.sort_order || 0);
        $('#svc_desc_ja').val(svc.desc_ja);
        $('#svc_desc_en').val(svc.desc_en);
        $('#serviceModal').modal('show');
    }

    function confirmDeleteService(id, title) {
        Swal.fire({
            title: '分野を削除しますか？',
            text: '「' + title + '」を削除します。',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: '削除',
            cancelButtonText: 'キャンセル'
        }).then((res) => {
            if (res.isConfirmed) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '/admin/services/' + id + '/delete';
                const csrf = document.createElement('input');
                csrf.type = 'hidden';
                csrf.name = '_token';
                csrf.value = '{{ csrf_token() }}';
                form.appendChild(csrf);
                document.body.appendChild(form);
                form.submit();
            }
        });
    }

    // Story Modals
    function openStoryCreateModal() {
        $('#storyModalTitle').html('<i class="fas fa-plus mr-2"></i> 新規記事を作成');
        $('#storyForm').attr('action', '{{ route("admin.stories.store", [], false) }}');
        $('#st_title_ja').val('');
        $('#st_title_en').val('');
        $('#st_category_ja').val('採用事例');
        $('#st_published_date').val(new Date().toISOString().split('T')[0]);
        $('#st_featured').prop('checked', false);
        $('#st_summary_ja').val('');
        $('#st_summary_en').val('');
        $('#storyModal').modal('show');
    }

    function openStoryEditModal(st) {
        $('#storyModalTitle').html('<i class="fas fa-edit mr-2"></i> 記事の編集');
        $('#storyForm').attr('action', '/admin/stories/' + st.id);
        $('#st_title_ja').val(st.title_ja);
        $('#st_title_en').val(st.title_en);
        $('#st_category_ja').val(st.category_ja || '採用事例');
        $('#st_published_date').val(st.published_date || new Date().toISOString().split('T')[0]);
        $('#st_featured').prop('checked', !!st.featured);
        $('#st_summary_ja').val(st.summary_ja);
        $('#st_summary_en').val(st.summary_en);
        $('#storyModal').modal('show');
    }

    function confirmDeleteStory(id, title) {
        Swal.fire({
            title: '記事を削除しますか？',
            text: '「' + title + '」を削除します。',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: '削除',
            cancelButtonText: 'キャンセル'
        }).then((res) => {
            if (res.isConfirmed) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '/admin/stories/' + id + '/delete';
                const csrf = document.createElement('input');
                csrf.type = 'hidden';
                csrf.name = '_token';
                csrf.value = '{{ csrf_token() }}';
                form.appendChild(csrf);
                document.body.appendChild(form);
                form.submit();
            }
        });
    }

    // FAQ Modals
    function openFaqCreateModal() {
        $('#faqModalTitle').html('<i class="fas fa-plus mr-2"></i> 新規FAQを追加');
        $('#faqForm').attr('action', '{{ route("admin.faqs.store", [], false) }}');
        $('#faq_category_ja').val('特定技能・受入れ');
        $('#faq_sort_order').val('0');
        $('#faq_question_ja').val('');
        $('#faq_answer_ja').val('');
        $('#faqModal').modal('show');
    }

    function openFaqEditModal(fq) {
        $('#faqModalTitle').html('<i class="fas fa-edit mr-2"></i> FAQの編集');
        $('#faqForm').attr('action', '/admin/faqs/' + fq.id);
        $('#faq_category_ja').val(fq.category_ja || '一般');
        $('#faq_sort_order').val(fq.sort_order || 0);
        $('#faq_question_ja').val(fq.question_ja);
        $('#faq_answer_ja').val(fq.answer_ja);
        $('#faqModal').modal('show');
    }

    function confirmDeleteFaq(id) {
        Swal.fire({
            title: 'FAQを削除しますか？',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: '削除',
            cancelButtonText: 'キャンセル'
        }).then((res) => {
            if (res.isConfirmed) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '/admin/faqs/' + id + '/delete';
                const csrf = document.createElement('input');
                csrf.type = 'hidden';
                csrf.name = '_token';
                csrf.value = '{{ csrf_token() }}';
                form.appendChild(csrf);
                document.body.appendChild(form);
                form.submit();
            }
        });
    }

    // AI Diagnostic
    function runAiDiagnostic() {
        const consoleEl = $('#aiTestConsole');
        consoleEl.html('> Connecting to Sakana AI / Gemini engine...\n');
        fetch('/admin/api/sakana/test', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                consoleEl.append('> [SUCCESS] Status: OK\n> Latency: ' + (data.latency_ms || 42) + 'ms\n> Response: ' + JSON.stringify(data.sample_response || 'Online') + '\n');
                toastr.success('Sakana AI 疎通テストに成功しました');
            } else {
                consoleEl.append('> [ERROR] ' + (data.error || 'Connection failed') + '\n');
                toastr.error('AIテストに失敗しました');
            }
        })
        .catch(err => {
            consoleEl.append('> [FATAL] ' + err.message + '\n');
            toastr.error('通信エラー');
        });
    }

    // Charts Initialization
    document.addEventListener('DOMContentLoaded', function () {
        @if($activeTab === 'dashboard')
        // Trend Chart
        const trendCtx = document.getElementById('inquiriesTrendChart');
        if (trendCtx) {
            new Chart(trendCtx.getContext('2d'), {
                type: 'line',
                data: {
                    labels: ['4月', '5月', '6月', '7月', '8月', '9月'],
                    datasets: [
                        {
                            label: '企業採用相談 (Corporate Inquiries)',
                            data: [12, 19, 15, 25, 32, 40],
                            backgroundColor: 'rgba(0, 123, 255, 0.15)',
                            borderColor: '#007bff',
                            borderWidth: 2,
                            fill: true,
                            tension: 0.35
                        },
                        {
                            label: '外国人材応募 (Candidate Leads)',
                            data: [8, 14, 22, 28, 35, 48],
                            backgroundColor: 'rgba(40, 167, 69, 0.15)',
                            borderColor: '#28a745',
                            borderWidth: 2,
                            fill: true,
                            tension: 0.35
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'top' }
                    },
                    scales: {
                        y: { beginAtZero: true }
                    }
                }
            });
        }

        // Donut Chart
        const donutCtx = document.getElementById('sectorsDonutChart');
        if (donutCtx) {
            new Chart(donutCtx.getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: ['介護 (Nursing Care)', '外食 (Food Service)', 'ビルクリーニング', '製造・加工 (Manufacturing)', 'その他'],
                    datasets: [{
                        data: [35, 25, 20, 15, 5],
                        backgroundColor: ['#007bff', '#28a745', '#ffc107', '#17a2b8', '#6c757d']
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'bottom' }
                    }
                }
            });
        }
        @endif
    });
</script>
</body>
</html>
