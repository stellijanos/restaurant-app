

<style>

    #form-add-menu-item{
        display:flex;
        flex-direction:column;
        align-items:space-between;
        justify-content:center;
        gap:1rem;
    }

    #menu-items-bar {
        display:flex;
        flex-direction:row;
        align-items:center;
    }

    .input-menu-item {
        height:40px;
        border-radius:5px;
    }

    #input-meun-item-button {
        height:40px;
        margin-top:-5px;
    }

</style>


<div id="menu-items-bar">
    <h1> {{$category_name ?? 'Choose category >>>'}} |</h1>
    
    <form action="{{route('admin_panel_get_menu_items_by_category')}}" method="post" style="width:250px; margin-right:20px; display:flex">
        @csrf
        <select name="category" class="form-select">
            <option value="0" selected>Choose category</option>
            @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-warning">Show</button>
    </form>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create-menu-item">
        Add new menu item
    </button>
</div>

@include($source.'create_menu_item')


@if($errors->any())
    <div style="background-color:#ff7f7f; color:#000; padding:10px;">
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </div>
@endif
