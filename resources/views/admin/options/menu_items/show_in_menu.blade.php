 <div class="form-check">
    <input class="form-check-input" type="checkbox" value="" id="checkbox-{{$food->id}}" name="show" {{ $food->show_on_menu == 1 ? "checked" : ""}}>
    <label for="checkbox-{{$food->id}}">Show in menu</label>
</div>