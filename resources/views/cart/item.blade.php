
<div class="item">
    <div class="image">
        <img src="{{asset('storage/app/public/images/menu_items').'/'.$food->image}}" alt="{{$food->name}}" width="100" height="100">
    </div>
    <div class="details-options">
        <div class="name-quantity">
            <p style="font-weight:bold; font-size:1.3rem">{{$food->name}}</p>
            <div class="set-quantity-div">
                <i class="bi bi-dash-circle" id="quantity-icon-dash-{{$food->id}}" onclick="cart.updateCartItem({{$food->id}}, {{$food->price}}, -1)" onmouseover="cart.cartUI.fillIcon({{$food->id}},'dash')" onmouseout="cart.cartUI.unfillIcon({{$food->id}},'dash')"></i>
                <p name="quantity" value="1" id="text-quantity-{{$food->id}}">{{$cookie_cart[$food->id] ?? 0 }}</p>
                <input type="hidden" id="quantity-{{$food->id}}" value='{{$cookie_cart[$food->id] ?? 0}}'>
                <i class="bi bi-plus-circle" id="quantity-icon-plus-{{$food->id}}" onclick="cart.updateCartItem({{$food->id}}, {{$food->price}}, 1)" onmouseover="cart.cartUI.fillIcon({{$food->id}},'plus')" onmouseout="cart.cartUI.unfillIcon({{$food->id}},'plus')"></i>
            </div>
            <p class="remove" onclick="cart.removeItem({{$food->id}})">Remove item</p>
        </div>
        <div class="final-price">
            <p style="font-size:1.2rem; font-weight:bold"><span id="price-{{$food->id}}">{{number_format($food->price * $food->quantity, 2)}}</span>&euro;</p>
        </div>
    </div>
</div>
