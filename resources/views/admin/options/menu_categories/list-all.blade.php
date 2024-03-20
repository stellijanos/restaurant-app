@foreach($categories as $category) 
    <div class="menu-category-block">
        {{($loop->index+1 < 10 ? '0' : '').$loop->index+1}}.
        <form class="menu-category-form-block" action="{{route('update_menu_category', ['id' => $category->id])}}" method="POST" id="form-category-{{$category->id}}">
            @csrf
            @method('PUT')
            @include($source.'edit_category_name')
        </form>
        <div class="menu-category-position-block">
            <p style="margin-top:10px">Move on menu list: </p>
            @include($source.'up-button')
            @include($source.'down-button')
        </div>
        @include($source.'delete-button')
    </div>
    <hr>
@endforeach
