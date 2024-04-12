<section class="card p-3 hvr-shadow rounded-4 mb-5">
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
</section>
@if (session('status') === 'password-updated')
    <p
        x-data="{ show: true }"
        x-show="show"
        x-transition
        x-init="setTimeout(() => show = false, 2000)"
        class="text-sm text-gray-600"
    ><div class="alert alert-success fade show top-message"><i class="fa-solid fa-check"></i> Votre mot de passe à été changé avec succès</div></p>
@endif
