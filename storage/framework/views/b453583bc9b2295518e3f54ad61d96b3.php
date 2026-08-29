<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $__env->yieldContent('title', ($company->name_en ?? 'MIRANSH LLC') . ' | ' . ($company->tagline_en ?? 'International Human Resources & Student Support')); ?></title>

    <meta name="description"
        content="<?php echo $__env->yieldContent('description', ($company->name_en ?? 'MIRANSH LLC') . ' - ' . ($company->business_en ?? 'Foreign worker recruitment, visa support, life support and international student support in Japan.')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>

<body class="en">

    <?php echo $__env->make('partials.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <?php echo $__env->make('partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <script src="<?php echo e(asset('js/app.js')); ?>"></script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/laravel/other/miransh/resources/views/layouts/app.blade.php ENDPATH**/ ?>