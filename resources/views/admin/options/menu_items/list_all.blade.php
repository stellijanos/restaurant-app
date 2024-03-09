
@foreach($foods as $food) 
    <div class="menu-item-block">
        {{($loop->index+1 < 10 ? '0' : '').$loop->index+1}}.
        <form class="menu-item-form-block" action="{{route('update_menu_item', ['id' => $food->id])}}" method="POST" id="form-food-{{$food->id}}">
            @csrf
            @method('PUT')
            <div class="menu-item-input-values">
                @include($source.'edit_food_name')
                @include($source.'edit_food_price')
                @include($source.'edit_food_weight')
                @include($source.'edit_food_category')
            </div>
            @include($source.'show_in_menu')
            <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
        <div class="menu-item-position-block">
            <p style="margin-top:10px">Move on menu list: </p>
            @include($source.'up_button')
            @include($source.'down_button')
        </div>
        @include($source.'delete_button')
    </div>
@endforeach
