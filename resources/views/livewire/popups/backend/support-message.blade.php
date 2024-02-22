<div id="popup">
    <div class="entry-header">
        <div class="flex items-center">
            <div class="flex-1">
                <h1>Envoyer un message au support RSOFT</h1>
            </div>
            <div class="flex-none">
                <a wire:click="$dispatch('closeModal')" class="btn-icon_secondary_2 block text-black"><i class="fa-solid fa-xmark"></i></a>
            </div>
        </div>
    </div>
    <div class="entry-content">
        <p class="bg-gray-100 px-4 py-2 rounded-lg">
            Vous êtes sur le point d'envoyer un message au support RSOFT, nous reçevront un mail contenant vos coordonnées et les informations de votre demande.<br>
            <b>Veuillez noter que le délais et les modalités de traitement dépendrons du statut de votre contrat de maintenance</b>
        </p>
        <form wire:submit="send" class="mt-4">
            @csrf
            <div class="textfield">
                <label for="type">Type de demande<span class="text-red-500">*</span></label>
                <select wire:model.live="type" id="type">
                    <option value="">-- Sélectionner un type --</option>
                    <option value="1">Bugs bloquant rencontré</option>
                    <option value="2">Bugs non bloquant rencontré</option>
                    <option value="3">Demande d'amélioration</option>
                    <option value="4">Demande d'ajout de fonctionnalités</option>
                    <option value="5">Autre</option>
                </select>
            </div>
            @if($type == 5)
                <div class="textfield mt-2">
                    <label for="other">Votre sujet<span class="text-red-500">*</span></label>
                    <input type="text" id="other" wire:model.live="other" name="other" placeholder="Entrez votre sujet" class="@if($errors->has('other'))textfield-error @endif" value="{{ old('other') }}">
                    @if($errors->has('other'))
                        <p class="text-input-error">{{ $errors->first('other') }}</p>
                    @endif
                </div>
            @endif
            <div class="textfield mt-2">
                <label for="message">Votre message</label>
                <textarea wire:model.live="message" id="message" placeholder="Entrez votre message.">{{ old('message') }}</textarea>
                @if($errors->has('message'))
                    <p class="text-input-error">{{ $errors->first('message') }}</p>
                @endif
            </div>
            <div class="mt-5">
                <button type="submit" class="btn-filled_secondary">Envoyer</button>
            </div>
        </form>
    </div>
</div>
