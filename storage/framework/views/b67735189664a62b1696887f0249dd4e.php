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
                    <div style="font-size: 11px; color: #94A3B8;">Web Content Manager</div>
                </div>
            </div>

            <ul class="sidebar-menu">
                <li><button class="sidebar-item-btn active" onclick="switchAdminTab('company', this)">🏢 会社情報・CEO写真</button></li>
                <li><button class="sidebar-item-btn" onclick="switchAdminTab('about', this)">📖 About (会社紹介)</button></li>
                <li><button class="sidebar-item-btn" onclick="switchAdminTab('services', this)">💼 事業内容 (Services)</button></li>
                <li><button class="sidebar-item-btn" onclick="switchAdminTab('stories', this)">📰 採用事例 (Stories)</button></li>
                <li><button class="sidebar-item-btn" onclick="switchAdminTab('inquiries', this)">📬 お問い合わせ (<?php echo e(count($inquiries)); ?>)</button></li>
            </ul>

            <div style="border-top: 1px solid rgba(255,255,255,0.1); padding-top: 16px; display: flex; flex-direction: column; gap: 8px;">
                <a href="/" target="_blank" style="color: #93C5FD; font-size: 13px; font-weight: 600; display: flex; align-items: center; gap: 6px;">
                    <span>↗ 公開サイトを確認</span>
                </a>
                <a href="<?php echo e(route('admin.logout')); ?>" style="color: #EF4444; font-size: 13px; font-weight: 600; display: flex; align-items: center; gap: 6px;">
                    <span>🚪 ログアウト</span>
                </a>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="admin-main">
            <div class="admin-topbar">
                <div>
                    <h1 style="font-size: 24px; font-weight: 800; color: #0F172A;">MIRANSH コンテンツ管理システム</h1>
                    <p style="font-size: 14px; color: #64748B;">ホームページ上の全テキスト・写真・事業内容・採用事例をリアルタイムに更新できます。</p>
                </div>
            </div>

            <?php if(session('success')): ?>
            <div style="background: #ECFDF5; border: 1px solid #10B981; color: #065F46; padding: 14px 20px; border-radius: 8px; margin-bottom: 24px; font-weight: 600; font-size: 14px;">
                ✓ <?php echo e(session('success')); ?>

            </div>
            <?php endif; ?>

            <!-- TAB 1: COMPANY INFO & CEO PICTURE -->
            <div id="pane-company" class="tab-pane active">
                <div class="admin-card">
                    <h2 style="font-size: 20px; font-weight: 800; color: #0F172A; margin-bottom: 20px; border-bottom: 1px solid #E2E8F0; padding-bottom: 12px;">
                        会社基本情報・代表写真・ヒーロー設定
                    </h2>

                    <form action="<?php echo e(route('admin.company.update')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <h3 style="font-size: 16px; font-weight: 700; color: #2563EB; margin: 16px 0 12px;">1. 代表者（CEO）写真・代表メッセージ</h3>
                        <div class="form-grid-2">
                            <div class="form-group">
                                <label class="form-label">代表者 役職 (日本語)</label>
                                <input type="text" name="ceo_role_ja" class="form-input" value="<?php echo e($company->ceo_role_ja ?? '代表社員'); ?>">
                            </div>
                            <div class="form-group">
                                <label class="form-label">代表者 役職 (英語)</label>
                                <input type="text" name="ceo_role_en" class="form-input" value="<?php echo e($company->ceo_role_en ?? 'Representative Member'); ?>">
                            </div>
                        </div>

                        <div class="form-grid-2">
                            <div class="form-group">
                                <label class="form-label">代表者 氏名</label>
                                <input type="text" name="ceo_name" class="form-input" value="<?php echo e($company->ceo_name ?? 'ギリ ラム クリシュナ (Giri Ram Krishna)'); ?>">
                            </div>
                            <div class="form-group">
                                <label class="form-label">代表者 顔写真 画像URL</label>
                                <input type="text" name="ceo_image" class="form-input" value="<?php echo e($company->ceo_image ?? '/images/abc.jpeg'); ?>">
                                <div style="font-size: 12px; color: #64748B; margin-top: 4px;">デフォルト: <code>/images/abc.jpeg</code></div>
                            </div>
                        </div>

                        <div class="form-grid-2">
                            <div class="form-group">
                                <label class="form-label">代表挨拶 (日本語)</label>
                                <textarea name="ceo_message_ja" class="form-textarea" rows="6"><?php echo e($company->ceo_message_ja); ?></textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">代表挨拶 (英語)</label>
                                <textarea name="ceo_message_en" class="form-textarea" rows="6"><?php echo e($company->ceo_message_en); ?></textarea>
                            </div>
                        </div>

                        <h3 style="font-size: 16px; font-weight: 700; color: #2563EB; margin: 24px 0 12px;">2. ヒーローバナー（トップ大画面）</h3>
                        <div class="form-grid-2">
                            <div class="form-group">
                                <label class="form-label">トップバナー画像URL</label>
                                <input type="text" name="hero_image" class="form-input" value="<?php echo e($company->hero_image ?? '/images/hero_banner.jpg'); ?>">
                            </div>
                            <div class="form-group">
                                <label class="form-label">許認可番号バッジ表示</label>
                                <input type="text" name="license" class="form-input" value="<?php echo e($company->license ?? '有料職業紹介事業許可：13-ユ-319558'); ?>">
                            </div>
                        </div>

                        <div class="form-grid-2">
                            <div class="form-group">
                                <label class="form-label">ヒーロー メインキャッチ (日本語)</label>
                                <input type="text" name="hero_title_ja" class="form-input" value="<?php echo e($company->hero_title_ja); ?>">
                            </div>
                            <div class="form-group">
                                <label class="form-label">ヒーロー アクセント文字 (日本語)</label>
                                <input type="text" name="hero_title_accent_ja" class="form-input" value="<?php echo e($company->hero_title_accent_ja); ?>">
                            </div>
                        </div>

                        <h3 style="font-size: 16px; font-weight: 700; color: #2563EB; margin: 24px 0 12px;">3. 会社概要・登記情報</h3>
                        <div class="form-grid-2">
                            <div class="form-group">
                                <label class="form-label">会社名 (日本語)</label>
                                <input type="text" name="name_ja" class="form-input" value="<?php echo e($company->name_ja); ?>">
                            </div>
                            <div class="form-group">
                                <label class="form-label">会社名 (英語)</label>
                                <input type="text" name="name_en" class="form-input" value="<?php echo e($company->name_en); ?>">
                            </div>
                        </div>

                        <div class="form-grid-2">
                            <div class="form-group">
                                <label class="form-label">法人番号 (13桁)</label>
                                <input type="text" name="corporate_number" class="form-input" value="<?php echo e($company->corporate_number ?? '5012403006691'); ?>">
                            </div>
                            <div class="form-group">
                                <label class="form-label">設立・法人番号指定日 (日本語)</label>
                                <input type="text" name="established_ja" class="form-input" value="<?php echo e($company->established_ja); ?>">
                            </div>
                        </div>

                        <div class="form-grid-2">
                            <div class="form-group">
                                <label class="form-label">本店所在地 (日本語)</label>
                                <input type="text" name="address_ja" class="form-input" value="<?php echo e($company->address_ja); ?>">
                            </div>
                            <div class="form-group">
                                <label class="form-label">本店所在地 (英語)</label>
                                <input type="text" name="address_en" class="form-input" value="<?php echo e($company->address_en); ?>">
                            </div>
                        </div>

                        <div class="form-grid-2">
                            <div class="form-group">
                                <label class="form-label">電話番号</label>
                                <input type="text" name="phone" class="form-input" value="<?php echo e($company->phone ?? '042-409-8256'); ?>">
                            </div>
                            <div class="form-group">
                                <label class="form-label">代表メールアドレス</label>
                                <input type="email" name="email" class="form-input" value="<?php echo e($company->email ?? 'info@miransh.jp'); ?>">
                            </div>
                        </div>

                        <div style="margin-top: 24px;">
                            <button type="submit" class="btn-primary">保存して反映する (Save Changes)</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- TAB 2: ABOUT US -->
            <div id="pane-about" class="tab-pane">
                <div class="admin-card">
                    <h2 style="font-size: 20px; font-weight: 800; color: #0F172A; margin-bottom: 20px; border-bottom: 1px solid #E2E8F0; padding-bottom: 12px;">
                        About (会社紹介セクション) 設定
                    </h2>

                    <form action="<?php echo e(route('admin.about.update')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="form-grid-2">
                            <div class="form-group">
                                <label class="form-label">見出し (日本語)</label>
                                <input type="text" name="heading_ja" class="form-input" value="<?php echo e($about->heading_ja); ?>">
                            </div>
                            <div class="form-group">
                                <label class="form-label">見出し (英語)</label>
                                <input type="text" name="heading_en" class="form-input" value="<?php echo e($about->heading_en); ?>">
                            </div>
                        </div>

                        <div class="form-grid-2">
                            <div class="form-group">
                                <label class="form-label">紹介文 1 (日本語)</label>
                                <textarea name="desc1_ja" class="form-textarea" rows="4"><?php echo e($about->desc1_ja); ?></textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">紹介文 1 (英語)</label>
                                <textarea name="desc1_en" class="form-textarea" rows="4"><?php echo e($about->desc1_en); ?></textarea>
                            </div>
                        </div>

                        <div class="form-grid-2">
                            <div class="form-group">
                                <label class="form-label">紹介文 2 (日本語)</label>
                                <textarea name="desc2_ja" class="form-textarea" rows="4"><?php echo e($about->desc2_ja); ?></textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">紹介文 2 (英語)</label>
                                <textarea name="desc2_en" class="form-textarea" rows="4"><?php echo e($about->desc2_en); ?></textarea>
                            </div>
                        </div>

                        <div class="form-grid-2">
                            <div class="form-group">
                                <label class="form-label">代表メッセージ引用 (日本語)</label>
                                <input type="text" name="quote_ja" class="form-input" value="<?php echo e($about->quote_ja); ?>">
                            </div>
                            <div class="form-group">
                                <label class="form-label">代表メッセージ引用 (英語)</label>
                                <input type="text" name="quote_en" class="form-input" value="<?php echo e($about->quote_en); ?>">
                            </div>
                        </div>

                        <div style="margin-top: 24px;">
                            <button type="submit" class="btn-primary">Aboutセクションを更新 (Save About)</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- TAB 3: SERVICES -->
            <div id="pane-services" class="tab-pane">
                <div class="admin-card">
                    <h2 style="font-size: 20px; font-weight: 800; color: #0F172A; margin-bottom: 20px; border-bottom: 1px solid #E2E8F0; padding-bottom: 12px;">
                        事業内容一覧 (Services Manager)
                    </h2>

                    <table class="table-custom" style="margin-bottom: 32px;">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>事業名 (日本語 / 英語)</th>
                                <th>概要</th>
                                <th>詳細ページ</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><span class="badge-status"><?php echo e($s->number_label); ?></span></td>
                                <td>
                                    <strong><?php echo e($s->title_ja); ?></strong><br>
                                    <span style="font-size: 12px; color: #64748B;"><?php echo e($s->title_en); ?></span>
                                </td>
                                <td style="font-size: 13px; color: #475569; max-width: 280px;">
                                    <?php echo e(Str::limit($s->desc_ja, 70)); ?>

                                </td>
                                <td>
                                    <a href="/services/<?php echo e($s->id); ?>" target="_blank" style="color: #2563EB; font-weight: 700; font-size: 13px;">
                                        ↗ 詳細表示
                                    </a>
                                </td>
                                <td>
                                    <button type="button" onclick="editServiceModal(<?php echo e(json_encode($s)); ?>)" class="btn-outline-white" style="color: #0F172A; border-color: #CBD5E1; padding: 6px 12px; font-size: 12px;">
                                        編集
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>

                    <!-- Add New Service -->
                    <h3 style="font-size: 17px; font-weight: 800; color: #0F172A; margin-bottom: 16px;">➕ 新規事業・サービスを追加</h3>
                    <form action="<?php echo e(route('admin.services.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="form-grid-2">
                            <div class="form-group">
                                <label class="form-label">事業番号 (例: 05)</label>
                                <input type="text" name="number_label" class="form-input" placeholder="05">
                            </div>
                            <div class="form-group">
                                <label class="form-label">アイコン (users, award, heart-handshake, globe)</label>
                                <input type="text" name="icon" class="form-input" value="users">
                            </div>
                        </div>

                        <div class="form-grid-2">
                            <div class="form-group">
                                <label class="form-label">事業名 (日本語)</label>
                                <input type="text" name="title_ja" class="form-input" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">事業名 (英語)</label>
                                <input type="text" name="title_en" class="form-input" required>
                            </div>
                        </div>

                        <div class="form-grid-2">
                            <div class="form-group">
                                <label class="form-label">概要説明 (日本語)</label>
                                <textarea name="desc_ja" class="form-textarea" rows="2" required></textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">概要説明 (英語)</label>
                                <textarea name="desc_en" class="form-textarea" rows="2" required></textarea>
                            </div>
                        </div>

                        <div class="form-grid-2">
                            <div class="form-group">
                                <label class="form-label">主なサポート項目 (1行に1項目・日本語)</label>
                                <textarea name="items_ja" class="form-textarea" rows="3" placeholder="項目1&#10;項目2&#10;項目3"></textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">主なサポート項目 (1行に1項目・英語)</label>
                                <textarea name="items_en" class="form-textarea" rows="3" placeholder="Item 1&#10;Item 2&#10;Item 3"></textarea>
                            </div>
                        </div>

                        <div class="form-grid-2">
                            <div class="form-group">
                                <label class="form-label">実施の流れ・ステップ (1行に1ステップ・日本語)</label>
                                <textarea name="workflow_steps_ja" class="form-textarea" rows="3" placeholder="1. ヒアリング&#10;2. 募集&#10;3. 面接"></textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">実施の流れ・ステップ (1行に1ステップ・英語)</label>
                                <textarea name="workflow_steps_en" class="form-textarea" rows="3" placeholder="1. Needs Assessment&#10;2. Sourcing&#10;3. Interview"></textarea>
                            </div>
                        </div>

                        <button type="submit" class="btn-primary">新しい事業を追加 (Publish Service)</button>
                    </form>
                </div>
            </div>

            <!-- TAB 4: STORIES -->
            <div id="pane-stories" class="tab-pane">
                <div class="admin-card">
                    <h2 style="font-size: 20px; font-weight: 800; color: #0F172A; margin-bottom: 20px; border-bottom: 1px solid #E2E8F0; padding-bottom: 12px;">
                        採用事例・ニュース管理 (Stories & Case Studies)
                    </h2>

                    <table class="table-custom" style="margin-bottom: 32px;">
                        <thead>
                            <tr>
                                <th>画像</th>
                                <th>カテゴリ</th>
                                <th>タイトル (日本語)</th>
                                <th>日付</th>
                                <th>詳細</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $stories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $st): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td style="width: 70px;">
                                    <img src="<?php echo e($st->image); ?>" style="width: 60px; height: 40px; object-fit: cover; border-radius: 4px;">
                                </td>
                                <td><span class="badge-status"><?php echo e($st->category_ja); ?></span></td>
                                <td>
                                    <strong><?php echo e($st->title_ja); ?></strong><br>
                                    <span style="font-size: 12px; color: #64748B;"><?php echo e($st->title_en); ?></span>
                                </td>
                                <td style="font-size: 12px; color: #64748B;"><?php echo e($st->published_date); ?></td>
                                <td>
                                    <a href="/stories/<?php echo e($st->id); ?>" target="_blank" style="color: #2563EB; font-weight: 700; font-size: 13px;">
                                        ↗ 記事確認
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>

                    <!-- Add Story Form -->
                    <h3 style="font-size: 17px; font-weight: 800; color: #0F172A; margin-bottom: 16px;">➕ 新規事例・記事の投稿</h3>
                    <form action="<?php echo e(route('admin.stories.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="form-grid-2">
                            <div class="form-group">
                                <label class="form-label">カテゴリ (日本語)</label>
                                <input type="text" name="category_ja" class="form-input" value="介護分野・特定技能">
                            </div>
                            <div class="form-group">
                                <label class="form-label">カテゴリ (英語)</label>
                                <input type="text" name="category_en" class="form-input" value="Caregiving / SSW">
                            </div>
                        </div>

                        <div class="form-grid-2">
                            <div class="form-group">
                                <label class="form-label">タイトル (日本語)</label>
                                <input type="text" name="title_ja" class="form-input" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">タイトル (英語)</label>
                                <input type="text" name="title_en" class="form-input" required>
                            </div>
                        </div>

                        <div class="form-grid-2">
                            <div class="form-group">
                                <label class="form-label">概要要約 (日本語)</label>
                                <textarea name="summary_ja" class="form-textarea" rows="2" required></textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">概要要約 (英語)</label>
                                <textarea name="summary_en" class="form-textarea" rows="2" required></textarea>
                            </div>
                        </div>

                        <div class="form-grid-2">
                            <div class="form-group">
                                <label class="form-label">記事本文 (日本語)</label>
                                <textarea name="content_ja" class="form-textarea" rows="5"></textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">記事本文 (英語)</label>
                                <textarea name="content_en" class="form-textarea" rows="5"></textarea>
                            </div>
                        </div>

                        <div class="form-grid-2">
                            <div class="form-group">
                                <label class="form-label">アイキャッチ画像URL</label>
                                <input type="text" name="image" class="form-input" value="/images/story1.jpg">
                            </div>
                            <div class="form-group">
                                <label class="form-label">公開日</label>
                                <input type="text" name="published_date" class="form-input" value="<?php echo e(date('Y.m.d')); ?>">
                            </div>
                        </div>

                        <button type="submit" class="btn-primary">記事を公開 (Publish Story)</button>
                    </form>
                </div>
            </div>

            <!-- TAB 5: INQUIRIES -->
            <div id="pane-inquiries" class="tab-pane">
                <div class="admin-card">
                    <h2 style="font-size: 20px; font-weight: 800; color: #0F172A; margin-bottom: 20px; border-bottom: 1px solid #E2E8F0; padding-bottom: 12px;">
                        お問い合わせ・相談受付一覧 (<?php echo e(count($inquiries)); ?>件)
                    </h2>

                    <?php if(count($inquiries) > 0): ?>
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
                            <?php $__currentLoopData = $inquiries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td style="font-size: 12px; color: #64748B; white-space: nowrap;"><?php echo e($inq->created_at); ?></td>
                                <td>
                                    <strong><?php echo e($inq->name); ?></strong><br>
                                    <span style="font-size: 12px; color: #64748B;"><?php echo e($inq->company_name ?? '個人・未記入'); ?></span>
                                </td>
                                <td style="font-size: 13px;">
                                    <div>📧 <?php echo e($inq->email); ?></div>
                                    <div>📞 <?php echo e($inq->phone ?? '-'); ?></div>
                                </td>
                                <td>
                                    <span class="badge-status"><?php echo e($inq->service_interest ?? '全般'); ?></span>
                                </td>
                                <td style="font-size: 13px; color: #334155; max-width: 320px; white-space: pre-line;">
                                    <?php echo e($inq->message); ?>

                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <?php else: ?>
                    <p style="color: #64748B; font-size: 14px; text-align: center; padding: 40px;">現在、新しいお問い合わせはありません。</p>
                    <?php endif; ?>
                </div>
            </div>
        </main>
    </div>

    <!-- Edit Service Modal -->
    <div id="serviceEditModal" class="admin-modal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.6); z-index: 1000; align-items: center; justify-content: center; padding: 20px;">
        <div style="background: #FFFFFF; border-radius: 12px; padding: 32px; max-width: 800px; width: 100%; max-height: 90vh; overflow-y: auto;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h3 style="font-size: 18px; font-weight: 800; color: #0F172A;" id="editModalTitle">事業内容の編集</h3>
                <button type="button" onclick="closeServiceModal()" style="background: none; border: none; font-size: 20px; cursor: pointer;">✕</button>
            </div>
            <form id="serviceEditForm" method="POST">
                <?php echo csrf_field(); ?>
                <div class="form-grid-2">
                    <div class="form-group">
                        <label class="form-label">事業名 (日本語)</label>
                        <input type="text" name="title_ja" id="edit_title_ja" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">事業名 (英語)</label>
                        <input type="text" name="title_en" id="edit_title_en" class="form-input" required>
                    </div>
                </div>
                <div class="form-grid-2">
                    <div class="form-group">
                        <label class="form-label">概要 (日本語)</label>
                        <textarea name="desc_ja" id="edit_desc_ja" class="form-textarea" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">概要 (英語)</label>
                        <textarea name="desc_en" id="edit_desc_en" class="form-textarea" rows="3" required></textarea>
                    </div>
                </div>
                <div style="margin-top: 20px; display: flex; gap: 12px;">
                    <button type="submit" class="btn-primary">変更を保存</button>
                    <button type="button" onclick="closeServiceModal()" class="btn-outline-white" style="color: #334155; border-color: #CBD5E1;">キャンセル</button>
                </div>
            </form>
        </div>
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

        function editServiceModal(service) {
            document.getElementById('serviceEditForm').action = '/admin/services/' + service.id;
            document.getElementById('edit_title_ja').value = service.title_ja || '';
            document.getElementById('edit_title_en').value = service.title_en || '';
            document.getElementById('edit_desc_ja').value = service.desc_ja || '';
            document.getElementById('edit_desc_en').value = service.desc_en || '';
            document.getElementById('serviceEditModal').style.display = 'flex';
        }

        function closeServiceModal() {
            document.getElementById('serviceEditModal').style.display = 'none';
        }

        (function() {
            const hash = window.location.hash.replace('#', '').replace('-tab', '');
            if (['company', 'about', 'services', 'stories', 'inquiries'].includes(hash)) {
                const btn = document.querySelector(`[onclick*="${hash}"]`);
                switchAdminTab(hash, btn);
            }
        })();
    </script>
</body>
</html>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/laravel/other/miransh/resources/views/admin/dashboard.blade.php ENDPATH**/ ?>