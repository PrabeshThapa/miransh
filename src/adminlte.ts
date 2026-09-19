// AdminLTE 3 Modular Layout Engine for MIRANSH Management Portal
import { i18n, AdminLang } from './admin/i18n';

export function escapeHtml(str: any): string {
  if (str === null || str === undefined) return '';
  return String(str)
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;')
    .replace(/'/g, '&#039;');
}

export function renderAdminLTELogin(errorMsg?: string, successMsg?: string, lang: AdminLang = 'ja'): string {
  const t = i18n[lang];

  return `<!DOCTYPE html>
<html lang="${lang}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MIRANSH LLC | ${t.login.title}</title>
  <link rel="icon" type="image/png" href="/images/logo-icon.png">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
  <style>
    body.login-page {
      background: linear-gradient(135deg, #0F172A 0%, #1E3A8A 50%, #0F172A 100%);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Source Sans Pro', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    }
    .login-box {
      width: 420px;
      max-width: 92vw;
    }
    .card-outline.card-primary {
      border-top: 4px solid #2563EB;
      border-radius: 12px;
      box-shadow: 0 20px 40px rgba(0,0,0,0.35);
      overflow: hidden;
    }
    .brand-logo-wrap {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 12px;
      margin-bottom: 8px;
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
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo text-white">
    <a href="/" class="text-white text-decoration-none">
      <div class="brand-logo-wrap">
        <img src="/images/logo-icon.png" alt="MIRANSH" style="height: 48px; width: 48px; background: white; border-radius: 50%; padding: 4px;">
        <span class="font-weight-bold">MIRANSH</span>
      </div>
      <span class="text-sm font-weight-light text-light">${t.login.subTitle}</span>
    </a>
  </div>
  
  <div class="card card-outline card-primary">
    <div class="card-body login-card-body p-4">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <p class="login-box-msg font-weight-bold text-dark m-0 p-0">${t.login.title}</p>
        <div class="lang-toggle-group shadow-xs" role="group" aria-label="Language Switcher">
          <button type="button" class="lang-btn ${lang === 'ja' ? 'active' : ''}" onclick="switchAdminLanguage('ja', event)" title="日本語 (Japanese / NP)">
            日本語
          </button>
          <button type="button" class="lang-btn ${lang === 'en' ? 'active' : ''}" onclick="switchAdminLanguage('en', event)" title="English (EN)">
            EN
          </button>
        </div>
      </div>

      ${errorMsg ? `
      <div class="alert alert-danger alert-dismissible fade show text-sm py-2 mb-3" role="alert">
        <i class="fas fa-exclamation-circle mr-1"></i> ${escapeHtml(errorMsg)}
        <button type="button" class="close py-2" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>` : ''}

      ${successMsg ? `
      <div class="alert alert-success alert-dismissible fade show text-sm py-2 mb-3" role="alert">
        <i class="fas fa-check-circle mr-1"></i> ${escapeHtml(successMsg)}
        <button type="button" class="close py-2" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>` : ''}

      <form action="/admin/login${lang === 'en' ? '?lang=en' : ''}" method="post">
        <div class="input-group mb-3">
          <input type="text" name="email" class="form-control" placeholder="${t.login.emailPlaceholder}" value="" required autofocus>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="${t.login.passwordPlaceholder}" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        
        <!-- Default credentials hidden per user preference -->
        <!--
        <div class="callout callout-info py-2 px-3 mb-3 bg-light text-xs text-muted">
          <div class="font-weight-bold text-dark mb-1"><i class="fas fa-info-circle mr-1 text-info"></i>${t.login.demoNoticeTitle}</div>
          <div>${t.login.demoNoticeId}</div>
          <div>${t.login.demoNoticePw}</div>
        </div>
        -->

        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block font-weight-bold shadow-sm py-2">
              <i class="fas fa-sign-in-alt mr-1"></i> ${t.login.submitBtn}
            </button>
          </div>
        </div>
      </form>

      <div class="text-center mt-3 pt-2 border-top">
        <a href="/" class="text-secondary text-sm text-decoration-none">
          <i class="fas fa-arrow-left mr-1"></i> ${t.login.backToSite}
        </a>
      </div>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<script>
function switchAdminLanguage(newLang, e) {
  if (e) { e.preventDefault(); e.stopPropagation(); }
  try {
    localStorage.setItem('admin_lang', newLang);
    localStorage.setItem('miransh_language', newLang);
    sessionStorage.setItem('admin_lang', newLang);
    document.cookie = 'admin_lang=' + newLang + '; path=/; max-age=31536000; SameSite=None; Secure';
    document.cookie = 'admin_lang=' + newLang + '; path=/; max-age=31536000; SameSite=Lax';
  } catch(err) {}

  var currentUrl = new URL(window.location.href);
  currentUrl.searchParams.set('lang', newLang);
  var targetHref = currentUrl.toString();

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

// Initial check on load for sticky language on login page
(function() {
  try {
    var stored = localStorage.getItem('admin_lang') || localStorage.getItem('miransh_language');
    if (stored && (stored === 'en' || stored === 'ja')) {
      var u = new URL(window.location.href);
      if (!u.searchParams.has('lang') && stored !== '${lang}') {
        u.searchParams.set('lang', stored);
        window.location.replace(u.toString());
      }
    }
  } catch(e) {}
})();
</script>
</body>
</html>`;
}

interface LayoutOptions {
  pageTitle: string;
  activePage: 'dashboard' | 'company' | 'about' | 'services' | 'stories' | 'faqs' | 'inquiries' | 'password' | 'ai';
  lang?: AdminLang;
  unreadCount?: number;
  company?: any;
  user?: any;
  bodyContent: string;
  modalsContent?: string;
  extraScripts?: string;
  flash?: { type: 'success' | 'danger' | 'info' | 'warning'; message: string };
}

export function renderAdminLTELayout(opts: LayoutOptions): string {
  const {
    pageTitle,
    activePage,
    lang = 'ja',
    unreadCount = 0,
    company = {},
    user = { name: 'admin', email: 'admin@miransh.jp' },
    bodyContent,
    modalsContent = '',
    extraScripts = '',
    flash
  } = opts;

  const t = i18n[lang];
  const ceoImg = company.ceo_image || '/images/ceo_portrait.jpg';
  const userName = user?.name || (lang === 'en' ? (company?.ceo_name_en || 'Admin') : (company?.ceo_name_ja || '管理者'));
  const langSuffix = '?lang=' + lang;

  const menuItems = [
    { id: 'dashboard', href: `/admin${langSuffix}`, icon: 'fas fa-tachometer-alt', label: t.nav.dashboard, badge: '' },
    { id: 'company', href: `/admin/company${langSuffix}`, icon: 'fas fa-building', label: t.nav.company, badge: '' },
    { id: 'about', href: `/admin/about${langSuffix}`, icon: 'fas fa-award', label: t.nav.about, badge: '' },
    { id: 'services', href: `/admin/services${langSuffix}`, icon: 'fas fa-concierge-bell', label: t.nav.services, badge: '' },
    { id: 'vacancies', href: `/admin/vacancies${langSuffix}`, icon: 'fas fa-user-tie', label: t.nav.vacancies, badge: '' },
    { id: 'stories', href: `/admin/stories${langSuffix}`, icon: 'fas fa-book-open', label: t.nav.stories, badge: '' },
    { id: 'faqs', href: `/admin/faqs${langSuffix}`, icon: 'fas fa-question-circle', label: t.nav.faqs, badge: '' },
    { id: 'inquiries', href: `/admin/inquiries${langSuffix}`, icon: 'fas fa-envelope', label: t.nav.inquiries, badge: unreadCount > 0 ? `<span class="badge badge-warning right font-weight-bold">${unreadCount}</span>` : '' },
    { id: 'password', href: `/admin/password${langSuffix}`, icon: 'fas fa-key', label: t.nav.password, badge: '<span class="badge badge-light right"><i class="fas fa-shield-alt text-primary"></i></span>' },
    { id: 'ai', href: `/admin/ai${langSuffix}`, icon: 'fas fa-robot', label: t.nav.ai, badge: '<span class="badge badge-info right">AI</span>' },
  ];

  const sidebarNavHtml = menuItems.map(item => {
    const isActive = activePage === item.id;
    return `
      <li class="nav-item">
        <a href="${item.href}" class="nav-link ${isActive ? 'active' : ''}">
          <i class="nav-icon ${item.icon}"></i>
          <p>
            ${item.label}
            ${item.badge}
          </p>
        </a>
      </li>
    `;
  }).join('');

  return `<!DOCTYPE html>
<html lang="${lang}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MIRANSH LLC | ${escapeHtml(pageTitle)} - AdminLTE 3</title>
  <link rel="icon" type="image/png" href="/images/logo-icon.png">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
  <style>
    .brand-link .brand-image {
      float: left;
      line-height: .8;
      margin-left: .8rem;
      margin-right: .5rem;
      margin-top: -3px;
      max-height: 33px;
      width: auto;
    }
    .user-panel .image img {
      width: 2.1rem;
      height: 2.1rem;
      object-fit: cover;
    }
    .drop-zone {
      border: 2px dashed #94A3B8;
      border-radius: 8px;
      padding: 16px;
      text-align: center;
      background: #F8FAFC;
      transition: all 0.2s ease;
      cursor: pointer;
    }
    .drop-zone:hover, .drop-zone.dragover {
      background: #EFF6FF;
      border-color: #2563EB;
    }
    .preview-thumb {
      max-width: 100%;
      height: 140px;
      object-fit: cover;
      border-radius: 6px;
      border: 1px solid #CBD5E1;
      background: #fff;
    }
    .table td, .table th {
      vertical-align: middle;
    }
    .lang-badge {
      font-size: 0.72rem;
      letter-spacing: 0.05em;
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
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed text-sm">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/" target="_blank" class="btn btn-outline-primary btn-sm ml-2 font-weight-bold">
          <i class="fas fa-external-link-alt mr-1"></i> ${t.viewPublicSite}
        </a>
      </li>
      <li class="nav-item d-none d-md-inline-block">
        <a href="/admin/password${langSuffix}" class="btn btn-outline-secondary btn-sm ml-2">
          <i class="fas fa-key mr-1"></i> ${t.changePassword}
        </a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto align-items-center">
      <!-- Language Switcher Component (Exact Frontend Design & Function) -->
      <li class="nav-item d-flex align-items-center mr-3" id="admin-lang-switcher-component">
        <div class="lang-toggle-group" id="admin-lang-toggle" role="group" aria-label="Language Switcher">
          <button type="button"
                  id="btn-lang-ja"
                  class="lang-btn ${lang === 'ja' ? 'active' : ''}"
                  onclick="switchAdminLanguage('ja', event)"
                  title="日本語 (Japanese / NP)"
                  aria-pressed="${lang === 'ja'}">
            日本語
          </button>
          <button type="button"
                  id="btn-lang-en"
                  class="lang-btn ${lang === 'en' ? 'active' : ''}"
                  onclick="switchAdminLanguage('en', event)"
                  title="English (EN)"
                  aria-pressed="${lang === 'en'}">
            EN
          </button>
        </div>
      </li>

      <!-- Inquiries Notification Badge -->
      <li class="nav-item">
        <a class="nav-link" href="/admin/inquiries${langSuffix}" title="${t.unreadTooltip}">
          <i class="far fa-comments"></i>
          ${unreadCount > 0 ? `<span class="badge badge-danger navbar-badge">${unreadCount}</span>` : ''}
        </a>
      </li>

      <!-- Fullscreen -->
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button" title="${t.fullscreen}">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>

      <!-- User Menu -->
      <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
          <img src="${escapeHtml(ceoImg)}" class="user-image img-circle elevation-1" alt="User Image">
          <span class="d-none d-md-inline font-weight-bold text-dark">${escapeHtml(userName)}</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right shadow-sm">
          <li class="user-header bg-primary text-white">
            <img src="${escapeHtml(ceoImg)}" class="img-circle elevation-2" alt="User Image">
            <p>
              ${escapeHtml(userName)} - <small class="text-white-50">${t.adminRole}</small>
              <small>${escapeHtml(user.email || 'admin@miransh.jp')}</small>
            </p>
          </li>
          <li class="user-footer d-flex justify-content-between">
            <a href="/admin/password${langSuffix}" class="btn btn-default btn-flat text-xs"><i class="fas fa-lock mr-1"></i>${t.changePassword}</a>
            <a href="/admin/logout" class="btn btn-outline-danger btn-flat text-xs font-weight-bold"><i class="fas fa-sign-out-alt mr-1"></i>${t.logout}</a>
          </li>
        </ul>
      </li>
    </ul>
  </nav>

  <!-- Sidebar -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="/admin${langSuffix}" class="brand-link bg-primary text-white">
      <img src="/images/logo-icon.png" alt="MIRANSH Logo" class="brand-image img-circle elevation-2" style="background: #fff; padding: 2px;">
      <span class="brand-text font-weight-bold">MIRANSH Admin</span>
    </a>

    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
        <div class="image">
          <img src="${escapeHtml(ceoImg)}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="/admin/company${langSuffix}" class="d-block font-weight-bold text-white">${escapeHtml(userName)}</a>
          <small class="text-success"><i class="fas fa-circle text-xs mr-1"></i>Online (${t.adminRole})</small>
        </div>
      </div>

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
          ${sidebarNavHtml}
        </ul>
      </nav>
    </div>
  </aside>

  <!-- Content Wrapper -->
  <div class="content-wrapper">
    <div class="content-header bg-white border-bottom mb-3 py-2">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="col-sm-6">
            <h4 class="m-0 font-weight-bold text-dark d-flex align-items-center">
              <span>${escapeHtml(pageTitle)}</span>
              <span class="badge badge-light border text-xs text-muted ml-2 font-weight-normal lang-badge">
                <i class="fas fa-globe-asia mr-1"></i>${t.langName}
              </span>
            </h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right mb-0 text-xs">
              <li class="breadcrumb-item"><a href="/admin${langSuffix}">${t.home}</a></li>
              <li class="breadcrumb-item active">${escapeHtml(pageTitle)}</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        ${flash ? `
        <div class="alert alert-${flash.type} alert-dismissible fade show shadow-sm mb-3" role="alert">
          <i class="fas fa-${flash.type === 'success' ? 'check-circle' : flash.type === 'danger' ? 'exclamation-circle' : 'info-circle'} mr-2"></i>
          ${escapeHtml(flash.message)}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>` : ''}

        ${bodyContent}
      </div>
    </section>
  </div>

  <!-- Modals Container -->
  ${modalsContent}

  <!-- Footer -->
  <footer class="main-footer text-xs">
    <strong>Copyright &copy; 2026 <a href="/">MIRANSH LLC</a>.</strong> All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>AdminLTE</b> v3.2.0 | Bilingual Enterprise Portal (JA / EN)
    </div>
  </footer>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<script>
function switchAdminLanguage(newLang, e) {
  if (e) {
    e.preventDefault();
    e.stopPropagation();
  }

  // Visual button state update immediately for instantaneous feedback
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

  // 1. Persist in storage and cookies
  try {
    localStorage.setItem('admin_lang', newLang);
    localStorage.setItem('miransh_language', newLang);
    sessionStorage.setItem('admin_lang', newLang);
    document.cookie = 'admin_lang=' + newLang + '; path=/; max-age=31536000; SameSite=None; Secure';
    document.cookie = 'admin_lang=' + newLang + '; path=/; max-age=31536000; SameSite=Lax';
  } catch(err) {}

  // 2. Compute exact destination URL preserving pathname, query parameters, and hash
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

  // Dispatch client-side event for reactive widgets
  try {
    window.dispatchEvent(new CustomEvent('adminLanguageChanged', { detail: { lang: newLang } }));
  } catch(err) {}

  // 3. Background session synchronization without unmounting session
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
  var currentLang = '${lang}';

  // Check on load if local storage has a chosen language and URL has no lang parameter
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

  // Intercept any clicks on internal admin links to ensure lang param is not lost
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

  // Intercept form submissions to ensure lang param and hidden field are preserved
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
${extraScripts}
</body>
</html>`;
}
