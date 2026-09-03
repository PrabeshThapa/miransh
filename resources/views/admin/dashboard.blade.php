<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MIRANSH LLC | 管理者ダッシュボード (Admin Portal)</title>
    <link rel="icon" type="image/png" href="/images/logo-icon.png">
    <link rel="stylesheet" href="/css/app.css">
    <style>
        .admin-layout {
            display: grid;
            grid-template-columns: 260px 1fr;
            min-height: 100vh;
            background: #F1F5F9;
            position: relative;
        }

        /* Mobile Header */
        .admin-mobile-header {
            display: none;
            background: #0B1C38;
            color: #FFFFFF;
            padding: 12px 16px;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 990;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }
        .admin-hamburger-btn {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #FFFFFF;
            border-radius: 8px;
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        /* Mobile Quick Tab Bar */
        .admin-mobile-tab-bar {
            display: none;
            background: #FFFFFF;
            border-bottom: 1px solid #E2E8F0;
            padding: 8px 12px;
            overflow-x: auto;
            white-space: nowrap;
            gap: 8px;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
            position: sticky;
            top: 62px;
            z-index: 980;
        }
        .admin-mobile-tab-bar::-webkit-scrollbar {
            display: none;
        }
        .admin-mobile-tab-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            color: #475569;
            background: #F1F5F9;
            border: 1px solid #CBD5E1;
            text-decoration: none;
            flex-shrink: 0;
            cursor: pointer;
        }
        .admin-mobile-tab-pill.active {
            background: #2563EB;
            color: #FFFFFF;
            border-color: #2563EB;
        }

        /* Backdrop Overlay */
        .admin-backdrop {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(2px);
            z-index: 998;
            opacity: 0;
            transition: opacity 0.25s ease;
        }
        .admin-backdrop.active {
            display: block;
            opacity: 1;
        }

        .admin-sidebar {
            background: #0B1C38;
            color: #FFFFFF;
            padding: 24px 16px;
            display: flex;
            flex-direction: column;
        }
        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            padding-bottom: 24px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 24px;
        }
        .sidebar-close-btn {
            display: none;
            background: transparent;
            border: none;
            color: #94A3B8;
            font-size: 22px;
            cursor: pointer;
            padding: 4px;
        }
        .sidebar-menu {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 6px;
            flex-grow: 1;
        }
        .sidebar-item-btn {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 14px;
            border-radius: 8px;
            color: #CBD5E1;
            font-size: 14px;
            font-weight: 600;
            background: transparent;
            border: none;
            cursor: pointer;
            text-align: left;
            transition: all 0.2s ease;
        }
        .sidebar-item-btn:hover,
        .sidebar-item-btn.active {
            background: #2563EB;
            color: #FFFFFF;
        }
        .admin-main {
            padding: 32px 40px;
            overflow-y: auto;
        }
        .admin-topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
        }
        .admin-card {
            background: #FFFFFF;
            border-radius: 12px;
            padding: 32px;
            border: 1px solid #E2E8F0;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            margin-bottom: 32px;
        }
        .form-grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        .tab-pane {
            display: none;
        }
        .tab-pane.active {
            display: block;
        }
        .table-custom {
            width: 100%;
            border-collapse: collapse;
        }
        .table-custom th {
            background: #F8FAFC;
            padding: 12px 16px;
            font-size: 13px;
            font-weight: 700;
            color: #334155;
            text-align: left;
            border-bottom: 1px solid #E2E8F0;
        }
        .table-custom td {
            padding: 14px 16px;
            font-size: 14px;
            border-bottom: 1px solid #E2E8F0;
            vertical-align: top;
        }
        .badge-status {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 9999px;
            font-size: 12px;
            font-weight: 700;
            background: #EFF6FF;
            color: #1D4ED8;
        }

        /* Mobile Layout & Responsiveness */
        @media (max-width: 1023px) {
            .admin-layout {
                display: flex;
                flex-direction: column;
                width: 100%;
                min-height: 100vh;
            }
            .admin-mobile-header {
                display: flex;
            }
            .admin-mobile-tab-bar {
                display: flex;
            }
            .admin-sidebar {
                position: fixed;
                top: 0;
                left: 0;
                bottom: 0;
                width: 280px;
                max-width: 85vw;
                height: 100vh;
                z-index: 999;
                transform: translateX(-100%);
                transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
                box-shadow: 4px 0 24px rgba(0, 0, 0, 0.3);
                overflow-y: auto;
            }
            .admin-sidebar.open {
                transform: translateX(0);
            }
            .sidebar-close-btn {
                display: block;
            }
            .admin-main {
                padding: 16px 14px;
                width: 100%;
                box-sizing: border-box;
            }
            .admin-topbar {
                display: none;
            }
            .form-grid-2 {
                grid-template-columns: 1fr;
                gap: 12px;
            }
            .admin-card {
                padding: 18px 14px;
                border-radius: 10px;
            }
            .upload-preview-container {
                flex-direction: column;
                align-items: stretch;
            }
        }
    </style>
