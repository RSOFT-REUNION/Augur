<form method="POST" action="{{ route('register') }}">
@csrf

    <h2 class="text-center mb-5">Effectuer une demande de compte</h2>

    <div class="mt-4">
        <label for="name"> {{ __('Name') }} </label>
        <input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ old('name') }}" required autofocus  autocomplete="name"/>
        @if ($errors->get('name'))
            <ul class="text-sm text-red-600 space-y-1">
                @foreach($errors->get('name') as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    </div>

    <div class="mt-4">
        <label for="email"> {{ __('Email') }} </label>
        <input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ old('email') }}" required  autocomplete="username"/>
        @if ($errors->get('email'))
            <ul class="text-sm text-red-600 space-y-1">
                @foreach($errors->get('email') as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    </div>

    <div class="mt-4">
        <label for="password"> {{ __('Password') }} </label>
        <input id="password" class="block mt-1 w-full" type="password" name="password" required  autocomplete="new-password"/>
        @if ($errors->get('password'))
            <ul class="text-sm text-red-600 space-y-1">
                @foreach($errors->get('password') as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    </div>

    <div class="mt-4">
        <label for="password_confirmation"> {{ __('Confirm Password') }} </label>
        <input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required  autocomplete="new-password"/>
        @if ($errors->get('password_confirmation'))
            <ul class="text-sm text-red-600 space-y-1">
                @foreach($errors->get('password_confirmation') as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    </div>

    <div class="flex items-center justify-end mt-4">
        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
            {{ __('Already registered?') }}
        </a>

        <button class="btn btn-primary ms-4">
            {{ __('Register') }}
        </button>
    </div>

</form>
