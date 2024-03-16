<div class="modal fade" id="view-menu-item-{{$food->id}}" tabindex="-1" aria-labelledby="view-menu-item-{{$food->id}}-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{route('update_admin_profile')}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h1 class="modal-title fs-5" style="text-align:center;" id="view-menu-item-{{$food->id}}-label">{{$food->name}}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="image">
                        <img src="{{asset('storage/app/public/images/menu_items').'/'.$food->image}}" alt="" width="400", height="400">
                    </div>
                    
                    <p>{{$food->weight}}</p>
                    <p>{{$food->price}}</p>
                </div>
                Quantity: 
                <div class="set-quantity-div">
                    <i class="bi bi-dash" id="remove-item-{{$food->id}}" onclick="change_quantity('quantity-{{$food->id}}')"></i>
                    <p name="quantity" value="1" id="text-quantity-{{$food->id}}">1</p>
                    <input type="hidden" id="quantity-{{$food->id}}" value='1'>
                    <i class="bi bi-plus" id="remove-item-{{$food->id}}" onclick="change_quantity('quantity-{{$food->id}}', true)"></i>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add to cart</button>
                </div>
            </form>
        </div>
    </div>
</div>
