

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
        margin:10px;
        gap:1rem;
    }

    .input-menu-item {
        height:40px;
        border-radius:5px;
    }

    #input-meun-item-button {
        height:40px;
        margin-top:-5px;
    }

    #menu-items-bar>select {
        width:200px;
    }

</style>

<script>
    const getMenuItemsByCategory = select => {
        const url = select.value;
        if (url !== "") {
            window.location.href= url;
        }
    }
</script>

<div id="menu-items-bar">
    <select name="category" class="form-select" onchange="getMenuItemsByCategory(this)">
        <option value="{{route('admin_panel_show_menu_items')}}">Choose category</option>
        @foreach($categories as $category)
            <option value="{{route('admin_panel_show_menu_items_by_category',['id' => $category->id])}}" {{($category_name ?? '') === $category->name ? 'selected' : ''}}>{{$category->name}} ({{$category->count}})</option>
        @endforeach
    </select>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create-menu-item">
        Add new menu item
    </button>


    @if(session()->has('create_message'))
        <h4>| {{session()->get('create_message')}}</h4>
    @endif

</div>


@include($source.'create_menu_item')


@if($errors->any())
    <div style="background-color:#ff7f7f; color:#000; padding:10px;">
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </div>
@endif
