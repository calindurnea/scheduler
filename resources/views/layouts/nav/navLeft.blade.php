<!-- Left Side Of Navbar -->
<ul class="nav navbar-nav">
    @guest
        @else
            <li><a href="{{route('schedule_show')}}">Schedule</a></li>
            <li><a href="{{route('users_show')}}">Users</a></li>
            <li><a href="{{route('user_create')}}">Add user</a></li>
            @endguest
</ul>