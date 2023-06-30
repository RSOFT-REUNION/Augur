<div id="popup">
    <div class="entry-header">
        <div class="flex items-center">
            <div class="flex-1">
                <h1>Se connecter</h1>
            </div>
            <div class="flex-none">
                <a wire:click="$emit('closeModal')" class="btn-icon_secondary_2 block text-black"><i class="fa-solid fa-xmark"></i></a>
            </div>
        </div>
    </div>
    <div class="entry-content">
        <form wire:submit.prevent="connect">
            @csrf
            <div class="textfield">
                <label for="email">Adresse e-mail<span class="text-red-500">*</span></label>
                <input type="email" id="email" wire:model="email" name="email" placeholder="Entrez votre adresse e-mail" class="@if($errors->has('email'))textfield-error @endif" value="{{ old('email') }}">
                @if($errors->has('email'))
                    <p class="text-input-error">{{ $errors->first('email') }}</p>
                @endif
            </div>
            <div class="textfield mt-2">
                <label for="password">Mot de passe<span class="text-red-500">*</span></label>
                <input type="password" id="password" wire:model="password" name="password" placeholder="Entrez votre mot de passe" class="@if($errors->has('password'))textfield-error @endif" value="{{ old('password') }}">
                @if($errors->has('password'))
                    <p class="text-input-error">{{ $errors->first('password') }}</p>
                @endif
            </div>
            <div class="mt-5 text-right">
                <button type="submit" class="btn-filled_secondary">Se connecter</button>
            </div>
        </form>
    </div>
</div>
