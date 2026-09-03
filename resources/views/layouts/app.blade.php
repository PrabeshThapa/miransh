<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', ($company->name_ja ?? 'MIRANSH合同会社') . ' | ' . ($company->tagline_ja ?? '日本企業と海外人材をつなぐ、信頼の架け橋'))</title>

    <meta name="description"
        content="@yield('description', ($company->name_ja ?? 'MIRANSH合同会社') . 'は日本企業とネパールを中心とする外国人材をつなぐ総合人材サービス企業です。特定技能（介護・建設・清掃・外食など）外国人材の採用支援、在留資格申請、入国・生活定着サポートを提供します。')">
    <meta name="keywords" content="@yield('keywords', 'MIRANSH合同会社,ミランス合同会社,外国人材紹介,特定技能,介護人材,ネパール人材採用,在留資格申請,有料職業紹介,13-ユ-319558')">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="@yield('canonical', 'https://miransh.co.jp/')">

    <!-- Open Graph (OG) Meta Tags -->
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="@yield('og_url', 'https://miransh.co.jp/')">
    <meta property="og:title" content="@yield('og_title', ($company->name_ja ?? 'MIRANSH合同会社') . ' | ' . ($company->tagline_ja ?? '日本企業と海外人材をつなぐ、信頼の架け橋'))">
    <meta property="og:description" content="@yield('og_description', ($company->name_ja ?? 'MIRANSH合同会社') . 'は日本企業とネパールを中心とする海外人材をつなぐ有料職業紹介事業者（13-ユ-319558）です。特定技能外国人材の採用・定着を一貫支援します。')">
    <meta property="og:image" content="@yield('og_image', 'https://miransh.co.jp/images/logo-icon.png')">
    <meta property="og:site_name" content="{{ $company->name_ja ?? 'MIRANSH合同会社' }} (MIRANSH LLC)">
    <meta property="og:locale" content="ja_JP">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="@yield('og_url', 'https://miransh.co.jp/')">
    <meta name="twitter:title" content="@yield('og_title', ($company->name_ja ?? 'MIRANSH合同会社') . ' | 日本企業と海外人材をつなぐ、信頼の架け橋')">
    <meta name="twitter:description" content="@yield('og_description', '特定技能（介護・建設・清掃など）の外国人材採用支援・在留資格申請・生活定着サポート。厚生労働大臣許可：13-ユ-319558。')">
    <meta name="twitter:image" content="@yield('og_image', 'https://miransh.co.jp/images/logo-icon.png')">

    <link rel="icon" type="image/png" href="{{ asset('images/logo-icon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('styles')
</head>

<body class="en">

    @include('partials.header')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
