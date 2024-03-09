

<style>

    #form-add-menu-item{
        display:flex;
        flex-direction:row;
        align-items:center;
        justify-content:space-between;
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
    <h1>Menu items |</h1>
    <form action="{{route('create_menu_item')}}" class="form-add-menu-item" method="post">
        @csrf
        <input type="text" class="input-menu-item" name="name" placeholder="Name of the product">
        <input type="number" class="input-menu-item" name="price" placeholder="Price" pattern="\d*\.?\d*" min="0">
        <input type="number" class="input-menu-item" name="weight" placeholder="weight" pattern="\d*\.?\d*" min="0">
        <select name="category" class="input-menu-item">
            <option value="0" selected>Choose category</option>
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
