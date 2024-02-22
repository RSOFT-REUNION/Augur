<div id="popup">
    <div class="entry-header">
        <div class="flex items-center">
            <div class="flex-1">
                <h1>{{ $recipe->title }}</h1>
            </div>
            <div class="flex-none">
                <a wire:click="$dispatch('closeModal')" class="btn-icon_secondary_2 block text-black"><i class="fa-solid fa-xmark"></i></a>
            </div>
        </div>
    </div>
    <div class="entry-content">
        <div class="force-center">
            <img src="{{ asset('storage/medias/'. $recipe->getPicture()) }}" class="rounded-lg">
        </div>
        @if($recipe->description != null)
            <div class="mt-5 text-center bg-gray-100 rounded-md py-2">
                <p>{{ $recipe->description }}</p>
            </div>
        @endif
        <div class="mt-5 border-t border-gray-100 pt-5">
            <div class="flex">
                <div class="flex-none w-[300px] mr-5">
                    <p class="text-xl text-primary font-bold">Ingrédients pour {{ $recipe->recipe_for }} personnes</p>
                    <div class="mt-3 bg-gray-100 px-3 py-2 rounded-md">
                        <ul>
                            @foreach($ingredients as $ingredient)
                                <li class="my-2">{{ $ingredient->title }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="flex-1 ml-5">
                    <p class="text-xl text-primary font-bold">Préparation</p>
                    <div class="mt-3">
                        <ul>
                            @foreach($steps as $step)
                                <li class="my-2">
                                    <div class="flex items-center">
                                        <div class="flex-none mr-2">
                                            <p class="text-2xl">{{ $step->step }}</p>
                                        </div>
                                        <div class="flex-1 ml-2 px-4 py-2 bg-gray-100 border-l-2 border-primary">
                                            <p>{{ $step->content }}</p>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="entry-footer text-right">
        <a wire:click="delete" class="btn-outline_gray"><i class="fa-solid fa-trash-can mr-3"></i>Supprimer</a>
        <a href="{{ route('bo.recette.edit', ['id' => $recipe->id]) }}" class="btn-outline_gray"><i class="fa-solid fa-pen-to-square mr-3"></i>Modifier</a>
    </div>
</div>
