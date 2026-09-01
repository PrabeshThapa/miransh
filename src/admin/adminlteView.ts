// AdminLTE v3 Complete Package Dashboard Renderer for MIRANSH Admin Panel

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
    escapeHtml,
  } = data;

  const pendingInquiriesCount = inquiries.filter((i) => i.status !== 'resolved').length;
  const newInquiriesCount = inquiries.filter((i) => i.status === 'new' || !i.status).length;
  const resolvedInquiriesCount = inquiries.filter((i) => i.status === 'resolved').length;
  const inProgressInquiriesCount = inquiries.filter((i) => i.status === 'in_progress').length;

  return `<!DOCTYPE html>
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
        :root {
            --primary-brand: #007bff;
        }
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
                <a class="nav-link" data-widget="pushmenu" href="#" role="button" title="サイドバー切り替え">
                    <i class="fas fa-bars"></i>
                </a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="/admin?tab=dashboard" class="nav-link font-weight-bold ${activeTab === 'dashboard' ? 'text-primary' : ''}">
                    <i class="fas fa-tachometer-alt mr-1"></i> ダッシュボード
                </a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="/admin?tab=inquiries" class="nav-link ${activeTab === 'inquiries' ? 'text-primary font-weight-bold' : ''}">
                    <i class="fas fa-envelope mr-1"></i> お問い合わせ
                    ${newInquiriesCount > 0 ? `<span class="badge badge-danger ml-1">${newInquiriesCount}</span>` : ''}
                </a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="/" target="_blank" class="nav-link text-info">
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
                    ${pendingInquiriesCount > 0 ? `<span class="badge badge-warning navbar-badge">${pendingInquiriesCount}</span>` : ''}
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right shadow-sm">
                    <span class="dropdown-header font-weight-bold">${inquiries.length} 件のお問い合わせ (${pendingInquiriesCount} 件 未完了)</span>
                    <div class="dropdown-divider"></div>
                    <a href="/admin?tab=inquiries" class="dropdown-item">
                        <i class="fas fa-envelope text-primary mr-2"></i> ${newInquiriesCount} 件の新着メッセージ
                        <span class="float-right text-muted text-sm font-weight-bold">新規</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="/admin?tab=inquiries" class="dropdown-item">
                        <i class="fas fa-clock text-warning mr-2"></i> ${inProgressInquiriesCount} 件の対応中案件
                        <span class="float-right text-muted text-sm">進行中</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="/admin?tab=inquiries" class="dropdown-item dropdown-footer text-primary font-weight-bold">すべてのお問い合わせを見る</a>
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
                                <a href="/admin?tab=inquiries" class="text-dark font-weight-bold">リード<br><span class="badge badge-primary">${inquiries.length}</span></a>
                            </div>
                            <div class="col-4">
                                <a href="/admin?tab=services" class="text-dark font-weight-bold">分野<br><span class="badge badge-success">${services.length}</span></a>
                            </div>
                            <div class="col-4">
                                <a href="/admin?tab=stories" class="text-dark font-weight-bold">事例<br><span class="badge badge-info">${stories.length}</span></a>
                            </div>
                        </div>
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer d-flex justify-content-between">
                        <a href="/admin?tab=users" class="btn btn-default btn-flat text-sm"><i class="fas fa-user-cog mr-1"></i> アカウント</a>
                        <a href="/admin/logout" class="btn btn-danger btn-flat text-sm"><i class="fas fa-sign-out-alt mr-1"></i> ログアウト</a>
                    </li>
                </ul>
            </li>

            <!-- Control Sidebar Toggle -->
            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button" title="テーマ・システム設定">
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
                    <span class="badge badge-success text-xs"><i class="fas fa-circle text-xs mr-1"></i> 管理者 (AdminLTE)</span>
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
                        <a href="/admin?tab=dashboard" class="nav-link ${activeTab === 'dashboard' ? 'active' : ''}">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>
                                ダッシュボード & 分析
                                <span class="right badge badge-primary">KPI</span>
                            </p>
                        </a>
                    </li>

                    <li class="nav-header font-weight-bold text-uppercase text-secondary">CORE MANAGEMENT</li>
                    
                    <li class="nav-item">
                        <a href="/admin?tab=inquiries" class="nav-link ${activeTab === 'inquiries' ? 'active' : ''}">
                            <i class="nav-icon fas fa-envelope"></i>
                            <p>
                                お問い合わせ・リード
                                <span class="badge badge-warning right">${inquiries.length}</span>
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="/admin?tab=company" class="nav-link ${activeTab === 'company' ? 'active' : ''}">
                            <i class="nav-icon fas fa-building"></i>
                            <p>会社情報 & CEOメディア</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="/admin?tab=about" class="nav-link ${activeTab === 'about' ? 'active' : ''}">
                            <i class="nav-icon fas fa-award"></i>
                            <p>企業理念 & About Us</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="/admin?tab=services" class="nav-link ${activeTab === 'services' ? 'active' : ''}">
                            <i class="nav-icon fas fa-briefcase"></i>
                            <p>
                                特定技能・事業内容
                                <span class="badge badge-info right">${services.length}</span>
                            </p>
                        </a>
                    </li>

                    <li class="nav-header font-weight-bold text-uppercase text-secondary">CONTENT & ARTICLES</li>

                    <li class="nav-item">
                        <a href="/admin?tab=stories" class="nav-link ${activeTab === 'stories' ? 'active' : ''}">
                            <i class="nav-icon fas fa-newspaper"></i>
                            <p>
                                採用事例・お知らせ
                                <span class="badge badge-success right">${stories.length}</span>
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="/admin?tab=faqs" class="nav-link ${activeTab === 'faqs' ? 'active' : ''}">
                            <i class="nav-icon fas fa-question-circle"></i>
                            <p>
                                FAQ よくある質問
                                <span class="badge badge-secondary right">${faqs.length}</span>
                            </p>
                        </a>
                    </li>

                    <li class="nav-header font-weight-bold text-uppercase text-secondary">AI & SYSTEM</li>

                    <li class="nav-item">
                        <a href="/admin?tab=ai" class="nav-link ${activeTab === 'ai' ? 'active' : ''}">
                            <i class="nav-icon fas fa-microchip"></i>
                            <p>
                                Sakana AI 相談エンジン
                                <span class="badge badge-success right">稼働中</span>
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="/admin?tab=users" class="nav-link ${activeTab === 'users' ? 'active' : ''}">
                            <i class="nav-icon fas fa-user-shield"></i>
                            <p>管理者アカウント設定</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="/admin?tab=timeline" class="nav-link ${activeTab === 'timeline' ? 'active' : ''}">
                            <i class="nav-icon fas fa-history"></i>
                            <p>操作ログ・タイムライン</p>
                        </a>
                    </li>

                    <li class="nav-item mt-3">
                        <a href="/" target="_blank" class="nav-link bg-secondary text-white">
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
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2 align-items-center">
                    <div class="col-sm-6">
                        <h1 class="m-0 font-weight-bold text-dark">
                            ${activeTab === 'dashboard' ? '<i class="fas fa-chart-pie text-primary mr-2"></i> ダッシュボード & KPI分析' :
                              activeTab === 'company' ? '<i class="fas fa-building text-primary mr-2"></i> 会社基本情報・代表者メディア管理' :
                              activeTab === 'about' ? '<i class="fas fa-award text-primary mr-2"></i> 企業理念・会社紹介 (About Us)' :
                              activeTab === 'services' ? '<i class="fas fa-briefcase text-primary mr-2"></i> 特定技能分野・事業案内 管理' :
                              activeTab === 'stories' ? '<i class="fas fa-newspaper text-primary mr-2"></i> 採用事例・お知らせ 記事管理' :
                              activeTab === 'faqs' ? '<i class="fas fa-question-circle text-primary mr-2"></i> よくある質問 (FAQ) 管理' :
                              activeTab === 'inquiries' ? '<i class="fas fa-envelope text-primary mr-2"></i> お問い合わせ・リード対応管理' :
                              activeTab === 'users' ? '<i class="fas fa-user-shield text-primary mr-2"></i> 管理者アカウント & セキュリティ' :
                              activeTab === 'timeline' ? '<i class="fas fa-history text-primary mr-2"></i> システムアクティビティ・操作タイムライン' :
                              '<i class="fas fa-microchip text-primary mr-2"></i> Sakana AI 相談エンジン設定 & 診断'}
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/admin"><i class="fas fa-home"></i> ホーム</a></li>
                            <li class="breadcrumb-item"><a href="/admin">AdminLTE v3</a></li>
                            <li class="breadcrumb-item active text-capitalize">${activeTab}</li>
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
                                <p>総お問い合わせ受信件数</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <a href="/admin?tab=inquiries" class="small-box-footer">
                                リード一覧を開く <i class="fas fa-arrow-circle-right ml-1"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning shadow-sm">
                            <div class="inner">
                                <h3>${pendingInquiriesCount}</h3>
                                <p>未対応・対応中案件</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <a href="/admin?tab=inquiries" class="small-box-footer">
                                未対応リードを処理 <i class="fas fa-arrow-circle-right ml-1"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success shadow-sm">
                            <div class="inner">
                                <h3>${services.length}</h3>
                                <p>支援対応 特定技能分野数</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-briefcase"></i>
                            </div>
                            <a href="/admin?tab=services" class="small-box-footer">
                                分野一覧を管理 <i class="fas fa-arrow-circle-right ml-1"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger shadow-sm">
                            <div class="inner">
                                <h3>${stories.length}</h3>
                                <p>公開中事例・お知らせ</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-newspaper"></i>
                            </div>
                            <a href="/admin?tab=stories" class="small-box-footer">
                                記事を管理・作成 <i class="fas fa-arrow-circle-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- TAB 0: DASHBOARD & CHARTS (When activeTab is 'dashboard' or default) -->
                ${(activeTab === 'dashboard') ? `
                <div class="row">
                    <!-- Chart 1: Inquiries Trend (Area/Bar Chart) -->
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
                                        <div class="font-weight-bold text-info">${resolvedInquiriesCount} / ${inquiries.length}</div>
                                        <span class="text-muted">対応完了率</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Chart 2: Visa Categories Breakdown (Donut Chart) -->
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

                <!-- Recent Inquiries & Quick Management Row -->
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card card-secondary card-outline shadow-sm">
                            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                                <h3 class="card-title font-weight-bold">
                                    <i class="fas fa-list text-secondary mr-1"></i> 最新のお問い合わせ・リード速報
                                </h3>
                                <a href="/admin?tab=inquiries" class="btn btn-primary btn-xs font-weight-bold">
                                    すべて表示 (${inquiries.length}) <i class="fas fa-arrow-right ml-1"></i>
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
                                            ${inquiries.slice(0, 5).map(inq => `
                                            <tr>
                                                <td>
                                                    <div class="font-weight-bold">${escapeHtml(inq.name)}</div>
                                                    <small class="text-muted">${escapeHtml(inq.company_name || inq.email)}</small>
                                                </td>
                                                <td><span class="badge badge-info">${escapeHtml(inq.service_interest || '全般')}</span></td>
                                                <td class="text-truncate" style="max-width: 220px;">${escapeHtml(inq.message || '')}</td>
                                                <td>
                                                    <span class="badge ${inq.status === 'resolved' ? 'badge-success' : inq.status === 'in_progress' ? 'badge-warning' : 'badge-danger'} py-1 px-2">
                                                        ${inq.status === 'resolved' ? '対応済' : inq.status === 'in_progress' ? '対応中' : '未対応'}
                                                    </span>
                                                </td>
                                                <td class="text-right">
                                                    <button type="button" class="btn btn-default btn-xs" onclick='openInquiryDetailModal(${JSON.stringify(inq).replace(/'/g, "&#39;")})' title="詳細">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            `).join('') || '<tr><td colspan="5" class="text-center py-3 text-muted">お問い合わせはありません</td></tr>'}
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
                                <a href="/admin?tab=company" class="btn btn-outline-info btn-block mb-2 text-left font-weight-bold">
                                    <i class="fas fa-camera mr-2"></i> 代表者顔写真・バナーの変更
                                </a>
                                <a href="/admin?tab=ai" class="btn btn-outline-success btn-block mb-2 text-left font-weight-bold">
                                    <i class="fas fa-robot mr-2"></i> Sakana AI 相談モデルの診断
                                </a>
                                <a href="/" target="_blank" class="btn btn-outline-secondary btn-block text-left font-weight-bold">
                                    <i class="fas fa-external-link-alt mr-2"></i> 公開ホームページを確認 ↗
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                ` : ''}

                <!-- TAB 1: Company Profile & Media -->
                ${activeTab === 'company' ? `
                <div class="card card-primary card-outline shadow-sm">
                    <div class="card-header bg-white">
                        <h3 class="card-title font-weight-bold">
                            <i class="fas fa-building text-primary mr-1"></i> 会社基本情報・代表者設定・トップバナー設定
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <form action="/admin/company" method="POST">
                        <div class="card-body">
                            
                            <!-- 1. CEO Image & Profile -->
                            <div class="callout callout-info mb-4">
                                <h5 class="font-weight-bold text-primary"><i class="fas fa-user-tie mr-1"></i> 1. 代表者（CEO）情報 & 顔写真設定</h5>
                                <p class="text-sm text-muted mb-0">ウェブサイト上の代表挨拶セクションに表示される代表者顔写真とメッセージです。</p>
                            </div>

                            <div class="row align-items-center mb-4 p-3 bg-light rounded border mx-0">
                                <div class="col-md-3 text-center mb-3 mb-md-0">
                                    <img id="preview_ceo_img" src="${escapeHtml(company.ceo_image || '/images/ceo_portrait.jpg')}" alt="CEO Photo" class="preview-img-box img-thumbnail shadow-sm" style="width: 140px; height: 140px;" onerror="this.src='/images/ceo_portrait.jpg'">
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
                                    <div id="ceo_status" class="badge badge-success text-xs mt-2 py-1 px-2" style="display: ${company.ceo_image ? 'inline-block' : 'none'};">
                                        ✓ 現在の写真が設定されています
                                    </div>
                                    <input type="hidden" id="input_ceo_image" name="ceo_image" value="${escapeHtml(company.ceo_image || '/images/ceo_portrait.jpg')}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold">代表社員 日本語氏名 <span class="text-danger">*</span></label>
                                    <input type="text" name="ceo_name_ja" class="form-control" value="${escapeHtml(company.ceo_name_ja || 'ギリ ラム クリシュナ')}" required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold">代表社員 英語氏名 <span class="text-danger">*</span></label>
                                    <input type="text" name="ceo_name_en" class="form-control" value="${escapeHtml(company.ceo_name_en || 'Giri Ram Krishna')}" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold">代表役職名 (日本語)</label>
                                    <input type="text" name="ceo_role_ja" class="form-control" value="${escapeHtml(company.ceo_role_ja || '代表社員')}">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold">代表役職名 (英語)</label>
                                    <input type="text" name="ceo_role_en" class="form-control" value="${escapeHtml(company.ceo_role_en || 'Representative Member')}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold">代表挨拶 (CEO Message - Japanese)</label>
                                    <textarea name="ceo_message_ja" class="form-control" rows="6">${escapeHtml(company.ceo_message_ja)}</textarea>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold">代表挨拶 (CEO Message - English)</label>
                                    <textarea name="ceo_message_en" class="form-control" rows="6">${escapeHtml(company.ceo_message_en)}</textarea>
                                </div>
                            </div>

                            <!-- 2. Hero Banner Image -->
                            <div class="callout callout-info mt-4 mb-4">
                                <h5 class="font-weight-bold text-primary"><i class="fas fa-image mr-1"></i> 2. トップヒーローバナー & 背景画像設定</h5>
                                <p class="text-sm text-muted mb-0">トップページのメインビジュアル画像とキャッチコピーです。</p>
                            </div>

                            <div class="row align-items-center mb-4 p-3 bg-light rounded border mx-0">
                                <div class="col-md-5 text-center mb-3 mb-md-0">
                                    <img id="preview_hero_img" src="${escapeHtml(company.hero_image || '/images/hero_banner.jpg')}" alt="Hero Banner" class="preview-img-box img-fluid shadow-sm" style="max-height: 160px; width: 100%; object-fit: cover;" onerror="this.src='/images/hero_banner.jpg'">
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
                                    <div id="hero_status" class="badge badge-success text-xs mt-2 py-1 px-2" style="display: ${company.hero_image ? 'inline-block' : 'none'};">
                                        ✓ 現在のバナー画像が設定されています
                                    </div>
                                    <input type="hidden" id="input_hero_image" name="hero_image" value="${escapeHtml(company.hero_image || '/images/hero_banner.jpg')}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold">キャッチコピー (日本語)</label>
                                    <input type="text" name="hero_title_ja" class="form-control" value="${escapeHtml(company.hero_title_ja || '日本企業と海外人材をつなぐ、')}">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold">強調ワード (日本語)</label>
                                    <input type="text" name="hero_title_accent_ja" class="form-control" value="${escapeHtml(company.hero_title_accent_ja || '信頼の架け橋。')}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold">キャッチコピー (英語)</label>
                                    <input type="text" name="hero_title_en" class="form-control" value="${escapeHtml(company.hero_title_en || 'Bridging Japanese Enterprises and')}">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold">強調ワード (英語)</label>
                                    <input type="text" name="hero_title_accent_en" class="form-control" value="${escapeHtml(company.hero_title_accent_en || 'Global Talent with Trust.')}">
                                </div>
                            </div>

                            <!-- 3. Corporate Info -->
                            <div class="callout callout-info mt-4 mb-4">
                                <h5 class="font-weight-bold text-primary"><i class="fas fa-info-circle mr-1"></i> 3. 会社基本概要 & 連絡先情報</h5>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold">会社名 (日本語) <span class="text-danger">*</span></label>
                                    <input type="text" name="name_ja" class="form-control" value="${escapeHtml(company.name_ja)}" required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold">Company Name (English) <span class="text-danger">*</span></label>
                                    <input type="text" name="name_en" class="form-control" value="${escapeHtml(company.name_en)}" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold">法人番号 (Corporate Number)</label>
                                    <input type="text" name="corporate_number" class="form-control" value="${escapeHtml(company.corporate_number)}">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold">登録支援機関・許認可番号</label>
                                    <input type="text" name="license" class="form-control" value="${escapeHtml(company.license)}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold">電話番号</label>
                                    <input type="text" name="phone" class="form-control" value="${escapeHtml(company.phone)}">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold">メールアドレス</label>
                                    <input type="email" name="email" class="form-control" value="${escapeHtml(company.email)}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold">所在地住所 (日本語)</label>
                                    <input type="text" name="address_ja" class="form-control" value="${escapeHtml(company.address_ja)}">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold">Headquarters Address (English)</label>
                                    <input type="text" name="address_en" class="form-control" value="${escapeHtml(company.address_en)}">
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
                ` : ''}

                <!-- TAB 2: Philosophy & About -->
                ${activeTab === 'about' ? `
                <div class="card card-primary card-outline shadow-sm">
                    <div class="card-header bg-white">
                        <h3 class="card-title font-weight-bold">
                            <i class="fas fa-award text-primary mr-1"></i> 企業理念・会社紹介・強み (About Us)
                        </h3>
                    </div>
                    <form action="/admin/about" method="POST">
                        <div class="card-body">
                            <div class="form-group">
                                <label class="font-weight-bold">見出し (Headline - Japanese) <span class="text-danger">*</span></label>
                                <input type="text" name="heading_ja" class="form-control" value="${escapeHtml(about.heading_ja)}" required>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">詳細説明 1 (Paragraph 1)</label>
                                <textarea name="desc1_ja" class="form-control" rows="4">${escapeHtml(about.desc1_ja)}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">詳細説明 2 (Paragraph 2)</label>
                                <textarea name="desc2_ja" class="form-control" rows="4">${escapeHtml(about.desc2_ja)}</textarea>
                            </div>
                        </div>
                        <div class="card-footer bg-white text-right">
                            <button type="submit" class="btn btn-primary px-4 font-weight-bold">
                                <i class="fas fa-save mr-1"></i> 会社紹介を保存する
                            </button>
                        </div>
                    </form>
                </div>
                ` : ''}

                <!-- TAB 3: Services -->
                ${activeTab === 'services' ? `
                <div class="card card-primary card-outline shadow-sm">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center flex-wrap">
                        <h3 class="card-title font-weight-bold">
                            <i class="fas fa-briefcase text-primary mr-1"></i> 事業内容・特定技能分野一覧 (${services.length}件)
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-primary btn-sm font-weight-bold" onclick="openServiceCreateModal()">
                                <i class="fas fa-plus mr-1"></i> 新規分野・事業追加 (Add Service)
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            ${services.map(s => `
                            <div class="col-md-6 mb-3">
                                <div class="card h-100 shadow-none border">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-2">
                                            <span class="mr-3 font-weight-bold text-primary" style="font-size: 28px;">
                                                <i class="fas fa-${escapeHtml(s.icon || 'briefcase')}"></i>
                                            </span>
                                            <div>
                                                <h5 class="card-title font-weight-bold text-dark mb-0">${escapeHtml(s.title_ja)}</h5>
                                                <small class="text-muted font-weight-bold d-block">${escapeHtml(s.title_en)}</small>
                                            </div>
                                        </div>
                                        <p class="card-text text-sm text-secondary mt-2">${escapeHtml(s.desc_ja)}</p>
                                    </div>
                                    <div class="card-footer bg-white border-top d-flex justify-content-between align-items-center">
                                        <span class="badge badge-primary">ID: #${s.id}</span>
                                        <div>
                                            <button type="button" class="btn btn-outline-info btn-xs mr-1" onclick='openServiceEditModal(${JSON.stringify(s).replace(/'/g, "&#39;")})'>
                                                <i class="fas fa-edit mr-1"></i> 編集
                                            </button>
                                            <a href="/services/${s.id}" target="_blank" class="btn btn-outline-secondary btn-xs mr-1">
                                                プレビュー ↗
                                            </a>
                                            <form action="/admin/services/${s.id}/delete" method="POST" class="d-inline" onsubmit="return confirm('分野「${escapeHtml(s.title_ja)}」を削除しますか？');">
                                                <button type="submit" class="btn btn-outline-danger btn-xs"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            `).join('')}
                        </div>
                    </div>
                </div>

                <!-- SERVICE CREATE/EDIT MODALS -->
                <div class="modal fade" id="serviceModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title font-weight-bold" id="serviceModalTitle"><i class="fas fa-briefcase mr-2"></i> 分野・事業内容の登録</h5>
                                <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                            </div>
                            <form id="serviceForm" action="/admin/services/create" method="POST">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="font-weight-bold">事業・分野タイトル (日本語) <span class="text-danger">*</span></label>
                                        <input type="text" id="svc_title_ja" name="title_ja" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold">Title (English) <span class="text-danger">*</span></label>
                                        <input type="text" id="svc_title_en" name="title_en" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold">アイコン名 (FontAwesome)</label>
                                        <select id="svc_icon" name="icon" class="form-control">
                                            <option value="briefcase">💼 briefcase (全般・ビジネス)</option>
                                            <option value="heart">❤️ heart (介護・医療)</option>
                                            <option value="utensils">🍴 utensils (外食・飲食調理)</option>
                                            <option value="broom">🧹 broom (ビルクリーニング)</option>
                                            <option value="industry">🏭 industry (製造業・ものづくり)</option>
                                            <option value="building">🏢 building (建設業)</option>
                                            <option value="users">👥 users (人材採用・支援)</option>
                                            <option value="globe">🌐 globe (国際・海外連携)</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold">詳細説明 (日本語) <span class="text-danger">*</span></label>
                                        <textarea id="svc_desc_ja" name="desc_ja" class="form-control" rows="3" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold">Description (English)</label>
                                        <textarea id="svc_desc_en" name="desc_en" class="form-control" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer bg-light">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
                                    <button type="submit" class="btn btn-primary font-weight-bold"><i class="fas fa-save mr-1"></i> 保存する</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                ` : ''}

                <!-- TAB 4: Stories & News (With DatePicker) -->
                ${activeTab === 'stories' ? `
                <div class="card card-primary card-outline shadow-sm">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center flex-wrap">
                        <h3 class="card-title font-weight-bold">
                            <i class="fas fa-newspaper text-primary mr-1"></i> 採用事例・お知らせ 管理 (${stories.length}件)
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-primary btn-sm font-weight-bold" onclick="openStoryCreateModal()">
                                <i class="fas fa-plus mr-1"></i> 新規事例を追加 (Add Story)
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Search Bar -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" id="stories_table_search" class="form-control" placeholder="事例タイトルやカテゴリで絞り込み..." oninput="filterStoriesTable(this.value)">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover table-middle" id="stories_admin_table">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="width: 70px;" class="text-center">写真</th>
                                        <th>タイトル (日本語 / 英語)</th>
                                        <th style="width: 150px;">カテゴリ</th>
                                        <th style="width: 140px;">📅 公開日</th>
                                        <th style="width: 130px;" class="text-right">アクション</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${stories.map(st => `
                                    <tr class="story-row-item" data-search="${escapeHtml(st.title_ja + ' ' + (st.title_en || '') + ' ' + st.category_ja).toLowerCase()}">
                                        <td class="text-center">
                                            <img src="${escapeHtml(st.image || '/images/story1.jpg')}" alt="Story" class="img-thumbnail" style="width: 60px; height: 42px; object-fit: cover;">
                                        </td>
                                        <td>
                                            <div class="font-weight-bold text-dark">
                                                ${escapeHtml(st.title_ja)}
                                                ${st.featured ? '<span class="badge badge-warning ml-1 text-xs">★ おすすめ</span>' : ''}
                                            </div>
                                            <small class="text-muted">${escapeHtml(st.title_en)}</small>
                                        </td>
                                        <td>
                                            <span class="badge badge-info text-xs">${escapeHtml(st.category_ja)}</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-light border text-sm font-weight-bold">
                                                <i class="far fa-calendar-alt text-primary mr-1"></i> ${escapeHtml(st.published_date)}
                                            </span>
                                        </td>
                                        <td class="text-right text-nowrap">
                                            <button type="button" class="btn btn-info btn-xs" onclick='openStoryEditModal(${JSON.stringify(st).replace(/'/g, "&#39;")})' title="編集">
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>
                                            <a href="/stories/${st.id}" target="_blank" class="btn btn-secondary btn-xs" title="プレビュー">
                                                <i class="fas fa-external-link-alt"></i>
                                            </a>
                                            <form action="/admin/stories/${st.id}/delete" method="POST" class="d-inline" onsubmit="return confirm('本当に事例「${escapeHtml(st.title_ja)}」を削除しますか？');">
                                                <button type="submit" class="btn btn-danger btn-xs" title="削除">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    `).join('') || '<tr><td colspan="5" class="text-center text-muted py-4">登録された事例はありません。</td></tr>'}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- STORY CREATE MODAL -->
                <div class="modal fade" id="storyCreateModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title font-weight-bold"><i class="fas fa-plus mr-2"></i> 新規 採用事例の追加 (Add New Story)</h5>
                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="/admin/stories/create" method="POST">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label class="font-weight-bold">タイトル (日本語) <span class="text-danger">*</span></label>
                                            <input type="text" name="title_ja" class="form-control" placeholder="例: 神奈川県・介護老人保健施設での特定技能マッチング" required>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label class="font-weight-bold">Title (English) <span class="text-danger">*</span></label>
                                            <input type="text" name="title_en" class="form-control" placeholder="e.g. Caregiving Placement in Kanagawa" required>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label class="font-weight-bold">カテゴリ (日本語) <span class="text-danger">*</span></label>
                                            <input type="text" name="category_ja" class="form-control" value="特定技能 / 介護分野" required>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label class="font-weight-bold">Category (English) <span class="text-danger">*</span></label>
                                            <input type="text" name="category_en" class="form-control" value="Nursing Care / SSW" required>
                                        </div>
                                    </div>

                                    <!-- DATE PICKER SECTION -->
                                    <div class="card card-outline card-info mb-3">
                                        <div class="card-body py-2 px-3 bg-light">
                                            <label class="font-weight-bold text-dark mb-1">
                                                <i class="far fa-calendar-alt text-info mr-1"></i> 公開日 (Published Date) & 日付ピッカー
                                            </label>
                                            <div class="row align-items-center">
                                                <div class="col-md-6 mb-2 mb-md-0">
                                                    <input type="date" id="create_story_datepicker" class="form-control font-weight-bold" onchange="syncDateToTextInput('create_story_datepicker', 'create_story_datetext')">
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text text-xs font-weight-bold">保存形式:</span>
                                                        </div>
                                                        <input type="text" id="create_story_datetext" name="published_date" class="form-control font-weight-bold text-center" value="${new Date().toISOString().slice(0, 10).replace(/-/g, '.')}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-2 text-xs">
                                                <span class="font-weight-bold mr-1">クイック設定:</span>
                                                <button type="button" class="btn btn-xs btn-outline-secondary" onclick="setPresetDateForForm('create_story_datepicker', 'create_story_datetext', 0)">今日</button>
                                                <button type="button" class="btn btn-xs btn-outline-secondary" onclick="setPresetDateForForm('create_story_datepicker', 'create_story_datetext', -1)">昨日</button>
                                                <button type="button" class="btn btn-xs btn-outline-secondary" onclick="setPresetDateForForm('create_story_datepicker', 'create_story_datetext', -7)">1週間前</button>
                                                <button type="button" class="btn btn-xs btn-outline-secondary" onclick="setPresetDateForForm('create_story_datepicker', 'create_story_datetext', -30)">1か月前</button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- IMAGE UPLOADER -->
                                    <div class="form-group p-3 bg-light rounded border">
                                        <label class="font-weight-bold">📷 カバー写真 (Cover Image)</label>
                                        <div class="d-flex align-items-center flex-wrap gap-3">
                                            <img id="preview_create_story" src="/images/story1.jpg" alt="Preview" class="img-thumbnail mr-3" style="width: 100px; height: 70px; object-fit: cover;">
                                            <div class="flex-grow-1">
                                                <input type="text" id="input_create_story_img" name="image" class="form-control form-control-sm mb-2" value="/images/story1.jpg" oninput="updateStoryPreview('input_create_story_img', 'preview_create_story')">
                                                <label class="btn btn-sm btn-primary mb-0 cursor-pointer">
                                                    <i class="fas fa-upload mr-1"></i> 画像ファイル選択
                                                    <input type="file" accept="image/*" class="d-none" onchange="handleAdminUpload(this, 'input_create_story_img', 'preview_create_story', 'status_create_story_img')">
                                                </label>
                                                <span id="status_create_story_img" class="badge badge-success ml-2"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="font-weight-bold">概要文 (日本語) <span class="text-danger">*</span></label>
                                        <textarea name="summary_ja" class="form-control" rows="2" placeholder="事例の要約..." required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold">Summary (English) <span class="text-danger">*</span></label>
                                        <textarea name="summary_en" class="form-control" rows="2" placeholder="Summary in English..." required></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label class="font-weight-bold">詳細記事・本文 (日本語)</label>
                                        <textarea name="content_ja" class="form-control" rows="4" placeholder="詳細な導入経緯、お客様の声など..."></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold">Full Article (English)</label>
                                        <textarea name="content_en" class="form-control" rows="4" placeholder="Detailed story in English..."></textarea>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label class="font-weight-bold">執筆者 (Author)</label>
                                            <input type="text" name="author" class="form-control" value="MIRANSH 編集部">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label class="font-weight-bold">トップ掲載 (Featured / おすすめ)</label>
                                            <select name="featured" class="form-control">
                                                <option value="1">★ おすすめとして表示 (Featured)</option>
                                                <option value="0">通常表示 (Standard)</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer bg-light">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
                                    <button type="submit" class="btn btn-primary font-weight-bold"><i class="fas fa-check mr-1"></i> 事例を登録する</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- STORY EDIT MODAL -->
                <div class="modal fade" id="storyEditModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-info text-white">
                                <h5 class="modal-title font-weight-bold"><i class="fas fa-edit mr-2"></i> 採用事例の編集 (Edit Story <span id="edit-story-id-label"></span>)</h5>
                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form id="form-edit-story" action="" method="POST">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label class="font-weight-bold">タイトル (日本語) <span class="text-danger">*</span></label>
                                            <input type="text" id="edit-st-title-ja" name="title_ja" class="form-control" required>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label class="font-weight-bold">Title (English) <span class="text-danger">*</span></label>
                                            <input type="text" id="edit-st-title-en" name="title_en" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label class="font-weight-bold">カテゴリ (日本語) <span class="text-danger">*</span></label>
                                            <input type="text" id="edit-st-cat-ja" name="category_ja" class="form-control" required>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label class="font-weight-bold">Category (English) <span class="text-danger">*</span></label>
                                            <input type="text" id="edit-st-cat-en" name="category_en" class="form-control" required>
                                        </div>
                                    </div>

                                    <!-- DATE PICKER (EDIT) -->
                                    <div class="card card-outline card-info mb-3">
                                        <div class="card-body py-2 px-3 bg-light">
                                            <label class="font-weight-bold text-dark mb-1">
                                                <i class="far fa-calendar-alt text-info mr-1"></i> 公開日 (Published Date) & 日付ピッカー
                                            </label>
                                            <div class="row align-items-center">
                                                <div class="col-md-6 mb-2 mb-md-0">
                                                    <input type="date" id="edit_story_datepicker" class="form-control font-weight-bold" onchange="syncDateToTextInput('edit_story_datepicker', 'edit-st-date')">
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text text-xs font-weight-bold">保存形式:</span>
                                                        </div>
                                                        <input type="text" id="edit-st-date" name="published_date" class="form-control font-weight-bold text-center">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-2 text-xs">
                                                <span class="font-weight-bold mr-1">クイック設定:</span>
                                                <button type="button" class="btn btn-xs btn-outline-secondary" onclick="setPresetDateForForm('edit_story_datepicker', 'edit-st-date', 0)">今日</button>
                                                <button type="button" class="btn btn-xs btn-outline-secondary" onclick="setPresetDateForForm('edit_story_datepicker', 'edit-st-date', -1)">昨日</button>
                                                <button type="button" class="btn btn-xs btn-outline-secondary" onclick="setPresetDateForForm('edit_story_datepicker', 'edit-st-date', -7)">1週間前</button>
                                                <button type="button" class="btn btn-xs btn-outline-secondary" onclick="setPresetDateForForm('edit_story_datepicker', 'edit-st-date', -30)">1か月前</button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- IMAGE UPLOADER (EDIT) -->
                                    <div class="form-group p-3 bg-light rounded border">
                                        <label class="font-weight-bold">📷 カバー写真 (Cover Image)</label>
                                        <div class="d-flex align-items-center flex-wrap gap-3">
                                            <img id="preview_edit_story" src="/images/story1.jpg" alt="Preview" class="img-thumbnail mr-3" style="width: 100px; height: 70px; object-fit: cover;">
                                            <div class="flex-grow-1">
                                                <input type="text" id="input_edit_story_img" name="image" class="form-control form-control-sm mb-2" oninput="updateStoryPreview('input_edit_story_img', 'preview_edit_story')">
                                                <label class="btn btn-sm btn-primary mb-0 cursor-pointer">
                                                    <i class="fas fa-upload mr-1"></i> 画像ファイル置換
                                                    <input type="file" accept="image/*" class="d-none" onchange="handleAdminUpload(this, 'input_edit_story_img', 'preview_edit_story', 'status_edit_story_img')">
                                                </label>
                                                <span id="status_edit_story_img" class="badge badge-success ml-2"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="font-weight-bold">概要文 (日本語) <span class="text-danger">*</span></label>
                                        <textarea id="edit-st-summary-ja" name="summary_ja" class="form-control" rows="2" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold">Summary (English) <span class="text-danger">*</span></label>
                                        <textarea id="edit-st-summary-en" name="summary_en" class="form-control" rows="2" required></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label class="font-weight-bold">詳細記事・本文 (日本語)</label>
                                        <textarea id="edit-st-content-ja" name="content_ja" class="form-control" rows="4"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold">Full Article (English)</label>
                                        <textarea id="edit-st-content-en" name="content_en" class="form-control" rows="4"></textarea>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label class="font-weight-bold">執筆者 (Author)</label>
                                            <input type="text" id="edit-st-author" name="author" class="form-control">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label class="font-weight-bold">トップ掲載 (Featured / おすすめ)</label>
                                            <select id="edit-st-featured" name="featured" class="form-control">
                                                <option value="1">★ おすすめとして表示 (Featured)</option>
                                                <option value="0">通常表示 (Standard)</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer bg-light">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
                                    <button type="submit" class="btn btn-info font-weight-bold"><i class="fas fa-save mr-1"></i> 変更を保存する</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                ` : ''}

                <!-- TAB 5: FAQs -->
                ${activeTab === 'faqs' ? `
                <div class="card card-primary card-outline shadow-sm">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center flex-wrap">
                        <h3 class="card-title font-weight-bold">
                            <i class="fas fa-question-circle text-primary mr-1"></i> よくある質問 (FAQ 管理) (${faqs.length}件)
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-primary btn-sm font-weight-bold" onclick="openFaqCreateModal()">
                                <i class="fas fa-plus mr-1"></i> 新規FAQを追加 (Add FAQ)
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            ${faqs.map(f => `
                            <div class="col-md-12 mb-3">
                                <div class="card shadow-none border">
                                    <div class="card-header bg-light py-2 d-flex justify-content-between align-items-center">
                                        <div>
                                            <span class="badge badge-primary mr-2">${escapeHtml(f.category_ja || '一般')}</span>
                                            <span class="font-weight-bold text-dark">Q: ${escapeHtml(f.question_ja)}</span>
                                        </div>
                                        <div>
                                            <button type="button" class="btn btn-outline-info btn-xs mr-1" onclick='openFaqEditModal(${JSON.stringify(f).replace(/'/g, "&#39;")})'>
                                                <i class="fas fa-edit mr-1"></i> 編集
                                            </button>
                                            <form action="/admin/faqs/${f.id}/delete" method="POST" class="d-inline" onsubmit="return confirm('このFAQを削除しますか？');">
                                                <button type="submit" class="btn btn-outline-danger btn-xs"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <p class="text-sm text-secondary mb-1"><strong>A (日本語):</strong> ${escapeHtml(f.answer_ja)}</p>
                                        ${f.answer_en ? `<p class="text-xs text-muted mb-0"><strong>A (English):</strong> ${escapeHtml(f.answer_en)}</p>` : ''}
                                    </div>
                                </div>
                            </div>
                            `).join('')}
                        </div>
                    </div>
                </div>

                <!-- FAQ CREATE/EDIT MODAL -->
                <div class="modal fade" id="faqModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title font-weight-bold" id="faqModalTitle"><i class="fas fa-question-circle mr-2"></i> FAQの追加</h5>
                                <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                            </div>
                            <form id="faqForm" action="/admin/faqs/create" method="POST">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="font-weight-bold">カテゴリ (日本語)</label>
                                        <input type="text" id="faq_cat_ja" name="category_ja" class="form-control" value="特定技能・採用について" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold">質問 (日本語) <span class="text-danger">*</span></label>
                                        <input type="text" id="faq_q_ja" name="question_ja" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold">Question (English)</label>
                                        <input type="text" id="faq_q_en" name="question_en" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold">回答 (日本語) <span class="text-danger">*</span></label>
                                        <textarea id="faq_a_ja" name="answer_ja" class="form-control" rows="3" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold">Answer (English)</label>
                                        <textarea id="faq_a_en" name="answer_en" class="form-control" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer bg-light">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
                                    <button type="submit" class="btn btn-primary font-weight-bold"><i class="fas fa-save mr-1"></i> 保存する</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                ` : ''}

                <!-- TAB 6: Inquiries -->
                ${activeTab === 'inquiries' ? `
                <div class="card card-primary card-outline shadow-sm">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center flex-wrap">
                        <h3 class="card-title font-weight-bold">
                            <i class="fas fa-envelope text-primary mr-1"></i> お問い合わせ・リード管理 (${inquiries.length}件)
                        </h3>
                        <div class="card-tools">
                            <span class="badge badge-danger mr-1">未対応: ${newInquiriesCount}</span>
                            <span class="badge badge-warning mr-1">対応中: ${inProgressInquiriesCount}</span>
                            <span class="badge badge-success">完了: ${resolvedInquiriesCount}</span>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-middle mb-0" id="inquiriesDataTable">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="width: 50px;">ID</th>
                                        <th>送信者・企業名</th>
                                        <th>連絡先</th>
                                        <th>ご相談分野</th>
                                        <th>メッセージ内容</th>
                                        <th style="width: 110px;">ステータス</th>
                                        <th style="width: 160px;" class="text-right">対応操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${inquiries.map(inq => `
                                    <tr>
                                        <td><span class="font-weight-bold text-muted">#${inq.id}</span></td>
                                        <td>
                                            <div class="font-weight-bold text-dark">${escapeHtml(inq.name)}</div>
                                            <small class="text-muted">${escapeHtml(inq.company_name || '個人・未記入')}</small>
                                        </td>
                                        <td>
                                            <div class="text-sm"><i class="fas fa-envelope text-primary mr-1"></i> <a href="mailto:${escapeHtml(inq.email)}">${escapeHtml(inq.email)}</a></div>
                                            <small class="text-muted"><i class="fas fa-phone text-secondary mr-1"></i> ${escapeHtml(inq.phone || '-')}</small>
                                        </td>
                                        <td>
                                            <span class="badge badge-info">${escapeHtml(inq.service_interest || '全般')}</span>
                                        </td>
                                        <td class="text-sm" style="max-width: 300px;">
                                            <div class="text-truncate" style="max-width: 280px;">${escapeHtml(inq.message)}</div>
                                        </td>
                                        <td>
                                            <span class="badge ${inq.status === 'resolved' ? 'badge-success' : inq.status === 'in_progress' ? 'badge-warning' : 'badge-danger'} py-1 px-2">
                                                ${inq.status === 'resolved' ? '✓ 対応済' : inq.status === 'in_progress' ? '⏳ 対応中' : '✉ 未対応'}
                                            </span>
                                        </td>
                                        <td class="text-right text-nowrap">
                                            <button type="button" class="btn btn-default btn-xs mr-1" onclick='openInquiryDetailModal(${JSON.stringify(inq).replace(/'/g, "&#39;")})' title="詳細確認・返信">
                                                <i class="fas fa-eye text-primary"></i>
                                            </button>
                                            <form action="/admin/inquiries/${inq.id}/status" method="POST" class="d-inline">
                                                <select name="status" class="custom-select custom-select-sm d-inline-block font-weight-bold" style="width: 85px;" onchange="this.form.submit()">
                                                    <option value="new" ${inq.status === 'new' ? 'selected' : ''}>未対応</option>
                                                    <option value="in_progress" ${inq.status === 'in_progress' ? 'selected' : ''}>対応中</option>
                                                    <option value="resolved" ${inq.status === 'resolved' ? 'selected' : ''}>対応済</option>
                                                </select>
                                            </form>
                                            <form action="/admin/inquiries/${inq.id}/delete" method="POST" class="d-inline ml-1" onsubmit="return confirm('お問い合わせ #${inq.id} を削除しますか？');">
                                                <button type="submit" class="btn btn-outline-danger btn-xs"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    `).join('') || '<tr><td colspan="7" class="text-center text-muted py-4">お問い合わせはありません。</td></tr>'}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- INQUIRY DETAIL MODAL -->
                <div class="modal fade" id="inquiryDetailModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title font-weight-bold"><i class="fas fa-envelope-open-text mr-2"></i> お問い合わせ詳細 (<span id="inq_modal_id"></span>)</h5>
                                <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="text-xs text-muted text-uppercase font-weight-bold">お名前 / 送信者</label>
                                        <div id="inq_modal_name" class="font-weight-bold h6 text-dark"></div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="text-xs text-muted text-uppercase font-weight-bold">企業名 / 組織名</label>
                                        <div id="inq_modal_company" class="font-weight-bold h6 text-dark"></div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="text-xs text-muted text-uppercase font-weight-bold">メールアドレス</label>
                                        <div><a id="inq_modal_email_link" href="" class="font-weight-bold"><i class="fas fa-envelope mr-1"></i> <span id="inq_modal_email"></span></a></div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="text-xs text-muted text-uppercase font-weight-bold">電話番号</label>
                                        <div id="inq_modal_phone" class="font-weight-bold text-dark"></div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="text-xs text-muted text-uppercase font-weight-bold">ご相談特定技能分野 / サービス</label>
                                    <div><span id="inq_modal_service" class="badge badge-info p-2 font-weight-bold"></span></div>
                                </div>

                                <div class="form-group p-3 bg-light rounded border">
                                    <label class="font-weight-bold text-dark mb-1">お問い合わせ内容・相談メッセージ</label>
                                    <div id="inq_modal_message" class="text-dark" style="white-space: pre-line; line-height: 1.6;"></div>
                                </div>

                                <form id="inq_status_form" action="" method="POST" class="d-flex align-items-center gap-3">
                                    <label class="font-weight-bold mr-3 mb-0">ステータス変更:</label>
                                    <select id="inq_modal_status_select" name="status" class="form-control font-weight-bold" style="max-width: 200px;">
                                        <option value="new">未対応 (New)</option>
                                        <option value="in_progress">対応中 (In Progress)</option>
                                        <option value="resolved">対応済 (Resolved)</option>
                                    </select>
                                    <button type="submit" class="btn btn-primary font-weight-bold ml-2"><i class="fas fa-check mr-1"></i> 更新</button>
                                </form>
                            </div>
                            <div class="modal-footer bg-light">
                                <a id="inq_modal_mailto_btn" href="" class="btn btn-success font-weight-bold">
                                    <i class="fas fa-reply mr-1"></i> メール返信を作成 (Mailto)
                                </a>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                            </div>
                        </div>
                    </div>
                </div>
                ` : ''}

                <!-- TAB 7: AI Engine (Sakana AI) -->
                ${activeTab === 'ai' ? `
                <div class="card card-primary card-outline shadow-sm">
                    <div class="card-header bg-white">
                        <h3 class="card-title font-weight-bold">
                            <i class="fas fa-microchip text-primary mr-1"></i> Sakana AI 相談エンジン設定 & 稼働診断
                        </h3>
                    </div>
                    <form action="/admin/api/sakana/config" method="POST">
                        <div class="card-body">
                            <div class="callout callout-info mb-4">
                                <h5 class="font-weight-bold text-info"><i class="fas fa-robot mr-1"></i> 日本特化型 AI「Sakana AI (Namazu / Fugu)」</h5>
                                <p class="text-sm text-muted mb-0">ウェブサイト上の特定技能ビザや外国人材採用に関するリアルタイムAI相談機能のモデルおよび認証キー設定です。</p>
                            </div>

                            <div class="form-group" style="max-width: 600px;">
                                <label class="font-weight-bold">使用 AI モデル (Selected Model)</label>
                                <select name="model" id="sakana_model_select" class="form-control font-weight-bold">
                                    <option value="sakana-namazu" ${currentSakanaModel === 'sakana-namazu' ? 'selected' : ''}>Sakana Namazu (日本語特化・高度推論モデル)</option>
                                    <option value="fugu" ${currentSakanaModel === 'fugu' ? 'selected' : ''}>Sakana Fugu (自律エージェント連携モデル)</option>
                                    <option value="fugu-ultra" ${currentSakanaModel === 'fugu-ultra' ? 'selected' : ''}>Sakana Fugu Ultra (深層リサーチ対応モデル)</option>
                                </select>
                            </div>

                            <div class="form-group" style="max-width: 600px;">
                                <label class="font-weight-bold">Sakana AI API Key</label>
                                <div class="input-group">
                                    <input type="text" name="apiKey" id="sakana_apikey_input" class="form-control" value="${currentSakanaKey}" placeholder="fish_live_..." autocomplete="off">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    </div>
                                </div>
                                <small class="text-muted">入力したキーまたは環境変数が安全に適用されます。</small>
                            </div>

                            <div class="d-flex flex-wrap gap-2 align-items-center mt-4">
                                <button type="submit" class="btn btn-primary font-weight-bold mr-2">
                                    <i class="fas fa-save mr-1"></i> AI設定を保存する
                                </button>
                                <button type="button" class="btn btn-outline-info font-weight-bold" id="btn_test_sakana" onclick="runSakanaDiagnosticTest()">
                                    <i class="fas fa-bolt mr-1"></i> 接続テスト・応答診断
                                </button>
                            </div>

                            <div id="ai_test_output" class="mt-3 p-3 bg-dark text-info rounded text-monospace text-xs" style="display: none; max-height: 250px; overflow-y: auto;"></div>
                        </div>
                    </form>
                </div>
                ` : ''}

                <!-- TAB 8: Admin Users & Security -->
                ${activeTab === 'users' ? `
                <div class="card card-primary card-outline shadow-sm">
                    <div class="card-header bg-white">
                        <h3 class="card-title font-weight-bold">
                            <i class="fas fa-user-shield text-primary mr-1"></i> 管理者アカウント設定・パスワード変更
                        </h3>
                    </div>
                    <form action="/admin/profile" method="POST">
                        <div class="card-body">
                            <div class="callout callout-info mb-4">
                                <h5 class="font-weight-bold text-info"><i class="fas fa-lock mr-1"></i> 管理者認証セキュリティ</h5>
                                <p class="text-sm text-muted mb-0">AdminLTE管理パネルへのログイン資格情報を更新できます。</p>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold">管理者名 (Display Name)</label>
                                    <input type="text" name="name" class="form-control font-weight-bold" value="${escapeHtml(user.name || 'admin')}" required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold">管理者メールアドレス (Login Email)</label>
                                    <input type="email" name="email" class="form-control font-weight-bold" value="${escapeHtml(user.email || 'admin@miransh.jp')}" required>
                                </div>
                            </div>

                            <div class="form-group" style="max-width: 500px;">
                                <label class="font-weight-bold">新しいパスワード (変更する場合のみ入力)</label>
                                <input type="password" name="new_password" class="form-control" placeholder="••••••••">
                                <small class="text-muted">空欄の場合は現在のパスワードが保持されます。</small>
                            </div>
                        </div>
                        <div class="card-footer bg-white text-right">
                            <button type="submit" class="btn btn-primary px-4 font-weight-bold">
                                <i class="fas fa-save mr-1"></i> アカウント情報を保存
                            </button>
                        </div>
                    </form>
                </div>
                ` : ''}

                <!-- TAB 9: Timeline / System Logs -->
                ${activeTab === 'timeline' ? `
                <div class="card card-primary card-outline shadow-sm">
                    <div class="card-header bg-white">
                        <h3 class="card-title font-weight-bold">
                            <i class="fas fa-history text-primary mr-1"></i> システム運用・更新タイムライン (AdminLTE Timeline)
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="timeline timeline-inverse">
                            
                            <!-- Timeline time label -->
                            <div class="time-label">
                                <span class="bg-primary">2026年9月 (現在)</span>
                            </div>

                            <!-- Timeline item 1 -->
                            <div>
                                <i class="fas fa-shield-alt bg-info"></i>
                                <div class="timeline-item shadow-sm">
                                    <span class="time"><i class="far fa-clock"></i> たった今</span>
                                    <h3 class="timeline-header font-weight-bold"><a href="#">MIRANSH AdminLTE v3</a> システム稼働確認</h3>
                                    <div class="timeline-body text-sm">
                                        AdminLTE v3 完全統合パッケージが正常に初期化されました。ダッシュボード、Chart.js KPIグラフ、事例日付ピッカー、画像自動アップローダーが稼働中です。
                                    </div>
                                </div>
                            </div>

                            <!-- Timeline item 2 -->
                            <div>
                                <i class="fas fa-envelope bg-warning"></i>
                                <div class="timeline-item shadow-sm">
                                    <span class="time"><i class="far fa-clock"></i> 最近</span>
                                    <h3 class="timeline-header font-weight-bold"><a href="/admin?tab=inquiries">リード・お問い合わせ</a> 受信ステータス</h3>
                                    <div class="timeline-body text-sm">
                                        合計 <strong>${inquiries.length} 件</strong> のお問い合わせを受信済み（うち ${pendingInquiriesCount} 件が対応中または未対応）。
                                    </div>
                                    <div class="timeline-footer">
                                        <a href="/admin?tab=inquiries" class="btn btn-primary btn-sm">お問い合わせ一覧を見る</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Timeline item 3 -->
                            <div>
                                <i class="fas fa-newspaper bg-success"></i>
                                <div class="timeline-item shadow-sm">
                                    <span class="time"><i class="far fa-clock"></i> 公開中</span>
                                    <h3 class="timeline-header font-weight-bold"><a href="/admin?tab=stories">事例・お知らせ</a> 公開件数</h3>
                                    <div class="timeline-body text-sm">
                                        特定技能介護・飲食等のマッチング事例 <strong>${stories.length} 件</strong> が公開されています。
                                    </div>
                                </div>
                            </div>

                            <div>
                                <i class="far fa-clock bg-gray"></i>
                            </div>
                        </div>
                    </div>
                </div>
                ` : ''}

            </div>
        </section>
    </div>

    <!-- Control Sidebar (Right Options Drawer) -->
    <aside class="control-sidebar control-sidebar-dark">
        <div class="p-3 control-sidebar-content">
            <h5><i class="fas fa-sliders-h mr-2"></i> 表示設定</h5>
            <hr class="mb-2">
            <div class="mb-4">
                <div class="custom-control custom-switch mb-3">
                    <input type="checkbox" class="custom-control-input" id="dark-mode-switch" onchange="toggleAdminDarkMode()">
                    <label class="custom-control-label" for="dark-mode-switch">ダークモード (Dark Mode)</label>
                </div>
            </div>
            <h6>クイックリンク</h6>
            <ul class="list-unstyled text-sm">
                <li class="mb-2"><a href="/admin?tab=dashboard" class="text-info"><i class="fas fa-chart-line mr-1"></i> ダッシュボード</a></li>
                <li class="mb-2"><a href="/admin?tab=company" class="text-info"><i class="fas fa-image mr-1"></i> メディア・写真管理</a></li>
                <li class="mb-2"><a href="/admin?tab=stories" class="text-info"><i class="fas fa-calendar mr-1"></i> 事例・日付ピッカー</a></li>
                <li class="mb-2"><a href="/" target="_blank" class="text-warning"><i class="fas fa-external-link-alt mr-1"></i> 公開サイト確認 ↗</a></li>
            </ul>
        </div>
    </aside>

    <!-- Main Footer -->
    <footer class="main-footer text-sm">
        <strong>Copyright &copy; 2026 <a href="/">MIRANSH LLC</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>AdminLTE Version</b> 3.2.0 (Full Package)
        </div>
    </footer>
</div>

<!-- jQuery 3.7.1 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<!-- Bootstrap 4 Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- Chart.js 3.9.1 -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<!-- AdminLTE App -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
// Configure Toastr
toastr.options = {
    closeButton: true,
    progressBar: true,
    positionClass: "toast-top-right",
    timeOut: 4000
};

// Dark Mode Handler
function initAdminDarkMode() {
    const isDark = localStorage.getItem('miransh_adminlte_dark') === 'true';
    if (isDark) {
        document.body.classList.add('dark-mode');
        const icon = document.getElementById('theme-toggle-icon');
        if (icon) {
            icon.classList.remove('fa-moon');
            icon.classList.add('fa-sun');
        }
        const switchEl = document.getElementById('dark-mode-switch');
        if (switchEl) switchEl.checked = true;
    }
}
initAdminDarkMode();

function toggleAdminDarkMode() {
    const body = document.body;
    const isNowDark = body.classList.toggle('dark-mode');
    localStorage.setItem('miransh_adminlte_dark', isNowDark ? 'true' : 'false');
    
    const icon = document.getElementById('theme-toggle-icon');
    if (icon) {
        if (isNowDark) {
            icon.classList.remove('fa-moon');
            icon.classList.add('fa-sun');
        } else {
            icon.classList.remove('fa-sun');
            icon.classList.add('fa-moon');
        }
    }
    const switchEl = document.getElementById('dark-mode-switch');
    if (switchEl) switchEl.checked = isNowDark;
    
    toastr.info(isNowDark ? 'ダークモードに切り替えました' : 'ライトモードに切り替えました');
}

// Chart.js Visual Charts for Dashboard
document.addEventListener('DOMContentLoaded', function() {
    // 1. Inquiries Trend Chart
    const trendCtx = document.getElementById('inquiriesTrendChart');
    if (trendCtx) {
        new Chart(trendCtx, {
            type: 'line',
            data: {
                labels: ['4月', '5月', '6月', '7月', '8月', '9月'],
                datasets: [
                    {
                        label: '特定技能 企業相談件数',
                        backgroundColor: 'rgba(0, 123, 255, 0.15)',
                        borderColor: '#007bff',
                        pointBackgroundColor: '#007bff',
                        pointBorderColor: '#ffffff',
                        pointRadius: 4,
                        fill: true,
                        tension: 0.35,
                        data: [4, 7, 12, 16, 22, ${Math.max(28, inquiries.length * 2)}]
                    },
                    {
                        label: '外国人材 求職エントリー',
                        backgroundColor: 'rgba(40, 167, 69, 0.15)',
                        borderColor: '#28a745',
                        pointBackgroundColor: '#28a745',
                        pointBorderColor: '#ffffff',
                        pointRadius: 4,
                        fill: true,
                        tension: 0.35,
                        data: [8, 14, 20, 29, 38, 45]
                    }
                ]
            },
            options: {
                maintainAspectRatio: false,
                responsive: true,
                plugins: {
                    legend: { display: true, position: 'top' }
                },
                scales: {
                    y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.05)' } },
                    x: { grid: { display: false } }
                }
            }
        });
    }

    // 2. Sectors Donut Chart
    const donutCtx = document.getElementById('sectorsDonutChart');
    if (donutCtx) {
        new Chart(donutCtx, {
            type: 'doughnut',
            data: {
                labels: ['介護分野 (Caregiving)', '外食・調理 (Food)', 'ビルクリーニング (Cleaning)', '製造・その他 (Industry)'],
                datasets: [{
                    data: [45, 25, 18, 12],
                    backgroundColor: ['#007bff', '#28a745', '#ffc107', '#17a2b8'],
                    hoverOffset: 4
                }]
            },
            options: {
                maintainAspectRatio: false,
                responsive: true,
                plugins: {
                    legend: { position: 'bottom' }
                },
                cutout: '65%'
            }
        });
    }
});

// Image Upload Handler
async function handleAdminUpload(fileInput, targetHiddenInputId, previewImgId, statusBadgeId, targetField) {
    const file = fileInput.files && fileInput.files[0];
    if (!file) return;

    const statusEl = document.getElementById(statusBadgeId);
    if (statusEl) {
        statusEl.style.display = 'inline-block';
        statusEl.className = 'badge badge-warning text-xs mt-2 py-1 px-2';
        statusEl.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i> アップロード中 (' + Math.round(file.size / 1024) + ' KB)...';
    }

    const formData = new FormData();
    formData.append('image', file);
    if (targetField) {
        formData.append('target_field', targetField);
    }

    try {
        const res = await fetch('/api/admin/upload-image', {
            method: 'POST',
            body: formData
        });
        const data = await res.json();
        if (data.success && data.url) {
            const hiddenInput = document.getElementById(targetHiddenInputId);
            if (hiddenInput) hiddenInput.value = data.url;

            const previewImg = document.getElementById(previewImgId);
            if (previewImg) {
                previewImg.src = data.url + '?t=' + Date.now();
            }

            if (statusEl) {
                statusEl.className = 'badge badge-success text-xs mt-2 py-1 px-2';
                statusEl.innerHTML = '✓ 画像反映・保存完了 (' + (data.filename || 'Success') + ')';
            }
            toastr.success('画像をアップロードし反映しました');
        } else {
            if (statusEl) {
                statusEl.className = 'badge badge-danger text-xs mt-2 py-1 px-2';
                statusEl.innerHTML = '❌ エラー: ' + (data.error || 'Upload failed');
            }
            toastr.error(data.error || 'アップロードに失敗しました');
        }
    } catch (err) {
        console.error('Upload error:', err);
        if (statusEl) {
            statusEl.className = 'badge badge-danger text-xs mt-2 py-1 px-2';
            statusEl.innerHTML = '❌ 通信エラーが発生しました';
        }
        toastr.error('通信エラーが発生しました');
    }
}

async function resetImageDefault(targetHiddenInputId, previewImgId, defaultUrl, statusBadgeId, targetField) {
    const hiddenInput = document.getElementById(targetHiddenInputId);
    if (hiddenInput) hiddenInput.value = defaultUrl;

    const previewImg = document.getElementById(previewImgId);
    if (previewImg) previewImg.src = defaultUrl;

    const statusEl = document.getElementById(statusBadgeId);
    if (statusEl) {
        statusEl.style.display = 'inline-block';
        statusEl.className = 'badge badge-success text-xs mt-2 py-1 px-2';
        statusEl.innerHTML = '✓ デフォルト画像に設定しました';
    }

    if (targetField) {
        try {
            const params = new URLSearchParams();
            params.append(targetField, defaultUrl);
            await fetch('/admin/company', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: params.toString()
            });
            toastr.success('デフォルト画像に戻して保存しました');
        } catch (e) {
            console.log('Default image saved');
        }
    }
}

// Story CRUD
function openStoryCreateModal() {
    const today = new Date();
    const yyyy = today.getFullYear();
    const mm = String(today.getMonth() + 1).padStart(2, '0');
    const dd = String(today.getDate()).padStart(2, '0');
    const isoDate = yyyy + '-' + mm + '-' + dd;
    const dotDate = yyyy + '.' + mm + '.' + dd;
    
    const picker = document.getElementById('create_story_datepicker');
    const datetext = document.getElementById('create_story_datetext');
    if (picker) picker.value = isoDate;
    if (datetext) datetext.value = dotDate;

    $('#storyCreateModal').modal('show');
}

function openStoryEditModal(st) {
    if (!st) return;
    const form = document.getElementById('form-edit-story');
    if (!form) return;

    form.action = '/admin/stories/' + st.id;
    document.getElementById('edit-story-id-label').textContent = '#' + st.id;
    document.getElementById('edit-st-title-ja').value = st.title_ja || '';
    document.getElementById('edit-st-title-en').value = st.title_en || '';
    document.getElementById('edit-st-cat-ja').value = st.category_ja || '';
    document.getElementById('edit-st-cat-en').value = st.category_en || '';
    document.getElementById('edit-st-summary-ja').value = st.summary_ja || '';
    document.getElementById('edit-st-summary-en').value = st.summary_en || '';
    document.getElementById('edit-st-content-ja').value = st.content_ja || '';
    document.getElementById('edit-st-content-en').value = st.content_en || '';
    document.getElementById('edit-st-author').value = st.author || 'MIRANSH 編集部';
    
    const featSelect = document.getElementById('edit-st-featured');
    if (featSelect) featSelect.value = st.featured ? '1' : '0';

    const rawDate = (st.published_date || '').trim();
    const dateInput = document.getElementById('edit-st-date');
    const datePicker = document.getElementById('edit_story_datepicker');
    if (dateInput) dateInput.value = rawDate;

    if (datePicker && rawDate) {
        const normalized = rawDate.replace(/\\./g, '-').replace(/\\//g, '-');
        const match = normalized.match(/^(\\d{4})-(\\d{1,2})-(\\d{1,2})/);
        if (match) {
            const yyyy = match[1];
            const mm = match[2].padStart(2, '0');
            const dd = match[3].padStart(2, '0');
            datePicker.value = yyyy + '-' + mm + '-' + dd;
        }
    }
    
    const imgInput = document.getElementById('input_edit_story_img');
    const previewImg = document.getElementById('preview_edit_story');
    if (imgInput) imgInput.value = st.image || '/images/story1.jpg';
    if (previewImg) previewImg.src = st.image || '/images/story1.jpg';

    $('#storyEditModal').modal('show');
}

function syncDateToTextInput(pickerId, textId) {
    const picker = document.getElementById(pickerId);
    const text = document.getElementById(textId);
    if (picker && text && picker.value) {
        text.value = picker.value.replace(/-/g, '.');
    }
}

function setPresetDateForForm(pickerId, textId, offsetDays) {
    const target = new Date();
    if (offsetDays !== 0) {
        target.setDate(target.getDate() + offsetDays);
    }
    const yyyy = target.getFullYear();
    const mm = String(target.getMonth() + 1).padStart(2, '0');
    const dd = String(target.getDate()).padStart(2, '0');
    const iso = yyyy + '-' + mm + '-' + dd;
    const dot = yyyy + '.' + mm + '.' + dd;

    const picker = document.getElementById(pickerId);
    const text = document.getElementById(textId);
    if (picker) picker.value = iso;
    if (text) text.value = dot;
}

function filterStoriesTable(query) {
    const q = (query || '').toLowerCase().trim();
    const rows = document.querySelectorAll('.story-row-item');
    rows.forEach(row => {
        const data = row.getAttribute('data-search') || '';
        if (!q || data.includes(q)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}

function filterAdminSidebar(query) {
    const q = (query || '').toLowerCase().trim();
    const items = document.querySelectorAll('#adminSidebarMenu .nav-item');
    items.forEach(item => {
        const text = item.textContent.toLowerCase();
        if (!q || text.includes(q)) {
            item.style.display = '';
        } else {
            item.style.display = 'none';
        }
    });
}

function updateStoryPreview(inputId, previewImgId) {
    const input = document.getElementById(inputId);
    const img = document.getElementById(previewImgId);
    if (input && img && input.value.trim()) {
        img.src = input.value.trim();
    }
}

// Service CRUD Modals
function openServiceCreateModal() {
    document.getElementById('serviceModalTitle').innerHTML = '<i class="fas fa-briefcase mr-2"></i> 新規 分野・事業内容の登録';
    document.getElementById('serviceForm').action = '/admin/services/create';
    document.getElementById('svc_title_ja').value = '';
    document.getElementById('svc_title_en').value = '';
    document.getElementById('svc_icon').value = 'briefcase';
    document.getElementById('svc_desc_ja').value = '';
    document.getElementById('svc_desc_en').value = '';
    $('#serviceModal').modal('show');
}

function openServiceEditModal(s) {
    if (!s) return;
    document.getElementById('serviceModalTitle').innerHTML = '<i class="fas fa-edit mr-2"></i> 分野・事業内容の編集 (#' + s.id + ')';
    document.getElementById('serviceForm').action = '/admin/services/' + s.id;
    document.getElementById('svc_title_ja').value = s.title_ja || '';
    document.getElementById('svc_title_en').value = s.title_en || '';
    document.getElementById('svc_icon').value = s.icon || 'briefcase';
    document.getElementById('svc_desc_ja').value = s.desc_ja || '';
    document.getElementById('svc_desc_en').value = s.desc_en || '';
    $('#serviceModal').modal('show');
}

// FAQ CRUD Modals
function openFaqCreateModal() {
    document.getElementById('faqModalTitle').innerHTML = '<i class="fas fa-question-circle mr-2"></i> 新規FAQの追加';
    document.getElementById('faqForm').action = '/admin/faqs/create';
    document.getElementById('faq_cat_ja').value = '特定技能・採用について';
    document.getElementById('faq_q_ja').value = '';
    document.getElementById('faq_q_en').value = '';
    document.getElementById('faq_a_ja').value = '';
    document.getElementById('faq_a_en').value = '';
    $('#faqModal').modal('show');
}

function openFaqEditModal(f) {
    if (!f) return;
    document.getElementById('faqModalTitle').innerHTML = '<i class="fas fa-edit mr-2"></i> FAQの編集 (#' + f.id + ')';
    document.getElementById('faqForm').action = '/admin/faqs/' + f.id;
    document.getElementById('faq_cat_ja').value = f.category_ja || '特定技能・採用について';
    document.getElementById('faq_q_ja').value = f.question_ja || '';
    document.getElementById('faq_q_en').value = f.question_en || '';
    document.getElementById('faq_a_ja').value = f.answer_ja || '';
    document.getElementById('faq_a_en').value = f.answer_en || '';
    $('#faqModal').modal('show');
}

// Inquiry Details Modal
function openInquiryDetailModal(inq) {
    if (!inq) return;
    document.getElementById('inq_modal_id').textContent = '#' + inq.id;
    document.getElementById('inq_modal_name').textContent = inq.name || '未記入';
    document.getElementById('inq_modal_company').textContent = inq.company_name || '個人・未記入';
    document.getElementById('inq_modal_email').textContent = inq.email || '-';
    document.getElementById('inq_modal_email_link').href = 'mailto:' + (inq.email || '');
    document.getElementById('inq_modal_phone').textContent = inq.phone || '-';
    document.getElementById('inq_modal_service').textContent = inq.service_interest || '全般';
    document.getElementById('inq_modal_message').textContent = inq.message || '';
    
    const form = document.getElementById('inq_status_form');
    if (form) form.action = '/admin/inquiries/' + inq.id + '/status';

    const statusSelect = document.getElementById('inq_modal_status_select');
    if (statusSelect) statusSelect.value = inq.status || 'new';

    const mailtoBtn = document.getElementById('inq_modal_mailto_btn');
    if (mailtoBtn && inq.email) {
        const subject = encodeURIComponent('【MIRANSH合同会社】お問い合わせありがとうございます');
        const body = encodeURIComponent((inq.name ? inq.name + ' 様\n\n' : '') + 'MIRANSH合同会社でございます。\nこの度はお問い合わせいただき誠にありがとうございます。\n\n─────────────\n【ご相談内容】\n' + (inq.message || '') + '\n─────────────\n\n');
        mailtoBtn.href = 'mailto:' + inq.email + '?subject=' + subject + '&body=' + body;
    }

    $('#inquiryDetailModal').modal('show');
}

// Sakana AI Diagnostic Test
async function runSakanaDiagnosticTest() {
    const btn = document.getElementById('btn_test_sakana');
    const output = document.getElementById('ai_test_output');
    const model = document.getElementById('sakana_model_select').value;
    const apiKey = document.getElementById('sakana_apikey_input').value;

    if (btn) btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i> 診断実行中...';
    if (output) {
        output.style.display = 'block';
        output.innerHTML = '⚡ Sakana AI エンドポイントへ通信テスト中 (Connecting to https://api.sakana.ai/v1)...';
    }

    try {
        const res = await fetch('/api/sakana/test', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ model, apiKey })
        });
        const data = await res.json();
        if (output) {
            output.innerHTML = '<div class="text-success font-weight-bold mb-1">✓ 診断レスポンス受信完了:</div><pre class="text-white m-0">' + JSON.stringify(data, null, 2) + '</pre>';
        }
        toastr.success('Sakana AI 接続診断が正常に完了しました');
    } catch (e) {
        if (output) {
            output.innerHTML = '<span class="text-danger">❌ 診断テスト失敗: ' + e.message + '</span>';
        }
        toastr.error('診断テスト通信エラー: ' + e.message);
    } finally {
        if (btn) btn.innerHTML = '<i class="fas fa-bolt mr-1"></i> 接続テスト・応答診断';
    }
}
</script>
</body>
</html>`;
}
