<x-mail::message>
# Game Invitation
## Hello, {{ $email }}
{{ Auth::user()->name }} has invited you to join the Game.
Please click below button to join.

<x-mail::button :url="$link">
Join Now
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
