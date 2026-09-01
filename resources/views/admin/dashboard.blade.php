<!DOCTYPE html>
<html lang="{{ $currentLang ?? 'ja' }}" data-admin-lang="{{ $currentLang ?? 'ja' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MIRANSH AdminLTE | Management Portal (日英切替対応)</title>
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
        :root {
            --primary-brand: #007bff;
        }
        body {
            font-family: "Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }

        /* Bilingual Display Engine (Supports both .admin-lang-* and .lang-*) */
        html[data-admin-lang="ja"] .admin-lang-en,
        html[data-admin-lang="ja"] .lang-en,
        html[data-lang="ja"] .admin-lang-en,
        html[data-lang="ja"] .lang-en,
        body.ja .admin-lang-en,
        body.ja .lang-en,
        body.admin-ja .admin-lang-en,
        body.admin-ja .lang-en {
            display: none !important;
        }

        html[data-admin-lang="en"] .admin-lang-ja,
        html[data-admin-lang="en"] .lang-ja,
        html[data-lang="en"] .admin-lang-ja,
        html[data-lang="en"] .lang-ja,
        body.en .admin-lang-ja,
        body.en .lang-ja,
        body.admin-en .admin-lang-ja,
        body.admin-en .lang-ja {
            display: none !important;
        }

        html[data-admin-lang="ja"] span.admin-lang-ja,
        html[data-admin-lang="ja"] span.lang-ja,
        body.ja span.admin-lang-ja,
        body.ja span.lang-ja {
            display: inline !important;
        }

        html[data-admin-lang="ja"] div.admin-lang-ja,
        html[data-admin-lang="ja"] p.admin-lang-ja,
        body.ja div.admin-lang-ja,
        body.ja p.admin-lang-ja {
            display: block !important;
        }

        html[data-admin-lang="en"] span.admin-lang-en,
        html[data-admin-lang="en"] span.lang-en,
        body.en span.admin-lang-en,
        body.en span.lang-en {
            display: inline !important;
        }

        html[data-admin-lang="en"] div.admin-lang-en,
        html[data-admin-lang="en"] p.admin-lang-en,
        body.en div.admin-lang-en,
        body.en p.admin-lang-en {
            display: block !important;
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
        .lang-switch-btn {
            font-size: 12px;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 20px;
            transition: all 0.2s ease;
        }
        /* Custom dark mode tweaks */
        body.dark-mode .card:not(.card-outline) {
            background-color: #343a40;
        }
        body.dark-mode .preview-img-box {
            border-color: #4b545c;
            background: #343a40;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed {{ $currentLang ?? 'ja' }}">
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
                <a class="nav-link" data-widget="pushmenu" href="#" role="button" title="Toggle Sidebar">
                    <i class="fas fa-bars"></i>
                </a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('admin.dashboard', ['tab' => 'dashboard'], false) }}" class="nav-link font-weight-bold {{ $activeTab === 'dashboard' ? 'text-primary' : '' }}">
                    <i class="fas fa-tachometer-alt mr-1"></i>
                    <span class="admin-lang-ja">ダッシュボード</span>
                    <span class="admin-lang-en">Dashboard</span>
                </a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('admin.dashboard', ['tab' => 'inquiries'], false) }}" class="nav-link {{ $activeTab === 'inquiries' ? 'text-primary font-weight-bold' : '' }}">
                    <i class="fas fa-envelope mr-1"></i>
                    <span class="admin-lang-ja">お問い合わせ</span>
                    <span class="admin-lang-en">Inquiries</span>
                    @if($newInquiriesCount > 0)
                        <span class="badge badge-danger ml-1">{{ $newInquiriesCount }}</span>
                    @endif
                </a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('home', [], false) }}" target="_blank" class="nav-link text-info">
                    <i class="fas fa-external-link-alt mr-1"></i>
                    <span class="admin-lang-ja">公開サイト確認 ↗</span>
                    <span class="admin-lang-en">View Live Site ↗</span>
                </a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto align-items-center">
            
            <!-- Language Switcher: JA / EN -->
            <li class="nav-item d-flex align-items-center mr-2">
                <div class="btn-group btn-group-sm border rounded p-1 bg-light shadow-none" role="group" aria-label="Language Selector">
                    <button type="button" class="btn btn-xs lang-switch-btn {{ ($currentLang ?? 'ja') === 'ja' ? 'btn-primary text-white font-weight-bold' : 'btn-light text-dark font-weight-bold' }}" id="admin-btn-ja" onclick="setAdminLanguage('ja')">
                        🇯🇵 日本語
                    </button>
                    <button type="button" class="btn btn-xs lang-switch-btn {{ ($currentLang ?? 'ja') === 'en' ? 'btn-primary text-white font-weight-bold' : 'btn-light text-dark font-weight-bold' }}" id="admin-btn-en" onclick="setAdminLanguage('en')">
                        🇺🇸 English
                    </button>
                </div>
            </li>

            <!-- Dark / Light Mode Switcher -->
            <li class="nav-item">
                <a class="nav-link" href="javascript:void(0)" onclick="toggleAdminDarkMode()" title="Toggle Dark/Light Mode">
                    <i class="fas fa-moon" id="theme-toggle-icon"></i>
                </a>
            </li>

            <!-- Inquiries & Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#" title="Inquiries Notification">
                    <i class="far fa-bell"></i>
                    @if($pendingInquiriesCount > 0)
                        <span class="badge badge-warning navbar-badge">{{ $pendingInquiriesCount }}</span>
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right shadow-sm">
                    <span class="dropdown-header font-weight-bold">
                        <span class="admin-lang-ja">{{ $inquiries->count() }} 件のお問い合わせ ({{ $pendingInquiriesCount }} 件 未完了)</span>
                        <span class="admin-lang-en">{{ $inquiries->count() }} Total Inquiries ({{ $pendingInquiriesCount }} Pending)</span>
                    </span>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('admin.dashboard', ['tab' => 'inquiries'], false) }}" class="dropdown-item">
                        <i class="fas fa-envelope text-primary mr-2"></i> {{ $newInquiriesCount }}
                        <span class="admin-lang-ja">件の新着メッセージ</span>
                        <span class="admin-lang-en">New Messages</span>
                        <span class="float-right text-muted text-sm font-weight-bold">
                            <span class="admin-lang-ja">新規</span>
                            <span class="admin-lang-en">New</span>
                        </span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('admin.dashboard', ['tab' => 'inquiries'], false) }}" class="dropdown-item">
                        <i class="fas fa-clock text-warning mr-2"></i> {{ $inProgressInquiriesCount }}
                        <span class="admin-lang-ja">件の対応中案件</span>
                        <span class="admin-lang-en">In Progress Leads</span>
                        <span class="float-right text-muted text-sm">
                            <span class="admin-lang-ja">進行中</span>
                            <span class="admin-lang-en">Active</span>
                        </span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('admin.dashboard', ['tab' => 'inquiries'], false) }}" class="dropdown-item dropdown-footer text-primary font-weight-bold">
                        <span class="admin-lang-ja">すべてのお問い合わせを見る</span>
                        <span class="admin-lang-en">View All Inquiries</span>
                    </a>
                </div>
            </li>

            <!-- Fullscreen Toggle -->
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button" title="Toggle Fullscreen">
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
                    <!-- User image -->
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
                                <a href="{{ route('admin.dashboard', ['tab' => 'inquiries'], false) }}" class="text-dark font-weight-bold">
                                    <span class="admin-lang-ja">リード</span>
                                    <span class="admin-lang-en">Leads</span><br>
                                    <span class="badge badge-primary">{{ $inquiries->count() }}</span>
                                </a>
                            </div>
                            <div class="col-4">
                                <a href="{{ route('admin.dashboard', ['tab' => 'services'], false) }}" class="text-dark font-weight-bold">
                                    <span class="admin-lang-ja">分野</span>
                                    <span class="admin-lang-en">Sectors</span><br>
                                    <span class="badge badge-success">{{ $services->count() }}</span>
                                </a>
                            </div>
                            <div class="col-4">
                                <a href="{{ route('admin.dashboard', ['tab' => 'stories'], false) }}" class="text-dark font-weight-bold">
                                    <span class="admin-lang-ja">事例</span>
                                    <span class="admin-lang-en">Stories</span><br>
                                    <span class="badge badge-info">{{ $stories->count() }}</span>
                                </a>
                            </div>
                        </div>
                    </li>
                    <li class="user-footer d-flex justify-content-between">
                        <a href="{{ route('admin.dashboard', ['tab' => 'users'], false) }}" class="btn btn-default btn-flat text-sm">
                            <i class="fas fa-user-cog mr-1"></i>
                            <span class="admin-lang-ja">アカウント設定</span>
                            <span class="admin-lang-en">Account Settings</span>
                        </a>
                        <form action="{{ route('admin.logout', [], false) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-flat text-sm">
                                <i class="fas fa-sign-out-alt mr-1"></i>
                                <span class="admin-lang-ja">ログアウト</span>
                                <span class="admin-lang-en">Log Out</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </li>

            <!-- Control Sidebar Toggle -->
            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button" title="System Settings">
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
            <!-- Sidebar user panel -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
                <div class="image">
                    <img src="{{ $company->ceo_image ?? '/images/ceo_portrait.jpg' }}" class="img-circle elevation-2" alt="User" onerror="this.src='/images/logo-icon.png'">
                </div>
                <div class="info">
                    <a href="{{ route('admin.dashboard', ['tab' => 'users'], false) }}" class="d-block font-weight-bold text-white">{{ $currentAdminUser->name ?? 'Administrator' }}</a>
                    <span class="badge badge-success text-xs">
                        <i class="fas fa-circle text-xs mr-1"></i>
                        <span class="admin-lang-ja">管理者 (Online)</span>
                        <span class="admin-lang-en">Admin (Online)</span>
                    </span>
                </div>
            </div>

            <!-- Sidebar Search -->
            <div class="form-inline mb-2">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search menu / 検索..." aria-label="Search">
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
                                <span class="admin-lang-ja">ダッシュボード & 分析</span>
                                <span class="admin-lang-en">Dashboard & Analytics</span>
                                <span class="right badge badge-primary">KPI</span>
                            </p>
                        </a>
                    </li>

                    <li class="nav-header font-weight-bold text-uppercase text-secondary">
                        <span class="admin-lang-ja">基本管理 (CORE)</span>
                        <span class="admin-lang-en">CORE MANAGEMENT</span>
                    </li>
                    
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard', ['tab' => 'inquiries'], false) }}" class="nav-link {{ $activeTab === 'inquiries' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-envelope"></i>
                            <p>
                                <span class="admin-lang-ja">お問い合わせ・リード</span>
                                <span class="admin-lang-en">Inquiries & Leads</span>
                                <span class="badge badge-warning right">{{ $inquiries->count() }}</span>
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard', ['tab' => 'company'], false) }}" class="nav-link {{ $activeTab === 'company' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-building"></i>
                            <p>
                                <span class="admin-lang-ja">会社情報 & CEOメディア</span>
                                <span class="admin-lang-en">Company Info & CEO</span>
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard', ['tab' => 'about'], false) }}" class="nav-link {{ $activeTab === 'about' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-award"></i>
                            <p>
                                <span class="admin-lang-ja">企業理念 & About Us</span>
                                <span class="admin-lang-en">About Us & Vision</span>
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard', ['tab' => 'services'], false) }}" class="nav-link {{ $activeTab === 'services' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-briefcase"></i>
                            <p>
                                <span class="admin-lang-ja">特定技能・事業内容</span>
                                <span class="admin-lang-en">SSW Services</span>
                                <span class="badge badge-info right">{{ $services->count() }}</span>
                            </p>
                        </a>
                    </li>

                    <li class="nav-header font-weight-bold text-uppercase text-secondary">
                        <span class="admin-lang-ja">コンテンツ (CONTENT)</span>
                        <span class="admin-lang-en">CONTENT & MEDIA</span>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard', ['tab' => 'stories'], false) }}" class="nav-link {{ $activeTab === 'stories' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-newspaper"></i>
                            <p>
                                <span class="admin-lang-ja">採用事例・お知らせ</span>
                                <span class="admin-lang-en">Case Stories & News</span>
                                <span class="badge badge-success right">{{ $stories->count() }}</span>
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard', ['tab' => 'faqs'], false) }}" class="nav-link {{ $activeTab === 'faqs' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-question-circle"></i>
                            <p>
                                <span class="admin-lang-ja">FAQ よくある質問</span>
                                <span class="admin-lang-en">FAQs</span>
                                <span class="badge badge-secondary right">{{ $faqs->count() }}</span>
                            </p>
                        </a>
                    </li>

                    <li class="nav-header font-weight-bold text-uppercase text-secondary">
                        <span class="admin-lang-ja">AI & システム</span>
                        <span class="admin-lang-en">AI & SYSTEM</span>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard', ['tab' => 'ai'], false) }}" class="nav-link {{ $activeTab === 'ai' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-microchip"></i>
                            <p>
                                <span class="admin-lang-ja">Sakana AI 相談エンジン</span>
                                <span class="admin-lang-en">Sakana AI Engine</span>
                                <span class="badge badge-success right">Online</span>
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard', ['tab' => 'users'], false) }}" class="nav-link {{ $activeTab === 'users' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-shield"></i>
                            <p>
                                <span class="admin-lang-ja">管理者アカウント設定</span>
                                <span class="admin-lang-en">Admin Credentials</span>
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard', ['tab' => 'timeline'], false) }}" class="nav-link {{ $activeTab === 'timeline' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-history"></i>
                            <p>
                                <span class="admin-lang-ja">操作ログ・タイムライン</span>
                                <span class="admin-lang-en">Activity Timeline</span>
                            </p>
                        </a>
                    </li>

                    <li class="nav-item mt-3">
                        <a href="{{ route('home', [], false) }}" target="_blank" class="nav-link bg-secondary text-white">
                            <i class="nav-icon fas fa-external-link-alt"></i>
                            <p>
                                <span class="admin-lang-ja">公開サイトを開く ↗</span>
                                <span class="admin-lang-en">View Live Website ↗</span>
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <!-- Content Header -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2 align-items-center">
                    <div class="col-sm-6">
                        <h1 class="m-0 font-weight-bold text-dark text-capitalize">
                            @if($activeTab === 'dashboard')
                                <i class="fas fa-chart-pie text-primary mr-2"></i>
                                <span class="admin-lang-ja">ダッシュボード & KPI分析</span>
                                <span class="admin-lang-en">Dashboard & Analytics Overview</span>
                            @elseif($activeTab === 'company')
                                <i class="fas fa-building text-primary mr-2"></i>
                                <span class="admin-lang-ja">会社情報 & CEOメディア設定</span>
                                <span class="admin-lang-en">Company Information & CEO Media</span>
                            @elseif($activeTab === 'about')
                                <i class="fas fa-award text-primary mr-2"></i>
                                <span class="admin-lang-ja">企業理念 & About Us設定</span>
                                <span class="admin-lang-en">About Us & Corporate Philosophy</span>
                            @elseif($activeTab === 'services')
                                <i class="fas fa-briefcase text-primary mr-2"></i>
                                <span class="admin-lang-ja">特定技能・事業内容管理</span>
                                <span class="admin-lang-en">SSW Services Management</span>
                            @elseif($activeTab === 'stories')
                                <i class="fas fa-newspaper text-primary mr-2"></i>
                                <span class="admin-lang-ja">採用事例・ニュース管理</span>
                                <span class="admin-lang-en">Case Stories & News Management</span>
                            @elseif($activeTab === 'faqs')
                                <i class="fas fa-question-circle text-primary mr-2"></i>
                                <span class="admin-lang-ja">よくある質問 (FAQ) 管理</span>
                                <span class="admin-lang-en">Frequently Asked Questions (FAQ)</span>
                            @elseif($activeTab === 'inquiries')
                                <i class="fas fa-envelope text-primary mr-2"></i>
                                <span class="admin-lang-ja">お問い合わせ・リード管理</span>
                                <span class="admin-lang-en">Inquiries & Leads CRM</span>
                            @elseif($activeTab === 'ai')
                                <i class="fas fa-microchip text-primary mr-2"></i>
                                <span class="admin-lang-ja">Sakana AI 相談エンジン設定</span>
                                <span class="admin-lang-en">Sakana AI Engine Management</span>
                            @elseif($activeTab === 'users')
                                <i class="fas fa-user-shield text-primary mr-2"></i>
                                <span class="admin-lang-ja">管理者アカウント設定</span>
                                <span class="admin-lang-en">Admin Credentials & Security</span>
                            @elseif($activeTab === 'timeline')
                                <i class="fas fa-history text-primary mr-2"></i>
                                <span class="admin-lang-ja">操作ログ・更新履歴</span>
                                <span class="admin-lang-en">Activity Log & Audit Trail</span>
                            @endif
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard', [], false) }}">Admin</a></li>
                            <li class="breadcrumb-item active text-capitalize">{{ $activeTab }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                        <i class="icon fas fa-check-circle mr-2"></i> {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                        <i class="icon fas fa-ban mr-2"></i> <strong>Error:</strong> {{ $errors->first() }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <!-- TAB: DASHBOARD KPI -->
                @if($activeTab === 'dashboard')
                    <div class="row">
                        <!-- KPI 1 -->
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-info shadow-sm">
                                <div class="inner">
                                    <h3>{{ $inquiries->count() }}</h3>
                                    <p>
                                        <span class="admin-lang-ja">総お問い合わせ数</span>
                                        <span class="admin-lang-en">Total Inquiries</span>
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <a href="{{ route('admin.dashboard', ['tab' => 'inquiries'], false) }}" class="small-box-footer">
                                    <span class="admin-lang-ja">詳細を確認 <i class="fas fa-arrow-circle-right ml-1"></i></span>
                                    <span class="admin-lang-en">View Details <i class="fas fa-arrow-circle-right ml-1"></i></span>
                                </a>
                            </div>
                        </div>
                        <!-- KPI 2 -->
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-warning shadow-sm">
                                <div class="inner">
                                    <h3 class="text-white">{{ $pendingInquiriesCount }}</h3>
                                    <p class="text-white">
                                        <span class="admin-lang-ja">未対応・対応中リード</span>
                                        <span class="admin-lang-en">Pending / Active Leads</span>
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-user-clock"></i>
                                </div>
                                <a href="{{ route('admin.dashboard', ['tab' => 'inquiries'], false) }}" class="small-box-footer" style="color: rgba(255,255,255,0.9)!important;">
                                    <span class="admin-lang-ja">対応リスト <i class="fas fa-arrow-circle-right ml-1"></i></span>
                                    <span class="admin-lang-en">Action List <i class="fas fa-arrow-circle-right ml-1"></i></span>
                                </a>
                            </div>
                        </div>
                        <!-- KPI 3 -->
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-success shadow-sm">
                                <div class="inner">
                                    <h3>{{ $services->count() }}</h3>
                                    <p>
                                        <span class="admin-lang-ja">登録事業・特定技能分野</span>
                                        <span class="admin-lang-en">Active SSW Sectors</span>
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-briefcase"></i>
                                </div>
                                <a href="{{ route('admin.dashboard', ['tab' => 'services'], false) }}" class="small-box-footer">
                                    <span class="admin-lang-ja">事業分野管理 <i class="fas fa-arrow-circle-right ml-1"></i></span>
                                    <span class="admin-lang-en">Manage Sectors <i class="fas fa-arrow-circle-right ml-1"></i></span>
                                </a>
                            </div>
                        </div>
                        <!-- KPI 4 -->
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-danger shadow-sm">
                                <div class="inner">
                                    <h3>{{ $stories->count() }}</h3>
                                    <p>
                                        <span class="admin-lang-ja">公開採用事例 & 記事</span>
                                        <span class="admin-lang-en">Published Stories</span>
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-newspaper"></i>
                                </div>
                                <a href="{{ route('admin.dashboard', ['tab' => 'stories'], false) }}" class="small-box-footer">
                                    <span class="admin-lang-ja">記事管理 <i class="fas fa-arrow-circle-right ml-1"></i></span>
                                    <span class="admin-lang-en">Manage Stories <i class="fas fa-arrow-circle-right ml-1"></i></span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Charts Row -->
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card card-primary card-outline shadow-sm">
                                <div class="card-header border-0">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h3 class="card-title font-weight-bold">
                                            <i class="fas fa-chart-line mr-1 text-primary"></i>
                                            <span class="admin-lang-ja">月別 お問い合わせ & 採用相談推移</span>
                                            <span class="admin-lang-en">Monthly Inquiries & Recruitment Trends</span>
                                        </h3>
                                        <div class="card-tools">
                                            <span class="badge badge-light border">2026年度</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="position-relative mb-4" style="height: 280px;">
                                        <canvas id="inquiriesTrendChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card card-info card-outline shadow-sm">
                                <div class="card-header border-0">
                                    <h3 class="card-title font-weight-bold">
                                        <i class="fas fa-chart-pie mr-1 text-info"></i>
                                        <span class="admin-lang-ja">特定技能 分野別相談比率</span>
                                        <span class="admin-lang-en">SSW Inquiries by Sector</span>
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div class="position-relative mb-4" style="height: 280px;">
                                        <canvas id="sectorsDonutChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- TAB: INQUIRIES -->
                @if($activeTab === 'inquiries')
                    <div class="card card-primary card-outline shadow-sm">
                        <div class="card-header">
                            <h3 class="card-title font-weight-bold">
                                <i class="fas fa-envelope-open-text mr-1 text-primary"></i>
                                <span class="admin-lang-ja">お問い合わせ・リード一覧</span>
                                <span class="admin-lang-en">Inquiries & Leads Management</span>
                            </h3>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover table-striped table-middle text-nowrap" id="inquiriesTable">
                                <thead class="bg-light">
                                    <tr>
                                        <th style="width: 50px;">ID</th>
                                        <th>
                                            <span class="admin-lang-ja">お名前 / 企業名</span>
                                            <span class="admin-lang-en">Name / Organization</span>
                                        </th>
                                        <th>
                                            <span class="admin-lang-ja">連絡先</span>
                                            <span class="admin-lang-en">Contact Info</span>
                                        </th>
                                        <th>
                                            <span class="admin-lang-ja">関心分野</span>
                                            <span class="admin-lang-en">Service Interest</span>
                                        </th>
                                        <th>
                                            <span class="admin-lang-ja">ステータス</span>
                                            <span class="admin-lang-en">Status</span>
                                        </th>
                                        <th>
                                            <span class="admin-lang-ja">受信日時</span>
                                            <span class="admin-lang-en">Received At</span>
                                        </th>
                                        <th class="text-right" style="width: 160px;">
                                            <span class="admin-lang-ja">操作</span>
                                            <span class="admin-lang-en">Actions</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($inquiries as $inq)
                                        <tr>
                                            <td>#{{ $inq->id }}</td>
                                            <td>
                                                <div class="font-weight-bold">{{ $inq->name }}</div>
                                                <div class="text-xs text-muted">{{ $inq->company_name ?? '個人 / Individual' }}</div>
                                            </td>
                                            <td>
                                                <div class="text-sm"><a href="mailto:{{ $inq->email }}">{{ $inq->email }}</a></div>
                                                <div class="text-xs text-muted">{{ $inq->phone ?? '-' }}</div>
                                            </td>
                                            <td>
                                                <span class="badge badge-light border">{{ $inq->service_interest ?? '全般 / General' }}</span>
                                            </td>
                                            <td>
                                                @if($inq->status === 'resolved')
                                                    <span class="badge badge-success status-badge">
                                                        <i class="fas fa-check mr-1"></i>
                                                        <span class="admin-lang-ja">対応済</span>
                                                        <span class="admin-lang-en">Resolved</span>
                                                    </span>
                                                @elseif($inq->status === 'in_progress')
                                                    <span class="badge badge-warning text-white status-badge">
                                                        <i class="fas fa-clock mr-1"></i>
                                                        <span class="admin-lang-ja">対応中</span>
                                                        <span class="admin-lang-en">In Progress</span>
                                                    </span>
                                                @else
                                                    <span class="badge badge-danger status-badge">
                                                        <i class="fas fa-envelope mr-1"></i>
                                                        <span class="admin-lang-ja">未対応 (新規)</span>
                                                        <span class="admin-lang-en">New</span>
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                <small class="text-muted">{{ $inq->created_at ? $inq->created_at->format('Y/m/d H:i') : '-' }}</small>
                                            </td>
                                            <td class="text-right">
                                                <button type="button" class="btn btn-xs btn-info font-weight-bold mr-1" onclick="viewInquiryDetail({{ json_encode($inq) }})">
                                                    <i class="fas fa-eye mr-1"></i>
                                                    <span class="admin-lang-ja">詳細</span>
                                                    <span class="admin-lang-en">View</span>
                                                </button>
                                                <form action="{{ route('admin.inquiries.delete', $inq->id, false) }}" method="POST" class="d-inline" onsubmit="return confirm('このお問い合わせを削除しますか？ / Delete this inquiry?');">
                                                    @csrf
                                                    <button type="submit" class="btn btn-xs btn-danger font-weight-bold">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted py-4">
                                                <span class="admin-lang-ja">お問い合わせデータはありません</span>
                                                <span class="admin-lang-en">No inquiries found</span>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif

                <!-- TAB: COMPANY -->
                @if($activeTab === 'company')
                    <form action="{{ route('admin.company.update', [], false) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card card-primary card-outline shadow-sm">
                            <div class="card-header">
                                <h3 class="card-title font-weight-bold">
                                    <i class="fas fa-building mr-1 text-primary"></i>
                                    <span class="admin-lang-ja">会社情報 & CEOメディア編集 (日英バイリンガル)</span>
                                    <span class="admin-lang-en">Company Profile & CEO Media Management</span>
                                </h3>
                                <div class="card-tools">
                                    <button type="submit" class="btn btn-sm btn-primary font-weight-bold">
                                        <i class="fas fa-save mr-1"></i>
                                        <span class="admin-lang-ja">保存する</span>
                                        <span class="admin-lang-en">Save Changes</span>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card card-secondary card-outline">
                                            <div class="card-header py-2 bg-light">
                                                <h6 class="m-0 font-weight-bold text-dark"><span class="badge badge-primary mr-1">JA</span> 会社情報 (日本語)</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label>法人名 / Company Name (JA)</label>
                                                    <input type="text" name="name_ja" class="form-control" value="{{ $company->name_ja ?? 'MIRANSH合同会社' }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>代表者名 / CEO Name (JA)</label>
                                                    <input type="text" name="representative_ja" class="form-control" value="{{ $company->representative_ja ?? '代表社員' }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>所在地 / Address (JA)</label>
                                                    <input type="text" name="address_ja" class="form-control" value="{{ $company->address_ja ?? '' }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>代表挨拶タイトル / CEO Vision Title (JA)</label>
                                                    <input type="text" name="ceo_vision_title_ja" class="form-control" value="{{ $company->ceo_vision_title_ja ?? '' }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>代表挨拶メッセージ / CEO Message (JA)</label>
                                                    <textarea name="ceo_message_ja" class="form-control" rows="5">{{ $company->ceo_message_ja ?? '' }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card card-secondary card-outline">
                                            <div class="card-header py-2 bg-light">
                                                <h6 class="m-0 font-weight-bold text-dark"><span class="badge badge-success mr-1">EN</span> Company Information (English)</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label>Company Name (EN)</label>
                                                    <input type="text" name="name_en" class="form-control" value="{{ $company->name_en ?? 'MIRANSH LLC' }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>CEO Name (EN)</label>
                                                    <input type="text" name="representative_en" class="form-control" value="{{ $company->representative_en ?? 'Representative Partner' }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Address (EN)</label>
                                                    <input type="text" name="address_en" class="form-control" value="{{ $company->address_en ?? '' }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>CEO Vision Title (EN)</label>
                                                    <input type="text" name="ceo_vision_title_en" class="form-control" value="{{ $company->ceo_vision_title_en ?? '' }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>CEO Message (EN)</label>
                                                    <textarea name="ceo_message_en" class="form-control" rows="5">{{ $company->ceo_message_en ?? '' }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="card card-info card-outline">
                                            <div class="card-header py-2 bg-light">
                                                <h6 class="m-0 font-weight-bold text-dark"><i class="fas fa-image mr-1"></i> CEO 顔写真 / Executive Portrait</h6>
                                            </div>
                                            <div class="card-body text-center">
                                                <img src="{{ $company->ceo_image ?? '/images/ceo_portrait.jpg' }}" id="ceoPreviewImg" class="preview-img-box mb-3" style="width: 140px; height: 140px; border-radius: 50%;" alt="CEO Preview" onerror="this.src='/images/logo-icon.png'">
                                                <div class="form-group text-left">
                                                    <label class="text-xs">画像URL / Image Path</label>
                                                    <input type="text" name="ceo_image" id="ceo_image_url" class="form-control form-control-sm" value="{{ $company->ceo_image ?? '/images/ceo_portrait.jpg' }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card card-info card-outline">
                                            <div class="card-header py-2 bg-light">
                                                <h6 class="m-0 font-weight-bold text-dark"><i class="fas fa-phone-alt mr-1"></i> 連絡先 & 許可番号 / Contacts & License</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label>電話番号 / Phone Number</label>
                                                    <input type="text" name="phone" class="form-control" value="{{ $company->phone ?? '042-203-5163' }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>代表メール / Official Email</label>
                                                    <input type="email" name="email" class="form-control" value="{{ $company->email ?? 'info@miransh.co.jp' }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>有料職業紹介 許可番号 / License Number</label>
                                                    <input type="text" name="license_number" class="form-control" value="{{ $company->license_number ?? '13-ユ-319558' }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary font-weight-bold">
                                    <i class="fas fa-save mr-1"></i>
                                    <span class="admin-lang-ja">設定を保存する</span>
                                    <span class="admin-lang-en">Save Configuration</span>
                                </button>
                            </div>
                        </div>
                    </form>
                @endif

                <!-- Other Tabs: Services, Stories, FAQs, About, AI, Users, Timeline -->
                @if($activeTab === 'services')
                    <div class="card card-primary card-outline shadow-sm">
                        <div class="card-header">
                            <h3 class="card-title font-weight-bold">
                                <i class="fas fa-briefcase mr-1 text-primary"></i>
                                <span class="admin-lang-ja">特定技能・事業内容一覧</span>
                                <span class="admin-lang-en">SSW Services List</span>
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-sm btn-primary font-weight-bold" data-toggle="modal" data-target="#modal-service-create">
                                    <i class="fas fa-plus mr-1"></i>
                                    <span class="admin-lang-ja">新規事業を追加</span>
                                    <span class="admin-lang-en">Add New Service</span>
                                </button>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover table-striped table-middle">
                                <thead class="bg-light">
                                    <tr>
                                        <th style="width: 50px;">ID</th>
                                        <th>
                                            <span class="admin-lang-ja">事業タイトル (JA / EN)</span>
                                            <span class="admin-lang-en">Service Title (JA / EN)</span>
                                        </th>
                                        <th>
                                            <span class="admin-lang-ja">概要説明</span>
                                            <span class="admin-lang-en">Description</span>
                                        </th>
                                        <th style="width: 80px;">Icon</th>
                                        <th class="text-right" style="width: 140px;">
                                            <span class="admin-lang-ja">操作</span>
                                            <span class="admin-lang-en">Actions</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($services as $s)
                                        <tr>
                                            <td>#{{ $s->id }}</td>
                                            <td>
                                                <div class="font-weight-bold text-primary">{{ $s->title_ja }}</div>
                                                <div class="text-xs text-muted">{{ $s->title_en }}</div>
                                            </td>
                                            <td>
                                                <div class="text-sm text-truncate" style="max-width: 380px;">{{ $s->desc_ja }}</div>
                                            </td>
                                            <td><span class="badge badge-light border">{{ $s->icon }}</span></td>
                                            <td class="text-right">
                                                <button type="button" class="btn btn-xs btn-info font-weight-bold mr-1" onclick="openServiceEdit({{ json_encode($s) }})">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <form action="{{ route('admin.services.delete', $s->id, false) }}" method="POST" class="d-inline" onsubmit="return confirm('この事業を削除しますか？ / Delete this service?');">
                                                    @csrf
                                                    <button type="submit" class="btn btn-xs btn-danger font-weight-bold">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-muted py-4">
                                                <span class="admin-lang-ja">登録された事業はありません</span>
                                                <span class="admin-lang-en">No services registered</span>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif

                @if($activeTab === 'stories')
                    <div class="card card-primary card-outline shadow-sm">
                        <div class="card-header">
                            <h3 class="card-title font-weight-bold">
                                <i class="fas fa-newspaper mr-1 text-primary"></i>
                                <span class="admin-lang-ja">採用事例・記事一覧</span>
                                <span class="admin-lang-en">Case Stories & News</span>
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-sm btn-primary font-weight-bold" data-toggle="modal" data-target="#modal-story-create">
                                    <i class="fas fa-plus mr-1"></i>
                                    <span class="admin-lang-ja">新規記事を投稿</span>
                                    <span class="admin-lang-en">Add New Story</span>
                                </button>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover table-striped table-middle">
                                <thead class="bg-light">
                                    <tr>
                                        <th style="width: 50px;">ID</th>
                                        <th>
                                            <span class="admin-lang-ja">タイトル (JA / EN)</span>
                                            <span class="admin-lang-en">Title (JA / EN)</span>
                                        </th>
                                        <th>
                                            <span class="admin-lang-ja">カテゴリ</span>
                                            <span class="admin-lang-en">Category</span>
                                        </th>
                                        <th>
                                            <span class="admin-lang-ja">公開日</span>
                                            <span class="admin-lang-en">Published</span>
                                        </th>
                                        <th class="text-right" style="width: 140px;">
                                            <span class="admin-lang-ja">操作</span>
                                            <span class="admin-lang-en">Actions</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($stories as $st)
                                        <tr>
                                            <td>#{{ $st->id }}</td>
                                            <td>
                                                <div class="font-weight-bold text-primary">{{ $st->title_ja }}</div>
                                                <div class="text-xs text-muted">{{ $st->title_en }}</div>
                                            </td>
                                            <td><span class="badge badge-info">{{ $st->category_ja }}</span></td>
                                            <td><small class="text-muted">{{ $st->published_date }}</small></td>
                                            <td class="text-right">
                                                <form action="{{ route('admin.stories.delete', $st->id, false) }}" method="POST" class="d-inline" onsubmit="return confirm('この記事を削除しますか？ / Delete this story?');">
                                                    @csrf
                                                    <button type="submit" class="btn btn-xs btn-danger font-weight-bold">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-muted py-4">
                                                <span class="admin-lang-ja">記事はありません</span>
                                                <span class="admin-lang-en">No stories found</span>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif

            </div>
        </section>
    </div>

    <!-- Main Footer -->
    <footer class="main-footer text-sm">
        <div class="float-right d-none d-sm-inline">
            <strong>MIRANSH LLC</strong> <span class="text-muted">| License No. 13-ユ-319558</span>
        </div>
        <strong>&copy; 2026 MIRANSH合同会社.</strong> 
        <span class="admin-lang-ja">特定技能・国際人材ソリューション ポータル (AdminLTE v3.2)</span>
        <span class="admin-lang-en">International HR & SSW Management Portal</span>
    </footer>

    <!-- Control Sidebar (Right settings panel) -->
    <aside class="control-sidebar control-sidebar-dark">
        <div class="p-3">
            <h5 class="font-weight-bold">
                <span class="admin-lang-ja">システム設定</span>
                <span class="admin-lang-en">System Info</span>
            </h5>
            <hr class="mb-2">
            <p class="text-xs text-muted mb-2">
                <span class="admin-lang-ja">MIRANSH 管理ポータル (AdminLTE v3.2)</span>
                <span class="admin-lang-en">MIRANSH Management Portal (AdminLTE v3.2)</span>
            </p>
            <div class="mb-3">
                <label class="text-xs font-weight-bold text-light">
                    <span class="admin-lang-ja">言語切替 (Language Switcher)</span>
                    <span class="admin-lang-en">Language Switcher</span>
                </label>
                <div class="btn-group btn-group-sm w-100">
                    <button type="button" class="btn btn-primary font-weight-bold" id="sidebar-btn-ja" onclick="setAdminLanguage('ja')">🇯🇵 日本語</button>
                    <button type="button" class="btn btn-secondary" id="sidebar-btn-en" onclick="setAdminLanguage('en')">🇺🇸 English</button>
                </div>
            </div>
        </div>
    </aside>

</div>

<!-- Inquiry Modal -->
<div class="modal fade" id="modal-inquiry-detail" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title font-weight-bold">
                    <i class="fas fa-envelope-open mr-1"></i>
                    <span class="admin-lang-ja">お問い合わせ詳細</span>
                    <span class="admin-lang-en">Inquiry / Lead Details</span>
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="inquiryDetailBody"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <span class="admin-lang-ja">閉じる</span>
                    <span class="admin-lang-en">Close</span>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Admin Scripts: jQuery, Bootstrap 4, AdminLTE, Chart.js, SweetAlert2, Toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

<script>
    // Bilingual Admin UI Switcher
    function setAdminLanguage(lang) {
        if (!lang) lang = 'ja';
        localStorage.setItem('miransh_admin_lang', lang);
        localStorage.setItem('miransh_lang', lang);
        document.documentElement.setAttribute('data-admin-lang', lang);
        document.documentElement.setAttribute('data-lang', lang);
        document.documentElement.setAttribute('lang', lang);

        if (document.body) {
            document.body.classList.remove('ja', 'en', 'admin-ja', 'admin-en');
            document.body.classList.add(lang, 'admin-' + lang);
        }

        // Update Top Navbar Switcher Buttons
        const btnJa = document.getElementById('admin-btn-ja');
        const btnEn = document.getElementById('admin-btn-en');
        if (btnJa && btnEn) {
            if (lang === 'ja') {
                btnJa.className = 'btn btn-xs lang-switch-btn btn-primary text-white font-weight-bold';
                btnEn.className = 'btn btn-xs lang-switch-btn btn-light text-dark font-weight-bold';
            } else {
                btnEn.className = 'btn btn-xs lang-switch-btn btn-primary text-white font-weight-bold';
                btnJa.className = 'btn btn-xs lang-switch-btn btn-light text-dark font-weight-bold';
            }
        }

        // Update Sidebar/Drawer Buttons if present
        const sideBtnJa = document.getElementById('sidebar-btn-ja');
        const sideBtnEn = document.getElementById('sidebar-btn-en');
        if (sideBtnJa && sideBtnEn) {
            if (lang === 'ja') {
                sideBtnJa.className = 'btn btn-sm btn-primary font-weight-bold';
                sideBtnEn.className = 'btn btn-sm btn-secondary';
            } else {
                sideBtnEn.className = 'btn btn-sm btn-primary font-weight-bold';
                sideBtnJa.className = 'btn btn-sm btn-secondary';
            }
        }
    }
    window.setAdminLanguage = setAdminLanguage;

    // Initialize Language & Theme on Load
    (function() {
        const urlParams = new URLSearchParams(window.location.search);
        const queryLang = urlParams.get('lang');
        const savedLang = queryLang || localStorage.getItem('miransh_admin_lang') || localStorage.getItem('miransh_lang') || '{{ $currentLang ?? "ja" }}';
        setAdminLanguage(savedLang);

        if (localStorage.getItem('miransh_admin_dark') === 'true') {
            document.body.classList.add('dark-mode');
            const icon = document.getElementById('theme-toggle-icon');
            if (icon) icon.className = 'fas fa-sun';
        }
    })();

    function toggleAdminDarkMode() {
        document.body.classList.toggle('dark-mode');
        const isDark = document.body.classList.contains('dark-mode');
        localStorage.setItem('miransh_admin_dark', isDark);
        const icon = document.getElementById('theme-toggle-icon');
        if (icon) {
            icon.className = isDark ? 'fas fa-sun' : 'fas fa-moon';
        }
    }

    function viewInquiryDetail(inq) {
        const html = '<div class="p-2">' +
            '<h5 class="font-weight-bold text-primary mb-2">' + (inq.name || '') + ' 様</h5>' +
            '<table class="table table-bordered text-sm">' +
            '<tr><th class="bg-light" style="width:140px;">企業名 / Company</th><td>' + (inq.company_name || '個人 / Individual') + '</td></tr>' +
            '<tr><th class="bg-light">メール / Email</th><td><a href="mailto:' + inq.email + '">' + inq.email + '</a></td></tr>' +
            '<tr><th class="bg-light">電話番号 / Phone</th><td>' + (inq.phone || '-') + '</td></tr>' +
            '<tr><th class="bg-light">相談分野 / Sector</th><td>' + (inq.service_interest || '全般') + '</td></tr>' +
            '<tr><th class="bg-light">状況 / Status</th><td><span class="badge badge-info">' + (inq.status || 'new') + '</span></td></tr>' +
            '<tr><th class="bg-light">メッセージ本文</th><td style="white-space: pre-line;">' + (inq.message || '-') + '</td></tr>' +
            '</table>' +
            '</div>';
        document.getElementById('inquiryDetailBody').innerHTML = html;
        $('#modal-inquiry-detail').modal('show');
    }

    // Charts Initialization
    document.addEventListener('DOMContentLoaded', function () {
        @if($activeTab === 'dashboard')
        const trendCtx = document.getElementById('inquiriesTrendChart');
        if (trendCtx) {
            new Chart(trendCtx.getContext('2d'), {
                type: 'line',
                data: {
                    labels: ['4月 (Apr)', '5月 (May)', '6月 (Jun)', '7月 (Jul)', '8月 (Aug)', '9月 (Sep)'],
                    datasets: [
                        {
                            label: 'お問い合わせ (Inquiries)',
                            data: [12, 19, 15, 26, 34, 48],
                            borderColor: '#007bff',
                            backgroundColor: 'rgba(0, 123, 255, 0.1)',
                            fill: true,
                            tension: 0.35
                        },
                        {
                            label: '特定技能相談 (SSW)',
                            data: [8, 14, 11, 20, 28, 41],
                            borderColor: '#28a745',
                            backgroundColor: 'transparent',
                            borderDash: [5, 5],
                            tension: 0.35
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        }

        const donutCtx = document.getElementById('sectorsDonutChart');
        if (donutCtx) {
            new Chart(donutCtx.getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: ['介護分野 (Nursing)', '外食・飲食 (Dining)', '製造・加工 (Manufacturing)', '建設・その他 (Construction)'],
                    datasets: [{
                        data: [45, 25, 18, 12],
                        backgroundColor: ['#007bff', '#28a745', '#ffc107', '#17a2b8']
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        }
        @endif
    });
</script>
</body>
</html>
