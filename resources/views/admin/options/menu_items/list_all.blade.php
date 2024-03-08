

@foreach($foods as $food) 
    <form action="{{route('update_food', ['id' => $food->id])}}" method="POST" id="form-food-{{$food->id}}">
        @csrf
        @method('PUT')
        <div class="menu-food-block">
            {{($loop->index+1 < 10 ? '0' : '').$loop->index+1}}.

           

            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" name="show" {{ $food->show_on_menu == 1 ? "checked" : ""}}>
                <label for="flexCheckDefault-{{$food->id}}">Show in menu</label>
            </div>

            <button type="submit" class="btn btn-primary">Save changes</button>
    </form>
            <div class="menu-position-block">
                <p>Move on menu list: </p>
                @include($source.'up_button')
                @include($source.'down_button')
            </div>
            
            <form action="{{route('delete_category', ['id' => $food->id])}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>

        </div>
@endforeach

@foreach($foods as $food) 
    <div class="menu-item-block">
        {{($loop->index+1 < 10 ? '0' : '').$loop->index+1}}.
        <form class="menu-item-form-block" action="{{route('update_food', ['id' => $food->id])}}" method="POST" id="form-food-{{$food->id}}">
            @csrf
            @method('PUT')
            @include($source.'edit_food_name')
            @include($source.'show_in_menu')
            <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
        <div class="menu-category-position-block">
            <p style="margin-top:10px">Move on menu list: </p>
            @include($source.'up_button')
            @include($source.'down_button')
        </div>
        @include($source.'delete_button')
    </div>
@endforeach


