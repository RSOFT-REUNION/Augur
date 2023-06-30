@extends('layouts.app')

@section('content-app')
    <div id="backend_page">
        <div class="flex">
            <div class="flex-none">
                @include('components.templates.back-sidebar')
            </div>
            <div class="grow">
                @if(view()->shared('settingGlobal')->site_active == 0)
                    <div class="bg-yellow-200 py-2 ml-[300px]">
                        <div class="container mx-auto text-sm text-red-500 font-bold text-center">
                            <p><i class="fa-solid fa-triangle-exclamation mr-3"></i>Vous êtes actuellement en mode de maintenance, seulement l'équipe Aügur et RSOFT ont accès au site<i class="fa-solid fa-triangle-exclamation ml-3"></i></p>
                        </div>
                    </div>
                @endif
                @yield('content-template')
            </div>
        </div>
    </div>
@endsection
