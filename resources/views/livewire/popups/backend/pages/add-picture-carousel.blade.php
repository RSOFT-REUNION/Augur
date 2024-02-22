<div id="popup">
    <div class="entry-header">
        <div class="flex items-center">
            <div class="flex-1">
                <h1>Ajouter une image</h1>
            </div>
            <div class="flex-none">
                <a wire:click="$dispatch('closeModal')" class="btn-icon_secondary_2 block text-black"><i class="fa-solid fa-xmark"></i></a>
            </div>
        </div>
    </div>
    <form wire:submit="create" enctype="multipart/form-data">
        @csrf
        <div class="entry-content">
            @if($cover)
                <div class="force-center mb-5">
                    <img src="{{ $cover->temporaryUrl() }}" class="image-preview"/>
                </div>
            @endif
            <div class="textfield">
                <label for="key">Clé (uniquement visible dans votre espace)<span class="text-red-500">*</span></label>
                <input type="text" id="key" wire:model.live="key" name="key" placeholder="Entrez une clé" class="@if($errors->has('key'))textfield-error @endif" value="{{ old('key') }}">
                @if($errors->has('key'))
                    <p class="text-input-error">{{ $errors->first('key') }}</p>
                @endif
            </div>
            <div class="textfield mt-2">
                <label for="cover">Image<span class="text-red-500">*</span></label>
                <input type="file" id="cover" wire:model.live="cover" name="cover" class="@if($errors->has('cover'))textfield-error @endif" value="{{ old('cover') }}">
                @if($errors->has('cover'))
                    <p class="text-input-error">{{ $errors->first('cover') }}</p>
                @endif
            </div>
            <p class="bg-yellow-200 px-3 py-1 rounded-lg mt-2 text-sm">Vous devez fournir une image au format 1920x600</p>
        </div>
        <div class="mt-5 mx-5 mb-3 text-right">
            <button type="submit" class="btn-filled_secondary">Ajouter</button>
        </div>
    </form>
</div>
