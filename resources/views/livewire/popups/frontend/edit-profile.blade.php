<div id="popup">
    <div class="entry-header">
        <div class="flex items-center">
            <div class="flex-1">
                <h1>Modification de mon profil</h1>
            </div>
            <div class="flex-none">
                <a wire:click="$dispatch('closeModal')" class="btn-icon_secondary_2 block text-black"><i class="fa-solid fa-xmark"></i></a>
            </div>
        </div>
    </div>
    <div class="entry-content">
        <form wire:submit="edit">
            @csrf
            <div class="flex mt-5">
                <div class="flex-1 mr-1">
                    <div class="textfield">
                        <label for="lastname">Nom de famille<span class="text-red-500">*</span></label>
                        <input type="text" id="lastname" wire:model.live="lastname" name="lastname" placeholder="Entrez votre nom de famille" class="@if($errors->has('lastname'))textfield-error @endif" value="{{ old('lastname') }}">
                        @if($errors->has('lastname'))
                            <p class="text-input-error">{{ $errors->first('lastname') }}</p>
                        @endif
                    </div>
                </div>
                <div class="flex-1 ml-1">
                    <div class="textfield">
                        <label for="firstname">Prénom<span class="text-red-500">*</span></label>
                        <input type="text" id="firstname" wire:model.live="firstname" name="firstname" placeholder="Entrez votre prénom" class="@if($errors->has('firstname'))textfield-error @endif" value="{{ old('firstname') }}">
                        @if($errors->has('firstname'))
                            <p class="text-input-error">{{ $errors->first('firstname') }}</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="textfield mt-2">
                <label for="email">Adresse e-mail<span class="text-red-500">*</span></label>
                <input type="email" id="email" wire:model.live="email" name="email" placeholder="Entrez votre adresse e-mail" class="@if($errors->has('email'))textfield-error @endif" value="{{ old('email') }}">
                @if($errors->has('email'))
                    <p class="text-input-error">{{ $errors->first('email') }}</p>
                @endif
            </div>
            <div class="textfield mt-2">
                <label for="password">Mot de passe<span class="text-red-500">*</span></label>
                <input type="password" id="password" wire:model.live="password" name="password" placeholder="Modifier votre mot de passe" class="@if($errors->has('password'))textfield-error @endif">
                @if($errors->has('password'))
                    <p class="text-input-error">{{ $errors->first('password') }}</p>
                @endif
            </div>
            <div class="mt-5">
                <input type="checkbox" wire:model.live="newsletter" id="newsletter" @if($me->newsletter) checked @endif>
                <label for="newsletter" class="pl-2 cursor-pointer">@if($me->newsletter) Je ne souhaite plus être abonné à la newsletter @else Je souhaite être abonné à la newsletter @endif</label>
            </div>
            <div class="mt-5 text-right">
                <button type="submit" class="btn-filled_secondary">Modifier</button>
            </div>
        </form>
    </div>
</div>
