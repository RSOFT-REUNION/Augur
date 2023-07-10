<x-mail::message>
# Nouvelle demande de support

<x-mail::table>
    | Nom & Prénom  | Adresse-email |
    | ------------- |:-------------:|
    | {{ $user->lastname }} {{$user->firstname}} | {{ $user->email }} |
</x-mail::table>

## {{ ($support->type == 5) ? $support->other : $support->getType() }}

<x-mail::panel>
    {{ $support->message }}
</x-mail::panel>


Cordialement,<br>
{{ config('app.name') }}
</x-mail::message>
