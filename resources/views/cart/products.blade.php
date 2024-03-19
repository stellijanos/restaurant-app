<div id="products">
    <p style="font-size:2rem; font-weight:bold">Your Products</p>
    @foreach($cart as $food) 
        @include('cart.item')
    @endforeach
</div>
