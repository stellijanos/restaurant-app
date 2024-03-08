



<style>
    .menu-category-block {
        background-color:rgba(211, 211, 211, 0.6);
        margin:10px;
        padding:10px;
        justify-content:space-between;
    }

    .menu-category-form-block, .menu-category-position-block{
        gap:1rem;
    }

    .menu-category-block, .menu-category-name-block, .menu-category-form-block, .menu-category-position-block {
        display:flex;
        flex-direction:row;
        align-items:center;
    }


    .menu-category-name-block>input {
        height:40px;
        border-radius: 5px 0 0 5px;
    }

    .menu-category-name-block>button {
        height:40px;
        border-radius:0 5px 5px 0;
    }


    .menu-items-block {
        display:flex;
        flex-direction:column;
    }


    .form-add-menu-item {
        display:flex;
        flex-direction:row;
        margin:10px;
        gap:1rem;
    }


</style>


@foreach($categories as $category) 
    <div class="menu-category-block">
        {{($loop->index+1 < 10 ? '0' : '').$loop->index+1}}.
        <form class="menu-category-form-block" action="{{route('update_menu_category', ['id' => $category->id])}}" method="POST" id="form-category-{{$category->id}}">
            @csrf
            @method('PUT')
            @include($source.'edit_category_name')
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

