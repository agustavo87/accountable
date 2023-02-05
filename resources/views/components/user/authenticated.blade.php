@props(['user'])
<div class="user-detail">
    Hello {{$user->name}}!
    <ul>
        <li><a href="{{ route('user.logout')}}">Logout</a> </li>
    </ul> 
</div>