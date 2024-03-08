<div id="menu-categories-bar">
    <h1>Menu categories |</h1>
    <form action="{{route('admin_panel_menu_categories')}}" method="POST">
        @csrf
        <input type="text" name="category_name" placeholder="Enter category name" id="input-category">
        <button class="btn btn-success" type="submit" id="input-category-button">Add</button>
    </form>

    @if(session()->has('create_message'))
        <h4>| {{session()->get('create_message')}}</h4>
    @endif
</div>

@if($errors->any())
    <div style="background-color:#ff7f7f; color:#000; padding:10px;">
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </div>
@endif