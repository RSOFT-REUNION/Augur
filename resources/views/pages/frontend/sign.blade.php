@extends('layouts.frontend')

@section('header-carousel')
    <div class="carousel-single_title" style="background-image: url('{{ asset('images/assets/background_login.jpg') }}')">
        <h1>Connexion / Inscription</h1>
    </div>
@endsection

@section('content-template')
    <main role="main">
        @livewire('components.alert-messages')
        <div class="container mx-auto my-10">
            <div class="items-center hidden xl:flex">
                <div class="flex-1 px-4">
                    <h2 class="text-center">Connexion à votre compte</h2>
                </div>
                <div class="flex-1 px-4 border-l border-gray-200">
                    <h2 class="text-center">Effectuer une demande de compte</h2>
                    <p class="bg-gray-100 border border-gray-200 px-5 py-2 mt-5 mx-4 rounded-md">
                        Toutes les demandes de création se font en liaison avec notre ERP. Un mail vous sera envoyé une fois votre compte
                        accessible.
                    </p>
                </div>
            </div>
            <div class="flex flex-col xl:flex-row items-center">
                <div class="flex-1 xl:px-4">
                    {{-- Login form --}}
                    <div class="block xl:hidden">
                        <h2 class="text-center">Connexion à votre compte</h2>
                    </div>
                    <div class="force-center mt-10">
                        <form method="POST" action="{{ route('fo.sign.handle') }}" class="width-500 text-left">
                            @csrf
                            <input type="hidden" name="action" value="login">
                            <div class="textfield">
                                <label for="log_email">Adresse e-mail<span class="text-red-500">*</span></label>
                                <input type="email" id="log_email" name="log_email" placeholder="Entrez votre adresse e-mail" class="@if($errors->has('log_email'))textfield-error @endif" value="{{ old('log_email') }}">
                                @if($errors->has('log_email'))
                                    <p class="text-input-error">{{ $errors->first('log_email') }}</p>
                                @endif
                            </div>
                            <div class="textfield mt-2">
                                <label for="log_password">Mot de passe<span class="text-red-500">*</span></label>
                                <input type="password" id="log_password" name="log_password" placeholder="Entrez votre mot de passe" class="@if($errors->has('log_password'))textfield-error @endif">
                            </div>
                            @if($errors->has('log_password'))
                                <p class="text-input-error">{{ $errors->first('log_password') }}</p>
                            @endif
                            {{--<div class="mt-4 mx-2">
                                <div>
                                    <input type="checkbox" name="rembember" id="rembember">
                                    <label for="rembember" class="pl-2">Je souvenir de moi</label>
                                </div>
                            </div>--}}
                            <div class="mt-5 force-center">
                                <button type="submit" class="btn-filled_secondary block w-full">Se connecter</button>
                            </div>
                            {{--<div class="mt-3 text-center">
                                <a href="" class="hover:text-amber-400">Mot de passe oublié ?</a>
                            </div>--}}
                        </form>
                    </div>
                </div>
                <div class="flex-1 mt-10 pt-10 xl:px-4 border-t xl:border-l xl:border-t-0 xl:mt-0 xl:pt-0 border-gray-200">
                    {{-- Register form --}}
                    <div class="block xl:hidden">
                        <h2 class="text-center">Effectuer une demande de compte</h2>
                    </div>
                    <div class="force-center mt-10">
                        <form method="POST" action="{{ route('fo.sign.handle') }}" class="width-500 text-left">
                            @csrf
                            <input type="hidden" name="action" value="register">
                            <div class="textfield">
                                <label for="lastname">Nom de famille<span class="text-red-500">*</span></label>
                                <input type="text" id="lastname" name="lastname" placeholder="Entrez votre nom de famille" class="@if($errors->has('lastname'))textfield-error @endif" value="{{ old('lastname') }}">
                                @if($errors->has('lastname'))
                                    <p class="text-input-error">{{ $errors->first('lastname') }}</p>
                                @endif
                            </div>
                            <div class="textfield mt-2">
                                <label for="firstname">Prénom<span class="text-red-500">*</span></label>
                                <input type="text" id="firstname" name="firstname" placeholder="Entrez votre nom prénom" class="@if($errors->has('firstname'))textfield-error @endif" value="{{ old('firstname') }}">
                                @if($errors->has('firstname'))
                                    <p class="text-input-error">{{ $errors->first('firstname') }}</p>
                                @endif
                            </div>
                            <div class="textfield mt-2">
                                <label for="phone">Numéro de téléphone<span class="text-red-500">*</span></label>
                                <input type="tel" id="phone" name="phone" placeholder="Entrez votre numéro de téléphone (0000 11 22 33)" class="@if($errors->has('phone'))textfield-error @endif" value="{{ old('phone') }}">
                                @if($errors->has('phone'))
                                    <p class="text-input-error">{{ $errors->first('phone') }}</p>
                                @endif
                            </div>
                            <div class="textfield mt-2">
                                <label for="email">Adresse e-mail<span class="text-red-500">*</span></label>
                                <input type="email" id="email" name="email" placeholder="Entrez votre adresse e-mail" class="@if($errors->has('email'))textfield-error @endif" value="{{ old('email') }}">
                                @if($errors->has('email'))
                                    <p class="text-input-error">{{ $errors->first('email') }}</p>
                                @endif
                            </div>
                            <div class="flex flex-col md:flex-row mt-2">
                                <div class="flex-1 md:mr-1">
                                    <div class="textfield">
                                        <label for="password">Mot de passe<span class="text-red-500">*</span></label>
                                        <input type="password" id="password" name="password" placeholder="Entrez votre mot de passe" class="@if($errors->has('password'))textfield-error @endif">
                                    </div>
                                </div>
                                <div class="flex-1 mt-2 md:mt-0 md:ml-1">
                                    <div class="textfield">
                                        <label for="password_confirmation">Mot de passe (confirmation)<span class="text-red-500">*</span></label>
                                        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Entrez votre mot de passe" class="@if($errors->has('password'))textfield-error @endif">
                                    </div>
                                </div>
                            </div>
                            @if($errors->has('password'))
                                <p class="text-box-error mt-2">{{ $errors->first('password') }}</p>
                            @endif
                            <div class="mt-4 mx-2">
                                <div>
                                    <input type="checkbox" name="newsletter" id="newsletter">
                                    <label for="newsletter" class="pl-2">Je souhaite m'abonner à la newsletter</label>
                                </div>
                                <div class="mt-2">
                                    <input type="checkbox" name="consent" id="consent">
                                    <label for="consent" class="pl-2">J'accepte les <a href="" class="font-bold">Mentions légales</a> et les <a href="" class="font-bold">CGU</a></label>
                                </div>
                                @if($errors->has('consent'))
                                    <p class="text-box-error mt-2">{{ $errors->first('consent') }}</p>
                                @endif
                            </div>
                            <div class="mt-5 force-center">
                                <button type="submit" class="btn-filled_secondary block w-full">Envoyer une demande</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
