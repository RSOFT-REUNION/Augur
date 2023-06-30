<div id="popup">
    <div class="entry-header">
        <div class="flex items-center">
            <div class="flex-1">
                <h1>Ajouter un media</h1>
            </div>
            <div class="flex-none">
                <a wire:click="$emit('closeModal')" class="btn-icon_secondary_2 block text-black"><i class="fa-solid fa-xmark"></i></a>
            </div>
        </div>
    </div>
    <div class="entry-content">
        {{--<form wire:submit.prevent="add" enctype="multipart/form-data">
            @csrf
            @if($picture)
                <img src="{{ $picture->temporaryUrl() }}" class="image-preview mb-5">
            @endif
            <div class="textfield">
                <label for="type">Type de média<span class="text-red-500">*</span></label>
                <select wire:model="type" id="type" class="@if($errors->has('type'))textfield-error @endif">
                    <option value="">-- Sélectionner un type --</option>
                    <option value="1">Image produit</option>
                    <option value="2">Image Label</option>
                    <option value="3">Image magasin</option>
                    <option value="3">Image évènement</option>
                </select>
                @if($errors->has('type'))
                    <p class="text-input-error">{{ $errors->first('type') }}</p>
                @endif
            </div>
            <div class="textfield mt-2">
                <label for="key">Clé unique (par défaut le titre)</label>
                <input type="text" id="key" wire:model="key" name="key" placeholder="Entrez le titre de l'image" class="@if($errors->has('key'))textfield-error @endif" value="{{ old('key') }}">
                @if($errors->has('key'))
                    <p class="text-input-error">{{ $errors->first('key') }}</p>
                @endif
            </div>
            <div class="textfield mt-2">
                <label for="title">Titre<span class="text-red-500">*</span></label>
                <input type="text" id="title" wire:model="title" name="title" placeholder="Entrez le titre de l'image" class="@if($errors->has('title'))textfield-error @endif" value="{{ old('title') }}">
                @if($errors->has('title'))
                    <p class="text-input-error">{{ $errors->first('title') }}</p>
                @endif
            </div>
            <div class="textfield mt-2">
                <div class="flex items-center">
                    <div class="flex-1">
                        <label for="picture">Photo<span class="text-red-500">*</span></label>
                    </div>
                    <div class="flex-none">
                        <div wire:loading wire:target="picture">
                            <p class="text-red-500">En cours d'ajout...</p>
                        </div>
                    </div>
                </div>
                <input type="file" id="picture" wire:model="picture" name="picture" class="@if($errors->has('picture'))textfield-error @endif">
                @if($errors->has('picture'))
                    <p class="text-input-error">{{ $errors->first('picture') }}</p>
                @endif
            </div>
            <div class="mt-5 text-right">
                <button type="submit" class="btn-filled_secondary">Ajouter</button>
            </div>
        </form>--}}
        <p class="empty-text">Cette fonctionnalité arrive bientôt</p>
    </div>
</div>
