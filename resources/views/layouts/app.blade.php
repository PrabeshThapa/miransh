<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'MIRANSH LLC | International Human Resources & Student Support')</title>

    <meta name="description"
        content="MIRANSH LLC provides foreign worker recruitment, visa support, life support and international student support in Japan.">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @stack('styles')
</head>

<body class="en">

    @include('partials.header')

    <main id="top">
        @yield('content')
    </main>

    @include('partials.footer')

    <script src="{{ asset('js/app.js') }}"></script>

    @stack('scripts')

</body>
</html>
