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
                                <img src="{{ asset('storage/images/evenements/'. $ev->cover) }}">
                            </div>
                            <div class="flex-1 ml-10 pr-10">
                                <h2>{{ $ev->title }}</h2>
                                <p class="my-4">{{ $ev->description_short }}</p>
                                <div class="flex items-center">
                                    <div class="flex-1">
                                        <h3>Le {{ $ev->getDate() }} de {{ $ev->start_time }} à {{ $ev->end_time }}</h3>
                                    </div>
                                    <div class="flex-none">
                                        <button wire:click="deleteEvenement({{ $ev->id }})" class="btn-outline_primary mr-2"><i class="fa-solid fa-trash"></i></button>
                                        <button wire:click="deleteEvenement({{ $ev->id }})" class="btn-outline_primary mr-2"><i class="fa-solid fa-trash"></i></button>
                                        <button wire:click="editEvenement({{ $ev->id }})" class="btn-filled_secondary"><i class="fa-solid fa-pen-to-square mr-3"></i>Modifier le contenue</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
            {{-- Olds evenements --}}
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
                                <td>De {{ $ev->start_time }} à {{ $ev->end_time }}</td>
                                <td>{{ $ev->getShop() }}</td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="empty-text">Aucune animation n'a été créée</p>
        @endif
    </div>
</div>
