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
                <li><a href="#faq" class="nav-link"><span class="lang-ja">FAQ</span><span class="lang-en">FAQ</span></a></li>
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
                <span class="section-badge"><span class="lang-ja">事業案内</span><span class="lang-en">Core Services</span></span>
                <h2 class="section-title">
                    <span class="lang-ja">MIRANSHが提供する4つの包括的サービス</span>
                    <span class="lang-en">Four Comprehensive Recruitment & Support Solutions</span>
                </h2>
                <p class="section-subtitle">
                    <span class="lang-ja">採用計画の策定からビザ申請、入国・入社手続き、その後の職場定着まで、ワンストップで支援いたします。</span>
                    <span class="lang-en">From initial candidate matching and immigration procedures to long-term workplace follow-up, we deliver end-to-end recruitment lifecycle solutions.</span>
                </p>
            </div>

            <div class="services-grid">
                @foreach($services as $service)
                <div class="service-card">
                    <div class="service-card-icon">
                        <span style="font-size: 26px;">{{ $service->icon ?? '💼' }}</span>
                    </div>
                    <h3 class="service-card-title">
                        <span class="lang-ja">{{ $service->title_ja }}</span>
                        <span class="lang-en">{{ $service->title_en }}</span>
                    </h3>
                    <p class="service-card-desc">
                        <span class="lang-ja">{{ $service->description_ja }}</span>
                        <span class="lang-en">{{ $service->description_en }}</span>
                    </p>
                    <a href="{{ route('services.detail', $service->id) }}" class="service-read-more">
                        <span class="lang-ja">詳しく見る →</span>
                        <span class="lang-en">Learn More →</span>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- STRENGTHS SECTION -->
    <section id="strengths" class="section section-bg-light">
        <div class="container">
            <div class="strengths-callout">
                <span class="section-badge" style="background: rgba(255, 255, 255, 0.15); color: #FCD34D;">
                    <span class="lang-ja">MIRANSHの強み</span><span class="lang-en">Why Choose MIRANSH</span>
                </span>
                <h2 class="strengths-callout-title">
                    <span class="lang-ja">{{ $company->strengths_tagline_ja ?? '人材紹介だけで終わらない、手厚い継続サポート' }}</span>
                    <span class="lang-en">{{ $company->strengths_tagline_en ?? 'Beyond Recruitment — Continuous, High-Touch Support' }}</span>
                </h2>
                <p class="strengths-callout-desc">
                    <span class="lang-ja">{{ $company->strengths_desc_ja }}</span>
                    <span class="lang-en">{{ $company->strengths_desc_en }}</span>
                </p>

                <div class="strengths-pillars-grid">
                    <div class="pillar-card">
                        <div class="pillar-num">01</div>
                        <h4 class="pillar-title"><span class="lang-ja">ネパール現地直接連携</span><span class="lang-en">Direct Academic Network in Nepal</span></h4>
                        <p class="pillar-desc"><span class="lang-ja">現地提携校と連携し、日本語能力・専門技能の基礎を備えた優秀な候補者を厳選してご紹介。</span><span class="lang-en">Direct partnership with leading academies ensures highly motivated, pre-screened, and vetted talent.</span></p>
                    </div>
                    <div class="pillar-card">
                        <div class="pillar-num">02</div>
                        <h4 class="pillar-title"><span class="lang-ja">特定技能・介護分野に特化</span><span class="lang-en">SSW Caregiving Specialization</span></h4>
                        <p class="pillar-desc"><span class="lang-ja">深刻な人手不足が続く介護施設様へ、試験合格済みの即戦力人材をスムーズにマッチング。</span><span class="lang-en">Targeted caregiving pipelines matching exam-certified candidates directly to healthcare facilities.</span></p>
                    </div>
                    <div class="pillar-card">
                        <div class="pillar-num">03</div>
                        <h4 class="pillar-title"><span class="lang-ja">生活・職場への密着フォロー</span><span class="lang-en">Daily Life & Workplace Mentorship</span></h4>
                        <p class="pillar-desc"><span class="lang-ja">住居確保、市役所手続きから入社後の定期面談まで、母国語対応も含め親身にサポート。</span><span class="lang-en">Bilingual staff assists with apartment leasing, municipal registration, and ongoing counseling.</span></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- INDUSTRIES SECTION -->
    <section id="industries" class="section">
        <div class="container">
            <div class="section-header">
                <span class="section-badge"><span class="lang-ja">対応分野</span><span class="lang-en">Industries Covered</span></span>
                <h2 class="section-title">
                    <span class="lang-ja">特定技能・主な対応職種</span>
                    <span class="lang-en">Specified Skilled Worker (SSW) Sectors</span>
                </h2>
                <p class="section-subtitle">
                    <span class="lang-ja">介護分野を中核としつつ、人手不足が深刻な各産業分野での受入れをサポートしています。</span>
                    <span class="lang-en">Focused primarily on nursing care, while actively placing skilled professionals across key industries.</span>
                </p>
            </div>

            <div class="industries-grid">
                <div class="industry-card">
                    <div class="industry-badge-rec"><span class="lang-ja">主力対応分野</span><span class="lang-en">Key Focus</span></div>
                    <div class="industry-icon">🩺</div>
                    <h3 class="industry-title"><span class="lang-ja">介護分野 (Nursing Care)</span><span class="lang-en">Nursing & Elderly Care</span></h3>
                    <p class="industry-desc"><span class="lang-ja">特別養護老人ホーム、デイサービス、介護老人保健施設等での身体介護・生活援助。介護技能評価試験・日本語試験合格者をご紹介。</span><span class="lang-en">Certified candidates for elderly care, assisted living facilities, and daycare centers with verified Japanese proficiency.</span></p>
                </div>

                <div class="industry-card">
                    <div class="industry-icon">🏗️</div>
                    <h3 class="industry-title"><span class="lang-ja">建設分野 (Construction)</span><span class="lang-en">Construction & Engineering</span></h3>
                    <p class="industry-desc"><span class="lang-ja">型枠施工、鉄筋施工、内装仕上げ、土木など、現場で活躍できる意欲の高い若手人材をご紹介。</span><span class="lang-en">Formwork, rebar placement, interior finishing, and civil works with strong safety ethics.</span></p>
                </div>

                <div class="industry-card">
                    <div class="industry-icon">🧹</div>
                    <h3 class="industry-title"><span class="lang-ja">ビルクリーニング (Cleaning)</span><span class="lang-en">Building Maintenance</span></h3>
                    <p class="industry-desc"><span class="lang-ja">商業施設、オフィスビル、宿泊施設等の清掃衛生管理業務。礼儀と丁寧な作業ができる人材をご提案。</span><span class="lang-en">Commercial, office, and hospital sanitation operations with meticulous attention to detail.</span></p>
                </div>

                <div class="industry-card">
                    <div class="industry-icon">🍽️</div>
                    <h3 class="industry-title"><span class="lang-ja">外食業・食品製造 (Food Service)</span><span class="lang-en">Food & Dining Services</span></h3>
                    <p class="industry-desc"><span class="lang-ja">飲食店での調理・接客・店舗管理、および食品工場での加工製造業務。</span><span class="lang-en">Culinary prep, customer service, and hygienic food production facility placements.</span></p>
                </div>
            </div>
        </div>
    </section>

    <!-- STORIES / CASE STUDIES SECTION -->
    <section id="stories" class="section section-bg-light">
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
                @foreach($stories as $story)
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
                        <a href="{{ route('stories.detail', $story->id) }}" class="story-read-link">
                            <span class="lang-ja">記事全文を読む →</span>
                            <span class="lang-en">Read Full Story →</span>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ===================================================
         FAQ SECTION (よくある質問)
    =================================================== -->
    <section id="faq" class="faq-section">
        <div class="container">
            <div class="section-header">
                <span class="section-badge"><span class="lang-ja">よくある質問</span><span class="lang-en">Frequently Asked Questions</span></span>
                <h2 class="section-title">
                    <span class="lang-ja">外国人材採用・在留資格に関するFAQ</span>
                    <span class="lang-en">SSW Recruitment & Visa FAQs</span>
                </h2>
                <p class="section-subtitle">
                    <span class="lang-ja">企業様からよくいただくご質問とその回答をまとめました。ご不明な点がございましたらお気軽にお問い合わせください。</span>
                    <span class="lang-en">Find answers to common questions about candidate qualifications, visa procedures, onboarding timelines, and fees.</span>
                </p>
            </div>

            <div class="faq-grid">
                @forelse($faqs as $faq)
                <div class="faq-card">
                    <span class="faq-category-tag">
                        <span class="lang-ja">{{ $faq->category_ja }}</span>
                        <span class="lang-en">{{ $faq->category_en }}</span>
                    </span>
                    <div class="faq-question">
                        <span class="faq-q-badge">Q</span>
                        <div>
                            <span class="lang-ja">{{ $faq->question_ja }}</span>
                            <span class="lang-en">{{ $faq->question_en }}</span>
                        </div>
                    </div>
                    <div class="faq-answer">
                        <div class="lang-ja">{!! nl2br(e($faq->answer_ja)) !!}</div>
                        <div class="lang-en">{!! nl2br(e($faq->answer_en)) !!}</div>
                    </div>
                </div>
                @empty
                <div class="faq-card" style="grid-column: span 2; text-align: center; padding: 40px;">
                    <p style="color: #64748B;">
                        <span class="lang-ja">FAQ項目を読み込んでいます...</span>
                        <span class="lang-en">Loading FAQs...</span>
                    </p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- COMPANY PROFILE & GOOGLE MAPS EMBED -->
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
                                    <strong><span class="lang-ja">{{ $company->name_ja ?? 'MIRANSH合同会社' }}</span></strong>
                                    <br>
                                    <span class="lang-en" style="color: var(--text-light);">{{ $company->name_en ?? 'MIRANSH LLC' }}</span>
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
                                    <div class="lang-ja">
                                        {{ $company->ceo_role_ja ?? '代表社員' }}：<strong>{{ $company->ceo_name_ja ?? 'ギリ ラム クリシュナ' }}</strong>
                                        <span style="color: #64748B; margin-left: 8px;">({{ $company->ceo_name_en ?? 'Giri Ram Krishna' }})</span>
                                    </div>
                                    <div class="lang-en">
                                        {{ $company->ceo_role_en ?? 'Representative Member' }}: <strong>{{ $company->ceo_name_en ?? 'Giri Ram Krishna' }}</strong>
                                        <span style="color: #64748B; margin-left: 8px;">(Japanese: {{ $company->ceo_name_ja ?? 'ギリ ラム クリシュナ' }})</span>
                                    </div>
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
                        <img src="{{ $company->ceo_image ?? '/images/ceo_portrait.jpg' }}" alt="{{ $company->ceo_name_ja ?? 'ギリ ラム クリシュナ' }}" class="vision-ceo-photo">
                        <h3 class="vision-ceo-name">
                            <span class="lang-ja">{{ $company->ceo_name_ja ?? 'ギリ ラム クリシュナ' }}</span>
                            <span class="lang-en">{{ $company->ceo_name_en ?? 'Giri Ram Krishna' }}</span>
                        </h3>
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
                                    <span class="lang-ja">{{ $company->ceo_role_ja ?? '代表社員' }} {{ $company->ceo_name_ja ?? 'ギリ ラム クリシュナ' }}</span>
                                    <span class="lang-en">{{ $company->ceo_role_en ?? 'Representative Member' }}: {{ $company->ceo_name_en ?? 'Giri Ram Krishna' }}</span>
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

                        <form id="contact-form" action="{{ route('contact.submit') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">
                                    <span class="lang-ja">貴社名 / 法人名</span><span class="lang-en">Company / Organization</span>
                                </label>
                                <input type="text" id="input-company" name="company_name" class="form-input" placeholder="例: 株式会社〇〇">
                            </div>

                            <div class="form-group">
                                <label class="form-label">
                                    <span class="lang-ja">ご担当者様 お名前</span><span class="lang-en">Full Name</span>
                                    <span class="req">*</span>
                                </label>
                                <input type="text" id="input-name" name="name" class="form-input" required placeholder="例: 山田 太郎">
                            </div>

                            <div class="form-group">
                                <label class="form-label">
                                    <span class="lang-ja">メールアドレス</span><span class="lang-en">Email Address</span>
                                    <span class="req">*</span>
                                </label>
                                <input type="email" id="input-email" name="email" class="form-input" required placeholder="name@company.co.jp">
                            </div>

                            <div class="form-group">
                                <label class="form-label">
                                    <span class="lang-ja">お電話番号</span><span class="lang-en">Phone Number</span>
                                </label>
                                <input type="tel" id="input-phone" name="phone" class="form-input" placeholder="03-0000-0000">
                            </div>

                            <div class="form-group">
                                <label class="form-label">
                                    <span class="lang-ja">ご相談分野・ご興味のある内容</span><span class="lang-en">Service of Interest</span>
                                </label>
                                <select id="input-service" name="service_interest" class="form-select">
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
                                <textarea id="input-message" name="message" class="form-textarea" required placeholder="採用予定人数、時期、職種などのご希望をご記入ください。"></textarea>
                            </div>

                            <button type="submit" class="btn-submit-contact">
                                <span class="lang-ja">送信する (Submit Inquiry)</span>
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
                        <li><a href="#faq"><span class="lang-ja">FAQ・よくある質問</span><span class="lang-en">FAQ</span></a></li>
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

    <!-- Sakana AI Consultant Floating Button -->
    <button id="sakana-float-btn" class="sakana-float-btn" onclick="toggleSakanaChat()" title="Sakana AI 採用・在留資格AI相談">
        <div class="sakana-badge-pulse"></div>
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 2a10 10 0 0 1 10 10c0 5.523-4.477 10-10 10a9.96 9.96 0 0 1-4.755-1.2L2 22l1.2-5.245A9.96 9.96 0 0 1 2 12C2 6.477 6.477 2 12 2z"></path>
            <path d="M8 12h.01M12 12h.01M16 12h.01"></path>
        </svg>
        <span class="lang-ja">AI 採用・在留資格相談</span>
        <span class="lang-en">AI Visa & Job Advisor</span>
    </button>

    <!-- Sakana AI Interactive Chat Modal / Drawer -->
    <div id="sakana-modal-overlay" class="sakana-modal-overlay" onclick="closeSakanaOnBackdrop(event)">
        <div class="sakana-chat-window" onclick="event.stopPropagation()">
            <!-- Header -->
            <div class="sakana-chat-header">
                <div class="sakana-chat-header-info">
                    <div class="sakana-icon-avatar">🐟</div>
                    <div>
                        <div class="sakana-chat-title">
                            <span class="lang-ja">MIRANSH AIコンサルタント</span>
                            <span class="lang-en">MIRANSH AI Consultant</span>
                        </div>
                        <div class="sakana-chat-subtitle">
                            <span class="sakana-status-dot"></span>
                            <span>Powered by Sakana AI (Namazu / Fugu)</span>
                        </div>
                    </div>
                </div>
                <button class="sakana-btn-close" onclick="toggleSakanaChat()" aria-label="Close Chat">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <!-- Quick Suggestions -->
            <div class="sakana-quick-prompts">
                <button class="sakana-chip" onclick="sendQuickPrompt('介護分野での特定技能の採用要件や流れを教えてください')">
                    <span class="lang-ja">🏥 介護分野の特定技能要件</span>
                    <span class="lang-en">🏥 Caregiving SSW Requirements</span>
                </button>
                <button class="sakana-chip" onclick="sendQuickPrompt('ネパール人材の特徴や日本語レベルについて')">
                    <span class="lang-ja">🇳🇵 ネパール人材の強み</span>
                    <span class="lang-en">🇳🇵 Nepali Talent Advantages</span>
                </button>
                <button class="sakana-chip" onclick="sendQuickPrompt('特定技能1号の受入れ費用と入社までのスケジュール')">
                    <span class="lang-ja">💰 採用費用とスケジュール</span>
                    <span class="lang-en">💰 Cost & Timeline</span>
                </button>
                <button class="sakana-chip" onclick="sendQuickPrompt('建設分野の受入れ手続きについて教えてください')">
                    <span class="lang-ja">🏗️ 建設分野の受入れ</span>
                    <span class="lang-en">🏗️ Construction Sector</span>
                </button>
            </div>

            <!-- Message Area -->
            <div id="sakana-messages-body" class="sakana-messages-body">
                <div class="sakana-msg bot">
                    <div class="sakana-msg-bubble">
                        <span class="lang-ja">こんにちは！MIRANSH合同会社のAI採用・在留資格アシスタントです（Sakana AI 連携）。<br><br>特定技能（介護・建設・清掃・外食など）の外国人材採用、ネパール提携校ネットワーク、ビザ申請（COE）、受入れ費用など、ご不明な点をいつでもご相談ください。</span>
                        <span class="lang-en">Hello! I am your AI Recruitment & Visa Consultant for MIRANSH LLC (Powered by Sakana AI).<br><br>Feel free to ask about Specified Skilled Worker (SSW) hiring, our Nepal talent network, visa application (COE), costs, or life support. How can I assist you today?</span>
                    </div>
                    <div class="sakana-msg-meta">
                        <span>MIRANSH AI (Sakana Namazu)</span>
                    </div>
                </div>
            </div>

            <!-- Footer Quick Action -->
            <div class="sakana-chat-footer-action">
                <span><span class="lang-ja">個別のご相談や求人票のご依頼</span><span class="lang-en">Direct hiring inquiries:</span></span>
                <button class="sakana-btn-inquiry-link" onclick="transferChatToInquiry()">
                    <span class="lang-ja">✉️ 相談内容をフォームに転記</span>
                    <span class="lang-en">✉️ Fill Contact Form</span>
                </button>
            </div>

            <!-- Input Bar -->
            <div class="sakana-chat-input-wrap">
                <input type="text" id="sakana-user-input" class="sakana-input-field" placeholder="質問を入力してください (例: 介護の採用要件は？)" onkeydown="handleSakanaKey(event)">
                <button id="sakana-btn-send" class="sakana-btn-send" onclick="sendSakanaMessage()" aria-label="Send">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Admin Floating Launcher -->
    <a href="{{ route('admin.dashboard') }}" class="admin-float-btn" title="Admin Portal">
        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
        <span class="lang-ja">管理画面</span>
        <span class="lang-en">Admin Portal</span>
    </a>

    <!-- Language Switching Engine Script -->
    <script>
        function setLanguage(lang) {
            document.body.className = lang;
            const btnJa = document.getElementById('btn-lang-ja');
            const btnEn = document.getElementById('btn-lang-en');
            if (lang === 'en') {
                btnEn?.classList.add('active');
                btnJa?.classList.remove('active');
                document.documentElement.lang = 'en';
            } else {
                btnJa?.classList.add('active');
                btnEn?.classList.remove('active');
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

        /* ===================================================
           Sakana AI Chat Interaction Engine
        =================================================== */
        const sakanaChatHistory = [];

        function toggleSakanaChat() {
            const overlay = document.getElementById('sakana-modal-overlay');
            overlay.classList.toggle('open');
            if (overlay.classList.contains('open')) {
                setTimeout(() => {
                    document.getElementById('sakana-user-input')?.focus();
                }, 100);
            }
        }

        function closeSakanaOnBackdrop(e) {
            if (e.target.id === 'sakana-modal-overlay') {
                toggleSakanaChat();
            }
        }

        function handleSakanaKey(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                sendSakanaMessage();
            }
        }

        function sendQuickPrompt(promptText) {
            const input = document.getElementById('sakana-user-input');
            input.value = promptText;
            sendSakanaMessage();
        }

        async function sendSakanaMessage() {
            const input = document.getElementById('sakana-user-input');
            const message = input.value.trim();
            if (!message) return;

            input.value = '';
            const msgBody = document.getElementById('sakana-messages-body');
            const sendBtn = document.getElementById('sakana-btn-send');

            // Append User Message
            const userMsgEl = document.createElement('div');
            userMsgEl.className = 'sakana-msg user';
            userMsgEl.innerHTML = `
                <div class="sakana-msg-bubble">${escapeHtml(message)}</div>
                <div class="sakana-msg-meta"><span>${new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}</span></div>
            `;
            msgBody.appendChild(userMsgEl);
            msgBody.scrollTop = msgBody.scrollHeight;

            sakanaChatHistory.push({ role: 'user', content: message });

            // Show Typing Indicator
            const typingEl = document.createElement('div');
            typingEl.className = 'sakana-typing';
            typingEl.id = 'sakana-typing-indicator';
            typingEl.innerHTML = `
                <div class="sakana-typing-dot"></div>
                <div class="sakana-typing-dot"></div>
                <div class="sakana-typing-dot"></div>
            `;
            msgBody.appendChild(typingEl);
            msgBody.scrollTop = msgBody.scrollHeight;

            sendBtn.disabled = true;

            const activeLang = document.body.classList.contains('en') ? 'en' : 'ja';

            try {
                const response = await fetch('/api/ai/chat', {
                    method: 'POST',
                    headers: { 
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        messages: sakanaChatHistory,
                        language: activeLang
                    })
                });

                const data = await response.json();
                const typing = document.getElementById('sakana-typing-indicator');
                if (typing) typing.remove();

                const botMsgEl = document.createElement('div');
                botMsgEl.className = 'sakana-msg bot';
                
                const formattedReply = renderMarkdown(data.reply || 'ご質問ありがとうございます。詳細につきましてはMIRANSH担当者よりご案内いたします。');
                const providerBadge = data.provider || 'Sakana AI (Namazu)';

                botMsgEl.innerHTML = `
                    <div class="sakana-msg-bubble">${formattedReply}</div>
                    <div class="sakana-msg-meta">
                        <span>${providerBadge}</span>
                        <span>• ${new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}</span>
                    </div>
                `;
                msgBody.appendChild(botMsgEl);
                msgBody.scrollTop = msgBody.scrollHeight;

                if (data.reply) {
                    sakanaChatHistory.push({ role: 'assistant', content: data.reply });
                }
            } catch (err) {
                console.error('Sakana Chat Error:', err);
                const typing = document.getElementById('sakana-typing-indicator');
                if (typing) typing.remove();

                const botMsgEl = document.createElement('div');
                botMsgEl.className = 'sakana-msg bot';
                botMsgEl.innerHTML = `
                    <div class="sakana-msg-bubble">
                        申し訳ありません。一時的な通信エラーが発生しました。お急ぎの場合はお電話（042-409-8256）またはお問い合わせフォームよりご連絡ください。
                    </div>
                    <div class="sakana-msg-meta"><span>System Notice</span></div>
                `;
                msgBody.appendChild(botMsgEl);
                msgBody.scrollTop = msgBody.scrollHeight;
            } finally {
                sendBtn.disabled = false;
                document.getElementById('sakana-user-input')?.focus();
            }
        }

        function transferChatToInquiry() {
            toggleSakanaChat();
            const contactSection = document.getElementById('contact');
            if (contactSection) {
                contactSection.scrollIntoView({ behavior: 'smooth' });
                const messageTextarea = document.getElementById('input-message');
                if (messageTextarea && sakanaChatHistory.length > 0) {
                    const lastUserMsg = sakanaChatHistory.filter(m => m.role === 'user').pop();
                    if (lastUserMsg) {
                        messageTextarea.value = `【AI相談からの転記】\nご相談内容: ${lastUserMsg.content}`;
                        messageTextarea.focus();
                    }
                }
            }
        }

        function escapeHtml(text) {
            const map = { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#039;' };
            return text.replace(/[&<>"']/g, function(m) { return map[m]; });
        }

        function renderMarkdown(md) {
            if (!md) return '';
            let html = escapeHtml(md);
            // Bold
            html = html.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');
            // Headings
            html = html.replace(/^### (.*$)/gim, '<h4 style="margin:8px 0 4px;font-size:14px;font-weight:700;color:var(--primary);">$1</h4>');
            // Lists
            html = html.replace(/^\- (.*$)/gim, '<li style="margin-left:16px;">$1</li>');
            html = html.replace(/^\d+\. (.*$)/gim, '<li style="margin-left:16px;list-style-type:decimal;">$1</li>');
            // Line breaks
            html = html.replace(/\n\n/g, '<br><br>');
            html = html.replace(/\n/g, '<br>');
            return html;
        }
    </script>
</body>
</html>
