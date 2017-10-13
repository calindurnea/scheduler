<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
        @guest
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{route('shifts_get')}}">Shifts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('users_get')}}">Employees</a>
                </li>
                @managerOrAdmin
                <li class="nav-item">
                    <a class="nav-link" href="{{route('users_create')}}">Add employee</a>
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
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                       aria-haspopup="true" aria-expanded="false">{{ Auth::user()->first_name }} <span
                                class="caret"></span></a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{route('users_show', ['id'=>Auth::user()->id])}}" onclick="event.preventDefault();
                                                     document.getElementById('settings-form').submit();">
                            Settings</a>
                        <form id="settings-form"
                              action="{{route('users_show', ['id'=>Auth::user()->id])}}"
                              method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
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