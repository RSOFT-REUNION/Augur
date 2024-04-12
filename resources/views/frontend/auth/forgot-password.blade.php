@extends('frontend.layouts.layout')
@section('title', __('Mot de passe oublié') )

@section('main-content')
    <div class="row row-flex">
        <div class="col-12 col-md-3 content p-5"></div>
        <div class="col-12 col-md-6 content p-5">
            <h3>Mot de passe oublié</h3>
            <p>{{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}</p>

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div class="form-group mb-4">
                    <label class="form-control-label" for="email">Adresse e-mail : <span class="small text-danger">*</span></label>
                    <input id="email" type="text" name="email"
                           class="@error('email') is-invalid @enderror form-control" required
                           value="{{ old('email') }}">
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-center">
                    <button class="btn btn-primary hvr-grow-shadow">
                        {{ __('Email Password Reset Link') }}
                    </button>
                </div>

            </form>
        </div>
        <div class="col-12 col-md-3 content p-5"></div>
    </div>

@endsection
