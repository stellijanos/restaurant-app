
<style>

    #menu-categories-bar {
        display:flex;
        flex-direction:row;
        align-items:center;
    }


    .menu-category-block {
        background-color:#fff;
        height: 75px;
        margin-top:20px;
        width:750px;
        border-radius:5px;
        margin-left:20px;
        padding:5px;
        display:flex;
        flex-direction:row;
        align-items:center;
        justify-content:space-between;
        user-select:none;
    }

    #input-category {
        height:40px;
        border-radius:5px;
    }

    #input-category-button {
        height:40px;
        margin-top:-5px;
    }


    #category-listing {
        /* background-color:blue; */
        height:calc(100vh - 200px);
    }

</style>

<div id="menu-categories-bar">
    <h1>Menu categories | </h1>
    <form action="{{route('admin_panel_menu_categories')}}" method="POST">
        @csrf
        <input type="text" name="category_name" placeholder="Enter category name" id="input-category">
        <button class="btn btn-success" type="submit" id="input-category-button">Add</button>
    </form> 

    @if(session()->has('create_message'))
        <h4>{{session()->get('create_message')}}</h4>
    @endif
</div>

<div id="category-listing" class="overflow-auto">
    @foreach($categories as $category) 
        <form action="" method="POST" class="menu-category-block">
            @csrf
            {{$category->id}}.<input type="text" name="category_{{$category->id}}"  id="category_{{$category->id}}" value="{{$category->name}}" disabled>
            <button type="button" class="btn btn-secondary" id="btn_category_{{$category->id}}">Edit</button>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-{{$category->id}}">
                <label class="form-check-label" for="flexCheckDefault-{{$category->id}}">
                Show in menu
                </label>
            </div>
            <button type="submit" class="btn btn-success">Save changes</button>
            |
            <button type="button" class="btn btn-danger">Delete</button>
        </form>
    @endforeach
</div>
