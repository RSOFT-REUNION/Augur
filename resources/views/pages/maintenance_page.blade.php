@extends('layouts.app')

@section('content-app')
    @if($settingGlobal->maintenance_type == 1)
        {{-- Maintenance for test new functionnality --}}
        <div id="background_maint-1" class="flex h-screen">
            <div class="container-filled m-auto width-500">
                <div class="force-center">
                    <img src="{{ asset('images/logos/AUGUR_GRIS.svg') }}">
                </div>
                <div class="px-5 pb-5">
                    <h1>De nouvelles fonctionnalités arrivent !</h1>
                    <p class="mt-3">Nous sommes en cours de test de nouvelles fonctionnalités, votre site sera de nouveau disponible dans peu de temps !</p>
                    <div class="mt-5">
                        <button onclick="Livewire.emit('openModal', 'popups.frontend.sign-maintenance')" class="btn-filled_secondary">Je fais partie de l'organisation</button>
                    </div>
                </div>
            </div>
        </div>

    @elseif($settingGlobal->maintenance_type == 2)
        {{-- Maintenance for fix problems --}}
        <div id="background_maint-1" class="flex h-screen">
            <div class="container-filled m-auto width-500">
                <div class="force-center">
                    <img src="{{ asset('images/logos/AUGUR_GRIS.svg') }}">
                </div>
                <div class="px-5 pb-5">
                    <h1>Site en cours de maintenance !</h1>
                    <p class="mt-3">Votre site Aügur est actuellement en cours de maintenance. Nous nous efforçons de le rendre à nouveau disponible !</p>
                    <div class="mt-5 text-center">
                        <button onclick="Livewire.emit('openModal', 'popups.frontend.sign-maintenance')" class="btn-filled_secondary">Je fais partie de l'organisation</button>
                    </div>
                </div>
            </div>
        </div>

    @endif
@endsection
