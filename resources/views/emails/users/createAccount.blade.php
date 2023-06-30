<x-mail::message>
# Bienvenue sur notre site !

Bonjour, **{{ $user->firstname }}**,
Merci d'avoir rejoint **Aügur** !

Nous aimerions vous confirmer que votre compte a été créé avec succès. Vous pouvez désormais vous inscrire a des évènements, suivre vos participations et bien plus !


<x-mail::button :url="route('fo.home')">
Accèder au site
</x-mail::button>

Si vous rencontrez des difficultés pour vous connecter à votre compte, contactez-nous à l'adresse suivante **{{ $setting->main_email }}**

Cordialement,<br>
{{ config('app.name') }}
</x-mail::message>
