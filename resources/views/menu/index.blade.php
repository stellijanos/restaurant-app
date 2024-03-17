

@extends('layouts.header-footer')
@section('content')

<link rel="stylesheet" href="{{asset('public/css/menu.css')}}">

<div id="menu" class="overflow-auto">
    @foreach($categories as $category)
        @include('menu/item')
    @endforeach
</div>

<script src="{{asset('public/js/menu.js')}}"></script>


<script>


function setCookie(name, value, days) {
    const date = new Date();
    date.setTime(date.getTime() + (days * 24 * 3600 * 1000));
    const expires = "expires=" + date.toUTCString();
    document.cookie = name + "=" + value + ";" + expires + ";path=/";
}


function addToCart(id) {

    let quantity = Number(document.getElementById('quantity-' + id).value);

    if (cart.hasOwnProperty(id)) {
        cart[id] += quantity;
    } else {
        cart[id] = quantity;
    }

    setCookie('cart', JSON.stringify(cart), 30);

    food_cart_nr.innerText = getNrElements(cart);
}

</script>

@endsection
