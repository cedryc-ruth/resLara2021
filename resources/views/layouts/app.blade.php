<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Projet réservations - @yield('title')</title>

        @include('feed::links')
        
        @yield('style')
    </head>
    <body>
        <div class="container">
            @yield('content')
        </div>

        @yield('script')
    </body>
</html>