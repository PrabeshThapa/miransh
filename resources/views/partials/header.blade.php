<header id="site-header">
    <div class="container navbar">

        <a href="#top" class="logo">
            {{ explode(' ', $company->name_en ?? 'MIRANSH LLC')[0] }} <span>{{ explode(' ', $company->name_en ?? 'MIRANSH LLC')[1] ?? '' }}</span>
        </a>

        <div class="nav-right">

            <nav>
                <a href="#top">
                    <span class="lang-en">Top</span>
                    <span class="lang-ja">トップ</span>
                </a>

                <a href="#services">
                    <span class="lang-en">Services</span>
                    <span class="lang-ja">サービス</span>
                </a>

                <a href="#company">
                    <span class="lang-en">Company Profile</span>
                    <span class="lang-ja">会社概要</span>
                </a>

                <a href="#contact">
                    <span class="lang-en">Inquiry</span>
                    <span class="lang-ja">お問い合わせ</span>
                </a>

                <a href="{{ route('admin.dashboard') }}" class="admin-link-btn" title="Admin Control Panel" style="font-weight: 600; color: #0f4c81; background: #f0fdf4; border: 1px solid #bbf7d0; padding: 5px 10px; border-radius: 6px; font-size: 13px;">
                    ⚙️ <span class="lang-en">Admin</span><span class="lang-ja">管理</span>
                </a>
            </nav>

            <div class="language-switcher">
                <button id="enBtn"
                        class="lang-btn active"
                        onclick="setLanguage('en')">
                    EN
                </button>

                <button id="jaBtn"
                        class="lang-btn"
                        onclick="setLanguage('ja')">
                    日本語
                </button>
            </div>

            <a href="tel:{{ $company->phone ?? '042-409-8256' }}" class="phone-btn">
                📞 {{ $company->phone ?? '042-409-8256' }}
            </a>

        </div>
    </div>
</header>
