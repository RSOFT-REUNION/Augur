<div id="modalSlot{{ $product->id }}">
    <h4 class="text-center mb-4">Selectionnez votre ville pour connaitre les offres disponible</h4>
    <div class="d-flex justify-content-center">
        <form method="post">  @csrf
            <div class="form-group">
                <select class="form-select" aria-label="chosed_cities" name="chosed_cities" id="chosed_cities"
                        hx-post="{{ route('cart.select_slot', ["product" => $product]) }}"
                        hx-target="#modalSlot{{ $product->id }}"
                        hx-swap="outerHTML">
                    <option value="">Selectionnez votre ville</option>
                @foreach($cities  as $city)
                        <option value="{{ $city->postal_code }}" @if($city->postal_code == @$chosed_cities) selected @endif>{{ $city->city }}</option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>
    @empty(!@$chosed_cities)
        @if(getRegion($chosed_cities) == 'nord')
            <div class="text-center">
                <img style="width: 100px;" src="{{ asset('frontend/images/24-hours.png') }}">
                <h4 class="mb-3">Choix souhaitez du créneau de livraison <br>(Région Nord / Est)</h4>
            </div>
            @include('frontend.carts.partials.select_slot_modal_content_slot', array('region'=>'nord'))
        @elseif(getRegion($chosed_cities) == 'sud')
            <div class="text-center">
                <img style="width: 100px;" src="{{ asset('frontend/images/24-hours.png') }}">
                <h4 class="mb-3">Choix souhaitez du créneau de livraison <br>(Région Sud / Ouest)</h4>
            </div>
            @include('frontend.carts.partials.select_slot_modal_content_slot', array('region'=>'sur'))
        @else
            <div class="w-75 mx-auto bg-danger rounded-4 shadow text-white p-3">
                <div class="text-center"><i class="fa-solid fa-triangle-exclamation fa-5x"></i></div>
                <p class="text-center">Nous sommes désolés, mais la livraison n'est pas encore disponible dans votre
                    commune.</p>
            </div>
        @endif
    @endempty
</div>
