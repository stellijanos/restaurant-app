<div id="summary">
    <h1>Checkout Summary</h1>

    <div id="products" class="overflow-auto" style="height:300px">
        @foreach($cart as $item) 
            <hr>
            <div class="item">
                <img src="{{asset('storage/app/public/images/menu_items').'/'.$item->image}}" alt="{{$item->name}}" width="100px" height="100px">
                <div class="details">
                    <li>{{$item->name}}</li>
                    <li>{{$item->quantity}}x</li>
                    <li>{{$item->price * $item->quantity}}</li>
                </div>
            </div>
        @endforeach
    </div>

    <div id="pricing-details">
        <hr>
        <h3>Pricing details</h3>
        <ul>
            <li>Produts price: <b>{{$products_price}}</b>&euro;</li>
            <li>Shipping fee: <b>{{$shipping_fee}}</b>&euro; ({{$delivery_type}})</li>
            <li>Total price: <b>{{$products_price + $shipping_fee}}</b>&euro;</li>
        </ul>
    </div>

</div>
