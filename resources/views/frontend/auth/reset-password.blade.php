@extends('frontend.layouts.layout')
@section('title', __('Mot de passe oublié') )

@section('main-content')
    <div class="row row-flex">
        <div class="col-12 col-md-3 content p-5"></div>
        <div class="col-12 col-md-6 content p-5">

            <h3 class="text-center mb-3">Rèinitialiser le mot de passe</h3>

            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="form-group mb-4">
                    <label class="form-control-label" for="email">Adresse e-mail : <span class="small text-danger">*</span></label>
                    <input id="email" type="text" name="email"
                           class="@error('email') is-invalid @enderror form-control" required
                           value="{{ old('email', $request->email) }}">
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-4">
                    <label class="form-control-label" for="password">Mot de passe : <span
                            class="small text-danger">*</span></label>
                    <input id="password" type="password" name="password"
                           class="@error('password') is-invalid @enderror form-control" required>
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-4">
                    <label class="form-control-label" for="password_confirmation">Confirmer le mot de passe :
                        <span class="small text-danger">*</span></label>
                    <input id="password_confirmation" type="password" name="password_confirmation"
                           class="@error('password_confirmation') is-invalid @enderror form-control" required>
                    @error('password_confirmation')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-center">
                    <button class="btn btn-primary hvr-grow-shadow">
                        {{ __('Reset Password') }}
                    </button>
                </div>

            </form>
        </div>
        <div class="col-12 col-md-3 content p-5"></div>
    </div>

@endsection
