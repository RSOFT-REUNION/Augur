<div id="popup">
    <div class="entry-header">
        <div class="flex items-center">
            <div class="flex-1">
                <h1>Ajout d'un univers</h1>
            </div>
            <div class="flex-none">
                <a wire:click="$emit('closeModal')" class="btn-icon_secondary_2 block text-black"><i class="fa-solid fa-xmark"></i></a>
            </div>
        </div>
    </div>
    <div class="entry-content">
        <form wire:submit.prevent="create" enctype="multipart/form-data" class="mt-3">
            @csrf
            @if($image)
                <img src="{{ $image->temporaryUrl() }}" class="image-preview  mb-4">
            @endif
            <div class="textfield">
                <label for="key">Emplacement dans le menu<span class="text-red-500">*</span></label>
                <select wire:model="key" id="key">
                    <option value="">-- Sélectionner un emplacement --</option>
                    <option value="1">Emplacement 1</option>
                    <option value="2">Emplacement 2</option>
                    <option value="3">Emplacement 3</option>
                    <option value="4">Emplacement 4</option>
                </select>
            </div>
            @if(!$key)
                <p class="bg-gray-100 px-2 py-1 rounded-lg mt-1 text-sm">Vous n'avez pas encore séléctionné d'emplacement</p>
            @else
                <p class="mb-1 mt-3">Aperçu des emplacements</p>
                <div class="flex bg-gray-100 mt-2 rounded-lg overflow-hidden p-1">
                    <div class="flex-1 rounded-md border-dotted border border-gray-300 text-center py-5 mr-1 @if($key == 1) bg-yellow-300 font-bold @endif">
                        <p>Emplacement 1</p>
                    </div>
                    <div class="flex-1 rounded-md border-dotted border border-gray-300 text-center py-5 mr-1 @if($key == 2) bg-yellow-300 font-bold @endif">
                        <p>Emplacement 2</p>
                    </div>
                    <div class="flex-1 rounded-md border-dotted border border-gray-300 text-center py-5 mr-1 @if($key == 3) bg-yellow-300 font-bold @endif">
                        <p>Emplacement 3</p>
                    </div>
                    <div class="flex-1 rounded-md border-dotted border border-gray-300 text-center py-5 @if($key == 4) bg-yellow-300 font-bold @endif">
                        <p>Emplacement 4</p>
                    </div>
                </div>
            @endif

            <div class="textfield mt-2">
                <label for="title">Nom de l'univers<span class="text-red-500">*</span></label>
                <input type="text" id="title" wire:model="title" name="title" placeholder="Entrez le nom de l'univers" class="@if($errors->has('title'))textfield-error @endif" value="{{ old('title') }}">
                @if($errors->has('title'))
                    <p class="text-input-error">{{ $errors->first('title') }}</p>
                @endif
            </div>
            <div class="textfield mt-2">
                <label for="image">Image</label>
                <input type="file" id="image" wire:model="image" name="image" class="@if($errors->has('image'))textfield-error @endif" value="{{ old('image') }}">
                @if($errors->has('image'))
                    <p class="text-input-error">{{ $errors->first('image') }}</p>
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
                <button type="submit" class="btn-filled_secondary"><i class="fa-solid fa-circle-plus mr-3"></i>Ajouter</button>
            </div>
        </form>
    </div>
</div>
