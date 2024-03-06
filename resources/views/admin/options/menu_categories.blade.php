
<style>

    #menu-categories-bar {
        display:flex;
        flex-direction:row;
        align-items:center;
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
        max-height:calc(100vh - 240px);
    }

    .menu-category-block {
        display:flex;
        flex-direction:row;
        align-items:center;
        justify-content:space-between;
        width:100%;
        min-width:500px;
        height:50px;
        background-color:rgba(211, 211, 211, 0.6);
        padding:10px;
        margin-top:20px;
    }


    .menu-name-block {
        display:flex;
        flex-direction:row;
        align-items:center;
    }

    .menu-name-block>input {
        height:40px;
        border-radius: 5px 0 0 5px;
    }

    .menu-name-block>button {
        height:40px;
        border-radius:0 5px 5px 0;
    }

    .menu-position-block {
        display:flex;
        flex-direction:row;
        /* justify-content:space-between; */
        gap:1rem;
        align-items:center;
    }

</style>

<div id="menu-categories-bar">
    <h1>Menu categories |</h1>
    <form action="{{route('admin_panel_menu_categories')}}" method="POST">
        @csrf
        <input type="text" name="category_name" placeholder="Enter category name" id="input-category">
        <button class="btn btn-success" type="submit" id="input-category-button">Add</button>
    </form><h1>|</h1>
    <button type="submit" class="btn btn-primary" onclick="submit_all_forms()">Save changes</button>

    @if(session()->has('create_message'))
        <h4>{{session()->get('create_message')}}</h4>
    @endif
</div>



<div id="category-listing" class="overflow-auto">
    @foreach($categories as $category) 
        <form action="{{route('update_category', ['id' => $category->id])}}" method="POST" id="category-{{$category->id}}-{{$category->menu_position}}">
            @csrf
            <div class="menu-category-block">
                {{($loop->index+1 < 10 ? '0' : '').$loop->index+1}}.
                <div class="menu-name-block">
                    <input type="text" name="name"  id="category_{{$category->id}}" value="{{$category->name}}" disabled>
                    <button type="button" class="btn btn-secondary" id="btn_category_{{$category->id}}">Edit</button>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" name="show" id="flexCheckDefault-{{$category->id}}" {{ $category->show_on_menu == 1 ? "checked" : ""}}>
                    <label for="flexCheckDefault-{{$category->id}}">Show in menu</label>
                </div>
        </form>
                <div class="menu-position-block">
                    <p>Move on menu list: </p>
                    
                    @if($loop->index >= 1)

                        <form action="{{route('update_category_patch',['id'=>$category->id])}}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="prev" value="{{$categories[$loop->index-1]->id}}">
                            <button type="submit" class="btn btn-warning">UP</button>
                        </form>
                    @else 
                        <button type="button" class="btn btn-secondary" disabled>UP</button>
                    @endif 
                    @if($loop->index < count($categories)-1)
                        <form action="{{route('update_category_patch', ['id'=>$category->id])}}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="prev" value="{{$categories[$loop->index+1]->id}}">
                            <button type="submit" class="btn btn-warning">DOWN</button>
                        </form>
                    @else 
                        <button type="button" class="btn btn-secondary" disabled>DOWN</button>
                    @endif
                </div>
                <form action="{{route('delete_category', ['id' => $category->id])}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
    @endforeach
</div>
