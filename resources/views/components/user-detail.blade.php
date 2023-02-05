
    @if ($authenticated)
        <x-user.authenticated :user="$user" />
    @else
        <x-user.guest />
    @endif
