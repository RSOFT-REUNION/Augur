<div>
    <div class="container mx-auto">
        <div class="text-center">
            <h1>Nos Animations</h1>
            <h3>Ateliers et événements</h3>
        </div>
        @if($evenements->count() > 0)
            <div class="my-20">
                @foreach($evenements as $ev)
                    <div class="container-front_evenement">
                        <div class="flex">
                            <div class="flex-none">
                                <img src="{{ asset('storage/images/evenements/'. $ev->cover) }}">
                            </div>
                            <div class="flex-1 content pr-10">
                                <h2>{{ $ev->title }}</h2>
                                <p class="mt-5">{{ $ev->description_short }}</p>
                                <div class="flex items-center mt-10">
                                    <div class="flex-1 inline-flex items-center">
                                        <h4>Le {{ $ev->getDate() }} de {{ $ev->start_time }} à {{ $ev->end_time }}</h4>
                                        <h5 class="ml-2">- {{ $ev->getShop() }}</h5>
                                    </div>
                                    <div class="flex-none">
                                        <button wire:click="$emit('openModal', 'popups.frontend.evenements.popup-evenement', {{ json_encode(['evenement_id' => $ev->id]) }})" class="btn-filled_primary">En savoir plus</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="empty-text my-20">Nous n'avons aucun événement de planifié pour le moment</p>
        @endif

        @if($oldEvenements->count() > 0)
            <div class="my-20">
                <div class="text-center">
                    <h3>Retour sur nos précédente animations !</h3>
                </div>
            </div>
            <div class="carousel-scroll_line">
                @foreach($oldEvenements as $oldEv)
                    <div onclick="Livewire.emit('openModal', 'popups.frontend.evenements.popup-evenement', {{ json_encode(['evenement_id' => $oldEv->id]) }})" style="background-image: url('{{ asset('storage/images/evenements/'. $oldEv->cover) }}')">
                        <h5>{{ $oldEv->title }}</h5>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

