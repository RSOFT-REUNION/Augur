@extends('layouts.app')

@section('content-app')
    @if($settingGlobal->maintenance_type == 1)
        {{-- Maintenance for test new functionnality --}}
        <div id="background_maint-1" class="flex h-screen">
            <div class="m-auto width-500">
                <div class="container-filled">
                    <div class="force-center">
                        <img src="{{ asset('images/logos/AUGUR_GRIS.svg') }}">
                    </div>
                    <div class="px-5 pb-5">
                        <h1>De nouvelles fonctionnalités arrivent !</h1>
                        <p class="mt-3">Nous sommes en cours de test de nouvelles fonctionnalités, votre site sera de nouveau disponible dans peu de temps !</p>
                        <div class="mt-5 text-center">
                            <button onclick="Livewire.dispatch('openModal', { component: 'popups.frontend.sign-maintenance' })" class="btn-filled_secondary">Je fais partie de l'organisation</button>
                        </div>
                    </div>
                </div>
                {{--<div class="container-filled mt-2">
                    <form method="POST">
                        <div class="textfield-white">
                            <label for="email">Identifiant<span class="text-red-500">*</span></label>
                            <input type="email" id="email" wire:model.live="email" name="email" placeholder="Entrez votre identifiant" class="@if($errors->has('email'))textfield-error @endif" value="{{ old('email') }}">
                        </div>
                        <div class="textfield-white mt-1">
                            <label for="password">Mot de passe<span class="text-red-500">*</span></label>
                            <input type="password" id="password" wire:model.live="password" name="password" placeholder="Entrez votre mot de passe" class="@if($errors->has('password'))textfield-error @endif" value="{{ old('password') }}">
                        </div>
                        @if($errors->has('email') || $errors->has('email'))
                            <div class="bg-red-100 px-3 py-1 text-sm mt-2 rounded-lg">
                                <p>Vous ne semblez pas faire partie de l'organisation ou bien vous vous êtes trompé dans vos identifiants</p>
                            </div>
                        @endif
                        <div class="mt-5">
                            <button type="submit" class="btn-filled_secondary block w-full">Je me connecte</button>
                        </div>
                    </div>--}}
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
                        <button onclick="Livewire.dispatch('openModal', { component: 'popups.frontend.sign-maintenance' })" class="btn-filled_secondary">Je fais partie de l'organisation</button>
                    </div>
                </div>
            </div>
        </div>

    @endif
@endsection
