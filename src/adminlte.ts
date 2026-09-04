// AdminLTE 3 Modular Layout Engine for MIRANSH Management Portal
export function escapeHtml(str: any): string {
  if (str === null || str === undefined) return '';
  return String(str)
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;')
    .replace(/'/g, '&#039;');
}

export function renderAdminLTELogin(errorMsg?: string, successMsg?: string): string {
  return `<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MIRANSH LLC | 管理者ログイン (Admin Login)</title>
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
      <span class="text-sm font-weight-light text-light">Global Talent Management Portal</span>
    </a>
  </div>
  <div class="card card-outline card-primary">
    <div class="card-body login-card-body p-4">
      <p class="login-box-msg font-weight-bold text-dark mb-3">管理者ポータル ログイン</p>

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

      <form action="/admin/login" method="post">
        <div class="input-group mb-3">
          <input type="text" name="email" class="form-control" placeholder="ユーザー名またはメールアドレス" value="admin@miransh.jp" required autofocus>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="パスワード" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        
        <div class="callout callout-info py-2 px-3 mb-3 bg-light text-xs text-muted">
          <div class="font-weight-bold text-dark mb-1"><i class="fas fa-info-circle mr-1 text-info"></i>初期管理者アカウント:</div>
          <div>ID: <code>admin@miransh.jp</code> または <code>admin</code></div>
          <div>PW: <code>admin123</code> (ログイン後にパスワード変更可能です)</div>
        </div>

        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block font-weight-bold shadow-sm py-2">
              <i class="fas fa-sign-in-alt mr-1"></i> ログインする (Sign In)
            </button>
          </div>
        </div>
      </form>

      <div class="text-center mt-3 pt-2 border-top">
        <a href="/" class="text-secondary text-sm text-decoration-none">
          <i class="fas fa-arrow-left mr-1"></i> 公開Webサイトに戻る
        </a>
      </div>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>
</html>`;
}

interface LayoutOptions {
  pageTitle: string;
  activePage: 'dashboard' | 'company' | 'about' | 'services' | 'stories' | 'faqs' | 'inquiries' | 'password' | 'ai';
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
    unreadCount = 0,
    company = {},
    user = { name: 'admin', email: 'admin@miransh.jp' },
    bodyContent,
    modalsContent = '',
    extraScripts = '',
    flash
  } = opts;

  const ceoImg = company.ceo_image || '/images/ceo_portrait.jpg';
  const userName = user?.name || company?.ceo_name_ja || 'Admin';

  const menuItems = [
    { id: 'dashboard', href: '/admin', icon: 'fas fa-tachometer-alt', label: 'ダッシュボード概要', badge: '' },
    { id: 'company', href: '/admin/company', icon: 'fas fa-building', label: '会社情報・画像設定', badge: '' },
    { id: 'about', href: '/admin/about', icon: 'fas fa-award', label: '企業理念・メッセージ', badge: '' },
    { id: 'services', href: '/admin/services', icon: 'fas fa-concierge-bell', label: '提供サービス管理', badge: '' },
    { id: 'stories', href: '/admin/stories', icon: 'fas fa-book-open', label: '採用事例・実績管理', badge: '' },
    { id: 'faqs', href: '/admin/faqs', icon: 'fas fa-question-circle', label: 'よくある質問管理', badge: '' },
    { id: 'inquiries', href: '/admin/inquiries', icon: 'fas fa-envelope', label: 'お問い合わせ管理', badge: unreadCount > 0 ? `<span class="badge badge-warning right font-weight-bold">${unreadCount}</span>` : '' },
    { id: 'password', href: '/admin/password', icon: 'fas fa-key', label: 'パスワード変更', badge: '<span class="badge badge-light right"><i class="fas fa-shield-alt text-primary"></i></span>' },
    { id: 'ai', href: '/admin/ai', icon: 'fas fa-robot', label: 'Sakana AI 設定', badge: '<span class="badge badge-info right">AI</span>' },
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
<html lang="ja">
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
          <i class="fas fa-external-link-alt mr-1"></i> 公開Webサイトを表示
        </a>
      </li>
      <li class="nav-item d-none d-md-inline-block">
        <a href="/admin/password" class="btn btn-outline-secondary btn-sm ml-2">
          <i class="fas fa-key mr-1"></i> パスワード変更
        </a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="/admin/inquiries" title="未対応お問い合わせ">
          <i class="far fa-comments"></i>
          ${unreadCount > 0 ? `<span class="badge badge-danger navbar-badge">${unreadCount}</span>` : ''}
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button" title="全画面表示">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
          <img src="${escapeHtml(ceoImg)}" class="user-image img-circle elevation-1" alt="User Image">
          <span class="d-none d-md-inline font-weight-bold text-dark">${escapeHtml(userName)}</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <li class="user-header bg-primary text-white">
            <img src="${escapeHtml(ceoImg)}" class="img-circle elevation-2" alt="User Image">
            <p>
              ${escapeHtml(userName)} - 管理者
              <small>${escapeHtml(user.email || 'admin@miransh.jp')}</small>
            </p>
          </li>
          <li class="user-footer d-flex justify-content-between">
            <a href="/admin/password" class="btn btn-default btn-flat text-xs"><i class="fas fa-lock mr-1"></i>パスワード変更</a>
            <a href="/admin/logout" class="btn btn-outline-danger btn-flat text-xs font-weight-bold"><i class="fas fa-sign-out-alt mr-1"></i>ログアウト</a>
          </li>
        </ul>
      </li>
    </ul>
  </nav>

  <!-- Sidebar -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="/admin" class="brand-link bg-primary text-white">
      <img src="/images/logo-icon.png" alt="MIRANSH Logo" class="brand-image img-circle elevation-2" style="background: #fff; padding: 2px;">
      <span class="brand-text font-weight-bold">MIRANSH Admin</span>
    </a>

    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
        <div class="image">
          <img src="${escapeHtml(ceoImg)}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="/admin/company" class="d-block font-weight-bold text-white">${escapeHtml(company.ceo_name_ja || '代表取締役')}</a>
          <small class="text-success"><i class="fas fa-circle text-xs mr-1"></i>Online (Admin)</small>
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
            <h4 class="m-0 font-weight-bold text-dark">
              ${escapeHtml(pageTitle)}
            </h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right mb-0 text-xs">
              <li class="breadcrumb-item"><a href="/admin">管理ホーム</a></li>
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

  <!-- Footer -->
  <footer class="main-footer text-xs">
    <strong>Copyright &copy; 2026 <a href="/">MIRANSH LLC</a>.</strong> All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>AdminLTE</b> v3.2.0 | Full-Stack Enterprise Ready
    </div>
  </footer>
</div>

<!-- Modals -->
${modalsContent}

<!-- REQUIRED SCRIPTS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

<script>
  // Image upload helper
  async function uploadAdminImageFile(fileInput, targetField) {
    if (!fileInput.files || !fileInput.files[0]) return;
    const file = fileInput.files[0];
    
    try {
      const blobUrl = URL.createObjectURL(file);
      if (targetField === 'ceo_image') {
        const p = document.getElementById('ceo_photo_preview');
        if (p) p.src = blobUrl;
      } else if (targetField === 'hero_image') {
        const p = document.getElementById('hero_banner_preview');
        if (p) p.src = blobUrl;
      }
    } catch (e) {}

    const statusEl = document.getElementById(targetField === 'ceo_image' ? 'ceo_upload_status' : 'hero_upload_status');
    if (statusEl) {
      statusEl.className = 'text-xs text-primary font-weight-bold';
      statusEl.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i>アップロード中...';
    }

    const formData = new FormData();
    formData.append('image', file);
    formData.append('target_field', targetField);

    try {
      const res = await fetch('/api/admin/upload-image', {
        method: 'POST',
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
          'X-Admin-Token': 'miransh_admin_token_2026_auth_ok'
        },
        body: formData
      });

      const rawText = await res.text();
      let data = null;
      try {
        data = JSON.parse(rawText);
      } catch (jsonErr) {
        const firstBrace = rawText.indexOf('{');
        const lastBrace = rawText.lastIndexOf('}');
        if (firstBrace !== -1 && lastBrace !== -1) {
          data = JSON.parse(rawText.substring(firstBrace, lastBrace + 1));
        } else {
          throw jsonErr;
        }
      }

      if (data && data.success && data.url) {
        if (targetField === 'ceo_image') {
          const p = document.getElementById('ceo_photo_preview');
          if (p) p.src = data.url + '?t=' + Date.now();
          const hiddenCeo = document.getElementById('input_form_ceo_image');
          if (hiddenCeo) hiddenCeo.value = data.url;
        } else if (targetField === 'hero_image') {
          const p = document.getElementById('hero_banner_preview');
          if (p) p.src = data.url + '?t=' + Date.now();
          const hiddenHero = document.getElementById('input_form_hero_image');
          if (hiddenHero) hiddenHero.value = data.url;
        }
        if (statusEl) {
          statusEl.className = 'text-xs text-success font-weight-bold';
          statusEl.innerHTML = '✓ 画像が正常に更新・反映されました';
          setTimeout(() => { statusEl.innerHTML = ''; }, 4000);
        }
      } else {
        throw new Error((data && data.error) || 'Upload error');
      }
    } catch (err) {
      console.error('Upload error:', err);
      if (statusEl) {
        statusEl.className = 'text-xs text-danger font-weight-bold';
        statusEl.innerHTML = '✕ アップロード失敗: ' + err.message;
      }
    }
  }

  async function uploadImageToInput(fileInput, targetInputId) {
    if (!fileInput.files || !fileInput.files[0]) return;
    const file = fileInput.files[0];
    const formData = new FormData();
    formData.append('image', file);

    try {
      const res = await fetch('/api/admin/upload-image', {
        method: 'POST',
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
          'X-Admin-Token': 'miransh_admin_token_2026_auth_ok'
        },
        body: formData
      });
      const data = await res.json();
      if (data && data.success && data.url) {
        const targetEl = document.getElementById(targetInputId);
        if (targetEl) targetEl.value = data.url;
      }
    } catch (e) {
      console.error(e);
      alert('画像アップロードに失敗しました: ' + e.message);
    }
  }

  function handleDragOver(e) {
    e.preventDefault();
    e.stopPropagation();
    e.currentTarget.classList.add('dragover');
  }
  function handleDragLeave(e) {
    e.preventDefault();
    e.stopPropagation();
    e.currentTarget.classList.remove('dragover');
  }
  function handleDrop(e, targetField) {
    e.preventDefault();
    e.stopPropagation();
    e.currentTarget.classList.remove('dragover');
    if (e.dataTransfer.files && e.dataTransfer.files.length > 0) {
      uploadAdminImageFile({ files: e.dataTransfer.files }, targetField);
    }
  }
</script>
${extraScripts}
</body>
</html>`;
}
