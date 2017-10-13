<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('layouts.head')
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        @include('layouts.nav')
    </nav>
    <div class="container-fluid">
        @yield('content')
    </div>
</div>

@include('layouts.scripts')
@yield('pageScripts')
</body>
</html>
