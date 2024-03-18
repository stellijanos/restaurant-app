<!doctype html>
<html lang="en" class="">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $page_title }}</title>
        @include('includes.css')
    </head>
    <body>
        @include('includes.navbar')
        @yield('content')
        @include('includes.cookie-consent')
        @include('includes.footer')
        @include('includes.scripts')
    </body>
</html>
