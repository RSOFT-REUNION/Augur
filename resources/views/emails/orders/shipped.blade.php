<x-mail::message>
    # Bonjour !

    Bonjour, **{{ $user->firstname }}**,
    Merci d'avoir rejoint **Aügur** !

    Nous vous confirmons que votre compte a été créé avec succès. Vous pouvez désormais vous inscrire à des évènements, suivre vos participations et bien plus !


    <x-mail::button :url="route('fo.home')">
        Accèder au site
    </x-mail::button>

    Si vous rencontrez des difficultés pour vous connecter à votre compte, contactez-nous à l'adresse suivante **{{ $setting->main_email }}**

    Cordialement,<br>
    {{ config('app.name') }}
</x-mail::message>
