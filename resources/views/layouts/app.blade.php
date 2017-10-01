<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('layouts.head')
</head>
<body>
<div id="app">
    <nav class="navbar navbar-default navbar-static-top">
        @include('layouts.nav.nav')
    </nav>

    @yield('content')
</div>

@include('layouts.scripts')
</body>
</html>
