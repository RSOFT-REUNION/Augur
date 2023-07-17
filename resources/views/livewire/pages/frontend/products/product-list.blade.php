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
        <div class="container_slider mt-10">
            <div id="surgele" class="slider_section" style="background-image: url('{{ asset('images/assets/produit surgele.jpg') }}')">
                <div class="slider_content">
                    <p>Produits surgelé</p>
                </div>
                <div class="slider_overlay"></div>
            </div>
            <div id="fine" class="slider_section" style="background-image: url('{{ asset('images/assets/epicerie_fine.jpg') }}')">
                <div class="slider_content">
                    <p>Epicerie fine</p>
                </div>
                <div class="slider_overlay"></div>
            </div>
            <div id="vrac" class="slider_section" style="background-image: url('{{ asset('images/assets/produit sec.jpg') }}')">
                <div class="slider_content">
                    <p>Produits vrac</p>
                </div>
                <div class="slider_overlay"></div>
            </div>
        </div>
        {{-- Fin Unviers --}}
    </div>
</div>
