@extends('layouts.app')

@section('content-app')
    <div id="frontend_page">
        <div class="flex flex-col h-screen">
            <div class="flex-none">
                @include('components.templates.front-header')
                @yield('header-carousel')
            </div>
            <div class="grow">
                @yield('content-template')
            </div>
            <div class="flex-none">
                @include('components.templates.front-footer')
            </div>
        </div>
    </div>
@endsection
