<x-mail::message>
    # Bienvenue sur notre site !

    Bonjour, **{{ $user->firstname }}**,
    Bienvenue sur notre site, **Aügur**

    Nous avons bien reçu votre demande de création de compte, vous serais averti par e-mail dès que celui-ci sera accessible.

    Vous pouvez nous contacter à tout moment sur l'adresse e-mail suivante **{{ $setting->main_email }}**

    Cordialement,<br>
    {{ config('app.name') }}
</x-mail::message>
