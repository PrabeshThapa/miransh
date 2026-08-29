<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $company->name_ja ?? 'MIRANSH合同会社' }} | {{ $company->tagline_ja ?? '日本企業と海外人材をつなぐ、信頼の架け橋' }}</title>
    <meta name="description" content="MIRANSH合同会社（ミランス）は、日本企業とネパールをはじめとする海外人材をつなぐ総合人材サービス企業です。特定技能外国人材の採用支援、在留資格手続き、生活・就労サポートを提供します。">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🏢</text></svg>">
</head>
<body class="ja">

    <!-- HEADER & NAVIGATION -->
    <header>
        <div class="container navbar">
            <a href="/" class="brand-wrapper">
                <div class="brand-icon">M</div>
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
                <li><a href="#about" class="nav-link"><span class="lang-ja">会社紹介</span><span class="lang-en">About</span></a></li>
                <li><a href="#services" class="nav-link"><span class="lang-ja">事業内容</span><span class="lang-en">Services</span></a></li>
                <li><a href="#strengths" class="nav-link"><span class="lang-ja">当社の強み</span><span class="lang-en">Strengths</span></a></li>
                <li><a href="#industries" class="nav-link"><span class="lang-ja">対応分野</span><span class="lang-en">Industries</span></a></li>
                <li><a href="#stories" class="nav-link"><span class="lang-ja">採用事例</span><span class="lang-en">Stories</span></a></li>
                <li><a href="#company" class="nav-link"><span class="lang-ja">会社概要</span><span class="lang-en">Profile</span></a></li>
                <li><a href="#vision" class="nav-link"><span class="lang-ja">代表挨拶</span><span class="lang-en">Message</span></a></li>
            </ul>

            <div class="nav-right-actions">
                <div class="lang-toggle-group">
                    <button type="button" class="lang-btn active" id="btn-lang-ja" onclick="setLanguage('ja')">日本語</button>
                    <button type="button" class="lang-btn" id="btn-lang-en" onclick="setLanguage('en')">EN</button>
                </div>
                <a href="#contact" class="btn-header-cta">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    <span class="lang-ja">お問い合わせ</span>
                    <span class="lang-en">Contact Us</span>
                </a>
            </div>
        </div>
    </header>

    <!-- HERO SECTION -->
    <section class="hero-section">
        <div class="container hero-grid">
            <div class="hero-content">
                <div class="hero-badge">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    <span>{{ $company->license ?? '有料職業紹介事業許可：13-ユ-319558' }}</span>
                </div>

                <h1 class="hero-title">
                    <span class="lang-ja">
                        {{ $company->hero_title_ja ?? '日本企業と海外人材をつなぐ、' }}
                        <span class="hero-title-accent">{{ $company->hero_title_accent_ja ?? '信頼の架け橋。' }}</span>
                    </span>
                    <span class="lang-en">
                        {{ $company->hero_title_en ?? 'Bridging Japanese Enterprises and' }}
                        <span class="hero-title-accent">{{ $company->hero_title_accent_en ?? 'Global Talent with Trust.' }}</span>
                    </span>
                </h1>

                <p class="hero-desc">
                    <span class="lang-ja">{{ $company->hero_desc_ja ?? '外国人材の採用から入国・就労、入社後の生活サポートまで、双方に寄り添うトータル人材ソリューション。' }}</span>
                    <span class="lang-en">{{ $company->hero_desc_en ?? 'Comprehensive recruitment solutions—from overseas hiring, visa procedures, and orientation to long-term post-employment support.' }}</span>
                </p>

                <div class="hero-actions">
                    <a href="#contact" class="btn-primary">
                        <span class="lang-ja">無料相談・お問い合わせ</span>
                        <span class="lang-en">Inquire / Free Consultation</span>
                        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                    <a href="#services" class="btn-outline-white">
                        <span class="lang-ja">事業案内を見る</span>
                        <span class="lang-en">Explore Services</span>
                    </a>
                </div>

                <div class="hero-stats-row">
                    <div>
                        <div class="stat-item-num">100%</div>
                        <div class="stat-item-label"><span class="lang-ja">在留資格・法令遵守</span><span class="lang-en">Compliance Assured</span></div>
                    </div>
                    <div>
                        <div class="stat-item-num">ワンストップ</div>
                        <div class="stat-item-label"><span class="lang-ja">採用から入社後生活支援まで</span><span class="lang-en">End-to-End Support</span></div>
                    </div>
                    <div>
                        <div class="stat-item-num">ネパール直結</div>
                        <div class="stat-item-label"><span class="lang-ja">現地提携教育機関ネットワーク</span><span class="lang-en">Direct Academic Network</span></div>
                    </div>
                </div>
            </div>

            <div class="hero-image-wrapper">
                <div class="hero-image-card">
                    <img src="{{ $company->hero_image ?? '/images/hero_banner.jpg' }}" alt="MIRANSH Global Talent Support">
                </div>
                <div class="hero-floating-badge">
                    <div class="badge-icon-box">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <div>
                        <div style="font-size: 11px; color: var(--text-light); font-weight: 600;"><span class="lang-ja">厚生労働大臣許可</span><span class="lang-en">MHLW Certified</span></div>
                        <div style="font-size: 13px; font-weight: 800; color: var(--primary);">13-ユ-319558</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ABOUT US SECTION -->
    <section id="about" class="section section-bg-light">
        <div class="container">
            <div class="about-grid">
                <div>
                    <span class="section-badge"><span class="lang-ja">{{ $about->badge_ja ?? 'MIRANSH合同会社について' }}</span><span class="lang-en">{{ $about->badge_en ?? 'About MIRANSH LLC' }}</span></span>
                    <h2 class="section-title">
                        <span class="lang-ja">{{ $about->heading_ja ?? '日本企業と海外人材をつなぎ、採用から定着までを伴走支援' }}</span>
                        <span class="lang-en">{{ $about->heading_en ?? 'Bridging Japanese Enterprises & International Talent with Complete Lifecycle Support' }}</span>
                    </h2>
                    <p class="about-text-lead">
                        <span class="lang-ja">{{ $about->subheading_ja ?? '日本で働きたい外国人材と、信頼できる人材を求める日本企業双方に寄り添うトータルサポート。' }}</span>
                        <span class="lang-en">{{ $about->subheading_en ?? 'Supporting people who want to work, grow, and build their future in Japan.' }}</span>
                    </p>
                    <p class="about-text-body">
                        <span class="lang-ja">{{ $about->desc1_ja }}</span>
                        <span class="lang-en">{{ $about->desc1_en }}</span>
                    </p>
                    <p class="about-text-body">
                        <span class="lang-ja">{{ $about->desc2_ja }}</span>
                        <span class="lang-en">{{ $about->desc2_en }}</span>
                    </p>

                    <div class="about-quote-box">
                        <div class="about-quote-text">
                            <span class="lang-ja">{{ $about->quote_ja }}</span>
                            <span class="lang-en">{{ $about->quote_en }}</span>
                        </div>
                    </div>
                </div>

                <div>
                    <!-- 7-Stage Visual Lifecycle Track -->
                    <div class="lifecycle-track">
                        <div class="lifecycle-track-title">
                            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                            <span class="lang-ja">受入・定着の7段階トータルサポート</span>
                            <span class="lang-en">7-Stage Lifecycle Onboarding & Retention</span>
                        </div>
                        <div class="lifecycle-steps" style="grid-template-columns: repeat(1, 1fr); gap: 10px;">
                            <div class="pipeline-step-item">
                                <div class="pipeline-step-badge">1</div>
                                <div class="pipeline-step-text"><span class="lang-ja">採用前ヒアリング・求人要件設定</span><span class="lang-en">Pre-recruitment Needs Assessment</span></div>
                            </div>
                            <div class="pipeline-step-item">
                                <div class="pipeline-step-badge">2</div>
                                <div class="pipeline-step-text"><span class="lang-ja">現地厳選・Web面接調整・通訳同席</span><span class="lang-en">Interviews & Candidate Sourcing</span></div>
                            </div>
                            <div class="pipeline-step-item">
                                <div class="pipeline-step-badge">3</div>
                                <div class="pipeline-step-text"><span class="lang-ja">内定通知・雇用契約締結フォロー</span><span class="lang-en">Job Offers & Pre-contract Confirmation</span></div>
                            </div>
                            <div class="pipeline-step-item">
                                <div class="pipeline-step-badge">4</div>
                                <div class="pipeline-step-text"><span class="lang-ja">在留資格認定証明書（COE）申請支援</span><span class="lang-en">Status of Residence (Visa/COE) Processing</span></div>
                            </div>
                            <div class="pipeline-step-item">
                                <div class="pipeline-step-badge">5</div>
                                <div class="pipeline-step-text"><span class="lang-ja">渡航前オリエンテーション・日本語研修</span><span class="lang-en">Pre-departure Training & Travel Prep</span></div>
                            </div>
                            <div class="pipeline-step-item">
                                <div class="pipeline-step-badge">6</div>
                                <div class="pipeline-step-text"><span class="lang-ja">入国時空港出迎え・行政手続・入社</span><span class="lang-en">Arrival Logistics & Workplace Onboarding</span></div>
                            </div>
                            <div class="pipeline-step-item">
                                <div class="pipeline-step-badge">7</div>
                                <div class="pipeline-step-text"><span class="lang-ja">入社後の定期生活面談・職場定着フォロー</span><span class="lang-en">Continuous Post-employment & Living Follow-up</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CORE SERVICES SECTION -->
    <section id="services" class="section">
        <div class="container">
            <div class="section-header">
                <span class="section-badge"><span class="lang-ja">事業内容</span><span class="lang-en">Core Services</span></span>
                <h2 class="section-title">
                    <span class="lang-ja">企業のニーズに寄り添うトータル人材ソリューション</span>
                    <span class="lang-en">Comprehensive Solutions for Enterprises & Global Talent</span>
                </h2>
                <p class="section-subtitle">
                    <span class="lang-ja">採用計画の立案から、入国時のビザ申請、職場定着、日々の生活支援まで、専門チームが一貫してサポートいたします。</span>
                    <span class="lang-en">From strategic talent sourcing and visa processing to workplace integration and retention counseling.</span>
                </p>
            </div>

            <div class="services-grid">
                @foreach ($services as $service)
                <div class="service-card">
                    <div class="service-card-header">
                        <span class="service-num-badge">{{ $service->number_label ?? '01' }}</span>
                        <div class="service-icon-box">
                            @if ($service->icon === 'users')
                                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                            @elseif ($service->icon === 'award')
                                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                            @elseif ($service->icon === 'heart-handshake')
                                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                            @else
                                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            @endif
                        </div>
                    </div>

                    <div class="service-card-body">
                        <h3 class="service-title">
                            <span class="lang-ja">{{ $service->title_ja }}</span>
                            <span class="lang-en">{{ $service->title_en }}</span>
                        </h3>
                        @if ($service->subtitle_ja || $service->subtitle_en)
                        <div class="service-subtitle">
                            <span class="lang-ja">{{ $service->subtitle_ja }}</span>
                            <span class="lang-en">{{ $service->subtitle_en }}</span>
                        </div>
                        @endif

                        <p class="service-desc">
                            <span class="lang-ja">{{ $service->desc_ja }}</span>
                            <span class="lang-en">{{ $service->desc_en }}</span>
                        </p>

                        @if (!empty($service->items_ja))
                        <ul class="service-items-list lang-ja">
                            @foreach ($service->items_ja as $item)
                            <li class="service-item-li">
                                <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                <span>{{ $item }}</span>
                            </li>
                            @endforeach
                        </ul>
                        @endif

                        @if (!empty($service->items_en))
                        <ul class="service-items-list lang-en">
                            @foreach ($service->items_en as $item)
                            <li class="service-item-li">
                                <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                <span>{{ $item }}</span>
                            </li>
                            @endforeach
                        </ul>
                        @endif

                        <div class="service-card-footer">
                            <a href="/services/{{ $service->id }}" class="btn-service-detail">
                                <span class="lang-ja">詳細・サポート手順を見る</span>
                                <span class="lang-en">View Service Details & Workflow</span>
                                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- STRENGTHS SECTION -->
    <section id="strengths" class="section section-bg-light">
        <div class="container">
            <div class="strengths-callout">
                <span class="section-badge" style="background: rgba(255,255,255,0.15); color: #FCD34D;">
                    <span class="lang-ja">MIRANSHの強み</span>
                    <span class="lang-en">Our Strengths</span>
                </span>
                <h2 class="strengths-tagline">
                    <span class="lang-ja">{{ $company->strengths_tagline_ja ?? '人材紹介だけで終わらない、手厚い継続サポート' }}</span>
                    <span class="lang-en">{{ $company->strengths_tagline_en ?? 'Beyond Recruitment — Continuous, High-Touch Support' }}</span>
                </h2>
                <p class="strengths-lead">
                    <span class="lang-ja">{{ $company->strengths_desc_ja }}</span>
                    <span class="lang-en">{{ $company->strengths_desc_en }}</span>
                </p>

                <div class="strengths-pillars-grid">
                    <div class="strength-pillar-card">
                        <div class="strength-pillar-icon">
                            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                        </div>
                        <h4 class="strength-pillar-title"><span class="lang-ja">多言語対応・生活相談</span><span class="lang-en">Multilingual Counseling</span></h4>
                        <p class="strength-pillar-desc"><span class="lang-ja">ネパール語・英語・日本語による母国語サポートで、候補者の不安を解消。</span><span class="lang-en">Direct mother-tongue assistance in Nepali, English & Japanese.</span></p>
                    </div>

                    <div class="strength-pillar-card">
                        <div class="strength-pillar-icon">
                            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                        </div>
                        <h4 class="strength-pillar-title"><span class="lang-ja">在留資格・手続の徹底</span><span class="lang-en">Visa & Legal Accuracy</span></h4>
                        <p class="strength-pillar-desc"><span class="lang-ja">特定技能の入管申請書類作成から入国準備まで、ミスなく迅速に進めます。</span><span class="lang-en">Thorough document preparation for Status of Residence / SSW with full compliance.</span></p>
                    </div>

                    <div class="strength-pillar-card">
                        <div class="strength-pillar-icon">
                            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        </div>
                        <h4 class="strength-pillar-title"><span class="lang-ja">現地提携校との連携</span><span class="lang-en">Direct Academic Network</span></h4>
                        <p class="strength-pillar-desc"><span class="lang-ja">ネパール優良校と直結し、意欲が高く日本語を学んだ優秀層を厳選。</span><span class="lang-en">Direct alliances with leading colleges in Nepal for screened, highly motivated talent.</span></p>
                    </div>

                    <div class="strength-pillar-card">
                        <div class="strength-pillar-icon">
                            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                        </div>
                        <h4 class="strength-pillar-title"><span class="lang-ja">入社後の職場定着支援</span><span class="lang-en">Post-Hire Retention</span></h4>
                        <p class="strength-pillar-desc"><span class="lang-ja">定期的なヒアリングと企業様との連携により、早期離職を防ぎます。</span><span class="lang-en">Continuous liaison with employers and monthly check-ins to ensure lasting tenure.</span></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- INDUSTRIES COVERED -->
    <section id="industries" class="section">
        <div class="container">
            <div class="section-header">
                <span class="section-badge"><span class="lang-ja">対応分野</span><span class="lang-en">Industries We Serve</span></span>
                <h2 class="section-title">
                    <span class="lang-ja">対応可能な産業分野</span>
                    <span class="lang-en">Specialized Industry Sectors</span>
                </h2>
                <p class="section-subtitle">
                    <span class="lang-ja">日本の労働力不足が顕著な特定技能主要分野をはじめ、幅広い業界に対応しています。</span>
                    <span class="lang-en">Addressing critical labor shortages in key Specified Skilled Worker sectors across Japan.</span>
                </p>
            </div>

            <div class="industries-grid">
                <div class="industry-card">
                    <div class="industry-emoji-icon">🩺</div>
                    <h3 class="industry-name"><span class="lang-ja">介護分野</span><span class="lang-en">Nursing Care</span></h3>
                    <div class="industry-en-tag">Caregiving / SSW</div>
                    <p style="font-size: 13px; color: var(--text-muted); line-height: 1.6;">
                        <span class="lang-ja">高齢者施設・デイサービス等における身体介助・生活支援。専門用語教育済み。</span>
                        <span class="lang-en">Elderly welfare facilities & daily care support with specialized medical terminology training.</span>
                    </p>
                </div>

                <div class="industry-card">
                    <div class="industry-emoji-icon">🏗️</div>
                    <h3 class="industry-name"><span class="lang-ja">建設分野</span><span class="lang-en">Construction</span></h3>
                    <div class="industry-en-tag">Construction & Engineering</div>
                    <p style="font-size: 13px; color: var(--text-muted); line-height: 1.6;">
                        <span class="lang-ja">型枠・鉄筋・内装仕上げ・土木工事など、現場の即戦力となる体力と熱意ある人材。</span>
                        <span class="lang-en">Formwork, rebar, interior finishing, and civil engineering with safety training.</span>
                    </p>
                </div>

                <div class="industry-card">
                    <div class="industry-emoji-icon">🧹</div>
                    <h3 class="industry-name"><span class="lang-ja">ビルクリーニング・清掃</span><span class="lang-en">Building Cleaning</span></h3>
                    <div class="industry-en-tag">Facility Maintenance</div>
                    <p style="font-size: 13px; color: var(--text-muted); line-height: 1.6;">
                        <span class="lang-ja">商業施設・オフィスビル・ホテルの環境衛生維持。日本の衛生基準を徹底研修。</span>
                        <span class="lang-en">Commercial facilities, office buildings, and hotels adhering to Japanese hygiene protocols.</span>
                    </p>
                </div>

                <div class="industry-card">
                    <div class="industry-emoji-icon">🌐</div>
                    <h3 class="industry-name"><span class="lang-ja">その他特定技能分野</span><span class="lang-en">Other SSW Sectors</span></h3>
                    <div class="industry-en-tag">Food, Logistics & Manufacturing</div>
                    <p style="font-size: 13px; color: var(--text-muted); line-height: 1.6;">
                        <span class="lang-ja">外食業・飲食料品製造業・農業・宿泊業など、特定技能制度対象職種に対応。</span>
                        <span class="lang-en">Food service, food manufacturing, agriculture, and hospitality under SSW program.</span>
                    </p>
                </div>
            </div>

            <div class="industry-note-box">
                <span class="lang-ja">※ 対応可能な在留資格・職種・国籍については、受入企業の条件に合わせて個別にご相談いただけます。</span>
                <span class="lang-en">* Eligible visa types, job categories, and qualifications can be tailored based on corporate hiring needs.</span>
            </div>
        </div>
    </section>

    <!-- COMMITMENTS -->
    <section class="section section-bg-light">
        <div class="container">
            <div class="section-header">
                <span class="section-badge"><span class="lang-ja">企業様へのお約束</span><span class="lang-en">Our Guiding Principles</span></span>
                <h2 class="section-title">
                    <span class="lang-ja">MIRANSHが大切にしている3つの価値</span>
                    <span class="lang-en">Three Pillars of Our Commitment</span>
                </h2>
            </div>

            <div class="commitments-grid">
                <div class="commitment-card">
                    <div class="commitment-icon-box">
                        <svg width="28" height="28" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <h3 class="commitment-title"><span class="lang-ja">信頼 (Trust)</span><span class="lang-en">Trust & Transparency</span></h3>
                    <p class="commitment-desc">
                        <span class="lang-ja">法令遵守を徹底し、企業様と外国人材の双方が納得できる透明性の高いマッチングを約束します。</span>
                        <span class="lang-en">Strict compliance with Japanese labor and immigration laws, ensuring transparent, honest partnerships.</span>
                    </p>
                </div>

                <div class="commitment-card">
                    <div class="commitment-icon-box">
                        <svg width="28" height="28" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    </div>
                    <h3 class="commitment-title"><span class="lang-ja">安心 (Peace of Mind)</span><span class="lang-en">Peace of Mind</span></h3>
                    <p class="commitment-desc">
                        <span class="lang-ja">入国手続きから生活面の不安解消まで、母国語サポートを含む手厚いフォローで安心をお届けします。</span>
                        <span class="lang-en">End-to-end guidance from visa documentation to daily life counseling in the candidate's native tongue.</span>
                    </p>
                </div>

                <div class="commitment-card">
                    <div class="commitment-icon-box">
                        <svg width="28" height="28" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                    </div>
                    <h3 class="commitment-title"><span class="lang-ja">長期的な関係 (Partnership)</span><span class="lang-en">Long-Term Growth</span></h3>
                    <p class="commitment-desc">
                        <span class="lang-ja">一過性の紹介ではなく、企業様の事業発展と外国人材の日本でのキャリア形成を長く支え続けます。</span>
                        <span class="lang-en">Fostering lasting bonds that drive sustainable business growth and fulfilling careers in Japan.</span>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- STORIES / CASE STUDIES SECTION -->
    <section id="stories" class="section">
        <div class="container">
            <div class="section-header">
                <span class="section-badge"><span class="lang-ja">採用事例・ニュース</span><span class="lang-en">Stories & News</span></span>
                <h2 class="section-title">
                    <span class="lang-ja">採用・定着の成功ストーリー</span>
                    <span class="lang-en">Real-World Placement & Integration Stories</span>
                </h2>
                <p class="section-subtitle">
                    <span class="lang-ja">MIRANSHがサポートした企業様と外国人材の実際の事例をご紹介します。</span>
                    <span class="lang-en">Explore recent placements, onboarding journeys, and pre-departure programs.</span>
                </p>
            </div>

            <div class="stories-grid">
                @foreach ($stories as $story)
                <div class="story-card">
                    <div class="story-card-image">
                        <img src="{{ $story->image ?? '/images/story1.jpg' }}" alt="{{ $story->title_ja }}">
                        <span class="story-category-tag">
                            <span class="lang-ja">{{ $story->category_ja }}</span>
                            <span class="lang-en">{{ $story->category_en }}</span>
                        </span>
                    </div>
                    <div class="story-card-body">
                        <div class="story-date">{{ $story->published_date ?? '2024.11.20' }}</div>
                        <h3 class="story-title">
                            <span class="lang-ja">{{ $story->title_ja }}</span>
                            <span class="lang-en">{{ $story->title_en }}</span>
                        </h3>
                        <p class="story-summary">
                            <span class="lang-ja">{{ $story->summary_ja }}</span>
                            <span class="lang-en">{{ $story->summary_en }}</span>
                        </p>
                        <a href="/stories/{{ $story->id }}" class="story-read-link">
                            <span class="lang-ja">記事全文を読む →</span>
                            <span class="lang-en">Read Full Story →</span>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- COMPANY PROFILE & GOOGLE MAP -->
    <section id="company" class="section section-bg-light">
        <div class="container">
            <div class="section-header">
                <span class="section-badge"><span class="lang-ja">会社概要</span><span class="lang-en">Corporate Profile</span></span>
                <h2 class="section-title">
                    <span class="lang-ja">MIRANSH合同会社 企業概要</span>
                    <span class="lang-en">MIRANSH LLC Profile & Location</span>
                </h2>
            </div>

            <div class="company-profile-wrapper">
                <div>
                    <table class="profile-table">
                        <tbody>
                            <tr>
                                <th><span class="lang-ja">会社名</span><span class="lang-en">Company Name</span></th>
                                <td>
                                    <strong><span class="lang-ja">{{ $company->name_ja ?? 'MIRANSH合同会社（ミランス合同会社）' }}</span></strong>
                                    <br>
                                    <span class="lang-en" style="color: var(--text-light);">{{ $company->name_en ?? 'MIRANSH LLC (MIRANSH Godo Kaisha)' }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th><span class="lang-ja">法人番号</span><span class="lang-en">Corporate Number</span></th>
                                <td><code>{{ $company->corporate_number ?? '5012403006691' }}</code></td>
                            </tr>
                            <tr>
                                <th><span class="lang-ja">許認可番号</span><span class="lang-en">License Number</span></th>
                                <td>
                                    <span style="display: inline-block; background: #EFF6FF; color: #1D4ED8; font-weight: 700; padding: 2px 8px; border-radius: 4px;">
                                        {{ $company->license ?? '有料職業紹介事業許可：13-ユ-319558' }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th><span class="lang-ja">本店所在地</span><span class="lang-en">Headquarters</span></th>
                                <td>
                                    <span class="lang-ja">{{ $company->address_ja }}</span>
                                    <span class="lang-en">{{ $company->address_en }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th><span class="lang-ja">法人形態</span><span class="lang-en">Corporate Form</span></th>
                                <td>
                                    <span class="lang-ja">{{ $company->corporate_form_ja ?? '合同会社' }}</span>
                                    <span class="lang-en">{{ $company->corporate_form_en ?? 'Limited Liability Company (LLC)' }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th><span class="lang-ja">設立・法人番号指定</span><span class="lang-en">Established</span></th>
                                <td>
                                    <span class="lang-ja">{{ $company->established_ja }}</span>
                                    <span class="lang-en">{{ $company->established_en }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th><span class="lang-ja">代表者</span><span class="lang-en">Executive</span></th>
                                <td>
                                    <span class="lang-ja">{{ $company->ceo_role_ja ?? '代表社員' }}：{{ $company->ceo_name ?? 'ギリ ラム クリシュナ (Giri Ram Krishna)' }}</span>
                                    <span class="lang-en">{{ $company->ceo_role_en ?? 'Representative Member' }}: {{ $company->ceo_name ?? 'Giri Ram Krishna' }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th><span class="lang-ja">事業内容</span><span class="lang-en">Core Businesses</span></th>
                                <td>
                                    <span class="lang-ja">{{ $company->business_ja }}</span>
                                    <span class="lang-en">{{ $company->business_en }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th><span class="lang-ja">電話番号 / Email</span><span class="lang-en">Phone / Email</span></th>
                                <td>
                                    <div>TEL: <strong>{{ $company->phone ?? '042-409-8256' }}</strong></div>
                                    <div>Email: {{ $company->email ?? 'info@miransh.jp' }}</div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div>
                    <!-- Google Maps Embed for Higashicho, Koganei-shi, Tokyo -->
                    <div class="map-container">
                        <iframe 
                            src="https://maps.google.com/maps?q=35.6983,139.5240&hl=ja&z=16&output=embed" 
                            title="MIRANSH LLC Headquarters Map"
                            loading="lazy" 
                            allowfullscreen>
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- VISION & CEO MESSAGE -->
    <section id="vision" class="section">
        <div class="container">
            <div class="vision-card">
                <div class="vision-grid">
                    <div class="vision-ceo-card">
                        <img src="{{ $company->ceo_image ?? '/images/ceo_portrait.jpg' }}" alt="{{ $company->ceo_name }}" class="vision-ceo-photo">
                        <h3 class="vision-ceo-name">{{ $company->ceo_name ?? 'ギリ ラム クリシュナ' }}</h3>
                        <div class="vision-ceo-role">
                            <span class="lang-ja">{{ $company->ceo_role_ja ?? '代表社員' }}</span>
                            <span class="lang-en">{{ $company->ceo_role_en ?? 'Representative Member' }}</span>
                        </div>
                    </div>

                    <div>
                        <span class="section-badge"><span class="lang-ja">代表挨拶・ビジョン</span><span class="lang-en">Executive Vision</span></span>
                        <h2 class="vision-content-lead">
                            <span class="lang-ja">「日本企業と海外人材をつなぐ、最も信頼されるパートナーを目指して」</span>
                            <span class="lang-en">“Aiming to be the Most Trusted Bridge Connecting Japanese Enterprises and Global Professionals.”</span>
                        </h2>

                        <div class="vision-body-text">
                            <div class="lang-ja">{!! nl2br(e($company->ceo_message_ja)) !!}</div>
                            <div class="lang-en">{!! nl2br(e($company->ceo_message_en)) !!}</div>
                        </div>

                        <div class="vision-signature-block">
                            <div>
                                <div class="vision-sign-company">
                                    <span class="lang-ja">{{ $company->name_ja ?? 'MIRANSH合同会社' }}</span>
                                    <span class="lang-en">{{ $company->name_en ?? 'MIRANSH LLC' }}</span>
                                </div>
                                <div class="vision-sign-name">
                                    <span class="lang-ja">{{ $company->ceo_role_ja ?? '代表社員' }} {{ $company->ceo_name ?? 'ギリ ラム クリシュナ' }}</span>
                                    <span class="lang-en">{{ $company->ceo_name ?? 'Giri Ram Krishna' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CONTACT CTA & FORM -->
    <section id="contact" class="contact-section">
        <div class="container">
            <div class="contact-grid">
                <div>
                    <span class="section-badge" style="background: rgba(255,255,255,0.15); color: #FCD34D;">
                        <span class="lang-ja">お問い合わせ・無料相談</span>
                        <span class="lang-en">Inquiry & Consultation</span>
                    </span>
                    <h2 class="contact-info-title">
                        <span class="lang-ja">外国人材の採用・受入について、お気軽にご相談ください</span>
                        <span class="lang-en">Get in Touch with our Recruitment Specialists</span>
                    </h2>
                    <p class="contact-info-desc">
                        <span class="lang-ja">「特定技能人材を採用したい」「ネパールからの人材受入を検討したい」「在留資格の手続きについて聞きたい」など、些細なことでも丁寧にご案内いたします。</span>
                        <span class="lang-en">Whether you are considering Specified Skilled Worker recruitment, seeking specialized Nepali caregivers, or need assistance with visa procedures, our dedicated team is here to assist you.</span>
                    </p>

                    <div class="contact-cards-list">
                        <div class="contact-detail-card">
                            <div class="contact-detail-icon">
                                <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            </div>
                            <div>
                                <div class="contact-detail-label"><span class="lang-ja">お電話でのお問い合わせ</span><span class="lang-en">Telephone Hotline</span></div>
                                <div class="contact-detail-value">{{ $company->phone ?? '042-409-8256' }}</div>
                            </div>
                        </div>

                        <div class="contact-detail-card">
                            <div class="contact-detail-icon">
                                <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <div class="contact-detail-label"><span class="lang-ja">メールでのお問い合わせ</span><span class="lang-en">Email Address</span></div>
                                <div class="contact-detail-value">{{ $company->email ?? 'info@miransh.jp' }}</div>
                            </div>
                        </div>

                        <div class="contact-detail-card">
                            <div class="contact-detail-icon">
                                <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <div>
                                <div class="contact-detail-label"><span class="lang-ja">本店所在地</span><span class="lang-en">Office Location</span></div>
                                <div class="contact-detail-value" style="font-size: 13px;">
                                    <span class="lang-ja">{{ $company->address_ja }}</span>
                                    <span class="lang-en">{{ $company->address_en }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="contact-form-box">
                        <h3 style="font-size: 20px; font-weight: 800; color: var(--primary); margin-bottom: 20px;">
                            <span class="lang-ja">お問い合わせフォーム</span>
                            <span class="lang-en">Send Us an Inquiry</span>
                        </h3>

                        @if (session('success'))
                        <div style="background: #ECFDF5; border: 1px solid #10B981; color: #065F46; padding: 14px 18px; border-radius: 8px; margin-bottom: 20px; font-weight: 600; font-size: 14px;">
                            ✓ {{ session('success') }}
                        </div>
                        @endif

                        <form action="{{ route('contact.submit') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">
                                    <span class="lang-ja">貴社名 / 法人名</span><span class="lang-en">Company / Organization</span>
                                </label>
                                <input type="text" name="company_name" class="form-input" placeholder="例: 株式会社〇〇">
                            </div>

                            <div class="form-group">
                                <label class="form-label">
                                    <span class="lang-ja">ご担当者様 お名前</span><span class="lang-en">Full Name</span>
                                    <span class="req">*</span>
                                </label>
                                <input type="text" name="name" class="form-input" required placeholder="例: 山田 太郎">
                            </div>

                            <div class="form-group">
                                <label class="form-label">
                                    <span class="lang-ja">メールアドレス</span><span class="lang-en">Email Address</span>
                                    <span class="req">*</span>
                                </label>
                                <input type="email" name="email" class="form-input" required placeholder="name@company.co.jp">
                            </div>

                            <div class="form-group">
                                <label class="form-label">
                                    <span class="lang-ja">お電話番号</span><span class="lang-en">Phone Number</span>
                                </label>
                                <input type="tel" name="phone" class="form-input" placeholder="03-0000-0000">
                            </div>

                            <div class="form-group">
                                <label class="form-label">
                                    <span class="lang-ja">ご相談分野・ご興味のある内容</span><span class="lang-en">Service of Interest</span>
                                </label>
                                <select name="service_interest" class="form-select">
                                    <option value="介護人材の採用支援">特定技能（介護）人材の採用支援</option>
                                    <option value="建設・その他特定技能">建設・その他分野の特定技能人材</option>
                                    <option value="在留資格・ビザ手続き">在留資格（ビザ）手続きの相談</option>
                                    <option value="入社後の生活・定着支援">入社後の生活・定着支援について</option>
                                    <option value="その他">その他のお問い合わせ</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label">
                                    <span class="lang-ja">ご相談内容・メッセージ</span><span class="lang-en">Inquiry Details</span>
                                    <span class="req">*</span>
                                </label>
                                <textarea name="message" class="form-textarea" required placeholder="採用予定人数、時期、職種などのご希望をご記入ください。"></textarea>
                            </div>

                            <button type="submit" class="btn-submit-contact">
                                <span class="lang-ja">送信する (Send Inquiry)</span>
                                <span class="lang-en">Submit Inquiry</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        <div class="container">
            <div class="footer-grid">
                <div>
                    <div class="footer-brand-title">
                        <span class="lang-ja">{{ $company->name_ja ?? 'MIRANSH合同会社' }}</span>
                        <span class="lang-en">{{ $company->name_en ?? 'MIRANSH LLC' }}</span>
                    </div>
                    <p class="footer-desc">
                        <span class="lang-ja">{{ $company->tagline_ja ?? '日本企業と海外人材をつなぐ、信頼の架け橋。' }}</span>
                        <span class="lang-en">{{ $company->tagline_en ?? 'Bridging Japanese Enterprises and Global Talent with Trust.' }}</span>
                    </p>
                    <div class="footer-licence-badge">
                        {{ $company->license ?? '有料職業紹介事業許可：13-ユ-319558' }} | 法人番号: {{ $company->corporate_number ?? '5012403006691' }}
                    </div>
                </div>

                <div>
                    <h4 class="footer-col-title"><span class="lang-ja">クイックリンク</span><span class="lang-en">Quick Links</span></h4>
                    <ul class="footer-links-list">
                        <li><a href="#about"><span class="lang-ja">会社紹介</span><span class="lang-en">About MIRANSH</span></a></li>
                        <li><a href="#services"><span class="lang-ja">事業案内</span><span class="lang-en">Services</span></a></li>
                        <li><a href="#strengths"><span class="lang-ja">当社の強み</span><span class="lang-en">Our Strengths</span></a></li>
                        <li><a href="#industries"><span class="lang-ja">対応分野</span><span class="lang-en">Industries</span></a></li>
                        <li><a href="#stories"><span class="lang-ja">採用事例</span><span class="lang-en">Case Studies</span></a></li>
                        <li><a href="#company"><span class="lang-ja">会社概要・アクセス</span><span class="lang-en">Profile & Location</span></a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="footer-col-title"><span class="lang-ja">お問い合わせ先</span><span class="lang-en">Contact Info</span></h4>
                    <div style="font-size: 13px; line-height: 1.8; color: #94A3B8;">
                        <p><strong>TEL:</strong> {{ $company->phone ?? '042-409-8256' }}</p>
                        <p><strong>Email:</strong> {{ $company->email ?? 'info@miransh.jp' }}</p>
                        <p style="margin-top: 8px;">
                            <span class="lang-ja">{{ $company->address_ja }}</span>
                            <span class="lang-en">{{ $company->address_en }}</span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <div>
                    &copy; {{ date('Y') }} {{ $company->name_ja ?? 'MIRANSH合同会社' }} (MIRANSH LLC). All Rights Reserved.
                </div>
                <div>
                    <a href="{{ route('admin.login') }}" style="color: #64748B; font-size: 11px;">管理者ログイン (Admin Login)</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Admin Floating Launcher -->
    <a href="{{ route('admin.dashboard') }}" class="admin-float-btn" title="Admin Portal">
        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
        <span>管理画面 (Admin)</span>
    </a>

    <!-- Language Switching Engine Script -->
    <script>
        function setLanguage(lang) {
            document.body.className = lang;
            const btnJa = document.getElementById('btn-lang-ja');
            const btnEn = document.getElementById('btn-lang-en');
            if (lang === 'en') {
                btnEn.classList.add('active');
                btnJa.classList.remove('active');
                document.documentElement.lang = 'en';
            } else {
                btnJa.classList.add('active');
                btnEn.classList.remove('active');
                document.documentElement.lang = 'ja';
            }
            try {
                localStorage.setItem('miransh_lang', lang);
            } catch(e) {}
        }

        (function() {
            try {
                const savedLang = localStorage.getItem('miransh_lang');
                if (savedLang === 'en' || savedLang === 'ja') {
                    setLanguage(savedLang);
                }
            } catch(e) {}
        })();
    </script>
</body>
</html>
