<div class="item">
    <div class="image">
        <img src="{{asset('storage/app/public/images/menu_items').'/'.$food->image}}" alt="{{$food->name}}" width="100" height="100">
    </div>
    <div class="details-options">
        <div class="name-quantity">
            <p style="font-weight:bold; font-size:1.3rem">{{$food->name}}</p>
            <div class="set-quantity-div">
                <i class="bi bi-dash-circle" id="remove-item-{{$food->id}}" onclick="change_quantity_price('{{$food->id}}', {{$food->price}}); modify_cart({{$food->id}}, -1)" onmouseover="change_color(this, true)" onmouseout="change_color(this, true, true)"></i>
                <p name="quantity" value="1" id="text-quantity-{{$food->id}}">{{$food->quantity}}</p>
                <input type="hidden" id="quantity-{{$food->id}}" value='{{$food->quantity}}'>
                <i class="bi bi-plus-circle" id="remove-item-{{$food->id}}" onclick="change_quantity_price('{{$food->id}}', {{$food->price}}, true); modify_cart({{$food->id}}, +1)" onmouseover="change_color(this, false)" onmouseout="change_color(this, false, true)"></i>
            </div>
            <p class="remove" onclick="modify_cart({{$food->id}})">Remove item</p>
        </div>
        <div class="final-price">
            <p style="font-size:1.2rem; font-weight:bold"><span id="price-{{$food->id}}">{{number_format($food->price * $food->quantity, 2)}}</span>&euro;</p>
        </div>
    </div>
</div>
