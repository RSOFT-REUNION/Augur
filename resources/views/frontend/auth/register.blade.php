@extends('frontend.layouts.layout')
@section('title', __('Connexion') )

@section('main-content')
    <div class="row row-flex">
        <div class="col-12 col-md-3 content p-5"></div>
        <div class="col-12 col-md-6 content p-5">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <h3 class="text-center mb-5">Effectuer une demande de compte</h3>

                <div class="form-group mb-4">
                    <label class="form-control-label" for="name">Nom de famille : <span
                            class="small text-danger">*</span></label>
                    <input id="name" type="text" name="name"
                           class="@error('name') is-invalid @enderror form-control" required
                           value="{{ old('name') }}">
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-4">
                    <label class="form-control-label" for="first_name">Prénom : <span class="small text-danger">*</span></label>
                    <input id="first_name" type="text" name="first_name"
                           class="@error('first_name') is-invalid @enderror form-control" required
                           value="{{ old('first_name') }}">
                    @error('first_name')
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

                <div class="form-check form-switch mb-3 pl-5">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember"
                           {{ old('remember') ? 'checked' : '' }} required>
                    <label class="form-check-label" for="remember">J'accepte les <a href="{{ route('legalnotice') }}"
                                                                                    target="_blank" class="blackcolor">Mentions
                            légales</a> et les <a class="blackcolor" href="{{ route('termsofservice') }}"
                                                  target="_blank">CGU</a> <span
                            class="small text-danger">*</span></label>
                </div>

                <div class="text-center">
                    <button class="btn btn-primary ms-4">
                        {{ __('Register') }}
                    </button>
                </div>

            </form>
        </div>
        <div class="col-12 col-md-3 content p-5"></div>
    </div>
@endsection
