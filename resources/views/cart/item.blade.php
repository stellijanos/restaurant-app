<div class="item">
    <div class="image">
        <img src="{{asset('storage/app/public/images/menu_items').'/'.$food->image}}" alt="{{$food->name}}" width="100" height="100">
    </div>
    <div class="details-options">
        <div class="name-quantity">
            <p style="font-weight:bold; font-size:1.3rem">{{$food->name}}</p>
            @include('menu.set-quantity-div')
            <p class="remove" onclick="modify_cart({{$food->id}})">Remove item</p>
        </div>
        <div class="final-price">
            <p style="font-size:1.2rem; font-weight:bold"><span id="price-{{$food->id}}">{{number_format($food->price * $food->quantity, 2)}}</span>&euro;</p>
        </div>
    </div>
</div>
