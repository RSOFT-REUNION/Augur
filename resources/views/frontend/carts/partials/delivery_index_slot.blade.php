<form action="" method="post"> @csrf
    <input type="hidden" name="address" value="{{ @$user_address->id }}">
    <input type="hidden" name="cart" value="{{ @$cart->id }}">
    <input type="hidden" name="deliver" value="{{ @$deliver->id  }}">

    <div class="row row-flex row-cols-3 justify-content-center">
        @foreach (getDaysTwoWeeks($region) as $key => $day)
            @if($key == 0)
                @if(getDateTimeNow() <= '14:00')
                    <div class="col">
                        <div class="content me-5 ms-5 mb-5 text-center ">
                            <h3 class="mb-4">{{ ucfirst($day['formatted_date']) }}</h3>
                            @if(getDateTimeNow() <= '09:00')
                                <button class="btn btn-primary m-2 hvr-grow-shadow"
                                        hx-post="{{ route('cart.chosed_delivery_date', [$deliver, $day['date'], 'matin']) }}"
                                        hx-swap="outerHTML"
                                        hx-target="#divdelivery"
                                        hx-indicator=".htmx-indicator, .htmx-style">
                                        @if($day['date'] == @$date && $slot == 'matin')
                                            <h4><span class="badge bg-success position-absolute top-0 start-0 slot-favorite"><i class="fa-regular fa-star"></i></span></h4>
                                        @endif
                                        Entre 9h et 13h</button>
                            @endif
                            <button class="btn btn-warning m-2 hvr-grow-shadow" style="padding: 3px 20px;"
                                    hx-post="{{ route('cart.chosed_delivery_date', [$deliver, $day['date'], 'aprem']) }}"
                                    hx-swap="outerHTML"
                                    hx-target="#divdelivery"
                                    hx-indicator=".htmx-indicator, .htmx-style">
                                    @if($day['date'] == @$date && $slot == 'aprem')
                                        <h4><span class="badge bg-success position-absolute top-0 start-0 slot-favorite"><i class="fa-regular fa-star"></i></span></h4>
                                    @endif
                                    Entre<br> 14h et <br>18h</button>
                        </div>
                    </div>
                @endif
            @else
                <div class="col">
                    <div class="content me-5 ms-5 mb-5">
                        <h3 class="text-center mb-4">{{ ucfirst($day['formatted_date']) }}</h3>
                        <div class="d-flex flex-row mb-3 text-center">
                            <button class="btn btn-primary m-2 hvr-grow-shadow"
                                    hx-post="{{ route('cart.chosed_delivery_date', [$deliver, $day['date'], 'matin']) }}"
                                    hx-swap="outerHTML"
                                    hx-target="#divdelivery"
                                    hx-indicator=".htmx-indicator, .htmx-style">
                                    @if($day['date'] == @$delivery_date && $delivery_slot == 'matin')
                                        <h4><span class="badge bg-success position-absolute top-0 start-0 slot-favorite"><i class="fa-regular fa-star"></i></span></h4>
                                    @endif
                                Entre 9h et 13h</button>
                            <button class="btn btn-warning m-2 hvr-grow-shadow"
                                    hx-post="{{ route('cart.chosed_delivery_date', [$deliver, $day['date'], 'aprem']) }}"
                                    hx-swap="outerHTML"
                                    hx-target="#divdelivery"
                                    hx-indicator=".htmx-indicator, .htmx-style">
                                    @if($day['date'] == @$delivery_date && $delivery_slot == 'aprem')
                                        <h4><span class="badge bg-success position-absolute top-0 start-0 slot-favorite"><i class="fa-regular fa-star"></i></span></h4>
                                    @endif
                                    Entre 14h et 18h</button>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</form>
