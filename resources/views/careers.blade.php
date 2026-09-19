<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>自社採用情報・求人一覧 | {{ $company->name_ja ?? 'MIRANSH合同会社' }} (MIRANSH LLC)</title>
    <meta name="description" content="MIRANSH合同会社 本社（東京都小金井市）の自社採用情報・求人一覧です。海外人材コーディネーター、通訳・翻訳、一般事務・経理補助など、日本と世界をつなぐ熱意ある仲間を募集しています。">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://miransh.co.jp/careers">

    <!-- Open Graph Protocol -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://miransh.co.jp/careers">
    <meta property="og:title" content="自社採用情報・求人一覧 | MIRANSH合同会社 本社">
    <meta property="og:description" content="MIRANSH合同会社 本社の直接雇用求人情報。海外人材コーディネーター、バックオフィス総合職を募集中。">
    <meta property="og:image" content="https://miransh.co.jp/images/logo-icon.png">
    <meta property="og:site_name" content="MIRANSH合同会社 (MIRANSH LLC)">
    <meta property="og:locale" content="ja_JP">

    <link rel="stylesheet" href="/css/app.css">
    <link rel="icon" type="image/png" href="/images/logo-icon.png">
    <style>
        .careers-hero {
            background: linear-gradient(135deg, #0F172A 0%, #1E293B 100%);
            color: #FFFFFF;
            padding: 60px 0;
            border-bottom: 1px solid #334155;
        }
        .career-card-hover:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 24px -6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="ja">

    <!-- Header -->
    <header>
        <div class="container navbar">
            <a href="/" class="brand-wrapper">
                <img src="/images/logo-icon.png" alt="MIRANSH LLC" class="brand-logo-img">
                <div>
                    <div class="brand-title">
                        <span class="lang-ja">{{ $company->name_ja ?? 'MIRANSH合同会社' }}</span>
                        <span class="lang-en">{{ $company->name_en ?? 'MIRANSH LLC' }}</span>
                    </div>
                    <div class="brand-subtitle">
                        <span class="lang-ja">ミランス合同会社 | 国際人材ソリューション</span>
                        <span class="lang-en">Global Talent & Corporate Bridge</span>
                    </div>
                </div>
            </a>

            <ul class="nav-links">
                <li><a href="/#about" class="nav-link"><span class="lang-ja">会社紹介</span><span class="lang-en">About</span></a></li>
                <li><a href="/#services" class="nav-link"><span class="lang-ja">事業内容</span><span class="lang-en">Services</span></a></li>
                <li><a href="/#strengths" class="nav-link"><span class="lang-ja">当社の強み</span><span class="lang-en">Strengths</span></a></li>
                <li><a href="/#stories" class="nav-link"><span class="lang-ja">採用事例</span><span class="lang-en">Stories</span></a></li>
                <li><a href="/careers" class="nav-link active" style="color: #0E7490; font-weight: 700;"><span class="lang-ja">自社採用</span><span class="lang-en">Careers</span></a></li>
                <li><a href="/#contact" class="nav-link"><span class="lang-ja">お問い合わせ</span><span class="lang-en">Contact</span></a></li>
            </ul>

            <div class="nav-right-actions">
                <div class="lang-toggle-group">
                    <button type="button" class="lang-btn active" id="btn-lang-ja" onclick="setLanguage('ja')">日本語</button>
                    <button type="button" class="lang-btn" id="btn-lang-en" onclick="setLanguage('en')">EN</button>
                </div>
                <a href="#vacancies-list" class="btn-header-cta">
                    <span class="lang-ja">求人を見る</span>
                    <span class="lang-en">View Jobs</span>
                </a>
            </div>
        </div>
    </header>

    <!-- Careers Hero Header -->
    <div class="careers-hero">
        <div class="container">
            <div style="max-width: 800px;">
                <div style="display: inline-flex; align-items: center; gap: 8px; background: rgba(14, 116, 144, 0.25); border: 1px solid rgba(14, 116, 144, 0.5); padding: 4px 14px; border-radius: 9999px; font-size: 13px; font-weight: 700; color: #38BDF8; margin-bottom: 16px;">
                    <span>💼</span>
                    <span class="lang-ja">MIRANSH合同会社 本社 採用ポータル</span>
                    <span class="lang-en">MIRANSH HQ Career Portal</span>
                </div>
                <h1 style="font-size: 32px; font-weight: 900; line-height: 1.3; margin: 0 0 16px 0; color: #FFFFFF;">
                    <span class="lang-ja">日本と世界をつなぐ架け橋を、<br>私たちと共に築きませんか？</span>
                    <span class="lang-en">Bridge Japan and the World.<br>Join the MIRANSH Team.</span>
                </h1>
                <p style="font-size: 16px; color: #CBD5E1; line-height: 1.7; margin: 0 0 24px 0;">
                    <span class="lang-ja">MIRANSH合同会社では、東京本社（小金井市）において、外国人材の募集・面接調整、在留資格申請支援、通訳・翻訳、バックオフィス業務を担う新たな仲間を募集しています。</span>
                    <span class="lang-en">We are hiring coordinators and administrative specialists at our Tokyo headquarters to support global candidates and Japanese enterprises through every step of recruitment and integration.</span>
                </p>
                <div style="display: inline-flex; align-items: center; gap: 8px; background: #FEF3C7; border: 1px solid #F59E0B; padding: 8px 16px; border-radius: 8px; font-size: 13px; color: #92400E; font-weight: 600;">
                    <span>⚠️</span>
                    <span class="lang-ja">【重要】掲載中の求人はすべてMIRANSH合同会社 本社の直接雇用求人です（他社への派遣・紹介求人ではありません）。</span>
                    <span class="lang-en">All listings here represent direct internal hiring at MIRANSH LLC Tokyo Headquarters.</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter & Search Bar -->
    <div style="background: #FFFFFF; border-bottom: 1px solid #E2E8F0; padding: 20px 0;">
        <div class="container">
            <form method="GET" action="/careers" style="display: flex; flex-wrap: wrap; gap: 16px; align-items: center; justify-content: space-between;">
                <div style="display: flex; flex-wrap: wrap; gap: 8px; align-items: center;">
                    <a href="/careers" class="btn-sm {{ !request()->filled('type') ? 'btn-primary' : 'btn-outline' }}" style="text-decoration: none; padding: 6px 16px; font-size: 13px;">
                        <span class="lang-ja">すべての雇用形態</span>
                        <span class="lang-en">All Types</span>
                    </a>
                    <a href="/careers?type=full_time" class="btn-sm {{ request()->query('type') === 'full_time' ? 'btn-primary' : 'btn-outline' }}" style="text-decoration: none; padding: 6px 16px; font-size: 13px;">
                        <span class="lang-ja">正社員</span>
                        <span class="lang-en">Full-time</span>
                    </a>
                    <a href="/careers?type=contract" class="btn-sm {{ request()->query('type') === 'contract' ? 'btn-primary' : 'btn-outline' }}" style="text-decoration: none; padding: 6px 16px; font-size: 13px;">
                        <span class="lang-ja">契約社員</span>
                        <span class="lang-en">Contract</span>
                    </a>
                    <a href="/careers?type=part_time" class="btn-sm {{ request()->query('type') === 'part_time' ? 'btn-primary' : 'btn-outline' }}" style="text-decoration: none; padding: 6px 16px; font-size: 13px;">
                        <span class="lang-ja">パート・アルバイト</span>
                        <span class="lang-en">Part-time</span>
                    </a>
                </div>

                <div style="display: flex; gap: 8px; min-width: 280px;">
                    <input type="text" name="q" value="{{ request()->query('q') }}" placeholder="職種・キーワードで検索..." style="flex: 1; padding: 8px 12px; border: 1px solid #CBD5E1; border-radius: 6px; font-size: 13px;">
                    <button type="submit" class="btn-primary" style="padding: 8px 16px; font-size: 13px;">検索</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Vacancies List Section -->
    <section id="vacancies-list" class="section" style="background: #F8FAFC; padding: 48px 0;">
        <div class="container">
            <div style="display: flex; justify-content: space-between; align-items: baseline; margin-bottom: 24px;">
                <h2 style="font-size: 22px; font-weight: 800; color: #0F172A; margin: 0;">
                    <span class="lang-ja">現在募集中の求人一覧</span>
                    <span class="lang-en">Active Open Positions</span>
                    <span style="font-size: 14px; font-weight: 600; color: #0E7490; margin-left: 8px;">({{ $vacancies->count() }}件)</span>
                </h2>
                <a href="/" style="font-size: 13px; color: #64748B; text-decoration: none;">← トップページに戻る</a>
            </div>

            @if($vacancies->isEmpty())
                <div style="background: #FFFFFF; border: 1px solid #E2E8F0; border-radius: 12px; padding: 60px 20px; text-align: center;">
                    <div style="font-size: 48px; margin-bottom: 16px;">💼</div>
                    <h3 style="font-size: 18px; font-weight: 800; color: #0F172A; margin: 0 0 8px 0;">現在条件に一致する求人はございません</h3>
                    <p style="font-size: 14px; color: #64748B; margin-bottom: 20px;">条件を変更して再検索いただくか、オープンポジションとしてお問い合わせください。</p>
                    <a href="/#contact" class="btn-primary" style="text-decoration: none;">採用に関するお問い合わせ</a>
                </div>
            @else
                <div style="display: grid; gap: 24px;">
                    @foreach($vacancies as $v)
                        @php
                            $salaryText = '';
                            if ($v->salary_min && $v->salary_max) {
                                $salaryText = '月給 ' . number_format($v->salary_min) . '円 〜 ' . number_format($v->salary_max) . '円';
                            } else if ($v->salary_min) {
                                $salaryText = '月給 ' . number_format($v->salary_min) . '円〜';
                            } else if (!empty($v->salary_note_ja)) {
                                $salaryText = $v->salary_note_ja;
                            }
                        @endphp
                        <div class="career-card-hover" style="background: #FFFFFF; border: 1px solid #CBD5E1; border-radius: 12px; padding: 28px; box-shadow: 0 2px 4px rgba(0,0,0,0.02); transition: all 0.2s ease;">
                            <div style="display: flex; flex-wrap: wrap; justify-content: space-between; align-items: flex-start; gap: 16px; margin-bottom: 16px;">
                                <div>
                                    <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 8px;">
                                        <span style="font-family: monospace; font-size: 12px; font-weight: 700; background: #0F172A; color: #FFFFFF; padding: 3px 8px; border-radius: 4px;">{{ $v->job_code }}</span>
                                        <span style="font-size: 12px; font-weight: 700; background: #0E7490; color: #FFFFFF; padding: 3px 10px; border-radius: 9999px;">
                                            @if($v->employment_type === 'full_time') 正社員 / Full-time
                                            @elseif($v->employment_type === 'contract') 契約社員 / Contract
                                            @elseif($v->employment_type === 'part_time') パート・アルバイト / Part-time
                                            @else インターン / Internship @endif
                                        </span>
                                    </div>
                                    <h3 style="font-size: 22px; font-weight: 800; margin: 0 0 6px 0;">
                                        <a href="/careers/{{ $v->job_code }}" style="color: #0F172A; text-decoration: none;">{{ $v->title_ja }}</a>
                                    </h3>
                                    <div style="font-size: 14px; color: #64748B; font-weight: 500;">{{ $v->title_en }}</div>
                                </div>

                                <div style="text-align: right;">
                                    <div style="font-size: 12px; color: #047857; font-weight: 700;">想定給与</div>
                                    <div style="font-size: 20px; font-weight: 800; color: #0F172A;">{{ $salaryText ?: '経験・能力に応ず' }}</div>
                                </div>
                            </div>

                            <!-- Details Grid -->
                            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 12px; background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 14px 18px; margin-bottom: 20px; font-size: 13px;">
                                <div>
                                    <strong>📍 勤務地:</strong> {{ $v->location_ja }}
                                </div>
                                <div>
                                    <strong>🕒 勤務時間:</strong> {{ $v->working_hours_ja ?: '9:00〜18:00 (実働8h)' }}
                                </div>
                                <div>
                                    <strong>🏖️ 休日:</strong> {{ $v->holidays_ja ?: '完全週休2日制（土日祝）' }}
                                </div>
                            </div>

                            <!-- Responsibilities & Requirements tags -->
                            @if($v->responsibilities && $v->responsibilities->count() > 0)
                                <div style="margin-bottom: 16px;">
                                    <strong style="font-size: 13px; color: #1E293B;">主な担当業務:</strong>
                                    <div style="display: flex; gap: 8px; flex-wrap: wrap; margin-top: 6px;">
                                        @foreach($v->responsibilities as $r)
                                            <span style="font-size: 12px; background: #EFF6FF; color: #1E40AF; border: 1px solid #DBEAFE; padding: 3px 10px; border-radius: 4px; font-weight: 600;">
                                                {{ $r->title_ja }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <div style="display: flex; justify-content: flex-end; gap: 12px; border-top: 1px solid #F1F5F9; padding-top: 16px;">
                                <a href="/careers/{{ $v->job_code }}" class="btn-primary" style="text-decoration: none; padding: 10px 24px; font-size: 14px;">
                                    募集要項・詳細を見る →
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container footer-bottom">
            <div>&copy; {{ date('Y') }} MIRANSH合同会社 (MIRANSH LLC). All Rights Reserved.</div>
            <div style="font-size: 12px; color: #64748B; margin-top: 6px;">有料職業紹介事業許可：13-ユ-319558 | 東京都小金井市東町4丁目8番14号</div>
        </div>
    </footer>

    <script src="/js/app.js"></script>
</body>
</html>
