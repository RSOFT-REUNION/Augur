<x-mail::message>
    # Bonjour **{{ $user->firstname }}**,

    Nous avons reçu une demande de suppression de votre compte ainsi que les données enregistrées vous concernant.
    Celui-ci a donc été immédiatement réalisé.

    Cordialement,<br>
    {{ config('app.name') }}
</x-mail::message>
