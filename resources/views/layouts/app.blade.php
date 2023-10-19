<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>
    <meta name="description" content="{{ config('app.name') }}">
    <meta name="robots" content="noindex, nofollow">
    <meta property="og:title" content="{{ config('app.name') }}">
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:description" content="{{ config('app.name') }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content=".">
    <meta property="og:image" content="/media/logos/logo-icon-colorfull.png">
    <link rel="shortcut icon" href="/media/favicons/favicon.ico">
    <link rel="icon" type="image/png" sizes="192x192" href="/media/favicons/192x192.png') }}">
    <!-- Scripts -->
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
    <!-- Styles -->
    <link rel="stylesheet" id="css-main" href="/css/dashmix.min.css">
    <link rel="stylesheet" id="css-theme" href="/css/themes/xsmooth.min.css">
</head>

<body>
    <div id="page-container"
        class="sidebar-dark side-scroll page-header-static page-header-dark page-header-glass main-content-boxed">
        @yield('frontmatter')
        <main id="main-container">
            @yield('content')
        </main>
        @yield('backmatter')
    </div>
    <script src="/js/dashmix.app.min.js"></script>
</body>

</html>
