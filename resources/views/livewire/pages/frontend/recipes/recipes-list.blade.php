<main role="main" class="container mx-auto">
    <div class="text-center">
        <h1>Nos recettes</h1>

    </div>

    {{-- Liste des recettes --}}
    <div class="mt-10 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
        @foreach($recipes as $recipe)
            <div class="border-2 border-gray-100 rounded-lg overflow-hidden hover:shadow-lg duration-300 cursor-pointer" role="button" data-href="{{ route('fo.recipes.single', ['id' => $recipe->id]) }}">
                <div class="flex flex-col">
                    <div class="flex-1">
                        <img src="{{ asset('storage/medias/'. $recipe->getPicture()) }}" loading="lazy">
                    </div>
                    <div class="flex-none">
                        <div class="py-4 px-2 text-center">
                            <p class="font-bold text-primary text-xl">{{ $recipe->title }}</p>
                            <button type="button" class="mt-2 bg-primary text-white px-4 py-2 rounded-md">Voir la recette</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="mt-5 mb-10">
        {{ $recipes->links() }}
    </div>
</main>
