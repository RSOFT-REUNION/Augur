<form method="POST" action="{{ route('login') }}">
    @csrf

    <h2 class="text-center mb-5">Connexion à votre compte</h2>

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

    <div class="form-check form-switch mb-3 pl-5 fs-5">
        <input type="checkbox" class="form-check-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
        <label class="form-check-label" for="remember">{{ __('Remember me') }}</label>
    </div>

    <div class="form-group text-center">
        <button type="submit" class="btn btn-lg btn-primary hvr-grow-shadow">
            {{ __('Login') }}
        </button>
    </div>
</form>
