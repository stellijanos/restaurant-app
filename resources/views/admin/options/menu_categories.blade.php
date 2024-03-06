
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
                {{$loop->index+1}}.
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

                        <form action="{{route('update_category',['id'=>$category->id])}}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="" value="{{$categories[$loop->index-1]->id}}">
                            
                    </form>


                    @endif

                    @if($category->menu_position < count($categories))


                    @endif
                    
                    <input type="hidden" name="position" id="menu-position-{{$category->menu_position}}" value="{{$category->menu_position}}">
                    <button 
                        type="button" 
                        id="up-{{$category->id}}-{{$category->menu_position}}" 
                        class="btn btn-warning" 
                        onclick="moveUp({{$category->id}},{{$category->menu_position}})"
                        {{$category->menu_position == 1 ? 'disabled' : ''}}
                        >UP
                    </button>
                    <button 
                        type="button" 
                        id="down-{{$category->id}}-{{$category->menu_position}}" 
                        class="btn btn-warning" 
                        onclick="moveDown({{$category->id}},{{$category->menu_position}})"
                        {{$category->menu_position == count($categories) ? 'disabled' : ''}}
                        >DOWN
                    </button>
                </div>
                <form action="{{route('delete_category', ['id' => $category->id])}}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
    @endforeach
</div>

<script>

    const moveUp = (id, position) => { 
        const position_int = parseInt(position); 
        document.getElementById('menu-position-'+ position).value = position_int - 1;
        document.getElementById('menu-position-'+ (position_int - 1)).value = position_int; 

        const item1 = document.getElementById('category-' + id + '-' + position);
        const item2 = item1.previousElementSibling;

    
        item1.submit();
        item2.submit();
    
    
    }

    const moveDown = (id, position) => {
        const item = document.getElementById('category-' + id + '-' + position);
        const nextItemId = item.nextElementSibling.id;
        console.log(nextItemId); 
    }

</script>


