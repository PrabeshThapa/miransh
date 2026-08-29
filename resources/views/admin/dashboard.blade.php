<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MIRANSH LLC | 管理者ダッシュボード (Admin Portal)</title>
    <link rel="stylesheet" href="/css/app.css">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>⚙️</text></svg>">
    <style>
        .admin-layout {
            display: grid;
            grid-template-columns: 260px 1fr;
            min-height: 100vh;
            background: #F1F5F9;
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
    </style>
</head>
<body>

    <div class="admin-layout">
        <!-- Sidebar Navigation -->
        <aside class="admin-sidebar">
            <div class="sidebar-brand">
                <div class="brand-icon" style="width: 34px; height: 34px; font-size: 16px;">M</div>
                <div>
                    <div style="font-weight: 800; font-size: 16px; color: #FFFFFF;">MIRANSH Admin</div>
                    <div style="font-size: 11px; color: #94A3B8;">Laravel Content Manager</div>
                </div>
            </div>

            <ul class="sidebar-menu">
                <li><button class="sidebar-item-btn active" onclick="switchAdminTab('company', this)">🏢 会社情報・CEO設定</button></li>
                <li><button class="sidebar-item-btn" onclick="switchAdminTab('about', this)">📖 About (会社紹介)</button></li>
                <li><button class="sidebar-item-btn" onclick="switchAdminTab('services', this)">💼 事業内容 (Services)</button></li>
                <li><button class="sidebar-item-btn" onclick="switchAdminTab('stories', this)">📰 採用事例 (Stories)</button></li>
                <li><button class="sidebar-item-btn" onclick="switchAdminTab('faqs', this)">❓ FAQ・よくある質問 ({{ count($faqs) }})</button></li>
                <li><button class="sidebar-item-btn" onclick="switchAdminTab('ai', this)">🐟 Sakana AI 設定・テスト</button></li>
                <li><button class="sidebar-item-btn" onclick="switchAdminTab('inquiries', this)">📬 お問い合わせ ({{ count($inquiries) }})</button></li>
            </ul>

            <div style="border-top: 1px solid rgba(255,255,255,0.1); padding-top: 16px; display: flex; flex-direction: column; gap: 8px;">
                <a href="/" target="_blank" style="color: #93C5FD; font-size: 13px; font-weight: 600; display: flex; align-items: center; gap: 6px;">
                    <span>↗ 公開サイトを確認</span>
                </a>
                <a href="{{ route('admin.logout') }}" style="color: #EF4444; font-size: 13px; font-weight: 600; display: flex; align-items: center; gap: 6px;">
                    <span>🚪 ログアウト</span>
                </a>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="admin-main">
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

                    <form action="{{ route('admin.company.update') }}" method="POST">
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
                            <div class="form-group">
                                <label class="form-label">代表者 顔写真 画像URL</label>
                                <input type="text" name="ceo_image" class="form-input" value="{{ $company->ceo_image ?? '/images/ceo_portrait.jpg' }}">
                                <div style="font-size: 12px; color: #64748B; margin-top: 4px;">デフォルト: <code>/images/ceo_portrait.jpg</code></div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">代表者 統合表示名 (後方互換)</label>
                                <input type="text" name="ceo_name" class="form-input" value="{{ $company->ceo_name ?? 'ギリ ラム クリシュナ (Giri Ram Krishna)' }}">
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
                            <div class="form-group">
                                <label class="form-label">トップバナー画像URL</label>
                                <input type="text" name="hero_image" class="form-input" value="{{ $company->hero_image ?? '/images/hero_banner.jpg' }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">許認可番号バッジ表示</label>
                                <input type="text" name="license" class="form-input" value="{{ $company->license ?? '有料職業紹介事業許可：13-ユ-319558' }}">
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

                    <form action="{{ route('admin.about.update') }}" method="POST">
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

            <!-- TAB 4: STORIES -->
            <div id="pane-stories" class="tab-pane">
                <div class="admin-card">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; border-bottom: 1px solid #E2E8F0; padding-bottom: 12px;">
                        <h2 style="font-size: 20px; font-weight: 800; color: #0F172A;">
                            採用事例・お知らせ一覧 ({{ count($stories) }}件)
                        </h2>
                    </div>

                    <table class="table-custom">
                        <thead>
                            <tr>
                                <th>タイトル (日本語 / 英語)</th>
                                <th>カテゴリ</th>
                                <th>公開日</th>
                                <th style="width: 120px;">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stories as $story)
                            <tr>
                                <td>
                                    <strong>{{ $story->title_ja }}</strong><br>
                                    <span style="font-size: 12px; color: #64748B;">{{ $story->title_en }}</span>
                                </td>
                                <td><span class="badge-status">{{ $story->category_ja }}</span></td>
                                <td style="font-size: 13px; color: #64748B;">{{ $story->published_date }}</td>
                                <td>
                                    <a href="{{ route('stories.detail', $story->id) }}" target="_blank" class="badge-status" style="text-decoration: none;">記事確認 ↗</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- TAB 5: FAQS (よくある質問) -->
            <div id="pane-faqs" class="tab-pane">
                <div class="admin-card">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; border-bottom: 1px solid #E2E8F0; padding-bottom: 12px;">
                        <h2 style="font-size: 20px; font-weight: 800; color: #0F172A;">
                            FAQ・よくある質問 管理 ({{ count($faqs) }}件)
                        </h2>
                        <button type="button" class="btn-primary" onclick="openFaqCreateModal()" style="font-size: 13px; padding: 8px 16px;">+ 新規FAQを追加</button>
                    </div>

                    <table class="table-custom">
                        <thead>
                            <tr>
                                <th style="width: 130px;">カテゴリ</th>
                                <th>質問 (Question)</th>
                                <th>回答 (Answer)</th>
                                <th style="width: 100px;">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($faqs as $faq)
                            <tr>
                                <td>
                                    <span class="badge-status">{{ $faq->category_ja }}</span>
                                </td>
                                <td>
                                    <strong>{{ $faq->question_ja }}</strong><br>
                                    <span style="font-size: 12px; color: #64748B;">{{ $faq->question_en }}</span>
                                </td>
                                <td style="font-size: 13px; color: #475569; max-width: 320px;">
                                    {{ Str::limit($faq->answer_ja, 110) }}
                                </td>
                                <td>
                                    <form action="{{ route('admin.faqs.delete', $faq->id) }}" method="POST" onsubmit="return confirm('このFAQを削除してもよろしいですか？')">
                                        @csrf
                                        <button type="submit" style="background: none; border: none; color: #EF4444; font-size: 13px; font-weight: 600; cursor: pointer;">削除</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Add FAQ Modal -->
                <div id="faqCreateModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.6); z-index: 1000; align-items: center; justify-content: center; padding: 20px;">
                    <div style="background: #FFFFFF; border-radius: 12px; padding: 32px; max-width: 700px; width: 100%; max-height: 90vh; overflow-y: auto;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                            <h3 style="font-size: 18px; font-weight: 800; color: #0F172A;">新規FAQの追加</h3>
                            <button type="button" onclick="closeFaqCreateModal()" style="background: none; border: none; font-size: 20px; cursor: pointer;">✕</button>
                        </div>
                        <form action="{{ route('admin.faqs.store') }}" method="POST">
                            @csrf
                            <div class="form-grid-2">
                                <div class="form-group">
                                    <label class="form-label">カテゴリ (日本語)</label>
                                    <input type="text" name="category_ja" class="form-input" value="特定技能・在留資格" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">カテゴリ (英語)</label>
                                    <input type="text" name="category_en" class="form-input" value="Specified Skilled Worker (SSW)" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">質問内容 (日本語)</label>
                                <input type="text" name="question_ja" class="form-input" placeholder="例: 介護の特定技能1号の受入れ要件は何ですか？" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">質問内容 (英語)</label>
                                <input type="text" name="question_en" class="form-input" placeholder="e.g. What are the requirements for Nursing Care SSW?">
                            </div>
                            <div class="form-group">
                                <label class="form-label">回答内容 (日本語)</label>
                                <textarea name="answer_ja" class="form-textarea" rows="4" required placeholder="わかりやすく丁寧な回答を入力してください"></textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">回答内容 (英語)</label>
                                <textarea name="answer_en" class="form-textarea" rows="4" placeholder="English translation of the answer"></textarea>
                            </div>
                            <div style="margin-top: 20px; display: flex; gap: 12px;">
                                <button type="submit" class="btn-primary">FAQを保存する</button>
                                <button type="button" onclick="closeFaqCreateModal()" class="btn-outline-white" style="color: #334155; border-color: #CBD5E1;">キャンセル</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- TAB 6: SAKANA AI CONFIGURATION & DIAGNOSTICS -->
            <div id="pane-ai" class="tab-pane">
                <div class="admin-card">
                    <h2 style="font-size: 20px; font-weight: 800; color: #0F172A; margin-bottom: 20px; border-bottom: 1px solid #E2E8F0; padding-bottom: 12px;">
                        🐟 Sakana AI (Namazu / Fugu) 連携ステータス & 接続テスト
                    </h2>

                    <div style="background: #F0FDF4; border: 1px solid #BBF7D0; border-radius: 8px; padding: 18px; margin-bottom: 24px;">
                        <div style="font-weight: 700; color: #166534; font-size: 15px; margin-bottom: 6px;">
                            ✓ Sakana AI API & フォールバックナレッジエンジン稼働中 (Operational)
                        </div>
                        <div style="font-size: 13px; color: #14532D; line-height: 1.6;">
                            MIRANSHウェブサイト上の浮動AIコンサルタントは、Sakana AI の最新モデル（<code>sakana-namazu</code> / <code>fugu</code>）およびMIRANSH独自ナレッジベースと直接連携しています。
                        </div>
                    </div>

                    <div class="form-grid-2" style="margin-bottom: 20px;">
                        <div class="form-group">
                            <label class="form-label">Sakana AI Base URL</label>
                            <input type="text" id="ai-baseUrl" class="form-input" value="{{ env('SAKANA_AI_BASE_URL', 'https://api.sakana.ai/v1') }}" readonly>
                        </div>
                        <div class="form-group">
                            <label class="form-label">アクティブモデル (Active Model)</label>
                            <select id="ai-model" class="form-select">
                                <option value="sakana-namazu" selected>sakana-namazu (日本語特化・推論モデル)</option>
                                <option value="fugu">fugu (マルチエージェント推論モデル)</option>
                                <option value="fugu-ultra">fugu-ultra (超高精度エージェント)</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group" style="margin-bottom: 24px;">
                        <label class="form-label">API Key (現在設定中のキー: <code>fish_5417ad43...3eb84e</code>)</label>
                        <input type="password" id="ai-apiKey" class="form-input" placeholder="新しいAPIキーを入力して上書きテストが可能です">
                    </div>

                    <div style="display: flex; gap: 12px; margin-bottom: 24px;">
                        <button type="button" class="btn-primary" onclick="testSakanaConnection()" id="btn-test-ai">
                            ⚡ API 接続テストを実行
                        </button>
                    </div>

                    <div id="ai-test-results" style="display: none; background: #0F172A; color: #F8FAFC; border-radius: 8px; padding: 20px; font-family: monospace; font-size: 13px; line-height: 1.6;">
                    </div>
                </div>
            </div>

            <!-- TAB 7: INQUIRIES -->
            <div id="pane-inquiries" class="tab-pane">
                <div class="admin-card">
                    <h2 style="font-size: 20px; font-weight: 800; color: #0F172A; margin-bottom: 20px; border-bottom: 1px solid #E2E8F0; padding-bottom: 12px;">
                        お問い合わせ・相談受付一覧 ({{ count($inquiries) }}件)
                    </h2>

                    @if (count($inquiries) > 0)
                    <table class="table-custom">
                        <thead>
                            <tr>
                                <th>受信日時</th>
                                <th>企業名 / お名前</th>
                                <th>連絡先</th>
                                <th>ご相談分野</th>
                                <th>メッセージ内容</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inquiries as $inq)
                            <tr>
                                <td style="font-size: 12px; color: #64748B; white-space: nowrap;">{{ $inq->created_at }}</td>
                                <td>
                                    <strong>{{ $inq->name }}</strong><br>
                                    <span style="font-size: 12px; color: #64748B;">{{ $inq->company_name ?? '個人・未記入' }}</span>
                                </td>
                                <td style="font-size: 13px;">
                                    <div>📧 {{ $inq->email }}</div>
                                    <div>📞 {{ $inq->phone ?? '-' }}</div>
                                </td>
                                <td>
                                    <span class="badge-status">{{ $inq->service_interest ?? '全般' }}</span>
                                </td>
                                <td style="font-size: 13px; color: #334155; max-width: 320px; white-space: pre-line;">
                                    {{ $inq->message }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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
            
            const targetPane = document.getElementById('pane-' + tabName);
            if (targetPane) targetPane.classList.add('active');
            if (btnElement) btnElement.classList.add('active');
            
            window.location.hash = tabName;
        }

        function openFaqCreateModal() {
            document.getElementById('faqCreateModal').style.display = 'flex';
        }

        function closeFaqCreateModal() {
            document.getElementById('faqCreateModal').style.display = 'none';
        }

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

        (function() {
            const hash = window.location.hash.replace('#', '').replace('-tab', '');
            if (['company', 'about', 'services', 'stories', 'faqs', 'ai', 'inquiries'].includes(hash)) {
                const btn = document.querySelector(`[onclick*="${hash}"]`);
                if (btn) switchAdminTab(hash, btn);
            }
        })();
    </script>
</body>
</html>
