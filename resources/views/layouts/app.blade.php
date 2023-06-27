<!DOCTYPE html>
<html>
<head>
    <title>Aügur</title>
    {{-- Metas --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content= "RSOFT REUNION">
    <meta name="generator" content="RSOFT CMS (1.0)">
    {{-- Scripts --}}
    <script src="https://cdn.tiny.cloud/1/j7a0crew3nmaxen8eoxy84fe62rbj8droiq6svy41ph2at27/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://unpkg.com/@alpinejs/focus@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js"></script>
    {{-- FontAwesome --}}
    <link rel="stylesheet" href="{{ asset('dist/fontawesome/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/fontawesome/brands.min.css') }}">
    <script src="{{ asset('dist/fontawesome/all.min.js') }}"></script>
    <script src="{{ asset('dist/fontawesome/brands.min.js') }}"></script>
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
    {{-- Contents --}}
    @yield('content-app')
    {{-- Scripts --}}
    @vite([
        'resources/js/functions.js',
        'resources/js/tinyMCE.js'
    ])
    @livewire('livewire-ui-modal')
    @livewireScripts
</body>
</html>
