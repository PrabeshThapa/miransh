<!DOCTYPE html>
<html lang="{{ $currentLang ?? 'ja' }}" data-admin-lang="{{ $currentLang ?? 'ja' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'MIRANSH AdminLTE | Management Portal (日英切替対応)')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-icon.png') }}">

    {{-- =========================================
         BASE FONTS & ICONS
    ========================================== --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,600,700&display=fallback">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    {{-- =========================================
         VENDOR CSS (Ordered to prevent collisions)
    ========================================== --}}
    <!-- DataTables Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css">
    <!-- Toastr & SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- AdminLTE 3.2.0 Core CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">

    {{-- =========================================
         CORPORATE BLUE THEME & GLOBAL ADMIN STYLES
    ========================================== --}}
    <style>
        :root {
            --brand-navy-dark: #0A1E3F;
            --brand-navy: #0F2C59;
            --brand-navy-light: #1E3E7B;
            --brand-blue: #2563EB;
            --brand-blue-hover: #1D4ED8;
            --brand-blue-light: #DBEAFE;
            --brand-blue-subtle: #EFF6FF;
            --brand-gold: #D97706;
            --brand-emerald: #059669;
            --brand-slate-bg: #F8FAFC;
            --brand-border: #E2E8F0;
        }
        body {
            font-family: "Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background-color: var(--brand-slate-bg);
            color: #1E293B;
        }

        /* Top Navbar */
        .main-header.navbar {
            background-color: #FFFFFF !important;
            border-bottom: 1px solid var(--brand-border) !important;
            box-shadow: 0 1px 3px rgba(15, 44, 89, 0.05) !important;
        }
        .main-header.navbar .nav-link {
            color: #475569 !important;
            font-weight: 500;
            transition: all 0.2s ease;
        }
        .main-header.navbar .nav-link:hover {
            color: var(--brand-blue) !important;
        }
        .main-header.navbar .nav-link.active,
        .main-header.navbar .nav-link.text-primary {
            color: var(--brand-blue) !important;
            font-weight: 700;
        }

        /* Sidebar Styling - Deep Navy & Royal Blue Accents */
        .main-sidebar {
            background: linear-gradient(180deg, #0A1E3F 0%, #0F2C59 100%) !important;
            border-right: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 2px 0 16px rgba(10, 30, 63, 0.15);
        }
        .brand-link {
            background: linear-gradient(135deg, #0A1E3F 0%, #1E3E7B 100%) !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.12) !important;
            padding: 0.9rem 1rem !important;
            display: flex;
            align-items: center;
        }
        .brand-link .brand-text {
            color: #FFFFFF !important;
            letter-spacing: 0.05em;
            font-size: 1.15rem;
        }

        .sidebar .user-panel {
            border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
            background: rgba(255, 255, 255, 0.04);
            border-radius: 8px;
            padding: 10px;
            margin: 12px 10px 16px 10px !important;
        }
        .sidebar .user-panel .info a {
            color: #FFFFFF !important;
            font-weight: 600;
            font-size: 0.95rem;
        }

        /* Sidebar Navigation Items */
        .sidebar .nav-header {
            color: #94A3B8 !important;
            font-size: 11px !important;
            font-weight: 700 !important;
            letter-spacing: 0.06em;
            padding: 12px 16px 4px 16px !important;
        }
        .sidebar .nav-link {
            color: #CBD5E1 !important;
            border-radius: 8px !important;
            margin: 2px 10px !important;
            padding: 9px 14px !important;
            font-size: 0.92rem;
            font-weight: 500;
            transition: all 0.2s ease-in-out;
        }
        .sidebar .nav-link:hover {
            background: rgba(255, 255, 255, 0.08) !important;
            color: #FFFFFF !important;
            transform: translateX(2px);
        }
        .sidebar .nav-link.active,
        .sidebar .nav-pills .nav-link.active {
            background: linear-gradient(135deg, #2563EB 0%, #1D4ED8 100%) !important;
            color: #FFFFFF !important;
            font-weight: 700 !important;
            box-shadow: 0 4px 14px rgba(37, 99, 235, 0.4) !important;
            transform: translateX(3px);
        }
        .sidebar .nav-link .nav-icon {
            font-size: 1rem;
            margin-right: 10px;
            width: 20px;
            text-align: center;
            color: #94A3B8;
        }
        .sidebar .nav-link.active .nav-icon {
            color: #FFFFFF !important;
        }

        /* Primary Cards & Overrides */
        .card-primary.card-outline {
            border-top: 3px solid var(--brand-blue) !important;
            border-radius: 12px;
            border-left: 1px solid var(--brand-border);
            border-right: 1px solid var(--brand-border);
            border-bottom: 1px solid var(--brand-border);
            box-shadow: 0 4px 12px -2px rgba(15, 44, 89, 0.05) !important;
        }
        .card-info.card-outline {
            border-top: 3px solid #0EA5E9 !important;
            border-radius: 12px;
            border-left: 1px solid var(--brand-border);
            border-right: 1px solid var(--brand-border);
            border-bottom: 1px solid var(--brand-border);
            box-shadow: 0 4px 12px -2px rgba(15, 44, 89, 0.05) !important;
        }
        .card-success.card-outline {
            border-top: 3px solid var(--brand-emerald) !important;
            border-radius: 12px;
            border-left: 1px solid var(--brand-border);
            border-right: 1px solid var(--brand-border);
            border-bottom: 1px solid var(--brand-border);
            box-shadow: 0 4px 12px -2px rgba(15, 44, 89, 0.05) !important;
        }
        .card {
            border-radius: 12px;
            border: 1px solid var(--brand-border);
            box-shadow: 0 2px 8px rgba(15, 44, 89, 0.04);
            margin-bottom: 1.5rem;
        }
        .card-header {
            background-color: #FFFFFF;
            border-bottom: 1px solid var(--brand-border);
            padding: 1rem 1.25rem;
            border-top-left-radius: 12px !important;
            border-top-right-radius: 12px !important;
        }
        .card-title {
            color: var(--brand-navy) !important;
            font-size: 1.05rem;
            font-weight: 700 !important;
        }

        /* Primary Buttons */
        .btn-primary {
            background: linear-gradient(135deg, #2563EB 0%, #1D4ED8 100%) !important;
            border-color: #1D4ED8 !important;
            box-shadow: 0 2px 6px rgba(37, 99, 235, 0.3) !important;
            border-radius: 6px;
            font-weight: 600;
        }
        .btn-primary:hover, .btn-primary:focus {
            background: linear-gradient(135deg, #1D4ED8 0%, #1E40AF 100%) !important;
            border-color: #1E40AF !important;
            box-shadow: 0 4px 10px rgba(37, 99, 235, 0.4) !important;
        }
        .btn-outline-primary {
            color: var(--brand-blue) !important;
            border-color: var(--brand-blue) !important;
            border-radius: 6px;
            font-weight: 600;
        }
        .btn-outline-primary:hover {
            background-color: var(--brand-blue) !important;
            color: #FFFFFF !important;
        }

        /* KPI Small Boxes in Blue Gradient Theme */
        .small-box {
            border-radius: 12px !important;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(15, 44, 89, 0.08) !important;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .small-box:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(15, 44, 89, 0.14) !important;
        }
        .small-box.bg-info {
            background: linear-gradient(135deg, #0F2C59 0%, #1E3E7B 100%) !important;
        }
        .small-box.bg-primary {
            background: linear-gradient(135deg, #2563EB 0%, #3B82F6 100%) !important;
        }
        .small-box.bg-warning {
            background: linear-gradient(135deg, #D97706 0%, #F59E0B 100%) !important;
        }
        .small-box.bg-success {
            background: linear-gradient(135deg, #059669 0%, #10B981 100%) !important;
        }
        .small-box.bg-danger {
            background: linear-gradient(135deg, #DC2626 0%, #EF4444 100%) !important;
        }
        .small-box .inner h3 {
            font-weight: 800;
            font-size: 2.2rem;
            color: #FFFFFF;
        }
        .small-box .inner p {
            font-size: 0.95rem;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.92);
        }
        .small-box-footer {
            background: rgba(0, 0, 0, 0.15) !important;
            color: rgba(255, 255, 255, 0.95) !important;
            font-weight: 600;
            padding: 6px 0;
        }

        /* Bilingual Display Engine (Supports both .admin-lang-* and .lang-*) */
        html[data-admin-lang="ja"] .admin-lang-en,
        html[data-admin-lang="ja"] .lang-en {
            display: none !important;
        }
        html[data-admin-lang="ja"] .admin-lang-ja,
        html[data-admin-lang="ja"] .lang-ja {
            display: inline !important;
        }
        html[data-admin-lang="ja"] div.admin-lang-ja,
        html[data-admin-lang="ja"] div.lang-ja,
        html[data-admin-lang="ja"] p.admin-lang-ja,
        html[data-admin-lang="ja"] p.lang-ja {
            display: block !important;
        }

        html[data-admin-lang="en"] .admin-lang-ja,
        html[data-admin-lang="en"] .lang-ja {
            display: none !important;
        }
        html[data-admin-lang="en"] .admin-lang-en,
        html[data-admin-lang="en"] .lang-en {
            display: inline !important;
        }
        html[data-admin-lang="en"] div.admin-lang-en,
        html[data-admin-lang="en"] div.lang-en,
        html[data-admin-lang="en"] p.admin-lang-en,
        html[data-admin-lang="en"] p.lang-en {
            display: block !important;
        }

        .lang-switch-btn {
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .preview-img-box {
            border: 2px dashed var(--brand-border);
            border-radius: 8px;
            padding: 10px;
            text-align: center;
            background: #FFFFFF;
            transition: all 0.2s ease;
        }
        .preview-img-box:hover {
            border-color: var(--brand-blue);
        }
        .preview-img-box img {
            max-height: 140px;
            max-width: 100%;
            object-fit: cover;
            border-radius: 6px;
        }
        .form-section-title {
            border-bottom: 2px solid var(--brand-blue-light);
            padding-bottom: 8px;
            margin-bottom: 16px;
            font-weight: 700;
            color: var(--brand-navy);
            display: flex;
            align-items: center;
        }
        .form-section-title i {
            margin-right: 8px;
            color: var(--brand-blue);
        }
        .table-middle td, .table-middle th {
            vertical-align: middle !important;
        }
        .cursor-pointer {
            cursor: pointer;
        }
        .timeline-inverse .time-label > span {
            font-weight: 700;
            padding: 5px 12px;
        }
        .status-badge {
            font-size: 0.85rem;
            padding: 4px 10px;
            border-radius: 20px;
            transition: all 0.2s ease;
        }

        /* Modal Headers with Blue Navy Gradient */
        .modal-header {
            background: linear-gradient(135deg, #0F2C59 0%, #1E3E7B 100%) !important;
            color: #FFFFFF !important;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }
        .modal-header .modal-title,
        .modal-header h4,
        .modal-header h5 {
            color: #FFFFFF !important;
            font-weight: 700;
        }
        .modal-header .close {
            color: #FFFFFF !important;
            text-shadow: none;
            opacity: 0.85;
        }
        .modal-header .close:hover {
            opacity: 1;
        }
        .modal-content {
            border-radius: 12px;
            border: none;
            box-shadow: 0 20px 25px -5px rgba(15, 44, 89, 0.2), 0 10px 10px -5px rgba(15, 44, 89, 0.1);
        }

        /* Dark mode tweaks */
        body.dark-mode {
            background-color: #0B132B !important;
            color: #E2E8F0 !important;
        }
        body.dark-mode .content-wrapper {
            background-color: #0B132B !important;
        }
        body.dark-mode .card {
            background-color: #1C2541 !important;
            border-color: #3A506B !important;
        }
        body.dark-mode .card-header {
            background-color: #1C2541 !important;
            border-color: #3A506B !important;
        }
        body.dark-mode .card-title {
            color: #FFFFFF !important;
        }
        body.dark-mode .main-header.navbar {
            background-color: #1C2541 !important;
            border-color: #3A506B !important;
        }
        body.dark-mode .main-header.navbar .nav-link {
            color: #CBD5E1 !important;
        }
        body.dark-mode .preview-img-box {
            border-color: #4b545c;
            background: #1C2541;
        }
    </style>

    {{-- =========================================
         PAGE-SPECIFIC STYLES STACK
    ========================================== --}}
    @stack('styles')
    @stack('head')
</head>

<body class="@yield('body_class', 'hold-transition sidebar-mini layout-fixed')">
@hasSection('no_wrapper')
    @yield('content')
@else
    @if(str_contains($__env->yieldContent('body_class'), 'login-page'))
        @yield('content')
    @else
        <div class="wrapper">
            @yield('content')
        </div>
    @endif
@endif

{{-- =========================================
     VENDOR SCRIPTS (Strictly ordered to prevent dependency collisions)
========================================== --}}
<!-- 1. jQuery Core (Must load before any plugins) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<!-- 2. Bootstrap 4 Bundle (Includes Popper.js) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- 3. DataTables Core & Bootstrap 4 Integration -->
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap4.min.js"></script>

<!-- 4. AdminLTE 3.2.0 Core JS -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

<!-- 5. Chart.js & Notification Libraries -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

{{-- =========================================
     PAGE-SPECIFIC SCRIPTS STACK
========================================== --}}
@stack('scripts')

</body>
</html>
