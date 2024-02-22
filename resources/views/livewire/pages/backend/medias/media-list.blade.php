<div>
    <div class="entry-header flex items-center">
        <div class="flex-1">
            <h1>Medias</h1>
        </div>
        <div class="flex-none inline-flex items-center">
            <button wire:click="$dispatch('openModal', { component: 'popups.backend.medias.media-add' })" class="btn-filled_secondary"><i class="fa-solid fa-image mr-3"></i>Ajouter un media</button>
        </div>
    </div>
    <div class="entry-content">
        <div class="flex">
            <div class="flex-1 mr-2">
                @if($medias->count() > 0)
                    <div class="grid grid-cols-3 gap-5">
                        @foreach($medias as $media)
                            <div class="radio_picture cursor-pointer">
                                <input type="radio" wire:model.live="selected" value="{{ $media->id }}" id="selected-{{ $media->id }}">
                                <label for="selected-{{ $media->id }}"><img src="{{ asset('storage/medias/'. $media->title) }}" alt="{{ $media->alt }}" class="bg-auto w-auto"/></label>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-3">
                        {{ $medias->links() }}
                    </div>
                @else
                    <p class="empty-text">Vous n'avez pas encore ajouter de médias</p>
                @endif
            </div>
            <div class="flex-none ml-2">
                @if($selected)
                    <div class="container-filled width-300">
                        <div class="force-center">
                            <img src="{{ asset('storage/medias/'. $media_selected->title) }}" class="rounded-lg">
                        </div>
                        <div class="mt-3">
                            <h2>{{ $media_selected->alt }}</h2>
                            <p class="text-sm" id="key_copy">Clé unique: <b>{{ $media_selected->key }}</b></p>
                            <p class="text-sm">Date d'ajout: <b>{{ $media_selected->getDate() }}</b></p>
                            <hr class="my-3">
                            <div class="text-center">
                                <a wire:click="deleteMedia({{$media_selected->id}})" class="btn-icon_transparent"><i class="fa-solid fa-trash-can"></i></a>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="container-filled width-300">
                        <p class="text-center text-sm text-gray-500">Sélectionner une photo pour voir ses informations</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
