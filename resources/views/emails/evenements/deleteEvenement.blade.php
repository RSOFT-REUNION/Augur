<x-mail::message>
# Annulation de notre évènement

Bonjour, {{ $user->firstname }},

Nous sommes navrés de vous annoncer que notre évènement du **{{ date('d/m/Y', strtotime($evenement->date)) }}** concernant "**{{ $evenement->title }}**" a été annulé.

N'hésitez pas à nous contacter pour plus d'informations ou à vous rendre sur notre site afin de consulter nos autres évènements en cours.

<x-mail::button :url="route('fo.evenements')">
Découvrir nos autres évènements
</x-mail::button>

Merci,<br>
{{ config('app.name') }}
</x-mail::message>
