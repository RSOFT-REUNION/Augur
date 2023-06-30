<div id="popup">
    <div class="entry-header">
        <div class="flex items-center">
            <div class="flex-1">
                <h1>{{ $evenement->title }}</h1>
            </div>
            <div class="flex-none">
                <a wire:click="$emit('closeModal')" class="btn-icon_secondary_2 block text-black"><i class="fa-solid fa-xmark"></i></a>
            </div>
        </div>
    </div>
    <div class="entry-content">
        <div class="force-center">
            <img src="{{ asset('storage/images/evenements/'. $evenement->cover) }}" class="image-preview"/>
        </div>
        <div class="my-10 tiny-content">
            <p>{{ $evenement->description_short }}</p>
        </div>
    </div>
</div>