</head>
<body>

    <!-- Mobile Top Header -->
    <header class="admin-mobile-header">
        <div style="display: flex; align-items: center; gap: 10px;">
            <button type="button" class="admin-hamburger-btn" onclick="toggleAdminSidebar()" aria-label="ナビゲーションメニューを開く">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
            </button>
            <div style="display: flex; align-items: center; gap: 8px;">
                <img src="/images/logo-icon.png" alt="MIRANSH" style="width: 30px; height: 30px; border-radius: 50%;">
                <span style="font-weight: 800; font-size: 15px; color: #FFFFFF;">MIRANSH Admin</span>
            </div>
        </div>
        <div style="display: flex; align-items: center; gap: 10px;">
            <a href="/" target="_blank" style="font-size: 12px; color: #93C5FD; text-decoration: none; font-weight: 700;">サイト表示 ↗</a>
            <a href="{{ route('admin.logout', [], false) }}" style="font-size: 12px; color: #FCA5A5; text-decoration: none; font-weight: 700;">退出</a>
        </div>
    </header>

    <!-- Mobile Horizontal Quick Tab Bar -->
    <nav class="admin-mobile-tab-bar">
        <button type="button" class="admin-mobile-tab-pill active" onclick="switchAdminTab('company', this)">🏢 会社・代表者</button>
        <button type="button" class="admin-mobile-tab-pill" onclick="switchAdminTab('about', this)">📖 About</button>
        <button type="button" class="admin-mobile-tab-pill" onclick="switchAdminTab('services', this)">💼 事業内容</button>
        <button type="button" class="admin-mobile-tab-pill" onclick="switchAdminTab('stories', this)">📰 採用事例</button>
        <button type="button" class="admin-mobile-tab-pill" onclick="switchAdminTab('faqs', this)">❓ FAQ ({{ count($faqs) }})</button>
        <button type="button" class="admin-mobile-tab-pill" onclick="switchAdminTab('ai', this)">🐟 AI設定</button>
        <button type="button" class="admin-mobile-tab-pill" onclick="switchAdminTab('inquiries', this)">📬 問合せ ({{ count($inquiries) }})</button>
    </nav>

    <!-- Offcanvas Backdrop Overlay -->
    <div id="adminBackdrop" class="admin-backdrop" onclick="closeAdminSidebar()"></div>

    <div class="admin-layout">
        <!-- Sidebar Navigation -->
        <aside class="admin-sidebar">
            <div class="sidebar-brand" style="display: flex; align-items: center; justify-content: space-between;">
                <div style="display: flex; align-items: center; gap: 10px;">
                    <img src="/images/logo-icon.png" alt="MIRANSH LLC" style="width: 36px; height: 36px; border-radius: 50%; flex-shrink: 0;">
                    <div>
                        <div style="font-weight: 800; font-size: 16px; color: #FFFFFF; letter-spacing: 0.02em;">MIRANSH Admin</div>
                        <div style="font-size: 11px; color: #94A3B8;">Laravel Content Manager</div>
                    </div>
                </div>
                <button type="button" class="sidebar-close-btn" onclick="closeAdminSidebar()" aria-label="メニューを閉じる">✕</button>
            </div>

            <ul class="sidebar-menu">
                <li><button class="sidebar-item-btn active" onclick="switchAdminTab('company', this); closeAdminSidebar();">🏢 会社情報・CEO設定</button></li>
                <li><button class="sidebar-item-btn" onclick="switchAdminTab('about', this); closeAdminSidebar();">📖 About (会社紹介)</button></li>
                <li><button class="sidebar-item-btn" onclick="switchAdminTab('services', this); closeAdminSidebar();">💼 事業内容 (Services)</button></li>
                <li><button class="sidebar-item-btn" onclick="switchAdminTab('stories', this); closeAdminSidebar();">📰 採用事例 (Stories)</button></li>
                <li><button class="sidebar-item-btn" onclick="switchAdminTab('faqs', this); closeAdminSidebar();">❓ FAQ・よくある質問 ({{ count($faqs) }})</button></li>
                <li><button class="sidebar-item-btn" onclick="switchAdminTab('ai', this); closeAdminSidebar();">🐟 Sakana AI 設定・テスト</button></li>
                <li><button class="sidebar-item-btn" onclick="switchAdminTab('inquiries', this); closeAdminSidebar();">📬 お問い合わせ ({{ count($inquiries) }})</button></li>
            </ul>

            <div style="border-top: 1px solid rgba(255,255,255,0.1); padding-top: 16px; display: flex; flex-direction: column; gap: 8px; margin-top: auto;">
                <a href="/" target="_blank" style="color: #93C5FD; font-size: 13px; font-weight: 600; display: flex; align-items: center; gap: 6px;">
                    <span>↗ 公開サイトを確認</span>
                </a>
                <a href="{{ route('admin.logout', [], false) }}" style="color: #EF4444; font-size: 13px; font-weight: 600; display: flex; align-items: center; gap: 6px;">
                    <span>🚪 ログアウト</span>
                </a>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="admin-main">
            <!-- Mobile Horizontal Tabs Bar -->
            <div class="admin-mobile-tabs-scroller">
                <button type="button" class="mobile-tab-btn active" onclick="switchAdminTab('company', this)">🏢 会社・代表者</button>
                <button type="button" class="mobile-tab-btn" onclick="switchAdminTab('about', this)">📖 About</button>
                <button type="button" class="mobile-tab-btn" onclick="switchAdminTab('services', this)">💼 事業内容</button>
                <button type="button" class="mobile-tab-btn" onclick="switchAdminTab('stories', this)">📰 採用事例</button>
                <button type="button" class="mobile-tab-btn" onclick="switchAdminTab('faqs', this)">❓ FAQ ({{ count($faqs) }})</button>
                <button type="button" class="mobile-tab-btn" onclick="switchAdminTab('ai', this)">🐟 AI設定</button>
                <button type="button" class="mobile-tab-btn" onclick="switchAdminTab('inquiries', this)">📬 問合せ ({{ count($inquiries) }})</button>
            </div>

            <div class="admin-topbar">
                <div>
                    <h1 style="font-size: 24px; font-weight: 800; color: #0F172A;">MIRANSH コンテンツ管理システム (Laravel)</h1>
                    <p style="font-size: 14px; color: #64748B;">ホームページ上の全テキスト・写真・事業内容・採用事例・FAQ・Sakana AIをリアルタイムに更新できます。</p>
                </div>
            </div>

            @if (session('success'))
            <div style="background: #ECFDF5; border: 1px solid #10B981; color: #065F46; padding: 14px 20px; border-radius: 8px; margin-bottom: 24px; font-weight: 600; font-size: 14px;">
                ✓ {{ session('success') }}
            </div>
            @endif

            <!-- TAB 1: COMPANY INFO & CEO PICTURE -->
            <div id="pane-company" class="tab-pane active">
                <div class="admin-card">
                    <h2 style="font-size: 20px; font-weight: 800; color: #0F172A; margin-bottom: 20px; border-bottom: 1px solid #E2E8F0; padding-bottom: 12px;">
                        会社基本情報・代表者（CEO）設定・ヒーロー設定
                    </h2>

                    <form action="{{ route('admin.company.update', [], false) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <h3 style="font-size: 16px; font-weight: 700; color: #2563EB; margin: 16px 0 12px;">1. 代表者（CEO）バイリンガル氏名・役職・写真</h3>
                        
                        <div class="form-grid-2">
                            <div class="form-group">
                                <label class="form-label">代表者 日本語氏名 (CEO Japanese Name)</label>
                                <input type="text" name="ceo_name_ja" class="form-input" value="{{ $company->ceo_name_ja ?? 'ギリ ラム クリシュナ' }}" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">代表者 英語氏名 (CEO English Name)</label>
                                <input type="text" name="ceo_name_en" class="form-input" value="{{ $company->ceo_name_en ?? 'Giri Ram Krishna' }}" required>
                            </div>
                        </div>

                        <div class="form-grid-2">
                            <div class="form-group">
                                <label class="form-label">代表者 役職 (日本語)</label>
                                <input type="text" name="ceo_role_ja" class="form-input" value="{{ $company->ceo_role_ja ?? '代表社員' }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">代表者 役職 (英語)</label>
                                <input type="text" name="ceo_role_en" class="form-input" value="{{ $company->ceo_role_en ?? 'Representative Member' }}">
                            </div>
                        </div>

                        <div class="form-grid-2">
                            <div class="form-group" style="grid-column: span 2;">
                                <label class="form-label" style="font-weight: 700; font-size: 14px; margin-bottom: 8px;">
                                    📷 代表者（CEO）顔写真 (CEO Portrait Photo)
                                </label>
                                <div class="admin-image-upload-card" style="background: #F8FAFC; border: 2px dashed #CBD5E1; border-radius: 12px; padding: 20px;">
                                    <div style="display: flex; align-items: center; gap: 20px; flex-wrap: wrap;">
                                        <img id="preview_ceo_image" src="{{ $company->ceo_image ?? '/images/ceo_portrait.jpg' }}" alt="CEO Portrait Preview" style="width: 120px; height: 120px; border-radius: 12px; object-fit: cover; border: 2px solid #E2E8F0; background: #fff;" onerror="this.src='/images/ceo_portrait.jpg'">
                                        <div style="flex: 1; min-width: 220px;">
                                            <div style="font-size: 14px; font-weight: 700; color: #0F172A; margin-bottom: 4px;">顔写真をアップロード (Upload CEO Photo)</div>
                                            <div style="font-size: 12px; color: #64748B; margin-bottom: 12px;">JPEG, PNG, WebP形式対応。ファイルを選択すると自動的にアップロードされ、即時プレビューされます。</div>
                                            
                                            <div style="display: flex; gap: 8px; align-items: center; flex-wrap: wrap;">
                                                <label class="btn-primary" style="display: inline-flex; align-items: center; gap: 6px; padding: 8px 16px; font-size: 13px; cursor: pointer;">
                                                    📁 画像ファイルを選択
                                                    <input type="file" name="ceo_image_file" accept="image/*" style="display: none;" onchange="handleAdminUpload(this, 'input_ceo_image', 'preview_ceo_image', 'preview_ceo_status', 'ceo_image')">
                                                </label>
                                                <button type="button" class="btn-secondary" style="padding: 8px 14px; font-size: 12px;" onclick="resetImageDefault('input_ceo_image', 'preview_ceo_image', '/images/abc.jpeg', 'preview_ceo_status', 'ceo_image')">
                                                    🔄 デフォルト写真に戻す
                                                </button>
                                            </div>

                                            <div id="preview_ceo_status" style="margin-top: 8px; font-size: 12px; font-weight: 600; color: #166534; display: inline-block;">
                                                ✓ 写真が設定されています ({{ $company->ceo_image ?? '/images/ceo_portrait.jpg' }})
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" id="input_ceo_image" name="ceo_image" value="{{ $company->ceo_image ?? '/images/ceo_portrait.jpg' }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-grid-2">
                            <div class="form-group">
                                <label class="form-label">代表挨拶 (日本語)</label>
                                <textarea name="ceo_message_ja" class="form-textarea" rows="6">{{ $company->ceo_message_ja }}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">代表挨拶 (英語)</label>
                                <textarea name="ceo_message_en" class="form-textarea" rows="6">{{ $company->ceo_message_en }}</textarea>
                            </div>
                        </div>

                        <h3 style="font-size: 16px; font-weight: 700; color: #2563EB; margin: 24px 0 12px;">2. ヒーローバナー（トップ大画面）</h3>
                        <div class="form-grid-2">
                            <div class="form-group" style="grid-column: span 2;">
                                <label class="form-label" style="font-weight: 700; font-size: 14px; margin-bottom: 8px;">
                                    🖼️ トップヒーローバナー画像 (Hero Banner Image)
                                </label>
                                <div class="admin-image-upload-card" style="background: #F8FAFC; border: 2px dashed #CBD5E1; border-radius: 12px; padding: 20px;">
                                    <div style="display: flex; align-items: center; gap: 20px; flex-wrap: wrap;">
                                        <img id="preview_hero_image" src="{{ $company->hero_image ?? '/images/hero_banner.jpg' }}" alt="Hero Banner Preview" style="width: 100%; max-width: 380px; height: 150px; border-radius: 10px; object-fit: cover; border: 2px solid #E2E8F0; background: #0B1C38;" onerror="this.src='/images/hero_banner.jpg'">
                                        <div style="flex: 1; min-width: 220px;">
                                            <div style="font-size: 14px; font-weight: 700; color: #0F172A; margin-bottom: 4px;">バナー画像をアップロード (Upload Hero Banner)</div>
                                            <div style="font-size: 12px; color: #64748B; margin-bottom: 12px;">JPEG, PNG, WebP形式対応（推奨サイズ: 1920×1080 または 16:9横長比率）。ファイルを選択すると自動的にアップロードされます。</div>
                                            
                                            <div style="display: flex; gap: 8px; align-items: center; flex-wrap: wrap;">
                                                <label class="btn-primary" style="display: inline-flex; align-items: center; gap: 6px; padding: 8px 16px; font-size: 13px; cursor: pointer;">
                                                    📁 バナー画像を選択
                                                    <input type="file" name="hero_image_file" accept="image/*" style="display: none;" onchange="handleAdminUpload(this, 'input_hero_image', 'preview_hero_image', 'preview_hero_status', 'hero_image')">
                                                </label>
                                                <button type="button" class="btn-secondary" style="padding: 8px 14px; font-size: 12px;" onclick="resetImageDefault('input_hero_image', 'preview_hero_image', '/images/hero_banner.jpg', 'preview_hero_status', 'hero_image')">
                                                    🔄 デフォルトバナーに戻す
                                                </button>
                                            </div>

                                            <div id="preview_hero_status" style="margin-top: 8px; font-size: 12px; font-weight: 600; color: #166534; display: inline-block;">
                                                ✓ バナー画像が設定されています ({{ $company->hero_image ?? '/images/hero_banner.jpg' }})
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" id="input_hero_image" name="hero_image" value="{{ $company->hero_image ?? '/images/hero_banner.jpg' }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-grid-2">
                            <div class="form-group">
                                <label class="form-label">キャッチコピー (日本語)</label>
                                <input type="text" name="hero_title_ja" class="form-input" value="{{ $company->hero_title_ja }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">強調ワード (日本語)</label>
                                <input type="text" name="hero_title_accent_ja" class="form-input" value="{{ $company->hero_title_accent_ja }}">
                            </div>
                        </div>

                        <div class="form-grid-2">
                            <div class="form-group">
                                <label class="form-label">キャッチコピー (英語)</label>
                                <input type="text" name="hero_title_en" class="form-input" value="{{ $company->hero_title_en }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">強調ワード (英語)</label>
                                <input type="text" name="hero_title_accent_en" class="form-input" value="{{ $company->hero_title_accent_en }}">
                            </div>
                        </div>

                        <div class="form-grid-2">
                            <div class="form-group">
                                <label class="form-label">リード文 (日本語)</label>
                                <textarea name="hero_desc_ja" class="form-textarea" rows="3">{{ $company->hero_desc_ja }}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">リード文 (英語)</label>
                                <textarea name="hero_desc_en" class="form-textarea" rows="3">{{ $company->hero_desc_en }}</textarea>
                            </div>
                        </div>

                        <h3 style="font-size: 16px; font-weight: 700; color: #2563EB; margin: 24px 0 12px;">3. 会社概要テーブル情報</h3>
                        <div class="form-grid-2">
                            <div class="form-group">
                                <label class="form-label">会社名 (日本語)</label>
                                <input type="text" name="name_ja" class="form-input" value="{{ $company->name_ja ?? 'MIRANSH合同会社' }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">会社名 (英語)</label>
                                <input type="text" name="name_en" class="form-input" value="{{ $company->name_en ?? 'MIRANSH LLC' }}">
                            </div>
                        </div>

                        <div class="form-grid-2">
                            <div class="form-group">
                                <label class="form-label">法人番号</label>
                                <input type="text" name="corporate_number" class="form-input" value="{{ $company->corporate_number ?? '5012403006691' }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">電話番号</label>
                                <input type="text" name="phone" class="form-input" value="{{ $company->phone ?? '042-409-8256' }}">
                            </div>
                        </div>

                        <div class="form-grid-2">
                            <div class="form-group">
                                <label class="form-label">メールアドレス</label>
                                <input type="email" name="email" class="form-input" value="{{ $company->email ?? 'info@miransh.jp' }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">本店住所 (日本語)</label>
                                <input type="text" name="address_ja" class="form-input" value="{{ $company->address_ja }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">本店住所 (英語)</label>
                            <input type="text" name="address_en" class="form-input" value="{{ $company->address_en }}">
                        </div>

                        <div class="form-grid-2">
                            <div class="form-group">
                                <label class="form-label">事業内容 (日本語)</label>
                                <textarea name="business_ja" class="form-textarea" rows="3">{{ $company->business_ja }}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">事業内容 (英語)</label>
                                <textarea name="business_en" class="form-textarea" rows="3">{{ $company->business_en }}</textarea>
                            </div>
                        </div>

                        <button type="submit" class="btn-primary" style="margin-top: 16px;">会社情報・CEO設定を保存する</button>
                    </form>
                </div>
            </div>

            <!-- TAB 2: ABOUT SECTION -->
            <div id="pane-about" class="tab-pane">
                <div class="admin-card">
                    <h2 style="font-size: 20px; font-weight: 800; color: #0F172A; margin-bottom: 20px; border-bottom: 1px solid #E2E8F0; padding-bottom: 12px;">
                        About Us (会社紹介・理念) 設定
                    </h2>

                    <form action="{{ route('admin.about.update', [], false) }}" method="POST">
                        @csrf
                        <div class="form-grid-2">
                            <div class="form-group">
                                <label class="form-label">セクション見出し (日本語)</label>
                                <input type="text" name="heading_ja" class="form-input" value="{{ $about->heading_ja }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">セクション見出し (英語)</label>
                                <input type="text" name="heading_en" class="form-input" value="{{ $about->heading_en }}">
                            </div>
                        </div>

                        <div class="form-grid-2">
                            <div class="form-group">
                                <label class="form-label">サブヘッド (日本語)</label>
                                <textarea name="subheading_ja" class="form-textarea" rows="2">{{ $about->subheading_ja }}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">サブヘッド (英語)</label>
                                <textarea name="subheading_en" class="form-textarea" rows="2">{{ $about->subheading_en }}</textarea>
                            </div>
                        </div>

                        <div class="form-grid-2">
                            <div class="form-group">
                                <label class="form-label">紹介本文 段落1 (日本語)</label>
                                <textarea name="desc1_ja" class="form-textarea" rows="5">{{ $about->desc1_ja }}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">紹介本文 段落1 (英語)</label>
                                <textarea name="desc1_en" class="form-textarea" rows="5">{{ $about->desc1_en }}</textarea>
                            </div>
                        </div>

                        <div class="form-grid-2">
                            <div class="form-group">
                                <label class="form-label">紹介本文 段落2 (日本語)</label>
                                <textarea name="desc2_ja" class="form-textarea" rows="4">{{ $about->desc2_ja }}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">紹介本文 段落2 (英語)</label>
                                <textarea name="desc2_en" class="form-textarea" rows="4">{{ $about->desc2_en }}</textarea>
                            </div>
                        </div>

                        <div class="form-grid-2">
                            <div class="form-group">
                                <label class="form-label">理念・コミットメント引用文 (日本語)</label>
                                <textarea name="quote_ja" class="form-textarea" rows="3">{{ $about->quote_ja }}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">理念・コミットメント引用文 (英語)</label>
                                <textarea name="quote_en" class="form-textarea" rows="3">{{ $about->quote_en }}</textarea>
                            </div>
                        </div>

                        <button type="submit" class="btn-primary" style="margin-top: 16px;">About 情報を保存する</button>
                    </form>
                </div>
            </div>

            <!-- TAB 3: SERVICES -->
            <div id="pane-services" class="tab-pane">
                <div class="admin-card">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; border-bottom: 1px solid #E2E8F0; padding-bottom: 12px;">
                        <h2 style="font-size: 20px; font-weight: 800; color: #0F172A;">
                            事業内容・サービス一覧 ({{ count($services) }}件)
                        </h2>
                    </div>

                    <div class="table-responsive">
                        <table class="table-custom">
                            <thead>
                                <tr>
                                    <th style="width: 60px;">アイコン</th>
                                    <th>事業名 (日本語 / 英語)</th>
                                    <th>概要</th>
                                    <th style="width: 120px;">操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($services as $service)
                                <tr>
                                    <td style="font-size: 24px; text-align: center;">{{ $service->icon ?? '💼' }}</td>
                                    <td>
                                        <strong>{{ $service->title_ja }}</strong><br>
                                        <span style="font-size: 12px; color: #64748B;">{{ $service->title_en }}</span>
                                    </td>
                                    <td style="font-size: 13px; color: #475569;">
                                        {{ Str::limit($service->description_ja, 90) }}
                                    </td>
                                    <td>
                                        <div style="display: flex; gap: 8px;">
                                            <a href="{{ route('services.detail', $service->id) }}" target="_blank" class="badge-status" style="text-decoration: none;">表示 ↗</a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- TAB 4: STORIES (採用事例・ニュース) -->
            <div id="pane-stories" class="tab-pane">
                <div class="admin-card">
                    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px; margin-bottom: 20px; border-bottom: 1px solid #E2E8F0; padding-bottom: 16px;">
                        <div>
                            <h2 style="font-size: 20px; font-weight: 800; color: #0F172A; margin-bottom: 4px;">
                                📰 採用事例・お知らせ 管理 (<span id="story-count-display">{{ count($stories) }}</span>件)
                            </h2>
                            <p style="font-size: 13px; color: #64748B; margin: 0;">ウェブサイト上の「採用事例」セクションにリアルタイムに反映されます。記事の新規追加、写真変更、日英語コンテンツの編集が可能です。</p>
                        </div>
                        <button type="button" class="btn-primary" onclick="openStoryCreateModal()" style="font-size: 14px; padding: 10px 20px; display: inline-flex; align-items: center; gap: 6px; box-shadow: 0 4px 12px rgba(15, 76, 129, 0.2);">
                            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            新規事例を追加
                        </button>
                    </div>

                    <!-- Search & Filter Controls -->
                    <div style="display: flex; gap: 12px; margin-bottom: 20px; flex-wrap: wrap; align-items: center; background: #F8FAFC; padding: 12px 16px; border-radius: 8px; border: 1px solid #E2E8F0;">
                        <div style="flex: 1; min-width: 240px; position: relative;">
                            <input 
                                type="text" 
                                id="story-search-input" 
                                oninput="filterStoryTable()" 
                                placeholder="🔍 タイトル・概要・キーワードで検索..." 
                                style="width: 100%; padding: 8px 12px 8px 32px; border: 1px solid #CBD5E1; border-radius: 6px; font-size: 13px; background: #FFFFFF;"
                            >
                            <span style="position: absolute; left: 10px; top: 9px; color: #94A3B8; pointer-events: none;">🔍</span>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table-custom">
                            <thead>
                                <tr>
                                    <th style="width: 70px;">写真</th>
                                    <th>タイトル (日本語 / 英語)</th>
                                    <th>カテゴリ</th>
                                    <th>公開日</th>
                                    <th>作成者</th>
                                    <th style="width: 180px; text-align: right;">操作</th>
                                </tr>
                            </thead>
                            <tbody id="stories-table-body">
                                @forelse ($stories as $story)
                                <tr class="story-row" data-search="{{ strtolower($story->title_ja . ' ' . $story->title_en . ' ' . $story->summary_ja . ' ' . $story->category_ja) }}">
                                    <td style="text-align: center;">
                                        <img src="{{ $story->image ?? '/images/story1.jpg' }}" alt="{{ $story->title_ja }}" style="width: 58px; height: 42px; border-radius: 6px; object-fit: cover; border: 1px solid #CBD5E1; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                                    </td>
                                    <td>
                                        <strong style="color: #0F172A; font-size: 14px;">{{ $story->title_ja }}</strong>
                                        @if ($story->featured)
                                        <span style="font-size: 10px; background: #FEF3C7; color: #92400E; font-weight: 700; padding: 2px 6px; border-radius: 4px; margin-left: 6px;">★ おすすめ</span>
                                        @endif
                                        <br>
                                        <span style="font-size: 12px; color: #64748B;">{{ $story->title_en }}</span>
                                    </td>
                                    <td><span class="badge-status" style="background: #EFF6FF; color: #1D4ED8;">{{ $story->category_ja }}</span></td>
                                    <td style="font-size: 13px; color: #64748B; white-space: nowrap;">{{ $story->published_date }}</td>
                                    <td style="font-size: 12px; color: #64748B; white-space: nowrap;">{{ $story->author ?? 'MIRANSH' }}</td>
                                    <td style="text-align: right; white-space: nowrap;">
                                        <button 
                                            type="button" 
                                            class="badge-status" 
                                            style="background: #0284C7; color: #FFFFFF; border: none; cursor: pointer; padding: 5px 10px; margin-right: 4px; font-weight: 700;"
                                            onclick='openStoryEditModal(@json($story))'
                                        >
                                            ✏️ 編集
                                        </button>
                                        
                                        <a href="{{ route('stories.detail', $story->id) }}" target="_blank" class="badge-status" style="background: #F1F5F9; color: #475569; border: 1px solid #CBD5E1; text-decoration: none; padding: 4px 8px; margin-right: 4px;">
                                            ↗
                                        </a>

                                        <form action="{{ route('admin.stories.delete', $story->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('本当に事例「{{ $story->title_ja }}」を削除しますか？');">
                                            @csrf
                                            <button type="submit" class="badge-status" style="background: #FEE2E2; color: #DC2626; border: 1px solid #FCA5A5; cursor: pointer; padding: 4px 8px;">
                                                🗑️
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" style="text-align: center; padding: 32px; color: #64748B;">現在、登録された採用事例はありません。</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- STORY CREATE MODAL -->
            <div id="storyCreateModal" class="modal-overlay" style="display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.6); z-index: 1000; align-items: center; justify-content: center; padding: 20px; overflow-y: auto;">
                <div class="admin-card" style="width: 100%; max-width: 800px; max-height: 90vh; overflow-y: auto; margin: auto; position: relative; box-shadow: 0 20px 40px rgba(0,0,0,0.25);">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; border-bottom: 1px solid #E2E8F0; padding-bottom: 12px;">
                        <h3 style="font-size: 18px; font-weight: 800; color: #0F172A; margin: 0;">
                            📰 新規 採用事例・記事の作成 (Add New Story)
                        </h3>
                        <button type="button" onclick="closeStoryCreateModal()" style="background: none; border: none; font-size: 20px; color: #94A3B8; cursor: pointer;">✕</button>
                    </div>

                    <form action="{{ route('admin.stories.store', [], false) }}" method="POST">
                        @csrf
                        
                        <div class="form-grid-2">
                            <div class="form-group">
                                <label class="form-label">タイトル (日本語) <span style="color: #EF4444;">*</span></label>
                                <input type="text" id="create-story-title-ja" name="title_ja" class="form-input" placeholder="例: 神奈川県・特別養護老人ホーム様での特定技能介護マッチング" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">タイトル (英語) (Title in English) <span style="color: #EF4444;">*</span></label>
                                <input type="text" id="create-story-title-en" name="title_en" class="form-input" placeholder="e.g. Caregiving Placement in Special Nursing Home" required>
                            </div>
                        </div>

                        <div class="form-grid-2">
                            <div class="form-group">
                                <label class="form-label">カテゴリ (日本語) <span style="color: #EF4444;">*</span></label>
                                <input type="text" id="create-story-cat-ja" name="category_ja" class="form-input" value="介護分野 / 特定技能1号" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">カテゴリ (英語) <span style="color: #EF4444;">*</span></label>
                                <input type="text" id="create-story-cat-en" name="category_en" class="form-input" value="Nursing Care / SSW" required>
                            </div>
                        </div>

                        <!-- Image Upload for New Story -->
                        <div class="form-group" style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 16px; margin-bottom: 16px;">
                            <label class="form-label" style="font-weight: 700;">📷 カバー写真 (Cover Image)</label>
                            <div style="display: flex; gap: 16px; align-items: center; flex-wrap: wrap;">
                                <div style="width: 120px; height: 80px; border-radius: 6px; overflow: hidden; border: 1px solid #CBD5E1; background: #E2E8F0; display: flex; align-items: center; justify-content: center;">
                                    <img id="preview-create-story-img" src="/images/story1.jpg" alt="Preview" style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                                <div style="flex: 1; min-width: 240px;">
                                    <input type="text" id="create-story-image" name="image" class="form-input" value="/images/story1.jpg" style="margin-bottom: 8px;" oninput="updateStoryImagePreview('create-story-image', 'preview-create-story-img')">
                                    <div style="display: flex; gap: 8px; align-items: center; flex-wrap: wrap;">
                                        <label class="btn-secondary" style="font-size: 12px; padding: 6px 12px; cursor: pointer; display: inline-flex; align-items: center; gap: 4px; margin: 0;">
                                            📁 ファイルを選択
                                            <input type="file" accept="image/*" style="display: none;" onchange="handleStoryUpload(this, 'create-story-image', 'preview-create-story-img', 'status-create-story-upload')">
                                        </label>
                                        <span id="status-create-story-upload" style="font-size: 12px; color: #64748B;"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">概要文 (日本語) <span style="color: #EF4444;">*</span></label>
                            <textarea id="create-story-summary-ja" name="summary_ja" class="form-textarea" rows="3" placeholder="事例の要約・背景・導入前の課題..." required></textarea>
                        </div>

                        <div class="form-group">
                            <label class="form-label">概要文 (英語) (Summary in English) <span style="color: #EF4444;">*</span></label>
                            <textarea id="create-story-summary-en" name="summary_en" class="form-textarea" rows="3" placeholder="Summary of the success story..." required></textarea>
                        </div>

                        <div class="form-group">
                            <label class="form-label">本文・詳細記事 (日本語) (Full Article in Japanese)</label>
                            <textarea id="create-story-content-ja" name="content_ja" class="form-textarea" rows="6" placeholder="詳しい導入経緯、ネパール人材の活躍の様子、施設長様からのコメントなど..."></textarea>
                        </div>

                        <div class="form-group">
                            <label class="form-label">本文・詳細記事 (英語) (Full Article in English)</label>
                            <textarea id="create-story-content-en" name="content_en" class="form-textarea" rows="6" placeholder="Full details of the story in English..."></textarea>
                        </div>

                        <div class="form-grid-2">
                            <div class="form-group">
                                <label class="form-label">公開日 (Published Date)</label>
                                <input type="text" name="published_date" class="form-input" value="{{ date('Y.m.d') }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">執筆者・編集部 (Author)</label>
                                <input type="text" name="author" class="form-input" value="MIRANSH 編集部">
                            </div>
                        </div>

                        <div class="form-grid-2" style="align-items: center;">
                            <div class="form-group">
                                <label class="form-label">表示順序 (Sort Order)</label>
                                <input type="number" name="sort_order" class="form-input" value="0" min="0">
                            </div>
                            <div style="padding-top: 14px;">
                                <label style="display: flex; align-items: center; gap: 8px; font-weight: 700; font-size: 14px; cursor: pointer;">
                                    <input type="checkbox" name="featured" value="1" checked style="width: 18px; height: 18px;">
                                    ★ トップページのおすすめ事例に掲載する
                                </label>
                            </div>
                        </div>

                        <div style="margin-top: 24px; display: flex; gap: 12px; justify-content: flex-end; border-top: 1px solid #E2E8F0; padding-top: 16px;">
                            <button type="button" onclick="closeStoryCreateModal()" class="btn-outline-white" style="color: #475569; border-color: #CBD5E1; padding: 10px 20px;">キャンセル</button>
                            <button type="submit" class="btn-primary" style="padding: 10px 24px;">✓ 事例を公開・登録する</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- STORY EDIT MODAL -->
            <div id="storyEditModal" class="modal-overlay" style="display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.6); z-index: 1000; align-items: center; justify-content: center; padding: 20px; overflow-y: auto;">
                <div class="admin-card" style="width: 100%; max-width: 800px; max-height: 90vh; overflow-y: auto; margin: auto; position: relative; box-shadow: 0 20px 40px rgba(0,0,0,0.25);">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; border-bottom: 1px solid #E2E8F0; padding-bottom: 12px;">
                        <h3 style="font-size: 18px; font-weight: 800; color: #0F172A; margin: 0;">
                            ✏️ 採用事例の編集 (Edit Story <span id="edit-story-id-badge" class="badge-status" style="background: #EFF6FF; color: #1D4ED8;"></span>)
                        </h3>
                        <button type="button" onclick="closeStoryEditModal()" style="background: none; border: none; font-size: 20px; color: #94A3B8; cursor: pointer;">✕</button>
                    </div>

                    <form id="form-edit-story" action="" method="POST">
                        @csrf
                        
                        <div class="form-grid-2">
                            <div class="form-group">
                                <label class="form-label">タイトル (日本語) <span style="color: #EF4444;">*</span></label>
                                <input type="text" id="edit-story-title-ja" name="title_ja" class="form-input" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">タイトル (英語) (Title in English) <span style="color: #EF4444;">*</span></label>
                                <input type="text" id="edit-story-title-en" name="title_en" class="form-input" required>
                            </div>
                        </div>

                        <div class="form-grid-2">
                            <div class="form-group">
                                <label class="form-label">カテゴリ (日本語) <span style="color: #EF4444;">*</span></label>
                                <input type="text" id="edit-story-cat-ja" name="category_ja" class="form-input" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">カテゴリ (英語) <span style="color: #EF4444;">*</span></label>
                                <input type="text" id="edit-story-cat-en" name="category_en" class="form-input" required>
                            </div>
                        </div>

                        <!-- Image Upload for Edit Story -->
                        <div class="form-group" style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 16px; margin-bottom: 16px;">
                            <label class="form-label" style="font-weight: 700;">📷 カバー写真 (Cover Image)</label>
                            <div style="display: flex; gap: 16px; align-items: center; flex-wrap: wrap;">
                                <div style="width: 120px; height: 80px; border-radius: 6px; overflow: hidden; border: 1px solid #CBD5E1; background: #E2E8F0; display: flex; align-items: center; justify-content: center;">
                                    <img id="preview-edit-story-img" src="/images/story1.jpg" alt="Preview" style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                                <div style="flex: 1; min-width: 240px;">
                                    <input type="text" id="edit-story-image" name="image" class="form-input" style="margin-bottom: 8px;" oninput="updateStoryImagePreview('edit-story-image', 'preview-edit-story-img')">
                                    <div style="display: flex; gap: 8px; align-items: center; flex-wrap: wrap;">
                                        <label class="btn-secondary" style="font-size: 12px; padding: 6px 12px; cursor: pointer; display: inline-flex; align-items: center; gap: 4px; margin: 0;">
                                            📁 ファイルを選択して置換
                                            <input type="file" accept="image/*" style="display: none;" onchange="handleStoryUpload(this, 'edit-story-image', 'preview-edit-story-img', 'status-edit-story-upload')">
                                        </label>
                                        <span id="status-edit-story-upload" style="font-size: 12px; color: #64748B;"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">概要文 (日本語) <span style="color: #EF4444;">*</span></label>
                            <textarea id="edit-story-summary-ja" name="summary_ja" class="form-textarea" rows="3" required></textarea>
                        </div>

                        <div class="form-group">
                            <label class="form-label">概要文 (英語) (Summary in English) <span style="color: #EF4444;">*</span></label>
                            <textarea id="edit-story-summary-en" name="summary_en" class="form-textarea" rows="3" required></textarea>
                        </div>

                        <div class="form-group">
                            <label class="form-label">本文・詳細記事 (日本語) (Full Article in Japanese)</label>
                            <textarea id="edit-story-content-ja" name="content_ja" class="form-textarea" rows="6"></textarea>
                        </div>

                        <div class="form-group">
                            <label class="form-label">本文・詳細記事 (英語) (Full Article in English)</label>
                            <textarea id="edit-story-content-en" name="content_en" class="form-textarea" rows="6"></textarea>
                        </div>

                        <div class="form-grid-2">
                            <div class="form-group">
                                <label class="form-label">公開日 (Published Date)</label>
                                <input type="text" id="edit-story-published-date" name="published_date" class="form-input">
                            </div>
                            <div class="form-group">
                                <label class="form-label">執筆者・編集部 (Author)</label>
                                <input type="text" id="edit-story-author" name="author" class="form-input">
                            </div>
                        </div>

                        <div class="form-grid-2" style="align-items: center;">
                            <div class="form-group">
                                <label class="form-label">表示順序 (Sort Order)</label>
                                <input type="number" id="edit-story-sort-order" name="sort_order" class="form-input" min="0">
                            </div>
                            <div style="padding-top: 14px;">
                                <label style="display: flex; align-items: center; gap: 8px; font-weight: 700; font-size: 14px; cursor: pointer;">
                                    <input type="checkbox" id="edit-story-featured" name="featured" value="1" style="width: 18px; height: 18px;">
                                    ★ トップページのおすすめ事例に掲載する
                                </label>
                            </div>
                        </div>

                        <div style="margin-top: 24px; display: flex; gap: 12px; justify-content: flex-end; border-top: 1px solid #E2E8F0; padding-top: 16px;">
                            <button type="button" onclick="closeStoryEditModal()" class="btn-outline-white" style="color: #475569; border-color: #CBD5E1; padding: 10px 20px;">キャンセル</button>
                            <button type="submit" class="btn-primary" style="padding: 10px 24px;">✓ 事例の変更を保存する</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- TAB 5: FAQS (よくある質問) -->
            <div id="pane-faqs" class="tab-pane">
                <div class="admin-card">
                    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px; margin-bottom: 20px; border-bottom: 1px solid #E2E8F0; padding-bottom: 16px;">
                        <div>
                            <h2 style="font-size: 20px; font-weight: 800; color: #0F172A; margin-bottom: 4px;">
                                💬 FAQ・よくある質問 管理 (<span id="faq-count-display">{{ count($faqs) }}</span>件)
                            </h2>
                            <p style="font-size: 13px; color: #64748B; margin: 0;">ウェブサイト上のFAQセクションにリアルタイムに反映されます。並び順、カテゴリ、日英語の編集・追加・削除が可能です。</p>
                        </div>
                        <button type="button" class="btn-primary" onclick="openFaqCreateModal()" style="font-size: 14px; padding: 10px 20px; display: inline-flex; align-items: center; gap: 6px; box-shadow: 0 4px 12px rgba(15, 76, 129, 0.2);">
                            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            新規FAQを追加
                        </button>
                    </div>

                    <!-- Search & Filter Controls -->
                    <div style="display: flex; gap: 12px; margin-bottom: 20px; flex-wrap: wrap; align-items: center; background: #F8FAFC; padding: 12px 16px; border-radius: 8px; border: 1px solid #E2E8F0;">
                        <div style="flex: 1; min-width: 240px; position: relative;">
                            <input 
                                type="text" 
                                id="faq-search-input" 
                                oninput="filterFaqTable()" 
                                placeholder="🔍 質問・回答・キーワードで絞り込み検索..." 
                                style="width: 100%; padding: 8px 12px 8px 32px; border: 1px solid #CBD5E1; border-radius: 6px; font-size: 13px; background: #FFFFFF;"
                            >
                            <span style="position: absolute; left: 10px; top: 9px; color: #94A3B8; pointer-events: none;">🔍</span>
                        </div>
                        <div style="display: flex; gap: 8px; align-items: center;">
                            <label style="font-size: 12px; font-weight: 700; color: #475569; white-space: nowrap;">カテゴリ絞込:</label>
                            <select id="faq-category-filter" onchange="filterFaqTable()" style="padding: 8px 12px; border: 1px solid #CBD5E1; border-radius: 6px; font-size: 13px; background: #FFFFFF; color: #334155;">
                                <option value="all">すべてのカテゴリ (All)</option>
                                @php
                                    $uniqueCategories = $faqs->pluck('category_ja')->unique()->filter();
                                @endphp
                                @foreach($uniqueCategories as $cat)
                                    <option value="{{ $cat }}">{{ $cat }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table-custom" id="faqs-table">
                            <thead>
                                <tr>
                                    <th style="width: 70px; text-align: center;">表示順</th>
                                    <th style="width: 160px;">カテゴリ</th>
                                    <th>質問内容 (日 / 英)</th>
                                    <th>回答概要 (Answer)</th>
                                    <th style="width: 140px; text-align: center;">操作</th>
                                </tr>
                            </thead>
                            <tbody id="faqs-table-body">
                                @forelse ($faqs as $faq)
                                <tr class="faq-row" data-category="{{ $faq->category_ja }}" data-search="{{ strtolower($faq->question_ja . ' ' . $faq->question_en . ' ' . $faq->answer_ja . ' ' . $faq->answer_en . ' ' . $faq->category_ja . ' ' . $faq->category_en) }}">
                                    <td style="text-align: center;">
                                        <span style="display: inline-block; background: #F1F5F9; color: #334155; font-weight: 700; font-size: 12px; padding: 3px 8px; border-radius: 12px; border: 1px solid #CBD5E1;">
                                            #{{ $faq->sort_order ?? $loop->iteration }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge-status" style="background: #EFF6FF; color: #1D4ED8; border: 1px solid #BFDBFE; font-weight: 600;">
                                            {{ $faq->category_ja }}
                                        </span>
                                        <div style="font-size: 11px; color: #64748B; margin-top: 3px;">
                                            {{ $faq->category_en }}
                                        </div>
                                    </td>
                                    <td>
                                        <div style="font-weight: 700; color: #0F172A; font-size: 14px; margin-bottom: 2px;">
                                            {{ $faq->question_ja }}
                                        </div>
                                        <div style="font-size: 12px; color: #64748B; line-height: 1.4;">
                                            {{ $faq->question_en }}
                                        </div>
                                    </td>
                                    <td style="font-size: 13px; color: #475569; max-width: 320px; line-height: 1.5;">
                                        <div style="color: #334155; margin-bottom: 4px;">{{ Str::limit($faq->answer_ja, 90) }}</div>
                                        <div style="font-size: 11px; color: #94A3B8;">{{ Str::limit($faq->answer_en, 80) }}</div>
                                    </td>
                                    <td style="text-align: center;">
                                        <div style="display: flex; gap: 8px; justify-content: center; align-items: center;">
                                            <button 
                                                type="button" 
                                                class="btn-outline-white" 
                                                style="padding: 5px 10px; font-size: 12px; color: #0F4C81; border-color: #93C5FD; background: #F0F7FF; border-radius: 4px; cursor: pointer;"
                                                onclick='openFaqEditModal(@json($faq))'
                                            >
                                                ✏️ 編集
                                            </button>
                                            <form action="{{ route('admin.faqs.delete', $faq->id, false) }}" method="POST" onsubmit="return confirm('本当にこのFAQ「{{ addslashes($faq->question_ja) }}」を削除しますか？')" style="margin: 0;">
                                                @csrf
                                                <button type="submit" style="background: #FEF2F2; border: 1px solid #FECACA; color: #DC2626; font-size: 12px; font-weight: 600; padding: 5px 10px; border-radius: 4px; cursor: pointer;">
                                                    🗑️ 削除
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr id="faq-empty-row">
                                    <td colspan="5" style="text-align: center; padding: 40px; color: #64748B;">
                                        登録されているFAQはありません。「+ 新規FAQを追加」ボタンから質問を追加してください。
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                </div>

                <!-- Add FAQ Modal -->
                <div id="faqCreateModal" style="display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.7); backdrop-filter: blur(3px); z-index: 1000; align-items: center; justify-content: center; padding: 20px;">
                    <div style="background: #FFFFFF; border-radius: 16px; padding: 32px; max-width: 750px; width: 100%; max-height: 90vh; overflow-y: auto; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3);">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; border-bottom: 1px solid #E2E8F0; padding-bottom: 12px;">
                            <div style="display: flex; align-items: center; gap: 8px;">
                                <span style="font-size: 24px;">💬</span>
                                <div>
                                    <h3 style="font-size: 18px; font-weight: 800; color: #0F172A; margin: 0;">新規FAQの追加 (Add New FAQ)</h3>
                                    <p style="font-size: 12px; color: #64748B; margin: 0;">ウェブサイト上のよくある質問セクションに即時公開されます。</p>
                                </div>
                            </div>
                            <button type="button" onclick="closeFaqCreateModal()" style="background: #F1F5F9; border: none; font-size: 16px; width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #64748B; cursor: pointer;">✕</button>
                        </div>
                        
                        <form action="{{ route('admin.faqs.store', [], false) }}" method="POST" id="form-create-faq">
                            @csrf
                            
                            <!-- Quick Category Selector Chips -->
                            <div style="margin-bottom: 16px; background: #F8FAFC; border: 1px solid #E2E8F0; padding: 12px; border-radius: 8px;">
                                <label style="font-size: 12px; font-weight: 700; color: #475569; display: block; margin-bottom: 6px;">💡 よく使われるカテゴリのクイック選択 (Quick Preset):</label>
                                <div style="display: flex; flex-wrap: wrap; gap: 6px;">
                                    <button type="button" onclick="setCreateFaqCategory('特定技能・在留資格', 'Specified Skilled Worker (SSW)')" class="badge-status" style="cursor: pointer; border: 1px solid #BFDBFE; background: #EFF6FF; color: #1D4ED8;">特定技能・在留資格</button>
                                    <button type="button" onclick="setCreateFaqCategory('介護分野の採用', 'Caregiving Sector Recruitment')" class="badge-status" style="cursor: pointer; border: 1px solid #BBF7D0; background: #F0FDF4; color: #15803D;">介護分野の採用</button>
                                    <button type="button" onclick="setCreateFaqCategory('ネパール人材・語学力', 'Nepali Talent & Language')" class="badge-status" style="cursor: pointer; border: 1px solid #FED7AA; background: #FFF7ED; color: #C2410C;">ネパール人材・語学力</button>
                                    <button type="button" onclick="setCreateFaqCategory('採用フロー・期間', 'Recruitment Timeline & Process')" class="badge-status" style="cursor: pointer; border: 1px solid #E9D5FF; background: #FAF5FF; color: #7E22CE;">採用フロー・期間</button>
                                    <button type="button" onclick="setCreateFaqCategory('費用・サポート体制', 'Costs & Support System')" class="badge-status" style="cursor: pointer; border: 1px solid #CBD5E1; background: #F8FAFC; color: #334155;">費用・サポート体制</button>
                                    <button type="button" onclick="setCreateFaqCategory('入国・生活支援・定着', 'Onboarding & Living Support')" class="badge-status" style="cursor: pointer; border: 1px solid #99F6E4; background: #F0FDFA; color: #0F766E;">生活支援・定着</button>
                                </div>
                            </div>

                            <div class="form-grid-2">
                                <div class="form-group">
                                    <label class="form-label">カテゴリ (日本語) <span style="color: #EF4444;">*</span></label>
                                    <input type="text" id="create-cat-ja" name="category_ja" class="form-input" value="特定技能・在留資格" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">カテゴリ (英語) <span style="color: #EF4444;">*</span></label>
                                    <input type="text" id="create-cat-en" name="category_en" class="form-input" value="Specified Skilled Worker (SSW)" required>
                                </div>
                            </div>

                            <div class="form-grid-2">
                                <div class="form-group" style="grid-column: span 2;">
                                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                                        <label class="form-label" style="margin-bottom: 0;">質問内容 (日本語) <span style="color: #EF4444;">*</span></label>
                                        <span style="font-size: 11px; color: #64748B;">サイト訪問者が知りたい具体的な質問</span>
                                    </div>
                                    <input type="text" id="create-q-ja" name="question_ja" class="form-input" placeholder="例: 介護の特定技能1号の受入れ要件は何ですか？" required>
                                </div>
                                <div class="form-group" style="grid-column: span 2;">
                                    <label class="form-label">質問内容 (英語) (Question in English)</label>
                                    <input type="text" id="create-q-en" name="question_en" class="form-input" placeholder="e.g. What are the requirements for Nursing Care SSW?">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">回答内容 (日本語) <span style="color: #EF4444;">*</span></label>
                                <textarea id="create-a-ja" name="answer_ja" class="form-textarea" rows="4" required placeholder="わかりやすく丁寧な回答を入力してください"></textarea>
                            </div>

                            <div class="form-group">
                                <label class="form-label">回答内容 (英語) (Answer in English)</label>
                                <textarea id="create-a-en" name="answer_en" class="form-textarea" rows="4" placeholder="English translation of the answer"></textarea>
                            </div>

                            <div class="form-grid-2" style="align-items: center;">
                                <div class="form-group">
                                    <label class="form-label">表示順序 (Sort Order - 小さい数字ほど上位表示)</label>
                                    <input type="number" name="sort_order" class="form-input" value="{{ count($faqs) + 1 }}" min="0" step="1">
                                </div>
                                <div style="padding-top: 18px;">
                                    <button type="button" onclick="autoTranslateCreateFaq()" class="btn-outline-white" style="font-size: 12px; padding: 8px 14px; border-color: #38BDF8; color: #0284C7; background: #F0F9FF; display: inline-flex; align-items: center; gap: 6px;">
                                        ⚡ 日本語から英語を自動入力 (AI Quick Translate)
                                    </button>
                                </div>
                            </div>

                            <div style="margin-top: 24px; display: flex; gap: 12px; justify-content: flex-end; border-top: 1px solid #E2E8F0; padding-top: 16px;">
                                <button type="button" onclick="closeFaqCreateModal()" class="btn-outline-white" style="color: #475569; border-color: #CBD5E1; padding: 10px 20px;">キャンセル</button>
                                <button type="submit" class="btn-primary" style="padding: 10px 24px;">✓ FAQを保存して公開</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Edit FAQ Modal -->
                <div id="faqEditModal" style="display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.7); backdrop-filter: blur(3px); z-index: 1000; align-items: center; justify-content: center; padding: 20px;">
                    <div style="background: #FFFFFF; border-radius: 16px; padding: 32px; max-width: 750px; width: 100%; max-height: 90vh; overflow-y: auto; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3);">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; border-bottom: 1px solid #E2E8F0; padding-bottom: 12px;">
                            <div style="display: flex; align-items: center; gap: 8px;">
                                <span style="font-size: 24px;">✏️</span>
                                <div>
                                    <h3 style="font-size: 18px; font-weight: 800; color: #0F172A; margin: 0;">FAQの編集 (Edit FAQ)</h3>
                                    <p style="font-size: 12px; color: #64748B; margin: 0;">FAQ ID: <span id="edit-faq-id-badge" style="font-weight: 700; color: #0F4C81;">-</span> の質問・回答を更新します。</p>
                                </div>
                            </div>
                            <button type="button" onclick="closeFaqEditModal()" style="background: #F1F5F9; border: none; font-size: 16px; width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #64748B; cursor: pointer;">✕</button>
                        </div>
                        
                        <form id="form-edit-faq" action="" method="POST">
                            @csrf
                            
                            <!-- Quick Category Selector Chips for Edit -->
                            <div style="margin-bottom: 16px; background: #F8FAFC; border: 1px solid #E2E8F0; padding: 12px; border-radius: 8px;">
                                <label style="font-size: 12px; font-weight: 700; color: #475569; display: block; margin-bottom: 6px;">💡 カテゴリのクイック変更:</label>
                                <div style="display: flex; flex-wrap: wrap; gap: 6px;">
                                    <button type="button" onclick="setEditFaqCategory('特定技能・在留資格', 'Specified Skilled Worker (SSW)')" class="badge-status" style="cursor: pointer; border: 1px solid #BFDBFE; background: #EFF6FF; color: #1D4ED8;">特定技能・在留資格</button>
                                    <button type="button" onclick="setEditFaqCategory('介護分野の採用', 'Caregiving Sector Recruitment')" class="badge-status" style="cursor: pointer; border: 1px solid #BBF7D0; background: #F0FDF4; color: #15803D;">介護分野の採用</button>
                                    <button type="button" onclick="setEditFaqCategory('ネパール人材・語学力', 'Nepali Talent & Language')" class="badge-status" style="cursor: pointer; border: 1px solid #FED7AA; background: #FFF7ED; color: #C2410C;">ネパール人材・語学力</button>
                                    <button type="button" onclick="setEditFaqCategory('採用フロー・期間', 'Recruitment Timeline & Process')" class="badge-status" style="cursor: pointer; border: 1px solid #E9D5FF; background: #FAF5FF; color: #7E22CE;">採用フロー・期間</button>
                                    <button type="button" onclick="setEditFaqCategory('費用・サポート体制', 'Costs & Support System')" class="badge-status" style="cursor: pointer; border: 1px solid #CBD5E1; background: #F8FAFC; color: #334155;">費用・サポート体制</button>
                                    <button type="button" onclick="setEditFaqCategory('入国・生活支援・定着', 'Onboarding & Living Support')" class="badge-status" style="cursor: pointer; border: 1px solid #99F6E4; background: #F0FDFA; color: #0F766E;">生活支援・定着</button>
                                </div>
                            </div>

                            <div class="form-grid-2">
                                <div class="form-group">
                                    <label class="form-label">カテゴリ (日本語) <span style="color: #EF4444;">*</span></label>
                                    <input type="text" id="edit-cat-ja" name="category_ja" class="form-input" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">カテゴリ (英語) <span style="color: #EF4444;">*</span></label>
                                    <input type="text" id="edit-cat-en" name="category_en" class="form-input" required>
                                </div>
                            </div>

                            <div class="form-grid-2">
                                <div class="form-group" style="grid-column: span 2;">
                                    <label class="form-label">質問内容 (日本語) <span style="color: #EF4444;">*</span></label>
                                    <input type="text" id="edit-q-ja" name="question_ja" class="form-input" required>
                                </div>
                                <div class="form-group" style="grid-column: span 2;">
                                    <label class="form-label">質問内容 (英語) (Question in English)</label>
                                    <input type="text" id="edit-q-en" name="question_en" class="form-input">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">回答内容 (日本語) <span style="color: #EF4444;">*</span></label>
                                <textarea id="edit-a-ja" name="answer_ja" class="form-textarea" rows="4" required></textarea>
                            </div>

                            <div class="form-group">
                                <label class="form-label">回答内容 (英語) (Answer in English)</label>
                                <textarea id="edit-a-en" name="answer_en" class="form-textarea" rows="4"></textarea>
                            </div>

                            <div class="form-grid-2" style="align-items: center;">
                                <div class="form-group">
                                    <label class="form-label">表示順序 (Sort Order)</label>
                                    <input type="number" id="edit-sort-order" name="sort_order" class="form-input" min="0" step="1">
                                </div>
                                <div style="padding-top: 18px;">
                                    <button type="button" onclick="autoTranslateEditFaq()" class="btn-outline-white" style="font-size: 12px; padding: 8px 14px; border-color: #38BDF8; color: #0284C7; background: #F0F9FF; display: inline-flex; align-items: center; gap: 6px;">
                                        ⚡ 日本語から英語を自動入力 (AI Quick Translate)
                                    </button>
                                </div>
                            </div>

                            <div style="margin-top: 24px; display: flex; gap: 12px; justify-content: flex-end; border-top: 1px solid #E2E8F0; padding-top: 16px;">
                                <button type="button" onclick="closeFaqEditModal()" class="btn-outline-white" style="color: #475569; border-color: #CBD5E1; padding: 10px 20px;">キャンセル</button>
                                <button type="submit" class="btn-primary" style="padding: 10px 24px;">✓ FAQの変更を保存する</button>
                            </div>
                        </form>
                    </div>
                </div>

            <!-- TAB 6: AI CONFIGURATION & DIAGNOSTICS -->
            <div id="pane-ai" class="tab-pane">
                <div class="admin-card">
                    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px; margin-bottom: 20px; border-bottom: 1px solid #E2E8F0; padding-bottom: 16px;">
                        <div>
                            <h2 style="font-size: 20px; font-weight: 800; color: #0F172A; margin-bottom: 4px;">
                                🤖 MIRANSH AI 連携ステータス & 接続テスト
                            </h2>
                            <p style="font-size: 13px; color: #64748B; margin: 0;">MIRANSHウェブサイト上の浮動AIコンサルタントの稼働状態、モデル設定、API接続テストを管理します。</p>
                        </div>
                        <span class="badge-status" style="background: #DCFCE7; color: #15803D; font-size: 13px; padding: 6px 14px; font-weight: 700;">
                            ● 稼働中 (Active Engine)
                        </span>
                    </div>

                    <div style="background: #F0FDF4; border: 1px solid #BBF7D0; border-radius: 10px; padding: 18px; margin-bottom: 24px;">
                        <div style="font-weight: 700; color: #166534; font-size: 15px; margin-bottom: 6px; display: flex; align-items: center; gap: 8px;">
                            <span>✓</span> AI推論エンジン & ナレッジベース稼働中
                        </div>
                        <div style="font-size: 13px; color: #14532D; line-height: 1.6;">
                            MIRANSH公式ウェブサイト右下に常駐するAIエージェントは、Sakana AI 推論モデルおよびMIRANSH独自データ（会社概要、事業内容、特定技能、介護・建設支援実績、FAQ）とリアルタイム連携しています。
                        </div>
                    </div>

                    <div class="form-grid-2" style="margin-bottom: 20px;">
                        <div class="form-group">
                            <label class="form-label">Sakana AI Base URL</label>
                            <input type="text" id="ai-baseUrl" class="form-input" value="{{ env('SAKANA_AI_BASE_URL', 'https://api.sakana.ai/v1') }}" readonly>
                        </div>
                        <div class="form-group">
                            <label class="form-label">推論モデル (Active Model)</label>
                            <select id="ai-model" class="form-select">
                                <option value="sakana-namazu" selected>sakana-namazu (日本語特化・高速推論モデル)</option>
                                <option value="fugu">fugu (マルチエージェント推論モデル)</option>
                                <option value="fugu-ultra">fugu-ultra (超高精度エージェント)</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group" style="margin-bottom: 24px;">
                        <label class="form-label">API Key 設定 (現在設定中のキー: <code>fish_5417ad43...3eb84e</code>)</label>
                        <input type="password" id="ai-apiKey" class="form-input" placeholder="新しいAPIキーを入力して上書きテストが可能です (空欄の場合はデフォルトキーを使用)">
                    </div>

                    <div style="display: flex; gap: 12px; margin-bottom: 24px;">
                        <button type="button" class="btn-primary" onclick="testSakanaConnection()" id="btn-test-ai" style="padding: 10px 24px; font-size: 14px;">
                            ⚡ Sakana AI 接続テストを実行
                        </button>
                    </div>

                    <div id="ai-test-results" style="display: none; background: #0F172A; color: #F8FAFC; border-radius: 8px; padding: 20px; font-family: monospace; font-size: 13px; line-height: 1.6; border: 1px solid #334155;">
                    </div>
                </div>
            </div>

            <!-- TAB 7: INQUIRIES -->
            <div id="pane-inquiries" class="tab-pane">
                <div class="admin-card">
                    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px; margin-bottom: 20px; border-bottom: 1px solid #E2E8F0; padding-bottom: 16px;">
                        <div>
                            <h2 style="font-size: 20px; font-weight: 800; color: #0F172A; margin-bottom: 4px;">
                                📬 お問い合わせ・相談受付一覧 ({{ count($inquiries) }}件)
                            </h2>
                            <p style="font-size: 13px; color: #64748B; margin: 0;">ウェブサイトのお問い合わせフォームから送信されたメッセージ一覧です。ステータス更新や削除が可能です。</p>
                        </div>
                    </div>

                    @if (count($inquiries) > 0)
                    <div class="table-responsive">
                        <table class="table-custom">
                            <thead>
                                <tr>
                                    <th style="width: 140px;">受信日時</th>
                                    <th>企業名 / お名前</th>
                                    <th>連絡先</th>
                                    <th>ご相談分野</th>
                                    <th>メッセージ内容</th>
                                    <th style="width: 130px; text-align: center;">対応状況</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inquiries as $inq)
                                <tr>
                                    <td style="font-size: 12px; color: #64748B; white-space: nowrap;">
                                        {{ $inq->created_at ?? '受付完了' }}
                                    </td>
                                    <td>
                                        <strong style="color: #0F172A; font-size: 14px;">{{ $inq->name }}</strong><br>
                                        <span style="font-size: 12px; color: #64748B;">{{ $inq->company_name ?? '個人・未記入' }}</span>
                                    </td>
                                    <td style="font-size: 13px;">
                                        <div>📧 <a href="mailto:{{ $inq->email }}" style="color: #2563EB; text-decoration: none;">{{ $inq->email }}</a></div>
                                        @if ($inq->phone)
                                        <div>📞 <a href="tel:{{ $inq->phone }}" style="color: #475569; text-decoration: none;">{{ $inq->phone }}</a></div>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge-status" style="background: #EFF6FF; color: #1D4ED8;">{{ $inq->service_interest ?? '全般' }}</span>
                                    </td>
                                    <td style="font-size: 13px; color: #334155; max-width: 320px; white-space: pre-line; line-height: 1.5;">
                                        {{ $inq->message }}
                                    </td>
                                    <td style="text-align: center;">
                                        <form action="/admin/inquiries/{{ $inq->id }}/status" method="POST" style="margin: 0 0 6px 0;">
                                            @csrf
                                            <select name="status" onchange="this.form.submit()" class="form-select" style="padding: 4px 8px; font-size: 12px; font-weight: 700; width: 100%; border-radius: 6px; cursor: pointer; background: {{ ($inq->status ?? '新規') === '新規' ? '#FEF2F2' : (($inq->status ?? '') === '連絡済み' ? '#EFF6FF' : (($inq->status ?? '') === '対応中' ? '#FFFBEB' : (($inq->status ?? '') === '成約' ? '#ECFDF5' : '#F1F5F9'))) }}; color: {{ ($inq->status ?? '新規') === '新規' ? '#DC2626' : (($inq->status ?? '') === '連絡済み' ? '#1D4ED8' : (($inq->status ?? '') === '対応中' ? '#D97706' : (($inq->status ?? '') === '成約' ? '#059669' : '#475569'))) }};">
                                                <option value="新規" {{ ($inq->status ?? '新規') === '新規' ? 'selected' : '' }}>🔴 新規</option>
                                                <option value="連絡済み" {{ ($inq->status ?? '') === '連絡済み' ? 'selected' : '' }}>🔵 連絡済み</option>
                                                <option value="対応中" {{ ($inq->status ?? '') === '対応中' ? 'selected' : '' }}>🟡 対応中</option>
                                                <option value="成約" {{ ($inq->status ?? '') === '成約' ? 'selected' : '' }}>🟢 成約</option>
                                                <option value="アーカイブ" {{ ($inq->status ?? '') === 'アーカイブ' ? 'selected' : '' }}>⚪ アーカイブ</option>
                                            </select>
                                        </form>
                                        <form action="/admin/inquiries/{{ $inq->id }}/delete" method="POST" onsubmit="return confirm('お問い合わせ「{{ addslashes($inq->name) }}」を削除しますか？');" style="margin: 0;">
                                            @csrf
                                            <button type="submit" style="background: none; border: none; color: #94A3B8; font-size: 11px; cursor: pointer; text-decoration: underline;">削除</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <p style="color: #64748B; font-size: 14px; text-align: center; padding: 40px;">現在、新しいお問い合わせはありません。</p>
                    @endif
                </div>
            </div>
        </main>
    </div>

    <script>
        function switchAdminTab(tabName, btnElement) {
            document.querySelectorAll('.tab-pane').forEach(el => el.classList.remove('active'));
            document.querySelectorAll('.sidebar-item-btn').forEach(el => el.classList.remove('active'));
            document.querySelectorAll('.mobile-tab-btn').forEach(el => el.classList.remove('active'));
            
            const targetPane = document.getElementById('pane-' + tabName);
            if (targetPane) targetPane.classList.add('active');
            
            // Sync all matching buttons (desktop sidebar + mobile scroller)
            document.querySelectorAll(`[onclick*="${tabName}"]`).forEach(btn => {
                btn.classList.add('active');
            });
            
            window.location.hash = tabName;
        }

        // --- REAL-TIME IMAGE PREVIEW ENGINE ---
        function updateAdminImagePreview(inputId, imgId, statusId) {
            const input = document.getElementById(inputId);
            const img = document.getElementById(imgId);
            const status = document.getElementById(statusId);
            if (input && img) {
                const val = input.value.trim();
                if (val) {
                    img.src = val;
                    if (status) {
                        status.innerHTML = '🔄 入力中のURLをプレビュー中...';
                        status.style.color = '#2563EB';
                    }
                }
            }
        }

        function handleImagePreviewError(imgElement, statusId) {
            const status = document.getElementById(statusId);
            if (status) {
                status.innerHTML = '⚠️ 画像が見つからないか読み込めません (URLをご確認ください)';
                status.style.color = '#DC2626';
            }
        }

        // --- FAQ MANAGEMENT JAVASCRIPT ---
        function openFaqCreateModal() {
            document.getElementById('faqCreateModal').style.display = 'flex';
            document.getElementById('create-q-ja').focus();
        }

        function closeFaqCreateModal() {
            document.getElementById('faqCreateModal').style.display = 'none';
        }

        function setCreateFaqCategory(ja, en) {
            document.getElementById('create-cat-ja').value = ja;
            document.getElementById('create-cat-en').value = en;
        }

        function openFaqEditModal(faq) {
            if (!faq) return;
            const modal = document.getElementById('faqEditModal');
            const form = document.getElementById('form-edit-faq');
            
            // Set form action URL to /admin/faqs/{id}
            form.action = `/admin/faqs/${faq.id}`;
            
            document.getElementById('edit-faq-id-badge').textContent = `#${faq.id}`;
            document.getElementById('edit-cat-ja').value = faq.category_ja || '';
            document.getElementById('edit-cat-en').value = faq.category_en || '';
            document.getElementById('edit-q-ja').value = faq.question_ja || '';
            document.getElementById('edit-q-en').value = faq.question_en || '';
            document.getElementById('edit-a-ja').value = faq.answer_ja || '';
            document.getElementById('edit-a-en').value = faq.answer_en || '';
            document.getElementById('edit-sort-order').value = faq.sort_order ?? 0;
            
            modal.style.display = 'flex';
            document.getElementById('edit-q-ja').focus();
        }

        function closeFaqEditModal() {
            document.getElementById('faqEditModal').style.display = 'none';
        }

        function setEditFaqCategory(ja, en) {
            document.getElementById('edit-cat-ja').value = ja;
            document.getElementById('edit-cat-en').value = en;
        }

        function filterFaqTable() {
            const query = (document.getElementById('faq-search-input').value || '').toLowerCase().trim();
            const category = document.getElementById('faq-category-filter').value;
            const rows = document.querySelectorAll('#faqs-table-body .faq-row');
            let visibleCount = 0;

            rows.forEach(row => {
                const rowCategory = row.getAttribute('data-category') || '';
                const rowSearch = row.getAttribute('data-search') || '';

                const matchesQuery = !query || rowSearch.includes(query);
                const matchesCategory = category === 'all' || rowCategory === category;

                if (matchesQuery && matchesCategory) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });

            const countDisplay = document.getElementById('faq-count-display');
            if (countDisplay) countDisplay.textContent = visibleCount;
        }

        async function autoTranslateCreateFaq() {
            const qJa = document.getElementById('create-q-ja').value.trim();
            const aJa = document.getElementById('create-a-ja').value.trim();
            if (!qJa && !aJa) {
                alert('日本語の質問または回答を入力してから実行してください。');
                return;
            }

            try {
                const res = await fetch('{{ route("sakana.translateJob") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ 
                        sourceText: `Question: ${qJa}\n\nAnswer: ${aJa}`,
                        targetLanguage: 'en'
                    })
                });

                if (res.ok) {
                    const data = await res.json();
                    if (data.translation) {
                        const parts = data.translation.split(/Answer:/i);
                        if (parts.length >= 2) {
                            document.getElementById('create-q-en').value = parts[0].replace(/Question:\s*/i, '').trim();
                            document.getElementById('create-a-en').value = parts[1].trim();
                        } else {
                            document.getElementById('create-a-en').value = data.translation;
                        }
                        return;
                    }
                }
            } catch (e) {
                console.log('AI translate fallback', e);
            }

            // Fallback quick draft
            if (!document.getElementById('create-q-en').value && qJa) {
                document.getElementById('create-q-en').value = qJa;
            }
            if (!document.getElementById('create-a-en').value && aJa) {
                document.getElementById('create-a-en').value = aJa;
            }
        }

        async function autoTranslateEditFaq() {
            const qJa = document.getElementById('edit-q-ja').value.trim();
            const aJa = document.getElementById('edit-a-ja').value.trim();
            if (!qJa && !aJa) {
                alert('日本語の質問または回答を入力してから実行してください。');
                return;
            }

            try {
                const res = await fetch('{{ route("sakana.translateJob") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ 
                        sourceText: `Question: ${qJa}\n\nAnswer: ${aJa}`,
                        targetLanguage: 'en'
                    })
                });

                if (res.ok) {
                    const data = await res.json();
                    if (data.translation) {
                        const parts = data.translation.split(/Answer:/i);
                        if (parts.length >= 2) {
                            document.getElementById('edit-q-en').value = parts[0].replace(/Question:\s*/i, '').trim();
                            document.getElementById('edit-a-en').value = parts[1].trim();
                        } else {
                            document.getElementById('edit-a-en').value = data.translation;
                        }
                        return;
                    }
                }
            } catch (e) {
                console.log('AI translate fallback', e);
            }

            // Fallback
            if (!document.getElementById('edit-q-en').value && qJa) {
                document.getElementById('edit-q-en').value = qJa;
            }
            if (!document.getElementById('edit-a-en').value && aJa) {
                document.getElementById('edit-a-en').value = aJa;
            }
        }

        // --- STORY MANAGEMENT JAVASCRIPT ---
        function openStoryCreateModal() {
            document.getElementById('storyCreateModal').style.display = 'flex';
            document.getElementById('create-story-title-ja').focus();
        }

        function closeStoryCreateModal() {
            document.getElementById('storyCreateModal').style.display = 'none';
        }

        function openStoryEditModal(story) {
            if (!story) return;
            const modal = document.getElementById('storyEditModal');
            const form = document.getElementById('form-edit-story');
            
            // Set form action URL to /admin/stories/{id}
            form.action = `/admin/stories/${story.id}`;
            
            document.getElementById('edit-story-id-badge').textContent = `#${story.id}`;
            document.getElementById('edit-story-title-ja').value = story.title_ja || '';
            document.getElementById('edit-story-title-en').value = story.title_en || '';
            document.getElementById('edit-story-cat-ja').value = story.category_ja || '';
            document.getElementById('edit-story-cat-en').value = story.category_en || '';
            document.getElementById('edit-story-summary-ja').value = story.summary_ja || '';
            document.getElementById('edit-story-summary-en').value = story.summary_en || '';
            document.getElementById('edit-story-content-ja').value = story.content_ja || '';
            document.getElementById('edit-story-content-en').value = story.content_en || '';
            document.getElementById('edit-story-image').value = story.image || '/images/story1.jpg';
            document.getElementById('preview-edit-story-img').src = story.image || '/images/story1.jpg';
            document.getElementById('edit-story-published-date').value = story.published_date || '';
            document.getElementById('edit-story-author').value = story.author || 'MIRANSH';
            document.getElementById('edit-story-sort-order').value = story.sort_order ?? 0;
            document.getElementById('edit-story-featured').checked = Boolean(story.featured);
            
            modal.style.display = 'flex';
            document.getElementById('edit-story-title-ja').focus();
        }

        function closeStoryEditModal() {
            document.getElementById('storyEditModal').style.display = 'none';
        }

        function updateStoryImagePreview(inputId, imgId) {
            const input = document.getElementById(inputId);
            const img = document.getElementById(imgId);
            if (input && img && input.value.trim()) {
                img.src = input.value.trim();
            }
        }

        async function handleStoryUpload(fileInput, targetHiddenInputId, previewImgId, statusBadgeId) {
            const file = fileInput.files && fileInput.files[0];
            if (!file) return;

            const previewImg = document.getElementById(previewImgId);
            if (previewImg) {
                try { previewImg.src = URL.createObjectURL(file); } catch (e) {}
            }

            const statusEl = document.getElementById(statusBadgeId);
            if (statusEl) {
                statusEl.style.color = '#92400E';
                statusEl.innerHTML = '⏳ アップロード中... (' + Math.round(file.size / 1024) + ' KB)';
            }

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

                const rawText = await res.text();
                let data = null;
                try {
                    data = JSON.parse(rawText);
                } catch (jsonErr) {
                    const firstBrace = rawText.indexOf('{');
                    const lastBrace = rawText.lastIndexOf('}');
                    if (firstBrace !== -1 && lastBrace !== -1 && lastBrace > firstBrace) {
                        data = JSON.parse(rawText.substring(firstBrace, lastBrace + 1));
                    } else {
                        throw jsonErr;
                    }
                }

                if (data && data.success && data.url) {
                    const hiddenInput = document.getElementById(targetHiddenInputId);
                    if (hiddenInput) hiddenInput.value = data.url;

                    if (previewImg) previewImg.src = data.url + '?t=' + Date.now();

                    if (statusEl) {
                        statusEl.style.color = '#166534';
                        statusEl.innerHTML = '✓ 画像反映完了';
                    }
                } else {
                    if (statusEl) {
                        statusEl.style.color = '#DC2626';
                        statusEl.innerHTML = '❌ ' + ((data && data.error) || 'Failed');
                    }
                }
            } catch (err) {
                console.error('Story upload error:', err);
                if (statusEl) {
                    statusEl.style.color = '#DC2626';
                    statusEl.innerHTML = '❌ アップロードエラー';
                }
            }
        }

        function filterStoryTable() {
            const query = (document.getElementById('story-search-input').value || '').toLowerCase().trim();
            const rows = document.querySelectorAll('#stories-table-body .story-row');
            let visibleCount = 0;

            rows.forEach(row => {
                const rowSearch = row.getAttribute('data-search') || '';
                if (!query || rowSearch.includes(query)) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });

            const countDisplay = document.getElementById('story-count-display');
            if (countDisplay) countDisplay.textContent = visibleCount;
        }

        // Close modals on Escape key or backdrop click
        window.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeFaqCreateModal();
                closeFaqEditModal();
                closeStoryCreateModal();
                closeStoryEditModal();
            }
        });

        document.getElementById('storyCreateModal')?.addEventListener('click', (e) => {
            if (e.target.id === 'storyCreateModal') closeStoryCreateModal();
        });

        document.getElementById('storyEditModal')?.addEventListener('click', (e) => {
            if (e.target.id === 'storyEditModal') closeStoryEditModal();
        });

        document.getElementById('faqCreateModal')?.addEventListener('click', (e) => {
            if (e.target.id === 'faqCreateModal') closeFaqCreateModal();
        });

        document.getElementById('faqEditModal')?.addEventListener('click', (e) => {
            if (e.target.id === 'faqEditModal') closeFaqEditModal();
        });

        // --- SAKANA AI TESTING ---
        async function testSakanaConnection() {
            const btn = document.getElementById('btn-test-ai');
            const resultBox = document.getElementById('ai-test-results');
            const apiKey = document.getElementById('ai-apiKey').value.trim();
            const model = document.getElementById('ai-model').value;

            btn.disabled = true;
            btn.innerText = 'テスト実行中...';
            resultBox.style.display = 'block';
            resultBox.innerHTML = 'Connecting to Sakana AI endpoint at https://api.sakana.ai/v1 ...';

            try {
                const res = await fetch('{{ route("admin.sakana.test") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ apiKey, model })
                });

                const data = await res.json();
                resultBox.innerHTML = `<pre style="white-space: pre-wrap; margin: 0;">${JSON.stringify(data, null, 2)}</pre>`;
            } catch (err) {
                resultBox.innerHTML = `<span style="color: #EF4444;">Error: ${err.message}</span>`;
            } finally {
                btn.disabled = false;
                btn.innerText = '⚡ API 接続テストを実行';
            }
        }

        // --- IMAGE UPLOAD HELPER ---
        async function handleAdminUpload(fileInput, targetHiddenInputId, previewImgId, statusBadgeId, targetField) {
            const file = fileInput.files && fileInput.files[0];
            if (!file) return;

            // Immediately show preview from local blob URL
            const previewImg = document.getElementById(previewImgId);
            if (previewImg) {
                try { previewImg.src = URL.createObjectURL(file); } catch (e) {}
            }

            const statusEl = document.getElementById(statusBadgeId);
            if (statusEl) {
                statusEl.style.color = '#92400E';
                statusEl.innerHTML = '⏳ アップロード中 / Uploading image (' + Math.round(file.size / 1024) + ' KB)...';
            }

            const formData = new FormData();
            formData.append('image', file);
            if (targetField) {
                formData.append('target_field', targetField);
            }

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
                    if (firstBrace !== -1 && lastBrace !== -1 && lastBrace > firstBrace) {
                        data = JSON.parse(rawText.substring(firstBrace, lastBrace + 1));
                    } else {
                        throw jsonErr;
                    }
                }

                if (data && data.success && data.url) {
                    const hiddenInput = document.getElementById(targetHiddenInputId);
                    if (hiddenInput) {
                        hiddenInput.value = data.url;
                    }

                    if (previewImg) {
                        previewImg.src = data.url + '?t=' + Date.now();
                    }

                    if (statusEl) {
                        statusEl.style.color = '#166534';
                        statusEl.innerHTML = '✓ 画像反映・保存完了 / Saved & Applied (' + (data.filename || 'Success') + ')';
                    }
                } else {
                    if (statusEl) {
                        statusEl.style.color = '#DC2626';
                        statusEl.innerHTML = '❌ エラー: ' + ((data && data.error) || 'Upload failed');
                    }
                }
            } catch (err) {
                console.error('Upload error:', err);
                if (statusEl) {
                    statusEl.style.color = '#DC2626';
                    statusEl.innerHTML = '❌ 通信エラーが発生しました: ' + err.message;
                }
            }
        }

        async function resetImageDefault(targetHiddenInputId, previewImgId, defaultUrl, statusBadgeId, targetField) {
            const hiddenInput = document.getElementById(targetHiddenInputId);
            if (hiddenInput) hiddenInput.value = defaultUrl;

            const previewImg = document.getElementById(previewImgId);
            if (previewImg) previewImg.src = defaultUrl;

            const statusEl = document.getElementById(statusBadgeId);
            if (statusEl) {
                statusEl.style.color = '#166534';
                statusEl.innerHTML = '✓ デフォルト画像に設定しました (' + defaultUrl + ')';
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
                } catch (e) {
                    console.log('Reset default auto-saved on save button submit');
                }
            }
        }

        function toggleAdminSidebar() {
            const sidebar = document.querySelector('.admin-sidebar');
            const backdrop = document.getElementById('adminBackdrop');
            if (sidebar) sidebar.classList.toggle('open');
            if (backdrop) backdrop.classList.toggle('active');
        }

        function closeAdminSidebar() {
            const sidebar = document.querySelector('.admin-sidebar');
            const backdrop = document.getElementById('adminBackdrop');
            if (sidebar) sidebar.classList.remove('open');
            if (backdrop) backdrop.classList.remove('active');
        }

        // --- INITIALIZE TAB ON LOAD ---
        (function() {
            const urlParams = new URLSearchParams(window.location.search);
            const queryTab = urlParams.get('tab');
            const hash = window.location.hash.replace('#', '').replace('-tab', '');
            const targetTab = queryTab || hash || '{{ $activeTab ?? "company" }}';
            
            if (['company', 'about', 'services', 'stories', 'faqs', 'ai', 'inquiries'].includes(targetTab)) {
                const btn = document.querySelector(`[onclick*="${targetTab}"]`);
                if (btn) switchAdminTab(targetTab, btn);
            }
        })();
    </script>
    <script src="/js/app.js"></script>
</body>
</html>
