

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
    let exists = false;

    for (let item of cart) {
        if (item.id == id) {
            exists = true;
            item.quantity += quantity;
            break;
        }
    }
    if (!exists) {
        let new_item = {'id' : id, 'quantity' : quantity};
        cart.push(new_item);
    }

    setCookie('cart', JSON.stringify(cart), 30);

    food_cart_nr.innerText = getNrElements(cart);
}

</script>

@endsection
