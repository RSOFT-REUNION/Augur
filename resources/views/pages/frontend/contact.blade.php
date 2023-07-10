@extends('layouts.frontend')

@section('content-template')
    <main role="main">
        <div class="container mx-auto">
            <div class="text-center">
                <h1>Contact</h1>
                <h3>Nous joindre facilement</h3>
            </div>
            <div class="my-20 flex flex-col lg:flex-row">
                <div class="flex-1 mt-10 lg:mt-0 lg:mr-2 force-center order-2 lg:order-1">
                    <h2>Ecrivez-nous</h2>
                    <form method="POST" class="width-500 text-left">
                        @csrf
                        @if(auth()->guest())
                            <div class="textfield">
                                <label for="lastname">Nom de famille<span class="text-red-500">*</span></label>
                                <input type="text" id="lastname" name="lastname" placeholder="Entrez votre nom de famille" class="@if($errors->has('lastname'))textfield-error @endif" value="{{ old('lastname') }}">
                                @if($errors->has('lastname'))
                                    <p class="text-input-error">{{ $errors->first('lastname') }}</p>
                                @endif
                            </div>
                            <div class="textfield mt-2">
                                <label for="firstname">Prénom<span class="text-red-500">*</span></label>
                                <input type="text" id="firstname" name="firstname" placeholder="Entrez votre prénom" class="@if($errors->has('firstname'))textfield-error @endif" value="{{ old('firstname') }}">
                                @if($errors->has('firstname'))
                                    <p class="text-input-error">{{ $errors->first('firstname') }}</p>
                                @endif
                            </div>
                            <div class="textfield mt-2">
                                <label for="email">Adresse e-mail<span class="text-red-500">*</span></label>
                                <input type="email" id="email" name="email" placeholder="Entrez votre adresse e-mail" class="@if($errors->has('email'))textfield-error @endif" value="{{ old('email') }}">
                                @if($errors->has('email'))
                                    <p class="text-input-error">{{ $errors->first('email') }}</p>
                                @endif
                            </div>
                        @endif
                        <div class="textfield mt-2 order-1">
                            <label for="subject">Sujet<span class="text-red-500">*</span></label>
                            <input type="text" id="subject" name="subject" placeholder="Entrez le sujet de votre message" class="@if($errors->has('subject'))textfield-error @endif" value="{{ old('subject') }}">
                            @if($errors->has('subject'))
                                <p class="text-input-error">{{ $errors->first('subject') }}</p>
                            @endif
                        </div>
                        <div class="textfield mt-2">
                            <label for="message">Message<span class="text-red-500">*</span></label>
                            <textarea name="message" id="message" placeholder="Entrez votre message">{{ old('message') }}</textarea>
                            @if($errors->has('message'))
                                <p class="text-input-error">{{ $errors->first('message') }}</p>
                            @endif
                        </div>
                        <div class="mt-3 text-center">
                            <button type="submit" class="btn-filled_secondary">Envoyer</button>
                        </div>
                        <div class="mt-5">
                            <p>Tous les champs comportant <span class="text-red-500">*</span> sont obligatoire.</p>
                            <p class="mt-3">
                                Aügur utilise les données recueillies pour traiter vos demandes. Pour en savoir plus sur
                                la gestion de vos données personnelles et pour exercer vos droits, reportez-vous à nos
                                <a href="{{ route('fo.conditions') }}" class="font-bold">conditions générales d'utilisation</a>
                            </p>
                        </div>
                    </form>
                </div>
                <div class="flex-1 lg:ml-2 lg:order-2 text-center lg:text-left">
                    @if($shops->count() > 0)
                        <h2>Retrouvez-nous</h2>
                        <ul class="mt-3">
                            @foreach($shops as $shop)
                                <li class="mb-2">{{$shop->address}}, {{ $shop->postal_code }} {{$shop->city}}</li>
                            @endforeach
                        </ul>
                    @endif
                    @if($settingGlobal->main_email || $settingGlobal->main_phone)
                        <h2 class="mt-10">Nous joindre</h2>
                        <ul class="mt-3">
                            @if($settingGlobal->main_email)
                                <li class="mb-2">{{ $settingGlobal->main_email }}</li>
                            @endif
                            @if($settingGlobal->main_phone)
                                <li class="mb-2">{{ $settingGlobal->main_phone }}</li>
                            @endif
                        </ul>
                    @endif
                    @if($settingGlobal->social_facebook || $settingGlobal->social_insta || $settingGlobal->social_twitter || $settingGlobal->social_youtube || $settingGlobal->social_linkedin)
                        <h2 class="mt-10">Nos réseaux sociaux</h2>
                        <div class="inline-flex items-center mt-3">
                            @if($settingGlobal->social_twitter)
                                <a href="{{ $settingGlobal->social_twitter }}" class="mr-2"><i class="fa-brands fa-twitter fa-2x"></i></a>
                            @endif
                            @if($settingGlobal->social_linkedin)
                                <a href="{{ $settingGlobal->social_linkedin }}" class="mr-2"><i class="fa-brands fa-linkedin fa-2x"></i></a>
                            @endif
                            @if($settingGlobal->social_youtube)
                                <a href="{{ $settingGlobal->social_youtube }}" class="mr-2"><i class="fa-brands fa-youtube fa-2x"></i></a>
                            @endif
                            @if($settingGlobal->social_insta)
                                <a href="{{ $settingGlobal->social_insta }}" class="mr-2"><i class="fa-brands fa-instagram fa-2x"></i></a>
                            @endif
                            @if($settingGlobal->social_facebook)
                                <a href="{{ $settingGlobal->social_facebook }}" class="mr-2"><i class="fa-brands fa-facebook fa-2x"></i></a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection
