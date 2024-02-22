     <!DOCTYPE html>
<html lang="fr">
<head>
    <title>Aügur</title>
    {{-- Metas --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content= "RSOFT REUNION">
    <meta name="generator" content="RSOFT CMS (1.0)">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    {{-- Scripts --}}
    <script src="https://cdn.tiny.cloud/1/j7a0crew3nmaxen8eoxy84fe62rbj8droiq6svy41ph2at27/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    {{-- <!-- Alpine Plugins --> deprecated in Livewire 3 as it ships directly with alpine integration
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/focus@3.x.x/dist/cdn.min.js"></script>
    <!-- Alpine Core -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script> --}}
    {{-- Google Analytics (uniquement en production) --}}
    @if(env('APP_ENV') == 'production')
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-940L0RK8XR"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-940L0RK8XR');
        </script>
    @endif
    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">
    {{-- FontAwesome --}}
    <script src="https://kit.fontawesome.com/956531071e.js" crossorigin="anonymous"></script>
    {{-- Styles --}}
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    @vite([
        'resources/css/app.css',
        'resources/sass/template.scss',
        'resources/sass/component.scss',
        'resources/sass/responsive.scss',
    ])
    @livewireStyles
</head>
<body class="antialiased">
    @include('components.flash-messsage')
    @include('cookie-consent::index')
    {{-- Contents --}}
    @yield('content-app')
    {{-- Scripts --}}
    @vite([
        'resources/js/functions.js',
        'resources/js/tinyMCE.js',
    ])
    @livewire('wire-elements-modal')
    @livewireScripts
</body>
</html>
