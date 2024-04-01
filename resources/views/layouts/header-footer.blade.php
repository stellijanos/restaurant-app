<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $page_title }}</title>
        @include('includes.css')
        <script src="{{asset('/public/js/Cookie.js')}}" ></script>
    </head>
    <body>
        @include('includes.navbar')
        @yield('content')

        @if(!isset($_COOKIE['cookie_consent']) || $_COOKIE['cookie_consent'] !== "accepted")
            @include('includes.cookie-consent')
        @endif
        @include('includes.footer')
        @include('includes.scripts')
    </body>
</html>
