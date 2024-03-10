
@foreach($foods as $food) 
    <div class="menu-item-block">
        <p style="width:300px;">
            {{($loop->index+1 < 10 ? '0' : '').$loop->index+1}}. {{$food->name}} - {{$food->price}} - {{$food->weight}}
        </p>
        

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
