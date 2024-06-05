   <form> @csrf
    <div class="row row-flex row-cols-2 justify-content-center">
        @foreach (getDaysTwoWeeks($region) as $key => $day)
            @if($key == 0)
                @if(getDateTimeNow() <= '14:00')
                    <div class="col">
                        <div class="content me-5 ms-5 mb-5 text-center ">
                            <h3 class="mb-4">{{ ucfirst($day['formatted_date']) }}</h3>
                            @if(getDateTimeNow() <= '09:00')
                                <button class="btn btn-primary m-2 hvr-grow-shadow">
                                    Entre 9h et 13h</button>
                            @endif
                            <button class="btn btn-warning m-2 hvr-grow-shadow" style="padding: 3px 20px;">
                                Entre<br> 14h et <br>18h</button>
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

   <script>
       function closeModal() {
           // Vous devrez remplacer 'modalId' par l'ID réel de votre modal
           var modal = document.getElementById('select_slot');
           var modalBackdrop = document.getElementsByClassName('modal-backdrop')[0];

           // Fermer le modal
           modal.style.display = 'none';
           modalBackdrop.remove();
       }
   </script>
