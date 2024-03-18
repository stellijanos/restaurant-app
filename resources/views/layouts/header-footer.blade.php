<!doctype html>
<html lang="en" class="">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $page_title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('public/css/app.css')}}">
    <link rel="icon" href="{{asset('/public/stellijanos.ico')}}" type="image/x-icon">
</head>
<body>

@include('includes.navbar')
    
@yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    @include('cookie-consent')

    
    <footer class="bg-dark">
        <p>&copy;<?=date('Y') ?> Stelli Janos.</p>
    </footer>
    <script src="{{asset('/public/js/Cookie.js')}}" ></script>
	<script src="{{asset('/public/js/cookie-consent.js')}}" ></script>
	<script src="{{asset('/public/js/cart.js')}}" ></script>
    <script>
        const cart = new Cart(Cookie.get('cart'));
        cart.setNrElementsTag();
    </script>
</body>

</html>
