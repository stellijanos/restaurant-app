<div class="modal fade" id="view-menu-item-{{$food->id}}" tabindex="-1" aria-labelledby="view-menu-item-{{$food->id}}-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <h1 class="modal-title fs-5" style="text-align:center;" id="view-menu-item-{{$food->id}}-label">{{$food->name}}</h1> -->
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="cart.reset({{$food->id}})"></button>
            </div>
            <div class="modal-body">
                <div class="image">
                    <img src="{{asset('storage/app/public/images/menu_items').'/'.$food->image}}" alt="" width="400", height="400">
                </div>
                <div class="infos">
                    <p class="name">{{$food->name}} - {{$food->weight}}g</p>
                    <p style="font-size:1.5rem; margin-top:-10px;">{{$food->price}} &euro;</p>
                </div>
                <div class="set-quantity-div">
                    <i class="bi bi-dash-circle" id="quantity-icon-dash-{{$food->id}}" onclick="cart.update_quantity_tag({{$food->id}}, {{$food->price}}, -1)" onmouseover="cart.fill_icon({{$food->id}},'dash')" onmouseout="cart.unfill_icon({{$food->id}},'dash')"></i>
                    <p name="quantity" value="1" id="text-quantity-{{$food->id}}">1</p>
                    <input type="hidden" id="quantity-{{$food->id}}" value='1'>
                    <i class="bi bi-plus-circle" id="quantity-icon-plus-{{$food->id}}" onclick="cart.update_quantity_tag({{$food->id}}, {{$food->price}}, 1)" onmouseover="cart.fill_icon({{$food->id}},'plus')" onmouseout="cart.unfill_icon({{$food->id}},'plus')"></i>
                </div>
            </div>
            <div class="modal-footer add-to-cart">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="add-to-cart-{{$food->id}}" onclick="cart.add_to_cart_tag({{$food->id}})" >Add to cart (<span id="price-{{$food->id}}">{{$food->price}}</span> &euro;)</button>
            </div>                
        </div>
    </div>
</div>
