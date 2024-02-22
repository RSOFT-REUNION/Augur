<div>
    <div class="entry-header flex items-center">
        <div class="flex-1">
            <h1>Recettes</h1>
        </div>
        <div class="flex-none inline-flex items-center">
            <p class="bg-gray-100 px-3 py-1 border border-gray-200 font-medium rounded-full">{{ \App\Models\Recipe::all()->count() }}</p>
        </div>
    </div>
    <div class="entry-content">
        <div class="container-float">
            <button onclick="window.location='{{ route('bo.recette.add') }}'" class="btn-container-float"><i class="fa-solid fa-plus mr-3"></i>Ajouter</button>
        </div>

        {{-- Grilles des recettes --}}
        @if($recipes->count() > 0)
            <div class="grid grid-cols-3 gap-10">
                @foreach($recipes as $recipe)
                    <div wire:click="$dispatch('openModal', { component: 'popups.backend.recipes.recipe', arguments: {{ json_encode(['recipe_id' => $recipe->id]) }} })" class="rounded-lg overflow-hidden bg-gray-100 border border-transparent hover:border-gray-200 hover:shadow-lg duration-300 cursor-pointer">
                        <div class="flex flex-col justify-between">
                            <div class="flex-1">
                                <img src="{{ asset('storage/medias/'. $recipe->getPicture()) }}" loading="lazy">
                            </div>
                            <div class="flex-none">
                                <div class="my-5 text-center">
                                    <p class="text-2xl font-bold text-primary">{{ $recipe->title }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="my-10">
                {{ $recipes->links() }}
            </div>
        @else
            <p class="text-center bg-gray-100 rounded-lg py-2">Vous n'avez pas encore ajouté de recettes</p>
        @endif
    </div>
</div>
