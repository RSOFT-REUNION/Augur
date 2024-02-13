<x-mail::message>
    # Bonjour **{{ $user->firstname }}**,

    Nous avons reçu une demande de suppression de votre compte et des données enregistrées vous concernant.
    Ceci a bien été réalisé.

    Cordialement,<br>
    {{ config('app.name') }}
</x-mail::message>
