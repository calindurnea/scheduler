<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
        @guest
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{route('shifts.index')}}">Shifts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('users.index')}}">Employees</a>
                </li>
                @managerOrAdmin
                <li class="nav-item">
                    <a class="nav-link" href="{{route('users.create')}}">Add employee</a>
                </li>
                @endmanagerOrAdmin
                @endguest
    </ul>
    <ul class="navbar-nav">
        @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">Register</a>
            </li>
            @else
                <li class="nav-item dropdown">
                    <a id="logged-user" class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                       aria-haspopup="true" aria-expanded="false">{{ Auth::user()->first_name }} <span
                                class="caret"></span></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{route('users.show', Auth::user()->id)}}">
                            Settings</a>
                        <a class="dropdown-item" href="/chat">Chatroom</a>
                        @managerOrAdmin
                        <a class="dropdown-item" href="{{route('colors.index')}}">Edit colors</a>
                        <a class="dropdown-item" href="{{route('schedules.show', 1)}}">Edit schedule</a>
                        @endmanagerOrAdmin

                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                              style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </li>
                @endguest

    </ul>
</div>