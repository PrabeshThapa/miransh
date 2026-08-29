<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($service->title_ja); ?> | <?php echo e($company->name_ja ?? 'MIRANSH合同会社'); ?></title>
    <meta name="description" content="<?php echo e($service->desc_ja); ?>">
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

    <!-- Detail Hero -->
    <section class="detail-hero">
        <div class="container">
            <div class="detail-breadcrumbs">
                <a href="/"><span class="lang-ja">ホーム</span><span class="lang-en">Home</span></a>
                <span>/</span>
                <a href="/#services"><span class="lang-ja">事業案内</span><span class="lang-en">Services</span></a>
                <span>/</span>
                <span>
                    <span class="lang-ja"><?php echo e($service->title_ja); ?></span>
                    <span class="lang-en"><?php echo e($service->title_en); ?></span>
                </span>
            </div>

            <span class="section-badge" style="background: rgba(255,255,255,0.15); color: #93C5FD; margin-bottom: 12px;">
                SERVICE <?php echo e($service->number_label ?? '01'); ?>

            </span>

            <h1 class="detail-title">
                <span class="lang-ja"><?php echo e($service->title_ja); ?></span>
                <span class="lang-en"><?php echo e($service->title_en); ?></span>
            </h1>

            <p class="detail-subtitle">
                <span class="lang-ja"><?php echo e($service->subtitle_ja ?? $service->desc_ja); ?></span>
                <span class="lang-en"><?php echo e($service->subtitle_en ?? $service->desc_en); ?></span>
            </p>
        </div>
    </section>

    <!-- Main Detail Content -->
    <section class="section">
        <div class="container">
            <div class="detail-content-layout">
                <div class="detail-main-content">
                    <img src="<?php echo e($service->image ?? '/images/caregiving.jpg'); ?>" alt="<?php echo e($service->title_ja); ?>" class="detail-banner-img">

                    <h2 style="font-size: 24px; font-weight: 800; color: var(--primary); margin-bottom: 16px;">
                        <span class="lang-ja">サービス概要・支援内容</span>
                        <span class="lang-en">Service Overview & Core Support</span>
                    </h2>

                    <div class="detail-prose">
                        <div class="lang-ja">
                            <p style="margin-bottom: 16px;"><?php echo e($service->full_content_ja ?? $service->desc_ja); ?></p>
                        </div>
                        <div class="lang-en">
                            <p style="margin-bottom: 16px;"><?php echo e($service->full_content_en ?? $service->desc_en); ?></p>
                        </div>
                    </div>

                    <!-- Key Inclusions / Features -->
                    <div style="background: #F8FAFC; border: 1px solid var(--border-color); border-radius: var(--radius-lg); padding: 28px; margin-bottom: 36px;">
                        <h3 style="font-size: 18px; font-weight: 800; color: var(--primary); margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
                            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span class="lang-ja">主なサポート項目</span>
                            <span class="lang-en">Key Service Inclusions</span>
                        </h3>

                        <?php if(!empty($service->items_ja)): ?>
                        <ul class="service-items-list lang-ja" style="border: none; padding: 0;">
                            <?php $__currentLoopData = $service->items_ja; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="service-item-li" style="font-size: 15px; padding: 8px 0;">
                                <svg width="18" height="18" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                <span><?php echo e($item); ?></span>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                        <?php endif; ?>

                        <?php if(!empty($service->items_en)): ?>
                        <ul class="service-items-list lang-en" style="border: none; padding: 0;">
                            <?php $__currentLoopData = $service->items_en; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="service-item-li" style="font-size: 15px; padding: 8px 0;">
                                <svg width="18" height="18" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                <span><?php echo e($item); ?></span>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                        <?php endif; ?>
                    </div>

                    <!-- Workflow Steps -->
                    <div class="workflow-pipeline-box">
                        <h3 style="font-size: 18px; font-weight: 800; color: var(--primary); margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
                            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span class="lang-ja">実施の流れ・ステップ</span>
                            <span class="lang-en">Implementation Steps & Workflow</span>
                        </h3>

                        <?php if(!empty($service->workflow_steps_ja)): ?>
                        <div class="lang-ja">
                            <?php $__currentLoopData = $service->workflow_steps_ja; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="pipeline-step-item">
                                <div class="pipeline-step-badge"><?php echo e($idx + 1); ?></div>
                                <div class="pipeline-step-text"><?php echo e($step); ?></div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <?php endif; ?>

                        <?php if(!empty($service->workflow_steps_en)): ?>
                        <div class="lang-en">
                            <?php $__currentLoopData = $service->workflow_steps_en; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="pipeline-step-item">
                                <div class="pipeline-step-badge"><?php echo e($idx + 1); ?></div>
                                <div class="pipeline-step-text"><?php echo e($step); ?></div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Sidebar Action Box -->
                <div>
                    <div style="background: #FFFFFF; border: 1px solid var(--border-color); border-radius: var(--radius-lg); padding: 32px; box-shadow: var(--shadow-md); position: sticky; top: 96px;">
                        <h3 style="font-size: 18px; font-weight: 800; color: var(--primary); margin-bottom: 12px;">
                            <span class="lang-ja">このサービスについて相談する</span>
                            <span class="lang-en">Inquire About This Service</span>
                        </h3>
                        <p style="font-size: 13px; color: var(--text-muted); line-height: 1.7; margin-bottom: 24px;">
                            <span class="lang-ja">採用計画や求人条件に合わせた最適な進め方をご提案します。</span>
                            <span class="lang-en">Our recruitment consultants will propose customized solutions matching your requirements.</span>
                        </p>

                        <div style="background: var(--surface-bg); border-radius: var(--radius-sm); padding: 16px; margin-bottom: 20px;">
                            <div style="font-size: 12px; color: var(--text-light);"><span class="lang-ja">お電話でのご相談</span><span class="lang-en">Phone Consultation</span></div>
                            <div style="font-size: 18px; font-weight: 800; color: var(--primary); margin-top: 2px;"><?php echo e($company->phone ?? '042-409-8256'); ?></div>
                        </div>

                        <a href="/#contact" class="btn-primary" style="width: 100%; justify-content: center;">
                            <span class="lang-ja">無料相談フォームへ進む</span>
                            <span class="lang-en">Go to Consultation Form</span>
                        </a>

                        <div style="margin-top: 36px; border-top: 1px solid var(--border-color); padding-top: 24px;">
                            <h4 style="font-size: 14px; font-weight: 700; color: var(--primary); margin-bottom: 14px;">
                                <span class="lang-ja">その他の事業内容</span>
                                <span class="lang-en">Other Services</span>
                            </h4>
                            <div style="display: flex; flex-direction: column; gap: 8px;">
                                <?php $__currentLoopData = $allServices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($s->id !== $service->id): ?>
                                    <a href="/services/<?php echo e($s->id); ?>" style="font-size: 13px; color: #2563EB; font-weight: 600; padding: 6px 0; display: flex; align-items: center; justify-content: space-between;">
                                        <span>
                                            <span class="lang-ja"><?php echo e($s->number_label); ?>. <?php echo e($s->title_ja); ?></span>
                                            <span class="lang-en"><?php echo e($s->number_label); ?>. <?php echo e($s->title_en); ?></span>
                                        </span>
                                        <span>→</span>
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
<?php /**PATH /app/applet/resources/views/service-detail.blade.php ENDPATH**/ ?>