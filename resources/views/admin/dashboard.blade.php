<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | MIRANSH LLC Content Management</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        :root {
            --primary: #0f4c81;
            --primary-dark: #0a365c;
            --primary-light: #e0eef8;
            --accent: #d97706;
            --surface: #ffffff;
            --bg-page: #f8fafc;
            --border: #e2e8f0;
            --text-dark: #0f172a;
            --text-muted: #64748b;
        }

        body {
            background-color: var(--bg-page);
            color: var(--text-dark);
            min-height: 100vh;
        }

        .admin-nav {
            background: #0f4c81;
            color: #ffffff;
            padding: 0 24px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .admin-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 18px;
            font-weight: 700;
        }

        .admin-badge {
            background: #d97706;
            color: #fff;
            padding: 3px 8px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .admin-nav-actions {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .btn-view-site {
            background: rgba(255,255,255,0.15);
            color: #fff;
            padding: 8px 14px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 6px;
            border: 1px solid rgba(255,255,255,0.25);
            transition: all 0.2s;
        }

        .btn-view-site:hover {
            background: rgba(255,255,255,0.25);
        }

        .btn-logout {
            background: #ef4444;
            color: #fff;
            padding: 8px 14px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 500;
            border: none;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-logout:hover {
            background: #dc2626;
        }

        .admin-container {
            max-width: 1200px;
            margin: 32px auto;
            padding: 0 20px;
        }

        .flash-alert {
            padding: 14px 20px;
            border-radius: 10px;
            margin-bottom: 24px;
            font-size: 15px;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .flash-success {
            background: #ecfdf5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .flash-error {
            background: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .admin-tabs {
            display: flex;
            gap: 8px;
            border-bottom: 2px solid var(--border);
            margin-bottom: 30px;
            background: #fff;
            padding: 8px 12px 0;
            border-radius: 12px 12px 0 0;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        }

        .admin-tab-btn {
            background: transparent;
            border: none;
            padding: 12px 20px;
            font-size: 15px;
            font-weight: 600;
            color: var(--text-muted);
            cursor: pointer;
            border-bottom: 3px solid transparent;
            margin-bottom: -2px;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
        }

        .admin-tab-btn:hover {
            color: var(--primary);
        }

        .admin-tab-btn.active {
            color: var(--primary);
            border-bottom-color: var(--primary);
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        .admin-card {
            background: #ffffff;
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 32px;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -2px rgba(0,0,0,0.05);
            margin-bottom: 32px;
        }

        .admin-card-header {
            border-bottom: 1px solid var(--border);
            padding-bottom: 18px;
            margin-bottom: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .admin-card-title {
            font-size: 20px;
            font-weight: 700;
            color: #0f172a;
        }

        .admin-card-subtitle {
            font-size: 13px;
            color: var(--text-muted);
            margin-top: 4px;
        }

        .form-grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        @media (max-width: 768px) {
            .form-grid-2 {
                grid-template-columns: 1fr;
            }
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #334155;
            margin-bottom: 6px;
        }

        .form-group label span.ja-tag {
            background: #f1f5f9;
            color: #475569;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 11px;
            margin-left: 6px;
        }

        .form-group label span.en-tag {
            background: #eff6ff;
            color: #1e40af;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 11px;
            margin-left: 6px;
        }

        .form-control {
            width: 100%;
            padding: 10px 14px;
            font-size: 14px;
            border: 1.5px solid var(--border);
            border-radius: 8px;
            outline: none;
            transition: all 0.2s;
            background: #fff;
            color: #1e293b;
            font-family: inherit;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(15, 76, 129, 0.15);
        }

        textarea.form-control {
            min-height: 90px;
            resize: vertical;
        }

        .btn-save {
            background: #0f4c81;
            color: #ffffff;
            border: none;
            padding: 12px 24px;
            font-size: 15px;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-save:hover {
            background: #0a365c;
        }

        .service-manage-item {
            background: #f8fafc;
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            transition: all 0.2s;
        }

        .service-manage-item:hover {
            border-color: #cbd5e1;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
        }

        .service-item-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }

        .service-item-title {
            font-size: 17px;
            font-weight: 700;
            color: #0f4c81;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .service-num-badge {
            background: #0f4c81;
            color: #fff;
            padding: 2px 8px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 700;
        }

        .service-actions {
            display: flex;
            gap: 10px;
        }

        .btn-action-delete {
            background: #fee2e2;
            color: #dc2626;
            border: 1px solid #fecaca;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-action-delete:hover {
            background: #fecaca;
            color: #991b1b;
        }

        .btn-action-add {
            background: #10b981;
            color: #ffffff;
            border: none;
            padding: 10px 18px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-action-add:hover {
            background: #059669;
        }
    </style>
</head>
<body>

    <header class="admin-nav">
        <div class="admin-brand">
            <span>MIRANSH LLC</span>
            <span class="admin-badge">ADMIN CMS</span>
        </div>

        <div class="admin-nav-actions">
            <a href="{{ route('home') }}" target="_blank" class="btn-view-site">
                🌐 View Live Website ↗
            </a>
            <form action="{{ route('admin.logout') }}" method="POST" style="margin:0;">
                @csrf
                <button type="submit" class="btn-logout">
                    Log Out
                </button>
            </form>
        </div>
    </header>

    <div class="admin-container">

        @if(session('success'))
            <div class="flash-alert flash-success">
                <span>✅ <strong>Success!</strong> {{ session('success') }}</span>
                <a href="{{ route('home') }}" target="_blank" style="text-decoration:underline; font-weight:600; color:inherit;">Check Website</a>
            </div>
        @endif

        @if(session('error'))
            <div class="flash-alert flash-error">
                <span>⚠️ <strong>Error:</strong> {{ session('error') }}</span>
            </div>
        @endif

        <div class="admin-tabs">
            <button class="admin-tab-btn {{ ($activeTab === 'company') ? 'active' : '' }}" onclick="switchTab('company')">
                🏢 Company Info & Profile
            </button>
            <button class="admin-tab-btn {{ ($activeTab === 'services') ? 'active' : '' }}" onclick="switchTab('services')">
                💼 Services ({{ count($services) }})
            </button>
            <button class="admin-tab-btn {{ ($activeTab === 'about') ? 'active' : '' }}" onclick="switchTab('about')">
                📖 About MIRANSH
            </button>
        </div>

        <!-- TAB 1: COMPANY -->
        <div id="tab-company" class="tab-content {{ ($activeTab === 'company') ? 'active' : '' }}">
            <form action="{{ route('admin.company.update') }}" method="POST">
                @csrf
                <div class="admin-card">
                    <div class="admin-card-header">
                        <div>
                            <h2 class="admin-card-title">General Company Details</h2>
                            <p class="admin-card-subtitle">Official company legal names, license registration, and contact information</p>
                        </div>
                        <button type="submit" class="btn-save">💾 Save Company Info</button>
                    </div>

                    <div class="form-grid-2">
                        <div class="form-group">
                            <label for="name_en">Company Name (English) <span class="en-tag">EN</span></label>
                            <input type="text" id="name_en" name="name_en" class="form-control" value="{{ $company->name_en ?? '' }}" required>
                        </div>
                        <div class="form-group">
                            <label for="name_ja">Company Name (Japanese) <span class="ja-tag">日本語</span></label>
                            <input type="text" id="name_ja" name="name_ja" class="form-control" value="{{ $company->name_ja ?? '' }}" required>
                        </div>
                    </div>

                    <div class="form-grid-2">
                        <div class="form-group">
                            <label for="tagline_en">Tagline (English) <span class="en-tag">EN</span></label>
                            <input type="text" id="tagline_en" name="tagline_en" class="form-control" value="{{ $company->tagline_en ?? '' }}" required>
                        </div>
                        <div class="form-group">
                            <label for="tagline_ja">Tagline (Japanese) <span class="ja-tag">日本語</span></label>
                            <input type="text" id="tagline_ja" name="tagline_ja" class="form-control" value="{{ $company->tagline_ja ?? '' }}" required>
                        </div>
                    </div>

                    <div class="form-grid-2">
                        <div class="form-group">
                            <label for="phone">Contact Phone Number 📞</label>
                            <input type="text" id="phone" name="phone" class="form-control" value="{{ $company->phone ?? '' }}" required>
                        </div>
                        <div class="form-group">
                            <label for="license">License Number (有料職業紹介事業許可)</label>
                            <input type="text" id="license" name="license" class="form-control" value="{{ $company->license ?? '' }}" required>
                        </div>
                    </div>

                    <div class="form-grid-2">
                        <div class="form-group">
                            <label for="location_en">Location (English) <span class="en-tag">EN</span></label>
                            <input type="text" id="location_en" name="location_en" class="form-control" value="{{ $company->location_en ?? '' }}" required>
                        </div>
                        <div class="form-group">
                            <label for="location_ja">Location (Japanese) <span class="ja-tag">日本語</span></label>
                            <input type="text" id="location_ja" name="location_ja" class="form-control" value="{{ $company->location_ja ?? '' }}" required>
                        </div>
                    </div>

                    <div class="form-grid-2">
                        <div class="form-group">
                            <label for="business_en">Business Description (English) <span class="en-tag">EN</span></label>
                            <textarea id="business_en" name="business_en" class="form-control" rows="3" required>{{ $company->business_en ?? '' }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="business_ja">Business Description (Japanese) <span class="ja-tag">日本語</span></label>
                            <textarea id="business_ja" name="business_ja" class="form-control" rows="3" required>{{ $company->business_ja ?? '' }}</textarea>
                        </div>
                    </div>

                    <hr style="border:0; border-top:1px solid var(--border); margin: 24px 0;">

                    <h3 style="font-size:16px; font-weight:700; color:#0f4c81; margin-bottom:16px;">👤 Leadership & CEO Profile</h3>
                    <div class="form-grid-2">
                        <div class="form-group">
                            <label for="ceo_name">CEO / Representative Name</label>
                            <input type="text" id="ceo_name" name="ceo_name" class="form-control" value="{{ $company->ceo_name ?? '' }}" required>
                        </div>
                        <div class="form-group"></div>
                        <div class="form-group">
                            <label for="ceo_role_en">CEO Title (English) <span class="en-tag">EN</span></label>
                            <input type="text" id="ceo_role_en" name="ceo_role_en" class="form-control" value="{{ $company->ceo_role_en ?? '' }}" required>
                        </div>
                        <div class="form-group">
                            <label for="ceo_role_ja">CEO Title (Japanese) <span class="ja-tag">日本語</span></label>
                            <input type="text" id="ceo_role_ja" name="ceo_role_ja" class="form-control" value="{{ $company->ceo_role_ja ?? '' }}" required>
                        </div>
                    </div>

                    <div style="margin-top: 20px;">
                        <button type="submit" class="btn-save">💾 Save Company Info</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- TAB 2: SERVICES -->
        <div id="tab-services" class="tab-content {{ ($activeTab === 'services') ? 'active' : '' }}">
            <div class="admin-card" style="border-left: 4px solid #10b981;">
                <div class="admin-card-header">
                    <div>
                        <h2 class="admin-card-title" style="color: #065f46;">➕ Add New Service</h2>
                        <p class="admin-card-subtitle">Create and publish a new service card to the website</p>
                    </div>
                </div>

                <form action="{{ route('admin.services.store') }}" method="POST">
                    @csrf
                    <div class="form-grid-2">
                        <div class="form-group">
                            <label for="new_number_label">Number Label (e.g. 03)</label>
                            <input type="text" id="new_number_label" name="number_label" class="form-control" value="0{{ count($services) + 1 }}" required>
                        </div>
                        <div class="form-group">
                            <label for="new_sort_order">Sort Order Display Rank</label>
                            <input type="number" id="new_sort_order" name="sort_order" class="form-control" value="{{ count($services) + 1 }}" required>
                        </div>
                    </div>

                    <div class="form-grid-2">
                        <div class="form-group">
                            <label for="new_title_en">Service Title (English) <span class="en-tag">EN</span></label>
                            <input type="text" id="new_title_en" name="title_en" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="new_title_ja">Service Title (Japanese) <span class="ja-tag">日本語</span></label>
                            <input type="text" id="new_title_ja" name="title_ja" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-grid-2">
                        <div class="form-group">
                            <label for="new_desc_en">Service Description (English) <span class="en-tag">EN</span></label>
                            <textarea id="new_desc_en" name="desc_en" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="new_desc_ja">Service Description (Japanese) <span class="ja-tag">日本語</span></label>
                            <textarea id="new_desc_ja" name="desc_ja" class="form-control" required></textarea>
                        </div>
                    </div>

                    <div class="form-grid-2">
                        <div class="form-group">
                            <label for="new_items_en">Bullet Items (English) <small>(one per line)</small></label>
                            <textarea id="new_items_en" name="items_en" class="form-control" rows="4"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="new_items_ja">Bullet Items (Japanese) <small>(one per line)</small></label>
                            <textarea id="new_items_ja" name="items_ja" class="form-control" rows="4"></textarea>
                        </div>
                    </div>

                    <button type="submit" class="btn-action-add">➕ Publish New Service</button>
                </form>
            </div>

            <div class="admin-card">
                <div class="admin-card-header">
                    <div>
                        <h2 class="admin-card-title">Existing Services ({{ count($services) }})</h2>
                        <p class="admin-card-subtitle">Edit details or remove services currently active on the site</p>
                    </div>
                </div>

                @foreach($services as $index => $service)
                    <div class="service-manage-item">
                        <div class="service-item-header">
                            <div class="service-item-title">
                                <span class="service-num-badge">{{ $service->number_label ?? ('0' . ($index + 1)) }}</span>
                                <span>{{ $service->title_en }} / {{ $service->title_ja }}</span>
                            </div>
                            <form action="{{ route('admin.services.delete', $service->id) }}" method="POST" onsubmit="return confirm('Delete this service?');">
                                @csrf
                                <button type="submit" class="btn-action-delete">🗑️ Delete</button>
                            </form>
                        </div>

                        <form action="{{ route('admin.services.update', $service->id) }}" method="POST">
                            @csrf
                            <div class="form-grid-2">
                                <div class="form-group">
                                    <label>Number Label</label>
                                    <input type="text" name="number_label" class="form-control" value="{{ $service->number_label }}" required>
                                </div>
                                <div class="form-group">
                                    <label>Sort Order</label>
                                    <input type="number" name="sort_order" class="form-control" value="{{ $service->sort_order }}" required>
                                </div>
                            </div>

                            <div class="form-grid-2">
                                <div class="form-group">
                                    <label>Title (English)</label>
                                    <input type="text" name="title_en" class="form-control" value="{{ $service->title_en }}" required>
                                </div>
                                <div class="form-group">
                                    <label>Title (Japanese)</label>
                                    <input type="text" name="title_ja" class="form-control" value="{{ $service->title_ja }}" required>
                                </div>
                            </div>

                            <div class="form-grid-2">
                                <div class="form-group">
                                    <label>Description (English)</label>
                                    <textarea name="desc_en" class="form-control" rows="3" required>{{ $service->desc_en }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Description (Japanese)</label>
                                    <textarea name="desc_ja" class="form-control" rows="3" required>{{ $service->desc_ja }}</textarea>
                                </div>
                            </div>

                            <div class="form-grid-2">
                                <div class="form-group">
                                    <label>Bullet Items (English) <small>(one per line)</small></label>
                                    <textarea name="items_en" class="form-control" rows="5">{{ is_array($service->items_en) ? implode("\n", $service->items_en) : '' }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Bullet Items (Japanese) <small>(one per line)</small></label>
                                    <textarea name="items_ja" class="form-control" rows="5">{{ is_array($service->items_ja) ? implode("\n", $service->items_ja) : '' }}</textarea>
                                </div>
                            </div>

                            <div style="text-align: right; margin-top: 10px;">
                                <button type="submit" class="btn-save">💾 Update Service #{{ $service->number_label }}</button>
                            </div>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- TAB 3: ABOUT -->
        <div id="tab-about" class="tab-content {{ ($activeTab === 'about') ? 'active' : '' }}">
            <form action="{{ route('admin.about.update') }}" method="POST">
                @csrf
                <div class="admin-card">
                    <div class="admin-card-header">
                        <div>
                            <h2 class="admin-card-title">About MIRANSH Section</h2>
                            <p class="admin-card-subtitle">Manage company mission, background story, and quote statements</p>
                        </div>
                        <button type="submit" class="btn-save">💾 Save About Section</button>
                    </div>

                    <div class="form-grid-2">
                        <div class="form-group">
                            <label for="badge_en">Section Badge (English) <span class="en-tag">EN</span></label>
                            <input type="text" id="badge_en" name="badge_en" class="form-control" value="{{ $about->badge_en ?? '' }}" required>
                        </div>
                        <div class="form-group">
                            <label for="badge_ja">Section Badge (Japanese) <span class="ja-tag">日本語</span></label>
                            <input type="text" id="badge_ja" name="badge_ja" class="form-control" value="{{ $about->badge_ja ?? '' }}" required>
                        </div>
                    </div>

                    <div class="form-grid-2">
                        <div class="form-group">
                            <label for="heading_en">Main Heading (English) <span class="en-tag">EN</span></label>
                            <input type="text" id="heading_en" name="heading_en" class="form-control" value="{{ $about->heading_en ?? '' }}" required>
                        </div>
                        <div class="form-group">
                            <label for="heading_ja">Main Heading (Japanese) <span class="ja-tag">日本語</span></label>
                            <input type="text" id="heading_ja" name="heading_ja" class="form-control" value="{{ $about->heading_ja ?? '' }}" required>
                        </div>
                    </div>

                    <div class="form-grid-2">
                        <div class="form-group">
                            <label for="desc1_en">Paragraph 1 (English) <span class="en-tag">EN</span></label>
                            <textarea id="desc1_en" name="desc1_en" class="form-control" rows="4" required>{{ $about->desc1_en ?? '' }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="desc1_ja">Paragraph 1 (Japanese) <span class="ja-tag">日本語</span></label>
                            <textarea id="desc1_ja" name="desc1_ja" class="form-control" rows="4" required>{{ $about->desc1_ja ?? '' }}</textarea>
                        </div>
                    </div>

                    <div class="form-grid-2">
                        <div class="form-group">
                            <label for="quote_en">Featured Quote (English) <span class="en-tag">EN</span></label>
                            <textarea id="quote_en" name="quote_en" class="form-control" rows="3" required>{{ $about->quote_en ?? '' }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="quote_ja">Featured Quote (Japanese) <span class="ja-tag">日本語</span></label>
                            <textarea id="quote_ja" name="quote_ja" class="form-control" rows="3" required>{{ $about->quote_ja ?? '' }}</textarea>
                        </div>
                    </div>

                    <div style="margin-top: 20px;">
                        <button type="submit" class="btn-save">💾 Save About Section</button>
                    </div>
                </div>
            </form>
        </div>

    </div>

    <script>
        function switchTab(tabId) {
            document.querySelectorAll('.admin-tab-btn').forEach(btn => btn.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));
            
            const targetBtn = Array.from(document.querySelectorAll('.admin-tab-btn')).find(b => b.getAttribute('onclick').includes(tabId));
            if (targetBtn) targetBtn.classList.add('active');
            
            const targetContent = document.getElementById('tab-' + tabId);
            if (targetContent) targetContent.classList.add('active');
        }
    </script>
</body>
</html>
