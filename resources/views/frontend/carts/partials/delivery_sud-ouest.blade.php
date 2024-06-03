<div class="text-center">
    <h3>Choix souhaitez du créneau de livraison (Région Sud / Ouest)</h3>
</div>
@foreach (getDaysTwoWeeks('sud') as $day)
    @dump(ucfirst(formatDateInFrench($day['date'])))
@endforeach
