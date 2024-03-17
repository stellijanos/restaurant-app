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

    <script>
        function getCookieValue(cookie_name) {
            let cookies_array = document.cookie.split(';');

            cookies_array = cookies_array.filter(function(cookie) {
                arr = cookie.split('=');

                return arr[0].trim() == cookie_name;
            });

            if (cookies_array.length === 0) {
                return null;
            }
            cookie_str = cookies_array[0].trim();
            return cookie_str.split('=')[1].trim();
        }

        function getNrElements(cart) {
            return Object.values(cart).reduce((sum, curr) => sum + curr, 0);
        }

        const cart = JSON.parse(getCookieValue('cart'));

        const food_cart_nr = document.getElementById('cart-quantity');

        food_cart_nr.innerText = getNrElements(cart);

    </script>

    <footer class="bg-dark">
        <p>&copy;<?=date('Y') ?> Stelli Janos.</p>
    </footer>
</body>

</html>
