<div id="popup">
    <div class="entry-header">
        <div class="flex items-center">
            <div class="flex-1">
                <h1>Configuration de l'utilisateur</h1>
            </div>
            <div class="flex-none">
                <a wire:click="$emit('closeModal')" class="btn-icon_secondary_2 block text-black"><i class="fa-solid fa-xmark"></i></a>
            </div>
        </div>
    </div>
    <div class="entry-content">
        <form wire:submit.prevent="createUser">
            @csrf
            <p class="mb-3">
                Vous devez noter que la liaison avec le code client EBP est nécessaire pour la récupération des points de fidélités EBP du client.
                <span class="text-red-400">
                    Vous pouvez également accepter un compte sans code client EBP, il n'est donc pas obligatoire de remplir la zone
                </span>
            </p>
            <div class="textfield">
                <label for="EBP_customer">Code client EBP</label>
                <input type="text" id="EBP_customer" wire:model="EBP_customer" name="EBP_customer" placeholder="Entrez le code client EBP" class="@if($errors->has('EBP_customer'))textfield-error @endif" value="{{ old('EBP_customer') }}">
                @if($errors->has('EBP_customer'))
                    <p class="text-input-error">{{ $errors->first('EBP_customer') }}</p>
                @endif
            </div>
            <div class="mt-5 text-right">
                <button type="submit" class="btn-filled_primary"><i class="fa-solid fa-user-plus mr-3"></i>Créer le compte</button>
            </div>
        </form>
    </div>
</div>
