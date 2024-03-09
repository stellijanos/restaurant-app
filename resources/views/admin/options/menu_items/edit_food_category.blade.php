<div class="menu-item-value-block">
    <select name="category" id="" class="form-select">
        @foreach($categories as $category) 
            <option value="{{$category->id}}" {{$food->category_id == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
        @endforeach
    </select>
</div>