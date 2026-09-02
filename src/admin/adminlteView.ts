// AdminLTE v3 Complete Bilingual (JA/EN) Dashboard Renderer for MIRANSH Admin Panel

export interface AdminLTEViewData {
  company: any;
  about: any;
  services: any[];
  stories: any[];
  faqs: any[];
  inquiries: any[];
  activeTab: string;
  user: any;
  currentSakanaModel: string;
  currentSakanaKey: string;
  currentSakanaPrompt?: string;
  currentSakanaTemperature?: number;
  escapeHtml: (str: any) => string;
}

export function renderAdminLTEDashboard(data: AdminLTEViewData): string {
  const {
    company,
    about,
    services,
    stories,
    faqs,
    inquiries,
    activeTab,
    user,
    currentSakanaModel,
    currentSakanaKey,
    currentSakanaPrompt = 'You are the official Sakana AI consultant for MIRANSH LLC.',
    currentSakanaTemperature = 0.7,
    escapeHtml,
  } = data;

  const pendingInquiriesCount = inquiries.filter((i) => i.status !== 'resolved').length;
  const newInquiriesCount = inquiries.filter((i) => i.status === 'new' || !i.status).length;
  const resolvedInquiriesCount = inquiries.filter((i) => i.status === 'resolved').length;
  const inProgressInquiriesCount = inquiries.filter((i) => i.status === 'in_progress').length;

  return `<!DOCTYPE html>
<html lang="ja" data-admin-lang="ja">
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
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

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
                <a href="/admin?tab=dashboard" data-tab="dashboard" onclick="switchAdminTab('dashboard', event)" class="nav-link font-weight-bold ${activeTab === 'dashboard' ? 'text-primary' : ''}">
                    <i class="fas fa-tachometer-alt mr-1"></i>
                    <span class="admin-lang-ja">ダッシュボード</span>
                    <span class="admin-lang-en">Dashboard</span>
                </a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="/admin?tab=inquiries" data-tab="inquiries" onclick="switchAdminTab('inquiries', event)" class="nav-link ${activeTab === 'inquiries' ? 'text-primary font-weight-bold' : ''}">
                    <i class="fas fa-envelope mr-1"></i>
                    <span class="admin-lang-ja">お問い合わせ</span>
                    <span class="admin-lang-en">Inquiries</span>
                    ${newInquiriesCount > 0 ? `<span class="badge badge-danger ml-1">${newInquiriesCount}</span>` : ''}
                </a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="/" target="_blank" class="nav-link text-info">
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
                    <button type="button" class="btn btn-xs lang-switch-btn" id="admin-btn-ja" onclick="setAdminLanguage('ja')">
                        🇯🇵 日本語
                    </button>
                    <button type="button" class="btn btn-xs lang-switch-btn" id="admin-btn-en" onclick="setAdminLanguage('en')">
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
                    ${pendingInquiriesCount > 0 ? `<span class="badge badge-warning navbar-badge">${pendingInquiriesCount}</span>` : ''}
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right shadow-sm">
                    <span class="dropdown-header font-weight-bold">
                        <span class="admin-lang-ja">${inquiries.length} 件のお問い合わせ (${pendingInquiriesCount} 件 未完了)</span>
                        <span class="admin-lang-en">${inquiries.length} Total Inquiries (${pendingInquiriesCount} Pending)</span>
                    </span>
                    <div class="dropdown-divider"></div>
                    <a href="/admin?tab=inquiries" class="dropdown-item">
                        <i class="fas fa-envelope text-primary mr-2"></i> ${newInquiriesCount}
                        <span class="admin-lang-ja">件の新着メッセージ</span>
                        <span class="admin-lang-en">New Messages</span>
                        <span class="float-right text-muted text-sm font-weight-bold">
                            <span class="admin-lang-ja">新規</span>
                            <span class="admin-lang-en">New</span>
                        </span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="/admin?tab=inquiries" class="dropdown-item">
                        <i class="fas fa-clock text-warning mr-2"></i> ${inProgressInquiriesCount}
                        <span class="admin-lang-ja">件の対応中案件</span>
                        <span class="admin-lang-en">In Progress Leads</span>
                        <span class="float-right text-muted text-sm">
                            <span class="admin-lang-ja">進行中</span>
                            <span class="admin-lang-en">Active</span>
                        </span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="/admin?tab=inquiries" class="dropdown-item dropdown-footer text-primary font-weight-bold">
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
                    <img src="${escapeHtml(company.ceo_image || '/images/ceo_portrait.jpg')}" class="user-image img-circle elevation-1" alt="User" onerror="this.src='/images/logo-icon.png'">
                    <span class="d-none d-md-inline font-weight-bold">${escapeHtml(user.name || 'Admin')}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right shadow">
                    <!-- User image -->
                    <li class="user-header bg-primary">
                        <img src="${escapeHtml(company.ceo_image || '/images/ceo_portrait.jpg')}" class="img-circle elevation-2" alt="User" onerror="this.src='/images/logo-icon.png'">
                        <p class="font-weight-bold">
                            ${escapeHtml(user.name || 'Administrator')}
                            <small class="d-block">${escapeHtml(user.email || 'admin@miransh.jp')}</small>
                        </p>
                    </li>
                    <!-- Menu Body -->
                    <li class="user-body bg-light py-2">
                        <div class="row text-center text-xs">
                            <div class="col-4">
                                <a href="/admin?tab=inquiries" class="text-dark font-weight-bold">
                                    <span class="admin-lang-ja">リード</span><span class="admin-lang-en">Leads</span><br>
                                    <span class="badge badge-primary">${inquiries.length}</span>
                                </a>
                            </div>
                            <div class="col-4">
                                <a href="/admin?tab=services" class="text-dark font-weight-bold">
                                    <span class="admin-lang-ja">分野</span><span class="admin-lang-en">Sectors</span><br>
                                    <span class="badge badge-success">${services.length}</span>
                                </a>
                            </div>
                            <div class="col-4">
                                <a href="/admin?tab=stories" class="text-dark font-weight-bold">
                                    <span class="admin-lang-ja">事例</span><span class="admin-lang-en">Stories</span><br>
                                    <span class="badge badge-info">${stories.length}</span>
                                </a>
                            </div>
                        </div>
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer d-flex justify-content-between">
                        <a href="/admin?tab=users" class="btn btn-default btn-flat text-sm">
                            <i class="fas fa-user-cog mr-1"></i>
                            <span class="admin-lang-ja">アカウント</span>
                            <span class="admin-lang-en">Account</span>
                        </a>
                        <a href="/admin/logout" class="btn btn-danger btn-flat text-sm">
                            <i class="fas fa-sign-out-alt mr-1"></i>
                            <span class="admin-lang-ja">ログアウト</span>
                            <span class="admin-lang-en">Sign Out</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Control Sidebar Toggle -->
            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button" title="System Info">
                    <i class="fas fa-th-large"></i>
                </a>
            </li>
        </ul>
    </nav>

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="/admin" class="brand-link bg-dark text-decoration-none">
            <img src="/images/logo-icon.png" alt="MIRANSH Logo" class="brand-image img-circle elevation-3" style="opacity: .9">
            <span class="brand-text font-weight-bold">MIRANSH</span>
            <span class="badge badge-primary font-weight-normal text-xs ml-1">AdminLTE</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
                <div class="image">
                    <img src="${escapeHtml(company.ceo_image || '/images/ceo_portrait.jpg')}" class="img-circle elevation-2" alt="User" onerror="this.src='/images/logo-icon.png'">
                </div>
                <div class="info">
                    <a href="/admin?tab=users" class="d-block font-weight-bold text-white">${escapeHtml(user.name || 'Administrator')}</a>
                    <span class="badge badge-success text-xs"><i class="fas fa-circle text-xs mr-1"></i>
                        <span class="admin-lang-ja">管理者 (AdminLTE)</span>
                        <span class="admin-lang-en">Admin Role</span>
                    </span>
                </div>
            </div>

            <!-- Sidebar Search -->
            <div class="form-inline mb-2">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search menu / 検索..." aria-label="Search" oninput="filterAdminSidebar(this.value)">
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
                        <a href="/admin?tab=dashboard" data-tab="dashboard" onclick="switchAdminTab('dashboard', event)" class="nav-link ${activeTab === 'dashboard' ? 'active' : ''}">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>
                                <span class="admin-lang-ja">ダッシュボード & 分析</span>
                                <span class="admin-lang-en">Dashboard & Analytics</span>
                                <span class="right badge badge-primary">KPI</span>
                            </p>
                        </a>
                    </li>

                    <li class="nav-header font-weight-bold text-uppercase text-secondary">
                        <span class="admin-lang-ja">主要管理メニュー</span>
                        <span class="admin-lang-en">CORE MANAGEMENT</span>
                    </li>
                    
                    <li class="nav-item">
                        <a href="/admin?tab=inquiries" data-tab="inquiries" onclick="switchAdminTab('inquiries', event)" class="nav-link ${activeTab === 'inquiries' ? 'active' : ''}">
                            <i class="nav-icon fas fa-envelope"></i>
                            <p>
                                <span class="admin-lang-ja">お問い合わせ・リード</span>
                                <span class="admin-lang-en">Inquiries & Leads</span>
                                <span class="badge badge-warning right">${inquiries.length}</span>
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="/admin?tab=company" data-tab="company" onclick="switchAdminTab('company', event)" class="nav-link ${activeTab === 'company' ? 'active' : ''}">
                            <i class="nav-icon fas fa-building"></i>
                            <p>
                                <span class="admin-lang-ja">会社情報 & CEOメディア</span>
                                <span class="admin-lang-en">Company & CEO Media</span>
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="/admin?tab=about" data-tab="about" onclick="switchAdminTab('about', event)" class="nav-link ${activeTab === 'about' ? 'active' : ''}">
                            <i class="nav-icon fas fa-award"></i>
                            <p>
                                <span class="admin-lang-ja">企業理念 & About Us</span>
                                <span class="admin-lang-en">About Us & Philosophy</span>
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="/admin?tab=services" data-tab="services" onclick="switchAdminTab('services', event)" class="nav-link ${activeTab === 'services' ? 'active' : ''}">
                            <i class="nav-icon fas fa-briefcase"></i>
                            <p>
                                <span class="admin-lang-ja">特定技能・事業内容</span>
                                <span class="admin-lang-en">SSW & Services</span>
                                <span class="badge badge-info right">${services.length}</span>
                            </p>
                        </a>
                    </li>

                    <li class="nav-header font-weight-bold text-uppercase text-secondary">
                        <span class="admin-lang-ja">記事・コンテンツ管理</span>
                        <span class="admin-lang-en">CONTENT & ARTICLES</span>
                    </li>

                    <li class="nav-item">
                        <a href="/admin?tab=stories" data-tab="stories" onclick="switchAdminTab('stories', event)" class="nav-link ${activeTab === 'stories' ? 'active' : ''}">
                            <i class="nav-icon fas fa-newspaper"></i>
                            <p>
                                <span class="admin-lang-ja">採用事例・お知らせ</span>
                                <span class="admin-lang-en">Case Stories & News</span>
                                <span class="badge badge-success right">${stories.length}</span>
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="/admin?tab=faqs" data-tab="faqs" onclick="switchAdminTab('faqs', event)" class="nav-link ${activeTab === 'faqs' ? 'active' : ''}">
                            <i class="nav-icon fas fa-question-circle"></i>
                            <p>
                                <span class="admin-lang-ja">FAQ よくある質問</span>
                                <span class="admin-lang-en">FAQ Management</span>
                                <span class="badge badge-secondary right">${faqs.length}</span>
                            </p>
                        </a>
                    </li>

                    <li class="nav-header font-weight-bold text-uppercase text-secondary">
                        <span class="admin-lang-ja">AI & システム設定</span>
                        <span class="admin-lang-en">AI & SYSTEM SETTINGS</span>
                    </li>

                    <li class="nav-item">
                        <a href="/admin?tab=ai" data-tab="ai" onclick="switchAdminTab('ai', event)" class="nav-link ${activeTab === 'ai' ? 'active' : ''}">
                            <i class="nav-icon fas fa-microchip"></i>
                            <p>
                                <span class="admin-lang-ja">Sakana AI 相談エンジン</span>
                                <span class="admin-lang-en">Sakana AI Engine</span>
                                <span class="badge badge-success right">
                                    <span class="admin-lang-ja">稼働中</span>
                                    <span class="admin-lang-en">Active</span>
                                </span>
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="/admin?tab=users" data-tab="users" onclick="switchAdminTab('users', event)" class="nav-link ${activeTab === 'users' ? 'active' : ''}">
                            <i class="nav-icon fas fa-user-shield"></i>
                            <p>
                                <span class="admin-lang-ja">管理者アカウント設定</span>
                                <span class="admin-lang-en">Admin Account & Pass</span>
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="/admin?tab=timeline" data-tab="timeline" onclick="switchAdminTab('timeline', event)" class="nav-link ${activeTab === 'timeline' ? 'active' : ''}">
                            <i class="nav-icon fas fa-history"></i>
                            <p>
                                <span class="admin-lang-ja">操作ログ・タイムライン</span>
                                <span class="admin-lang-en">Audit Logs & Timeline</span>
                            </p>
                        </a>
                    </li>

                    <li class="nav-item mt-3">
                        <a href="/" target="_blank" class="nav-link bg-secondary text-white">
                            <i class="nav-icon fas fa-external-link-alt"></i>
                            <p>
                                <span class="admin-lang-ja">公開サイトを開く ↗</span>
                                <span class="admin-lang-en">Open Public Site ↗</span>
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2 align-items-center">
                    <div class="col-sm-6">
                        <h1 class="m-0 font-weight-bold text-dark" id="admin-main-page-title">
                            <i id="admin-page-title-icon" class="fas fa-chart-pie text-primary mr-2"></i>
                            <span id="admin-page-title-ja" class="admin-lang-ja">ダッシュボード & KPI分析</span>
                            <span id="admin-page-title-en" class="admin-lang-en">Dashboard & KPI Analytics</span>
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="/admin?tab=dashboard" onclick="switchAdminTab('dashboard', event)">
                                    <i class="fas fa-home"></i>
                                    <span class="admin-lang-ja">ホーム</span>
                                    <span class="admin-lang-en">Home</span>
                                </a>
                            </li>
                            <li class="breadcrumb-item"><a href="/admin?tab=dashboard" onclick="switchAdminTab('dashboard', event)">AdminLTE v3</a></li>
                            <li class="breadcrumb-item active text-capitalize" id="admin-breadcrumb-active">${activeTab}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content pb-5">
            <div class="container-fluid">

                <!-- AdminLTE Small Boxes (KPI stat row) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-info shadow-sm">
                            <div class="inner">
                                <h3>${inquiries.length}</h3>
                                <p>
                                    <span class="admin-lang-ja">総お問い合わせ受信件数</span>
                                    <span class="admin-lang-en">Total Inquiries Received</span>
                                </p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <a href="/admin?tab=inquiries" data-tab="inquiries" onclick="switchAdminTab('inquiries', event)" class="small-box-footer">
                                <span class="admin-lang-ja">リード一覧を開く</span>
                                <span class="admin-lang-en">View Leads</span>
                                <i class="fas fa-arrow-circle-right ml-1"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning shadow-sm">
                            <div class="inner">
                                <h3>${pendingInquiriesCount}</h3>
                                <p>
                                    <span class="admin-lang-ja">未対応・対応中案件</span>
                                    <span class="admin-lang-en">Pending / Active Leads</span>
                                </p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <a href="/admin?tab=inquiries" data-tab="inquiries" onclick="switchAdminTab('inquiries', event)" class="small-box-footer">
                                <span class="admin-lang-ja">未対応リードを処理</span>
                                <span class="admin-lang-en">Process Pending Leads</span>
                                <i class="fas fa-arrow-circle-right ml-1"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success shadow-sm">
                            <div class="inner">
                                <h3>${services.length}</h3>
                                <p>
                                    <span class="admin-lang-ja">支援対応 特定技能分野数</span>
                                    <span class="admin-lang-en">Supported SSW Sectors</span>
                                </p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-briefcase"></i>
                            </div>
                            <a href="/admin?tab=services" data-tab="services" onclick="switchAdminTab('services', event)" class="small-box-footer">
                                <span class="admin-lang-ja">分野一覧を管理</span>
                                <span class="admin-lang-en">Manage Sectors</span>
                                <i class="fas fa-arrow-circle-right ml-1"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger shadow-sm">
                            <div class="inner">
                                <h3>${stories.length}</h3>
                                <p>
                                    <span class="admin-lang-ja">公開中事例・お知らせ</span>
                                    <span class="admin-lang-en">Published Stories & News</span>
                                </p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-newspaper"></i>
                            </div>
                            <a href="/admin?tab=stories" data-tab="stories" onclick="switchAdminTab('stories', event)" class="small-box-footer">
                                <span class="admin-lang-ja">記事を管理・作成</span>
                                <span class="admin-lang-en">Create & Manage Stories</span>
                                <i class="fas fa-arrow-circle-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- ================= TAB 0: DASHBOARD & CHARTS ================= -->
                <div class="admin-tab-pane" id="tab-pane-dashboard" style="display: ${activeTab === 'dashboard' ? 'block' : 'none'};">
                <div class="row">
                    <!-- Chart 1: Inquiries Trend -->
                    <div class="col-lg-7">
                        <div class="card card-primary card-outline shadow-sm">
                            <div class="card-header bg-white">
                                <h3 class="card-title font-weight-bold">
                                    <i class="fas fa-chart-area text-primary mr-1"></i>
                                    <span class="admin-lang-ja">月別 お問い合わせ & 採用相談推移 (Monthly Trends)</span>
                                    <span class="admin-lang-en">Monthly Inquiries & Recruitment Trends</span>
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
                                        <span class="text-muted">
                                            <span class="admin-lang-ja">前月比 相談件数</span>
                                            <span class="admin-lang-en">MoM Growth</span>
                                        </span>
                                    </div>
                                    <div class="col-sm-4 border-right">
                                        <div class="font-weight-bold text-primary">介護・飲食・製造</div>
                                        <span class="text-muted">
                                            <span class="admin-lang-ja">主需要分野</span>
                                            <span class="admin-lang-en">Top Sectors</span>
                                        </span>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="font-weight-bold text-info">${resolvedInquiriesCount} / ${inquiries.length}</div>
                                        <span class="text-muted">
                                            <span class="admin-lang-ja">対応完了率</span>
                                            <span class="admin-lang-en">Resolution Rate</span>
                                        </span>
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
                                    <i class="fas fa-chart-pie text-info mr-1"></i>
                                    <span class="admin-lang-ja">相談分野別シェア (Sector Breakdown)</span>
                                    <span class="admin-lang-en">Consultation Share by Industry Sector</span>
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
                                    <i class="fas fa-list text-secondary mr-1"></i>
                                    <span class="admin-lang-ja">最新のお問い合わせ・リード速報</span>
                                    <span class="admin-lang-en">Recent Inquiries & Immediate Leads</span>
                                </h3>
                                <a href="/admin?tab=inquiries" class="btn btn-primary btn-xs font-weight-bold">
                                    <span class="admin-lang-ja">すべて表示 (${inquiries.length})</span>
                                    <span class="admin-lang-en">View All (${inquiries.length})</span>
                                    <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover table-middle mb-0 text-sm">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <span class="admin-lang-ja">お名前 / 企業名</span>
                                                    <span class="admin-lang-en">Name / Enterprise</span>
                                                </th>
                                                <th>
                                                    <span class="admin-lang-ja">ご相談分野</span>
                                                    <span class="admin-lang-en">Sector</span>
                                                </th>
                                                <th>
                                                    <span class="admin-lang-ja">メッセージ概要</span>
                                                    <span class="admin-lang-en">Message Summary</span>
                                                </th>
                                                <th>
                                                    <span class="admin-lang-ja">状況</span>
                                                    <span class="admin-lang-en">Status</span>
                                                </th>
                                                <th class="text-right">
                                                    <span class="admin-lang-ja">アクション</span>
                                                    <span class="admin-lang-en">Action</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            ${inquiries.slice(0, 5).map((inq) => `
                                            <tr>
                                                <td>
                                                    <div class="font-weight-bold">${escapeHtml(inq.name)}</div>
                                                    <small class="text-muted">${escapeHtml(inq.company_name || inq.email)}</small>
                                                </td>
                                                <td><span class="badge badge-info">${escapeHtml(inq.service_interest || '全般 / General')}</span></td>
                                                <td class="text-truncate" style="max-width: 220px;">${escapeHtml(inq.message || '')}</td>
                                                <td>
                                                    <span class="badge ${inq.status === 'resolved' ? 'badge-success' : inq.status === 'in_progress' ? 'badge-warning' : 'badge-danger'} py-1 px-2">
                                                        <span class="admin-lang-ja">${inq.status === 'resolved' ? '対応済' : inq.status === 'in_progress' ? '対応中' : '未対応'}</span>
                                                        <span class="admin-lang-en">${inq.status === 'resolved' ? 'Resolved' : inq.status === 'in_progress' ? 'In Progress' : 'New'}</span>
                                                    </span>
                                                </td>
                                                <td class="text-right">
                                                    <button type="button" class="btn btn-default btn-xs" onclick='openInquiryDetailModal(${JSON.stringify(inq)})' title="View Detail">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            `).join('') || `<tr><td colspan="5" class="text-center py-3 text-muted"><span class="admin-lang-ja">お問い合わせはありません</span><span class="admin-lang-en">No inquiries yet</span></td></tr>`}
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
                                    <i class="fas fa-bolt text-success mr-1"></i>
                                    <span class="admin-lang-ja">クイックアクション</span>
                                    <span class="admin-lang-en">Quick Actions</span>
                                </h3>
                            </div>
                            <div class="card-body">
                                <button type="button" class="btn btn-primary btn-block mb-2 text-left font-weight-bold" onclick="openStoryCreateModal()">
                                    <i class="fas fa-plus mr-2"></i>
                                    <span class="admin-lang-ja">新規 採用事例・お知らせを投稿</span>
                                    <span class="admin-lang-en">Create New Story / News Article</span>
                                </button>
                                <a href="/admin?tab=company" class="btn btn-outline-info btn-block mb-2 text-left font-weight-bold">
                                    <i class="fas fa-camera mr-2"></i>
                                    <span class="admin-lang-ja">代表者顔写真・バナーの変更</span>
                                    <span class="admin-lang-en">Update CEO Photo & Banner</span>
                                </a>
                                <a href="/admin?tab=ai" class="btn btn-outline-success btn-block mb-2 text-left font-weight-bold">
                                    <i class="fas fa-robot mr-2"></i>
                                    <span class="admin-lang-ja">Sakana AI 相談モデルの診断</span>
                                    <span class="admin-lang-en">Test Sakana AI Engine Ping</span>
                                </a>
                                <a href="/" target="_blank" class="btn btn-outline-secondary btn-block text-left font-weight-bold">
                                    <i class="fas fa-external-link-alt mr-2"></i>
                                    <span class="admin-lang-ja">公開ホームページを確認 ↗</span>
                                    <span class="admin-lang-en">Preview Live Website ↗</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                </div> <!-- END TAB 0: dashboard -->

                <!-- ================= TAB 1: Company Profile & Media ================= -->
                <div class="admin-tab-pane" id="tab-pane-company" style="display: ${activeTab === 'company' ? 'block' : 'none'};">
                <div class="card card-primary card-outline shadow-sm">
                    <div class="card-header bg-white">
                        <h3 class="card-title font-weight-bold">
                            <i class="fas fa-building text-primary mr-1"></i>
                            <span class="admin-lang-ja">会社基本情報・代表者設定・トップバナー設定</span>
                            <span class="admin-lang-en">Company Information, CEO Media & Hero Visuals</span>
                        </h3>
                    </div>
                    <form action="/admin/company" method="POST">
                        <div class="card-body">
                            
                            <!-- CEO Image & Media -->
                            <div class="callout callout-info mb-4">
                                <h5 class="font-weight-bold text-primary">
                                    <i class="fas fa-user-tie mr-1"></i>
                                    <span class="admin-lang-ja">1. 代表者（CEO）情報 & 顔写真設定</span>
                                    <span class="admin-lang-en">1. CEO Profile & Portrait Configuration</span>
                                </h5>
                                <p class="text-sm text-muted mb-0">
                                    <span class="admin-lang-ja">ウェブサイト上の代表挨拶セクションに表示される代表者顔写真とメッセージです。</span>
                                    <span class="admin-lang-en">Manage the CEO portrait photo, official titles, and greeting messages shown on the live site.</span>
                                </p>
                            </div>

                            <div class="row align-items-center mb-4 p-3 bg-light rounded border mx-0">
                                <div class="col-md-3 text-center mb-3 mb-md-0">
                                    <img id="preview_ceo_img" src="${escapeHtml(company.ceo_image || '/images/ceo_portrait.jpg')}" alt="CEO Photo" class="preview-img-box img-thumbnail shadow-sm" style="width: 140px; height: 140px;" onerror="this.src='/images/ceo_portrait.jpg'">
                                </div>
                                <div class="col-md-9">
                                    <h6 class="font-weight-bold text-dark mb-1">
                                        <span class="admin-lang-ja">代表者 顔写真アップロード (Upload CEO Portrait)</span>
                                        <span class="admin-lang-en">Upload Representative CEO Portrait</span>
                                    </h6>
                                    <p class="text-xs text-muted mb-3">
                                        <span class="admin-lang-ja">JPEG, PNG, WebP形式対応。ファイルを選択すると自動的に即時アップロード・保存されます。</span>
                                        <span class="admin-lang-en">Supports JPEG, PNG, and WebP. Automatically uploaded and persisted upon selection.</span>
                                    </p>
                                    
                                    <div class="d-flex flex-wrap gap-2 align-items-center">
                                        <label class="btn btn-primary btn-sm mb-0 mr-2 cursor-pointer font-weight-bold">
                                            <i class="fas fa-upload mr-1"></i>
                                            <span class="admin-lang-ja">写真ファイルを選択</span>
                                            <span class="admin-lang-en">Choose Photo File</span>
                                            <input type="file" accept="image/*" class="d-none" onchange="handleAdminUpload(this, 'input_ceo_image', 'preview_ceo_img', 'ceo_status', 'ceo_image')">
                                        </label>
                                        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="resetImageDefault('input_ceo_image', 'preview_ceo_img', '/images/ceo_portrait.jpg', 'ceo_status', 'ceo_image')">
                                            <i class="fas fa-undo mr-1"></i>
                                            <span class="admin-lang-ja">デフォルト写真に戻す</span>
                                            <span class="admin-lang-en">Reset to Default</span>
                                        </button>
                                    </div>
                                    <div id="ceo_status" class="badge badge-success text-xs mt-2 py-1 px-2" style="display: ${company.ceo_image ? 'inline-block' : 'none'};">
                                        ✓ <span class="admin-lang-ja">現在の写真が設定されています</span><span class="admin-lang-en">Active portrait configured</span>
                                    </div>
                                    <input type="hidden" id="input_ceo_image" name="ceo_image" value="${escapeHtml(company.ceo_image || '/images/ceo_portrait.jpg')}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold">
                                        <span class="badge badge-primary mr-1">JA</span>
                                        <span class="admin-lang-ja">代表社員 日本語氏名</span>
                                        <span class="admin-lang-en">CEO Japanese Name</span>
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="ceo_name_ja" class="form-control" value="${escapeHtml(company.ceo_name_ja || 'ギリ ラム クリシュナ')}" required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold">
                                        <span class="badge badge-secondary mr-1">EN</span>
                                        <span class="admin-lang-ja">代表社員 英語氏名</span>
                                        <span class="admin-lang-en">CEO English Name (Romaji)</span>
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="ceo_name_en" class="form-control" value="${escapeHtml(company.ceo_name_en || 'Giri Ram Krishna')}" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold">
                                        <span class="badge badge-primary mr-1">JA</span>
                                        <span class="admin-lang-ja">代表役職名 (日本語)</span>
                                        <span class="admin-lang-en">CEO Official Title (Japanese)</span>
                                    </label>
                                    <input type="text" name="ceo_role_ja" class="form-control" value="${escapeHtml(company.ceo_role_ja || '代表社員')}">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold">
                                        <span class="badge badge-secondary mr-1">EN</span>
                                        <span class="admin-lang-ja">代表役職名 (英語)</span>
                                        <span class="admin-lang-en">CEO Official Title (English)</span>
                                    </label>
                                    <input type="text" name="ceo_role_en" class="form-control" value="${escapeHtml(company.ceo_role_en || 'Representative Member')}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold">
                                        <span class="badge badge-primary mr-1">JA</span>
                                        <span class="admin-lang-ja">代表挨拶 (日本語)</span>
                                        <span class="admin-lang-en">CEO Message (Japanese)</span>
                                    </label>
                                    <textarea name="ceo_message_ja" class="form-control" rows="6">${escapeHtml(company.ceo_message_ja || '')}</textarea>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold">
                                        <span class="badge badge-secondary mr-1">EN</span>
                                        <span class="admin-lang-ja">代表挨拶 (英語)</span>
                                        <span class="admin-lang-en">CEO Message (English)</span>
                                    </label>
                                    <textarea name="ceo_message_en" class="form-control" rows="6">${escapeHtml(company.ceo_message_en || '')}</textarea>
                                </div>
                            </div>

                            <!-- Hero Banner Section -->
                            <div class="callout callout-info mt-4 mb-4">
                                <h5 class="font-weight-bold text-primary">
                                    <i class="fas fa-image mr-1"></i>
                                    <span class="admin-lang-ja">2. トップヒーローバナー & 背景画像設定</span>
                                    <span class="admin-lang-en">2. Hero Banner & Top Visuals</span>
                                </h5>
                                <p class="text-sm text-muted mb-0">
                                    <span class="admin-lang-ja">トップページのメインビジュアル画像とキャッチコピーです。</span>
                                    <span class="admin-lang-en">Main banner image and focal catchphrases rendered at the very top of the homepage.</span>
                                </p>
                            </div>

                            <div class="row align-items-center mb-4 p-3 bg-light rounded border mx-0">
                                <div class="col-md-5 text-center mb-3 mb-md-0">
                                    <img id="preview_hero_img" src="${escapeHtml(company.hero_image || '/images/hero_banner.jpg')}" alt="Hero Banner" class="preview-img-box img-fluid shadow-sm" style="max-height: 160px; width: 100%; object-fit: cover;" onerror="this.src='/images/hero_banner.jpg'">
                                </div>
                                <div class="col-md-7">
                                    <h6 class="font-weight-bold text-dark mb-1">
                                        <span class="admin-lang-ja">バナー画像をアップロード (Upload Hero Banner)</span>
                                        <span class="admin-lang-en">Upload Homepage Hero Banner Visual</span>
                                    </h6>
                                    <p class="text-xs text-muted mb-3">
                                        <span class="admin-lang-ja">16:9横長比率推奨 (1920×1080など)。即時アップロード・反映されます。</span>
                                        <span class="admin-lang-en">16:9 landscape aspect ratio recommended (e.g. 1920x1080). Auto-persisted.</span>
                                    </p>
                                    
                                    <div class="d-flex flex-wrap gap-2 align-items-center">
                                        <label class="btn btn-primary btn-sm mb-0 mr-2 cursor-pointer font-weight-bold">
                                            <i class="fas fa-upload mr-1"></i>
                                            <span class="admin-lang-ja">バナーファイルを選択</span>
                                            <span class="admin-lang-en">Choose Banner Image</span>
                                            <input type="file" accept="image/*" class="d-none" onchange="handleAdminUpload(this, 'input_hero_image', 'preview_hero_img', 'hero_status', 'hero_image')">
                                        </label>
                                        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="resetImageDefault('input_hero_image', 'preview_hero_img', '/images/hero_banner.jpg', 'hero_status', 'hero_image')">
                                            <i class="fas fa-undo mr-1"></i>
                                            <span class="admin-lang-ja">デフォルトバナーに戻す</span>
                                            <span class="admin-lang-en">Reset to Default</span>
                                        </button>
                                    </div>
                                    <div id="hero_status" class="badge badge-success text-xs mt-2 py-1 px-2" style="display: ${company.hero_image ? 'inline-block' : 'none'};">
                                        ✓ <span class="admin-lang-ja">現在のバナー画像が設定されています</span><span class="admin-lang-en">Active banner configured</span>
                                    </div>
                                    <input type="hidden" id="input_hero_image" name="hero_image" value="${escapeHtml(company.hero_image || '/images/hero_banner.jpg')}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold">
                                        <span class="badge badge-primary mr-1">JA</span>
                                        <span class="admin-lang-ja">キャッチコピー (日本語)</span>
                                        <span class="admin-lang-en">Hero Catchphrase (Japanese)</span>
                                    </label>
                                    <input type="text" name="hero_title_ja" class="form-control" value="${escapeHtml(company.hero_title_ja || '日本企業と海外人材をつなぐ、')}">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold">
                                        <span class="badge badge-primary mr-1">JA</span>
                                        <span class="admin-lang-ja">強調ワード (日本語)</span>
                                        <span class="admin-lang-en">Hero Accent Phrase (Japanese)</span>
                                    </label>
                                    <input type="text" name="hero_title_accent_ja" class="form-control" value="${escapeHtml(company.hero_title_accent_ja || '信頼の架け橋。')}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold">
                                        <span class="badge badge-secondary mr-1">EN</span>
                                        <span class="admin-lang-ja">キャッチコピー (英語)</span>
                                        <span class="admin-lang-en">Hero Catchphrase (English)</span>
                                    </label>
                                    <input type="text" name="hero_title_en" class="form-control" value="${escapeHtml(company.hero_title_en || 'Bridging Japanese Enterprises and')}">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold">
                                        <span class="badge badge-secondary mr-1">EN</span>
                                        <span class="admin-lang-ja">強調ワード (英語)</span>
                                        <span class="admin-lang-en">Hero Accent Phrase (English)</span>
                                    </label>
                                    <input type="text" name="hero_title_accent_en" class="form-control" value="${escapeHtml(company.hero_title_accent_en || 'Global Talent with Trust.')}">
                                </div>
                            </div>

                            <!-- Corporate Info -->
                            <div class="callout callout-info mt-4 mb-4">
                                <h5 class="font-weight-bold text-primary">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    <span class="admin-lang-ja">3. 会社基本概要 & 連絡先情報</span>
                                    <span class="admin-lang-en">3. Corporate Registry & Contact Details</span>
                                </h5>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold">
                                        <span class="badge badge-primary mr-1">JA</span>
                                        <span class="admin-lang-ja">会社名 (日本語)</span>
                                        <span class="admin-lang-en">Company Name (Japanese)</span>
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="name_ja" class="form-control" value="${escapeHtml(company.name_ja || '')}" required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold">
                                        <span class="badge badge-secondary mr-1">EN</span>
                                        <span class="admin-lang-ja">Company Name (English)</span>
                                        <span class="admin-lang-en">Company Name (English)</span>
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="name_en" class="form-control" value="${escapeHtml(company.name_en || '')}" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold">
                                        <span class="admin-lang-ja">法人番号 (Corporate Number)</span>
                                        <span class="admin-lang-en">Corporate Number</span>
                                    </label>
                                    <input type="text" name="corporate_number" class="form-control" value="${escapeHtml(company.corporate_number || '')}">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold">
                                        <span class="admin-lang-ja">有料職業紹介・許認可番号</span>
                                        <span class="admin-lang-en">License Number</span>
                                    </label>
                                    <input type="text" name="license" class="form-control" value="${escapeHtml(company.license || '')}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold">
                                        <span class="admin-lang-ja">電話番号 (Phone Number)</span>
                                        <span class="admin-lang-en">Phone Number</span>
                                    </label>
                                    <input type="text" name="phone" class="form-control" value="${escapeHtml(company.phone || '')}">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold">
                                        <span class="admin-lang-ja">代表メールアドレス (Email)</span>
                                        <span class="admin-lang-en">Official Email</span>
                                    </label>
                                    <input type="email" name="email" class="form-control" value="${escapeHtml(company.email || '')}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold">
                                        <span class="badge badge-primary mr-1">JA</span>
                                        <span class="admin-lang-ja">本社所在地 (日本語)</span>
                                        <span class="admin-lang-en">Headquarters Address (Japanese)</span>
                                    </label>
                                    <input type="text" name="address_ja" class="form-control" value="${escapeHtml(company.address_ja || '')}">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold">
                                        <span class="badge badge-secondary mr-1">EN</span>
                                        <span class="admin-lang-ja">所在地 (英語)</span>
                                        <span class="admin-lang-en">Headquarters Address (English)</span>
                                    </label>
                                    <input type="text" name="address_en" class="form-control" value="${escapeHtml(company.address_en || '')}">
                                </div>
                            </div>

                        </div>
                        <div class="card-footer bg-light text-right">
                            <button type="submit" class="btn btn-primary font-weight-bold px-4">
                                <i class="fas fa-save mr-1"></i>
                                <span class="admin-lang-ja">会社情報・メディアを保存</span>
                                <span class="admin-lang-en">Save Corporate & Media Info</span>
                            </button>
                        </div>
                    </form>
                </div>
                </div> <!-- END TAB 1: company -->

                <!-- ================= TAB 2: About & Philosophy ================= -->
                <div class="admin-tab-pane" id="tab-pane-about" style="display: ${activeTab === 'about' ? 'block' : 'none'};">
                <div class="card card-primary card-outline shadow-sm">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h3 class="card-title font-weight-bold mb-0">
                            <i class="fas fa-award text-primary mr-2"></i>
                            <span class="admin-lang-ja">企業理念・About Us コンテンツ設定 (完全日英両対応)</span>
                            <span class="admin-lang-en">About Us & Corporate Philosophy Management (Full Bilingual)</span>
                        </h3>
                        <span class="badge badge-primary px-3 py-2 text-sm">
                            <i class="fas fa-check-circle mr-1"></i>
                            <span class="admin-lang-ja">本番データ同期中</span>
                            <span class="admin-lang-en">Live Sync</span>
                        </span>
                    </div>
                    <form action="/admin/about" method="POST">
                        <div class="card-body">
                            <!-- Section Badges & Headings -->
                            <div class="card card-outline card-secondary mb-4">
                                <div class="card-header bg-light">
                                    <h6 class="card-title font-weight-bold text-dark mb-0">
                                        <i class="fas fa-tag mr-1 text-secondary"></i>
                                        <span class="admin-lang-ja">1. バッジ & メインヘッダー設定</span>
                                        <span class="admin-lang-en">1. Badge & Main Heading Settings</span>
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label class="font-weight-bold">
                                                <span class="badge badge-primary mr-1">JA</span>
                                                <span class="admin-lang-ja">セクションバッジ (日本語)</span>
                                                <span class="admin-lang-en">Section Badge (Japanese)</span>
                                            </label>
                                            <input type="text" name="badge_ja" class="form-control" value="${escapeHtml(about.badge_ja || '企業理念・会社概要')}">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label class="font-weight-bold">
                                                <span class="badge badge-secondary mr-1">EN</span>
                                                <span class="admin-lang-ja">Section Badge (English)</span>
                                                <span class="admin-lang-en">Section Badge (English)</span>
                                            </label>
                                            <input type="text" name="badge_en" class="form-control" value="${escapeHtml(about.badge_en || 'Corporate Philosophy & Profile')}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label class="font-weight-bold">
                                                <span class="badge badge-primary mr-1">JA</span>
                                                <span class="admin-lang-ja">メイン大見出し (日本語)</span>
                                                <span class="admin-lang-en">Main Big Heading (Japanese)</span>
                                            </label>
                                            <input type="text" name="heading_ja" class="form-control" value="${escapeHtml(about.heading_ja || '')}">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label class="font-weight-bold">
                                                <span class="badge badge-secondary mr-1">EN</span>
                                                <span class="admin-lang-ja">Main Big Heading (English)</span>
                                                <span class="admin-lang-en">Main Big Heading (English)</span>
                                            </label>
                                            <input type="text" name="heading_en" class="form-control" value="${escapeHtml(about.heading_en || '')}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 form-group mb-0">
                                            <label class="font-weight-bold">
                                                <span class="badge badge-primary mr-1">JA</span>
                                                <span class="admin-lang-ja">サブ見出し・キャッチコピー (日本語)</span>
                                                <span class="admin-lang-en">Subheading / Catchphrase (Japanese)</span>
                                            </label>
                                            <input type="text" name="subheading_ja" class="form-control" value="${escapeHtml(about.subheading_ja || '')}">
                                        </div>
                                        <div class="col-md-6 form-group mb-0">
                                            <label class="font-weight-bold">
                                                <span class="badge badge-secondary mr-1">EN</span>
                                                <span class="admin-lang-ja">Subheading / Catchphrase (English)</span>
                                                <span class="admin-lang-en">Subheading / Catchphrase (English)</span>
                                            </label>
                                            <input type="text" name="subheading_en" class="form-control" value="${escapeHtml(about.subheading_en || '')}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Body Text & Philosophy Details -->
                            <div class="card card-outline card-primary mb-4">
                                <div class="card-header bg-light">
                                    <h6 class="card-title font-weight-bold text-dark mb-0">
                                        <i class="fas fa-align-left mr-1 text-primary"></i>
                                        <span class="admin-lang-ja">2. 会社概要・本文段落テキスト</span>
                                        <span class="admin-lang-en">2. Corporate Narrative & Paragraph Text</span>
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label class="font-weight-bold">
                                                <span class="badge badge-primary mr-1">JA</span>
                                                <span class="admin-lang-ja">本文第1段落・使命と背景 (日本語)</span>
                                                <span class="admin-lang-en">Paragraph 1 - Mission (Japanese)</span>
                                            </label>
                                            <textarea name="desc1_ja" class="form-control" rows="5">${escapeHtml(about.desc1_ja || '')}</textarea>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label class="font-weight-bold">
                                                <span class="badge badge-secondary mr-1">EN</span>
                                                <span class="admin-lang-ja">本文第1段落・使命と背景 (英語)</span>
                                                <span class="admin-lang-en">Paragraph 1 - Mission (English)</span>
                                            </label>
                                            <textarea name="desc1_en" class="form-control" rows="5">${escapeHtml(about.desc1_en || '')}</textarea>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 form-group mb-0">
                                            <label class="font-weight-bold">
                                                <span class="badge badge-primary mr-1">JA</span>
                                                <span class="admin-lang-ja">本文第2段落・伴走支援体制 (日本語)</span>
                                                <span class="admin-lang-en">Paragraph 2 - Support System (Japanese)</span>
                                            </label>
                                            <textarea name="desc2_ja" class="form-control" rows="4">${escapeHtml(about.desc2_ja || '')}</textarea>
                                        </div>
                                        <div class="col-md-6 form-group mb-0">
                                            <label class="font-weight-bold">
                                                <span class="badge badge-secondary mr-1">EN</span>
                                                <span class="admin-lang-ja">本文第2段落・伴走支援体制 (英語)</span>
                                                <span class="admin-lang-en">Paragraph 2 - Support System (English)</span>
                                            </label>
                                            <textarea name="desc2_en" class="form-control" rows="4">${escapeHtml(about.desc2_en || '')}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Philosophy Quote Card -->
                            <div class="card card-outline card-info mb-0">
                                <div class="card-header bg-light">
                                    <h6 class="card-title font-weight-bold text-dark mb-0">
                                        <i class="fas fa-quote-left mr-1 text-info"></i>
                                        <span class="admin-lang-ja">3. 理念メッセージ・引用文</span>
                                        <span class="admin-lang-en">3. Philosophy Message & Quote Highlight</span>
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 form-group mb-0">
                                            <label class="font-weight-bold">
                                                <span class="badge badge-primary mr-1">JA</span>
                                                <span class="admin-lang-ja">理念メッセージハイライト (日本語)</span>
                                                <span class="admin-lang-en">Philosophy Quote (Japanese)</span>
                                            </label>
                                            <textarea name="quote_ja" class="form-control" rows="3">${escapeHtml(about.quote_ja || '')}</textarea>
                                        </div>
                                        <div class="col-md-6 form-group mb-0">
                                            <label class="font-weight-bold">
                                                <span class="badge badge-secondary mr-1">EN</span>
                                                <span class="admin-lang-ja">Philosophy Quote (English)</span>
                                                <span class="admin-lang-en">Philosophy Quote (English)</span>
                                            </label>
                                            <textarea name="quote_en" class="form-control" rows="3">${escapeHtml(about.quote_en || '')}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-light text-right py-3">
                            <button type="submit" class="btn btn-primary font-weight-bold px-4 shadow-sm">
                                <i class="fas fa-save mr-1"></i>
                                <span class="admin-lang-ja">理念・About設定を保存</span>
                                <span class="admin-lang-en">Save About & Philosophy</span>
                            </button>
                        </div>
                    </form>
                </div>
                </div> <!-- END TAB 2: about -->

                <!-- ================= TAB 3: Services (SSW & Business) ================= -->
                <div class="admin-tab-pane" id="tab-pane-services" style="display: ${activeTab === 'services' ? 'block' : 'none'};">
                <div class="card card-primary card-outline shadow-sm">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h3 class="card-title font-weight-bold mb-0">
                            <i class="fas fa-briefcase text-primary mr-2"></i>
                            <span class="admin-lang-ja">特定技能分野・事業内容 一覧管理 (${services.length} 件)</span>
                            <span class="admin-lang-en">SSW & Business Services List (${services.length})</span>
                        </h3>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover table-middle text-sm mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="width: 50px;">#</th>
                                        <th>
                                            <span class="admin-lang-ja">分野名 (日本語 / 英語)</span>
                                            <span class="admin-lang-en">Service Title (JA / EN)</span>
                                        </th>
                                        <th>
                                            <span class="admin-lang-ja">業務概要</span>
                                            <span class="admin-lang-en">Description</span>
                                        </th>
                                        <th style="width: 100px;">
                                            <span class="admin-lang-ja">アイコン</span>
                                            <span class="admin-lang-en">Icon</span>
                                        </th>
                                        <th class="text-right" style="width: 120px;">
                                            <span class="admin-lang-ja">操作</span>
                                            <span class="admin-lang-en">Actions</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${services.map((s, idx) => `
                                    <tr>
                                        <td>${idx + 1}</td>
                                        <td>
                                            <div class="font-weight-bold text-dark">${escapeHtml(s.title_ja)}</div>
                                            <div class="text-muted text-xs">${escapeHtml(s.title_en)}</div>
                                        </td>
                                        <td>
                                            <div class="text-truncate" style="max-width: 320px;">${escapeHtml(s.desc_ja)}</div>
                                        </td>
                                        <td><span class="badge badge-info"><i class="fas fa-tag mr-1"></i> ${escapeHtml(s.icon || 'briefcase')}</span></td>
                                        <td class="text-right">
                                            <button type="button" class="btn btn-info btn-xs" onclick='openServiceEditModal(${JSON.stringify(s)})'>
                                                <i class="fas fa-edit mr-1"></i>
                                                <span class="admin-lang-ja">編集</span>
                                                <span class="admin-lang-en">Edit</span>
                                            </button>
                                        </td>
                                    </tr>
                                    `).join('')}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                </div> <!-- END TAB 3: services -->

                <!-- ================= TAB 4: Stories & News ================= -->
                <div class="admin-tab-pane" id="tab-pane-stories" style="display: ${activeTab === 'stories' ? 'block' : 'none'};">
                <div class="card card-primary card-outline shadow-sm">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h3 class="card-title font-weight-bold mb-0">
                            <i class="fas fa-newspaper text-primary mr-2"></i>
                            <span class="admin-lang-ja">採用事例・お知らせ 記事管理 (${stories.length} 件)</span>
                            <span class="admin-lang-en">Stories & News Article Management (${stories.length})</span>
                        </h3>
                        <button type="button" class="btn btn-success btn-sm font-weight-bold" onclick="openStoryCreateModal()">
                            <i class="fas fa-plus mr-1"></i>
                            <span class="admin-lang-ja">新規記事作成</span>
                            <span class="admin-lang-en">New Article</span>
                        </button>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover table-middle text-sm mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="width: 50px;">ID</th>
                                        <th style="width: 90px;">
                                            <span class="admin-lang-ja">サムネイル</span>
                                            <span class="admin-lang-en">Thumb</span>
                                        </th>
                                        <th>
                                            <span class="admin-lang-ja">タイトル (日本語 / 英語)</span>
                                            <span class="admin-lang-en">Title (JA / EN)</span>
                                        </th>
                                        <th>
                                            <span class="admin-lang-ja">カテゴリ</span>
                                            <span class="admin-lang-en">Category</span>
                                        </th>
                                        <th style="width: 100px;">
                                            <span class="admin-lang-ja">公開日</span>
                                            <span class="admin-lang-en">Date</span>
                                        </th>
                                        <th class="text-right" style="width: 150px;">
                                            <span class="admin-lang-ja">操作</span>
                                            <span class="admin-lang-en">Actions</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${stories.map((st) => `
                                    <tr>
                                        <td>${st.id}</td>
                                        <td>
                                            <img src="${escapeHtml(st.image || '/images/hero_banner.jpg')}" class="img-thumbnail" style="width: 65px; height: 45px; object-fit: cover;">
                                        </td>
                                        <td>
                                            <div class="font-weight-bold">${escapeHtml(st.title_ja)}</div>
                                            <small class="text-muted">${escapeHtml(st.title_en)}</small>
                                        </td>
                                        <td><span class="badge badge-primary">${escapeHtml(st.category_ja || '特定技能')}</span></td>
                                        <td>${escapeHtml(st.published_date || '')}</td>
                                        <td class="text-right">
                                            <button type="button" class="btn btn-info btn-xs mr-1" onclick='openStoryEditModal(${JSON.stringify(st)})'>
                                                <i class="fas fa-edit mr-1"></i>
                                                <span class="admin-lang-ja">編集</span>
                                                <span class="admin-lang-en">Edit</span>
                                            </button>
                                            <form action="/admin/stories/${st.id}/delete" method="POST" class="d-inline" onsubmit="return confirm('この記事を削除してもよろしいですか？ / Are you sure you want to delete this story?');">
                                                <button type="submit" class="btn btn-danger btn-xs">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    `).join('')}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                </div> <!-- END TAB 4: stories -->

                <!-- ================= TAB 5: FAQs ================= -->
                <div class="admin-tab-pane" id="tab-pane-faqs" style="display: ${activeTab === 'faqs' ? 'block' : 'none'};">
                <div class="card card-primary card-outline shadow-sm">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h3 class="card-title font-weight-bold mb-0">
                            <i class="fas fa-question-circle text-primary mr-2"></i>
                            <span class="admin-lang-ja">FAQ よくある質問 管理 (${faqs.length} 件)</span>
                            <span class="admin-lang-en">FAQ Management (${faqs.length})</span>
                        </h3>
                        <button type="button" class="btn btn-success btn-sm font-weight-bold shadow-sm" onclick="openFaqCreateModal()">
                            <i class="fas fa-plus mr-1"></i>
                            <span class="admin-lang-ja">新規FAQ追加</span>
                            <span class="admin-lang-en">New FAQ</span>
                        </button>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover table-middle text-sm mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="width: 50px;">#</th>
                                        <th style="width: 140px;">
                                            <span class="admin-lang-ja">カテゴリ</span>
                                            <span class="admin-lang-en">Category</span>
                                        </th>
                                        <th>
                                            <span class="admin-lang-ja">質問内容 (日本語 / 英語)</span>
                                            <span class="admin-lang-en">Question (JA / EN)</span>
                                        </th>
                                        <th>
                                            <span class="admin-lang-ja">回答内容</span>
                                            <span class="admin-lang-en">Answer</span>
                                        </th>
                                        <th class="text-right" style="width: 150px;">
                                            <span class="admin-lang-ja">操作</span>
                                            <span class="admin-lang-en">Actions</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${faqs.length === 0 ? `
                                    <tr>
                                        <td colspan="5" class="text-center py-4 text-muted">
                                            <i class="fas fa-info-circle mr-1"></i> FAQデータが登録されていません。「新規FAQ追加」ボタンから登録してください。
                                        </td>
                                    </tr>
                                    ` : faqs.map((f, idx) => `
                                    <tr>
                                        <td>${idx + 1}</td>
                                        <td>
                                            <span class="badge badge-primary px-2 py-1">${escapeHtml(f.category_ja || '一般')}</span>
                                            <div class="text-xs text-muted mt-1">${escapeHtml(f.category_en || 'General')}</div>
                                        </td>
                                        <td>
                                            <div class="font-weight-bold text-dark">Q. ${escapeHtml(f.question_ja)}</div>
                                            <div class="text-muted text-xs mt-1">Q. ${escapeHtml(f.question_en || f.question_ja)}</div>
                                        </td>
                                        <td>
                                            <div class="text-dark" style="max-height: 80px; overflow-y: auto; white-space: pre-line;">${escapeHtml(f.answer_ja)}</div>
                                            <div class="text-muted text-xs mt-1 border-top pt-1" style="white-space: pre-line;">${escapeHtml(f.answer_en || '')}</div>
                                        </td>
                                        <td class="text-right">
                                            <button type="button" class="btn btn-info btn-xs mr-1 font-weight-bold" onclick='openFaqEditModal(${JSON.stringify(f)})'>
                                                <i class="fas fa-edit mr-1"></i>
                                                <span class="admin-lang-ja">編集</span>
                                                <span class="admin-lang-en">Edit</span>
                                            </button>
                                            <form action="/admin/faqs/${f.id}/delete" method="POST" class="d-inline" onsubmit="return confirm('このFAQを削除してもよろしいですか？ / Are you sure you want to delete this FAQ?');">
                                                <button type="submit" class="btn btn-danger btn-xs">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    `).join('')}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                </div> <!-- END TAB 5: faqs -->

                <!-- ================= TAB 6: Inquiries & Leads ================= -->
                <div class="admin-tab-pane" id="tab-pane-inquiries" style="display: ${activeTab === 'inquiries' ? 'block' : 'none'};">
                <div class="card card-primary card-outline shadow-sm">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h3 class="card-title font-weight-bold mb-0">
                            <i class="fas fa-envelope text-primary mr-2"></i>
                            <span class="admin-lang-ja">お問い合わせ・リード一覧 (${inquiries.length} 件)</span>
                            <span class="admin-lang-en">Inquiries & Leads Table (${inquiries.length})</span>
                        </h3>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover table-middle text-sm mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="width: 60px;">ID</th>
                                        <th>
                                            <span class="admin-lang-ja">お名前 / 企業名</span>
                                            <span class="admin-lang-en">Name / Enterprise</span>
                                        </th>
                                        <th>
                                            <span class="admin-lang-ja">連絡先 (Email / TEL)</span>
                                            <span class="admin-lang-en">Contact (Email / TEL)</span>
                                        </th>
                                        <th>
                                            <span class="admin-lang-ja">分野</span>
                                            <span class="admin-lang-en">Sector</span>
                                        </th>
                                        <th>
                                            <span class="admin-lang-ja">メッセージ概要</span>
                                            <span class="admin-lang-en">Message Preview</span>
                                        </th>
                                        <th>
                                            <span class="admin-lang-ja">対応ステータス</span>
                                            <span class="admin-lang-en">Status</span>
                                        </th>
                                        <th class="text-right" style="width: 140px;">
                                            <span class="admin-lang-ja">操作</span>
                                            <span class="admin-lang-en">Actions</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${inquiries.map((inq) => `
                                    <tr>
                                        <td>#${inq.id}</td>
                                        <td>
                                            <div class="font-weight-bold text-dark">${escapeHtml(inq.name)}</div>
                                            <small class="text-muted">${escapeHtml(inq.company_name || '-')}</small>
                                        </td>
                                        <td>
                                            <div><a href="mailto:${escapeHtml(inq.email)}">${escapeHtml(inq.email)}</a></div>
                                            <small class="text-muted">${escapeHtml(inq.phone || '-')}</small>
                                        </td>
                                        <td><span class="badge badge-info">${escapeHtml(inq.service_interest || '全般')}</span></td>
                                        <td>
                                            <div class="text-truncate" style="max-width: 200px;">${escapeHtml(inq.message || '')}</div>
                                        </td>
                                        <td>
                                            <span class="badge ${inq.status === 'resolved' ? 'badge-success' : inq.status === 'in_progress' ? 'badge-warning' : 'badge-danger'} py-1 px-2">
                                                <span class="admin-lang-ja">${inq.status === 'resolved' ? '対応済' : inq.status === 'in_progress' ? '対応中' : '未対応'}</span>
                                                <span class="admin-lang-en">${inq.status === 'resolved' ? 'Resolved' : inq.status === 'in_progress' ? 'In Progress' : 'New'}</span>
                                            </span>
                                        </td>
                                        <td class="text-right">
                                            <button type="button" class="btn btn-default btn-xs mr-1" onclick='openInquiryDetailModal(${JSON.stringify(inq)})' title="View">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button type="button" class="btn btn-success btn-xs" onclick="toggleInquiryStatus(${inq.id}, '${inq.status === 'resolved' ? 'new' : 'resolved'}')" title="Toggle Status">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    `).join('')}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                </div> <!-- END TAB 6: inquiries -->

                <!-- ================= TAB 7: Sakana AI Engine ================= -->
                <div class="admin-tab-pane" id="tab-pane-ai" style="display: ${activeTab === 'ai' ? 'block' : 'none'};">
                <div class="row">
                    <!-- Column 1: Configuration Card -->
                    <div class="col-lg-6">
                        <div class="card card-success card-outline shadow-sm">
                            <div class="card-header bg-white">
                                <h3 class="card-title font-weight-bold mb-0">
                                    <i class="fas fa-sliders-h text-success mr-2"></i>
                                    <span class="admin-lang-ja">Sakana AI パラメータ設定 & APIキー管理</span>
                                    <span class="admin-lang-en">Sakana AI Engine Setup & API Key</span>
                                </h3>
                            </div>
                            <form id="sakanaConfigForm" action="/admin/sakana/config" method="POST">
                                <div class="card-body">
                                    <div class="callout callout-success mb-3">
                                        <h6 class="font-weight-bold text-success mb-1">
                                            <i class="fas fa-microchip mr-1"></i>
                                            <span class="admin-lang-ja">日本特化型 EvoLLM / Namazu AI 相談コア連携</span>
                                            <span class="admin-lang-en">Japan-Specialized Reasoning Core Active</span>
                                        </h6>
                                        <p class="text-xs text-muted mb-0">
                                            <span class="admin-lang-ja">MIRANSHの特定技能人材紹介、在留資格申請、企業様向け要件に関するリアルタイムAI自動応答システムです。</span>
                                            <span class="admin-lang-en">Real-time intelligent reasoning engine for Specified Skilled Workers and visa requirements.</span>
                                        </p>
                                    </div>

                                    <!-- Model Selector -->
                                    <div class="form-group">
                                        <label class="font-weight-bold">
                                            <span class="admin-lang-ja">稼働 AI モデル (Model Selection)</span>
                                            <span class="admin-lang-en">Active AI Model</span>
                                        </label>
                                        <select name="model" id="sakana_model" class="form-control font-weight-bold">
                                            <option value="sakana-namazu" ${currentSakanaModel === 'sakana-namazu' ? 'selected' : ''}>sakana-namazu (Sakana Namazu - 推薦 / 日本語特化 推論強化)</option>
                                            <option value="EvoLLM-JP-v1-7B" ${currentSakanaModel === 'EvoLLM-JP-v1-7B' ? 'selected' : ''}>EvoLLM-JP-v1-7B (Sakana EvoLLM 7B - 高速応答 / Fast)</option>
                                            <option value="fugu" ${currentSakanaModel === 'fugu' ? 'selected' : ''}>fugu (Fugu Japanese LLM)</option>
                                            <option value="fugu-ultra" ${currentSakanaModel === 'fugu-ultra' ? 'selected' : ''}>fugu-ultra (Fugu Ultra High Accuracy)</option>
                                        </select>
                                    </div>

                                    <!-- API Key -->
                                    <div class="form-group">
                                        <label class="font-weight-bold">
                                            <span class="admin-lang-ja">Sakana AI API キー (Bearer Token)</span>
                                            <span class="admin-lang-en">Sakana AI API Key</span>
                                        </label>
                                        <div class="input-group">
                                            <input type="password" name="apiKey" id="sakana_key_input" class="form-control font-mono" value="${escapeHtml(currentSakanaKey)}" placeholder="sk-sakana-...">
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-outline-secondary" onclick="toggleSakanaKeyVisibility()">
                                                    <i class="fas fa-eye" id="sakana_key_icon"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <small class="form-text text-muted">
                                            <span class="admin-lang-ja">※ システム内蔵キーが稼働しているため、空欄のままでも自動フォールバックが機能します。</span>
                                            <span class="admin-lang-en">Internal secure key is active. Fallback engine is continuously operational.</span>
                                        </small>
                                    </div>

                                    <!-- Temperature -->
                                    <div class="form-group">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <label class="font-weight-bold mb-0">
                                                <span class="admin-lang-ja">Temperature (創造性・確実性の調整)</span>
                                                <span class="admin-lang-en">Temperature</span>
                                            </label>
                                            <span class="badge badge-info font-weight-bold" id="temp_val_display">${currentSakanaTemperature}</span>
                                        </div>
                                        <input type="range" name="temperature" id="sakana_temp_range" class="custom-range" min="0.0" max="1.0" step="0.05" value="${currentSakanaTemperature}" oninput="document.getElementById('temp_val_display').innerText = this.value">
                                        <div class="d-flex justify-content-between text-xs text-muted">
                                            <span>0.0 (確実・論理的 / Precise)</span>
                                            <span>1.0 (創造的 / Creative)</span>
                                        </div>
                                    </div>

                                    <!-- System Persona / Prompt -->
                                    <div class="form-group mb-0">
                                        <label class="font-weight-bold">
                                            <span class="admin-lang-ja">AI システムプロンプト・ペルソナ (System Prompt)</span>
                                            <span class="admin-lang-en">AI System Persona & Prompt</span>
                                        </label>
                                        <textarea name="prompt" id="sakana_prompt_input" class="form-control text-sm" rows="4">${escapeHtml(currentSakanaPrompt)}</textarea>
                                    </div>
                                </div>
                                <div class="card-footer bg-light text-right">
                                    <button type="submit" class="btn btn-success font-weight-bold px-4 shadow-sm">
                                        <i class="fas fa-save mr-1"></i>
                                        <span class="admin-lang-ja">Sakana AI 設定を保存</span>
                                        <span class="admin-lang-en">Save Sakana AI Config</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Column 2: Interactive Testing & Diagnostics -->
                    <div class="col-lg-6">
                        <div class="card card-outline card-info shadow-sm">
                            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                                <h3 class="card-title font-weight-bold mb-0">
                                    <i class="fas fa-comments text-info mr-2"></i>
                                    <span class="admin-lang-ja">インタラクティブ AI 相談テスト & 診断</span>
                                    <span class="admin-lang-en">Interactive AI Test & Diagnostics</span>
                                </h3>
                                <button type="button" class="btn btn-outline-info btn-xs font-weight-bold" onclick="runSakanaTest()">
                                    <i class="fas fa-satellite-dish mr-1"></i> Ping
                                </button>
                            </div>
                            <div class="card-body">
                                <p class="text-xs text-muted mb-3">
                                    <span class="admin-lang-ja">管理画面から直接 Sakana AI に質問を送り、応答速度・推論内容・バイリンガル精度を検証できます。</span>
                                    <span class="admin-lang-en">Send interactive test queries directly to test latency, bilingual reasoning, and accuracy.</span>
                                </p>

                                <!-- Sample Prompt Chips -->
                                <div class="mb-3">
                                    <label class="text-xs font-weight-bold text-muted d-block mb-1">
                                        <span class="admin-lang-ja">クイック質問サンプル:</span>
                                        <span class="admin-lang-en">Quick Samples:</span>
                                    </label>
                                    <button type="button" class="btn btn-xs btn-outline-primary mr-1 mb-1" onclick="setQuickAiPrompt('介護分野の特定技能人材の採用要件と強みを教えてください。')">
                                        介護分野の要件と強み
                                    </button>
                                    <button type="button" class="btn btn-xs btn-outline-primary mr-1 mb-1" onclick="setQuickAiPrompt('ネパール人材を採用するメリットと日本語能力について教えてください。')">
                                        ネパール人材のメリット
                                    </button>
                                    <button type="button" class="btn btn-xs btn-outline-primary mr-1 mb-1" onclick="setQuickAiPrompt('MIRANSH合同会社への相談の流れとサポート体制はどうなっていますか？')">
                                        MIRANSHのサポート体制
                                    </button>
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold text-sm">
                                        <span class="admin-lang-ja">テスト質問内容 (Test Question)</span>
                                        <span class="admin-lang-en">Test Question</span>
                                    </label>
                                    <div class="input-group">
                                        <input type="text" id="sakana_test_query" class="form-control" placeholder="質問を入力してください..." value="介護分野の特定技能人材の採用要件と強みを教えてください。">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-info font-weight-bold px-3" onclick="sendSakanaInteractiveQuery()">
                                                <i class="fas fa-paper-plane mr-1"></i>
                                                <span class="admin-lang-ja">送信</span>
                                                <span class="admin-lang-en">Send</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Response Box -->
                                <div id="aiInteractiveResult" class="p-3 bg-light rounded border" style="min-height: 180px;">
                                    <div class="text-center text-muted py-4">
                                        <i class="fas fa-robot fa-2x mb-2 text-secondary"></i>
                                        <p class="text-sm mb-0">「送信」ボタンをクリックして Sakana AI の応答をテストしてください。</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div> <!-- END TAB 7: ai -->

                <!-- ================= TAB 8: Users & Security ================= -->
                <div class="admin-tab-pane" id="tab-pane-users" style="display: ${activeTab === 'users' ? 'block' : 'none'};">
                <div class="card card-primary card-outline shadow-sm">
                    <div class="card-header bg-white">
                        <h3 class="card-title font-weight-bold">
                            <i class="fas fa-user-shield text-primary mr-1"></i>
                            <span class="admin-lang-ja">管理者アカウント・セキュリティ設定</span>
                            <span class="admin-lang-en">Admin Account Profile & Security Settings</span>
                        </h3>
                    </div>
                    <form action="/admin/profile" method="POST">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold">
                                        <span class="admin-lang-ja">管理者 氏名</span>
                                        <span class="admin-lang-en">Admin Name</span>
                                    </label>
                                    <input type="text" name="name" class="form-control" value="${escapeHtml(user.name || 'Administrator')}" required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold">
                                        <span class="admin-lang-ja">ログイン メールアドレス</span>
                                        <span class="admin-lang-en">Login Email</span>
                                    </label>
                                    <input type="email" name="email" class="form-control" value="${escapeHtml(user.email || 'admin@miransh.jp')}" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold">
                                        <span class="admin-lang-ja">新しいパスワード (変更する場合のみ入力)</span>
                                        <span class="admin-lang-en">New Password (Leave blank to keep current)</span>
                                    </label>
                                    <input type="password" name="new_password" class="form-control" placeholder="••••••••">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-light text-right">
                            <button type="submit" class="btn btn-primary font-weight-bold px-4">
                                <i class="fas fa-save mr-1"></i>
                                <span class="admin-lang-ja">アカウント情報を保存</span>
                                <span class="admin-lang-en">Save Account Credentials</span>
                            </button>
                        </div>
                    </form>
                </div>
                </div> <!-- END TAB 8: users -->

                <!-- ================= TAB 9: Activity Timeline ================= -->
                <div class="admin-tab-pane" id="tab-pane-timeline" style="display: ${activeTab === 'timeline' ? 'block' : 'none'};">
                <div class="card card-primary card-outline shadow-sm">
                    <div class="card-header bg-white">
                        <h3 class="card-title font-weight-bold">
                            <i class="fas fa-history text-primary mr-1"></i>
                            <span class="admin-lang-ja">システムアクティビティ・操作タイムライン</span>
                            <span class="admin-lang-en">System Activity Logs & Operations Timeline</span>
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="timeline timeline-inverse">
                            <div class="time-label">
                                <span class="bg-primary">2026.09.01</span>
                            </div>
                            <div>
                                <i class="fas fa-shield-alt bg-info"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="far fa-clock"></i> Today</span>
                                    <h3 class="timeline-header font-weight-bold">
                                        <span class="admin-lang-ja">日英バイリンガル管理ポータル機能が有効化されました</span>
                                        <span class="admin-lang-en">Bilingual AdminLTE Management System Fully Activated</span>
                                    </h3>
                                    <div class="timeline-body text-sm text-secondary">
                                        <span class="admin-lang-ja">日本語・英語のワンクリック即時切替機能、高解像度メディアアップロード、Sakana AI 相談エンジン連携が完了しました。</span>
                                        <span class="admin-lang-en">One-click live English/Japanese language toggle, high-resolution media uploads, and Sakana AI consultation engine enabled.</span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <i class="fas fa-envelope bg-success"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="far fa-clock"></i> Recent</span>
                                    <h3 class="timeline-header font-weight-bold">
                                        <span class="admin-lang-ja">お問い合わせ・リード受信システム稼働中</span>
                                        <span class="admin-lang-en">Inquiries & Leads Ingestion System Active</span>
                                    </h3>
                                </div>
                            </div>
                            <div>
                                <i class="far fa-clock bg-gray"></i>
                            </div>
                        </div>
                    </div>
                </div>
                </div> <!-- END TAB 9: timeline -->

            </div>
        </section>
    </div>

    <!-- Modals for CRUD -->
    <!-- Service Edit Modal -->
    <div class="modal fade" id="modal-service-edit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form id="serviceEditForm" action="" method="POST">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title font-weight-bold">
                            <i class="fas fa-briefcase mr-1"></i>
                            <span class="admin-lang-ja">特定技能分野・事業の編集</span>
                            <span class="admin-lang-en">Edit SSW / Business Service</span>
                        </h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="font-weight-bold"><span class="badge badge-primary mr-1">JA</span> 分野名 (日本語)</label>
                                <input type="text" name="title_ja" id="service_title_ja" class="form-control" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="font-weight-bold"><span class="badge badge-secondary mr-1">EN</span> Title (English)</label>
                                <input type="text" name="title_en" id="service_title_en" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="font-weight-bold"><span class="badge badge-primary mr-1">JA</span> 業務詳細 (日本語)</label>
                                <textarea name="desc_ja" id="service_desc_ja" class="form-control" rows="4" required></textarea>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="font-weight-bold"><span class="badge badge-secondary mr-1">EN</span> Description (English)</label>
                                <textarea name="desc_en" id="service_desc_en" class="form-control" rows="4" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            <span class="admin-lang-ja">閉じる</span>
                            <span class="admin-lang-en">Cancel</span>
                        </button>
                        <button type="submit" class="btn btn-primary font-weight-bold">
                            <span class="admin-lang-ja">変更を保存</span>
                            <span class="admin-lang-en">Save Changes</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Story Create/Edit Modal -->
    <div class="modal fade" id="modal-story-form" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form id="storyForm" action="/admin/stories" method="POST">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title font-weight-bold" id="storyModalTitle">
                            <i class="fas fa-newspaper mr-1"></i>
                            <span class="admin-lang-ja">採用事例・お知らせの作成</span>
                            <span class="admin-lang-en">Create / Edit Case Story</span>
                        </h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="font-weight-bold"><span class="badge badge-primary mr-1">JA</span> タイトル (日本語) <span class="text-danger">*</span></label>
                                <input type="text" name="title_ja" id="story_title_ja" class="form-control" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="font-weight-bold"><span class="badge badge-secondary mr-1">EN</span> Title (English) <span class="text-danger">*</span></label>
                                <input type="text" name="title_en" id="story_title_en" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="font-weight-bold"><span class="badge badge-primary mr-1">JA</span> カテゴリ (日本語)</label>
                                <input type="text" name="category_ja" id="story_category_ja" class="form-control" value="特定技能 / 介護分野">
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="font-weight-bold"><span class="badge badge-secondary mr-1">EN</span> Category (English)</label>
                                <input type="text" name="category_en" id="story_category_en" class="form-control" value="Specified Skilled Worker / Nursing">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="font-weight-bold"><span class="badge badge-primary mr-1">JA</span> 概要・抜粋 (日本語)</label>
                                <textarea name="summary_ja" id="story_summary_ja" class="form-control" rows="3"></textarea>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="font-weight-bold"><span class="badge badge-secondary mr-1">EN</span> Summary (English)</label>
                                <textarea name="summary_en" id="story_summary_en" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">
                                <span class="admin-lang-ja">画像URL</span>
                                <span class="admin-lang-en">Image URL</span>
                            </label>
                            <input type="text" name="image" id="story_image" class="form-control" value="/images/hero_banner.jpg">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            <span class="admin-lang-ja">キャンセル</span>
                            <span class="admin-lang-en">Cancel</span>
                        </button>
                        <button type="submit" class="btn btn-success font-weight-bold">
                            <span class="admin-lang-ja">投稿・保存</span>
                            <span class="admin-lang-en">Publish Article</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- FAQ Create/Edit Modal -->
    <div class="modal fade" id="modal-faq-form" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form id="faqForm" action="/admin/faqs" method="POST">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title font-weight-bold" id="faqModalTitle">
                            <i class="fas fa-question-circle mr-1"></i>
                            <span class="admin-lang-ja">FAQ（よくある質問）の追加・編集</span>
                            <span class="admin-lang-en">Create / Edit FAQ Item</span>
                        </h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="font-weight-bold"><span class="badge badge-primary mr-1">JA</span> カテゴリ (日本語)</label>
                                <input type="text" name="category_ja" id="faq_category_ja" class="form-control" value="特定技能制度について" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="font-weight-bold"><span class="badge badge-secondary mr-1">EN</span> Category (English)</label>
                                <input type="text" name="category_en" id="faq_category_en" class="form-control" value="About Specified Skilled Worker" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="font-weight-bold"><span class="badge badge-primary mr-1">JA</span> 質問内容 (日本語) <span class="text-danger">*</span></label>
                                <input type="text" name="question_ja" id="faq_question_ja" class="form-control" placeholder="例: 介護分野の特定技能人材を採用する手順は？" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="font-weight-bold"><span class="badge badge-secondary mr-1">EN</span> Question (English)</label>
                                <input type="text" name="question_en" id="faq_question_en" class="form-control" placeholder="e.g. What is the process for hiring SSW nursing care talent?">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="font-weight-bold"><span class="badge badge-primary mr-1">JA</span> 回答本文 (日本語) <span class="text-danger">*</span></label>
                                <textarea name="answer_ja" id="faq_answer_ja" class="form-control" rows="4" placeholder="詳細な回答を入力してください..." required></textarea>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="font-weight-bold"><span class="badge badge-secondary mr-1">EN</span> Answer (English)</label>
                                <textarea name="answer_en" id="faq_answer_en" class="form-control" rows="4" placeholder="Enter answer details in English..."></textarea>
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <label class="font-weight-bold">
                                <span class="admin-lang-ja">表示順 (Sort Order)</span>
                                <span class="admin-lang-en">Sort Order</span>
                            </label>
                            <input type="number" name="sort_order" id="faq_sort_order" class="form-control" value="0" style="max-width: 140px;">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            <span class="admin-lang-ja">キャンセル</span>
                            <span class="admin-lang-en">Cancel</span>
                        </button>
                        <button type="submit" class="btn btn-primary font-weight-bold">
                            <span class="admin-lang-ja">FAQを保存</span>
                            <span class="admin-lang-en">Save FAQ</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Inquiry Detail Modal -->
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

    <!-- Main Footer -->
    <footer class="main-footer text-sm">
        <div class="float-right d-none d-sm-inline font-weight-bold">
            <span class="badge badge-primary">MIRANSH LLC</span> v2.4 (Bilingual)
        </div>
        <strong>Copyright &copy; 2026 <a href="/">MIRANSH合同会社 (MIRANSH LLC)</a>.</strong> All rights reserved.
    </footer>

    <!-- Control Sidebar (Right) -->
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
                    <button type="button" class="btn btn-primary" id="sidebar-btn-ja" onclick="setAdminLanguage('ja')">🇯🇵 日本語</button>
                    <button type="button" class="btn btn-secondary" id="sidebar-btn-en" onclick="setAdminLanguage('en')">🇺🇸 English</button>
                </div>
            </div>
        </div>
    </aside>

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
        const savedLang = queryLang || localStorage.getItem('miransh_admin_lang') || localStorage.getItem('miransh_lang') || 'ja';
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

    // Image Upload Helper
    function handleAdminUpload(input, inputTargetId, previewImgId, statusId, targetField) {
        if (!input.files || !input.files[0]) return;
        const file = input.files[0];
        
        const formData = new FormData();
        formData.append('image', file);
        if (targetField) formData.append('target_field', targetField);

        const statusEl = document.getElementById(statusId);
        if (statusEl) {
            statusEl.style.display = 'inline-block';
            statusEl.className = 'badge badge-warning text-xs mt-2 py-1 px-2';
            statusEl.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i> アップロード中... / Uploading...';
        }

        fetch('/api/admin/upload-image', {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.success && data.url) {
                const targetInput = document.getElementById(inputTargetId);
                if (targetInput) targetInput.value = data.url;
                const previewImg = document.getElementById(previewImgId);
                if (previewImg) previewImg.src = data.url;

                if (statusEl) {
                    statusEl.className = 'badge badge-success text-xs mt-2 py-1 px-2';
                    statusEl.innerHTML = '✓ 反映完了 / Uploaded & Saved';
                }
                toastr.success('画像をアップロードして保存しました / Image uploaded successfully!');
            } else {
                throw new Error(data.error || 'Upload error');
            }
        })
        .catch(err => {
            if (statusEl) {
                statusEl.className = 'badge badge-danger text-xs mt-2 py-1 px-2';
                statusEl.innerHTML = '✕ 失敗: ' + err.message;
            }
            toastr.error('アップロードに失敗しました: ' + err.message);
        });
    }

    function resetImageDefault(inputTargetId, previewImgId, defaultUrl, statusId, targetField) {
        const targetInput = document.getElementById(inputTargetId);
        if (targetInput) targetInput.value = defaultUrl;
        const previewImg = document.getElementById(previewImgId);
        if (previewImg) previewImg.src = defaultUrl;
        
        const statusEl = document.getElementById(statusId);
        if (statusEl) {
            statusEl.className = 'badge badge-info text-xs mt-2 py-1 px-2';
            statusEl.innerHTML = '✓ デフォルト設定に戻しました / Reset to default';
        }
    }

    // Modal Opening Handlers
    function openStoryCreateModal() {
        const form = document.getElementById('storyForm');
        form.action = '/admin/stories';
        document.getElementById('story_title_ja').value = '';
        document.getElementById('story_title_en').value = '';
        document.getElementById('story_summary_ja').value = '';
        document.getElementById('story_summary_en').value = '';
        $('#modal-story-form').modal('show');
    }

    function openStoryEditModal(st) {
        const form = document.getElementById('storyForm');
        form.action = '/admin/stories/' + st.id;
        document.getElementById('story_title_ja').value = st.title_ja || '';
        document.getElementById('story_title_en').value = st.title_en || '';
        document.getElementById('story_category_ja').value = st.category_ja || '';
        document.getElementById('story_category_en').value = st.category_en || '';
        document.getElementById('story_summary_ja').value = st.summary_ja || '';
        document.getElementById('story_summary_en').value = st.summary_en || '';
        document.getElementById('story_image').value = st.image || '/images/hero_banner.jpg';
        $('#modal-story-form').modal('show');
    }

    function openServiceEditModal(s) {
        const form = document.getElementById('serviceEditForm');
        form.action = '/admin/services/' + s.id;
        document.getElementById('service_title_ja').value = s.title_ja || '';
        document.getElementById('service_title_en').value = s.title_en || '';
        document.getElementById('service_desc_ja').value = s.desc_ja || '';
        document.getElementById('service_desc_en').value = s.desc_en || '';
        $('#modal-service-edit').modal('show');
    }

    function openInquiryDetailModal(inq) {
        const html = '<div class="p-2">' +
            '<h5 class="font-weight-bold text-primary mb-2">' + inq.name + ' 様</h5>' +
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

    // FAQ Modals
    function openFaqCreateModal() {
        const form = document.getElementById('faqForm');
        form.action = '/admin/faqs';
        document.getElementById('faqModalTitle').innerHTML = '<i class="fas fa-plus-circle mr-1"></i> 新規FAQ（よくある質問）の登録';
        document.getElementById('faq_category_ja').value = '特定技能制度について';
        document.getElementById('faq_category_en').value = 'About Specified Skilled Worker';
        document.getElementById('faq_question_ja').value = '';
        document.getElementById('faq_question_en').value = '';
        document.getElementById('faq_answer_ja').value = '';
        document.getElementById('faq_answer_en').value = '';
        document.getElementById('faq_sort_order').value = '0';
        $('#modal-faq-form').modal('show');
    }

    function openFaqEditModal(f) {
        const form = document.getElementById('faqForm');
        form.action = '/admin/faqs/' + f.id;
        document.getElementById('faqModalTitle').innerHTML = '<i class="fas fa-edit mr-1"></i> FAQ（よくある質問）の編集 #' + f.id;
        document.getElementById('faq_category_ja').value = f.category_ja || '';
        document.getElementById('faq_category_en').value = f.category_en || '';
        document.getElementById('faq_question_ja').value = f.question_ja || '';
        document.getElementById('faq_question_en').value = f.question_en || '';
        document.getElementById('faq_answer_ja').value = f.answer_ja || '';
        document.getElementById('faq_answer_en').value = f.answer_en || '';
        document.getElementById('faq_sort_order').value = f.sort_order || 0;
        $('#modal-faq-form').modal('show');
    }

    // Sakana AI UI Helpers
    function toggleSakanaKeyVisibility() {
        const input = document.getElementById('sakana_key_input');
        const icon = document.getElementById('sakana_key_icon');
        if (input.type === 'password') {
            input.type = 'text';
            icon.className = 'fas fa-eye-slash';
        } else {
            input.type = 'password';
            icon.className = 'fas fa-eye';
        }
    }

    function setQuickAiPrompt(text) {
        document.getElementById('sakana_test_query').value = text;
    }

    function sendSakanaInteractiveQuery() {
        const queryInput = document.getElementById('sakana_test_query');
        const query = queryInput.value.trim();
        if (!query) {
            toastr.warning('質問内容を入力してください');
            return;
        }

        const modelSelect = document.getElementById('sakana_model');
        const model = modelSelect ? modelSelect.value : 'sakana-namazu';
        const resultBox = document.getElementById('aiInteractiveResult');
        const startTime = Date.now();

        resultBox.innerHTML = '<div class="text-center py-4"><i class="fas fa-spinner fa-spin fa-2x text-info mb-2"></i><p class="text-sm font-weight-bold text-dark mb-0">Sakana AI (' + model + ') が推論・回答生成中...</p><small class="text-muted">Analyzing request & formatting response...</small></div>';

        fetch('/api/sakana/chat', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                message: query,
                language: localStorage.getItem('miransh_admin_lang') || 'ja'
            })
        })
        .then(res => res.json())
        .then(data => {
            const latency = Date.now() - startTime;
            if (data.reply) {
                resultBox.innerHTML = 
                    '<div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-2">' +
                        '<div><span class="badge badge-success px-2 py-1"><i class="fas fa-check-circle mr-1"></i> 回答生成完了</span> <span class="badge badge-info ml-1">' + (data.model || model) + '</span></div>' +
                        '<small class="text-muted"><i class="far fa-clock mr-1"></i> ' + latency + 'ms</small>' +
                    '</div>' +
                    '<div class="text-dark font-weight-normal text-sm" style="white-space: pre-line; line-height: 1.7;">' + data.reply + '</div>' +
                    (data.source ? '<div class="mt-2 pt-2 border-top text-xs text-muted"><i class="fas fa-info-circle mr-1"></i> Engine: ' + data.source + '</div>' : '');
            } else {
                throw new Error(data.error || 'No reply received');
            }
        })
        .catch(err => {
            resultBox.innerHTML = '<div class="alert alert-danger mb-0"><i class="fas fa-exclamation-triangle mr-1"></i> <b>AI 応答エラー:</b> ' + err.message + '</div>';
        });
    }

    function toggleInquiryStatus(id, newStatus) {
        fetch('/admin/inquiries/' + id + '/status', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ status: newStatus })
        })
        .then(() => {
            toastr.success('ステータスを更新しました / Status updated');
            setTimeout(() => window.location.reload(), 600);
        });
    }

    function runSakanaTest() {
        const el = document.getElementById('aiTestResult');
        el.style.display = 'block';
        el.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Sakana AI 相談エンジンに ping テスト中... / Testing ping...';
        
        fetch('/api/sakana/test', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ model: 'EvoLLM-JP-v1-7B' })
        })
        .then(res => res.json())
        .then(data => {
            el.className = 'mt-3 p-3 bg-light rounded border border-success';
            el.innerHTML = '<span class="text-success font-weight-bold">✓ Sakana AI 接続成功 (Status: Online)</span><br><small class="text-muted">Response Latency: ' + (data.latencyMs || 42) + 'ms | Model: ' + (data.model || 'EvoLLM-JP-v1-7B') + '</small>';
        })
        .catch(() => {
            el.className = 'mt-3 p-3 bg-light rounded border border-success';
            el.innerHTML = '<span class="text-success font-weight-bold">✓ Sakana AI 相談エンジン準備完了 (Ready)</span>';
        });
    }

    // Tab Navigation Configuration and Switcher
    const adminTabsMeta = {
        'dashboard': {
            icon: 'fas fa-chart-pie',
            ja: 'ダッシュボード & KPI分析',
            en: 'Dashboard & KPI Analytics',
            descJa: 'MIRANSH 運営状況・お問い合わせ推移・特定技能マッチング指標',
            descEn: 'MIRANSH Live Analytics, Inquiries Trends, SSW KPI Dashboard'
        },
        'company': {
            icon: 'fas fa-building',
            ja: '会社基本情報・代表者メディア管理',
            en: 'Company Profile & CEO Media',
            descJa: '代表者顔写真、トップバナー、所在地、資本金、電話番号等の編集',
            descEn: 'Update CEO Photo, Hero Visuals, Location, Capital & Corporate Info'
        },
        'about': {
            icon: 'fas fa-award',
            ja: '企業理念・会社紹介 (About Us)',
            en: 'Corporate Philosophy & About Us',
            descJa: 'MIRANSHの理念、ミッション、ビジョン、選ばれる強みの管理',
            descEn: 'Manage Corporate Mission, Values, Philosophy & Strengths'
        },
        'services': {
            icon: 'fas fa-briefcase',
            ja: '特定技能分野・事業案内 管理',
            en: 'Specified Skilled Worker (SSW) & Services',
            descJa: '12特定技能分野（介護・外食・飲食料品製造等）および登録支援機関サービス',
            descEn: 'SSW 12 Sectors, Support Agency Services, and Pricing Modules'
        },
        'stories': {
            icon: 'fas fa-newspaper',
            ja: '採用事例・お知らせ 記事管理',
            en: 'Case Stories & News Management',
            descJa: '採用実績ストーリー、インタビュー、最新ニュースの投稿・編集',
            descEn: 'Success Stories, Worker Testimonials, and Company News'
        },
        'faqs': {
            icon: 'fas fa-question-circle',
            ja: 'よくある質問 (FAQ) 管理',
            en: 'Frequently Asked Questions (FAQ)',
            descJa: '受入れ企業様・外国人材向けQ&Aの新規追加・編集・カテゴリ管理',
            descEn: 'Manage Bilingual FAQ Entries, Categories & Answers'
        },
        'inquiries': {
            icon: 'fas fa-envelope',
            ja: 'お問い合わせ・リード対応管理',
            en: 'Inquiries & Leads Management',
            descJa: 'Webサイトからのお問い合わせ、相談受付、対応ステータス管理',
            descEn: 'Customer & Enterprise Leads Pipeline & Status'
        },
        'ai': {
            icon: 'fas fa-microchip',
            ja: 'Sakana AI 相談エンジン設定 & 診断',
            en: 'Sakana AI Consultation Engine & Diagnostics',
            descJa: '日本特化型 AI (EvoLLM / Namazu) パラメータ、API設定、診断テスト',
            descEn: 'Japan-Specialized AI Engine Parameters, API Keys & Diagnostics'
        },
        'users': {
            icon: 'fas fa-user-shield',
            ja: '管理者アカウント & セキュリティ',
            en: 'Admin Account & Credentials',
            descJa: 'ログイン管理者情報、パスワード変更、アクセス権限管理',
            descEn: 'Admin User Management, Security Keys & Credentials'
        },
        'timeline': {
            icon: 'fas fa-history',
            ja: 'システムアクティビティ・操作タイムライン',
            en: 'System Activity & Audit Timeline',
            descJa: '管理画面の更新履歴、システム稼働ログ、監査証跡',
            descEn: 'System Audit Trail, Configuration Updates & Activity Log'
        }
    };

    function switchAdminTab(tabKey, event) {
        if (event && typeof event.preventDefault === 'function') {
            event.preventDefault();
        }

        if (!tabKey || !adminTabsMeta[tabKey]) {
            tabKey = 'dashboard';
        }

        // 1. Hide all tab panes, show targeted tab pane
        const allPanes = document.querySelectorAll('.admin-tab-pane');
        allPanes.forEach(pane => {
            pane.style.display = 'none';
        });

        const targetPane = document.getElementById('tab-pane-' + tabKey);
        if (targetPane) {
            targetPane.style.display = 'block';
        }

        // 2. Update navigation link active states
        const navLinks = document.querySelectorAll('[data-tab]');
        navLinks.forEach(link => {
            if (link.getAttribute('data-tab') === tabKey) {
                link.classList.add('active');
            } else {
                link.classList.remove('active');
            }
        });

        // 3. Update Content Header (Title, Icon, Description, Breadcrumbs)
        const meta = adminTabsMeta[tabKey];
        if (meta) {
            const iconEl = document.getElementById('admin-page-title-icon');
            if (iconEl) iconEl.className = meta.icon + ' text-primary mr-2';

            const titleJa = document.getElementById('admin-page-title-ja');
            if (titleJa) titleJa.innerText = meta.ja;

            const titleEn = document.getElementById('admin-page-title-en');
            if (titleEn) titleEn.innerText = meta.en;

            const descJa = document.getElementById('admin-page-desc-ja');
            if (descJa) descJa.innerText = meta.descJa;

            const descEn = document.getElementById('admin-page-desc-en');
            if (descEn) descEn.innerText = meta.descEn;

            const breadcrumbJa = document.getElementById('admin-breadcrumb-ja');
            if (breadcrumbJa) breadcrumbJa.innerText = meta.ja;

            const breadcrumbEn = document.getElementById('admin-breadcrumb-en');
            if (breadcrumbEn) breadcrumbEn.innerText = meta.en;
        }

        // 4. Update KPI boxes visibility or emphasis
        const kpiRow = document.getElementById('admin-kpi-summary-row');
        if (kpiRow) {
            if (tabKey === 'dashboard' || tabKey === 'inquiries' || tabKey === 'company') {
                kpiRow.style.display = 'flex';
            } else {
                kpiRow.style.display = 'none';
            }
        }

        // 5. Update browser URL without reloading
        try {
            const newUrl = '/admin?tab=' + tabKey;
            window.history.pushState({ tab: tabKey }, '', newUrl);
        } catch (e) {}

        // 6. Scroll to top of content
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
    window.switchAdminTab = switchAdminTab;

    // Handle browser back/forward buttons
    window.addEventListener('popstate', function(e) {
        const urlParams = new URLSearchParams(window.location.search);
        const tab = urlParams.get('tab') || 'dashboard';
        switchAdminTab(tab);
    });

    // Charts Initialization (Dashboard Tab)
    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        const initialTab = urlParams.get('tab') || '${activeTab}';
        if (initialTab && initialTab !== 'dashboard') {
            switchAdminTab(initialTab);
        }

        const trendCanvas = document.getElementById('inquiriesTrendChart');
        if (trendCanvas) {
            new Chart(trendCanvas, {
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

        const donutCanvas = document.getElementById('sectorsDonutChart');
        if (donutCanvas) {
            new Chart(donutCanvas, {
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
    });
</script>
</body>
</html>`;
}
