<div class="text-center">
    <img style="width: 100px;" src="{{ asset('frontend/images/24-hours.png') }}">
    <h3 class="mb-5">Choix souhaitez du créneau de livraison (Région Sud / Ouest)</h3>
</div>

<div class="row row-flex row-cols-3 justify-content-center">
    @foreach (getDaysTwoWeeks('sud') as $key => $day)
        @if($key == 0)
            @if(getDateTimeNow() <= '14:00')
                <div class="col">
                    <div class="content me-5 ms-5 mb-5">
                        <h4 class="text-center mb-4">{{ ucfirst(formatDateInFrench($day['date'])) }}</h4>
                        @if(getDateTimeNow() <= '09:00')
                            <button class="btn btn-success btn-sm m-2 hvr-grow-shadow">Entre 9h et 13h</button>
                        @endif
                        <button class="btn btn-warning btn-sm m-2 hvr-grow-shadow">Entre 14h et 18h</button>
                    </div>
                </div>
            @endif
        @else
            <div class="col">
                <div class="content me-5 ms-5 mb-5">
                    <h4 class="text-center mb-4">{{ ucfirst(formatDateInFrench($day['date'])) }}</h4>
                    <div class="d-flex flex-row mb-3 text-center">
                        <button class="btn btn-success btn-sm m-2 hvr-grow-shadow">Entre 9h et 13h</button>
                        <button class="btn btn-warning btn-sm m-2 hvr-grow-shadow">Entre 14h et 18h</button>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
</div>
