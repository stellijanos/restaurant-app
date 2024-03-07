@foreach($foods as $food) 
    <form action="{{route('update_food', ['id' => $food->id])}}" method="POST" id="form-food-{{$food->id}}">
        @csrf
        @method('PUT')
        <div class="menu-food-block">
            {{($loop->index+1 < 10 ? '0' : '').$loop->index+1}}.

            <div class="menu-food-block">
                <input type="text" name="name"  id="food_{{$category->id}}" value="{{$category->name}}" disabled>
                <button type="button" class="btn btn-secondary" id="btn_food_{{$category->id}}">Edit</button>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" name="show" {{ $category->show_on_menu == 1 ? "checked" : ""}}>
                <label for="flexCheckDefault-{{$category->id}}">Show in menu</label>
            </div>

            <button type="submit" class="btn btn-primary">Save changes</button>
    </form>
            <div class="menu-position-block">
                <p>Move on menu list: </p>
                @include('admin.options.menu_categories.up_button')
                @include('admin.options.menu_categories.down_button')
            </div>
            
            <form action="{{route('delete_category', ['id' => $category->id])}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>

        </div>
@endforeach