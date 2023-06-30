<div id="popup">
    <div class="entry-header">
        <div class="flex items-center">
            <div class="flex-1">
                <h1>Créer une animation</h1>
            </div>
            <div class="flex-none">
                <a wire:click="$emit('closeModal')" class="btn-icon_secondary_2 block text-black"><i class="fa-solid fa-xmark"></i></a>
            </div>
        </div>
    </div>
    <div class="entry-content">
        <p class="info">
            Vous êtes sur le point d'ajouter une animation sur votre site. Vous pouvez à tout moment modifier votre événement une fois celui-ci créer.
        </p>
        <form wire:submit.prevent="create" enctype="multipart/form-data" class="mt-3">
            @csrf
            <div class="flex items-center">
                <div class="flex-1 mr-2">
                    <div class="textfield">
                        <label for="title">Titre de l'événement<span class="text-red-500">*</span></label>
                        <input type="text" id="title" wire:model="title" name="title" placeholder="Entrez le titre de l'événement" class="@if($errors->has('title'))textfield-error @endif" value="{{ old('title') }}">
                        @if($errors->has('title'))
                            <p class="text-input-error">{{ $errors->first('title') }}</p>
                        @endif
                    </div>
                    <div class="textfield mt-2">
                        <div class="flex items-center">
                            <div class="flex-1">
                                <label for="cover">Image de présentation<span class="text-red-500">*</span></label>
                            </div>
                            <div class="flex-none">
                                <div wire:loading wire:target="cover">
                                    <p class="text-red-500">En cours d'ajout...</p>
                                </div>
                            </div>
                        </div>
                        <input type="file" id="cover" wire:model="cover" name="cover" class="@if($errors->has('cover'))textfield-error @endif">
                        @if($errors->has('cover'))
                            <p class="text-input-error">{{ $errors->first('cover') }}</p>
                        @endif
                    </div>
                </div>
                <div class="flex-none ml-2">
                    <div id="cover_thumbnail" class="flex">
                        @if($cover)
                            <img src="{{ $cover->temporaryUrl() }}">
                        @else
                            <div class="m-auto">
                                <i class="fa-regular fa-image fa-2x"></i>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="mt-2">
                <div class="textfield">
                    <label for="description_small">Description courte<span class="text-red-500">*</span></label>
                    <textarea wire:model.defer="description_small" name="description_small" class="@if($errors->has('description_small'))textfield-error @endif" placeholder="Entrez un résumer de votre événement">{{ old('description_small') }}</textarea>
                    @if($errors->has('description_small'))
                        <p class="text-input-error">{{ $errors->first('description_small') }}</p>
                    @endif
                </div>
                <div class="my-2 mx-2">
                    <input type="checkbox" wire:model="more_day" id="more_day">
                    <label for="more_day">Événement sur plusieurs journées</label>
                </div>
                @if($more_day == 1)
                    <div class="flex">
                    <div class="flex-1 mr-2">
                        <div class="textfield">
                            <label for="start_date">Date de début<span class="text-red-500">*</span></label>
                            <input type="date" id="start_date" wire:model="start_date" name="start_date" class="@if($errors->has('start_date'))textfield-error @endif" value="{{ old('start_date') }}">
                            @if($errors->has('start_date'))
                                <p class="text-input-error">{{ $errors->first('start_date') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="flex-1 ml-2">
                        <div class="textfield">
                            <label for="end_date">Date de fin<span class="text-red-500">*</span></label>
                            <input type="date" id="end_date" wire:model="end_date" name="end_date" class="@if($errors->has('end_date'))textfield-error @endif" value="{{ old('end_date') }}">
                            @if($errors->has('end_date'))
                                <p class="text-input-error">{{ $errors->first('end_date') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                @else
                    <div class="textfield">
                        <label for="date">Date<span class="text-red-500">*</span></label>
                        <input type="date" id="date" wire:model="date" name="date" class="@if($errors->has('date'))textfield-error @endif" value="{{ old('date') }}">
                        @if($errors->has('date'))
                            <p class="text-input-error">{{ $errors->first('date') }}</p>
                        @endif
                    </div>
                @endif
                <div class="flex mt-2">
                    <div class="flex-1 mr-2">
                        <div class="textfield">
                            <label for="start_time">Heure de début<span class="text-red-500">*</span></label>
                            <input type="time" id="start_time" wire:model="start_time" name="start_time" class="@if($errors->has('start_time'))textfield-error @endif" value="{{ old('start_time') }}">
                            @if($errors->has('start_time'))
                                <p class="text-input-error">{{ $errors->first('start_time') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="flex-1 ml-2">
                        <div class="textfield">
                            <label for="end_time">Heure de fin<span class="text-red-500">*</span></label>
                            <input type="time" id="end_time" wire:model="end_time" name="end_time" class="@if($errors->has('end_time'))textfield-error @endif" value="{{ old('end_time') }}">
                            @if($errors->has('end_time'))
                                <p class="text-input-error">{{ $errors->first('end_time') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="mt-2">
                    <div class="textfield">
                        <label for="shop">Magasin concernée<span class="text-red-500">*</span></label>
                        <select wire:model="shop" id="shop" class="@if($errors->has('shop'))textfield-error @endif">
                            <option value="">-- Sélectionner un magasin --</option>
                            <option value="ALL">Tous les magasins</option>
                            <optgroup label="Magasins référencés"></optgroup>
                            @foreach($shops as $shop)
                                <option value="{{ $shop->id }}">{{ $shop->title }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('shop'))
                            <p class="text-input-error">{{ $errors->first('shop') }}</p>
                        @endif
                    </div>
                </div>
                <div class="mt-5 text-right">
                    <button type="submit" class="btn-filled_secondary"><i class="fa-solid fa-circle-plus mr-2"></i>Créer</button>
                </div>
            </div>
        </form>
    </div>
</div>
