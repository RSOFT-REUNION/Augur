@extends('frontend.layouts.layout')
@section('title', __('contactez-nous') )

@section('main-content')

    <div style="margin-top: 60px;" class="mb-5">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-nav mt-5 p-3 rounded-3 shadow">
                <li class="breadcrumb-item"><a href="{{ route('index') }}"><i class="fa-solid fa-home"></i></a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">Contactez-nous</li>
            </ol>
        </nav>
    </div>


    <div class="text-center mb-5">
        <h1>Contact</h1>
        <h3>Nous joindre facilement</h3>
    </div>

    <div class="row">
        <div class="col-6">
            <h2 class="text-center mb-4">Ecrivez-nous</h2>
            <div class="row">
                <div class="col-2"></div>
                <div class="col-8">
                        <div class="form-group mb-4">
                            <label class="form-control-label" for="name">Nom : <span
                                    class="small text-danger">*</span></label>
                            <input id="name" type="text" name="name"
                                   class="@error('name') is-invalid @enderror form-control" required
                                   value="{{ old('name') }}">
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label class="form-control-label" for="email">Adresse e-mail : <span
                                    class="small text-danger">*</span></label>
                            <input id="email" type="email" name="email"
                                   class="@error('email') is-invalid @enderror form-control" required
                                   value="{{ old('email') }}">
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label class="form-control-label" for="subject">Sujet : <span
                                    class="small text-danger">*</span></label>
                            <input id="subject" type="text" name="subject"
                                   class="@error('subject') is-invalid @enderror form-control" required
                                   value="{{ old('subject') }}">
                            @error('subject')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label class="form-control-label" for="message">Message : <span
                                    class="small text-danger">*</span></label>
                            <textarea rows="4" id="message" type="text" name="message"
                                   class="@error('message') is-invalid @enderror form-control" required>{{ old('message') }}</textarea>
                            @error('message')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    <div class="text-center">
                        <button class="btn btn-warning hvr-grow-shadow">
                            <i class="fa-regular fa-paper-plane"></i> {{ __('Envoyer') }}
                        </button>
                    </div>

                    <div class="mt-5">
                        <p>Tous les champs comportant <span class="text-red-500">*</span> sont obligatoire.</p>
                        <p class="mt-3">
                            Aügur utilise les données recueillies pour traiter vos demandes. Pour en savoir plus sur
                            la gestion de vos données personnelles et pour exercer vos droits, reportez-vous à nos
                            <a href="{{ route('termsofservice') }}" class="font-bold text-black">conditions générales d'utilisation</a>
                        </p>
                    </div>

                    </div>
                <div class="col-2"></div>
            </div>



        </div>
        <div class="col-6">
            <h2  class="text-center mb-4">Retrouvez-nous</h2>
            <p class="mb-2">90B rue du four à chaux, 97410 SAINT-PIERRE</p>
            <p class="mb-2">rue de l'étang, 97450 SAINT LOUIS</p>
            <p class="mb-2">1 rue Mahatma Gandhi, 97419 LA POSSESSION</p>
            <p class="mb-2">2 bis chemin Père Pauber, 97423 LE GUILLAUME</p>
            <p class="mb-2">298 rue Hubert Delisle, 97430 LE TAMPON</p>
            <p class="mb-2">134 rue Mélodium, 97440 SAINT ANDRé</p>
            <p class="mb-2">rue lucien ducheman, 97470 SAINT BENOîT</p>
            <p class="mb-2">Résidence les Sables - 33 bis rue Jules Auber, 97400 SAINT DENIS</p>
            <p class="mb-2">46 rue Raphaël Babet, 97480 SAINT JOSEPH</p>
            <p class="mb-2">22 rue d'Australie, 97450 SAINT LOUIS</p>
            <p class="mb-2">13 bis rue François Isautier, 97410 SAINT PIERRE</p>
            <p class="mb-2">20 BIS rue de la République, 97438 SAINTE MARIE</p>
            <p class="mb-2">9 rue du Général de Gaulle, 97426 TROIS-BASSINS</p>
            <h2 class="text-center mb-4 mt-4">Nous joindre</h2>
            <p class="mb-2">Mail : augur-saint-pierre@augur.re</p>
            <p class="mb-2">Téléphone : 0693 66 18 92</p>
        </div>
    </div>
@endsection
