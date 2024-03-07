
<style>
    #menu-items-header,  #form-add-menu-item{
        display:flex;
        flex-direction:row;
        align-items:center;
    }

    #form-add-menu-item {
        justify-content:space-between;
        gap:1rem;
    }

    #category-listing {
        max-height:calc(100vh - 240px);
    }
</style>

<div id="menu-items-header">
    <h1>Menu items |</h1>

    <form action="{{route('admin_panel_create_menu_item')}}" id="form-add-menu-item">
        <input type="text" class="form-control" name="name" placeholder="Name of the product">
        <input type="number" class="form-control" name="price" placeholder="Price" pattern="\d*\.?\d*" min="0">
        <input type="number" class="form-control" name="weight" placeholder="weight" pattern="\d*\.?\d*" min="0">
        <select name="category" class="form-select">
            <option selected>Choose category</option>
            @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-primary" style="width=100px">Add</button>
    </form>
</div>


