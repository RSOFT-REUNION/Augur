<div>
    <form wire:submit.prevent="@if($recipe) upRecipe @else publish @endif" enctype="multipart/form-data">
        @csrf
        <div class="entry-header flex items-center">
            <div class="flex-1 inline-flex items-center">
                <a href="{{ route('bo.recette') }}" class="btn-icon_secondary mr-3"><i class="fa-solid fa-arrow-left"></i></a>
                <h1>@if($recipe) Modification d'une recette @else Ajouter une recette @endif</h1>
            </div>
            <div class="flex-none inline-flex items-center">
                <button type="submit" class="btn-filled_primary"><i class="fa-solid fa-floppy-disk mr-2"></i>@if($recipe) Mettre à jour ma recette @else Publier ma recette @endif</button>
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
                <div class="flex items-center">
                    <div class="flex-1">
                        <label for="image">Image de couverture<span class="text-red-500">*</span></label>
                    </div>
                    <div class="flex-none">
                        <p wire:loading wire:target="image" class="text-sm"><i class="fa-solid fa-rotate mr-2 fa-spin"></i>En cours de traitement</p>
                    </div>
                </div>
                <input type="file" id="image" wire:model="image" name="image" class="@if($errors->has('image'))textfield-error @endif" value="{{ old('image') }}">
                @if($errors->has('image'))
                    <p class="text-input-error">{{ $errors->first('image') }}</p>
                @endif
            </div>
            @if($recipe)
                <p class="px-2 py-1 text-sm bg-yellow-300 rounded-md mt-1">Si vous ne souhaitez pas mettre à jour la photo de couverture de votre recette, vous devez laisser cette zone vide !</p>
            @endif
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
        </div>
    </form>
    <hr class="my-5 border-gray-200">

    {{-- Liste des ingrédients --}}
    <div>
        <div class="flex items-center">
            <div class="flex-1">
                <h2 class="text-2xl font-bold">Liste des ingrédients</h2>
            </div>
            <div class="flex-none">
                <p class="px-2.5 py-1 bg-gray-100 rounded-md border border-gray-200">
                    @if($ingredients->count() > 0)
                        {{ $ingredients->count() }}
                    @else
                        Pas encore d'ingrédients
                    @endif
                </p>
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
                    @if($ingredient)
                        <div class="flex-none ml-3">
                            <button type="submit" class="btn-filled_secondary">Ajouter</button>
                        </div>
                    @endif
                </div>
            </form>
        </div>
        <div>
            @if($ingredients->count() > 0)
                <ul class="mt-2">
                    @foreach($ingredients as $ing)
                        <li class="bg-gray-100 px-5 py-2 rounded-lg mb-1">
                            <div class="flex items-center">
                                <div class="flex-1">
                                    <p>{{ $ing->title }}</p>
                                </div>
                                <div class="flex-none">
                                    <button wire:click="deleteIngredient({{ $ing->id }})" class=""><i class="fa-solid fa-trash"></i></button>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-center bg-gray-100 py-3 mt-2 rounded-lg">Vous n'avez pas encore ajouté d'ingrédients</p>
            @endif
        </div>
    </div>

    <hr class="my-5 border-gray-200">

    {{-- Liste des étapes --}}
    <div class="mb-10">
        <div class="flex items-center">
            <div class="flex-1">
                <h2 class="text-2xl font-bold">Liste des étapes de préparation</h2>
            </div>
            <div class="flex-none">
                <p class="px-2.5 py-1 bg-gray-100 rounded-md border border-gray-200">
                    @if($ingredients->count() > 0)
                        {{ $ingredients->count() }}
                    @else
                        Pas encore d'étapes
                    @endif
                </p>
            </div>
        </div>
        <div class="bg-gray-100 px-4 pt-2 pb-4 rounded-lg mt-5">
            <form wire:submit.prevent="createStep">
                @csrf
                <div class="textfield-white">
                    <label for="step">Étape numéro :<span class="text-red-500">*</span></label>
                    <input type="number" id="step" step="1" min="1" wire:model="step" name="step" placeholder="Entrez le numéro de l'étape" class="@if($errors->has('step'))textfield-error @endif" value="{{ old('step') }}">
                    @if($errors->has('step'))
                        <p class="text-input-error">{{ $errors->first('step') }}</p>
                    @endif
                </div>
                <div class="textfield-white mt-2">
                    <label for="content_step">Étape numéro :<span class="text-red-500">*</span></label>
                    <textarea wire:model="content_step" id="content_step" class="@if($errors->has('content_step'))textfield-error @endif" name="content_step" placeholder="Entrez l'étape à suivre">{{ old('content_step') }}</textarea>
                    @if($errors->has('content_step'))
                        <p class="text-input-error">{{ $errors->first('content_step') }}</p>
                    @endif
                </div>
                @if($step && $content_step)
                    <div class="flex-none mt-3 text-right">
                        <button type="submit" class="btn-filled_secondary"><i class="fa-solid fa-plus mr-3"></i>Ajouter</button>
                    </div>
                @endif
            </form>
        </div>
        <div>
            @if($steps->count() > 0)
                <ul class="mt-2">
                    @foreach($steps as $stp)
                        <li class="bg-gray-100 px-2 py-3 rounded-lg mt-1">
                            <div class="flex items-center">
                                <div class="flex-1">
                                    <div class="inline-flex items-center pl-2">
                                        <p class="text-2xl pr-2">{{ $stp->step }}</p>
                                        <div class="px-0.5 py-4 bg-blue-900 rounded-full mr-3"></div>
                                        <p class="">{{ $stp->content }}</p>
                                    </div>
                                </div>
                                <div class="flex-none pr-5">
                                    <button wire:click="deleteStep({{ $stp->id }})" class="hover:text-red-500"><i class="fa-solid fa-trash"></i></button>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <ul>

                </ul>

                <p class="text-center bg-gray-100 py-3 mt-2 rounded-lg">Vous n'avez pas encore ajouté d'étapes à votre recette</p>
            @endif
        </div>
    </div>
</div>
