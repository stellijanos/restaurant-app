<link rel="stylesheet" href="{{asset('public/css/cart.css')}}">
<div class="order-process" style="height:50px; border:1px solid #000;">
    <h1 style="margin-left:10px;">Your cart</h1>
</div>
<div id="cart-div" class="overflow-auto">
    @include('cart.products')
    @include('cart.checkout')
</div>
