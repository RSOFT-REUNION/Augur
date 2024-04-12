@extends('frontend.layouts.layout')
@section('title', __('Connexion') )

@section('main-content')
    <div class="row row-flex">
        <div class="col-12 col-md-3 content p-5"></div>
        <div class="col-12 col-md-6 content p-5">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <h3 class="text-center mb-5">Connexion à votre compte</h3>

                <div class="form-group mb-4">
                    <label class="form-control-label" for="email">Adresse e-mail : <span class="small text-danger">*</span></label>
                    <input id="email" type="text" name="email"
                           class="@error('email') is-invalid @enderror form-control" required
                           value="{{ old('email') }}">
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-4">
                    <label class="form-control-label" for="password">Mot de passe : <span class="small text-danger">*</span></label>
                    <input id="password" type="password" name="password"
                           class="@error('password') is-invalid @enderror form-control" required
                           value="{{ old('password') }}">
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-check form-switch mb-3 pl-5">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">{{ __('Remember me') }}</label>
                </div>

                @if (Route::has('password.request'))
                    <div class="mb-3">
                        <a class="text-decoration-none blackcolor" href="{{ route('password.request') }}">
                            <i class="fa-solid fa-lock"></i> {{ __('Forgot your password?') }}
                        </a>
                    </div>
                @endif

                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary hvr-grow-shadow">
                        {{ __('Login') }}
                    </button>
                    <a href="{{ route('register') }}" class="btn btn-warning hvr-grow-shadow">
                        Créer un compte
                    </a>
                </div>
            </form>
        </div>
        <div class="col-12 col-md-3 content p-5"></div>
    </div>
@endsection
