<div id="popup">
    <div class="entry-header">
        <div class="flex items-center">
            <div class="flex-1">
                <h1>Ajouter un magasin</h1>
            </div>
            <div class="flex-none">
                <a wire:click="$emit('closeModal')" class="btn-icon_secondary_2 block text-black"><i class="fa-solid fa-xmark"></i></a>
            </div>
        </div>
    </div>
    <div class="entry-content">
        <form wire:submit.prevent="create" enctype="multipart/form-data">
            @csrf
            @if($cover)
                <div class="force-center mb-4">
                    <img src="{{ $cover->temporaryUrl() }}" class="image-preview">
                </div>
            @endif
            <div class="textfield">
                <label for="title">Nom du magasin<span class="text-red-500">*</span></label>
                <input type="text" id="title" wire:model="title" name="title" placeholder="Entrez le nom du magasin (ex: AÜGUR - Saint-Pierre)" class="@if($errors->has('title'))textfield-error @endif" value="{{ old('title') }}">
                @if($errors->has('title'))
                    <p class="text-input-error">{{ $errors->first('title') }}</p>
                @endif
            </div>
            <div class="textfield mt-2">
                <label for="cover">Image de couverture</label>
                <input type="file" id="cover" wire:model="cover" name="cover" class="@if($errors->has('cover'))textfield-error @endif" value="{{ old('cover') }}">
                @if($errors->has('cover'))
                    <p class="text-input-error">{{ $errors->first('cover') }}</p>
                @endif
            </div>
            <hr class="my-3">
            <div class="textfield">
                <label for="address">Adresse<span class="text-red-500">*</span></label>
                <input type="text" id="address" wire:model="address" name="address" placeholder="Entrez l'adresse du magasin" class="@if($errors->has('address'))textfield-error @endif" value="{{ old('address') }}">
                @if($errors->has('address'))
                    <p class="text-input-error">{{ $errors->first('address') }}</p>
                @endif
            </div>
            <div class="flex">
                <div class="flex-1 mr-2">
                    <div class="textfield">
                        <label for="city">Ville<span class="text-red-500">*</span></label>
                        <input type="text" id="address" wire:model="city" name="city" placeholder="Entrez la ville" class="@if($errors->has('city'))textfield-error @endif" value="{{ old('city') }}">
                        @if($errors->has('city'))
                            <p class="text-input-error">{{ $errors->first('city') }}</p>
                        @endif
                    </div>
                </div>
                <div class="flex-1 ml-2">
                    <div class="textfield">
                        <label for="postal">Code postal<span class="text-red-500">*</span></label>
                        <input type="text" id="postal" wire:model="postal" name="postal" placeholder="Entrez le code postal" class="@if($errors->has('postal'))textfield-error @endif" value="{{ old('postal') }}">
                        @if($errors->has('postal'))
                            <p class="text-input-error">{{ $errors->first('postal') }}</p>
                        @endif
                    </div>
                </div>
            </div>
            <hr class="my-3">
            <div class="textfield">
                <label for="description">Description courte</label>
                <textarea id="description" wire:model="description" placeholder="Entrez une courte description" class="@if($errors->has('description'))textfield-error @endif" value="{{ old('description') }}">{{ old('description') }}</textarea>
                @if($errors->has('description'))
                    <p class="text-input-error">{{ $errors->first('description') }}</p>
                @endif
            </div>
            <div class="mt-5 text-right">
                <button type="submit" class="btn-filled_secondary">Continuer<i class="fa-solid fa-arrow-right-long ml-2"></i></button>
            </div>
        </form>
    </div>
</div>
