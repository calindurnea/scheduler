    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            {{--<a class="navbar-brand" href="{{ url('/login') }}">--}}
            {{--{{ config('app.name', 'Laravel') }}--}}
            {{--</a>--}}
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            @include('layouts.nav.navLeft')

            @include('layouts.nav.navRight')

        </div>
    </div>