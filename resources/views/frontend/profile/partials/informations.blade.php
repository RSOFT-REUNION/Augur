@extends('frontend.profile.dashboard')
@section('title', __('Mes informations') )


@section('dashboard-breadcrumb')
    <div style="margin-top: 60px;" class="mb-5">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-nav mt-5 p-3 rounded-3 shadow">
                <li class="breadcrumb-item"><a href="{{ route('index') }}"><i class="fa-solid fa-home"></i></a></li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Mon compte</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">Mes informations</li>
            </ol>
        </nav>
    </div>
@endsection

@section('dashboard-content')
    <div class="text-end mb-4">
        <a class="hvr-grow-shadow btn btn-warning" href="{{ route('dashboard') }}"><i class="fa-solid fa-circle-left"></i> Retour</a>
    </div>

    <h2>Mes informations</h2>

    <form> @csrf @method('PUT')
        <div class="form-check form-switch form-check-reverse mb-3" id="secnewsletter">
            @if($user->newsletter == 1)
            <input class="form-check-input newsletter-switch" type="checkbox" id="newsletter" name="newsletter" checked
                hx-post="{{ route('info.newsletter') }}" hx-target="#secnewsletter" hx-swap="outerHTML">
                <input type="hidden" name="value" value="off">
            @else
                <input class="form-check-input newsletter-switch" type="checkbox" id="newsletter" name="newsletter"
                       hx-post="{{ route('info.newsletter') }}" hx-target="#secnewsletter" hx-swap="outerHTML">
                <input type="hidden" name="value" value="on">
            @endif
            <label class="form-check-label h4" for="newsletter">Recevoir les newsletters</label>
        </div>
    </form>

    <div class="card p-3 hvr-shadow rounded-4 w-100 bg-gray mb-4">
        <header>
            <h3>{{ __('Profile Information') }}</h3>
        </header>

        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>
        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div class="alert alert-warning fade show text-center">
                <i class="fa-solid fa-circle-exclamation"></i> {{ __('Your email address is unverified.') }}
                <button form="send-verification" class="btn btn-primary hvr-grow-shadow">
                    <i class="fa-solid fa-share"></i> {{ __('Click here to re-send the verification email.') }}
                </button>
            </div>
        @endif
        <div class="row row-flex">
            <div class="col-12 col-md-2 content"></div>
            <div class="col-12 col-md-8 content">
                <form method="post" action="{{ route('info.update') }}" class="mt-6 space-y-6">
                    @csrf
                    @method('patch')

                    <div class="form-group mb-4">
                        <label class="form-control-label" for="name">Nom de famille : <span
                                class="small text-danger">*</span></label>
                        <input id="name" type="text" name="name"
                               class="@error('name') is-invalid @enderror form-control" required
                               value="{{ old('name', $user->name) }}">
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <label class="form-control-label" for="phone">Numéro de téléphone : <span class="small text-danger">*</span></label>
                        <input id="phone" type="text" name="phone"
                               class="@error('phone') is-invalid @enderror form-control" required
                               value="{{ old('phone', $user->phone) }}">
                        @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <label class="form-control-label" for="email">Adresse e-mail : <span
                                class="small text-danger">*</span></label>
                        <input id="email" type="email" name="email"
                               class="@error('email') is-invalid @enderror form-control" required
                               value="{{ old('email', $user->email) }}">
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="text-center">
                        <button class="btn btn-success hvr-grow-shadow"><i class="fa-solid fa-floppy-disk"></i> {{ __('Save') }}</button>
                    </div>
                </form>

            </div>
            <div class="col-12 col-md-2 content p-5"></div>
        </div>
    </div>

    @if (session('status') === 'profile-updated')
        <p
            x-data="{ show: true }"
            x-show="show"
            x-transition
            x-init="setTimeout(() => show = false, 2000)"
            class="text-sm text-gray-600"
        ><div class="alert alert-success w-auto fade show top-message text-end"><i class="fa-solid fa-check"></i> Vos information ont été changé avec succès</div></p>
    @endif


    <div class="card p-3 hvr-shadow rounded-4  w-100 bg-gray mb-4">
        <header>
            <h3>{{ __('Update Password') }}</h3>
            <p>{{ __('Ensure your account is using a long, random password to stay secure.') }}</p>
        </header>

        <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
            @csrf
            @method('put')

            <div class="form-group mb-4">
                <label class="form-control-label" for="update_password_current_password">{{ __('Current Password') }} : <span
                        class="small text-danger">*</span></label>
                <input id="update_password_current_password" type="password" name="current_password"  autocomplete="current-password"
                       class="@error('update_password_current_password') is-invalid @enderror form-control" required>
                @error('update_password_current_password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="form-group mb-4">
                        <label class="form-control-label" for="update_password_password">{{ __('New Password') }} : <span
                                class="small text-danger">*</span></label>
                        <input id="update_password_password" type="password" name="password" autocomplete="new-password"
                               class="@error('password') is-invalid @enderror form-control" required>
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group mb-4">
                        <label class="form-control-label" for="update_password_password_confirmation">{{ __('Confirm Password') }} : <span
                                class="small text-danger">*</span></label>
                        <input id="update_password_password_confirmation" type="password" name="password_confirmation"  autocomplete="new-password"
                               class="@error('password_confirmation') is-invalid @enderror form-control" required>
                        @error('password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>


            <div class="text-center">
                <button class="btn btn-success hvr-grow-shadow"><i class="fa-solid fa-floppy-disk"></i> {{ __('Save') }}</button>
            </div>
        </form>
    </div>
    @if (session('status') === 'password-updated')
        <p
            x-data="{ show: true }"
            x-show="show"
            x-transition
            x-init="setTimeout(() => show = false, 2000)"
            class="text-sm text-gray-600"
        ><div class="alert alert-success fade show top-message"><i class="fa-solid fa-check"></i> Votre mot de passe à été changé avec succès</div></p>
    @endif


@endsection
