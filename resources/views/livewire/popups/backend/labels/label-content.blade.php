<div id="popup">
    <div class="entry-header">
        <div class="flex items-center">
            <div class="flex-1">
                <h1>{{ $label->title }}</h1>
            </div>
            <div class="flex-none">
                <a wire:click="$emit('closeModal')" class="btn-icon_secondary_2 block text-black"><i class="fa-solid fa-xmark"></i></a>
            </div>
        </div>
    </div>
    <div class="entry-content">
        <div class="force-center">
            <img src="{{ asset('storage/images/labels/'. $label->logo) }}" width="250px" />
        </div>
        <div class="tiny-content mt-5">
            {!! $label->content !!}
        </div>
    </div>
    <div class="entry-footer text-right">
        <a wire:click="up" class="btn-outline_gray mr-1">@if(!$up) <i class="fa-solid fa-star mr-3"></i>Mettre en avant @else <i class="fa-regular fa-star mr-3"></i>Ne plus mettre en avant @endif</a>
        <a wire:click="delete" class="btn-outline_gray"><i class="fa-solid fa-trash-can mr-3"></i>Supprimer</a>
        <a href="{{ route('bo.labels.edit', ['id' => $label->id]) }}" class="btn-outline_gray"><i class="fa-solid fa-pen-to-square mr-3"></i>Modifier</a>
    </div>
</div>
