<footer id="site-footer">

    <div class="container">

        <div class="footer-grid">

            <div>
                <div class="footer-logo">
                    <?php echo e(explode(' ', $company->name_en ?? 'MIRANSH LLC')[0]); ?> <span><?php echo e(explode(' ', $company->name_en ?? 'MIRANSH LLC')[1] ?? ''); ?></span>
                </div>

                <div class="footer-text">

                    <span class="lang-en">
                        <?php echo e($company->footer_text_en ?? (($company->tagline_en ?? '') . '. Connecting Japan with international talent and students.')); ?>

                    </span>

                    <span class="lang-ja">
                        <?php echo e($company->footer_text_ja ?? (($company->tagline_ja ?? '') . '。日本と世界の人材・留学生をつなぎます。')); ?>

                    </span>

                </div>
            </div>

            <div class="footer-contact">

                <h4>
                    <span class="lang-en">Contact</span>
                    <span class="lang-ja">お問い合わせ</span>
                </h4>

                <a href="tel:<?php echo e($company->phone ?? '042-409-8256'); ?>">
                    <?php echo e($company->phone ?? '042-409-8256'); ?>

                </a>

                <p>
                    <span class="lang-en"><?php echo e($company->location_en ?? 'Koganei-shi, Tokyo, Japan'); ?></span>
                    <span class="lang-ja"><?php echo e($company->location_ja ?? '東京都小金井市'); ?></span>
                </p>

            </div>

        </div>

        <div class="copyright">
            <span class="lang-en">
                &copy; <?php echo e(date('Y')); ?> <?php echo e($company->name_en ?? 'MIRANSH LLC'); ?>. All Rights Reserved.
            </span>

            <span class="lang-ja">
                &copy; <?php echo e(date('Y')); ?> <?php echo e($company->name_ja ?? 'ミランス合同会社'); ?>. All Rights Reserved.
            </span>
        </div>

    </div>

</footer>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/laravel/other/miransh/resources/views/partials/footer.blade.php ENDPATH**/ ?>