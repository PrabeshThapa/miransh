<!DOCTYPE html>
<html lang="@yield('lang', 'ja')">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- =========================================
         SEO TITLE
    ========================================== --}}
    <title>
        @yield(
            'title',
            ($company->name_ja ?? 'MIRANSH合同会社')
            . ' | '
            . ($company->tagline_ja ?? '日本企業と海外人材をつなぐ、信頼の架け橋')
        )
    </title>


    {{-- =========================================
         META DESCRIPTION
    ========================================== --}}
    <meta
        name="description"
        content="@yield(
            'description',
            ($company->name_ja ?? 'MIRANSH合同会社')
            . 'は日本企業とネパールを中心とする外国人材をつなぐ総合人材サービス企業です。特定技能（介護・建設・清掃・外食など）外国人材の採用支援、在留資格申請、入国・生活定着サポートを提供します。'
        )"
    >


    {{-- =========================================
         SEARCH ENGINE CONTROL
    ========================================== --}}
    <meta
        name="robots"
        content="@yield('robots', 'index, follow')"
    >


    {{-- =========================================
         CANONICAL URL
    ========================================== --}}
    <link
        rel="canonical"
        href="@yield('canonical', url()->current())"
    >


    {{-- =========================================
         OPEN GRAPH
    ========================================== --}}
    <meta
        property="og:type"
        content="@yield('og_type', 'website')"
    >

    <meta
        property="og:url"
        content="@yield('og_url', url()->current())"
    >

    <meta
        property="og:title"
        content="@yield(
            'og_title',
            ($company->name_ja ?? 'MIRANSH合同会社')
            . ' | '
            . ($company->tagline_ja ?? '日本企業と海外人材をつなぐ、信頼の架け橋')
        )"
    >

    <meta
        property="og:description"
        content="@yield(
            'og_description',
            ($company->name_ja ?? 'MIRANSH合同会社')
            . 'は日本企業とネパールを中心とする海外人材をつなぐ有料職業紹介事業者（13-ユ-319558）です。特定技能外国人材の採用・定着を一貫支援します。'
        )"
    >

    <meta
        property="og:image"
        content="@yield('og_image', asset('images/logo-icon.png'))"
    >

    <meta
        property="og:image:alt"
        content="MIRANSH合同会社 ロゴ"
    >

    <meta
        property="og:site_name"
        content="{{ $company->name_ja ?? 'MIRANSH合同会社' }} (MIRANSH LLC)"
    >

    <meta
        property="og:locale"
        content="ja_JP"
    >

    @hasSection('english_url')
        <meta
            property="og:locale:alternate"
            content="en_US"
        >
    @endif


    {{-- =========================================
         TWITTER / X
    ========================================== --}}
    <meta
        name="twitter:card"
        content="summary_large_image"
    >

    <meta
        name="twitter:title"
        content="@yield(
            'og_title',
            ($company->name_ja ?? 'MIRANSH合同会社')
            . ' | 日本企業と海外人材をつなぐ、信頼の架け橋'
        )"
    >

    <meta
        name="twitter:description"
        content="@yield(
            'og_description',
            '特定技能（介護・建設・清掃など）の外国人材採用支援・在留資格申請・生活定着サポート。厚生労働大臣許可：13-ユ-319558。'
        )"
    >

    <meta
        name="twitter:image"
        content="@yield('og_image', asset('images/logo-icon.png'))"
    >


    {{-- =========================================
         FAVICON
    ========================================== --}}
    <link
        rel="icon"
        type="image/png"
        href="{{ asset('images/logo-icon.png') }}"
    >


    {{-- =========================================
         CSS
    ========================================== --}}
    <link
        rel="stylesheet"
        href="{{ asset('css/app.css') }}"
    >

    @stack('styles')


    {{-- =========================================
         ORGANIZATION STRUCTURED DATA
    ========================================== --}}
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",

        "name": @json($company->name_ja ?? 'MIRANSH合同会社'),

        "alternateName": "MIRANSH LLC",

        "url": "{{ config('app.url', 'https://miransh.co.jp') }}",

        "logo": "{{ asset('images/logo-icon.png') }}",

        "telephone": "+81-42-409-8256",

        "description": "日本企業とネパールをはじめとする海外人材をつなぐ総合人材サービス企業。特定技能外国人材の採用支援、在留資格手続き、生活・就労サポートを提供します。",

        "areaServed": {
            "@type": "Country",
            "name": "Japan"
        }
    }
    </script>


    {{-- Allow individual pages to add extra SEO/schema --}}
    @stack('head')

</head>


<body class="@yield('body_class', 'ja')">

    {{-- =========================================
         HEADER
    ========================================== --}}
    @include('partials.header')


    {{-- =========================================
         MAIN CONTENT
    ========================================== --}}
    <main>
        @yield('content')
    </main>


    {{-- =========================================
         FOOTER
    ========================================== --}}
    @include('partials.footer')


    {{-- =========================================
         JAVASCRIPT
    ========================================== --}}
    <script src="{{ asset('js/app.js') }}"></script>

    @stack('scripts')

</body>

</html>
