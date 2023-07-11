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
                                <img src="{{ asset('storage/medias/'. $ev->getPicture()) }}">
                            </div>
                            <div class="flex-1 content pr-10">
                                <h2>{{ $ev->title }}</h2>
                                <p class="mt-5">{{ $ev->description_short }}</p>
                                <div class="flex items-center mt-10">
                                    <div class="flex-1">
                                        <h4>Le {{ $ev->getDate() }}</h4>
                                        <h5>De {{ $ev->start_time }} à {{ $ev->end_time }} | <i class="fa-solid fa-location-dot mx-1"></i> {{ $ev->getShop() }}</h5>
                                    </div>
                                    <div class="flex-none">
                                        <button wire:click="$emit('openModal', 'popups.frontend.evenements.popup-evenement', {{ json_encode(['evenement_id' => $ev->id]) }})" class="btn-icon_transparent"><i class="fa-solid fa-circle-info"></i></button>
                                        <button wire:click="updateParticipe({{ $ev->id }})" class="btn-filled_primary">
                                            @if($participations->count() > 0)
                                                @foreach($participations as $par)
                                                    @if($par->evenement_id == $ev->id)
                                                        Je ne participe plus
                                                    @else
                                                        Je participe !
                                                    @endif
                                                @endforeach
                                            @else
                                                Je participe !
                                            @endif
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="empty-text my-10 lg:my-20">Nous n'avons aucun événement de planifié pour le moment</p>
        @endif

        @if($oldEvenements->count() > 0)
            <div class="my-5">
                <div class="text-center">
                    <h3>Retour sur nos précédente animations !</h3>
                </div>
            </div>
            <div class="carousel-scroll_line">
                @foreach($oldEvenements as $oldEv)
                    <div onclick="Livewire.emit('openModal', 'popups.frontend.evenements.popup-evenement', {{ json_encode(['evenement_id' => $oldEv->id]) }})" style="background-image: url('{{ asset('storage/medias/'. $oldEv->getPicture()) }}')">
                        <h5>{{ $oldEv->title }}</h5>
                    </div>
                @endforeach
            </div>
            <div class="old_evenements-list mb-5">
                <ul>
                    @foreach($oldEvenements as $oldEv)
                        <li class="evenement_items flex items-center">
                            <div class="flex-1">
                                <p>{{ $oldEv->title }}</p>
                            </div>
                            <div class="flex-none text-right">
                                <p class="text-blue-400">{{ $oldEv->getDate() }}</p>
                            </div>

                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</div>

