<div class="menu-category-name-block">
    <input type="text" name="name"  id="category_{{$category->id}}" value="{{$category->name}}" disabled oninput="changeToSubmitBtn(this)">
    <button type="button" style="width:100px;" class="btn btn-secondary" id="btn_category_{{$category->id}}">Edit</button>
</div>
