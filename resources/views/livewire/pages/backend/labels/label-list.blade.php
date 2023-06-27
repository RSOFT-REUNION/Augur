<div>
    <div class="entry-header flex items-center">
        <div class="flex-1">
            <h1>Labels & engagements</h1>
        </div>
        <div class="flex-none inline-flex items-center">
            <div class="textfield-line">
                <label for="search"><i class="fa-solid fa-magnifying-glass"></i></label>
                <input type="text" placeholder="Rechercher..." wire:model="search" class="focus:outline-none" role="searchbox">
            </div>
            <p class="bg-gray-100 block py-2 px-4 rounded-lg ml-2">{{ $labels->count() }}</p>
        </div>
    </div>
    <div class="entry-content">
        <button onclick="window.location='{{ route('bo.labels.add') }}'" id="btn_floating"><i class="fa-solid fa-plus mr-3"></i>Ajouter</button>
        @if($labels->count() > 0)
            @if($labels_up > 0)
                <div id="alert-box_dashboard">
                    <p><i class="fa-solid fa-star mr-3"></i>Vous avez mis en avant <b>{{ $labels_up }}</b> label(s)</p>
                </div>
            @endif
            <div class="grid grid-cols-5 gap-4 mt-3">
                @foreach($labels as $label)
                    <div class="dash-grid_item text-center" wire:click="$emit('openModal', 'popups.backend.labels.label-content', {{ json_encode(['label_id' => $label->id]) }})">
                        @if($label->show_home == 1)
                            <i class="fa-solid fa-star icon-up"></i>
                        @endif
                        <div class="flex flex-col h-full">
                            <div class="flex-1">
                                <div class="force-center">
                                    <img src="{{ asset('storage/images/labels/'. $label->logo) }}" width="100px">
                                </div>
                            </div>
                            <div class="flex-none">
                                <p class="mt-4">{{ $label->title }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-3">
                {{ $labels->links() }}
            </div>
        @else
            <p class="empty-text">Vous n'avez pas encore créer de labels</p>
        @endif
    </div>
</div>
