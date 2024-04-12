<section class="card p-3 hvr-shadow rounded-4">
    <header>
        <h3>{{ __('Profile Information') }}</h3>
        <p>{{ __("Update your account's profile information and email address.") }}</p>
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
            <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
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
                    <label class="form-control-label" for="first_name">Prénom : <span class="small text-danger">*</span></label>
                    <input id="first_name" type="text" name="first_name"
                           class="@error('first_name') is-invalid @enderror form-control" required
                           value="{{ old('first_name', $user->first_name) }}">
                    @error('first_name')
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
</section>
@if (session('status') === 'verification-link-sent')
    <div class="alert alert-success fade show top-message">
        <i class="fa-solid fa-check"></i> {{ __('A new verification link has been sent to your email address.') }}
    </div>
@endif
@if (session('status') === 'profile-updated')
    <p
        x-data="{ show: true }"
        x-show="show"
        x-transition
        x-init="setTimeout(() => show = false, 2000)"
        class="text-sm text-gray-600"
    ><div class="alert alert-success fade show top-message"><i class="fa-solid fa-check"></i> Vos information ont été changé avec succès</div></p>
@endif
