<form> @csrf
    <div class="container mb-5" style="margin-top: 90px;">
        @php
            $days = getDaysTwoWeeks($region);
            $week1 = array_slice($days, 0, 7);
            $week2 = array_slice($days, 7);
        @endphp

        <div class="row">
            <div class="col-1 p-0">
                <div class="hour-column">
                    @for ($hour = 8; $hour <= 18; $hour++)
                        <div class="hour-row">
                            {{ $hour }}:00
                        </div>
                    @endfor
                </div>
            </div>
            <div class="col-11 p-0">
                <div class="week-grid">
                    @foreach ($week1 as $key => $day)
                        <div class="day-column {{ $day['is_target_day'] ? '' : 'target-day' }}">
                            <div class="day-header">{{ ucfirst($day['formatted_date']) }}</div>
                            <div class="day-content">
                                @if($day['is_target_day'])
                                    @if(getDateDayPlusOne() < $day['date'])
                                        <div class="morning-session">&nbsp;</div>
                                        <button class="btn btn-primary rounded-0 hvr-grow-shadow" style="height: 175px;"
                                                name="delivery_slot"
                                                value="matin"
                                                hx-post="{{ route('cart.add_product', $product) }}"
                                                hx-include="[name=postal_code], [name=postal_code], [name=delivery_slot]"
                                                hx-target="#nb_produit"
                                                hx-swap="outerHTML">
                                            Entre 9h et 13h
                                        </button>
                                        <div class="morning-session">&nbsp;</div>
                                        <button class="btn btn-warning rounded-0 hvr-grow-shadow" style="height: 140px;"
                                                name="delivery_slot"
                                                value="aprem"
                                                hx-post="{{ route('cart.add_product', $product) }}"
                                                hx-include="[name=postal_code], [name=postal_code], [name=delivery_slot]"
                                                hx-target="#nb_produit"
                                                hx-swap="outerHTML">
                                            Entre 14h et 18h
                                        </button>
                                    @else
                                        <div class="morning-session">&nbsp;</div>
                                        <div class="morning-session">&nbsp;</div>
                                        <div class="morning-session">&nbsp;</div>
                                        <div class="morning-session">&nbsp;</div>
                                        <div class="morning-session">&nbsp;</div>
                                        <div class="morning-session">&nbsp;</div>
                                        <div class="morning-session">&nbsp;</div>
                                        <div class="morning-session">&nbsp;</div>
                                        <div class="morning-session">&nbsp;</div>
                                        <div class="morning-session">&nbsp;</div>
                                        <div class="morning-session">&nbsp;</div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <h4 class="mt-3" style="margin-bottom: 80px;">Semaine suivante</h4>
        <div class="row">
            <div class="col-1 p-0">
                <div class="hour-column">
                    @for ($hour = 8; $hour <= 18; $hour++)
                        <div class="hour-row">
                            {{ $hour }}:00
                        </div>
                    @endfor
                </div>
            </div>
            <div class="col-11 p-0">
                <div class="week-grid">
                    @foreach ($week2 as $key => $day)
                        <div class="day-column {{ $day['is_target_day'] ? '' : 'target-day' }}">
                            <div class="day-header">{{ ucfirst($day['formatted_date']) }}</div>
                            <div class="day-content">
                                @if($day['is_target_day'])
                                    @if(getDateDayPlusOne() < $day['date'])
                                        <div class="morning-session">&nbsp;</div>
                                        <button class="btn btn-primary rounded-0 hvr-grow-shadow" style="height: 175px;"
                                                name="delivery_slot"
                                                value="matin"
                                                hx-post="{{ route('cart.add_product', $product) }}"
                                                hx-include="[name=postal_code], [name=postal_code], [name=delivery_slot]"
                                                hx-target="#nb_produit"
                                                hx-swap="outerHTML">
                                            Entre 9h et 13h
                                        </button>
                                        <div class="morning-session">&nbsp;</div>
                                        <button class="btn btn-warning rounded-0 hvr-grow-shadow" style="height: 140px;"
                                                name="delivery_slot"
                                                value="aprem"
                                                hx-post="{{ route('cart.add_product', $product) }}"
                                                hx-include="[name=postal_code], [name=postal_code], [name=delivery_slot]"
                                                hx-target="#nb_produit"
                                                hx-swap="outerHTML">
                                            Entre 14h et 18h
                                        </button>
                                    @else
                                        <div class="morning-session">&nbsp;</div>
                                        <div class="morning-session">&nbsp;</div>
                                        <div class="morning-session">&nbsp;</div>
                                        <div class="morning-session">&nbsp;</div>
                                        <div class="morning-session">&nbsp;</div>
                                        <div class="morning-session">&nbsp;</div>
                                        <div class="morning-session">&nbsp;</div>
                                        <div class="morning-session">&nbsp;</div>
                                        <div class="morning-session">&nbsp;</div>
                                        <div class="morning-session">&nbsp;</div>
                                        <div class="morning-session">&nbsp;</div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>

    </div>

</form>
