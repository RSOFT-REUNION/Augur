<div>
    <form wire:submit.prevent="create" enctype="multipart/form-data">
        @csrf
        <div class="entry-header flex items-center">
            <div class="flex-1 inline-flex items-center">
                <a href="{{ route('bo.recette') }}" class="btn-icon_secondary mr-3"><i class="fa-solid fa-arrow-left"></i></a>
                <h1>Ajouter une recette</h1>
            </div>
            <div class="flex-none inline-flex items-center">
                <button type="submit" class="btn-filled_primary"><i class="fa-solid fa-floppy-disk mr-2"></i>Publier</button>
            </div>
        </div>
        <div class="entry-content">
            <div class="textfield">
                <label for="title">Nom de la recette<span class="text-red-500">*</span></label>
                <input type="text" id="title" wire:model="title" name="title" placeholder="Entrez le nom de votre recette" class="@if($errors->has('title'))textfield-error @endif" value="{{ old('title') }}">
                @if($errors->has('title'))
                    <p class="text-input-error">{{ $errors->first('title') }}</p>
                @endif
            </div>
            <div class="textfield mt-2">
                <label for="image">Image de couverture<span class="text-red-500">*</span></label>
                <input type="file" id="image" wire:model="image" name="image" class="@if($errors->has('image'))textfield-error @endif" value="{{ old('image') }}">
                @if($errors->has('image'))
                    <p class="text-input-error">{{ $errors->first('image') }}</p>
                @endif
            </div>
            <div class="textfield mt-2">
                <label for="number">Il s'agit d'une recette pour combien de personnes ?<span class="text-red-500">*</span></label>
                <input type="number" id="number" wire:model="number" name="number" step="1" placeholder="Ex. 4 (Les ingrédients pour 4 personnes)" class="@if($errors->has('number'))textfield-error @endif" value="{{ old('number') }}">
                @if($errors->has('number'))
                    <p class="text-input-error">{{ $errors->first('number') }}</p>
                @endif
            </div>
            <div class="textfield mt-2">
                <label for="description">Description</label>
                <textarea wire:model="description" id="description" placeholder="Entrez une description">{{ old('description') }}</textarea>
                @if($errors->has('description'))
                    <p class="text-input-error">{{ $errors->first('description') }}</p>
                @endif
            </div>
            <hr class="my-5">
            <div class="flex items-center">
                <div class="flex-1">
                    <h2>Liste des ingrédients</h2>
                </div>
                <div class="flex-none">
                    <button wire:click="" class="btn-filled_primary"><i class="fa-solid fa-plus mr-2"></i>Ajouter</button>
                </div>
            </div>
            <div class="bg-gray-100 px-4 pt-2 pb-4 rounded-lg mt-5">
                <form wire:submit.prevent="createIngredient">
                    @csrf
                    <div class="flex items-end">
                        <div class="flex-1">
                            <div class="textfield-white">
                                <label for="ingredient">Ingrédient<span class="text-red-500">*</span></label>
                                <input type="text" id="ingredient" wire:model="ingredient" name="ingredient" placeholder="Ex: 300g de sucre roux" class="@if($errors->has('ingredient'))textfield-error @endif" value="{{ old('ingredient') }}">
                                @if($errors->has('ingredient'))
                                    <p class="text-input-error">{{ $errors->first('ingredient') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="flex-none ml-3">
                            <button type="submit" class="btn-filled_secondary">Ajouter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </form>
</div>
