   <form> @csrf
    <div class="row row-flex row-cols-2 justify-content-center">
        @foreach (getDaysTwoWeeks($region) as $key => $day)
            @if($key == 0)
                @if(getDateTimeNow() <= '14:00')
                    <div class="col">
                        <div class="content me-2 ms-2 mb-3">
                            <h6 class="text-center mb-3">{{ ucfirst($day['formatted_date']) }}</h6>
                            <div class="text-center">
                                @if(getDateTimeNow() <= '09:00')
                                    <button class="btn btn-primary hvr-grow-shadow me-2"
                                            name="delivery_slot"
                                            value="matin"
                                            hx-post="{{ route('cart.add_product', $product) }}"
                                            hx-include="[name=postal_code], [name=postal_code], [name=delivery_slot]"
                                            hx-target="#nb_produit"
                                            hx-swap="outerHTML"
                                            onclick="closeModal()">Entre 9h et 13h</button>
                                @endif
                                    <button class="btn btn-warning hvr-grow-shadow"
                                            name="delivery_slot"
                                            value="aprem"
                                            hx-post="{{ route('cart.add_product', $product) }}"
                                            hx-include="[name=postal_code], [name=postal_code], [name=delivery_slot]"
                                            hx-target="#nb_produit"
                                            hx-swap="outerHTML"
                                            onclick="closeModal()">Entre 14h et 18h</button>
                            </div>
                        </div>
                    </div>
                @endif
            @else
                <div class="col">
                    <div class="content me-2 ms-2 mb-3">
                        <h6 class="text-center mb-3">{{ ucfirst($day['formatted_date']) }}</h6>
                        <div class="text-center">
                            <button class="btn btn-primary hvr-grow-shadow me-2"
                                    name="delivery_slot"
                                    value="matin"
                                    hx-post="{{ route('cart.add_product', $product) }}"
                                    hx-include="[name=postal_code], [name=postal_code], [name=delivery_slot]"
                                    hx-target="#nb_produit"
                                    hx-swap="outerHTML"
                                    onclick="closeModal()"> Entre 9h et 13h</button>
                            <button class="btn btn-warning hvr-grow-shadow"
                                    name="delivery_slot"
                                    value="aprem"
                                    hx-post="{{ route('cart.add_product', $product) }}"
                                    hx-include="[name=postal_code], [name=postal_code], [name=delivery_slot]"
                                    hx-target="#nb_produit"
                                    hx-swap="outerHTML"
                                    onclick="closeModal()">Entre 14h et 18h</button>
                            <input type="hidden" name="postal_code" id="postal_code" value="{{ $chosed_cities }}">
                            <input type="hidden" name="delivery_date" id="delivery_date" value="{{ $day['date'] }}">
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
   </form>
