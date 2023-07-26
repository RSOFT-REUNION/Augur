<div id="popup">
    <div class="entry-header">
        <div class="flex items-center">
            <div class="flex-1">
                <h1>Modifier un produit</h1>
            </div>
            <div class="flex-none">
                <a wire:click="$emit('closeModal')" class="btn-icon_secondary_2 block text-black"><i class="fa-solid fa-xmark"></i></a>
            </div>
        </div>
    </div>
    <div class="entry-content">
        <p class="info">
            Vous êtes sur le point de modifier un produit sur votre site. Vous pouvez à tout moment modifier a nouveau votre produit une fois celui-ci modifier.
        </p>
        <form wire:submit.prevent="create" enctype="multipart/form-data" class="mt-3">
            @csrf
            {{--@if($image)
                <img src="{{ $image->temporaryUrl() }}" class="image-preview  mb-4">
            @endif--}}
            <div class="textfield">
                <label for="title">Nom du produit<span class="text-red-500">*</span></label>
                <input type="text" id="title" wire:model="title" name="title" placeholder="Entrez le nom du produit" class="@if($errors->has('title'))textfield-error @endif" value="{{ old('title') }}">
                @if($errors->has('title'))
                    <p class="text-input-error">{{ $errors->first('title') }}</p>
                @endif
            </div>
            <div class="textfield mt-2">
                <label for="univers">Univers du produit<span class="text-red-500">*</span></label>
                <select wire:model="univers" id="univers" class="@if($errors->has('univers'))textfield-error @endif">
                    <option value="">-- Sélectionner un univers --</option>
                    @foreach($uni as $u)
                        <option value="{{ $u->id }}">{{ $u->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="textfield mt-2">
                <div class="flex items-center">
                    <div class="flex-1">
                        <label for="image">Image</label>
                    </div>
                    <div class="flex-none">
                        <p class="text-sm" wire:loading wire:dirty.class="text-yellow-500" wire:target="image"><i class="fa-solid fa-spinner fa-spin mr-2"></i>En cours d'ajout</p>
                    </div>
                </div>
                <input type="file" id="image" wire:model="image" name="image" class="@if($errors->has('image'))textfield-error @endif" value="{{ old('image') }}">
                @if($errors->has('image'))
                    <p class="text-input-error">{{ $errors->first('image') }}</p>
                @endif
            </div>
            <p class="mt-1 bg-yellow-100 text-sm px-2 py-1 rounded-lg">Si vous ne souhaitez pas modifier votre photo produit, merci de laisser vide ce champ.</p>
            <div class="textfield mt-2">
                <label for="tags">Étiquettes <span class="text-sm bg-gray-200 py-1 px-2 rounded-lg">liste séparée par ;</span> </label>
                <input type="text" id="tags" wire:model="tags" name="tags" placeholder="Entrez des étiquettes et séparé les par des ;" class="mt-2 @if($errors->has('tags'))textfield-error @endif" value="{{ old('tags') }}">
                @if($errors->has('tags'))
                    <p class="text-input-error">{{ $errors->first('tags') }}</p>
                @endif
            </div>
            <div class="textfield mt-2">
                <label for="labels">Labels concernés (éviter les fautes) <span class="text-sm bg-gray-200 py-1 px-2 rounded-lg">liste séparée par ;</span> </label>
                <input type="text" id="labels" wire:model="labels" name="labels" placeholder="Entrez des labels et séparé les par des ;" class="mt-2 @if($errors->has('labels'))textfield-error @endif" value="{{ old('labels') }}">
                @if($errors->has('labels'))
                    <p class="text-input-error">{{ $errors->first('labels') }}</p>
                @endif
            </div>
            <div class="textfield mt-2">
                <label for="description">Description</label>
                <textarea wire:model="description" id="description" placeholder="Entrez une description">{{ old('description') }}</textarea>
                @if($errors->has('description'))
                    <p class="text-input-error">{{ $errors->first('description') }}</p>
                @endif
            </div>
            <div class="mt-5 text-right">
                <button type="submit" class="btn-filled_secondary"><i class="fa-solid fa-circle-plus mr-3"></i>Modifier</button>
            </div>
        </form>
    </div>
</div>

