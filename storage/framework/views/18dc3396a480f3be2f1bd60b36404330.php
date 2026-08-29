<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($story->title_ja); ?> | <?php echo e($company->name_ja ?? 'MIRANSH合同会社'); ?></title>
    <meta name="description" content="<?php echo e($story->summary_ja); ?>">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🏢</text></svg>">
</head>
<body class="ja">

    <!-- Header -->
    <header>
        <div class="container navbar">
            <a href="/" class="brand-wrapper">
                <div class="brand-icon">M</div>
                <div>
                    <div class="brand-title">
                        <span class="lang-ja"><?php echo e($company->name_ja ?? 'MIRANSH合同会社'); ?></span>
                        <span class="lang-en"><?php echo e($company->name_en ?? 'MIRANSH LLC'); ?></span>
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
                <li><a href="/#industries" class="nav-link"><span class="lang-ja">対応分野</span><span class="lang-en">Industries</span></a></li>
                <li><a href="/#stories" class="nav-link"><span class="lang-ja">採用事例</span><span class="lang-en">Stories</span></a></li>
                <li><a href="/#company" class="nav-link"><span class="lang-ja">会社概要</span><span class="lang-en">Profile</span></a></li>
            </ul>

            <div class="nav-right-actions">
                <div class="lang-toggle-group">
                    <button type="button" class="lang-btn active" id="btn-lang-ja" onclick="setLanguage('ja')">日本語</button>
                    <button type="button" class="lang-btn" id="btn-lang-en" onclick="setLanguage('en')">EN</button>
                </div>
                <a href="/#contact" class="btn-header-cta">
                    <span class="lang-ja">お問い合わせ</span>
                    <span class="lang-en">Contact</span>
                </a>
            </div>
        </div>
    </header>

    <!-- Story Hero -->
    <section class="detail-hero">
        <div class="container">
            <div class="detail-breadcrumbs">
                <a href="/"><span class="lang-ja">ホーム</span><span class="lang-en">Home</span></a>
                <span>/</span>
                <a href="/#stories"><span class="lang-ja">採用事例・ニュース</span><span class="lang-en">Stories</span></a>
                <span>/</span>
                <span>
                    <span class="lang-ja"><?php echo e($story->title_ja); ?></span>
                    <span class="lang-en"><?php echo e($story->title_en); ?></span>
                </span>
            </div>

            <span class="section-badge" style="background: rgba(255,255,255,0.15); color: #93C5FD; margin-bottom: 12px;">
                <span class="lang-ja"><?php echo e($story->category_ja); ?></span>
                <span class="lang-en"><?php echo e($story->category_en); ?></span>
            </span>

            <h1 class="detail-title">
                <span class="lang-ja"><?php echo e($story->title_ja); ?></span>
                <span class="lang-en"><?php echo e($story->title_en); ?></span>
            </h1>

            <div style="font-size: 14px; color: #CBD5E1; margin-top: 8px;">
                <span><?php echo e($story->published_date ?? '2024.11.20'); ?></span> | <span><?php echo e($story->author ?? 'MIRANSH Editorial Team'); ?></span>
            </div>
        </div>
    </section>

    <!-- Main Story Content -->
    <section class="section">
        <div class="container">
            <div class="detail-content-layout">
                <div class="detail-main-content">
                    <img src="<?php echo e($story->image ?? '/images/story1.jpg'); ?>" alt="<?php echo e($story->title_ja); ?>" class="detail-banner-img">

                    <div style="background: #F8FAFC; border-left: 4px solid #2563EB; padding: 18px 24px; border-radius: 0 8px 8px 0; margin-bottom: 32px; font-size: 16px; font-weight: 600; color: var(--primary);">
                        <span class="lang-ja"><?php echo e($story->summary_ja); ?></span>
                        <span class="lang-en"><?php echo e($story->summary_en); ?></span>
                    </div>

                    <div class="detail-prose">
                        <div class="lang-ja" style="white-space: pre-line;">
                            <?php echo e($story->content_ja ?? $story->summary_ja); ?>

                        </div>
                        <div class="lang-en" style="white-space: pre-line;">
                            <?php echo e($story->content_en ?? $story->summary_en); ?>

                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div>
                    <div style="background: #FFFFFF; border: 1px solid var(--border-color); border-radius: var(--radius-lg); padding: 32px; box-shadow: var(--shadow-md); position: sticky; top: 96px;">
                        <h3 style="font-size: 18px; font-weight: 800; color: var(--primary); margin-bottom: 12px;">
                            <span class="lang-ja">外国人材採用のお問い合わせ</span>
                            <span class="lang-en">Consultation Inquiry</span>
                        </h3>
                        <p style="font-size: 13px; color: var(--text-muted); line-height: 1.7; margin-bottom: 24px;">
                            <span class="lang-ja">介護・建設・各種特定技能分野での採用実績に基づき、最適なプランをご提案します。</span>
                            <span class="lang-en">We provide tailored recruitment solutions based on proven track records across nursing care, construction, and specialized industries.</span>
                        </p>

                        <a href="/#contact" class="btn-primary" style="width: 100%; justify-content: center;">
                            <span class="lang-ja">お問い合わせフォーム</span>
                            <span class="lang-en">Contact Us</span>
                        </a>

                        <div style="margin-top: 36px; border-top: 1px solid var(--border-color); padding-top: 24px;">
                            <h4 style="font-size: 14px; font-weight: 700; color: var(--primary); margin-bottom: 14px;">
                                <span class="lang-ja">その他の採用事例</span>
                                <span class="lang-en">Other Stories</span>
                            </h4>
                            <div style="display: flex; flex-direction: column; gap: 12px;">
                                <?php $__currentLoopData = $allStories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($s->id !== $story->id): ?>
                                    <a href="/stories/<?php echo e($s->id); ?>" style="font-size: 13px; color: #2563EB; font-weight: 600; line-height: 1.4;">
                                        <span class="lang-ja">• <?php echo e($s->title_ja); ?></span>
                                        <span class="lang-en">• <?php echo e($s->title_en); ?></span>
                                    </a>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-bottom" style="border: none; padding-top: 0;">
                <div>&copy; <?php echo e(date('Y')); ?> <?php echo e($company->name_ja ?? 'MIRANSH合同会社'); ?> (MIRANSH LLC). All Rights Reserved.</div>
                <div><a href="/" style="color: #94A3B8;"><span class="lang-ja">← トップページへ戻る</span><span class="lang-en">← Back to Home</span></a></div>
            </div>
        </div>
    </footer>

    <!-- Language Script -->
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
            try { localStorage.setItem('miransh_lang', lang); } catch(e) {}
        }
        (function() {
            try {
                const savedLang = localStorage.getItem('miransh_lang');
                if (savedLang === 'en' || savedLang === 'ja') setLanguage(savedLang);
            } catch(e) {}
        })();
    </script>
</body>
</html>
<?php /**PATH /app/applet/resources/views/story-detail.blade.php ENDPATH**/ ?>