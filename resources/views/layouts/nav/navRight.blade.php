<!-- Right Side Of Navbar -->
<ul class="nav navbar-nav navbar-right">
    <!-- Authentication Links -->
    @guest
        <li><a href="{{ route('login') }}">Login</a></li>
        <li><a href="{{ route('register') }}">Register</a></li>
        @else
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                   aria-expanded="false">
                    {{ Auth::user()->first_name }} <span class="caret"></span>
                </a>

                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a href="{{route('user_show', ['id'=>Auth::user()->id])}}" onclick="event.preventDefault();
                                                     document.getElementById('settings-form').submit();">
                            Settings
                        </a>

                        <form id="settings-form"
                              action="{{route('user_show', ['id'=>Auth::user()->id])}}"
                              method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                              style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </li>
            @endguest
</ul>