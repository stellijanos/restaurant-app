<div class="modal fade" id="view-menu-item-{{$food->id}}" tabindex="-1" aria-labelledby="view-menu-item-{{$food->id}}-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <h1 class="modal-title fs-5" style="text-align:center;" id="view-menu-item-{{$food->id}}-label">{{$food->name}}</h1> -->
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="image">
                    <img class="img-fluid" src="{{asset('storage/app/public/images/menu_items').'/'.$food->image}}" alt="" width="400", height="400">
                </div>
                <div class="infos">
                    <p class="name">{{$food->name}} - {{$food->weight}}g</p>
                    <p style="font-size:1.5rem; margin-top:-10px;">{{$food->price}} &euro;</p>
                </div>
                @include('menu.set-quantity-div')
            </div>
            <div class="modal-footer add-to-cart">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="add-to-cart-{{$food->id}}" onclick="cart.addToCart({{$food->id}})" >Add to cart (<span id="price-{{$food->id}}">{{$food->price}}</span> &euro;)</button>
            </div>                
        </div>
    </div>
</div>
