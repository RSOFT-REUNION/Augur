@extends('layouts.app')

@section('content-app')
    @if(view()->shared('settingGlobal')->site_active == 0)
        <div class="bg-yellow-200 py-2">
            <div class="container mx-auto text-sm text-red-500 font-bold text-center">
                <p><i class="fa-solid fa-triangle-exclamation mr-3"></i>Vous êtes actuellement en mode de maintenance, seulement l'équipe Aügur et RSOFT ont accès au site<i class="fa-solid fa-triangle-exclamation ml-3"></i></p>
            </div>
        </div>
    @endif
    <div id="frontend_page">
        <div class="flex flex-col h-screen">
            <div class="flex-none">
                @include('components.templates.front-header')
                @livewire('components.front.hero-banner')
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
