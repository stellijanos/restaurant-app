<div id="menu-categories-bar">
    <h1>Menu items |</h1>
    <form action="{{route('admin_panel_create_menu_item')}}" class="form-add-menu-item">
        <input type="text" class="form-control" name="name" placeholder="Name of the product">
        <input type="number" class="form-control" name="price" placeholder="Price" pattern="\d*\.?\d*" min="0">
        <input type="number" class="form-control" name="weight" placeholder="weight" pattern="\d*\.?\d*" min="0">
        <select name="category" class="form-select">
            <option selected>Choose category</option>
            @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
        <button class="btn btn-success" type="submit" id="input-category-button">Add </button>

    </form>
</div>

@if($errors->any())
    <div style="background-color:#ff7f7f; color:#000; padding:10px;">
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </div>
@endif
