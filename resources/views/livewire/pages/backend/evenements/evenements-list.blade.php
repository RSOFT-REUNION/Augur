<div>
    <div class="entry-header flex items-center">
        <div class="flex-1">
            <h1>Animations</h1>
        </div>
        <div class="flex-none inline-flex items-center">
        </div>
    </div>
    <div class="entry-content">
        <button onclick="Livewire.emit('openModal', 'popups.backend.evenements.add-evenement')" id="btn_floating"><i class="fa-solid fa-plus mr-3"></i>Créer une animation</button>
        @if($evenements->count() > 0)
            @foreach($evenements as $ev)
                @if($ev->date > \Carbon\Carbon::now() || $ev->start_date > \Carbon\Carbon::now())
                    <div class="back_card_evenement mb-2">
                        <div class="flex items-center">
                            <div class="flex-none mr-2">
                                <img src="{{ asset('storage/medias/'. $ev->getPicture()) }}">
                            </div>
                            <div class="flex-1 ml-10 pr-10">
                                <h2>{{ $ev->title }}</h2>
                                <p class="my-4">{{ $ev->description_short }}</p>
                                <div class="flex items-center">
                                    <div class="flex-1">
                                        @if($ev->one_day == 1)
                                            <h3>Le {{ $ev->getDate() }}</h3>
                                            <p class="text-sm">De {{ $ev->start_time }} à {{ $ev->end_time }} | <i class="fa-solid fa-location-dot mx-2"></i>{{ $ev->getShop() }}</p>
                                        @else
                                            <h3>Du {{ $ev->getDate() }}</h3>
                                            <p class="text-sm">De {{ $ev->start_time }} à {{ $ev->end_time }} | <i class="fa-solid fa-location-dot mx-2"></i>{{ $ev->getShop() }}</p>
                                        @endif
                                    </div>
                                    <div class="flex-none">
                                        <button wire:click="participantEvenement({{ $ev->id }})" class="mr-1 bg-primary text-white py-1.5 px-4 rounded-[10px] border border-primary hover:text-primary duration-300 hover:bg-secondary-gray"><i class="fa-solid fa-eye mr-2"></i>Voir les participants</button>
                                        <button wire:click="editEvenement({{ $ev->id }})" title="Modifier l'évènement" class="btn-filled_secondary mr-1"><i class="fa-solid fa-pen mr-2"></i>Modifier</button>
                                        <button wire:click="deleteEvenement({{ $ev->id }})" class="btn-outline_primary"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
            {{-- Olds evenements --}}
            @if($old_evenements->count() > 0)
                <div class="title-line_big">
                    <h2>Anciens événements</h2>
                    <hr/>
                </div>
                <div class="table-primary">
                    <table>
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Titre</th>
                            <th>Date de l'évenement</th>
                            <th>Heures</th>
                            <th>Magasins</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($evenements as $ev)
                            @if($ev->date < \Carbon\Carbon::now() && $ev->start_date < \Carbon\Carbon::now())
                                <tr>
                                    <td>{{ $ev->id }}</td>
                                    <td>{{ $ev->title }}</td>
                                    <td>{{ $ev->getDate() }}</td>
                                    <td>De <b>{{ $ev->start_time }}</b> à <b>{{ $ev->end_time }}</b></td>
                                    <td>{{ $ev->getShop() }}</td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

        @else
            <p class="empty-text">Aucune animation n'a été créée</p>
        @endif
    </div>
</div>
