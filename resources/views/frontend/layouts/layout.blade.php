<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Rsoft Réunion">
    <meta name="author" content="RsoftCMS">

    <title>@yield('title') | Rsoft Réunion</title>
    @include('frontend.layouts.style')
</head>

<body>

    <main id="main">

        @yield('main-content')
    </main>

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center text-decoration-none"><i class="fa-duotone fa-arrow-up fa-fw"></i></a>

    @include('frontend.layouts.script')
</body>
