
@foreach($foods as $food) 
    <div class="menu-item-block">
        <p>{{($loop->index+1 < 10 ? '0' : '').$loop->index+1}}.</p>
        <img src="{{asset('/storage/app/public/images/menu_items').'/'.$food->image}}" class="img-fluid" height="200" width="200" alt="{{$food->name}}">
        <div style="width:250px;">
            <p>Name: {{$food->name}}</p>
            <p>Price: {{$food->price}}</p>
            <p>Weight: {{$food->weight}}</p>
        </div>


        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit-menu-item-{{$food->id}}">
            Edit 
        </button>

        @include($source.'edit_menu_modal')
  


        <div class="menu-item-position-block">
            <p style="margin-top:10px">Move on menu list: </p>
            @include($source.'up_button')
            @include($source.'down_button')
        </div>
        @include($source.'delete_button')
    </div>
@endforeach
