<div class="container mx-auto">
    <div class="text-center">
        <h1>Nos produits</h1>
        <h3>Des choix de grande qualité</h3>
    </div>
    <div class="my-20">
        @if($description)
            <p class="text-center">
                {{ $description->content }}
            </p>
        @endif

        {{-- Début Univers --}}
        @if($univers->count() > 0)
            <div class="container_slider mt-10">
                @foreach($univers as $uni)
                    <div id="{{ $uni->key }}" role="button" data-href="{{ route('fo.products.list', ['id' => $uni->id]) }}" class="slider_section" style="background-image: url('{{ asset('storage/medias/'. $uni->getPicture()) }}')">
                        <div class="slider_content">
                            <p>{{ $uni->title }}</p>
                        </div>
                        <div class="slider_overlay"></div>
                    </div>
                @endforeach
            </div>
        @endif
        {{-- Fin Unviers --}}
    </div>
</div>
