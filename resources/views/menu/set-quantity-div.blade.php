<div class="set-quantity-div">
    <i class="bi bi-dash-circle" id="quantity-icon-dash-{{$food->id}}" onclick="cart.update_quantity_tag({{$food->id}}, {{$food->price}}, -1); " onmouseover="cart.fill_icon({{$food->id}},'dash')" onmouseout="cart.unfill_icon({{$food->id}},'dash')"></i>
    <p name="quantity" value="1" id="text-quantity-{{$food->id}}">1</p>
    <input type="hidden" id="quantity-{{$food->id}}" value='1'>
    <i class="bi bi-plus-circle" id="quantity-icon-plus-{{$food->id}}" onclick="cart.update_quantity_tag({{$food->id}}, {{$food->price}}, 1); " onmouseover="cart.fill_icon({{$food->id}},'plus')" onmouseout="cart.unfill_icon({{$food->id}},'plus')"></i>
</div>
