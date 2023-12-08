<div id="popup">
    <div class="entry-header">
        <div class="flex items-center">
            <div class="flex-1">
                <h1>Informations de participation</h1>
            </div>
            <div class="flex-none">
                <a wire:click="$emit('closeModal')" class="btn-icon_secondary_2 block text-black"><i class="fa-solid fa-xmark"></i></a>
            </div>
        </div>
    </div>
    <form wire:submit.prevent="create" class="entry-content">
        <div class="bg-secondary border border-secondary bg-opacity-20 rounded-lg py-3 flex flex-row items-center justify-center mb-3">
            <h2>Ces informations sont requises pour participer à cette animation.</h2>
        </div>
        @if(session('error'))
            <div class="flex flex-row items-center justify-center bg-red-500 bg-opacity-30 border border-red-500 py-2 rounded-lg mb-3 text-red-500">
                <p>{{ session('error') }}</p>
            </div>
        @endif
        <div class="textfield mb-2">
            <label for="lastname">Nom<span class="text-red-500">*</span></label>
            <input type="text" id="lastname" wire:model="lastname" name="lastname" placeholder="Entrez votre nom" class="@if($errors->has('lastname'))textfield-error @endif">
            @if($errors->has('lastname'))
                <p class="text-input-error">{{ $errors->first('lastname') }}</p>
            @endif
        </div>
        <div class="textfield mb-2">
            <label for="firstname">Prénom<span class="text-red-500">*</span></label>
            <input type="text" id="firstname" wire:model="firstname" name="firstname" placeholder="Entrez votre prénom" class="@if($errors->has('firstname'))textfield-error @endif">
            @if($errors->has('firstname'))
                <p class="text-input-error">{{ $errors->first('firstname') }}</p>
            @endif
        </div>
        <div class="textfield mb-2">
            <label for="mail">Adresse e-mail<span class="text-red-500">*</span></label>
            <input type="text" id="mail" wire:model="mail" name="mail" placeholder="Entrez votre adresse e-mail" class="@if($errors->has('mail'))textfield-error @endif">
            @if($errors->has('mail'))
                <p class="text-input-error">{{ $errors->first('mail') }}</p>
            @endif
        </div>
        <div class="textfield mb-2">
            <label for="phone">Numéro de téléphone<span class="text-red-500">*</span></label>
            <input type="text" id="phone" wire:model="phone" name="phone" placeholder="Entrez votre numéro de téléphone" class="@if($errors->has('phone'))textfield-error @endif">
            @if($errors->has('phone'))
                <p class="text-input-error">{{ $errors->first('phone') }}</p>
            @endif
        </div>
        <div class="mt-5 text-right mb-2">
            <button type="submit" class="btn-filled_secondary"><i class="fa-solid fa-circle-check mr-2"></i>Validé ma participation</button>
        </div>
    </form>
</div>
