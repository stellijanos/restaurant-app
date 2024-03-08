<div class="form-check">
    <input class="form-check-input" type="checkbox" value="" id="checkbox-{{$category->id}}" name="show" {{ $category->show_on_menu == 1 ? "checked" : ""}}>
    <label for="checkbox-{{$category->id}}">Show in menu</label>
</div>