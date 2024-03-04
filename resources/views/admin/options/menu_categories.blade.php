
<style>

    #menu-categories-bar {
        display:flex;
        flex-direction:row;
        align-items:center;
    }

    .menu_category_block {
        background-color:#fff;
    }

    #input-category {
        height:40px;
        border-radius:5px;
    }

    #input-category-button {
        height:40px;
        margin-top:-5px;
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

<div>
    @foreach($categories as $category) 
        <div class="menu-category-block">
            <p>{{$category->id}} - {{$category->name}}</p>
        </div>
    @endforeach
</div>
