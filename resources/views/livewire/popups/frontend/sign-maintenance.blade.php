<div id="popup">
    <div class="entry-header">
        <div class="flex items-center">
            <div class="flex-1">
                <h1>Se connecter</h1>
            </div>
            <div class="flex-none">
                <a wire:click="$dispatch('closeModal')" class="btn-icon_secondary_2 block text-black"><i class="fa-solid fa-xmark"></i></a>
            </div>
        </div>
    </div>
    <div class="entry-content">
        <form wire:submit="connect">
            @csrf
            <div class="textfield">
                <label for="email">Adresse e-mail<span class="text-red-500">*</span></label>
                <input type="email" id="email" wire:model.live="email" name="email" placeholder="Entrez votre adresse e-mail" class="@if($errors->has('email'))textfield-error @endif" value="{{ old('email') }}">
                @if($errors->has('email'))
                    <p class="text-input-error">{{ $errors->first('email') }}</p>
                @endif
            </div>
            <div class="textfield mt-2">
                <label for="password">Mot de passe<span class="text-red-500">*</span></label>
                <input type="password" id="password" wire:model.live="password" name="password" placeholder="Entrez votre mot de passe" class="@if($errors->has('password'))textfield-error @endif" value="{{ old('password') }}">
                @if($errors->has('password'))
                    <p class="text-input-error">{{ $errors->first('password') }}</p>
                @endif
            </div>
            @if($errors->has('email') || $errors->has('email'))
                <div class="bg-red-100 px-3 py-1 text-sm mt-2 rounded-lg">
                    <p>Vous ne semblez pas faire partie de l'organisation ou bien vous vous êtes trompé dans vos identifiants</p>
                </div>
            @endif
            <div class="mt-5 text-right">
                <button type="submit" class="btn-filled_secondary">Se connecter</button>
            </div>
        </form>
    </div>
</div>
