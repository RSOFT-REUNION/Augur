@extends('frontend.layouts.layout')
@section('title', __('Register') )

@section('main-content')

    <div style="margin-top: 60px;">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-nav mt-5 p-3 rounded-3 shadow">
                <li class="breadcrumb-item"><a href="{{ route('index') }}"><i class="fa-solid fa-home"></i></a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">{{ __('Register') }}</li>
            </ol>
        </nav>
    </div>

    <div class="row row-flex">
        <div class="col-12 col-md-3 content p-5"></div>
        <div class="col-12 col-md-6 content p-5">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <h1 class="text-center mb-5">Bienvenue sur Augur</h1>
                <p>Créez en quelques minutes votre compte pour profiter pleinement de votre Programme de Fidélité, commander en ligne en Livraison à domicile ou en Click & Collect, et encore plein d'autres fonctionnalités.</p>

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
                    <label class="form-control-label" for="phone">Numéro de téléphone : <span class="small text-danger">*</span></label>
                    <input id="phone" type="text" name="phone"
                           class="@error('phone') is-invalid @enderror form-control" required
                           value="{{ old('phone') }}">
                    @error('phone')
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

                <div class="row">
                    <div class="col-6">
                        <div class="form-group mb-4">
                            <label class="form-control-label" for="password">Mot de passe : <span
                                    class="small text-danger">*</span></label>
                            <input id="password" type="password" name="password"
                                   class="@error('password') is-invalid @enderror form-control" required>
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group mb-4">
                            <label class="form-control-label" for="password_confirmation">Confirmer le mot de passe :
                                <span class="small text-danger">*</span></label>
                            <input id="password_confirmation" type="password" name="password_confirmation"
                                   class="@error('password_confirmation') is-invalid @enderror form-control" required>
                            @error('password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-check form-switch mb-3 pl-5">
                    <input type="checkbox" class="form-check-input" id="newsletter"
                           name="newsletter" {{ old('newsletter') ? 'checked' : '' }}>
                    <label class="form-check-label" for="newsletter">Je souhaite m'abonner à la newsletter</label>
                </div>

                <div class="form-check form-switch mb-5 pl-5">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }} required>
                    <label class="form-check-label" for="remember">J'accepte les <a href="{{ route('legalnotice') }}" target="_blank" class="blackcolor">Mentions légales</a> et les <a class="blackcolor" href="{{ route('termsofservice') }}" target="_blank">CGU</a> <span class="small text-danger">*</span></label>
                </div>

                <div class="text-center">
                    <button class="btn btn-primary btn-lg hvr-grow-shadow w-100">
                        {{ __('Register') }}
                    </button>
                </div>

            </form>
        </div>
        <div class="col-12 col-md-3 content p-5"></div>
    </div>
@endsection
