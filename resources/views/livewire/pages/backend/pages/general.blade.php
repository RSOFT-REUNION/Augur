<div>
    <div class="entry-header flex items-center">
        <div class="flex-1">
            <h1>Général</h1>
        </div>
        <div class="flex-none inline-flex items-center">
        </div>
    </div>
    <div class="entry-content">
        <div>
            <div class="flex items-center">
                <div class="flex-1">
                    <h2>Carousel principal</h2>
                </div>
                <div class="flex-none">
                    <button wire:click="$dispatch('openModal', { component: 'popups.backend.pages.add-picture-carousel' })" class="btn-filled_secondary">Ajouter une image</button>
                </div>
            </div>
            <div class="mt-5">
                <p class="bg-blue-300 px-3 py-2 rounded-lg text-blue-800 mb-5"><i class="fa-solid fa-star mr-3"></i>De nouvelles fonctionnalités vont bientôt arriver pour ce module !</p>
                @if($mainCarousel->count() > 0)
                    @foreach($mainCarousel as $car)
                        <div class="container-carousel_list" style="background-image: url('{{ asset('storage/medias/'. $car->getPicture()) }}')">
                            <div class="buttons">
                                <button wire:click="deleteCarousel({{ $car->id }})" class="btn-icon_secondary"><i class="fa-solid fa-trash"></i></button>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="empty-text">Vous n'avez pas encore configurer votre carousel</p>
                @endif
            </div>
        </div>
    </div>
</div>
