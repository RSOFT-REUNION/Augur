<div class="container mx-auto">
    <div class="text-center">
        <h1>Nos labels</h1>
        <h3>Des labels certifiés</h3>
    </div>
    <div class="my-20">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-10">
            @foreach($labels as $label)
                <div class="front-grid_label" role="button" data-href="{{ route('fo.label', ['slug' => $label->slug]) }}">
                    <div class="flex flex-col h-full">
                        <div class="flex-1 flex h-full">
                            <div class="m-auto">
                                <img src="{{ asset('storage/medias/'. $label->getPicture()) }}"/>
                            </div>
                        </div>
                        <div class="flex-none">
                            <h2>{{ $label->title }}</h2>
                            <div class="mt-4 text-center">
                                <button onclick="window.location='{{ route('fo.label', ['slug' => $label->slug]) }}'" class="btn-filled_primary">En savoir plus</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-3">
            {{ $labels->links() }}
        </div>

    </div>
</div>
