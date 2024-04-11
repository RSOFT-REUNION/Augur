<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password"> {{ __('Current Password') }} </label>
            <input id="update_password_current_password" class="block mt-1 w-full" type="password" name="current_password" required  autocomplete="current-password"/>
            @if ($errors->get('current_password'))
                <ul class="text-sm text-red-600 space-y-1">
                    @foreach($errors->get('update_password_current_password') as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
        </div>

        <div>
            <label for="update_password_password"> {{ __('New Password') }} </label>
            <input id="update_password_password" class="block mt-1 w-full" type="password" name="password" required  autocomplete="new-password"/>
            @if ($errors->get('password'))
                <ul class="text-sm text-red-600 space-y-1">
                    @foreach($errors->get('password') as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
        </div>

        <div>
            <label for="update_password_password_confirmation"> {{ __('Confirm Password') }} </label>
            <input id="update_password_password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required  autocomplete="new-password"/>
            @if ($errors->get('password_confirmation'))
                <ul class="text-sm text-red-600 space-y-1">
                    @foreach($errors->get('password_confirmation') as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <button class="btn btn-primary ms-4">{{ __('Save') }}</button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
