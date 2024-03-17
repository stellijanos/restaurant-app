
@extends('layouts.header-footer')

@section('content')

<style>
    #cart-div {
        height:calc(100vh - 156px);
        display:flex;
        flex-direction:row;

        padding:10px;
        gap:1rem;
    }

    #products {
        display:flex;
        flex-direction:column;
        width:70%;
        gap:1rem;
    }


    #cart-div .item {
        border:1px solid #000;
        background-color:#fefefa;
        border-radius:10px;
        height:120px;
        width:60%;

        display:flex;
        flex-direction:row;
        gap:0.5rem;
    }

    #cart-div .item > .image>img {
        border-radius:10px;
        margin-left:10px;
    }

    #cart-div .item > .image {
        display:flex;
        justify-content:center;
        align-items:center;
        padding:10px 0;
    }

    .item .details-options  {
        width:calc(100% - 110px);
    }

    .item .details-options {
        display:flex;
        flex-direction:row;
        padding:10px;
        justify-content:space-between;
    }


    .set-quantity-div {
        width:90px;
        height:30px;
        
        display:flex;
        flex-direction:row;
        justify-content:center;
        gap:0.5rem;
        margin:auto;
        margin-left:0;
        font-weight:bold;
        font-size:1.3rem;
    }

    .set-quantity-div  p {
        text-align:center;
        user-select:none;
        width:40px;
    }

    .set-quantity-div i {
        cursor:pointer;
    }

    .set-quantity-div i:hover {
        cursor:pointer;
    }

    .item .remove {
        text-decoration:underline;
        cursor:pointer;
        user-select:none;
    }

</style>
<div class="order-process" style="height:50px; border:1px solid #000;">
    <h1 style="margin-left:10px;">Your cart</h1>
</div>
<div id="cart-div" class="overflow-auto">
    <div id="products">
        <p style="font-size:2rem; font-weight:bold">Your Products</p>
        @foreach($cart as $food) 
            <div class="item">
                <div class="image">
                    <img src="{{asset('storage/app/public/images/menu_items').'/'.$food->image}}" alt="{{$food->name}}" width="100" height="100">
                </div>
                <div class="details-options">
                    <div class="name-quantity">
                        <p style="font-weight:bold; font-size:1.3rem">{{$food->name}}</p>
                        <div class="set-quantity-div">
                            <i class="bi bi-dash-circle" id="remove-item-{{$food->id}}" onclick="change_quantity_price('{{$food->id}}', {{$food->price}})" onmouseover="change_color(this, true)" onmouseout="change_color(this, true, true)"></i>
                            <p name="quantity" value="1" id="text-quantity-{{$food->id}}">{{$food->quantity}}</p>
                            <input type="hidden" id="quantity-{{$food->id}}" value='{{$food->quantity}}'>
                            <i class="bi bi-plus-circle" id="remove-item-{{$food->id}}" onclick="change_quantity_price('{{$food->id}}', {{$food->price}}, true)" onmouseover="change_color(this, false)" onmouseout="change_color(this, false, true)"></i>
                        </div>
                        <p class="remove" onclick="remove_item({{$food->id}})">Remove item</p>
                    </div>
                    <div class="final-price">
                        <p style="font-size:1.2rem; font-weight:bold"><span id="price-{{$food->id}}">{{number_format($food->price * $food->quantity, 2)}}</span>&euro;</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<script>
    const change_color = (btn_icon, is_dash, remove = false) => {
        let type = is_dash ? 'dash' : 'plus';

        if (remove) {
            btn_icon.classList.remove('bi-'+ type +'-circle-fill');
            btn_icon.classList.add('bi-'+ type +'-circle');
        } else {
            btn_icon.classList.remove('bi-'+ type +'-circle');
            btn_icon.classList.add('bi-'+ type +'-circle-fill');
        }
    }
</script>
<script src="{{asset('public/js/menu.js')}}" type="text/javascript"></script>
@endsection
