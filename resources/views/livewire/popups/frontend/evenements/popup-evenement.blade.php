<div id="popup">
    <div class="entry-header">
        <div class="flex items-center">
            <div class="flex-1">
                <h1>{{ $evenement->title }}</h1>
            </div>
            <div class="flex-none">
                <a wire:click="$dispatch('closeModal')" class="btn-icon_secondary_2 block text-black"><i class="fa-solid fa-xmark"></i></a>
            </div>
        </div>
    </div>
    <div class="entry-content">
        <div class="force-center">
            <img src="{{ asset('storage/medias/'. $evenement->getPicture()) }}" class="image-preview"/>
        </div>
        <div class="my-10">
            <h3>Résumé</h3>
            <div class="mt-3 bg-gray-100 px-4 py-2 rounded-lg">
                <p>{{ $evenement->description_short }}</p>
            </div>
        </div>
        <div class="my-10">
            <h3>Description</h3>
            <div class="tiny-content">
                {!! $evenement->page_content !!}
            </div>
        </div>
    </div>
</div>
